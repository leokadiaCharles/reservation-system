@extends('layouts.app')

@section('content')
<div class="all-content-wrapper">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               
                <div class="card-header">Book Table</div>


                <div class="card-body">
                   
                    <form method="POST" action="{{ route('bookings.store') }}">
                        @csrf
                       
                            <input type="hidden" name="table_id" value="{{ $table->id }}">

                            <div class="form-group">
    <label for="booking_date">Booking Date</label>
    <input id="booking_date" type="date" class="form-control" name="booking_date" min="{{ date('Y-m-d') }}" required>
</div>

<script>
    // Ensure booking date is from today onwards
    document.addEventListener('DOMContentLoaded', function() {
        let today = new Date().toISOString().split('T')[0];
        document.getElementById('booking_date').setAttribute('min', today);
    });
</script>


                         <div class="form-group">
                            <label for="transaction_id">Transaction id</label>
                            <input id="transaction_id" type="number" class="form-control" name="transaction_id" required>
                        </div>

                        <div class="form-group">
                            <label for="booking_time">Booking Time</label>
                            <input id="booking_time" type="time" class="form-control" name="booking_time" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Book Table</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
                    </div>
@endsection
