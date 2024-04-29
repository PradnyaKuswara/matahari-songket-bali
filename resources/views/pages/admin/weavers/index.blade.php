@extends('layouts.dashboard')

@section('title')
    Management Weaver
@endsection

@section('content')
    <x-dashboard.page-title header="Management Weaver" subtitle="Weaver" :linkSubTitle="route('admin.dashboard.weavers.index')" title="Index"
        :linkTitle="route('admin.dashboard.weavers.index')"></x-dashboard.page-title>

    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12">
            <div class="card bg-white shadow-lg rounded-lg text-center">
                <div class="card-body">
                    <div class="card-actions mb-4 items-center w-full justify-between">
                        <a href="{{ route('admin.dashboard.weavers.create') }}"
                            class="btn btn-md bg-neutral w-full md:w-48 text-white hover:text-black">+ Create Data</a>
                        <label class="input input-bordered input-md w-full md:w-80  flex items-center gap-2">
                            <input type="text" id="search" class="form-input grow border-none outline-none "
                                placeholder="Search by keyword"
                                @if (session('keyword')) value="{{ session('keyword') }}" @endif />
                            <span class="mdi mdi-magnify"></span>
                        </label>
                    </div>
                    <div id="table" class="overflow-x-scroll max-h-[28rem] 2xl:max-h-screen">
                        @include('pages.admin.weavers.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/search.js') }}"></script>
    <script>
        search("search", "table", "{{ url('admin/dashboard/weavers/search?') }}")
    </script>
@endpush
