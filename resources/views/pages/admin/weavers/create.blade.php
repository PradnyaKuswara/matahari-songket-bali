@extends('layouts.dashboard')

@section('title')
    Create Weaver
@endsection

@section('content')
    <x-dashboard.page-title header="Create Weaver" subtitle="Weaver" :linkSubTitle="route('admin.dashboard.weavers.index')" title="Create"
        :linkTitle="route('admin.dashboard.weavers.create')"></x-dashboard.page-title>

    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12">
            <div class="card bg-white shadow-lg rounded-lg">
                <div class="card-body">
                    <form action="{{ route('admin.dashboard.weavers.store') }}" method="POST">
                        @csrf
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
                                        name="name" value="{{ old('name') }}" minlength="1" maxlength="30"
                                        placeholder="Enter your name">
                                </label>

                                @error('name')
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
                                        type="text" name="phone_number" value="{{ old('phone_number') }}"
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
                                    <option value="men" {{ old('gender') == 'men' ? 'selected' : null }}>Men</option>
                                    <option value="women" {{ old('gender') == 'women' ? 'selected' : null }}>Women
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
                                        value="{{ old('date_of_birth') }}" placeholder="Enter your date" />
                                </label>

                                @error('date_of_birth')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-col lg:flex-row gap-4 mb-4">
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
                                        type="text" name="province" value="{{ old('province') }}" minlength="1"
                                        maxlength="20" placeholder="Enter your province">
                                </label>

                                @error('province')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>
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
                                        name="city" value="{{ old('city') }}" minlength="1" maxlength="20"
                                        placeholder="Enter your city">
                                </label>

                                @error('city')
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
                                        type="text" name="address" value="{{ old('address') }}" minlength="1"
                                        maxlength="100" placeholder="Enter your address">
                                </label>

                                @error('address')
                                    <p class="mt-2 text-error text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <button type="button" data-fc-type="modal" class="btn w-full bg-primary text-white">
                            Submit Form
                        </button>

                        <x-dashboard.confirm-modal title="Create Weaver"
                            description="Are you sure create this data?"></x-dashboard.confirm-modal>
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
