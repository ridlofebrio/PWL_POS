@extends('Layout\app')

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome to the Laravel AdminLTE Starter Kit')

@section('content_body')
<p>Welcome to this beautiful admin panek</p>  
@stop

@push('css')

@endpush

@push('js')
<script>console.log("Hi, Im using the Laravel AdminLTE package!");</script>