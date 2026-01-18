<?php

namespace DesignPattern\Structural\Facade\GoodCode;

class CarRentalService
{
    public function searchCars(string $location, string $pickupDate): array
    {
        // Complex car search logic
        return [
            'car_id' => 'CR-' . rand(1000, 9999),
            'model' => 'Toyota Camry',
            'location' => $location,
            'pickup_date' => $pickupDate,
            'price' => 200
        ];
    }

    public function rentCar(string $carId): string
    {
        // Complex rental logic
        return "Car {$carId} rented successfully";
    }
}
