@extends('layouts.dashboard')


@section('title')
    All Transactions
@endsection

@section('content')
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Dashboard</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Invoices</span>
            </li>
        </ul>

        <div>
            <div class="flex flex-col lg:flex-row gap-4 lg:justify-between lg:items-center">
                <h2 class="text-xl font-semibold mt-4">All Transactions</h2>
                <label
                    class="input input-bordered input-md w-full md:w-80  flex items-center gap-2  text-white bg-[#0E1726]">
                    <input type="text" id="search" class="form-input grow border-none outline-none  text-white"
                        placeholder="Search by invoice id"
                        @if (session('keyword')) value="{{ session('keyword') }}" @endif />
                    <span class="mdi mdi-magnify"></span>
                </label>
            </div>
            <div id="data-list" class="grid lg:grid-cols-4 gap-4 mt-4" id="order-list">
                @include('pages.admin-seller.transactions.data')
            </div>
            <div class="mt-5">
                {{ $transactions->links('components.dashboard.pagination') }}
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/search.js') }}"></script>
    <script>
        search("search", "data-list", "{{ url(request()->user()->role->name . '/dashboard/transactions/search?') }}")
    </script>
@endpush
