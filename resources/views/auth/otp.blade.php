@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verification') }}</div>

                <div class="card-body">
                <div class="card-body">
                @if(Session::has('message'))
                <div class="alert alert-danger">
                    {{ Session::get('message') }}
                    @php
                        Session::forget('message');
                    @endphp
                </div>
                @endif
                    <form method="POST" action="{{ route('verify') }}">
                        @csrf

                        <input id="otp" type="hidden" value={{ $user_id }} name="user_id">

                        <div class="form-group row">

                            <label for="otp" class="col-md-4 col-form-label text-md-right">{{ __('OTP') }}</label>

                            <div class="col-md-6">
                                <input id="otp" type="number" class="form-control @error('otp') is-invalid @enderror" name="otp">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
