<?php

namespace App\Actions\Report;

use App\Models\Report;

class DeleteReport
{
    public function execute(int $id): void
    {
        Report::destroy($id);
    }
}
