@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">Hello, world!</h1>
            <p class="lead">{{ config('app.name') }} allows you to apply to scholarship programs.</p>

            <hr class="my-4">

            @php
                $user = Auth::user();
            @endphp

            <a class="btn btn-primary btn-lg" href="{{ $user ? route('home') : route('login') }}" role="button">
                {{ $user ? 'Go to Dashboard' : 'Sign In to your Account' }}
            </a>
        </div>
    </div>
@endsection
