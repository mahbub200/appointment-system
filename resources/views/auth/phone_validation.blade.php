@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            @if (Session::has('message'))
                <div class="alert bg-danger alert-success text-white" role="alert">
                    {{ Session::get('message') }}
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert bg-success alert-success text-white" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
                <div class="card-header">{{ __('Phone validation code') }}</div>
                @if (!Session::has('success'))
                <div class="card-body">
                    <form method="POST" action="{{ route('phoneUpdate') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="Phone" class="col-md-4 col-form-label text-md-end">{{ __('Enter your code') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="tel" class="form-control @error('email') is-invalid @enderror" name="phone" value="<?php echo Session::get('phone') ?>" hidden>
                                <input id="valid_code" type="tel" class="form-control @error('email') is-invalid @enderror" name="valid_code" value="<?php echo Session::get('code') ?>" hidden>
                                <input id="code" type="number" class="form-control @error('email') is-invalid @enderror" name="code" value="" required  autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
