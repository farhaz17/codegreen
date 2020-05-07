@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User details</div>

                <div class="card-body">
                    <a class="btn btn-primary float-right" href="edit/{{Auth::user()->id}}">
                        {{ __('Edit') }}
                    </a> <br>
                    Username: {{Auth::user()->username}} <br>
                    Email: {{$details->email}} <br>
                    Date Of Birth: {{$details->dob}} <br>
                    City: {{$details->city}} <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
