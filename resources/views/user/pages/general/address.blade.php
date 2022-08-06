@extends('layouts.my')

    @section('content')


	<div class="page-content">
		<div class="row">
			
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">All Address</li>
				</ol>
			</nav>

			
			<div class="col-12 mt-4 col-xl-12 stretch-card">
			  <div class="row flex-grow">
				{!!$data!!}
			  </div>
			</div>
		  </div> <!-- row -->
		<div class="row">
			
		</div>
	</div>
	@include('layouts.footer')
  @endsection