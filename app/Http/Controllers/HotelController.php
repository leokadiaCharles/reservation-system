<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class HotelController extends Controller
{
    //
    public function index(){
        
        return view('hotelViews.newTable');
    }

    public function storeHotel(Request $request)
    {
        try {
            $request->validate([
                'hotel_name' => 'required|string',
                'hotel_location' => 'required|string',
            ]);

            
            // Create the hotel record
            $table = Hotel::create([
                'hotel_name' => $request->input('hotel_name'),
                'hotel_location' => $request->input('hotel_location'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return redirect()->route('hotelViews.newTable')->with('success', 'Hotel information stored successfully.');

        } catch (\Exception $e) {
            // Log error
            Log::error('Failed to store hotel: ' . $e->getMessage());

            return redirect()->route('hotelViews.newTable')->with('error', 'Failed to store hotel. Please try again.');
        }
    }

    public function showHotels(){

        $hotels = Hotel::select('hotel_name','hotel_location')
        ->get(); 
        return view('hotelViews.show_list', compact('hotels'));
        
    }
}
