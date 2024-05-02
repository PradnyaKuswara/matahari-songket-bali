@extends('layouts.dashboard')

@section('title')
    Edit Customer
@endsection

@section('content')
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Customer</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Edit</span>
            </li>
        </ul>

        <div class="grid grid-cols-12 gap-4 mt-5">
            <div class="col-span-12">
                <div class="panel">
                    <form action="{{ route('admin.dashboard.customers.update', $customer) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="flex flex-col lg:flex-row gap-4 mb-4">
                            <div class=" w-full">
                                <label class="form-control w-full max-w-xs" for="LoggingName">
                                    <div class="label">
                                        <div>
                                            <span class="label-text">Name</span>
                                            <span class="text-error">*</span>
                                        </div>

                                    </div>
                                </label>

                                <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                    <input id="LoggingName" class="form-input grow border-none outline-none" type="text"
                                        name="name" value="{{ old('name') ?? $customer->name }}" minlength="1"
                                        maxlength="30" placeholder="Enter your name">
                                </label>

                                @error('name')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class=" w-full">
                                <label class="form-control w-full max-w-xs" for="LoggingUsername">
                                    <div class="label">
                                        <div>
                                            <span class="label-text">User Name</span>
                                            <span class="text-error">*</span>
                                        </div>

                                    </div>
                                </label>
                                <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                    <input id="LoggingUsername" class="form-input grow border-none outline-none"
                                        type="text" name="username" value="{{ old('username') ?? $customer->username }}"
                                        minlength="1" maxlength="15" placeholder="Enter your username">
                                </label>

                                @error('username')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col lg:flex-row gap-4 mb-4">
                            <div class=" w-full">
                                <label class="form-control w-full max-w-xs" for="LoggingGender">
                                    <div class="label">
                                        <div>
                                            <span class="label-text">Gender</span>
                                        </div>
                                    </div>
                                </label>
                                <select id="LoggingGender" name="gender" class="select w-full select-bordered">
                                    <option disabled selected>Pick one</option>
                                    <option value="men"
                                        {{ $customer->gender == 'men' ? 'selected' : (old('gender') == 'men' ? 'selected' : null) }}>
                                        Men</option>
                                    <option value="women"
                                        {{ $customer->gender == 'women' ? 'selected' : (old('gender') == 'women' ? 'selected' : null) }}>
                                        Women
                                    </option>
                                </select>

                                @error('gender')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class=" w-full">
                                <label class="form-control w-full max-w-xs" for="loggingDateOfBirth">
                                    <div class="label">
                                        <div>
                                            <span class="label-text">Date Of Birth</span>
                                        </div>
                                    </div>
                                </label>

                                <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                    <input id="loggingDateOfBirth" type="date"
                                        class="form-input grow border-none outline-none " name="date_of_birth"
                                        value="{{ old('date_of_birth') ?? $customer->date_of_birth }}"
                                        placeholder="Enter your date" />
                                </label>

                                @error('date_of_birth')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col lg:flex-row gap-4 mb-4">
                            <div class=" w-full">
                                <label class="form-control w-full max-w-xs" for="LoggingEmailAddress">
                                    <div class="label">
                                        <div>
                                            <span class="label-text">Email</span>
                                            <span class="text-error">*</span>
                                        </div>
                                    </div>
                                </label>

                                <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                    <input id="LoggingEmailAddress" class="form-input grow border-none outline-none "
                                        type="email" name="email" value="{{ old('email') ?? $customer->email }}"
                                        minlength="1" maxlength="100" placeholder="Enter your email">
                                </label>

                                @error('email')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class=" w-full">
                                <label class="form-control w-full max-w-xs" for="LoggingPhoneNumber">
                                    <div class="label">
                                        <div>
                                            <span class="label-text">Phone Number (08)</span>
                                        </div>
                                    </div>
                                </label>

                                <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                    <input id="LoggingPhoneNumber" class="form-input grow border-none outline-none "
                                        type="text" name="phone_number"
                                        value="{{ old('phone_number') ?? $customer->phone_number }}"
                                        placeholder="Enter your phone number" minlength="10"
                                        maxlength="{{ config('validation.phone_number.maxlength') }}"
                                        pattern="{{ config('validation.phone_number.regex') }}"
                                        onkeypress="return onlyNumberKey(event)">
                                </label>

                                @error('phone_number')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div x-data="modal">
                            <button type="button" class="btn btn-primary btn-sm w-full lg:w-44 border-none"
                                @click="toggle">Submit Form</button>
                            <x-dashboard.confirm-modal-action modalId="edit-data" title="Edit Customer"
                                description="Are you sure edit this data?"></x-dashboard.confirm-modal-action>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('assets/js/max-input.js') }}"></script>
    <script>
        function onlyNumberKey(event) {
            const ASCIICode = (event.which) ? event.which : event.keyCode

            return !(ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57));
        }

        const inputPhoneNumber = document.getElementById('telp')
        const maxlength = inputPhoneNumber.getAttribute('maxlength')

        maxInputValue(inputPhoneNumber, maxlength)
    </script>
@endpush
