@extends('layouts.dashboard')

@section('title')
    Management Log
@endsection

@section('content')
    <x-dashboard.page-title subtitle="Page" title="Management Log"></x-dashboard.page-title>

    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12">
            <div class="card bg-white shadow-lg rounded-lg text-center">
                <div class="card-body">
                    <div class="overflow-x-scroll max-h-[28rem] 2xl:max-h-screen">
                        @include('pages.admin.audits.table')
                    </div>
                    <div class="mt-2">
                        {{ $audits->links('components.dashboard.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
