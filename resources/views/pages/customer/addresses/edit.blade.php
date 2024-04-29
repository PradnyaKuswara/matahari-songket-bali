@extends('layouts.dashboard')

@section('title')
    Edit Address
@endsection

@section('content')
    <x-dashboard.page-title header="Create Address" subtitle="Address" :linkSubTitle="route('customer.dashboard.address.index')" title="Edit"
        :linkTitle="route('customer.dashboard.address.edit', $address)"></x-dashboard.page-title>

    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12">
            <div class="card bg-white shadow-lg rounded-lg">
                <div class="card-body">
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
                                        type="text" name="country" value="{{ $address->country ?? old('country') }}"
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
                                        type="text" name="province" value="{{ $address->province ?? old('province') }}"
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
                                        name="city" value="{{ $address->city ?? old('city') }}" minlength="1"
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
                                        value="{{ $address->postal_code ?? old('postal_code') }}" minlength="1" maxlength="10"
                                        placeholder="Enter your postal code">
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
                                        type="text" name="address" value="{{ $address->address ?? old('address') }}"
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
                                        value="{{ $address->additional_information ?? old('additional_information') }}"
                                        minlength="1" maxlength="100" placeholder="Enter your additional information">
                                </label>

                                @error('additional_information')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <button type="button" data-fc-type="modal" class="btn w-full bg-primary text-white">
                            Update Address
                        </button>

                        <x-dashboard.confirm-modal title="Edit Address"
                            description="Are you sure change your address?"></x-dashboard.confirm-modal>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
