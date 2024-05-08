@extends('layouts.dashboard')

@section('title')
    Management Product Post
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />
@endpush

@section('content')
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Product Post</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Index</span>
            </li>
        </ul>

        <div class="grid grid-cols-12 gap-4 mt-5">
            <div class="col-span-12">
                <div class="panel">
                    <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
                        <div class="w-full" x-data="modalCreate">
                            <label for="modal_create" class="btn btn-primary w-full lg:w-32" @click="toggle()">+ Create
                                Data</label>

                            <x-dashboard.create-modal :elements="[
                                [
                                    'name' => 'name',
                                    'id' => 'inputName',
                                    'label' => 'Name',
                                    'type' => 'text',
                                    'placeholder' => 'Enter your product name',
                                    'is_required' => 'true',
                                ],
                                [
                                    'name' => 'product_category_id',
                                    'id' => 'inputCategory',
                                    'label' => 'Select Category',
                                    'type' => 'select',
                                    'options' => $productCategories,
                                    'is_required' => 'true',
                                ],
                                [
                                    'name' => 'stock',
                                    'id' => 'inputStock',
                                    'label' => 'Stock',
                                    'type' => 'number',
                                    'placeholder' => 'Enter your product stock',
                                    'is_required' => 'true',
                                ],
                                [
                                    'name' => 'goods_price',
                                    'id' => 'inputGoodsPrice',
                                    'label' => 'Goods Price',
                                    'type' => 'number',
                                    'placeholder' => 'Enter your product goods price',
                                    'is_required' => 'true',
                                ],
                                [
                                    'name' => 'sell_price',
                                    'id' => 'inputSellPrice',
                                    'label' => 'Sell Price',
                                    'type' => 'number',
                                    'placeholder' => 'Enter your product sell price',
                                    'is_required' => 'true',
                                ],
                                [
                                    'name' => 'color',
                                    'id' => 'inputColor',
                                    'label' => 'Color',
                                    'type' => 'text',
                                    'class' => 'color-picker',
                                    'placeholder' => 'Enter your product color',
                                    'is_required' => 'true',
                                ],
                                [
                                    'name' => 'image_1',
                                    'id' => 'inputImage1',
                                    'label' => 'Image 1',
                                    'type' => 'file',
                                    'placeholder' => 'Choose your product image 1',
                                    'is_required' => 'true',
                                    'accept' => '.jpg, .jpeg, .png',
                                ],
                                [
                                    'name' => 'image_2',
                                    'id' => 'inputImage2',
                                    'label' => 'Image 2',
                                    'type' => 'file',
                                    'placeholder' => 'Choose your product image 2',
                                    'is_required' => 'false',
                                    'accept' => '.jpg, .jpeg, .png',
                                ],
                                [
                                    'name' => 'image_3',
                                    'id' => 'inputImage3',
                                    'label' => 'Image 3',
                                    'type' => 'file',
                                    'placeholder' => 'Choose your product image 3',
                                    'is_required' => 'false',
                                    'accept' => '.jpg, .jpeg, .png',
                                ],
                                [
                                    'name' => 'image_4',
                                    'id' => 'inputImage4',
                                    'label' => 'Image 4',
                                    'type' => 'file',
                                    'placeholder' => 'Choose your product image 4',
                                    'is_required' => 'false',
                                    'accept' => '.jpg, .jpeg, .png',
                                ],
                                [
                                    'name' => 'description',
                                    'id' => 'inputDescription',
                                    'label' => 'Description',
                                    'type' => 'textarea',
                                    'placeholder' => 'Enter your product description',
                                    'is_required' => 'true',
                                ],
                            ]" route="{{ request()->user()->role->name }}.dashboard.products.store"
                                title="Create Product Post"></x-dashboard.create-modal>
                        </div>

                        <label
                            class="input input-bordered input-md w-full md:w-80  flex items-center gap-2  text-white bg-[#0E1726]">
                            <input type="text" id="search"
                                class="form-input grow border-none outline-none  text-white" placeholder="Search by keyword"
                                @if (session('keyword')) value="{{ session('keyword') }}" @endif />
                            <span class="mdi mdi-magnify"></span>
                        </label>


                    </div>
                    <div id="table" class="overflow-x-scroll max-h-[28rem] 2xl:max-h-screen mt-4">
                        @include('pages.admin-seller.products.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/search.js') }}"></script>
    <script>
        search("search", "table", "{{ url(request()->user()->role->name . '/dashboard/products/search?') }}")
    </script>
@endpush
