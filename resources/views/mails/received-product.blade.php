@extends('layouts.mail')

@section('title')
    Confirmation Order Shipped
@endsection

@section('content')


    <div class="w-full">
        <x-shipping-confirm :shipping="$content"></x-shipping-confirm>
    </div>
@endsection
