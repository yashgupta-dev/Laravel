@extends('layouts.my')
 @section('content')
<div class="page-content">
    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow">
                <nav aria-label="breadcrumb">
					<ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                      <li class="breadcrumb-item"><a href="{{ route('home.address')}}">All Address</a></li>
					  <li class="breadcrumb-item active" aria-current="page">ADD Address</li>
					</ol>
                  </nav>
                  
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="offset-md-3 col-md-6">
                                <form class="address-form" method="POST" action="{{ route('home.address_add')}}">
                                        <div class="form-group">
                                            <label for="address_line">Address Line <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" required name="address_line" maxlength="70" placeholder="Floor, Flat, House No.">
                                            <div class="text-danger small font-weight-bold" id="address_line"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="address_line_two">Address Line 2 </label>
                                            <input type="text" class="form-control" name="address_line_two" maxlength="70" required placeholder="Area, Locality">
                                            <div class="text-danger small font-weight-bold" id="address_line_two"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="country">Country <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="country" maxlength="70" required placeholder="Country">
                                            <div class="text-danger small font-weight-bold" id="country"></div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <label for="state">State <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" required name="state" maxlength="20" placeholder="State">
                                                <div class="text-danger small font-weight-bold" id="state"></div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="city">City <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" required name="city" maxlength="20" placeholder="city"> 
                                                <div class="text-danger small font-weight-bold" id="city"></div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="pin">Postal Code <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" required name="postal_code" maxlength="20" placeholder="Postal Code"> 
                                                <div class="text-danger small font-weight-bold" id="postal_code"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="mark">Land Mark </label>
                                            <input type="text" class="form-control" required name="mark" maxlength="50" placeholder="Near by of your address">
                                            <div class="text-danger small font-weight-bold" id="mark"></div>
                                        </div>
                                        @csrf
                                        
                                        <div class="form-group mt-3">
                                            <button class="btn btn-info" id="address-btn" type="button">Save</button>
                                        </div>
                                        
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                        <!--card body end -->
                    </div>
                    <!--card end -->
                </div>
                <!--col-12 end -->
            </div>
            <!-- row end -->
        </div>
        <!--col-12 end -->
    </div>
    <!-- row end -->
</div>
@include('layouts.footer')
@endsection