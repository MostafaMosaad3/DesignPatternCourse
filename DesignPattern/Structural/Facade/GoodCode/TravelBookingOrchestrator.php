<?php

namespace DesignPattern\Structural\Facade\GoodCode;

// ============================================
// BUSINESS LOGIC LAYER (Separate Concern!)
// ✅ Purpose: Handle business rules and orchestration
// ============================================


class TravelBookingOrchestrator
{
    protected $facade ;

    public function __construct(TravelBookingFacade $facade)
    {
        $this->facade = $facade;
    }

    /**
     * ✅ GOOD: Business logic separated here
     * Orchestrates the booking process
     */
    public function bookCompleteTrip(
        string $origin,
        string $destination,
        string $date,
        string $checkoutDate
    ): array
    {
        $totalAmount = 0;

        // Book flight
        $flight = $this->facade->searchAndBookFlight($origin, $destination, $date);
        $totalAmount += $flight['data']['price'];

        // Reserve hotel
        $hotel = $this->facade->searchAndReserveHotel($destination, $date, $checkoutDate);
        $totalAmount += $hotel['data']['price'];

        // Rent car
        $car = $this->facade->searchAndRentCar($destination, $date);
        $totalAmount += $car['data']['price'];

        // Process payment
        $payment = $this->facade->processPayment($totalAmount);

        return [
            'flight' => $flight['booking'],
            'hotel' => $hotel['booking'],
            'car' => $car['booking'],
            'payment' => $payment,
            'total' => $totalAmount
        ];
    }
}


/**
 * ============================================
 * PROPER SEPARATION OF CONCERNS:
 * ============================================
 *
 * 1. SUBSYSTEMS (FlightService, HotelService, etc.):
 *    ✅ Handle their specific domain logic
 *    ✅ Don't know about each other
 *
 * 2. FACADE (TravelBookingFacade):
 *    ✅ Provides SIMPLE INTERFACE to subsystems
 *    ✅ Just delegates calls
 *    ✅ NO business logic
 *    ✅ Makes subsystems easier to use
 *
 * 3. ORCHESTRATOR (TravelBookingOrchestrator):
 *    ✅ Contains BUSINESS LOGIC
 *    ✅ Orchestrates multiple operations
 *    ✅ Handles workflow and coordination
 *    ✅ Uses facade for simplified access
 *
 * 4. CONTROLLER (BookingController):
 *    ✅ Handles HTTP REQUESTS/RESPONSES
 *    ✅ Validates input
 *    ✅ Calls orchestrator
 *    ✅ Returns responses
 *
 * ============================================
 * ADVANTAGES:
 * ============================================
 *
 * 1. SINGLE RESPONSIBILITY:
 *    ✅ Each class has ONE clear purpose
 *    ✅ Easy to understand and maintain
 *
 * 2. LOOSE COUPLING:
 *    ✅ Controller doesn't know about subsystems
 *    ✅ Orchestrator uses facade interface
 *    ✅ Easy to change implementations
 *
 * 3. TESTABILITY:
 *    ✅ Test controller: mock orchestrator
 *    ✅ Test orchestrator: mock facade
 *    ✅ Test facade: mock services
 *    ✅ Each layer isolated
 *
 * 4. MAINTAINABILITY:
 *    ✅ Change business logic? Update orchestrator
 *    ✅ Change service API? Update facade
 *    ✅ Change HTTP handling? Update controller
 *    ✅ Changes are localized
 *
 * 5. FLEXIBILITY:
 *    ✅ Can reuse orchestrator in different contexts
 *    ✅ Can reuse facade with different orchestrators
 *    ✅ Can swap implementations easily
 *
 * ============================================
 * COMPARISON: BAD vs GOOD
 * ============================================
 *
 * BAD CODE (Without Facade):
 * ❌ Controller creates 4 services
 * ❌ Controller has business logic
 * ❌ Controller orchestrates everything
 * ❌ Tightly coupled
 * ❌ Hard to test
 * ❌ Hard to maintain
 *
 * GOOD CODE (With Facade + Proper Separation):
 * ✅ Controller is thin (just HTTP)
 * ✅ Orchestrator has business logic
 * ✅ Facade simplifies subsystem access
 * ✅ Loosely coupled
 * ✅ Easy to test each layer
 * ✅ Easy to maintain and extend
 *
 * That's the power of Facade Pattern
 * WITH proper Separation of Concerns! 🚀
 */


