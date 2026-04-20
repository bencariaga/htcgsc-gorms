<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\File;

class EnvCheck extends BaseCommand
{
    protected $signature = 'env:check';

    public function handle()
    {
        $envPath = base_path('.env');
        $examplePath = base_path('.env.example');

        if (!File::exists($envPath) && !File::exists($examplePath)) {
            $this->components->warn('No .env.example and .env detected.');
            $this->components->info('Generating .env.example and .env...');
            $stub = "# Created automatically\nAPP_NAME=Laravel\nAPP_ENV=local\nAPP_KEY=\nAPP_DEBUG=true\nAPP_URL=http://localhost";

            File::put($examplePath, $stub);
            File::copy($examplePath, $envPath);

            $this->call('key:generate');
            $this->components->info('.env.example and .env have been generated!');

            return;
        }

        if (!File::exists($envPath)) {
            $this->components->warn('No .env detected.');
            $this->components->info('Generating .env...');
            File::copy($examplePath, $envPath);
            $this->call('key:generate');
            $this->components->info('.env has been generated!');

            return;
        }

        if (!File::exists($examplePath)) {
            $this->components->warn('No .env.example detected.');
            $this->components->info('Generating .env.example from .env...');
            $envContent = File::get($envPath);
            $exampleContent = str($envContent)->replaceMatches('/=.*$/m', '=');
            File::put($examplePath, $exampleContent);
            $this->components->info('.env.example has been generated!');

            return;
        }

        if (blank(config('app.key'))) {
            $this->components->warn('APP_KEY is missing in .env.');
            $this->call('key:generate');
            $this->components->info('APP_KEY has been generated!');
        }

        $this->components->info('Both .env and .env.example are present.');
    }
}
