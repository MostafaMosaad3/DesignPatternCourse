<?php

namespace DesignPattern\Structural\Facade\BadCode;
use Illuminate\Http\Request;

class BookingController
{
    /**
     * ❌ BAD: Client must create and manage ALL subsystems
     * ❌ Must know the order of operations
     * ❌ Must understand ALL implementation details
     */
    public function bookingCompleteTrip(Request $request)
    {
        $flightService = new FlightService();
        $hotelService = new HotelService();
        $carService = new CarRentalService() ;
        $paymentService = new PaymentService();

        $totalAmount = 0 ;

        // ❌ Step 1: Search and book flight
        $flightData = $flightService->searchFlights(
            $request->origin,
            $request->destination,
            $request->date
        );
        $flightBooking = $flightService->bookFlight($flightData['flight_id']);
        $totalAmount += $flightData['price'];

        // ❌ Step 2: Search and reserve hotel
        $hotelData = $hotelService->searchHotels(
            $request->destination,
            $request->date,
            $request->checkout_date
        );
        $hotelBooking = $hotelService->reserveRoom($hotelData['hotel_id']);
        $totalAmount += $hotelData['price'];

        // ❌ Step 3: Search and rent car
        $carData = $carService->searchCars(
            $request->destination,
            $request->date
        );
        $carBooking = $carService->rentCar($carData['car_id']);
        $totalAmount += $carData['price'];

        // ❌ Step 4: Process payment
        $payment = $paymentService->processPayment($totalAmount);

        return response()->json([
            'flight' => $flightBooking,
            'hotel' => $hotelBooking,
            'car' => $carBooking,
            'payment' => $payment,
            'total' => $totalAmount
        ]);
    }

    /**
     * ❌ BAD: Code duplication for flight-only booking
     */
    public function bookFlightOnly(Request $request)
    {
        // ❌ Must create services again
        $flightService = new FlightService();
        $paymentService = new PaymentService();

        $flightData = $flightService->searchFlights(
            $request->origin,
            $request->destination,
            $request->date
        );
        $flightBooking = $flightService->bookFlight($flightData['flight_id']);
        $payment = $paymentService->processPayment($flightData['price']);

        return response()->json([
            'flight' => $flightBooking,
            'payment' => $payment,
            'total' => $flightData['price']
        ]);
    }
}

/**
 * ============================================
 * PROBLEMS WITH BAD CODE:
 * ============================================
 *
 * 1. TIGHT COUPLING:
 *    ❌ Controller depends on ALL subsystems
 *    ❌ Change one service = change controller
 *
 * 2. COMPLEX CLIENT CODE:
 *    ❌ Client must know ALL implementation details
 *    ❌ Must create 4 service objects
 *    ❌ Must know correct order of operations
 *
 * 3. CODE DUPLICATION:
 *    ❌ Similar code repeated in each method
 *    ❌ Hard to maintain
 *
 * 4. HARD TO TEST:
 *    ❌ Must mock ALL services
 *    ❌ Complex test setup
 *
 * 5. NO SEPARATION OF CONCERNS:
 *    ❌ Controller handles business logic
 *    ❌ Controller orchestrates services
 *    ❌ Controller handles presentation
 *
 * ============================================
 * SOLUTION: USE FACADE PATTERN!
 * ============================================
 */
