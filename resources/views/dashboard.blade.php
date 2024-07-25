@extends('layouts.app')

@section('content')
@role('Customer')
<div class="all-content-wrapper">
@if (session('success'))
 <div class ="alert-alert-success">{{session('success')}}</div>
@endif
    <div class="analytics-sparkle-area">
        <div class="contacts-area mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    @foreach($tables as $table)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="student-inner-std res-mg-b-30">
                                <div class="student-img">
                                    @if($table->table_image)
                                        <img src="{{ asset('storage/' . $table->table_image) }}" alt="Table Image" />
                                    @else
                                        <img src="{{ asset('img/default_table.jpg') }}" alt="Default Table Image" />
                                    @endif
                                </div>
                                <div class="student-dtl">
                                    <h2>Table {{ $table->id }}</h2>
                                    <p class="dp">Type: {{ $table->table_type }}</p>
                                    <p class="dp">Size: {{ $table->table_size }}</p>
                                    <p class="dp-ag"><b>Amount:</b> ${{ $table->table_amount }}</p>
                                    <div class="button-ap-list responsive-btn">
                                        <div class="button-style-four btn-mg-b-10">
                                            <a href="{{ route('bookings.index', $table->id) }}" class="btn btn-custon-four btn-primary">Book Now</a> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                
            </div>
        </div>
    </div>
</div>
@else
<div class="all-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list">
                    <div class="sparkline12-hd">
                        <div class="main-sparkline12-hd">
                            <h1>All Form Element</h1>
                        </div>
                    </div>
                    <div class="sparkline12-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="all-form-element-inner">
                                        <form action="{{ route('hotelViews.storeTable') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Table size</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <input type="number" name="table_size" class="form-control" required />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Table Type</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <select name="table_type" class="form-control" required>
                                                            <option value="" disabled selected>Select Table Type</option>
                                                            <option value="Round">Round</option>
                                                            <option value="Square">Square</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Table Amount</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <input type="number" name="table_amount" class="form-control" required />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Table image</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <input type="file" name="table_image" class="form-control" required />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group-inner">
                                                <div class="login-btn-inner">
                                                    <div class="row">
                                                        <div class="col-lg-3"></div>
                                                        <div class="col-lg-9">
                                                            <div class="login-horizental cancel-wp pull-left form-bc-ele">
                                                                <button class="btn btn-white" type="submit">Cancel</button>
                                                                <button class="btn btn-sm btn-primary login-submit-cs" type="submit">Save Change</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endrole

@endsection

