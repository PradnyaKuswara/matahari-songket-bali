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
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1 ">
                <a href="{{ route('admin.dashboard.customers.showMenu', $addresses->first()->user->id) }}"
                    class="text-primary hover:underline">Menu</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Address</span>
            </li>
        </ul>

        <div class="grid grid-cols-12 gap-4 mt-5">
            <div class="col-span-12">
                <div id="item">
                    @include('pages.customer.addresses.list')
                </div>
            </div>
        </div>
    </div>
@endsection
