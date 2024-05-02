@extends('layouts.dashboard')

@section('title')
    Edit Address
@endsection

@section('content')
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Customer</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Address</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Edit</span>
            </li>
        </ul>

        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12">
                <div class="panel">
                    <form action="{{ route('customer.dashboard.address.update', $address->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="flex flex-col">
                            <h2>Note:</h2>
                            <p class="text-muted">* If you want to change your address, please fill in the form.</p>
                            <p class="text-muted">* Ensure that the address you provide is accurate and complete.</p>
                            <p class="text-muted">* We appreciate your honesty in filling out this form, as it will help
                                facilitate a smoother and more accurate delivery process.</p>
                        </div>

                        <div class="flex flex-col lg:flex-row gap-4 mt-4 mb-4">
                            <div class=" w-full">
                                <label class="form-control w-full max-w-xs" for="LoggingCountry">
                                    <div class="label">
                                        <div>
                                            <span class="label-text">Country</span>
                                            <span class="text-error">*</span>
                                        </div>

                                    </div>
                                </label>

                                <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                    <input id="LoggingCountry" class="form-input grow border-none outline-none"
                                        type="text" name="country" value="{{ old('country') ?? $address->country }}"
                                        minlength="1" maxlength="20" placeholder="Enter your country">
                                </label>

                                @error('country')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class=" w-full">
                                <label class="form-control w-full max-w-xs" for="LoggingProvince">
                                    <div class="label">
                                        <div>
                                            <span class="label-text">Province</span>
                                            <span class="text-error">*</span>
                                        </div>
                                    </div>
                                </label>
                                <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                    <input id="LoggingProvince" class="form-input grow border-none outline-none"
                                        type="text" name="province" value="{{ old('province') ?? $address->province }}"
                                        minlength="1" maxlength="20" placeholder="Enter your province">
                                </label>

                                @error('province')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col lg:flex-row gap-4 mb-4">
                            <div class=" w-full">
                                <label class="form-control w-full max-w-xs" for="LoggingCity">
                                    <div class="label">
                                        <div>
                                            <span class="label-text">City</span>
                                            <span class="text-error">*</span>
                                        </div>
                                    </div>
                                </label>

                                <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                    <input id="LoggingCity" class="form-input grow border-none outline-none" type="text"
                                        name="city" value="{{ old('city') ?? $address->city }}" minlength="1"
                                        maxlength="20" placeholder="Enter your city">
                                </label>

                                @error('city')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class=" w-full">
                                <label class="form-control w-full max-w-xs" for="LoggingPostalCode">
                                    <div class="label">
                                        <div>
                                            <span class="label-text">Postal Code</span>
                                            <span class="text-error">*</span>
                                        </div>
                                    </div>
                                </label>
                                <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                    <input id="LoggingPostalCode" class="form-input grow border-none outline-none"
                                        type="text" name="postal_code"
                                        value="{{ old('postal_code') ?? $address->postal_code }}" minlength="1"
                                        maxlength="10" placeholder="Enter your postal code">
                                </label>

                                @error('postal_code')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex gap-4 mb-4">
                            <div class=" w-full">
                                <label class="form-control w-full max-w-xs" for="LoggingAddress">
                                    <div class="label">
                                        <div>
                                            <span class="label-text">Address</span>
                                            <span class="text-error">*</span>
                                        </div>
                                    </div>
                                </label>
                                <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                    <input id="LoggingAddress" class="form-input grow border-none outline-none"
                                        type="text" name="address" value="{{ old('address') ?? $address->address }}"
                                        minlength="1" maxlength="100" placeholder="Enter your address">
                                </label>

                                @error('address')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex gap-4 mb-4">
                            <div class=" w-full">
                                <label class="form-control w-full max-w-xs" for="LoggingAdditional">
                                    <div class="label">
                                        <div>
                                            <span class="label-text">Additional information</span>
                                            <span class="text-error">*</span>
                                        </div>
                                    </div>
                                </label>
                                <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                    <input id="LoggingAdditional" class="form-input grow border-none outline-none"
                                        type="text" name="additional_information"
                                        value="{{ old('additional_information') ?? $address->additional_information }}"
                                        minlength="1" maxlength="100" placeholder="Enter your additional information">
                                </label>

                                @error('additional_information')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div x-data="modal">
                            <button type="button" class="btn btn-primary btn-sm w-full lg:w-44 border-none"
                                @click="toggle">Submit Form</button>
                            <x-dashboard.confirm-modal-action modalId="edit-data" title="Edit Customer Address"
                                description="Are you sure edit this data?"></x-dashboard.confirm-modal-action>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
