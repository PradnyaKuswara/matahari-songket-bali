@extends('layouts.dashboard')

@section('page-title')
    {{ $transaction->generate_id }}
@endsection

@push('css')
    <style>
        @media print {

            .no-print,
            .no-print * {
                display: none !important;
                margin: 0px;
                padding: 0px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="no-print">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Dashboard</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Transaction</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Invoice</span>
            </li>
        </ul>
    </div>
    <div class="flex gap-2 items-center justify-end print:hidden mt-4">
        <a href="javascript:window.print()" class="btn bg-primary text-white"><span class="mdi mdi-printer-outline"></span>
            Print</a>
    </div>
    <div class="mt-4  mx-auto max-w-screen-md">
        <x-invoice :order="$transaction->order"></x-invoice>
    </div>
@endsection
