@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="banner/banner.jpg" class="img-fluid" alt="image not found">
        </div>
        @if(!Auth::user())
        <div class="col-md-6 mt-5">
            <h2>Create an account & book your appointment</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, repellat! Accusamus quisquam illum facere possimus, sequi dicta eveniet reprehenderit nostrum eaque voluptas iusto, earum iste obcaecati sapiente dolores modi rem.</p>
        <div class="mt-4">
                <a href="{{ url('/register') }}"> <button class="btn btn-primary" style="margin-right: 10px;">Register as Patient</button></a>

                <a href="{{ url('/login') }}"><button class="btn btn-success">Login</button></a>
        </div>
        @endif
        @if(Auth::user())
        <div class="col-md-6 mt-5">
            <h2>welcome to the bindaaas house</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, repellat! Accusamus quisquam illum facere possimus, sequi dicta eveniet reprehenderit nostrum eaque voluptas iusto, earum iste obcaecati sapiente dolores modi rem.</p>
        </div>
        @endif
        </div>
    </div>
    <hr/>
      <!-- search doctor -->
    <form action="{{ url('/') }}"method="GET">
            <div class="card mb-4 mt-4">

  
                <div class="card-body">
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
        <div class="card">
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
