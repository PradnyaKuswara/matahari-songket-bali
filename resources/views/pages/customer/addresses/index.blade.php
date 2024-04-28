@extends('layouts.dashboard')


@section('title')
    User Address
@endsection

@section('content')
    <x-dashboard.page-title header="Management Address" subtitle="Address" :linkSubTitle="route('customer.dashboard.address.index')" title="Index"
        :linkTitle="route('customer.dashboard.address.index')"></x-dashboard.page-title>

    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12">
            <div class="card-actions mb-4 items-center w-full justify-end">
                <a href="{{ route('customer.dashboard.address.create') }}"
                    class="btn btn-md bg-neutral text-white w-full md:w-48 hover:text-black">+ Create New Address</a>
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
@endsection
