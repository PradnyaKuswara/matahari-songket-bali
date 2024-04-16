@extends('layouts.app')

@section('page-title')
    Cart | Matahari Songket Bali
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
    <section
        class="min-h-screen xl:max-w-screen-xl lg:max-w-screen-lg lg:mx-auto pt-28 py-14 md:px-14 lg:px-0 lg:pt-28 mx-4 md:mx-0">
        <div x-data="{ intersect: false }" x-intersect:enter="intersect=true" x-intersect:leave="intersect=false"
            class="flex flex-col md:flex-row px-4 lg:px-0">
            <h1 class="text-4xl font-bold " :class="intersect ? 'animate-fade-right' : 'opacity-0'">My Cart</h1>
        </div>

        <div class="grid lg:grid-cols-4 gap-8 mt-8">
            <div class="md:col-span-3 lg:col-span-3">
                <div x-data="{ checkAll: false }" x-init="checkAll = false" class="flex flex-col gap-4">
                    <div class="flex justify-between items-center w-full shadow-md rounded-md p-4">
                        <div class="flex items-center gap-4">
                            <input type="checkbox" x-bind:checked="checkAll" @click="checkAll=!checkAll"
                                class="checkbox checkbox-accent" />
                            <p class="text-sm font-bold">Select All</p>
                        </div>
                        <button class="btn btn-sm bg-accent text-white" onclick="delete_cart.showModal()">Delete
                            All</button>
                        <dialog id="delete_cart" class="modal">
                            <div class="modal-box">
                                <h3 class="font-bold text-lg">Confirmation</h3>
                                <p class="pt-4">Are you sure delete all items?</p>
                                <div class="modal-action">
                                    <form method="dialog">
                                        <!-- if there is a button in form, it will close the modal -->
                                        <button class="btn btn-error">Sure</button>
                                        <button class="btn">Close</button>
                                    </form>
                                </div>
                            </div>
                        </dialog>
                    </div>
                    <div class="flex flex-col w-full shadow-lg rounded-md p-4 2xl:h-[49rem] h-[33rem] overflow-y-scroll">
                        <div class="flex flex-col gap-4">
                            <x-cart-list></x-cart-list>
                            <x-cart-list></x-cart-list>
                            <x-cart-list></x-cart-list>
                            <x-cart-list></x-cart-list>
                            <x-cart-list></x-cart-list>
                            <div class="flex justify-center items-center my-52 2xl:my-80 text-slate-300">
                                No items
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:col-span-3 lg:col-span-1  ">
                <div class="flex flex-col gap-8 ">
                    <div class="flex flex-col gap-4 shadow-md rounded-md p-4 ">
                        <h1 class="text-lg font-bold">Order Summary</h1>
                        <div class="flex justify-between">
                            <p class="text-sm">Subtotal</p>
                            <p class="text-sm font-sans">Rp. 1000000</p>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-sm">Shipping</p>
                            <p class="text-sm font-sans">Rp. 100000</p>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-sm">Total</p>
                            <p class="text-sm font-sans">Rp. 1100000</p>
                        </div>
                        <x-button-link link="{{ route('checkout') }}"
                            class="btn-sm bg-accent text-white">Checkout</x-button-link>
                    </div>
                    <div class="flex flex-col gap-4 shadow-md rounded-md p-4">
                        <h1 class="text-lg font-bold">Need Help?</h1>
                        <p class="text-sm">If you have any question, feel free to contact us</p>
                        <x-button-link link="{{ route('about') }}/#contact-us" class="btn-sm bg-accent text-white">Contact Us</x-button-link>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
