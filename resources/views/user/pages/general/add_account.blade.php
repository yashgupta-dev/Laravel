@extends('layouts.my')
 @section('content')
<div class="page-content">
    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow">
                <nav aria-label="breadcrumb">
					<ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                      <li class="breadcrumb-item"><a href="{{ route('home.accounts')}}">All Accounts</a></li>
					  <li class="breadcrumb-item active" aria-current="page">ADD Accounts</li>
					</ol>
                  </nav>
                  
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="offset-md-2 col-md-8">
                                <form class="account-form" method="POST" action="{{ route('home.account_add')}}">
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label for="select_bank">Select Your Bank <span class="text-danger">*</span></label>
                                                <div id="the-basics">
                                                    <input class="typeahead form-control" autocomplete="off" name="bank_name" type="text" placeholder="Type Bank Name">
                                                </div>
                                                <div class="text-danger small font-weight-bold" id="bank_name"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Branch Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" required name="branch" maxlength="50">
                                                    <div class="text-danger small font-weight-bold" id="branch"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">A/C Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" required name="account_name" maxlength="70">
                                            <div class="text-danger small font-weight-bold" id="account_name"></div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <label for="name">A/C No. <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" required name="account_no" maxlength="20">
                                                <div class="text-danger small font-weight-bold" id="account_no"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="name">Confirm A/C No. <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" required name="confirm_account" maxlength="20">
                                            </div>
                                        </div>
                                        @csrf
                                        
                                        <div class="form-group">
                                            <label for="name">IFSC Code <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" required name="ifsc" maxlength="11">
                                            <div class="text-danger small font-weight-bold" id="ifsc"></div>
                                        </div>
                                        <button class="btn btn-info" id="account-btn" type="button">Save</button>
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