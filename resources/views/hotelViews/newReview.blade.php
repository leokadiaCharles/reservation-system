@extends('layouts.app')

@section('content')
<div class="all-content-wrapper">
    <div class="container">
        <h2>Create a New Review</h2>
        <form action="{{ route('review.store') }}" method="POST">
            @csrf
            <input type="hidden" name="reviewable_type" value="App\Models\Table">
            <input type="hidden" name="reviewable_id" value="{{ $table->id }}">
            
            <div class="form-group">
                <label for="rating">Rating:</label>
                <div id="star-rating" class="stars">
                    <!-- Render stars dynamically with data-rating attribute -->
                    <i class="far fa-star" data-rating="1"></i>
                    <i class="far fa-star" data-rating="2"></i>
                    <i class="far fa-star" data-rating="3"></i>
                    <i class="far fa-star" data-rating="4"></i>
                    <i class="far fa-star" data-rating="5"></i>
                </div>
                <input type="hidden" name="rating" id="rating" required>
            </div>
            
            <div class="form-group" id="review-group" style="display: none;">
                <label for="review">Review:</label>
                <textarea name="review" id="review" class="form-control" required>{{ old('review') }}</textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit Review</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<script>
    $(document).ready(function() {
        console.log('Document ready! Initializing star rating...');

        $('#star-rating').find('i').click(function() {
            var rating = $(this).data('rating');
            console.log('Selected rating:', rating);

            // Update UI: change star colors based on selected rating
            $('#star-rating').find('i').each(function() {
                if ($(this).data('rating') <= rating) {
                    $(this).removeClass('far').addClass('fas text-warning');
                } else {
                    $(this).removeClass('fas text-warning').addClass('far');
                }
            });

            // Set the selected rating in the hidden input
            $('#rating').val(rating);

            // Set the comment based on rating
            if (rating === 5) {
                $('#review').val('Excellent service');
            } else if (rating === 4) {
                $('#review').val('Very Good service');
            }
            else if (rating === 3) {
                $('#review').val('Good service');
            }
             else {
                $('#review').val('');
            }

            // Show/hide review textarea based on rating
            if (rating < 3) {
                $('#review-group').show();
                $('#review').prop('required', true);
            } else {
                $('#review-group').hide();
                $('#review').prop('required', false);
            }
        });
    });
</script>
@endsection
