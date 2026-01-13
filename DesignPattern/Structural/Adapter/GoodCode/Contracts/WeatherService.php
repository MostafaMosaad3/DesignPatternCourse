<?php

namespace Adapter\GoodCode\Contracts;

/**
 * Target Interface: What our application expects
 *
 * This is the interface our application code uses
 */

interface WeatherService
{
    public function getWeather(string $city , string $country) : array;
}
