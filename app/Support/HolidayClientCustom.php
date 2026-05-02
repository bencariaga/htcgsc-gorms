<?php

namespace App\Support;

use App\Enums\NonDB\PhilippineHolidays;
use Exception;
use Illuminate\Support\{Carbon, Facades\Cache, Facades\Http};
use San103\Phpholidayapi\HolidayClientLaravel;

class HolidayClientCustom extends HolidayClientLaravel
{
    protected int|string $customYear;

    protected ?string $customApiKey;

    public function __construct()
    {
        parent::__construct();
        $this->customYear = date('Y');
        $this->customApiKey = config('services.holiday_client.api_key');
    }

    /** @param int|string $y */
    public function year($y): self
    {
        $this->customYear = $y;
        parent::year($y);

        return $this;
    }

    /** @param string $key */
    public function apiKey($key): self
    {
        $this->customApiKey = $key;
        parent::apiKey($key);

        return $this;
    }

    public function result()
    {
        $cc = 'philippines';
        $url = "https://www.googleapis.com/calendar/v3/calendars/en.{$cc}%23holiday%40group.v.calendar.google.com/events?key={$this->customApiKey}";

        return Cache::remember("holidays_{$this->customYear}", now()->addMonth(), function () use ($url) {
            try {
                $response = Http::timeout(3)->get($url);

                if (!$response->successful()) {
                    return PhilippineHolidays::fixedDates((int) $this->customYear);
                }

                $items = collect($response->json()['items']);
                $isPublicHoliday = fn ($item) => $item['description'] === 'Public holiday';
                $isSpecificYear = fn ($item) => Carbon::parse($item['start']['date'])->year == $this->customYear;
                $isConfirmed = fn ($item) => $item['status'] === 'confirmed';
                $formatToDateArray = fn ($item) => [$item['summary'] => $item['start']['date']];
                $apiHolidays = $items->filter($isPublicHoliday)->filter($isSpecificYear)->filter($isConfirmed)->mapWithKeys($formatToDateArray)->toArray();

                return collect([PhilippineHolidays::fixedDates((int) $this->customYear), $apiHolidays])->collapse();
            } catch (Exception) {
                return PhilippineHolidays::fixedDates((int) $this->customYear);
            }
        });
    }
}
