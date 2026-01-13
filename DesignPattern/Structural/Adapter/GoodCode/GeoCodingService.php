<?php

namespace Adapter\GoodCode;

class GeoCodingService
{
    /**
     * Convert city and country to longitude and latitude
     */
    public function getCityCoordinates(string $city, string $country): array
    {
        // Simulate geocoding API call
        // In real app, this would call Google Maps API or similar

        $coordinates = [
            'Cairo,Egypt' => ['longitude' => 31.2357, 'latitude' => 30.0444],
            'London,UK' => ['longitude' => -0.1276, 'latitude' => 51.5074],
            'New York,USA' => ['longitude' => -74.0060, 'latitude' => 40.7128],
        ];

        $key = $city . ',' . $country;
        return $coordinates[$key] ?? ['longitude' => 0.0, 'latitude' => 0.0];
    }
}
