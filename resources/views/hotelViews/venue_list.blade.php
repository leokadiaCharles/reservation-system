@extends('layouts.app')
@section('content')
<div class="all-content-wrapper">
    <div class="product-status mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Venue List</h4>
                        <div class="add-product">
                            <a href="{{ route('hotelViews.venueShow') }}">Add Venue</a>
                        </div>
                        <div class="asset-inner">
                            <table>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Venue name</th>
                                    <th>Capacity</th>
                                    <th>Amount</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                @foreach($venues as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><img src="{{ asset('storage/' . $item->venue_image) }}" alt="Venue Image" width="100"/></td>
                                    <td>{{ $item->venue_name }}</td>
                                    <td>{{ $item->venue_capacity }}</td>
                                    <td>{{ $item->venue_amount }}</td>
                                    <td>
                                        <a href="{{ route('venue.editVenue',$item->id) }}" style="color:blue;">Edit</a>
                                    </td>
                                    <td>
                                    <form action="{{ route('hotelViews.deleteVenue') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this venue?');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <button type="submit" style="background:none;border:none;color:red;cursor:pointer;">Delete</button>
                                </form>

                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="custom-pagination">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
