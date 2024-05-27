@extends('layouts.mail')

@section('title')
    Shipped
@endsection

@section('content')
    <div class="w-full">
        <x-shipping :shipping="$content"></x-shipping>
    </div>
@endsection
