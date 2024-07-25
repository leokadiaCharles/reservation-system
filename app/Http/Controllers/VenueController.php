<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Venue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VenueController extends Controller
{
    public function index(){
        return view('hotelViews.updateTable');
    }

    public function venueShow()
    {
        return view('hotelViews.newVenue');
    }

    public function venueList()
    {
        $venues = Venue::select('id', 'venue_name', 'venue_capacity', 'venue_amount', 'venue_image')->get();
        return view('hotelViews.venue_list', compact('venues'));
    }

    public function storeVenue(Request $request)
    {
        try {
            $request->validate([
                'venue_name' => 'required|string',
                'venue_capacity' => 'required|integer',
                'venue_amount' => 'required|numeric|min:0',
                'additional_notes' => 'required|string',
                'venue_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Handle file upload
            $path = null;
            if ($request->hasFile('venue_image')) {
                $image = $request->file('venue_image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $path = $image->storeAs('images', $imageName, 'public');
            }

            // Create the venue record
            $venue = Venue::create([
                'venue_name' => $request->input('venue_name'),
                'venue_capacity' => $request->input('venue_capacity'),
                'venue_amount' => $request->input('venue_amount'),
                'additional_notes' => $request->input('additional_notes'),
                'venue_image' => $path,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            // Logging success
            Log::info('Venue created successfully.', ['venue_id' => $venue->id]);

            return redirect()->route('hotelViews.venueShow')->with('success', 'Venue information stored successfully.');

        } catch (\Exception $e) {
            // Log error
            Log::error('Failed to store venue: ' . $e->getMessage());

            return redirect()->route('hotelViews.venueShow')->with('error', 'Failed to store venue. Please try again.');
        }
    }

    public function deleteVenue(Request $request)
    {
        try {
            $id = $request->input('id'); // Retrieve the 'id' parameter from the request

            $venue = Venue::find($id);

            if (!$venue) {
                return redirect()->route('hotelViews.venueList')->with('error', 'Venue not found.');
            }

            $venue->delete();

            // Logging success
            Log::info('Venue deleted successfully.', ['venue_id' => $id]);

            return redirect()->route('hotelViews.venueList')->with('success', 'Venue deleted successfully.');

        } catch (\Exception $e) {
            // Log error
            Log::error('Failed to delete venue: ' . $e->getMessage());

            return redirect()->route('hotelViews.venueList')->with('error', 'Failed to delete venue. Please try again.');
        }
    }

    public function editVenue($id)
    {
        try {
            $venue = Venue::find($id);

            if (!$venue) {
                return redirect()->route('hotelViews.venueList')->with('error', 'Venue not found.');
            }

            return view('hotelViews.updateVenue', compact('venue'));

        } catch (\Exception $e) {
            // Log error
            Log::error('Failed to fetch venue for editing: ' . $e->getMessage());

            return redirect()->route('hotelViews.venueList')->with('error', 'Failed to fetch venue for editing. Please try again.');
        }
    }

    public function updateVenue(Request $request, $id)
    {
        try {
            $request->validate([
                'venue_name' => 'required|string',
                'venue_capacity' => 'required|integer',
                'venue_amount' => 'required|numeric|min:0',
                'additional_notes' => 'required|string',
                'venue_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $venue = Venue::find($id);

            if (!$venue) {
                return redirect()->route('hotelViews.venueList')->with('error', 'Venue not found.');
            }

            // Handle file upload if a new image is provided
            if ($request->hasFile('venue_image')) {
                // Delete the old image if exists
                if ($venue->venue_image) {
                    Storage::disk('public')->delete($venue->venue_image);
                }

                $image = $request->file('venue_image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $path = $image->storeAs('images', $imageName, 'public');
                $venue->venue_image = $path;
            }

            // Update venue details
            $venue->venue_name = $request->input('venue_name');
            $venue->venue_capacity = $request->input('venue_capacity');
            $venue->venue_amount = $request->input('venue_amount');
            $venue->additional_notes = $request->input('additional_notes');
            $venue->updated_at = Carbon::now();
            $venue->save();

            // Logging success
            Log::info('Venue updated successfully.', ['venue_id' => $venue->id]);

            return redirect()->route('hotelViews.venueList')->with('success', 'Venue updated successfully.');

        } catch (\Exception $e) {
            // Log error
            Log::error('Failed to update venue: ' . $e->getMessage());

            return redirect()->route('hotelViews.venueList')->with('error', 'Failed to update venue. Please try again.');
        }
    }
}
