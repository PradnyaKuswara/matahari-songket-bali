@extends('layouts.dashboard')

@section('page-title')
    {{ $shipping->order->generate_id }}
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
                <a href="javascript:;" class="text-primary hover:underline">Customer</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Shipping</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Detail</span>
            </li>
        </ul>
    </div>
    <div>
        <div class="flex flex-col md:flex-row md:justify-between gap-4">
            <h2 class="text-xl font-semibold mt-4">Shipping Detail</h2>
        </div>

        <div class="grid grid-cols-1 gap-4 mt-4">
            <div class="card">
                <div class="card-body bg-white">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-lg font-semibold">Order ID: {{ $shipping->order->generate_id }}</p>
                            @if ($shipping->status == 'cancel')
                                <div class="badge badge-error badge-outline">Cancel</div>
                            @endif
                            @if ($shipping->status == 'pending')
                                <div class="badge badge-warning badge-outline">Pending</div>
                            @endif
                            @if ($shipping->status == 'packing')
                                <div class="badge badge-accent badge-outline">Packing</div>
                            @endif
                            @if ($shipping->status == 'shipping')
                                <div class="badge badge-primary badge-outline">Shipping</div>
                            @endif

                            @if ($shipping->status == 'delivered')
                                <div class="badge badge-success badge-outline">Delivered</div>
                            @endif
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Courier: {{ $shipping->courier ?? '-' }}</p>
                            <p class="text-gray-500 text-sm">Number: {{ $shipping->tracking_number ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-gray-500 text-sm">Shipped at:
                            {{ $shipping->shipped_at ? $shipping->shipped_at->format('d F Y') : '-' }}</p>
                        <p class="text-gray-500 text-sm">Estimate Delivered at:
                            {{ $shipping->delivered_at ? $shipping->delivered_at->format('d F Y') : '-' }}</p>
                        <p class="text-gray-500 text-sm">Max Confirmation:
                            {{ $shipping->max_confirm ? $shipping->max_confirm->format('d F Y') : '-' }}</p>
                    </div>
                    <div class="mt-4">
                        <p class="text-gray-500 text-sm">Address:</p>
                        <p class="text-gray-800 font-bold text-sm">{{ $shipping->address }}</p>
                        <p class="text-gray-800 font-bold text-sm">{{ $shipping->city }},
                            {{ $shipping->province }}</p>
                        <p class="text-gray-800 font-bold text-sm">{{ $shipping->city }},
                            {{ $shipping->country }}</p>
                        <p class="text-gray-800 font-bold text-sm">{{ $shipping->postal_code }}</p>
                    </div>
                    <div class="mt-4">
                        <p class="text-gray-500 text-sm">Receiver:</p>
                        <p class="text-gray-800 font-bold text-sm">{{ $shipping->user->name }}</p>
                        <p class="text-gray-800 font-bold text-sm">{{ $shipping->user->phone_number }}</p>
                    </div>
                    <div class="mt-4">
                        {{-- product list --}}
                        <p class="text-gray-500 font-bold text-base">Product List:</p>
                        <div class="grid grid-cols-1 gap-4">
                            @foreach ($shipping->order->products as $item)
                                <div class="card">
                                    <div class="card-body bg-white">
                                        <div class="flex flex-col md:flex-row md:justify-between gap-4">
                                            <div class="flex gap-4 items-center">
                                                <div class="flex-col">
                                                    <img src="{{ $item->image1() }}" alt="{{ $item->name }}"
                                                        class="w-20 h-20 object-cover rounded-lg">
                                                </div>
                                                <div class="flex-col">
                                                    <p class="text-lg font-semibold">{{ $item->name }}</p>
                                                    <p class="text-gray-500 text-sm">Qty: {{ $item->pivot->quantity }}
                                                    </p>
                                                </div>

                                            </div>
                                            <div>
                                                <p class="text-gray-800 font-bold text-base">Price: Rp
                                                    {{ number_format($item->pivot->price, 2, ',', '.') }}</p>
                                                <p class="text-gray-800 font-bold text-base">Subtotal: Rp
                                                    {{ number_format($item->pivot->total_price, 2, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="flex gap-2 items-center justify-end print:hidden mt-4">
        <a href="javascript:window.print()" class="btn bg-primary text-white"><span class="mdi mdi-printer-outline"></span>
            Print</a>
    </div>
    <div class="mt-4  mx-auto max-w-screen-md">
        <x-shipping :shipping="$shipping"></x-shipping>
    </div> --}}
@endsection
