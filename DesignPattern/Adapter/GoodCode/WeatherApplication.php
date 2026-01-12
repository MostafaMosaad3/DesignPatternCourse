<?php

namespace DesignPattern\Adapter\GoodCode;

class WeatherApplication
{
    private $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    /**
     * Display weather information
     *
     * Application doesn't know about adapters!
     * It just uses the interface
     */
    public function displayWeather(string $city, string $country): array
    {
        return $this->weatherService->getWeather($city, $country);
    }
}

/**
 * BENEFITS ACHIEVED:
 *
 * ✅ Application code unchanged
 *    - Still calls getWeatherData(city, country)
 *    - Doesn't know about coordinates internally
 *
 * ✅ New service integrated
 *    - NewWeatherService uses coordinates
 *    - Adapter handles conversion
 *
 * ✅ Geocoding extracted
 *    - Separate service for city → coordinates
 *    - Reusable elsewhere
 *
 * ✅ Format conversion easy
 *    - JsonFormatAdapter for JSON output
 *    - Can add more format adapters
 *
 * ✅ Open/Closed Principle
 *    - Add new adapters without changing existing code
 *
 * ✅ Easy to test
 *    - Each component independent
 *    - Can mock adapters
 */
