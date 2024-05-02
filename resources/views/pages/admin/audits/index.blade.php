@extends('layouts.dashboard')

@section('title')
    History Log
@endsection

@section('content')
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Audit</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Index</span>
            </li>
        </ul>

        <div class="mt-5">
            <div class="panel">
                <div id="table" class="overflow-x-scroll max-h-[28rem] 2xl:max-h-screen mt-4">
                    @include('pages.admin.audits.table')
                </div>
            </div>
        </div>
    </div>
@endsection
