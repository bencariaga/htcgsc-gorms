<?php

namespace App\Exports\Components;

use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\{Alignment, Border, Fill};
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

trait Styles
{
    public function registerEvents(): array
    {
        return [AfterSheet::class => function (AfterSheet $event) {
            $event->sheet->getDelegate()->freezePane('A3');
        }];
    }

    public function styles(Worksheet $worksheet)
    {
        $lastColumn = $worksheet->getHighestColumn();
        $lastRow = $worksheet->getHighestRow();

        $fullRange = "A1:{$lastColumn}{$lastRow}";

        $worksheet->getParent()->getDefaultStyle()->getFont()->setName('Arial');
        $worksheet->getParent()->getDefaultStyle()->getFont()->setSize(14);
        $worksheet->getParent()->getDefaultStyle()->getFont()->getColor()->setRGB('000000');
        $worksheet->getParent()->getProperties()->setCustomProperty('officestopover', true);

        foreach ($worksheet->getColumnIterator() as $column) {
            $worksheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }

        $worksheet->getDefaultRowDimension()->setRowHeight(35);

        $alignment = ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER];
        $borders = ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']]];

        $worksheet->getStyle($fullRange)->applyFromArray(compact('alignment', 'borders'));

        $rows = [1 => ['text' => '000000', 'bg' => 'FFFFFF'], 2 => ['text' => 'FFFFFF', 'bg' => '2563EB']];

        foreach ($rows as $row => $colors) {
            $font = ['bold' => true, 'color' => ['rgb' => $colors['text']]];
            $fill = ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $colors['bg']]];
            $worksheet->getStyle("A{$row}:{$lastColumn}{$row}")->applyFromArray(compact('font', 'fill'));
        }

        for ($i = 3; $i <= $lastRow; $i++) {
            $color = ($i % 2 !== 0) ? 'FFFFFF' : 'F4F4F4';
            $worksheet->getStyle("A{$i}:{$lastColumn}{$i}")->getFill()->applyFromArray(['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => $color]]);
        }

        $worksheet->getStyle("A3:A{$lastRow}")->getFont()->setBold(true);
        $worksheet->setSelectedCell('A1');

        return [];
    }
}
