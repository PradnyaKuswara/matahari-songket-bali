@extends('layouts.dashboard')

@section('title')
    Transaction Invoice | Matahari Songket Bali
@endsection

@push('css')
    <style>
        @media print {

            .no-print,
            .no-print * {
                display: none !important;
            }

            body {
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
@endpush

@section('content')
    <x-dashboard.page-title subtitle="Page" title="Invoice"></x-dashboard.page-title>

    <x-invoice></x-invoice>
@endsection
