@extends('layouts.dashboard')

@section('title')
    Management Product Category
@endsection

@section('content')
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Product Category</a>
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
                            <label for="modal_create" class="btn btn-primary w-full lg:w-32" @click="toggle()">+ Create Data</label>

                            <x-dashboard.create-modal :elements="[
                                [
                                    'name' => 'name',
                                    'id' => 'inputName',
                                    'label' => 'Input Name',
                                    'type' => 'text',
                                    'placeholder' => 'Enter your product name',
                                    'is_required' => 'true',
                                ],
                            ]" route="{{ request()->user()->role->name }}.dashboard.products.categories.store"
                                title="Create Product Category"></x-dashboard.create-modal>
                        </div>
                        <label
                            class="input input-bordered input-md w-full md:w-80  flex items-center gap-2 text-white bg-[#0E1726]">
                            <input type="text" id="search"
                                class="form-input grow border-none outline-none text-white " placeholder="Search by keyword"
                                @if (session('keyword')) value="{{ session('keyword') }}" @endif />
                            <span class="mdi mdi-magnify"></span>
                        </label>
                    </div>
                    <div id="table" class="overflow-x-scroll max-h-[28rem] 2xl:max-h-screen mt-4">
                        @include('pages.admin-seller.products.categories.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/search.js') }}"></script>
    <script>
        search("search", "table", "{{ url(request()->user()->role->name . '/dashboard/products/categories/search?') }}")
    </script>
@endpush
