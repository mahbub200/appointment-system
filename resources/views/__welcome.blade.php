@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-6">
            <img src="banner/banner.jpg" class="img-fluid" alt="image not found" height="200px">
        </div>
        <div class="col-md-6">
            <h2>Create an account & book your appointment</h2>
            <p>It is a doctor appointment booking online web application, Now-a-days getting
 appointment is such a hard task, to get effective solution and hassle-free booking
experience So book your appointment with the desired doctor. </p>
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
