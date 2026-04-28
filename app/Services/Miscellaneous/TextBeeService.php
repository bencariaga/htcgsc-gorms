<?php

namespace App\Services\Miscellaneous;

use App\Exceptions\NoInternetConnectionException;
use Illuminate\Http\Client\{ConnectionException, Response};
use Illuminate\Support\Facades\{Http, Log};

class TextBeeService
{
    protected ?string $baseUrl = null;

    protected ?string $apiKey = null;

    protected ?string $deviceId = null;

    public function __construct()
    {
        $settings = ['base_url', 'api_key', 'device_id'];

        foreach ($settings as $setting) {
            $property = str($setting)->camel()->toString();
            $config = "services.textbee.{$setting}";
            $this->{$property} = config($config);
        }
    }

    public function sendSms(array $recipients, string $message): ?Response
    {
        try {
            if (blank($this->apiKey) || blank($this->deviceId)) {
                Log::error('TextBee SMS API failed. API key or Device ID may be missing.');

                return null;
            }

            $url = "{$this->baseUrl}/gateway/devices/{$this->deviceId}/send-sms";

            return Http::withHeaders(['x-api-key' => $this->apiKey, 'Accept' => 'application/json'])->timeout(3)->withoutVerifying()->post($url, compact('recipients', 'message'));
        } catch (ConnectionException) {
            throw new NoInternetConnectionException;
        }
    }
}
