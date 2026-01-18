<?php

namespace DesignPattern\Structural\Facade\GoodCode;

// ============================================
// BAD CODE: WITHOUT FACADE PATTERN
// ============================================

/**
 * PROBLEMS:
 * ❌ Client must interact with ALL subsystems directly
 * ❌ Must know internal implementation details
 * ❌ Tightly coupled code
 * ❌ Hard to maintain and test
 * ❌ Complex client code
 */

// ============================================
// SUBSYSTEMS (Complex Services)
// ============================================

class FlightService
{
    public function searchFlights(string $origin, string $destination, string $date): array
    {
        // Complex flight search logic
        return [
            'flight_id' => 'FL-' . rand(1000, 9999),
            'from' => $origin,
            'to' => $destination,
            'date' => $date,
            'price' => 500
        ];
    }

    public function bookFlight(string $flightId): string
    {
        // Complex booking logic
        return "Flight {$flightId} booked successfully";
    }

}
