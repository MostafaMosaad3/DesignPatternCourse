<?php

namespace DesignPattern\Adapter\GoodCode;

class WeatherServiceAdapter implements WeatherService
{
    private NewWeatherService $newWeatherService;
    private GeocodingService $geocodingService;

    public function __construct(
        NewWeatherService $newWeatherService,
        GeocodingService $geocodingService
    ) {
        $this->newWeatherService = $newWeatherService;
        $this->geocodingService = $geocodingService;
    }

    /**
     * Adapt the interface: city/country → coordinates → weather
     *
     * Application calls this with city/country
     * We convert to coordinates and call new service
     */

    public function getWeather(string $city, string $country): array
    {
        // Step 1: Convert city and country to coordinates
        $coordinates = $this->geocodingService->getCityCoordinates($city, $country);

        // Step 2: Call new service with coordinates
        $weatherData = $this->newWeatherService->fetchWeatherByCoordinates(
            $coordinates['longitude'],
            $coordinates['latitude']
        );

        // Step 3: Transform data to expected format
        return [
            'temperature' => $weatherData['temp'],
            'condition' => $weatherData['conditions'],
            'city' => $city,
            'country' => $country
        ];
    }


}
