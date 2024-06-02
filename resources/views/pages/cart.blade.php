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
    <div x-data="carts"
        class="min-h-screen xl:max-w-screen-xl lg:max-w-screen-lg lg:mx-auto pt-28 py-14 md:px-14 lg:px-0 lg:pt-28 mx-4 md:mx-0">
        <div class="flex justify-between items-center" x-data="{ intersect: false }" x-intersect:enter="intersect=true"
            x-intersect:leave="intersect=false">
            <div class="flex flex-col md:flex-row px-4 lg:px-0">
                <h1 class="text-2xl md:text-4xl font-bold " :class="intersect ? 'animate-fade-right' : 'opacity-0'">My Cart</h1>
            </div>
            <div class="flex flex-col md:flex-row px-4 lg:px-0">
                <x-button-link class="btn-neutral btn-sm md:btn-md" :link="route('products.indexFront')">
                    <span class="mdi mdi-store-search-outline text-base md:text-xl"></span>Browse Product</x-button-link>
            </div>
        </div>


        <div class="grid lg:grid-cols-4 gap-8 mt-8">
            <div class="md:col-span-3 lg:col-span-3">
                <div class="flex flex-col gap-4">
                    <div class="flex justify-between items-center w-full shadow-md rounded-md p-4">
                        <div class="flex items-center gap-4">
                            <input type="checkbox" x-bind:checked="checkAll" @click="toggleCheckAll()"
                                class="checkbox checkbox-accent" />
                            <p class="text-sm font-bold">Select All</p>
                        </div>
                    </div>
                    <div class="flex flex-col w-full shadow-lg rounded-md p-4 2xl:h-[49rem] h-[33rem] overflow-y-scroll">
                        <div x-show="temp" id="cart-list" class="flex flex-col gap-4">
                            @include('pages.cart-data')
                        </div>
                        <div>
                            <x-loading-cart></x-loading-cart>
                            <x-loading-cart></x-loading-cart>
                            <x-loading-cart></x-loading-cart>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:col-span-3 lg:col-span-1  ">
                <div class="flex flex-col gap-8 ">
                    <div class="flex flex-col gap-4 shadow-md rounded-md p-4 ">
                        <h1 class="text-lg font-bold">Order Summary</h1>
                        <div class="flex justify-between">
                            <p class="text-sm">Total</p>
                            <p class="text-sm font-sans" x-text="totalPriceDisplay"></p>
                        </div>
                        <x-button-link link="{{ route('checkout.index') }}"
                            class="btn-sm bg-primary text-white">Checkout</x-button-link>
                    </div>
                    <div class="flex flex-col gap-4 shadow-md rounded-md p-4">
                        <h1 class="text-lg font-bold">Need Help?</h1>
                        <p class="text-sm">If you have any question, feel free to contact us</p>
                        <x-button-link link="{{ route('about.index') }}/#contact-us"
                            class="btn-sm bg-neutral text-white">Contact
                            Us</x-button-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('carts', () => ({
                init() {
                    this.getCart();
                },
                forms: [],
                checkAll: false,
                loading: false,
                cart: true,
                products: null,
                temp: true,
                totalPrice: 0,
                endpointCart: '{{ route('carts.getCartByCustomer') }}',
                endpointUpdate: '{{ route('carts.updateCartByCustomer') }}',
                endpointDelete: '{{ route('carts.deleteCartByCustomer') }}',
                endpointToggle: '{{ route('carts.toggleCartByCustomer') }}',
                endpointToggleAll: '{{ route('carts.toggleCartByCustomerAll') }}',

                totalPriceDisplay: function() {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    }).format(this.totalPrice);
                },

                checkAllStatus() {
                    if (this.forms.length > 0) {
                        return this.forms.every((form) => form.is_active == 1);
                    } else {
                        return false;
                    }
                },

                toggleCheckAll: debounce(function() {
                    this.checkAll = !this.checkAll;
                    this.forms.map((form, index) => {
                        form.is_active = this.checkAll ? 1 : 0;
                    });

                    $.ajax({
                        url: this.endpointToggleAll,
                        type: 'patch',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'),
                        },
                        data: {
                            checkAll: this.checkAll ? 1 : 0,
                        },
                    }).done((response) => {
                        this.getCart();
                    }).fail((jqXHR, ajaxOptions, thrownError) => {
                        this.showMessage(jqXHR.responseJSON.message, 'error');
                        console.log(jqXHR.responseJSON.message);
                    });
                }, 300),

                toggleCheck: debounce(function(index) {
                    this.forms[index].is_active = this.forms[index].is_active == 1 ? 0 : 1;

                    $.ajax({
                        url: this.endpointToggle,
                        type: 'patch',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'),
                        },
                        data: {
                            product_id: this.forms[index].product_id,
                            quantity: this.forms[index].quantity,
                        },
                    }).done((response) => {
                        this.getCart();

                    }).fail((jqXHR, ajaxOptions, thrownError) => {
                        this.showMessage('Failed to update cart', 'error');
                    });
                }, 300),

                getTotalPrice() {
                    this.totalPrice = 0; // Reset totalPrice setiap kali fungsi dipanggil
                    if (this.products && this.products.length > 0) {
                        this.forms.map((form, index) => {
                            if (form.is_active == 1) {
                                this.totalPrice += this.products[index].sell_price * form
                                    .quantity;
                            }
                        });
                    } else {
                        this.totalPrice = 0;
                    }
                },

                getCart() {
                    $.ajax({
                        url: this.endpointCart,
                        type: 'get',
                        beforeSend: () => {
                            this.loading = true;
                            this.temp = false;
                        },
                    }).done((response) => {
                        $('#cart-list').html(response.html);
                        this.products = response.products;
                        this.initForm();
                        this.getTotalPrice();
                        this.checkAll = this.checkAllStatus();
                        this.loading = false;
                        this.temp = true;

                    }).fail((jqXHR, ajaxOptions, thrownError) => {
                        this.showMessage('Failed to get cart', 'error');
                        this.loading = false;
                    });
                },

                initForm() {
                    if (this.products && this.products.length > 0) {
                        this.forms = this.products.map((product) => ({
                            product_id: product.id,
                            quantity: product.pivot.quantity,
                            is_active: product.pivot.is_active,
                            is_buy: product.pivot.is_buy,
                        }));
                    } else {
                        this.forms = [];
                    }
                },

                minusQuantity: debounce(function(index) {
                    if (this.forms[index].quantity > 1) {
                        this.forms[index].quantity--;

                        $.ajax({
                            url: this.endpointUpdate,
                            type: 'patch',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content'),
                            },
                            data: {
                                product_id: this.forms[index].product_id,
                                quantity: this.forms[index].quantity,
                            },
                        }).done((response) => {
                            this.getCart();
                        }).fail((jqXHR, ajaxOptions, thrownError) => {
                            this.showMessage('Failed to update cart', 'error');
                        });
                    } else {
                        this.showMessage('Minimum quantity', 'error');
                    }
                }, 300),

                plusQuantity: debounce(function(index) {
                    if (this.forms[index].quantity >= this.products[index].stock) {
                        this.showMessage('Maximum quantity', 'error');
                        return;
                    }
                    this.forms[index].quantity++;

                    $.ajax({
                        url: this.endpointUpdate,
                        type: 'patch',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content'),
                        },
                        data: {
                            product_id: this.forms[index].product_id,
                            quantity: this.forms[index].quantity,
                        },
                    }).done((response) => {
                        this.getCart();
                    }).fail((jqXHR, ajaxOptions, thrownError) => {
                        this.showMessage('Failed to update cart', 'error');
                    });
                }, 300),

                deleteCart(index) {
                    if (this.forms && this.forms[index]) {
                        $.ajax({
                            url: this.endpointDelete,
                            type: 'delete',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content'),
                            },
                            data: {
                                product_id: this.forms[index].product_id,
                                quantity: this.forms[index].quantity,
                            },
                        }).done((response) => {
                            this.showMessage('Success delete cart', 'success');
                            this.getCart();
                        }).fail((jqXHR, ajaxOptions, thrownError) => {
                            this.showMessage('Failed to delete cart', 'error');
                        });
                    }
                },

                showMessage(message = '', status = 'success') {
                    const notify = new Notyf({
                        duration: 3000,
                        position: {
                            x: 'right',
                            y: 'bottom',
                        },
                    });

                    if (status == 'success') {
                        notify.success(message);
                    } else {
                        notify.error(message);
                    }
                },
            }));
        });
    </script>
@endpush
