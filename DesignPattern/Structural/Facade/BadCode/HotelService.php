<?php

namespace DesignPattern\Structural\Facade\BadCode;

class HotelService
{
    public function searchHotels(string $location, string $checkin, string $checkout): array
    {
        // Complex hotel search logic
        return [
            'hotel_id' => 'HT-' . rand(1000, 9999),
            'name' => 'Grand Plaza Hotel',
            'location' => $location,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'price' => 800
        ];
    }

    public function reserveRoom(string $hotelId): string
    {
        // Complex reservation logic
        return "Hotel {$hotelId} reserved successfully";
    }
}
