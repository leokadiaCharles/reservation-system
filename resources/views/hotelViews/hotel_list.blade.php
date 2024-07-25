@extends('layouts.app')
@section('content')
<div class="all-content-wrapper">
    <div class="product-status mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>All Hotels</h4>
                        <div class="asset-inner">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Hotel Name</th>
                                        <th>Hotel Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($hotels as $index => $hotel)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $hotel->hotel_name }}</td>
                                        <td>{!! $hotel->hotel_location !!}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
