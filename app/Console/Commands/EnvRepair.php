<?php

namespace App\Console\Commands;

use App\Support\Regex;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\{Artisan, File};
use Symfony\Component\Console\Command\Command as ConsoleCommand;
use Throwable;

class EnvRepair extends BaseCommand
{
    protected $signature = 'env:repair';

    public function handle(): int
    {
        $this->info('Starting environment health check...');

        if (!File::exists(base_path('.env'))) {
            $this->components->error('.env file is missing! Copying from .env.example...');
            File::copy(base_path('.env.example'), base_path('.env'));
        }

        if (!$this->shouldGenerateKey()) {
            $this->components->info('APP_KEY is present and healthy.');
        } else {
            $this->components->warn('APP_KEY is missing or invalid. Generating a new one...');
            $this->removeExistingKey();
            Artisan::call('key:generate', ['--force' => true]);
            $this->info('New APP_KEY generated successfully.');
        }

        $this->info('Clearing cached configurations to sync changes...');
        Artisan::call('config:clear');

        try {
            Artisan::call('config:cache');
        } catch (Throwable $e) {
            $this->components->error('Failed to cache configuration. Check your config files for non-serializable values (like Objects or Closures).');
            $this->line($e->getMessage());

            return ConsoleCommand::FAILURE;
        }

        $this->components->info('System is refurbished and ready to go!');

        return ConsoleCommand::SUCCESS;
    }

    protected function shouldGenerateKey(): bool
    {
        $key = config('app.key');
        $cipher = config('app.cipher');

        if (blank($key)) {
            return true;
        }

        try {
            new Encrypter($this->parseKey($key), $cipher);

            return false;
        } catch (Throwable) {
            return true;
        }
    }

    protected function removeExistingKey(): void
    {
        $envPath = base_path('.env');
        $content = File::get($envPath);
        $content = str($content)->replaceMatches(Regex::appKey(), Regex::appKeyPrefix());
        File::put($envPath, $content);
    }

    protected function parseKey(string $key): string
    {
        return str($key)->startsWith('base64:') ? str($key)->after('base64:')->fromBase64() : $key;
    }
}
