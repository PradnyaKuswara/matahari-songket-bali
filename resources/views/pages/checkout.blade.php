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
        <p class="lg:w-1/3 w-2/3 text-center text-white">This may take a few seconds, please don't close this page.</p>
    </div>


    @if ($errors->any())
        <div class="alert alert-error">
            <div class="flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="w-6 h-6 mx-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z">
                    </path>
                </svg>
                <label>{{ $errors->first() }}</label>
            </div>
        </div>
    @endif

    @if ($user->addresses->count() <= 0)
        <div
            class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-[100] overflow-hidden bg-gray-800 opacity-75 flex flex-col items-center justify-center">
            <h2 class="text-center text-white text-xl font-semibold">You don't have a shipping address yet, please add a new
                address</h2>
            @php
                session()->put('link-direct-checkout', 'checkout');
            @endphp
            <div class="flex gap-4 mt-4">
                <x-button-link class="btn btn-danger" :link="route('carts.indexFront')">Cancel</x-button-link>
                <x-button-link class="btn btn-primary " :link="route('customer.dashboard.address.index')">Add Address</x-button-link>

            </div>
        </div>
    @endif
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
                    <div class="flex flex-col border border-primary shadow-md rounded-sm w-full p-8 gap-4 ">
                        @if ($user->addresses->count() > 0)
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

                        <h2 class="font-extrabold text-2xl lg:text-3xl">Book Information - <span
                                class="font-bold text-xl">Your
                                detail</span> </h2>
                        <div class="grid md:grid-cols-3 gap-4">
                            <label class="form-control w-full ">
                                <div class="label">
                                    <span class="label-text">Name</span>
                                </div>
                                <p class="mx-2 font-bold text-base lg:text-sm">{{ $user->name }}</p>

                            </label>

                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">User Name</span>
                                </div>
                                <p class="mx-2 font-bold text-base lg:text-sm">{{ $user->username }}</p>
                            </label>

                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Phone Number</span>
                                </div>
                                @if ($user->addresses->count() > 0)
                                    <p class="mx-2 font-bold text-base lg:text-sm font-sans">
                                        {{ $user->addresses->first()->phone_number }}</p>
                                @else
                                    <p class="mx-2 font-bold text-base lg:text-sm font-sans">
                                        -</p>
                                @endif
                            </label>
                        </div>

                        @if ($user->addresses->count() > 0)
                            <label class="form-control w-full ">
                                <div class="label">
                                    <span class="label-text">Address</span>
                                </div>
                                <p class="mx-2 font-bold text-base lg:text-sm">{{ $user->addresses->first()->address }}</p>
                            </label>

                            <div class="grid md:grid-cols-4 gap-4">
                                <label class="form-control w-full ">
                                    <div class="label">
                                        <span class="label-text">Country</span>
                                    </div>
                                    <p class="mx-2 font-bold text-base lg:text-sm">{{ $user->addresses->first()->country }}
                                    </p>
                                </label>
                                <label class="form-control w-full ">
                                    <div class="label">
                                        <span class="label-text">Province</span>
                                    </div>
                                    <p class="mx-2 font-bold text-base lg:text-sm">{{ $user->addresses->first()->province }}
                                    </p>
                                </label>

                                <label class="form-control w-full ">
                                    <div class="label">
                                        <span class="label-text">City</span>
                                    </div>
                                    <p class="mx-2 font-bold text-base lg:text-sm">{{ $user->addresses->first()->city }}</p>
                                </label>

                                <label class="form-control w-full ">
                                    <div class="label">
                                        <span class="label-text">Post Code</span>
                                    </div>
                                    <p class="mx-2 font-bold text-base lg:text-sm font-sans">
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


                        <h2 class="font-extrabold text-2xl lg:text-3xl">Shipping Information - <span
                                class="font-bold text-xl">Select Courier</span> </h2>

                        <div class="grid gap-4">
                            <label class="form-control w-full max-w-sm">
                                <div class="label">
                                    <span class="label-text">Courier</span>
                                </div>
                                <select class="select select-bordered" id="select-courier">
                                    <option value="" disabled>Select Courier</option>
                                    <option value="jne" selected>JNE</option>
                                    <option value="jnt">JNT</option>
                                    <option value="sicepat">SICEPAT</option>
                                </select>
                            </label>
                            <div id="shipping" class="flex flex-col gap-4">
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col border border-primary shadow-md rounded-sm  w-full p-8 gap-4">
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
                    <form action="{{ route('checkout.store') }}" method="POST" id="form-checkout">
                        @csrf
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

                                $shipping = 0;

                                $total = $item + $shipping;

                                $tax = round($item * 0.1);

                                $totalAll = $total + $tax;
                            @endphp
                            <div class="flex-col border-b pb-4">
                                <div class="flex justify-between items-center">
                                    <h1>Items ({{ $quantity }}) : </h1>
                                    <h1 class="font-sans">Rp. {{ number_format($item, 2, ',', '.') }}</h1>
                                </div>
                                <div class="flex justify-between items-center mt-4">
                                    <h1>Shipping : </h1>
                                    <h1 class="font-sans" id="shippingPrice">Rp.
                                        {{ number_format($shipping, 2, ',', '.') }}</h1>
                                </div>
                                <div class="flex justify-between items-center mt-4">
                                    <h1>Subtotal : </h1>
                                    <h1 class="font-sans" id="subTotal">Rp. {{ number_format($total, 2, ',', '.') }}
                                    </h1>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <h1>PPN : </h1>
                                <h1 class="font-sans" id="tax">Rp. {{ number_format($tax, 2, ',', '.') }}</h1>
                            </div>
                            <div class="text-4xl font-sans">
                                <h1 id="totalAll">Rp. {{ number_format($totalAll, 2, ',', '.') }}</h1>
                            </div>
                            <div class="flex flex-col gap-4 mt-8">
                                @if ($user->carts->count() > 0 && $user->addresses->count() > 0)
                                    <button type="submit" id="checkout" class="btn btn-accent w-full hidden md:flex"
                                        disabled><span class="mdi mdi-dots-hexagon text-xl"></span>Make Order</button>
                                    <x-button-link class="btn btn-neutral hidden lg:flex  w-full" :link="route('carts.indexFront')"><span
                                            class="mdi mdi-cart-outline text-xl"></span>Change
                                        Product Cart</x-button-link>
                                @else
                                    <x-button-link class="btn btn-neutral hidden lg:flex  w-full" :link="route('products.indexFront')">Explore
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
                        <input type="hidden" name="shipping_cost" id="shipping_cost">
                        <input type="hidden" name="shipping_method" id="shipping_method_input">
                        <input type="hidden" name="shipping_code" id="shipping_code_input">

                        <div class="fixed bottom-0 left-0 right-0 bg-white opacity-100 p-4 shadow-lg z-[200] lg:hidden">
                            <div class="flex gap-4 justify-between items-center">
                                <div class="text-xl font-sans text-black">
                                    <h1 id="totalAllMobile" class="font-bold">Rp.
                                        {{ number_format($totalAll, 2, ',', '.') }}</h1>
                                </div>
                                @if ($user->carts->count() > 0)
                                    <button type="submit" id="checkout-mobile" class="btn btn-accent "disabled>
                                        <span class="mdi mdi-dots-hexagon text-xl"></span> Make Order
                                    </button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        const loader = document.getElementById('loading-checkout');
        const shippingContainer = document.getElementById('shipping');
        const checkout = document.getElementById('checkout');
        const checkoutMobile = document.getElementById('checkout-mobile');
        const formCheckout = document.getElementById('form-checkout');
        const selectCourier = document.getElementById('select-courier');
        const apiKey = '{{ config('shipping.api_key') }}';
        const address = @json($user->addresses->first());

        function getOngkir(courier) {
            const url = `{{ route('checkout.ongkirCheck') }}`;
            const data = {
                destination: address.idCity,
                weight: 1000,
                courier: courier,
            };
            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            $.ajax({
                type: "get",
                url: url,
                data: data,
                beforeSend: function() {
                    loader.style.display = 'flex';
                    shippingContainer.innerHTML = '';
                }
            }).done((response) => {
                loader.style.display = 'none';

                console.log(response.rajaongkir);

                const {
                    code,
                    name,
                    costs
                } = response.rajaongkir.results[0];

                costs.forEach((costItem) => {
                    const {
                        service,
                        description,
                        cost
                    } = costItem;

                    const containerTitle = document.createElement('div');

                    containerTitle.classList.add('flex', 'justify-between', 'items-center',
                        'border-b', 'border-primary',
                        'rounded-md', 'p-2', 'mb-2');

                    const title = document.createElement('h1');
                    title.textContent = `${service} - ${description}`;

                    containerTitle.appendChild(title);

                    // Container untuk setiap opsi pengiriman
                    const optionContainer = document.createElement('div');
                    optionContainer.classList.add('flex', 'items-center', 'mb-2', 'border',
                        'border-primary',
                        'rounded-md', 'p-2');

                    // Radio button untuk memilih metode pengiriman
                    costItem.cost.forEach((cost) => {
                        const radioInput = document.createElement('input');
                        radioInput.type = 'radio';
                        radioInput.name = 'shipping_method';
                        radioInput.value = cost.value;
                        radioInput.classList.add('mr-2', 'cursor-pointer');
                        radioInput.addEventListener('change', function() {
                            document.getElementById('shipping_cost').value = cost
                                .value;
                            document.getElementById('shipping_method_input').value =
                                service;
                            document.getElementById('shipping_code_input').value =
                                code;
                            updateTotal(cost.value);
                            checkout.disabled = false;
                        });
                        optionContainer.appendChild(radioInput);

                        // Label untuk nama layanan dan harga
                        const label = document.createElement('label');
                        label.textContent = `${service} - ${formatter.format(cost.value)}`;
                        label.classList.add('cursor-pointer', 'font-sans');
                        optionContainer.appendChild(label);
                    });
                    shippingContainer.appendChild(containerTitle);
                    shippingContainer.appendChild(optionContainer);
                });
            }).fail(() => {
                loader.style.display = 'none';

                const notify = new Notyf({
                    duration: 5000,
                    position: {
                        x: 'right',
                        y: 'top',
                    },
                });

                notify.error(
                    'Courier not available for this destination. Plase choose another courier or contact us for more information.'
                );
            });
        }

        if (selectCourier.value != '') {
            getOngkir(selectCourier.value);
        }

        selectCourier.addEventListener('change', function() {
            getOngkir(this.value);
        });

        function updateTotal(shippingCost) {
            const itemTotal = {{ $item }};
            const subTotal = parseFloat(itemTotal) + parseFloat(shippingCost);
            const tax = Math.round(parseFloat(itemTotal) * 0.1);
            const totalAll = subTotal + tax;

            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            document.getElementById('shippingPrice').textContent = formatter.format(shippingCost);
            document.getElementById('subTotal').textContent = formatter.format(subTotal);
            document.getElementById('tax').textContent = formatter.format(tax);
            document.getElementById('totalAll').textContent = formatter.format(totalAll);
            document.getElementById('totalAllMobile').textContent = formatter.format(totalAll);

            checkout.disabled = false;
            checkoutMobile.disabled = false;

        }

        checkout.addEventListener('click', function(e) {
            e.preventDefault();
            const radioInput = document.querySelector('input[name="shipping_method"]:checked');

            if (selectCourier.value == '' || radioInput == null || radioInput.value == '') {
                const notify = new Notyf({
                    duration: 5000,
                    position: {
                        x: 'right',
                        y: 'top',
                    },
                });

                notify.error('Please select courier first');
                return;
            }
            loader.style.display = 'flex';
            checkout.disabled = true;
            formCheckout.submit();
        });

        checkoutMobile.addEventListener('click', function(e) {
            e.preventDefault();
            const radioInput = document.querySelector('input[name="shipping_method"]:checked');

            if (selectCourier.value == '' || radioInput == null || radioInput.value == '') {
                const notify = new Notyf({
                    duration: 5000,
                    position: {
                        x: 'right',
                        y: 'top',
                    },
                });

                notify.error('Please select courier first');
                return;
            }
            loader.style.display = 'flex';
            checkoutMobile.disabled = true;
            formCheckout.submit();
        });
    </script>
@endpush
