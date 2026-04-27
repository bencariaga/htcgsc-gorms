<?php

namespace App\Models;

use App\{Contracts\CommonModel, Traits\Miscellaneous\IsCommonModel};
use App\Enums\{DataCategory, FileOutputFormat};
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $report_id
 * @property string $title
 * @property mixed $start_date
 * @property mixed $end_date
 * @property DataCategory $data_category
 * @property FileOutputFormat $file_output_format
 * @property mixed $created_at
 * @property mixed $updated_at
 */
class Report extends Model implements CommonModel
{
    use IsCommonModel;

    /** @var array */
    protected $fillable = ['report_id', 'title', 'start_date', 'end_date', 'data_category', 'file_output_format'];

    protected function casts(): array
    {
        return ['start_date' => 'date:Y-m-d', 'end_date' => 'date:Y-m-d', 'data_category' => DataCategory::class, 'file_output_format' => FileOutputFormat::class];
    }
}
