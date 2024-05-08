@extends('layouts.dashboard')

@section('title')
    Menu Customer
@endsection

@section('content')
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="{{ route('admin.dashboard.customers.index') }}" class="text-primary hover:underline">Customer</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Show</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Menu</span>
            </li>
        </ul>

        <div class="mt-5">
            <div
                class="grid lg:grid-cols-3 lg:max-w-screen-lg lg:mx-auto lg:place-items-center lg:place-content-center gap-4">
                <a href="{{ route('admin.dashboard.customers.showAddress', $customer) }}" class="w-full">
                    <div
                        class="max-w-[24rem] w-full bg-white hover:bg-neutral shadow-[4px_6px_10px_-3px_#bfc9d4] rounded border border-[#e0e6ed] dark:border-[#1b2e4b] dark:bg-[#191e3a] dark:shadow-none">
                        <div class="py-7 px-6 ">
                            {{-- <div class="bg-primary mb-5 inline-block p-3 text-[#f1f2f3] rounded-full">

                            </div> --}}
                            <span class="mdi mdi-map-marker-outline text-xl text-primary mb-8"></span>
                            <h5 class="text-[#3b3f5c] hover:text-white  text-xl font-semibold mb-4 dark:text-white-light">
                                Address</h5>
                            <p class="text-white-dark hover:text-white ">Manage your address customer</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.dashboard.customers.showAddress', $customer) }}" class="w-full">
                    <div
                        class="max-w-[24rem] w-full bg-white hover:bg-neutral shadow-[4px_6px_10px_-3px_#bfc9d4] rounded border border-[#e0e6ed] dark:border-[#1b2e4b] dark:bg-[#191e3a] dark:shadow-none">
                        <div class="py-7 px-6 ">
                            <span class="mdi mdi-map-marker-outline text-xl text-primary mb-8"></span>
                            <h5 class="text-[#3b3f5c] hover:text-white  text-xl font-semibold mb-4 dark:text-white-light">
                                Reset Password</h5>
                            <p class="text-white-dark hover:text-white ">Reset your password customer</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
