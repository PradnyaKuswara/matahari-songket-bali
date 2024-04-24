@extends('layouts.dashboard')


@section('title')
    Profile User
@endsection

@section('content')
    <div class="grid lg:grid-cols-6 gap-4">
        <div class="lg:col-span-2">
            <div class="card bg-white shadow-md rounded-sm text-center">
                <div class="card-body">
                    <div class="flex justify-center">
                        <div class="avatar">
                            <div class="w-24 rounded-full">
                                <img src="{{ auth()->user()->avatar ? auth()->user()->avatar() : 'https://eu.ui-avatars.com/api/?name=' . auth()->user()->username . '&size=150' }}"
                                    alt="profile-image">
                            </div>
                        </div>
                    </div>

                    <div class="text-start mt-3">
                        <h4 class="fs-13 text-uppercase">About Me :</h4>
                        <p class="text-muted mb-3">
                            Hi I'm {{ $user->name }}. I'm a customer at Matahari Songket Bali. This is my dashboard panel. I can manage my profile here.
                        </p>
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card -->

            <div class="card bg-white shadow-md rounded-sm mt-4" id="profile-password">
                <div class="card-body">
                    <form action="{{ route('dashboard.profile.update-password') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <h2 class="text-xl mb-4 "><i class="ph-duotone ph-info"></i> Password User
                        </h2>

                        <div class="flex flex-col">
                            <h2>Note:</h2>
                            <p class="text-muted">* If you want to change your password, please fill in the form.</p>
                            <p class="text-muted">* Create a password that is at least 8 characters long.</p>
                            <p class="text-muted">* Avoid using personal information such as your name, date of birth, or
                                phone number as part of the password.</p>
                            <p class="text-muted">* Do not use the same password for various online services.</p>
                        </div>

                        <div class="flex gap-4 mb-4">
                            <div class=" w-full">
                                <label class="form-control w-full max-w-xs" for="loggingPassword">
                                    <div class="label">
                                        <div>
                                            <span class="label-text">Password</span>
                                            <span class="text-error">*</span>
                                        </div>
                                    </div>
                                </label>

                                <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                    <input id="loggingPassword" type="password"
                                        class="form-input grow border-none outline-none " name="password"
                                        value="{{ old('password') }}" placeholder="Enter your password" minlength="1"
                                        maxlength="100" />
                                </label>

                                @error('password')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex gap-4 mb-4">
                            <div class=" w-full">
                                <label class="form-control w-full max-w-xs" for="loggingRePassword">
                                    <div class="label">
                                        <div>
                                            <span class="label-text">Password Confirmation</span>
                                            <span class="text-error">*</span>
                                        </div>
                                    </div>
                                </label>

                                <label class="input input-bordered w-full text-xs md:text-base flex items-center ">
                                    <input id="loggingRePassword" type="password"
                                        class="form-input grow border-none outline-none " name="password_confirmation"
                                        value="{{ old('password_confirmation') }}" minlength="1" maxlength="100"
                                        placeholder="Enter your password confirmation" />
                                </label>

                                @error('password_confirmation')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <button type="button" data-fc-type="modal" class="btn w-full bg-primary text-white">
                            Update Password
                        </button>

                        <x-dashboard.confirm-modal title="Update Password"
                            description="Are you sure change your password?"></x-dashboard.confirm-modal>
                    </form>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="lg:col-span-4">
            <div class="card w-full bg-white shadow-md rounded-sm">
                <div class="card-body">
                    <form action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <h2 class="text-xl mb-4 "><i class="ph-duotone ph-info"></i> Personal Info
                        </h2>

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
                                        name="name" value="{{ $user->name ?? old('name') }}" minlength="1"
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
                                        type="text" name="username" value="{{ $user->username ?? old('username') }}"
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
                                    <option value="men" {{ $user->gender == 'men' ? 'selected' : null }}>Men</option>
                                    <option value="women" {{ $user->gender == 'women' ? 'selected' : null }}>Women
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
                                        value="{{ $user->date_of_birth ?? old('date_of_birth') }}"
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
                                        type="email" name="email" value="{{ $user->email ?? old('email') }}"
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
                                        value="{{ $user->phone_number ?? old('phone_number') }}"
                                        placeholder="Enter your phone number" minlength="10"
                                        maxlength="{{ config('validation.phone_number.maxlength') }}"
                                        pattern="{{ config('validation.phone_number.regex') }}"
                                        onkeypress="return onlyNumberKey(event)">
                                </label>

                                @error('email')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex gap-4 mb-8">
                            <div class=" w-full">
                                <label class="form-control w-full max-w-xs" for="LoggingUsername">
                                    <div class="label">
                                        <span class="label-text">Avatar</span>
                                    </div>
                                </label>
                                <input type="file" name="avatar" class="file-input file-input-bordered w-full"
                                    accept=".jpg, .jpeg, .png" />

                                @error('avatar')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <button type="button" data-fc-type="modal" class="btn w-full bg-primary text-white">
                            Update Profile
                        </button>

                        <x-dashboard.confirm-modal title="Update Profile"
                            description="Are you sure change your profile?"></x-dashboard.confirm-modal>
                    </form>
                </div> <!-- end card body -->
            </div> <!-- end card -->

            <div class="card w-full bg-white shadow-md rounded-sm mt-4" id="profile-address">
                <div class="card-body">
                    <form action="{{ route('dashboard.profile.update-address') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <h2 class="text-xl mb-4 "><i class="ph-duotone ph-info"></i> Address
                        </h2>

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
                                        type="text" name="country" value="{{ $user->country ?? old('country') }}"
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
                                        type="text" name="province" value="{{ $user->province ?? old('province') }}"
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
                                    <input id="LoggingCity" class="form-input grow border-none outline-none"
                                        type="text" name="city" value="{{ $user->city ?? old('city') }}"
                                        minlength="1" maxlength="20" placeholder="Enter your city">
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
                                        value="{{ $user->postal_code ?? old('postal_code') }}" minlength="1"
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
                                        type="text" name="address" value="{{ $user->address ?? old('address') }}"
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
                                        value="{{ $user->additional_information ?? old('additional_information') }}"
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

                        <x-dashboard.confirm-modal title="Update Address"
                            description="Are you sure change your address?"></x-dashboard.confirm-modal>
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
