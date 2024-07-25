@extends('layouts.app')
@section('content')
<div class="all-content-wrapper">
    <div class="product-status mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-status-wrap">
                        <h4>Hotel List</h4>
                        <div class="add-product">
                            <a href="">Add Hotel</a>
                        </div>
                        <div class="asset-inner">
                            <table>
                                <tr>
                                    <th>No</th>
                                    <th>Hotel Name</th>
                                    <th>Location </th>
                                </tr>
                                @foreach($hotels as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->hotel_name }}</td>
                                    <td>{{ $item->hotel_location }}</td>
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
