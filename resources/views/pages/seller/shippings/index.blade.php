@extends('layouts.dashboard')

@section('title')
    Shipping
@endsection

@section('content')
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Customer</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Shipping</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Index</span>
            </li>
        </ul>

        <div>
            <h2 class="text-xl font-semibold mt-4">All Shipping</h2>
            <div class="grid mx-auto lg:grid-cols-4 gap-4 mt-4" id="order-list">
                @forelse ($shippings as $shipping)
                    <x-dashboard.shipping :shipping="$shipping" :loop="$loop->iteration"></x-dashboard.shipping>
                @empty
                    <div class="card col-span-4">
                        <div class="card-body bg-white">
                            <div class="text-center">
                                <p class="text-lg">There is no shippings</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="mt-5">
                {{ $shippings->links('components.dashboard.pagination') }}
            </div>
        </div>
    </div>
@endsection
