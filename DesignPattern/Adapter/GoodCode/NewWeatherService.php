<?php

namespace DesignPattern\Adapter\GoodCode;

/**
 * Adaptee: The new service that uses longitude/latitude
 *
 * This is the NEW system we need to integrate
 */

class NewWeatherService
{
    public function fetchWeatherByCoordinates(float $longitude , float $latitude ) : array
    {
        return [
            'temp' => 25,
            'conditions' => 'Sunny',
            'longitude' => $longitude,
            'latitude' => $latitude
        ];
    }
}
