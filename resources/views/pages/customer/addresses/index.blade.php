@extends('layouts.dashboard')


@section('title')
    User Address
@endsection

@section('content')
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Customer</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Address</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Index</span>
            </li>
        </ul>

        <div class="grid grid-cols-12 gap-4 mt-5">
            <div class="col-span-12">
                <div class="card-actions mb-4 items-center w-full justify-end">
                    <a href="{{ route('admin.dashboard.weavers.create') }}"
                        class="btn btn-neutral text-white border-none w-full lg:w-32 btn-md rounded-md">+ Create
                        Data</a>
                    {{-- <label class="input input-bordered input-md w-full md:w-80  flex items-center gap-2">
                    <input type="text" id="search" class="form-input grow border-none outline-none "
                        placeholder="Search" @if (session('keyword')) value="{{ session('keyword') }}" @endif />
                    <span class="mdi mdi-magnify"></span>
                </label> --}}
                </div>
                <div id="item">
                    @include('pages.customer.addresses.list')
                </div>
            </div>
        </div>
    </div>
@endsection
