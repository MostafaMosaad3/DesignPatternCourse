<?php

namespace DesignPattern\Structural\Facade\GoodCode;

// ============================================
// FACADE: SIMPLIFIED INTERFACE ONLY
// ✅ Purpose: Provide simple access to complex subsystems
// ✅ Does NOT contain business logic
// ============================================


class TravelBookingFacade
{
    protected $hotelService;
    protected $carService;
    protected $flightService;
    protected $paymentService;


    public function __construct(
        HotelService $hotelService,
        FlightService $flightService,
        PaymentService $paymentService,
        CarRentalService $carService
    ) {
        $this->hotelService = $hotelService;
        $this->flightService = $flightService;
        $this->paymentService = $paymentService;
        $this->carService = $carService;
    }


    /**
     * ✅ GOOD: Just delegates to FlightService
     * No business logic here
     */
    public function searchAndBookFlight(string $origin, string $destination, string $date): array
    {
        $flightData = $this->flightService->searchFlights($origin, $destination, $date);
        $booking = $this->flightService->bookFlight($flightData['flight_id']);

        return [
            'data' => $flightData,
            'booking' => $booking
        ];
    }

    /**
     * ✅ GOOD: Just delegates to HotelService
     */
    public function searchAndReserveHotel(string $location, string $checkin, string $checkout): array
    {
        $hotelData = $this->hotelService->searchHotels($location, $checkin, $checkout);
        $booking = $this->hotelService->reserveRoom($hotelData['hotel_id']);

        return [
            'data' => $hotelData,
            'booking' => $booking
        ];
    }

    /**
     * ✅ GOOD: Just delegates to CarRentalService
     */
    public function searchAndRentCar(string $location, string $pickupDate): array
    {
        $carData = $this->carService->searchCars($location, $pickupDate);
        $booking = $this->carService->rentCar($carData['car_id']);

        return [
            'data' => $carData,
            'booking' => $booking
        ];
    }

    /**
     * ✅ GOOD: Just delegates to PaymentService
     */
    public function processPayment(float $amount): string
    {
        return $this->paymentService->processPayment($amount);
    }
}

