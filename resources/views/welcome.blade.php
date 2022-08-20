@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="banner/banner.jpg" class="" alt="image not found" height="400px" width="600px">
        </div>
        @if(!Auth::user())
        <div class="col-md-6 mt-5">
            <h2>Create an account & book your appointment</h2>
            <p>It is a doctor appointment booking online web application, Now-a-days getting
 appointment is such a hard task, to get effective solution and hassle-free booking
experience So book your appointment with the desired doctor. </p>
        <div class="mt-4">
                <a href="{{ url('/register') }}"> <button class="btn btn-primary" style="margin-right: 10px;">Register as Patient</button></a>

                <a href="{{ url('/login') }}"><button class="btn btn-success">Login</button></a>
        </div>
        @endif
        @if(Auth::user())
        <div class="col-md-6 mt-5 ">
            <h2>Welcome to the doctor appointment system</h2>
            <p>It is a doctor appointment booking online web application, Now-a-days getting
 appointment is such a hard task, to get effective solution and hassle-free booking
experience So book your appointment with the desired doctor. </p>
        </div>
        @endif
        </div>
    </div>
    <hr/>
      <!-- search doctor -->
    <form action="{{ url('/') }}"method="GET">
            <div class="card mb-4 mt-4 container">

  
                <div class="card-body ">
                    <div class="card-header">Find Doctors</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-8">
                                <input type="text" name='date' id="datepicker" class='form-control'>
                            </div>
                            <div class="col-md-6 col-sm-4">
                                <button class="btn btn-primary" type="submit">Go</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
            <!-- display doctor  -->
        <div class="card container">
            <div class="card-body">
                <div class="card-header">List of Doctors Available
                </div>
            <div class="card-body table-responsive-sm">
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Expertise</th>
                                <th>Book</th>
                            </tr>
                        </thead>
                    <tbody>
                        @forelse ($doctors as $doctor)

                                <tr>
                                    <th scope ='row'> 1</th>
                                    <td><img src="{{ asset('images') }}/{{ $doctor->doctor->image }}" alt="no image found" width ="80px" height ="80px" style="border-radius:50%;" >
                                </td>

                                <td>{{ $doctor->doctor->name }}</td>

                                <td>{{ $doctor->doctor->department }}</td>

                                <td>
                                    <a href="{{ route('create.appointment', [$doctor->user_id, $doctor->date]) }}">
                                    <button class="btn btn-primary mt-3">Appointment</button></a>
                                </td>
                                </tr>
                                @empty
                                <td>No doctors available</td>
                         @endforelse
                    </tbody>
                </table>
            </div>
            </div>

        </div>
</div>
@endsection
