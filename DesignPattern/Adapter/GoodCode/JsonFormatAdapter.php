<?php

namespace DesignPattern\Adapter\GoodCode;

// ============================================
// STEP 5: FORMAT ADAPTER (FOR JSON)
// ============================================

/**
 * Another adapter for format conversion
 * Converts XML format to JSON format
 */

class JsonFormatAdapter
{
    private WeatherService $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function getWeatherAsJson(string $city , string $country) : string
    {
        // Get data from weather service
        $data = $this->weatherService->getWeather($city, $country);

        // Convert to JSON
        return json_encode($data, JSON_PRETTY_PRINT);
    }

}
