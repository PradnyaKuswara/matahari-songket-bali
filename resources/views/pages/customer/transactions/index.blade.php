@extends('layouts.dashboard')


@section('title')
    Transactions
@endsection

@section('content')
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Customer</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Transactions</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Index</span>
            </li>
        </ul>

        <div>
            <h2 class="text-xl font-semibold mt-4">Transaction Pending</h2>
            <div class="grid mx-auto lg:grid-cols-4 gap-4 mt-4" id="order-list">
                @forelse ($transactionPendings as $transaction)
                    <x-dashboard.transaction :order="$transaction->order"></x-dashboard.transaction>
                @empty
                    <div class="card col-span-4">
                        <div class="card-body bg-white">
                            <div class="text-center">
                                <p class="text-lg">There is no orders</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="mt-5">
                {{ $transactionPendings->links('components.dashboard.pagination') }}
            </div>
        </div>

        <div>
            <h2 class="text-xl font-semibold mt-8">All Transaction</h2>
            <div class="grid grid-cols-4 gap-4 mt-4" id="order-list">
                @forelse ($transactions as $transaction)
                    <x-dashboard.transaction :order="$transaction->order"></x-dashboard.transaction>
                @empty
                    <div class="card col-span-4">
                        <div class="card-body bg-white">
                            <div class="text-center">
                                <p class="text-lg">There is no orders</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="mt-5">
                {{ $transactions->links('components.dashboard.pagination') }}
            </div>
        </div>

    </div>
@endsection
