@extends('layouts.app')
@section('content')

<div class="all-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list">
                    <div class="sparkline12-hd">
                        <div class="main-sparkline12-hd">
                            <h1>Venue Elements</h1>
                        </div>
                    </div>
                    <div class="sparkline12-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="all-form-element-inner">
                                        <form action="{{ route('hotelViews.storeVenue') }}" method="post" enctype="multipart/form-data" >
                                            @csrf
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Venue name</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <input type="text" name="venue_name" class="form-control" required />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Capacity</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <input type="number" name="venue_capacity" class="form-control" required />
                                                    </div>
                                                </div>
                                            </div>
                                            

                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Amount</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <input type="number" name="venue_amount" class="form-control" required />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group-inner">
                                                
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <label class="login2 pull-right pull-right-pro">Additional Notes</label>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                    <textarea name="additional_notes" class="form-control" rows="4" required></textarea>
                                                </div>
                                            </div>
                                        </div>


                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Venue image</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <input type="file" name="venue_image" class="form-control" required />
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
                                                                <button class="btn btn-sm btn-primary login-submit-cs" type="submit">Save</button>
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
@endsection
