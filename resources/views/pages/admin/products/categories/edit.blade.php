@extends('layouts.dashboard')

@section('title')
    Edit Product Category
@endsection

@section('content')
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Product Category</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Edit</span>
            </li>
        </ul>

        <div class="grid grid-cols-12 gap-4 mt-5">
            <div class="col-span-12">
                <div class="panel">
                    <form action="{{ route('admin.dashboard.products.categories.update', $productCategory->id) }}"
                        method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="flex gap-4 mb-4">
                            <div class=" w-full">
                                <label class="form-control w-full max-w-xs" for="loggingName">
                                    <div class="label">
                                        <div>
                                            <span class="label-text">Product Category Name</span>
                                            <span class="text-error">*</span>
                                        </div>
                                    </div>
                                </label>

                                <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                    <input id="loggingName" type="text" class="form-input grow border-none outline-none "
                                        name="name" value="{{ old('name') ?? $productCategory->name }}"
                                        placeholder="Enter your item name" minlength="1" maxlength="50" />
                                </label>

                                @error('name')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div x-data="modal">
                            <button type="button" class="btn btn-primary btn-sm w-full lg:w-44 border-none"
                                @click="toggle">Submit Form</button>
                            <x-dashboard.confirm-modal-action modalId="edit-data" title="Edit Product Category"
                                description="Are you sure edit this data?"></x-dashboard.confirm-modal-action>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
