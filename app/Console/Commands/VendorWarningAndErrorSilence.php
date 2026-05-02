<?php

namespace App\Console\Commands;

use App\Support\Regex;
use Illuminate\Support\Facades\File;

class VendorWarningAndErrorSilence extends BaseCommand
{
    protected $signature = 'vendor:silence';

    public function handle()
    {
        $configPath = base_path('phpunit.xml');

        if (!File::exists($configPath)) {
            $this->components->error('The phpunit.xml file was not found in the root directory.');

            return 1;
        }

        $content = File::get($configPath);

        if (str($content)->contains('<env name="TERMINATE_ON_WARNING" value="false"/>')) {
            $this->components->info('Warnings are already silenced in phpunit.xml.');

            return 0;
        }

        $pattern = Regex::phpBlock();
        $replacement = Regex::phpBlockReplacement();
        $newContent = str($content)->replaceMatches($pattern, $replacement);
        File::put($configPath, $newContent);
        $this->components->info('Successfully silenced vendor warnings and errors in phpunit.xml.');

        return 0;
    }
}
