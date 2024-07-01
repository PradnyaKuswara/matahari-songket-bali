@extends('layouts.dashboard')

@section('title')
    Management Production
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />
    <script src="{{ asset('assets/js/preview.js') }}"></script>
@endpush

@section('content')
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Production *{{ $production->name }}</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Show</span>
            </li>
        </ul>

        <div class="grid grid-cols-12 gap-4 mt-5">
            <div class="col-span-12">
                <div class="panel">
                    <h5 class="text-lg font-semibold dark:text-white-light">Item Expanditure</h5>
                    <div id="table-item" class="overflow-x-scroll max-h-[28rem] 2xl:max-h-screen mt-4">
                        @include('pages.admin.items.table')
                    </div>

                </div>
                <div class="panel">
                    <h5 class="text-lg font-semibold dark:text-white-light">Product Production</h5>
                    <div id="table-item" class="overflow-x-scroll max-h-[28rem] 2xl:max-h-screen mt-4">
                        @include('pages.admin.products.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
