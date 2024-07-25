<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\USSDController;
use App\Http\Controllers\ReviewController;



use App\Models\Table;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $tables = Table::where('is_available', true)->get();

    return view('dashboard', compact('tables'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});



// Table routes
Route::get('/hotelViews.new_table', [TableController::class, 'tableShow'])->name('hotelViews.tableShow');
Route::post('/hotelViews.new_table', [TableController::class, 'storeTable'])->name('hotelViews.storeTable');
Route::get('/hotelViews.table_list', [TableController::class, 'index'])->name('hotelViews.index');
Route::post('/hotelViews/updateTable/{id}', [TableController::class, 'update'])->name('hotelViews.updateTable');
Route::get('/table/edit/{id}', [TableController::class, 'edit'])->name('table.edit');
Route::delete('tables/delete', [TableController::class, 'deleteTable'])->name('hotelViews.deleteTable');

// Hotel routes
Route::get('/hotelViews.newTable', [HotelController::class, 'index'])->name('hotelViews.newTable');
Route::post('/hotelViews.newTable', [HotelController::class, 'storeHotel'])->name('hotelViews.storeHotel');
Route::get('/hotelViews.newHotel', [HotelController::class, 'showHotels'])->name('hotelViews.showHotels');

// Venue routes
Route::get('/hotelViews.newVenue', [VenueController::class, 'venueShow'])->name('hotelViews.venueShow');
Route::post('/hotelViews.newVenue', [VenueController::class, 'storeVenue'])->name('hotelViews.storeVenue');
Route::get('/hotelViews.venue_list', [VenueController::class, 'venueList'])->name('hotelViews.venueList');
Route::delete('venues/delete', [VenueController::class, 'deleteVenue'])->name('hotelViews.deleteVenue');
Route::get('venue/editVenue/{id}', [VenueController::class, 'editVenue'])->name('venue.editVenue');
Route::put('venue/updateVenue/{id}', [VenueController::class, 'updateVenue'])->name('venue.updateVenue');

// // Booking routes
// Route::get('/hotelViews.bookingForm', [BookingController::class, 'create'])->name('bookings.create');
Route::get('/hotelViews/bookingForm/{table?}', [BookingController::class, 'index'])->name('bookings.index');
Route::get('/tables', [TableController::class, 'index'])->name('tables.index');
Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store');



// USSD routes
Route::post('/ussd', [USSDController::class, 'handleUSSD']);


//review
Route::get('/hotelViews/newReview',[ReviewController::class, 'create'])->name('review.create');

Route::post('/review',[ReviewController::class, 'store'])->name('review.store');

require __DIR__.'/auth.php';
