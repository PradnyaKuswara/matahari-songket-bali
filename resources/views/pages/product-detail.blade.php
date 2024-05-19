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
            <div x-data="products" class="grid lg:grid-cols-2 gap-8 place-items-center place-content-center">

                <div class="flex flex-col gap-4 animate-fade-down lg:animate-fade-right ">
                    <div class="flex">
                        <x-product-image :src="$product->image1()" onclick="modal_image_preview_1.showModal()"
                            id="modal_image_preview_1"></x-product-image>
                    </div>
                    <div class="grid grid-cols-3 gap-2 lg:gap-4">
                        <x-product-image :src="$product->image_2
                            ? $product->image2()
                            : asset('assets/images/placeholder-image.jpg')" onclick="modal_image_preview_2.showModal()"
                            id="modal_image_preview_2"></x-product-image>
                        <x-product-image :src="$product->image_3
                            ? $product->image3()
                            : asset('assets/images/placeholder-image.jpg')" onclick="modal_image_preview_3.showModal()"
                            id="modal_image_preview_3"></x-product-image>
                        <x-product-image :src="$product->image_4
                            ? $product->image4()
                            : asset('assets/images/placeholder-image.jpg')" onclick="modal_image_preview_4.showModal()"
                            id="modal_image_preview_4"></x-product-image>
                    </div>
                </div>
                <div class="flex flex-col gap-4 animate-fade-right lg:animate-fade-down">
                    <p class="text-xs md:text-sm font-bold">Songket / {{ $product->productCategory->name }}</p>
                    <h1 class="text-3xl md:text-5xl font-extrabold">{{ $product->name }}</h1>
                    <p class="text-xs font-bold"><i class="fas fa-eye"></i>
                        {{ visits(\App\Models\Visitor::TYPE_PRODUCT, $product)->getVisitorCountPerSite() }} view this
                        product</p>
                    <h1 class="text-xl md:text-3xl font-bold font-sans text-primary"> Rp.
                        {{ number_format($product->sell_price, 2, ',', '.') }}</h1>

                    <div class="flex flex-col gap-2">
                        <h1 class="text-lg md:text-xl font-bold">Product Description</h1>
                        <p class="text-sm md:text-base">{{ $product->description }}</p>
                    </div>

                    <div class="flex flex-col gap-2">
                        <h1 class="text-lg md:text-xl font-bold">Avaliable Color</h1>
                        <div class="p-2 md:p-3 w-1/12 rounded-lg" style="background-color: {{ $product->color }}"></div>
                    </div>

                    <div class="flex flex-row gap-4 items-center">
                        <div class="flex flex-col gap-2">
                            <h1 class="text-lg md:text-xl font-bold">Item Quantity</h1>
                            <div class="custom-number-input h-10 w-32">
                                <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                    <button type="button"
                                        class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-l cursor-pointer outline-none"
                                        @click="form.quantity > 1 ? form.quantity-- : null">
                                        <span class="m-auto text-3xl">−</span>
                                    </button>
                                    <input type="number" readonly
                                        class=" focus:outline-none text-center w-full bg-gray-100 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none"
                                        name="quantity" x-model="form.quantity"></input>
                                    <button data-action="increment" type="button"
                                        class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r cursor-pointer"
                                        @click="form.quantity < {{ $product->stock }} ? form.quantity++ : ''">
                                        <span class="m-auto text-2xl">+</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <input type="text" name="product_id" x-model="form.product_id" class="hidden">
                        <div class="flex text-red-400 text-sm mt-10">Ready {{ $product->stock }} stock</div>
                    </div>

                    <div class="flex gap-2 md:gap-4 item-center mt-5">
                        <x-button-click @click="addToCart({{ $product }})" id="btn-cart"
                            class="bg-primary w-full text-white"><span class="mdi mdi-cart-outline text-xl"></span>Add to
                            Cart</x-button-click>
                    </div>
                </div>
            </div>
    </section>
    <section class="xl:max-w-screen-xl lg:max-w-screen-lg mx-2 md:mx-8 lg:mx-auto pb-16">
        <div class="flex flex-col gap-8 lg:gap-4">
            <div class="text-2xl md:text-4xl font-bold">You may like also</div>
            <div x-data="{ card: false, loading: false }" x-init=" card = true, loading = false" class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-8">
                @foreach ($products as $product)
                    <x-product-card :product="$product" class="card" />
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('products', () => ({
                form: {
                    product_id: null,
                    quantity: 1,
                },

                endPointStoreCart: '{{ route('carts.storeCartByCustomer') }}',

                addToCart: debounce(function(product) {
                    this.form.product_id = product.id;
                    let notify = new Notyf({
                        duration: 3000,
                        position: {
                            x: 'right',
                            y: 'bottom',
                        },
                    });

                    $.ajax({
                        url: this.endPointStoreCart,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: this.form,
                        beforeSend: () => {
                            $('#btn-cart').html('Loading...');
                        }
                    }).done(response => {
                        notify.success(response.message);
                        $('#btn-cart').html(
                            '<span class="mdi mdi-cart-outline text-xl"></span>Add to Cart'
                            );
                    }).fail((jqXHR, textStatus, errorThrown) => {
                        $('#btn-cart').html('Add to Chart');

                        if (jqXHR.status == 400) {
                            notify.error(jqXHR.responseJSON.message);
                        }

                        if (jqXHR.status == 422) {
                            notify.error(jqXHR.responseJSON.message);
                        }

                        if (jqXHR.status == 404) {
                            notify.error(jqXHR.responseJSON.message);
                        }

                        if (jqXHR.status == 401) {
                            notify.error(
                                `${jqXHR.responseJSON.message}. Please login first`);
                            window.location.href = '{{ route('login') }}';
                        }

                        if (jqXHR.status == 500) {
                            notify.error('Internal server error');
                        }

                        if (jqXHR.status == 419) {
                            notify.error('Page has expired');
                        }
                    });
                }, 300)
            }))
        })
    </script>
@endpush
