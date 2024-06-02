@extends('layouts.app')

@section('page-title')
    Checkout | Matahari Songket Bali
@endsection

@push('css')
    <style>
        input[type='number']::-webkit-inner-spin-button,
        input[type='number']::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .custom-number-input input:focus {
            outline: none !important;
        }

        .custom-number-input button:focus {
            outline: none !important;
        }
    </style>
@endpush

@section('content')
    <div style="display: none;" id="loading-checkout"
        class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-[100] overflow-hidden bg-gray-800 opacity-75 flex flex-col items-center justify-center">
        <div class="loading loading-dots w-12 rounded-full text-white h-12 mb-4"></div>
        <h2 class="text-center text-white text-xl font-semibold">Loading...</h2>
        <p class="w-1/3 text-center text-white">This may take a few seconds, please don't close this page.</p>
    </div>
    <section
        class="min-h-screen xl:max-w-screen-xl lg:max-w-screen-lg lg:mx-auto pt-28 py-14 md:px-14 lg:px-0 lg:pt-28 mx-4 md:mx-0">
        <div x-data="{ intersect: false }" x-intersect:enter="intersect=true" x-intersect:leave="intersect=false"
            class="flex flex-col md:flex-row px-4 lg:px-0">
            <h1 class="text-4xl font-bold " :class="intersect ? 'animate-fade-right' : 'opacity-0'">Checkout Product</h1>
        </div>

        @if (!auth()->user()->hasVerifiedEmail())
            <div role="alert" class="alert alert-primary mb-4 mt-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="stroke-current shrink-0 w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Please verify you account. We’ve sent you a verification link to
                    the email address <span class="font-medium text-indigo-500">{{ auth()->user()->email }}</span> or click
                    beside
                    button to
                    resend email verification</span>
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit"
                        class="btn btn-sm btn-primary w-50 rounded px-5 font-medium text-white shadow-md shadow-indigo-500/20">Resend
                        Verification Email</button>
                </form>
            </div>
        @endif

        <div class="grid lg:grid-cols-6 gap-8 mt-8">
            <div class="md:col-span-3 lg:col-span-4">
                <div class="flex flex-col gap-4 mt-4">
                    <div class="flex flex-col border rounded-sm shadow-md w-full p-8 gap-4 ">
                        @if ($user->addresses->count() <= 0)
                            <div role="alert" class="alert alert-primary mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    class="stroke-current shrink-0 w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Please fill in the details of your account address completely at the following link.
                                    or click
                                    beside
                                    button</span>
                                @php
                                    session()->put('link-direct-checkout', 'checkout');
                                @endphp
                                <x-button-link class="btn btn-primary" :link="route('customer.dashboard.address.index')">Add your address</x-button-link>
                            </div>
                        @else
                            <div role="alert" class="alert alert-primary mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    class="stroke-current shrink-0 w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>If you want change your address, please follow link or click beside button</span>
                                @php
                                    session()->put('link-direct-checkout', 'checkout');
                                @endphp
                                <x-button-link class="btn btn-primary" :link="route('customer.dashboard.address.index')">Change your address</x-button-link>
                            </div>
                        @endif

                        <h2 class="font-extrabold text-3xl">Book Information - <span class="font-bold text-xl">Your
                                detail</span> </h2>
                        <div class="grid md:grid-cols-3 gap-4">
                            <label class="form-control w-full ">
                                <div class="label">
                                    <span class="label-text">Name</span>
                                </div>
                                <p class="mx-2 font-bold text-sm">{{ $user->name }}</p>

                            </label>

                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">User Name</span>
                                </div>
                                <p class="mx-2 font-bold text-sm">{{ $user->username }}</p>
                            </label>

                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Phone Number</span>
                                </div>
                                @if ($user->phone_number == null)
                                    @php
                                        session()->put('link-direct-checkout', 'checkout');
                                    @endphp
                                    <x-button-link class="btn btn-primary" :link="route('customer.dashboard.profile.edit')">Add
                                        your phone number</x-button-link>
                                @else
                                    <div class="flex gap-2 items-center">
                                        <p class="mx-2 font-bold text-sm font-sans">{{ $user->phone_number ?? '-' }}</p>
                                        @php
                                            session()->put('link-direct-checkout', 'checkout');
                                        @endphp
                                        <a href="{{ route('customer.dashboard.profile.edit') }}"
                                            class="text-xs text-primary underline">Edit phone number</a>
                                    </div>
                                @endif
                            </label>
                        </div>

                        @if ($user->addresses->count() > 0)
                            <label class="form-control w-full ">
                                <div class="label">
                                    <span class="label-text">Address</span>
                                </div>
                                <p class="mx-2 font-bold text-sm">{{ $user->addresses->first()->address }}</p>
                            </label>

                            <div class="grid md:grid-cols-4 gap-4">
                                <label class="form-control w-full ">
                                    <div class="label">
                                        <span class="label-text">Country</span>
                                    </div>
                                    <p class="mx-2 font-bold text-sm">{{ $user->addresses->first()->country }}</p>
                                </label>
                                <label class="form-control w-full ">
                                    <div class="label">
                                        <span class="label-text">Province</span>
                                    </div>
                                    <p class="mx-2 font-bold text-sm">{{ $user->addresses->first()->province }}</p>
                                </label>

                                <label class="form-control w-full ">
                                    <div class="label">
                                        <span class="label-text">City</span>
                                    </div>
                                    <p class="mx-2 font-bold text-sm">{{ $user->addresses->first()->city }}</p>
                                </label>

                                <label class="form-control w-full ">
                                    <div class="label">
                                        <span class="label-text">Post Code</span>
                                    </div>
                                    <p class="mx-2 font-bold text-sm font-sans">
                                        {{ $user->addresses->first()->postal_code }}
                                    </p>
                            </div>

                            <label class="form-control w-full ">
                                <div class="label">
                                    <span class="label-text">Additional Information</span>
                                </div>
                                <p class="mx-2 font-bold text-sm">
                                    {{ $user->addresses->first()->additional_information }}</p>
                            </label>
                        @else
                            <label class="form-control w-full ">
                                <div class="label">
                                    <span class="label-text">Address</span>
                                </div>
                                <p class="mx-2 font-bold text-sm">-</p>
                            </label>

                            <div class="grid grid-cols-3 gap-4">
                                <label class="form-control w-full ">
                                    <div class="label">
                                        <span class="label-text">Province</span>
                                    </div>
                                    <p class="mx-2 font-bold text-sm">-</p>
                                </label>

                                <label class="form-control w-full ">
                                    <div class="label">
                                        <span class="label-text">Regency</span>
                                    </div>
                                    <p class="mx-2 font-bold text-sm">-</p>
                                </label>

                                <label class="form-control w-full ">
                                    <div class="label">
                                        <span class="label-text">Post Code</span>
                                    </div>
                                    <p class="mx-2 font-bold text-sm">-</p>
                                </label>
                            </div>

                            <label class="form-control w-full ">
                                <div class="label">
                                    <span class="label-text">Additional Information</span>
                                </div>
                                <p class="mx-2 font-bold text-sm">-</p>
                            </label>
                        @endif
                    </div>

                    <div class="flex flex-col border rounded-sm  w-full p-8 gap-4 shadow-md">
                        <h2 class="font-extrabold text-xl">Account Information</h2>
                        <div class="flex flex-col">
                            <p>Name: <span class="font-bold">{{ $user->name }}</span></p>
                            <p>Email: <span class="font-bold">{{ $user->email }}</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:col-span-3 lg:col-span-2  ">
                <div class="flex flex-col gap-4 mt-4">
                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf
                        <input type="text" class="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="flex flex-col border rounded-md border-primary  text-primary w-full p-8 gap-4 ">
                            <h2 class="font-extrabold text-3xl">Order Summary</h2>
                            <div class="max-h-[15rem] overflow-auto ">
                                @forelse ($user->carts as $cart)
                                    <x-order-summary :cart="$cart"></x-order-summary>
                                @empty
                                    <div class="flex justify-center items-center h-32">
                                        <h1 class="text-lg">No item in cart</h1>
                                    </div>
                                @endforelse
                            </div>

                            @php
                                $item = $user->carts->sum(function ($cart) {
                                    return $cart->sell_price * $cart->pivot->quantity;
                                });

                                $quantity = $user->carts->sum(function ($cart) {
                                    return $cart->pivot->quantity;
                                });

                                $shipping = $quantity * 10000;

                                $total = $item + $shipping;

                                $tax = $item * 0.05;

                                $totalAll = $total + $tax;
                            @endphp
                            <div class="flex-col border-b pb-4">
                                <div class="flex justify-between items-center">
                                    <h1>Items ({{ $quantity }}) : </h1>
                                    <h1 class="font-sans">Rp. {{ number_format($item, 2, ',', '.') }}</h1>
                                    <input type="text" class="hidden" name="item_total_price"
                                        value="{{ $item }}">
                                    <input type="text" class="hidden" name="quantity" value="{{ $quantity }}">
                                </div>
                                <div class="flex justify-between items-center mt-4">
                                    <h1>Shipping : </h1>
                                    <h1 class="font-sans">Rp. {{ number_format($shipping, 2, ',', '.') }}</h1>
                                    <input type="text" class="hidden" name="shipping_price"
                                        value="{{ $shipping }}">
                                </div>
                                <div class="flex justify-between items-center mt-4">
                                    <h1>Subtotal : </h1>
                                    <h1 class="font-sans">Rp. {{ number_format($total, 2, ',', '.') }}</h1>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <h1>PPN : </h1>
                                <h1 class="font-sans">Rp. {{ number_format($tax, 2, ',', '.') }}</h1>
                                <input type="text" class="hidden" name="tax" value="{{ $tax }}">
                            </div>
                            <div class="text-4xl font-sans">
                                <h1>Rp. {{ number_format($totalAll, 2, ',', '.') }}</h1>
                                <input type="text" class="hidden" name="total_price" value="{{ $totalAll }}">
                            </div>
                            <div class="flex flex-col gap-4 mt-8">
                                @if ($user->carts->count() > 0 && $user->addresses->count() > 0 && $user->phone_number != null)
                                    <button type="submit" id="checkout" class="btn btn-accent w-full"><span
                                            class="mdi mdi-dots-hexagon text-xl"></span>Checkout Product</button>
                                    <x-button-link class="btn btn-neutral  w-full" :link="route('carts.indexFront')"><span
                                            class="mdi mdi-cart-outline text-xl"></span>Change
                                        Product Cart</x-button-link>
                                @else
                                    <x-button-link class="btn btn-neutral  w-full" :link="route('products.indexFront')">Explore
                                        Product</x-button-link>
                                    <div class="">
                                        <p class="text-red-500 text-xs">* Make sure choose your product on cart</p>
                                        <p class="text-red-500 text-xs">* Please complete your profile address to
                                            checkout</p>
                                        <p class="text-red-500 text-xs">* Please complete your profile phone number to
                                            checkout</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const loader = document.getElementById('loading-checkout');
        const checkout = document.getElementById('checkout');

        checkout.addEventListener('click', function() {
            loader.style.display = 'flex';
        });
    </script>
@endpush
