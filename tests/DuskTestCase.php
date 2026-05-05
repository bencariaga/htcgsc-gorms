<?php

namespace Tests;

use Facebook\WebDriver\{Chrome\ChromeOptions, Remote\DesiredCapabilities, Remote\RemoteWebDriver};
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\{Concerns\ProvidesBrowser, TestCase as BaseTestCase};
use Pest\{Arch\Concerns\Architectable, Browser\Browsable};

abstract class DuskTestCase extends BaseTestCase
{
    use Architectable, Browsable, DatabaseMigrations, ProvidesBrowser;

    public static function prepare()
    {
        if (!static::runningInSail()) {
            static::startChromeDriver();
        }
    }

    protected function driver()
    {
        $options = (new ChromeOptions)->addArguments(collect([$this->shouldStartMaximized() ? '--start-maximized' : '--window-size=1920,1080', '--disable-search-engine-choice-screen'])->unless($this->hasHeadlessDisabled(), fn ($items) => $items->merge(['--disable-gpu', '--headless=new']))->all());

        return RemoteWebDriver::create($_ENV['DUSK_DRIVER_URL'] ?? 'http://localhost:9515', DesiredCapabilities::chrome()->setCapability(ChromeOptions::CAPABILITY, $options));
    }

    protected function hasHeadlessDisabled(): bool
    {
        return collect($_SERVER)->has('DUSK_HEADLESS_DISABLED') || collect($_ENV)->has('DUSK_HEADLESS_DISABLED');
    }

    protected function shouldStartMaximized(): bool
    {
        return collect($_SERVER)->has('DUSK_START_MAXIMIZED') || collect($_ENV)->has('DUSK_START_MAXIMIZED');
    }
}
