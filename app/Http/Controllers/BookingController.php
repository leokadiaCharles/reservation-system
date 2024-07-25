<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;
use App\Models\payement;
use Illuminate\Support\Facades\Session;


class BookingController extends Controller
{
    public function index(Table $table){
        return view('hotelViews.bookingForm',compact('table'));
    }


    public function showBookingform(){
        
        return view('hotelViews.bookingForm');
    
    }
    

    public function creates(Table $table)
{
    return view('bookings.create', compact('table'));
}



public function store(Request $request)
{
    $request->validate([
        'table_id' => 'required|exists:tables,id',
        'booking_date' => 'required|date',
        'booking_time' => 'required|date_format:H:i',
        'transaction_id' => 'required|string|exists:payements,transaction_id', // Validate existence of transaction_id in payments table
    ]);

    try {
        $table = Table::findOrFail($request->input('table_id'));

        if (!$table->is_available) {
            return redirect()->back()->with('error', 'Table is not available for booking.');
        }

        // Retrieve the payment details for the provided transaction_id
        $payment = payement::where('transaction_id', $request->transaction_id)->first();

        if (!$payment) {
            return redirect()->back()->with('error', 'Invalid transaction ID. Please provide a valid transaction ID.');
        }

        // Check if the transaction_id has already been used for a booking
        $existingBooking = Booking::where('transaction_id', $request->transaction_id)->first();

        if ($existingBooking) {
            return redirect()->back()->with('error', 'This transaction ID has already been used for a booking.');
        }

        // Proceed with booking since transaction_id exists and is valid
        $bookingData = [
            'table_id' => $table->id,
            'user_id' => auth()->id(),
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'transaction_id' => $request->transaction_id,
        ];

        $booking = Booking::create($bookingData);

        $table->is_available = false; 
        $table->save();
if($table->save()){
    return redirect()->route('dashboard')->with('success', 'Table booked successfully.');
};
        

    } catch (\Exception $e) {
        Log::error('Failed to book table: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to book table. Please try again.');
    }
}


}
