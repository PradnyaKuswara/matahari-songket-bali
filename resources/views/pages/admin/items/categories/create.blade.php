@extends('layouts.dashboard')

@section('title')
    Create Item Category
@endsection

@section('content')
    <x-dashboard.page-title header="Create Item Category" subtitle="Item Category" :linkSubTitle="route('admin.dashboard.items.categories.index')" title="Create"
        :linkTitle="route('admin.dashboard.items.categories.create')"></x-dashboard.page-title>

    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12">
            <div class="card bg-white shadow-lg rounded-lg">
                <div class="card-body">
                    <form action="{{ route('admin.dashboard.items.categories.store') }}" method="POST">
                        @csrf
                        <div class="flex gap-4 mb-4">
                            <div class=" w-full">
                                <label class="form-control w-full max-w-xs" for="loggingName">
                                    <div class="label">
                                        <div>
                                            <span class="label-text">Item Name</span>
                                            <span class="text-error">*</span>
                                        </div>
                                    </div>
                                </label>

                                <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                    <input id="loggingName" type="text" class="form-input grow border-none outline-none "
                                        name="name" value="{{ old('name') }}" placeholder="Enter your item name"
                                        minlength="1" maxlength="50" />
                                </label>

                                @error('name')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <button type="button" data-fc-type="modal" class="btn w-full bg-primary text-white">
                            Submit Form
                        </button>

                        <x-dashboard.confirm-modal title="Create Item Category"
                            description="Are you sure create this data?"></x-dashboard.confirm-modal>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
