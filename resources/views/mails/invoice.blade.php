@extends('layouts.mail')

@section('title')
    Invoice
@endsection

@section('content')
    <div class="hero p-20 md:p-32" style="background-image: url({{ asset('assets/images/hero2.jpg') }});">
        <div class="hero-overlay bg-opacity-60"></div>
    </div>

    <!-- start main content section -->
    <div class="w-full">
        <x-invoice :order="$content"></x-invoice>
    </div>
    <!-- end main content section -->
@endsection
