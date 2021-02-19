@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <x-alert />

                    <h4 class="text-primary mb-0">
                        Welcome back, {{ Auth::user()->fullName }}
                    </h4>

                    @php
                        $user = Auth::user();
                    @endphp

                    @can('apply to programs')
                        <div class="border-top mt-3">
                            <h2 class="text-center text-underline font-weight-bold py-3">Your Programs</h2>

                            @forelse ($user->programs as $program)
                                <div class="col col-lg-4 col-md-4 col-sm-6 p-0">
                                    <div class="card shadow border-0">
                                        <img src="{{ $program->photo }}" class="card-img-top" alt="image">

                                        <div class="card-body">
                                            <h5 class="card-title">{{ $program->name }}</h5>
                                            <p class="card-text">{{ $program->description }}</p>
                                            <p class="card-text">Last updated {{ $program->updated_at->diffForHumans() }}</p>
                                        </div>

                                        <div class="card-footer">
                                            @if (!$program->pivot->applied)
                                                <form
                                                    action="{{ route('program-apply', [
                                                        'program' => $program->id
                                                    ]) }}"
                                                    method="post"
                                                >
                                                    @csrf

                                                    <input type="submit" value="Apply" class="btn btn-sm btn-success">
                                                </form>
                                            @else
                                                <span class="text-success font-weight-bold">Applied!</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-info">None yet!</div>
                            @endforelse
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
