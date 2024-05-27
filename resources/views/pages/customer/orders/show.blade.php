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

        <div class="panel">
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
                    @foreach ($order->products as $product)
                        <div class="flex justify-between">
                            <span>Product Name</span>
                            <span>{{ $product->name }}</span>
                        </div>
                        <div class="flex justify-between mt-2">
                            <span>Product Price</span>
                            <span>Rp. {{ number_format($product->pivot->price, 2, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between mt-2">
                            <span>Product Quantity</span>
                            <span>{{ $product->pivot->quantity }}</span>
                        </div>
                        <div class="flex justify-between mt-2">
                            <span>Product Total Price</span>
                            <span>Rp. {{ number_format($product->pivot->total_price, 2, ',', '.') }}</span>
                        </div>

                        @if ($loop->count > 1)
                            <div class="border-t border-black my-4 "></div>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
