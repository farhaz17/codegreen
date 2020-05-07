@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User details</div>

                <div class="card-body">
                <form method="POST" action="{{ route('edit') }}">
                    @csrf
                    <input id="id" type="hidden" value="{{Auth::user()->id}}" name="user_id">
                    <button type="submit" class="btn btn-primary float-right">Edit</button>
                </form>
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
