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
    <section
        class="min-h-screen xl:max-w-screen-xl lg:max-w-screen-lg lg:mx-auto pt-28 py-14 md:px-14 lg:px-0 lg:pt-28 mx-4 md:mx-0">
        <div x-data="{ intersect: false }" x-intersect:enter="intersect=true" x-intersect:leave="intersect=false"
            class="flex flex-col md:flex-row px-4 lg:px-0">
            <h1 class="text-4xl font-bold " :class="intersect ? 'animate-fade-right' : 'opacity-0'">Checkout Product</h1>
        </div>

        <div class="grid lg:grid-cols-6 gap-8 mt-8">
            <div class="md:col-span-3 lg:col-span-4">
                <div class="flex flex-col gap-4 mt-4">
                    <div class="flex flex-col border rounded-sm shadow-md w-full p-8 gap-4 ">
                        <h2 class="font-extrabold text-3xl">Book Information - <span class="font-bold text-xl">Your
                                detail</span> </h2>
                        <form action="" class="flex flex-col gap-4">
                            <div class="grid grid-cols-2 gap-4">
                                <label class="form-control w-full ">
                                    <div class="label">
                                        <span class="label-text">First Name</span>
                                    </div>
                                    <input type="text" placeholder="Type here" class="input input-bordered w-full" />
                                </label>

                                <label class="form-control w-full">
                                    <div class="label">
                                        <span class="label-text">Last Name</span>
                                    </div>
                                    <input type="text" placeholder="Type here" class="input input-bordered w-full" />
                                </label>
                            </div>

                            <label class="form-control w-full ">
                                <div class="label">
                                    <span class="label-text">Address</span>
                                </div>
                                <input type="text" placeholder="Type here" class="input input-bordered w-full" />
                            </label>

                            <div class="grid grid-cols-3 gap-4">
                                <label class="form-control w-full ">
                                    <div class="label">
                                        <span class="label-text">Province</span>
                                    </div>
                                    <input type="text" placeholder="Type here" class="input input-bordered w-full" />
                                </label>

                                <label class="form-control w-full ">
                                    <div class="label">
                                        <span class="label-text">Regency</span>
                                    </div>
                                    <input type="text" placeholder="Type here" class="input input-bordered w-full" />
                                </label>

                                <label class="form-control w-full ">
                                    <div class="label">
                                        <span class="label-text">Post Code</span>
                                    </div>
                                    <input type="text" placeholder="Type here" class="input input-bordered w-full" />
                                </label>
                            </div>

                            <label class="form-control w-full ">
                                <div class="label">
                                    <span class="label-text">Additional Information</span>
                                </div>
                                <input type="text" placeholder="Type here" class="input input-bordered w-full" />
                            </label>
                        </form>
                    </div>

                    <div class="flex flex-col border rounded-sm  w-full p-8 gap-4 shadow-md">
                        <h2 class="font-extrabold text-xl">Account Information</h2>
                        <div class="flex flex-col">
                            <p>Lorem Ipsum</p>
                            <p>loremipsum@gmail.com</p>
                        </div>


                    </div>
                    {{-- <div class="flex flex-col w-full gap-4 mt-4">
                        <h2 class="ml-4">Payment Method</h2>
                        <form action="">
                            <div class="flex gap-4 items-center border rounded-md border-slate-400 p-4">
                                <input type="radio" name="radio-2" class="radio radio-primary" checked />
                                <label for="radio-2" class="text-sm">Bank Transfer</label>
                            </div>
                        </form>

                    </div> --}}
                </div>
            </div>

            <div class="md:col-span-3 lg:col-span-2  ">
                <div class="flex flex-col gap-4 mt-4">
                    <div
                        class="flex flex-col border rounded-md bg-primary text-primary-content border-slate-400 w-full p-8 gap-4 ">
                        <h2 class="font-extrabold text-3xl">Order Summary</h2>
                        <div class="h-[15rem] overflow-auto ">
                            <x-order-summary></x-order-summary>
                            <x-order-summary></x-order-summary>
                            <x-order-summary></x-order-summary>
                        </div>

                        <div class="flex-col border-b pb-4">
                            <div class="flex justify-between items-center">
                                <h1>Items (4) : </h1>
                                <h1 class="font-sans">Rp. 1000000</h1>
                            </div>
                            <div class="flex justify-between items-center mt-4">
                                <h1>Subtotal : </h1>
                                <h1 class="font-sans">Rp. 1000000</h1>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <h1>PPN : </h1>
                            <h1 class="font-sans">Rp. 20.000</h1>
                        </div>
                        <div class="text-4xl font-sans">
                            <h1>Rp. 1020000</h1>
                        </div>
                        <div class="flex mt-8">
                            <button class="btn btn-accent w-full">Checkout</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
