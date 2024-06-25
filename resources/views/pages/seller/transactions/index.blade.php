@extends('layouts.dashboard')

@section('title', 'Direct Transactions')


@section('content')
    <div style="display: none;" id="loading-checkout"
        class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-[300] overflow-hidden bg-gray-800 opacity-75 flex flex-col items-center justify-center">
        <div class="loading loading-dots w-12 rounded-full text-white h-12 mb-4"></div>
        <h2 class="text-center text-white text-xl font-semibold">Loading...</h2>
        <p class="lg:w-1/3 w-2/3 text-center text-white">This may take a few seconds, please don't close this page.</p>
    </div>
    <div x-data="directTransaction">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Dashboard</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Transactions</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Direct</span>
            </li>
        </ul>

        <div>
            <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
                <h2 class="text-xl font-semibold mt-4">Create Transaction</h2>
                <label class="input input-bordered input-md w-full lg:w-80 flex items-center gap-2 dark:bg-black ">
                    <input type="text" id="search" x-model="search"
                        class=" grow border-none outline-none text-black dark:text-white"
                        placeholder="Search product name" />
                    <span class="mdi mdi-magnify"></span>
                </label>
            </div>
        </div>

        <form x-ref="form-create" @submit.prevent="submitForm()"">
            @csrf
            <div class="grid md:grid-cols-5 lg:grid-cols-8 gap-4 mt-4">
                <div class="md:col-span-5 lg:col-span-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">
                        <template x-for="(product, index) in products" :key="index">
                            <div class="border-blue-600 rounded-2xl border  max-w-sm  bg-white dark:bg-black"
                                style="box-shadow: rgba(45, 50, 130, 0.15) 0px 12px 16px -4px, rgba(45, 50, 130, 0.15) 0px 4px 6px -2px;">
                                <div class="pt-6 px-4">
                                    <div class="flex items-center gap-2">
                                        <h2 class="text-xl font-semibold" x-text="product.name"></h2>
                                        {{-- //button add --}}
                                        <div class="flex-grow"></div>
                                        <button type="button"
                                            class="btn btn-sm btn-outline btn-accent flex items-center gap-1"
                                            @click="addSumary(product.id, quantity[index])">
                                            <span class="mdi mdi-plus"></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="px-6 pt-3 pb-8">
                                    <h3 class="text-sm font-medium" x-text="formatRupiah(product.sell_price)"></h3>
                                    <ul role="list" class="mt-4 space-y-4">
                                        <li class="flex space-x-3">
                                            <div class="flex justify-center items-center rounded-full bg-green-100 h-5 w-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" aria-hidden="true"
                                                    class="h-3 w-3 flex-shrink-0 text-green-500">
                                                    <path fill-rule="evenodd"
                                                        d="M20.707 5.293a1 1 0 010 1.414l-11 11a1 1 0 01-1.414 0l-5-5a1 1 0 111.414-1.414L9 15.586 19.293 5.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <span class="text-sm" x-text="`${product.stock} stock`"></span>
                                        </li>
                                        <li class="flex space-x-3">
                                            <div class="flex justify-center items-center rounded-full bg-green-100 h-5 w-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" aria-hidden="true"
                                                    class="h-3 w-3 flex-shrink-0 text-green-500">
                                                    <path fill-rule="evenodd"
                                                        d="M20.707 5.293a1 1 0 010 1.414l-11 11a1 1 0 01-1.414 0l-5-5a1 1 0 111.414-1.414L9 15.586 19.293 5.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                            <span class="text-sm" x-text="product.product_category.name"></span>
                                        </li>
                                    </ul>

                                    <div class="flex flex-col md:flex-row lg:items-center lg:justify-between gap-2 mt-4">
                                        <label for="quantity" class="text-sm">Quantity</label>
                                        <div class="flex items-center">
                                            <button type="button" class="bg-gray-300 text-gray-700 rounded-l px-3 py-2"
                                                @click="quantity[index] > 1 ? quantity[index]-- : 1">-</button>
                                            <input type="text" x-model="quantity[index]" name="quantity[]" value="1"
                                                class="form-input  text-center w-12" min="1" :max="product.stock"
                                                readonly>
                                            <button type="button"
                                                @click="quantity[index] < product.stock ? quantity[index]++ : product.stock"
                                                class="bg-gray-300 text-gray-700 rounded-r px-3 py-2">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </template>
                        </p>
                        <!-- No Products Found Message -->
                        <template x-if="products.length === 0">
                            <div class="col-span-4">
                                <div class="bg-white dark:bg-black rounded-lg shadow-md p-6">
                                    <h2 class="text-lg font-semibold text-center">No Products Found</h2>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                <div class="md:col-span-5 lg:col-span-2 hidden lg:flex">
                    <div
                        class="bg-white dark:bg-black rounded-lg shadow-md p-6 sticky right-10 w-full md:w-8/12 lg:w-full mx-auto ">
                        <h2 class="text-lg font-semibold mb-4">Summary</h2>
                        {{-- show products and quantity on objData --}}
                        <template x-for="(productId, index) in objData.products" :key="index">
                            <div class="flex justify-between mb-2">
                                <span x-text="productsTemp.find(product => product.id === productId).name"></span>
                                <div class="flex gap-4">
                                    <span
                                        x-text="formatRupiah(productsTemp.find(product => product.id === productId).sell_price)"></span>
                                    <span>x</span>
                                    <span x-text="objData.quantity[index]"></span>
                                </div>
                            </div>
                        </template>
                        <hr class="my-2">
                        <div class="flex justify-between mb-2">
                            <span>Subtotal</span>
                            <span x-text="formatRupiah(subTotal)"></span>
                        </div>
                        <div class="flex justify-between mb-2">
                            <span>PPN (10%)</span>
                            <span x-text="formatRupiah(tax)"></span>
                        </div>
                        <hr class="my-2">
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Total</span>
                            <span class="font-semibold" x-text="formatRupiah(total)"></span>
                        </div>
                        <button type="submit" class="bg-accent text-white py-2 px-4 rounded-lg mt-4 w-full"
                            x-text="totalQuantity()"></button>
                        {{-- button empty cart --}}
                        <button type="button" class="bg-red-500 text-white py-2 px-4 rounded-lg mt-2 w-full"
                            @click="emptyCart()">
                            Empty Cart </button>
                    </div>
                </div>
            </div>

            <div class="fixed bottom-0 left-0 right-0 bg-white dark:bg-black opacity-100 p-2 shadow-lg z-[200] lg:hidden">
                <div class="w-full  ">
                    <div class="flex justify-between mb-2 gap-4">
                        <div class="flex gap-4 items-center">
                            <span>Subtotal</span>
                            <span x-text="formatRupiah(subTotal)"></span>
                        </div>

                        <div class="flex gap-4 items-center">
                            <span>PPN (10%)</span>
                            <span x-text="formatRupiah(tax)"></span>
                        </div>
                    </div>
                    <div class="flex justify-between mb-2">
                    </div>
                    <hr class="my-2">
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold">Total</span>
                        <span class="font-semibold" x-text="formatRupiah(total)"></span>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-accent text-white py-2 px-4 rounded-lg mt-4 w-full"
                            x-text="totalQuantity()"></button>
                        {{-- button empty cart --}}
                        <button type="button" class="bg-red-500 text-white py-2 px-4 rounded-lg mt-4 w-full"
                            @click="emptyCart()">
                            Empty Cart </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('directTransaction', () => ({
                init() {
                    this.products = this.productsTemp.map(product => ({
                        id: product.id,
                        name: product.name,
                        sell_price: product.sell_price,
                        stock: product.stock,
                        product_category: {
                            name: product.product_category.name
                        }
                    }));
                    this.quantity = Array(this.products.length).fill(1);
                    this.filterProducts();
                    this.getSessionStorage();
                },
                search: '',
                productsTemp: @json($products),
                products: [],
                quantity: [],
                subTotal: 0,
                total: 0,
                tax: 0,
                objData: {
                    products: [],
                    quantity: [],
                },

                endPointMakeCheckout: '{{ route('seller.dashboard.checkout.direct-checkout') }}',

                saveSessionStorage() {
                    sessionStorage.setItem('products', JSON.stringify(this.objData.products));
                    sessionStorage.setItem('quantity', JSON.stringify(this.objData.quantity));
                },

                getSessionStorage() {
                    const products = JSON.parse(sessionStorage.getItem('products'));
                    const quantity = JSON.parse(sessionStorage.getItem('quantity'));

                    if (products && quantity) {
                        this.objData.products = products;
                        this.objData.quantity = quantity;

                        this.calculateTotal();
                    }
                },

                formatRupiah(value) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }).format(value);
                },

                filterProducts() {
                    this.$watch('search', (value) => {
                        this.products = this.productsTemp.filter((product) => {
                            return product.name.toLowerCase().includes(value
                                .toLowerCase());
                        });
                    });
                },

                addSumary(productId, quantity) {
                    if (this.objData.products.includes(productId)) {
                        this.objData.quantity = this.objData.quantity.map((item, index) => {
                            if (this.objData.products[index] == productId) {
                                return quantity;
                            }
                            return item;
                        });
                    } else {
                        this.objData.products.push(productId);
                        this.objData.quantity.push(quantity);
                    }

                    this.calculateTotal();
                    this.saveSessionStorage();
                },

                calculateTotal() {
                    this.subTotal = 0;
                    this.tax = 0;
                    this.total = 0;

                    this.subTotal = this.objData.products.reduce((acc, productId, index) => {
                        const product = this.products.find(product => product.id === productId);
                        return acc + (product.sell_price * this.objData.quantity[index]);
                    }, 0);

                    this.tax = Math.round(this.subTotal * 0.1);
                    this.total = this.subTotal + this.tax;
                },

                submitForm() {
                    if (this.objData.products.length == 0 || this.objData.quantity.length == 0) {
                        this.showMessage('Please select at least one product', 'error');
                        return;
                    }

                    $.ajax({
                        url: this.endPointMakeCheckout,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        data: {
                            products: this.objData.products,
                            quantity: this.objData.quantity,
                        },
                        beforeSend: () => {
                            $('#loading-checkout').show();
                        },
                    }).done((response) => {
                        this.showMessage('Transaction success');
                        this.objData.products.forEach((productId, index) => {
                            const product = this.products.find(product => product.id ===
                                productId);
                            product.stock -= this.objData.quantity[index];
                        });
                        this.emptyCart();

                        $('#loading-checkout').hide();
                        window.location.href = response.data.invoice_link;
                    }).fail((error) => {
                        console.log(error.responseJSON);
                        $('#loading-checkout').hide();
                        this.showMessage('Transaction failed', 'error');

                    });
                },

                totalQuantity() {
                    if (this.objData.quantity.length == 0) {
                        return 'Checkout (0)';
                    }
                    return `Checkout (${this.objData.quantity.reduce((acc, quantity) => acc + quantity, 0)})`;
                },

                emptyCart() {
                    this.objData.products = [];
                    this.objData.quantity = [];
                    this.calculateTotal();
                    this.saveSessionStorage();
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
