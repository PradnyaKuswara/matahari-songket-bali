@extends('layouts.dashboard')

@section('title')
    History Log
@endsection

@section('content')
    <x-dashboard.page-title header="History Log" subtitle="Log" :linkSubTitle="route('admin.dashboard.logs.index')" title="Index"
        :linkTitle="route('admin.dashboard.logs.index')"></x-dashboard.page-title>

    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12">
            <div class="card bg-white shadow-lg rounded-lg text-center">
                <div class="card-body">
                    <div class="overflow-x-scroll max-h-[28rem] 2xl:max-h-screen">
                        @include('pages.admin.audits.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
