@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Students</div>

                <div class="card-body">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('students.index') }}">List</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('students.create') }}">New</a>
                            </li>
                        </ol>
                    </nav>

                    <x-alert />

                    @yield('student-content')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
