@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-6">
            <img src="banner/banner.jpg" class="img-fluid" alt="image not found">
        </div>
        <div class="col-md-6">
            <h2>Create an account & book your appointment</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, repellat! Accusamus quisquam illum facere possimus, sequi dicta eveniet reprehenderit nostrum eaque voluptas iusto, earum iste obcaecati sapiente dolores modi rem.</p>
        <div class="mt-5">
        <a href="{{ url('/register') }}"> <button class="btn btn-primary">Register as Patient</button></a>
                        <a href="{{ url('/login') }}"><button class="btn btn-success">Login</button></a>
        </div>
        </div>
    </div>
    <hr/>
    
    <!-- DATE PICKER COMPONENT -->
    <find-doctor></find-doctor> 
</div>
@endsection
