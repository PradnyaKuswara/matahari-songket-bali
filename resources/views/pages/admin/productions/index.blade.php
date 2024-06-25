@extends('layouts.dashboard')

@section('title')
    Management Production
@endsection

@section('content')
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Production</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Index</span>
            </li>
        </ul>

        <div class="grid grid-cols-12 gap-4 mt-5">
            <div class="col-span-12">
                <div class="panel">
                    <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
                        <a href="{{ route('admin.dashboard.productions.create') }}"
                            class="btn btn-primary text-white border-none w-full lg:w-32 btn-md rounded-md">+ Create
                            Data</a>
                        <label
                            class="input input-bordered input-md w-full md:w-80  flex items-center gap-2 border border-primary focus::border-primary dark:bg-black ">
                            <input type="text" id="search"
                                class="grow border-none outline-none text-black dark:text-white"
                                placeholder="Search by keyword"
                                @if (session('keyword')) value="{{ session('keyword') }}" @endif />
                            <span class="mdi mdi-magnify"></span>
                        </label>
                    </div>
                    <div id="table" class="overflow-x-scroll max-h-[28rem] 2xl:max-h-screen mt-4">
                        @include('pages.admin.productions.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/search.js') }}"></script>
    <script>
        search("search", "table", "{{ url('admin/dashboard/productions/search?') }}")
        localStorage.removeItem('x_form_item')
        localStorage.removeItem('x_form_product')
    </script>
@endpush
