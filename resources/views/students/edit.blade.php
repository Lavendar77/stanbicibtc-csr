@extends('layouts.student')

@section('student-content')
<x-student-form action="patch" :user="$student" />
@endsection
