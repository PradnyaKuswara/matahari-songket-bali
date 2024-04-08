@extends('layouts.app')


@section('page-title')
    Product Detail
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
    <section class=" xl:max-screen-xl lg:max-w-screen-lg lg:mx-auto mx-4 md:mx-0 pt-32 md:px-14 lg:px-0 pb-16">
        <div class="flex flex-col gap-6">
            <div class="grid lg:grid-cols-2 gap-8 place-items-center place-content-center">
                <div class="flex flex-col gap-4 animate-fade-down lg:animate-fade-right ">
                    <div class="flex">
                        <x-product-image onclick="modal_image_preview_1.showModal()"
                            id="modal_image_preview_1"></x-product-image>
                    </div>
                    <div class="grid grid-cols-3 gap-2 lg:gap-4">
                        <x-product-image onclick="modal_image_preview_2.showModal()"
                            id="modal_image_preview_2"></x-product-image>
                        <x-product-image onclick="modal_image_preview_3.showModal()"
                            id="modal_image_preview_3"></x-product-image>
                        <x-product-image onclick="modal_image_preview_4.showModal()"
                            id="modal_image_preview_4"></x-product-image>

                    </div>
                </div>
                <div class="flex flex-col gap-4 animate-fade-right lg:animate-fade-down">
                    <p class="text-xs md:text-sm font-bold">Songket / Kamen</p>
                    <h1 class="text-3xl md:text-5xl font-extrabold">Product Name</h1>
                    <p class="text-xs font-bold"><i class="fas fa-eye"></i> 2.5k view this product</p>
                    <h1 class="text-xl md:text-3xl font-bold font-mono">Rp.8000000</h1>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-lg md:text-xl font-bold">Product Description</h1>
                        <p class="text-sm md:text-base">Lorem Ipsum is simply dummy text of the printing and typesetting
                            industry.
                            Lorem
                            Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                            took
                            a galley of type and scrambled it to make a type specimen book</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h1 class="text-lg md:text-xl font-bold">Avaliable Color</h1>
                        <div class="p-2 md:p-3 w-1/12 rounded-lg bg-primary"></div>
                    </div>
                    <div class="flex flex-row gap-4 items-center">
                        <div class="flex flex-col gap-2">
                            <h1 class="text-lg md:text-xl font-bold">Item Quantity</h1>
                            <div class="custom-number-input h-10 w-32">
                                <div x-data="{ quantity: 0 }"
                                    class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                    <button
                                        class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none"
                                        @click="quantity > 0 ? quantity-- : null">
                                        <span class="m-auto text-3xl">−</span>
                                    </button>
                                    <input type="number"
                                        class="outline-none focus:outline-none text-center w-full bg-gray-100 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none"
                                        name="custom-input-number" name="quantity" x-model="quantity"></input>
                                    <button data-action="increment"
                                        class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer"
                                        @click="quantity < 2 ? quantity++ : ''">
                                        <span class="m-auto text-2xl">+</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="flex text-red-400 text-sm mt-10">Ready 2 stock</div>
                    </div>
                    <div class="flex gap-2 md:gap-4 item-center mt-2">
                        <x-button-click class="btn btn-primary">Add to Cart</x-button-click>
                        <x-button-click class="btn btn-secondary">Buy Now</x-button-click>
                    </div>
                </div>
            </div>
    </section>
    <section class="xl:max-w-screen-xl lg:max-w-screen-lg mx-2 md:mx-8 lg:mx-auto pb-16">
        <div class="flex flex-col gap-8 lg:gap-4">
            <div class="text-2xl md:text-4xl font-bold">You may like also</div>
            <div x-data="{ card: false, loading: false }" x-init=" card = true, loading = false" class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-8">
                @for ($i = 0; $i < 4; $i++)
                    <x-product-card class="shadow-md"></x-product-card>
                @endfor

            </div>
        </div>
    </section>
@endsection
