@extends('layouts.dashboard')

@section('title')
    Management Product Category
@endsection

@section('content')
    <x-dashboard.page-title header="Management Product Category" subtitle="Product Category" :linkSubTitle="route('admin.dashboard.products.categories.index')" title="index"
        :linkTitle="route('admin.dashboard.products.categories.index')"></x-dashboard.page-title>

    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12">
            <div class="card bg-white shadow-lg rounded-lg text-center">
                <div class="card-body">
                    <div class="card-actions mb-4 items-center justify-between">
                        <a href="{{ route('admin.dashboard.products.categories.create') }}"
                            class="btn btn-md bg-neutral text-white hover:text-black">+ Create Data</a>
                        <label class="input input-bordered input-md  flex items-center gap-2">
                            <input type="text" id="search" class="form-input grow border-none outline-none"
                                placeholder="Search"
                                @if (session('keyword')) value="{{ session('keyword') }}" @endif />
                            <span class="mdi mdi-magnify"></span>
                        </label>
                    </div>
                    <div id="table" class="overflow-x-scroll max-h-[28rem] 2xl:max-h-screen">
                        @include('pages.admin.products.categories.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/search.js') }}"></script>
    <script>
        search("search", "table", "{{ url('admin/dashboard/products/categories/search?') }}")
    </script>
@endpush
