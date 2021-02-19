@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Update Profile</div>

                <div class="card-body">
                    <x-alert />

                    <x-user-profile :user="Auth::user()" />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
