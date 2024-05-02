@extends('layouts.dashboard')

@section('title')
    Management Weaver
@endsection

@section('content')
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Weaver</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Index</span>
            </li>
        </ul>

        <div class="mt-5">
            <div class="panel">
                <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
                    <a href="{{ route('admin.dashboard.weavers.create') }}"
                        class="btn btn-neutral text-white border-none w-full lg:w-32 btn-md rounded-md">+ Create
                        Data</a>
                    <label class="input input-bordered input-md w-full md:w-80  flex items-center gap-2 text-white bg-[#0E1726] ">
                        <input type="text" id="search" class="form-input grow border-none outline-none text-white "
                            placeholder="Search by keyword"
                            @if (session('keyword')) value="{{ session('keyword') }}" @endif />
                        <span class="mdi mdi-magnify"></span>
                    </label>
                </div>
                <div id="table" class="overflow-x-scroll max-h-[28rem] 2xl:max-h-screen mt-4">
                    @include('pages.admin.weavers.table')
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
