<?php

namespace App\Components\Molecules\Forms;

use Illuminate\View\Component;

class ReportForm extends Component
{
    public function __construct(public mixed $initialState = null, public mixed $preloadedData = null, public mixed $selectedFile = null, public mixed $jsFields = null, public mixed $jsFormats = null, public mixed $actionHeader = null, public mixed $fields = null, public mixed $categories = null, public mixed $today = null, public mixed $formats = null, public mixed $actions = null, public string $type = '') {}

    public function render()
    {
        return view('components.molecules.forms.report-form');
    }
}
