@extends('layouts.student')

@section('student-content')
<x-student-form action="post" :user="null" />
@endsection
