@extends('layouts.dashboard')

@section('title')
    Create Production
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/css/tom-select.css" rel="stylesheet">
@endpush

@section('content')
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Production</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Create</span>
            </li>
        </ul>

        <div x-data="form">
            <form action="{{ route('admin.dashboard.productions.store') }}" method="POST"
                @submit.prevent="submitForm()" id="itemForm">
                @csrf
                <div class="panel mt-5">
                    <div class="flex flex-col lg:flex-row w-full justify-between items-center gap-4">
                        <div class="flex flex-col gap-2">
                            <h2 class="animate-pulse animate-infinite text-lg text-primary">Important Note:</h2>
                            <p class="text-xs text-muted">* Please fill the form correctly</p>
                            <p class="text-xs text-muted">* Please fill the form with valid data</p>
                            <p class="text-xs text-muted">* Max 10 data item expanditure per production</p>
                            <p class="text-xs text-muted">* Max 10 data product per production</p>
                            <p class="text-xs text-muted">* Make sure your data is correctly. Because your data is important
                                for system to generate another data business </p>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Form</button>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-4 mt-5">
                    <div class="col-span-12 lg:col-span-6">
                        <div class="panel">
                            <h5 class="text-lg font-semibold dark:text-white-light">Production Form</h5>
                            <div class="flex flex-col lg:flex-row gap-4 mb-4 mt-5">
                                <div class=" w-full">
                                    <label class="form-control w-full max-w-xs" for="loggingName">
                                        <div class="label">
                                            <div>
                                                <span class="label-text">Name</span>
                                                <span class="text-error">*</span>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                        <input id="loggingName" type="text"
                                            class="form-input grow border-none outline-none " name="name"
                                            x-model="form.name" value="{{ old('name') }}"
                                            placeholder="Enter your production name" minlength="1" maxlength="50" />
                                    </label>

                                    <template x-if="isSubmitFormItem">
                                        <p class="text-xs"
                                            :class="{
                                                'text-[#1abc9c]': form.name,
                                                'text-error': (!form.name)
                                            }"
                                            x-text="form.name ? 'Looks Good!' : 'Please fill the name'">
                                        </p>
                                    </template>
                                </div>

                                <div class=" w-full">
                                    <label class="form-control w-full max-w-xs" for="loggingDate">
                                        <div class="label">
                                            <div>
                                                <span class="label-text">Date</span>
                                                <span class="text-error">*</span>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                        <input id="loggingDate" type="date"
                                            class="form-input grow border-none outline-none " name="date"
                                            x-model="form.date" value="{{ old('date') }}"
                                            placeholder="Enter your production date" />
                                    </label>

                                    <template x-if="isSubmitFormItem">
                                        <p class="text-xs"
                                            :class="{
                                                'text-[#1abc9c]': form.date,
                                                'text-error': (!form.date)
                                            }"
                                            x-text="form.date ? 'Looks Good!' : 'Please fill the date'">
                                        </p>
                                    </template>

                                </div>
                            </div>

                            <div class="flex gap-4 mb-4 mt-5">
                                <div class=" w-full">
                                    <label class="form-control w-full max-w-xs" for="loggingEstimate">
                                        <div class="label">
                                            <div>
                                                <span class="label-text">Estimate (month)</span>
                                                <span class="text-error">*</span>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                        <input id="loggingEstimate" type="text"
                                            class="form-input grow border-none outline-none " name="estimate"
                                            x-model="form.estimate" value="{{ old('estimate') }}"
                                            placeholder="Enter your production estimate on month" minlength="1"
                                            maxlength="50" />
                                    </label>

                                    <template x-if="isSubmitFormItem">
                                        <p class="text-xs"
                                            :class="{
                                                'text-[#1abc9c]': form.estimate && !isNaN(form.estimate),
                                                'text-error': (!form.estimate || isNaN(form.estimate))
                                            }"
                                            x-text="form.estimate ? (!isNaN(form.estimate) ? 'Looks Good!' : 'Estimate must be a number') : 'Please fill the estimate'">
                                        </p>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <div class="panel mt-5">
                            <h5 class="text-lg font-semibold dark:text-white-light">Item Expanditure Form</h5>
                            <div class="flex flex-col mb-4 mt-5 gap-4" id="formContainer">
                                <div class="grid lg:grid-cols-7 grid-cols-2 place-items-center place-content-center gap-4 "
                                    id="formParent0">
                                    <div class="col-span-2 w-full">
                                        <label class="form-control w-full max-w-xs" for="loggingItemName">
                                            <div class="label">
                                                <div>
                                                    <span class="label-text">Name</span>
                                                    <span class="text-error">*</span>
                                                </div>
                                            </div>
                                        </label>

                                        <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                            <input id="loggingItemName" type="text"
                                                class="form-input grow border-none outline-none " name="items[0][name]"
                                                x-model="form.items[0].name" placeholder="Production name" minlength="1"
                                                maxlength="50" />
                                        </label>

                                        <template x-if="isSubmitFormItem && form.items[0].name">
                                            <p class="text-[#1abc9c] mt-2 text-xs">Looks Good!</p>
                                        </template>

                                        <template x-if="isSubmitFormItem && !form.items[0].name">
                                            <p class="mt-2 text-error text-xs">Please fill the Name</p>
                                        </template>
                                    </div>

                                    <div class="col-span-2 w-full">
                                        <label class="form-control w-full max-w-xs" for="loggingItemCategory">
                                            <div class="label">
                                                <div>
                                                    <span class="label-text">Item Category</span>
                                                    <span class="text-error">*</span>
                                                </div>
                                            </div>
                                        </label>

                                        <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                            <select
                                                class=" form-input grow border-none outline-none text-md font-extralight"
                                                id="loggingItemCategory" name="items[0][category_name]"
                                                x-model="form.items[0].category_name">
                                                <option selected>Production item category</option>
                                                <option value="material">
                                                    Material
                                                </option>
                                                <option value="service">
                                                    Service
                                                </option>
                                            </select>
                                        </label>

                                        <template x-if="isSubmitFormItem && form.items[0].category_name">
                                            <p class="text-[#1abc9c] mt-2 text-xs">Looks Good!</p>
                                        </template>

                                        <template x-if="isSubmitFormItem && !form.items[0].category_name">
                                            <p class="mt-2 text-error text-xs">Please fill the Item Category</p>
                                        </template>
                                    </div>

                                    <div class="col-span-2 w-full">
                                        <label class="form-control w-full max-w-xs" for="loggingItemPrice">
                                            <div class="label">
                                                <div>
                                                    <span class="label-text">Price</span>
                                                    <span class="text-error">*</span>
                                                </div>
                                            </div>
                                        </label>

                                        <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                            <p class="text-sm text-gray-400">Rp.</p>
                                            <input id="loggingItemPrice" type="text"
                                                class="form-input grow border-none outline-none " name="items[0][price]"
                                                x-model="form.items[0].price" placeholder="Production price"
                                                x-mask:dynamic="$money($input,',')" step="1000" minlength="1"
                                                maxlength="50" />
                                        </label>

                                        <template
                                            x-if="isSubmitFormItem && form.items[0].price && !isNaN(form.items[0].price)">
                                            <p class="text-[#1abc9c] mt-2 text-xs">Looks Good!</p>
                                        </template>

                                        <template x-if="isSubmitFormItem && !form.items[0].price">
                                            <p class="mt-2 text-error text-xs">Please fill the Price</p>
                                        </template>

                                        <template
                                            x-if="isSubmitFormItem && form.items[0].price && isNaN(form.items[0].price)">
                                            <p class="mt-2 text-error text-xs">Price must be number</p>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            <div class=" w-full flex gap-4">
                                <button type="button" id="btn-add-item" class="btn btn-sm btn-primary"
                                    @click="addItemForm()">+ Add
                                    item</button>
                                <button type="button" id="btn-clear-item" class="btn btn-sm btn-error text-white"
                                    @click="clearAllItemForm()">- Clear
                                    All Item</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-12 lg:col-span-6">
                        <div class="panel">
                            <h5 class="text-lg font-semibold dark:text-white-light">Product Form</h5>
                            <div class="flex flex-col mb-4 mt-5 gap-4" id="formContainerProduct">
                                <div class="grid lg:grid-cols-7 grid-cols-2 place-items-center place-content-center gap-4 "
                                    id="formParentProduct0">
                                    <div class="col-span-3 w-full">
                                        <label class="form-control w-full max-w-xs" for="loggingProductName0">
                                            <div class="label">
                                                <div>
                                                    <span
                                                        class="label-text
                                                    ">Name</span>
                                                    <span
                                                        class="text-error
                                                    ">*</span>
                                                </div>
                                            </div>
                                        </label>

                                        <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                            <input id="loggingProductName0" type="text"
                                                class="form-input grow border-none outline-none " name="products[0][name]"
                                                x-model="form.products[0].name" placeholder="Enter your product name"
                                                minlength="1" maxlength="50" />
                                        </label>

                                        <template x-if="isSubmitFormItem && form.products[0].name">
                                            <p class="text-[#1abc9c] mt-2 text-xs">Looks Good!</p>
                                        </template>

                                        <template x-if="isSubmitFormItem && !form.products[0].name">
                                            <p class="mt-2 text-error text-xs">Please fill the name</p>
                                        </template>
                                    </div>

                                    <div class="col-span-3 w-full">
                                        <label class="form-control w-full max-w-xs" for="loggingProductProfit0">
                                            <div class="label">
                                                <div>
                                                    <span
                                                        class="label-text
                                                    ">Profit</span>
                                                    <span
                                                        class="text-error
                                                    ">*</span>
                                                </div>
                                            </div>
                                        </label>

                                        <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                            <p class="text-sm text-gray-400">Rp.</p>
                                            <input id="loggingProductProfit0" type="text"
                                                class="form-input grow border-none outline-none "
                                                name="products[0][profit]" x-model="form.products[0].profit"
                                                x-mask:dynamic="$money($input,',')" step="1000"
                                                placeholder="Enter your product profit" minlength="1" maxlength="50" />
                                        </label>

                                        <template x-if="isSubmitFormItem && form.products[0].profit">
                                            <p class="text-[#1abc9c] mt-2 text-xs">Looks Good!</p>
                                        </template>

                                        <template x-if="isSubmitFormItem && !form.products[0].profit">
                                            <p class="mt-2 text-error text-xs">Please fill the profit</p>
                                        </template>
                                    </div>

                                    <div class="col-span-3 w-full">
                                        <label class="form-control w-full max-w-xs" for="loggingProductWeaverName0">
                                            <div class="label">
                                                <div>
                                                    <span
                                                        class="label-text
                                                    ">Weaver
                                                        Name</span>
                                                    <span
                                                        class="text-error
                                                    ">*</span>
                                                </div>
                                            </div>
                                        </label>

                                        <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                            <select
                                                class="dropDownWeaver form-input form-control grow border-none outline-none text-md font-extralight"
                                                id="loggingProductWeaverName0" name="products[0][weaver_name]"
                                                x-model="form.products[0].weaver_name">
                                                <option selected>Production weaver name</option>
                                            </select>
                                        </label>

                                        <template x-if="isSubmitFormItem && form.products[0].weaver_name">
                                            <p class="text-[#1abc9c] mt-2 text-xs">Looks Good!</p>
                                        </template>

                                        <template x-if="isSubmitFormItem && !form.products[0].weaver_name">
                                            <p class="mt-2 text-error text-xs">Please fill the weaver name</p>
                                        </template>
                                    </div>

                                    <div class="col-span-3 w-full">
                                        <label class="form-control w-full max-w-xs" for="loggingProductCategoryName0">
                                            <div class="label">
                                                <div>
                                                    <span
                                                        class="label-text
                                                    ">Category
                                                        Name</span>
                                                    <span
                                                        class="text-error
                                                    ">*</span>
                                                </div>
                                            </div>
                                        </label>

                                        <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                            <input id="loggingProductCategoryName0" type="text"
                                                class="form-input grow border-none outline-none"
                                                name="products[0][category_name]" x-model="form.products[0].category_name"
                                                placeholder="Enter your product category name" minlength="1"
                                                maxlength="50" />
                                        </label>

                                        <template x-if="isSubmitFormItem && form.products[0].category_name">
                                            <p class="text-[#1abc9c] mt-2 text-xs">Looks Good!</p>
                                        </template>

                                        <template x-if="isSubmitFormItem && !form.products[0].category_name">
                                            <p class="mt-2 text-error text-xs">Please fill the category name</p>
                                        </template>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full flex gap-4">
                                <button type="button" id="btn-add-item" class="btn btn-sm btn-primary"
                                    @click="addProductForm()">+ Add
                                    Product</button>
                                <button type="button" id="btn-clear-item" class="btn btn-sm btn-error text-white"
                                    @click="clearAllProductForm()">- Clear
                                    All Product</button>
                            </div>
                        </div>
                    </div>
                </div>


            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
    <script src="{{ asset('assets/js/itemFormInput.js') }}"></script>
    <script src="{{ asset('assets/js/productFormInput.js') }}"></script>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("form", () => ({
                init() {
                    this.renderItemForm(this.indexItem);
                    this.renderProductForm(this.indexProduct);
                    this.dropDownWeaver();
                },

                form: {
                    name: '',
                    date: '',
                    estimate: '',
                    items: [{
                        name: '',
                        category_name: '',
                        price: ''
                    }],
                    products: [{
                        name: '',
                        profit: '',
                        weaver_name: '',
                        category_name: '',
                    }]
                },

                indexItem: localStorage.getItem('x_form_item') ? localStorage.getItem('x_form_item') :
                    0,
                indexProduct: localStorage.getItem('x_form_product') ? localStorage.getItem(
                    'x_form_product') : 0,
                isSubmitFormItem: false,
                statusRequest: false,

                submitForm() {
                    this.isSubmitFormItem = true;
                    this.statusRequest = true;

                    if (!this.form.name || !this.form.date || !this.form.estimate || isNaN(this.form
                            .estimate)) {
                        this.statusRequest = false;
                    }

                    this.form.items.forEach((item, index) => {
                        if (item) {
                            item.price = this.clearDotFormInput(item.price);
                            console.log(item.price);
                            if (!item.name || !item.category_name || !item.price || isNaN(item
                                    .price)) {
                                this.statusRequest = false;
                            }
                        }
                    });

                    this.form.products.forEach((product, index) => {
                        if (product) {
                            product.profit = this.clearDotFormInput(product.profit);
                            if (!product.name || !product.profit || !product.weaver_name || !
                                product
                                .category_name) {
                                this.statusRequest = false;
                            }
                        }
                    });

                    if (this.statusRequest) {
                        this.isSubmitFormItem = false;
                        this.resetForm();
                        this.statusRequest = true;
                        $('#itemForm').submit();
                    }
                },

                addItemForm() {
                    let self = this;

                    if (this.form.items.length >= 10) {
                        this.showMessage('You can only add up to 10 items', 'error');
                        return;
                    }

                    self.indexItem++;
                    localStorage.setItem('x_form_item', self.indexItem);

                    this.form.items.push({
                        name: '',
                        category_name: '',
                        price: ''
                    });

                    $('#formContainer').append(() => formParent(self.indexItem));
                },

                addProductForm() {
                    let self = this;

                    if (this.form.products.length >= 10) {
                        this.showMessage('You can only add up to 10 products', 'error');
                        return;
                    }

                    self.indexProduct++;
                    localStorage.setItem('x_form_product', self.indexProduct);

                    this.form.products.push({
                        name: '',
                        profit: '',
                        weaver_name: '',
                        category_name: '',
                    });

                    $('#formContainerProduct').append(() => formParentProduct(self.indexProduct));
                    this.dropDownWeaver(self.indexProduct);
                },

                removeItemForm(index) {
                    let string = 'formParent' + index;
                    const formParent = document.getElementById(string);
                    formParent.remove();

                    for (let i = index + 1; i <= this.form.items.length; i++) {
                        let el = document.getElementById('formParent' + i);
                        if (el) {
                            this.resetIndexElementItem(el, i);
                        }
                    }
                    this.indexItem--;
                    localStorage.setItem('x_form_item', this.indexItem);

                    setTimeout(() => {
                        this.form.items.splice(index, 1);
                    }, 1);
                },

                removeProductForm(index) {
                    let string = 'formParentProduct' + index;
                    const formParent = document.getElementById(string);
                    formParent.remove();

                    for (let i = index + 1; i <= this.form.products.length; i++) {
                        let el = document.getElementById('formParentProduct' + i);
                        if (el) {
                            this.resetIndexElementProduct(el, i);
                        }
                    }
                    this.indexProduct--;
                    localStorage.setItem('x_form_product', this.indexProduct);

                    setTimeout(() => {
                        this.form.products.splice(index, 1);
                    }, 1);
                },

                renderItemForm(count) {
                    if (count > 0) {
                        for (let i = 1; i <= count; i++) {
                            this.form.items.push({
                                name: '',
                                category_name: '',
                                price: ''
                            });

                            $('#formContainer').append(() => formParent(i));
                        }
                    }
                },

                renderProductForm(count) {
                    if (count > 0) {
                        for (let i = 1; i <= count; i++) {
                            this.form.products.push({
                                name: '',
                                profit: '',
                                weaver_name: '',
                                category_name: '',
                            });

                            $('#formContainerProduct').append(() => formParentProduct(i));
                        }
                    }
                },

                resetIndexElementItem(el, i) {
                    el.id = 'formParent' + (i - 1);
                    el.querySelector('button').id = 'btn-remove-item-' + (i - 1);
                    el.querySelector('button').setAttribute('x-on:click', 'removeItemForm(' + (
                        i - 1) + ')');

                    // Change x-model and name attribute
                    el.querySelector('input[name="items[' + i + '][name]"]').setAttribute(
                        'x-model', 'form.items[' + (i - 1) + '].name');
                    el.querySelector('input[name="items[' + i + '][name]"]').name = 'items[' + (
                            i - 1) +
                        '][name]';
                    el.querySelector('select[name="items[' + i + '][category_name]"]')
                        .setAttribute('x-model', 'form.items[' + (i - 1) + '].category_name');
                    el.querySelector('select[name="items[' + i + '][category_name]"]').name =
                        'items[' + (i -
                            1) + '][category_name]';
                    el.querySelector('input[name="items[' + i + '][price]"]').setAttribute(
                        'x-model', 'form.items[' + (i - 1) + '].price');
                    el.querySelector('input[name="items[' + i + '][price]"]').name = 'items[' +
                        (i - 1) + '][price]';

                    // Change x-if attribute looksgood
                    el.querySelector('template[x-if="isSubmitFormItem && form.items[' + i +
                        '].name"]').setAttribute('x-if', "isSubmitFormItem && form.items[" +
                        (i - 1) + "].name");
                    el.querySelector('template[x-if="isSubmitFormItem && form.items[' + i +
                        '].category_name"]').setAttribute('x-if',
                        "isSubmitFormItem && form.items[" + (i - 1) + "].category_name");
                    el.querySelector('template[x-if="isSubmitFormItem && form.items[' + i +
                        '].price && !isNaN(form.items[' + i + '].price)"]').setAttribute(
                        'x-if',
                        "isSubmitFormItem && form.items[" + (i - 1) +
                        "].price && !isNaN(form.items[" + (
                            i - 1) + "].price)");

                    // Change x-if attribute please fill
                    el.querySelector('template[x-if="isSubmitFormItem && !form.items[' + i +
                        '].name"]').setAttribute('x-if',
                        "isSubmitFormItem && !form.items[" + (i - 1) + "].name");
                    el.querySelector('template[x-if="isSubmitFormItem && !form.items[' + i +
                        '].category_name"]').setAttribute('x-if',
                        "isSubmitFormItem && !form.items[" + (i - 1) + "].category_name");
                    el.querySelector('template[x-if="isSubmitFormItem && !form.items[' + i +
                        '].price"]').setAttribute('x-if',
                        "isSubmitFormItem && !form.items[" + (i - 1) + "].price");

                    // Change x-if attribute price must be number
                    el.querySelector('template[x-if="isSubmitFormItem && form.items[' + i +
                        '].price && isNaN(form.items[' + i + '].price)"]').setAttribute(
                        'x-if', "isSubmitFormItem && form.items[" + (i - 1) +
                        "].price && isNaN(form.items[" + (i - 1) + "].price)");
                },

                resetIndexElementProduct(el, i) {
                    el.id = 'formParentProduct' + (i - 1);
                    el.querySelector('button').id = 'btn-remove-product-' + (i - 1);
                    el.querySelector('button').setAttribute('x-on:click', 'removeProductForm(' + (
                        i - 1) + ')');

                    // Change x-model and name attribute
                    el.querySelector('input[name="products[' + i + '][name]"]').setAttribute(
                        'x-model', 'form.products[' + (i - 1) + '].name');
                    el.querySelector('input[name="products[' + i + '][name]"]').name = 'products[' +
                        (i - 1) + '][name]';
                    el.querySelector('input[name="products[' + i + '][profit]"]').setAttribute(
                        'x-model', 'form.products[' + (i - 1) + '].profit');
                    el.querySelector('input[name="products[' + i + '][profit]"]').name = 'products[' +
                        (i - 1) + '][profit]';
                    el.querySelector('select[name="products[' + i + '][weaver_name]"]').setAttribute(
                        'x-model', 'form.products[' + (i - 1) + '].weaver_name');
                    el.querySelector('select[name="products[' + i + '][weaver_name]"]').name =
                        'products[' + (i - 1) + '][weaver_name]';
                    el.querySelector('input[name="products[' + i + '][category_name]"]').setAttribute(
                        'x-model', 'form.products[' + (i - 1) + '].category_name');
                    el.querySelector('input[name="products[' + i + '][category_name]"]').name =
                        'products[' + (i - 1) + '][category_name]';

                    // Change x-if attribute looksgood
                    el.querySelector('template[x-if="isSubmitFormItem && form.products[' + i +
                        '].name"]').setAttribute('x-if', "isSubmitFormItem && form.products[" +
                        (i - 1) + "].name");
                    el.querySelector('template[x-if="isSubmitFormItem && form.products[' + i +
                        '].profit"]').setAttribute('x-if',
                        "isSubmitFormItem && form.products[" + (i - 1) + "].profit");
                    el.querySelector('template[x-if="isSubmitFormItem && form.products[' + i +
                        '].weaver_name"]').setAttribute('x-if',
                        "isSubmitFormItem && form.products[" + (i - 1) + "].weaver_name");
                    el.querySelector('template[x-if="isSubmitFormItem && form.products[' + i +
                        '].category_name"]').setAttribute('x-if',
                        "isSubmitFormItem && form.products[" + (i - 1) + "].category_name");

                    // Change x-if attribute please fill
                    el.querySelector('template[x-if="isSubmitFormItem && !form.products[' + i +
                        '].name"]').setAttribute('x-if',
                        "isSubmitFormItem && !form.products[" + (i - 1) + "].name");
                    el.querySelector('template[x-if="isSubmitFormItem && !form.products[' + i +
                        '].profit"]').setAttribute('x-if',
                        "isSubmitFormItem && !form.products[" + (i - 1) + "].profit");
                    el.querySelector('template[x-if="isSubmitFormItem && !form.products[' + i +
                        '].weaver_name"]').setAttribute('x-if',
                        "isSubmitFormItem && !form.products[" + (i - 1) + "].weaver_name");
                    el.querySelector('template[x-if="isSubmitFormItem && !form.products[' + i +
                            '].category_name"]')
                        .setAttribute('x-if', "isSubmitFormItem && !form.products[" + (i - 1) +
                            "].category_name");
                },

                dropDownWeaver(index = 0) {
                    let dropDowns = (index === 0 ? document.querySelectorAll('.dropDownWeaver') :
                        document.getElementById('loggingProductWeaverName' + index));

                    fetch('{{ route('admin.dashboard.productions.allWeaverJson') }}')
                        .then(response => response.json())
                        .then(data => {
                            if (dropDowns instanceof NodeList) {
                                dropDowns.forEach(dropDown => {
                                    data.forEach(item => {
                                        dropDown.innerHTML +=
                                            `<option value="${item.name}">${item.name}</option>`;
                                    });
                                });
                            } else {
                                data.forEach(item => {
                                    dropDowns.innerHTML +=
                                        `<option value="${item.name}">${item.name}</option>`;
                                });
                            }
                        });
                },

                resetForm() {
                    this.form = {
                        name: '',
                        date: '',
                        estimate: '',
                        items: [{
                            name: '',
                            category_name: '',
                            price: ''
                        }],
                        products: [{
                            name: '',
                            profit: '',
                            weaver_name: '',
                            category_name: '',
                        }]
                    };

                    localStorage.setItem('x_form_item', 0);
                    localStorage.setItem('x_form_product', 0);
                },

                clearAllItemForm() {
                    if (this.indexItem == 0) {
                        this.showMessage('There is no item to clear', 'error');
                        return;
                    }

                    for (let i = 1; i <= this.indexItem; i++) {
                        const formParent = document.getElementById('formParent' + i);
                        formParent.remove();
                    }

                    resetIndexForm = this.indexItem;
                    setTimeout(() => {
                        this.form.items.splice(1, resetIndexForm);
                    }, 1);

                    this.indexItem = 0;
                    localStorage.setItem('x_form_item', this.indexItem);
                },

                clearAllProductForm() {
                    if (this.indexProduct == 0) {
                        this.showMessage('There is no product to clear', 'error');
                        return;
                    }

                    for (let i = 1; i <= this.indexProduct; i++) {
                        const formParent = document.getElementById('formParentProduct' + i);
                        formParent.remove();
                    }

                    resetIndexForm = this.indexProduct;
                    setTimeout(() => {
                        this.form.products.splice(1, resetIndexForm);
                    }, 1);

                    this.indexProduct = 0;
                    localStorage.setItem('x_form_product', this.indexProduct);
                },

                clearDotFormInput(price) {
                    return price.split('.').join('');
                },

                showMessage(msg = '', type = 'success') {
                    const toast = window.Swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 1000
                    });
                    toast.fire({
                        icon: type,
                        title: msg,
                        padding: '10px 20px'
                    });
                },
            }));
        });
    </script>

    {{-- <script>
        const pickr = Pickr.create({
            el: '.color-picker',
            theme: 'classic', // or 'monolith', or 'nano'
            default: '#42445a',

            components: {

                // Main components
                preview: true,
                opacity: true,
                hue: true,

                // Input / output Options
                interaction: {
                    hex: true,
                    input: true,
                    clear: true,
                    save: true
                }
            }
        });

        pickr.on('change', (color, instance) => {
            const hexColor = color.toHEXA().toString();

            document.querySelector('body').style.backgroundColor = hexColor;
        });
    </script> --}}
@endpush
