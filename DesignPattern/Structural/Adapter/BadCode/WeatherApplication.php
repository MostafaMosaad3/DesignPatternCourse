<?php

namespace Adapter\BadCode;



/**
 * SCENARIO: Weather Application
 *
 * PROBLEM:
 * - Current application expects: city and country (XML format)
 * - Need to change to: longitude and latitude
 * - Must extract city and country from coordinates
 * - Third-party service takes city and country
 * - Also need to display in JSON format
 *
 * SOLUTION: Use Adapter Pattern
 */

// ============================================
// BAD CODE - WITHOUT ADAPTER PATTERN
// ============================================
class WeatherApplication
{
    public function getWeather(string $city , string $country) :array
    {
        $weather = $this->fetchWeatherFromAPI($city, $country);

        return $this->formatAsXml($weather);
    }

    private function fetchWeatherFromAPI(string $city, string $country): array
    {
        // Call third-party API with city and country
        return [
            'temperature' => 25,
            'condition' => 'Sunny',
            'city' => $city,
            'country' => $country
        ];
    }

    private function formatAsXML(array $data): array
    {
        // Return XML format
        return [
            'format' => 'XML',
            'data' => $data
        ];
    }
}


/**
 * PROBLEMS:
 * ❌ Hard-coded to expect city and country
 * ❌ Hard-coded to XML format
 * ❌ Can't easily switch to longitude/latitude
 * ❌ Can't easily switch to JSON format
 * ❌ Must modify existing code to change requirements
 * ❌ Violates Open/Closed Principle
 */
