@extends('layouts.dashboard')

@section('title')
    {{ $order->generate_id }}
@endsection

@section('content')
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Customer</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Order</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Detail</span>
            </li>
        </ul>

        <div class="panel mt-4">
            <div class="panel-body">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-lg font-semibold">Order Information</h3>
                        <div class="mt-4">
                            <div class="flex justify-between">
                                <span>Order ID</span>
                                <span>{{ $order->generate_id }}</span>
                            </div>
                            <div class="flex justify-between mt-2">
                                <span>Order Date</span>
                                <span>{{ $order->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between mt-2">
                                <span>Order Status</span>
                                @if ($order->status == false)
                                    <div class="badge badge-warning badge-outline">Not Accepted</div>
                                @endif

                                @if ($order->status == true)
                                    <div class="badge badge-success badge-outline">Accepted</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold">Shipping Information</h3>
                        <div class="mt-4">
                            <div class="flex justify-between mt-2">
                                <span>Shipping Date</span>
                                <span>{{ $order->shipping->shipped_at ? $order->shipping->shipped_at->format('d M Y') : 'Not delivered' }}</span>
                            </div>
                            <div class="flex justify-between mt-2">
                                <span>Shipping Status</span>
                                @if ($order->shipping->status == 'cancel')
                                    <div class="badge badge-error badge-outline">Cancel</div>
                                @endif
                                @if ($order->shipping->status == 'pending')
                                    <div class="badge badge-warning badge-outline">Pending</div>
                                @endif
                                @if ($order->shipping->status == 'packing')
                                    <div class="badge badge-accent badge-outline">Packing</div>
                                @endif
                                @if ($order->shipping->status == 'shipping')
                                    <div class="badge badge-primary badge-outline">Shipping</div>
                                @endif

                                @if ($order->shipping->status == 'delivered')
                                    <div class="badge badge-success badge-outline">Delivered</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="panel mt-4">
            <div>
                <h3 class="text-lg font-semibold">Product Information</h3>
                <div class="mt-4">
                    {{-- product list --}}
                    <div class="grid grid-cols-1 gap-4">
                        @foreach ($order->products as $item)
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
@endsection
