@extends('layouts.dashboard')


@section('title')
    Profile User
@endsection

@section('content')
    <!-- start main content section -->
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Users</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Profile</span>
            </li>
        </ul>
        <div class="pt-5">
            <div class="mb-5 grid grid-cols-1 gap-5 lg:grid-cols-3 xl:grid-cols-4">
                <div class="panel">
                    <div class="mb-5 flex items-center justify-between">
                        <h5 class="text-lg font-semibold dark:text-white-light">Profile</h5>
                    </div>
                    <div class="mb-5 my-auto mx-auto">
                        <div class="flex flex-col items-center justify-center">
                            <img src="{{ auth()->user()->avatar ? auth()->user()->avatar() : 'https://eu.ui-avatars.com/api/?name=' . auth()->user()->username . '&size=150' }}"
                                alt="image" class="mb-5 h-24 w-24 rounded-full object-cover" />

                        </div>

                        <div>
                            <p class="text-muted mb-3">
                                Hi I'm {{ $user->name }}. I'm a {{ $user->role->name }} at Matahari Songket Bali. This is my dashboard
                                panel.
                                I can manage my profile here.
                            </p>
                            <p class="text-xl font-semibold text-primary">{{ $user->username }}</p>
                        </div>

                        <ul class=" mt-5 flex max-w-[200px] flex-col space-y-4 font-semibold text-white-dark">
                            <li class="flex items-center gap-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0">
                                    <path
                                        d="M2.3153 12.6978C2.26536 12.2706 2.2404 12.057 2.2509 11.8809C2.30599 10.9577 2.98677 10.1928 3.89725 10.0309C4.07094 10 4.286 10 4.71612 10H15.2838C15.7139 10 15.929 10 16.1027 10.0309C17.0132 10.1928 17.694 10.9577 17.749 11.8809C17.7595 12.057 17.7346 12.2706 17.6846 12.6978L17.284 16.1258C17.1031 17.6729 16.2764 19.0714 15.0081 19.9757C14.0736 20.6419 12.9546 21 11.8069 21H8.19303C7.04537 21 5.9263 20.6419 4.99182 19.9757C3.72352 19.0714 2.89681 17.6729 2.71598 16.1258L2.3153 12.6978Z"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <path opacity="0.5"
                                        d="M17 17H19C20.6569 17 22 15.6569 22 14C22 12.3431 20.6569 11 19 11H17.5"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <path opacity="0.5"
                                        d="M10.0002 2C9.44787 2.55228 9.44787 3.44772 10.0002 4C10.5524 4.55228 10.5524 5.44772 10.0002 6"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M4.99994 7.5L5.11605 7.38388C5.62322 6.87671 5.68028 6.0738 5.24994 5.5C4.81959 4.9262 4.87665 4.12329 5.38382 3.61612L5.49994 3.5"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M14.4999 7.5L14.6161 7.38388C15.1232 6.87671 15.1803 6.0738 14.7499 5.5C14.3196 4.9262 14.3767 4.12329 14.8838 3.61612L14.9999 3.5"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                {{ $user->name }}
                            </li>
                            <li class="flex items-center gap-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0">
                                    <path
                                        d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12V14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14V12Z"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <path opacity="0.5" d="M7 4V2.5" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" />
                                    <path opacity="0.5" d="M17 4V2.5" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" />
                                    <path opacity="0.5" d="M2 9H22" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" />
                                </svg>
                                {{ $user->date_of_birth ?? '-' }}
                            </li>
                            <li>
                                <a href="javascript:;" class="flex items-center gap-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0">
                                        <path opacity="0.5"
                                            d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12Z"
                                            stroke="currentColor" stroke-width="1.5" />
                                        <path
                                            d="M6 8L8.1589 9.79908C9.99553 11.3296 10.9139 12.0949 12 12.0949C13.0861 12.0949 14.0045 11.3296 15.8411 9.79908L18 8"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                    </svg>
                                    <span class="truncate text-primary">{{ $user->email ?? '-' }}</span></a>
                            </li>
                            <li class="flex items-center gap-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5">
                                    <path
                                        d="M16.1007 13.359L16.5562 12.9062C17.1858 12.2801 18.1672 12.1515 18.9728 12.5894L20.8833 13.628C22.1102 14.2949 22.3806 15.9295 21.4217 16.883L20.0011 18.2954C19.6399 18.6546 19.1917 18.9171 18.6763 18.9651M4.00289 5.74561C3.96765 5.12559 4.25823 4.56668 4.69185 4.13552L6.26145 2.57483C7.13596 1.70529 8.61028 1.83992 9.37326 2.85908L10.6342 4.54348C11.2507 5.36691 11.1841 6.49484 10.4775 7.19738L10.1907 7.48257"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <path opacity="0.5"
                                        d="M18.6763 18.9651C17.0469 19.117 13.0622 18.9492 8.8154 14.7266C4.81076 10.7447 4.09308 7.33182 4.00293 5.74561"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <path opacity="0.5"
                                        d="M16.1007 13.3589C16.1007 13.3589 15.0181 14.4353 12.0631 11.4971C9.10807 8.55886 10.1907 7.48242 10.1907 7.48242"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                                <span class="whitespace-nowrap" dir="ltr">{{ $user->phone_number ?? '-' }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="panel lg:col-span-1 xl:col-span-2">
                    <div class="mb-5">
                        <h5 class="text-lg font-semibold dark:text-white-light">Update Profile</h5>
                    </div>

                    <div class="mb-5">
                        @if ($user->isAdmin())
                            <form action="{{ route('admin.dashboard.profile.update') }}" method="POST"
                                enctype="multipart/form-data">
                        @endif

                        @if ($user->isCustomer())
                            <form action="{{ route('customer.dashboard.profile.update') }}" method="POST"
                                enctype="multipart/form-data">
                        @endif
                        @if ($user->isSeller())
                            <form action="{{ route('seller.dashboard.profile.update') }}" method="POST"
                                enctype="multipart/form-data">
                        @endif
                        @csrf
                        @method('PATCH')
                        <div class="grid lg:grid-cols-2 gap-6 mb-4">
                            <div class="w-full col-span-2 lg:col-span-1">
                                <div class="flex">
                                    <label for="inputName">Name</label>
                                    <span class="text-danger">*</span>
                                </div>
                                <input id="inputName" type="text" placeholder="Enter your name" class="form-input "
                                    name="name" value="{{ old('name') ?? $user->name }}" minlength="1"
                                    maxlength="30" />
                                @error('name')
                                    <p class="mt-2 text-danger text-xs">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="w-full col-span-2 lg:col-span-1">
                                <div class="flex">
                                    <label for="inputUsername">Username</label>
                                    <span class="text-danger">*</span>
                                </div>

                                <input id="inputUsername" type="text" placeholder="Enter your username"
                                    class="form-input md:w-full w-72" name="username"
                                    value="{{ old('username') ?? $user->username }}" minlength="1" maxlength="15" />
                                @error('username')
                                    <p class="mt-2 text-danger text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full col-span-2 lg:col-span-1">
                                <label for="inputGender">Gender</label>
                                <select id="inputGender" class="form-select text-white-dark md:w-full w-72"
                                    name="gender">
                                    <option disabled selected>Open this select menu</option>
                                    <option value="men"
                                        {{ $user->gender == 'men' ? 'selected' : (old('gender') == 'men' ? 'selected' : null) }}>
                                        Men</option>
                                    <option value="women"
                                        {{ $user->gender == 'women' ? 'selected' : (old('gender') == 'women' ? 'selected' : null) }}>
                                        Women</option>
                                </select>
                                @error('gender')
                                    <p class="mt-2 text-danger text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full col-span-2 lg:col-span-1">
                                <label for="inputDob">Date of Birth</label>
                                <input id="inputDob" type="date" class="form-input md:w-full w-72"
                                    name="date_of_birth" value="{{ old('dob') ?? $user->dob }}" />
                                @error('date_of_birth')
                                    <p class="mt-2 text-danger text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full col-span-2 lg:col-span-1">
                                <div class="flex">
                                    <label for="inputEmail">Email</label>
                                    <span class="text-danger">*</span>
                                </div>
                                <input id="inputEmail" type="email" placeholder="Enter your email"
                                    class="form-input md:w-full w-72" name="email"
                                    value="{{ old('email') ?? $user->email }}" minlength="1" maxlength="100" />
                                @error('email')
                                    <p class="mt-2 text-danger text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full col-span-2 lg:col-span-1">
                                <label for="inputPhone">Phone (08)</label>
                                <input id="inputPhone" type="text" placeholder="Enter your phone"
                                    class="form-input md:w-full w-72" name="phone_number"
                                    value="{{ old('phone') ?? $user->phone_number }}"
                                    placeholder="Enter your phone number" minlength="10"
                                    maxlength="{{ config('validation.phone_number.maxlength') }}"
                                    pattern="{{ config('validation.phone_number.regex') }}"
                                    onkeypress="return onlyNumberKey(event)" />
                                @error('phone_number')
                                    <p class="mt-2 text-danger text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full col-span-2 lg:col-span-2">
                                <label for="inputAvatar">Avatar</label>
                                <input id="inputAvatar" type="file" name="avatar"
                                    class="file-input file-input-bordered md:w-full w-72 file-input-sm text-base rounded-md"
                                    accept=".jpg, .jpeg, .png" />

                                <div class="flex flex-col md:flex-row md:items-center mt-4">
                                    <div class=""
                                        style="width: 300px; height: 160px; border: 2px solid rgb(219, 219, 219);">
                                        <img class="w-full h-full object-contain"
                                            src="{{ $user->avatar ? $user->avatar() : 'https://eu.ui-avatars.com/api/?name=' . $user->username . '&size=150' }}"
                                            alt="{{ $user->username }}">
                                    </div>
                                    <svg width="52" height="52" viewBox="0 0 32 32" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20.5717 9.90039L26.6669 15.9987L20.5717 22.0954M6.85742 16.0002H26.6669"
                                            stroke="black" stroke-width="3" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    <div class="mx-2"
                                        style="width: 300px; height: 160px; border: 2px solid rgb(219, 219, 219);"
                                        id="preview-container">
                                        <img class="w-full h-full object-contain" id="preview"
                                            src="{{ asset('assets/images/placeholder-image.jpg') }}" alt="">
                                    </div>
                                </div>

                                @error('avatar')
                                    <p class="mt-2 text-danger text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-full col-span-2 lg:col-span-2 " x-data="modal">
                                <button type="button" class="btn btn-primary w-full btn-sm" @click="toggle">Update
                                    Profile</button>
                                <x-dashboard.confirm-modal-action :modalId="$user->created_at" title="Update Profile"
                                    description="Are you sure change your profile?"></x-dashboard.confirm-modal-action>

                            </div>
                        </div>
                        </form>
                    </div>
                </div>

                <div class="panel lg:col-span-1 xl:col-span-1">
                    <div class="mb-5">
                        <h5 class="text-lg font-semibold dark:text-white-light">Update Password</h5>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h2>Note:</h2>
                        <p class="text-muted text-xs">* Create a password that is at least 8 characters long.</p>
                        <p class="text-muted text-xs">* Avoid using personal information such as your name, date of birth,
                            or
                            phone number as part of the password.</p>
                        <p class="text-muted text-xs">* Do not use the same password for various online services.</p>
                    </div>
                    @if ($user->isAdmin())
                        <form action="{{ route('admin.dashboard.profile.update-password') }}" method="POST">
                    @endif

                    @if ($user->isCustomer())
                        <form action="{{ route('customer.dashboard.profile.update-password') }}" method="POST">
                    @endif
                    @if ($user->isSeller())
                        <form action="{{ route('seller.dashboard.profile.update-password') }}" method="POST"
                            enctype="multipart/form-data">
                    @endif
                    @csrf
                    @method('PATCH')

                    <div class="grid lg:grid-cols-2 gap-6 mb-4 mt-4">
                        <div class="w-full col-span-2 lg:col-span-2">
                            <div class="flex">
                                <label for="inputCurrentPassword"> Password</label>
                                <span class="text-danger text-xs ">*</span>
                            </div>
                            <input id="inputPassword" type="password" placeholder="Enter your  password"
                                class="form-input" name="password" minlength="8" maxlength="100" />
                            @error('password')
                                <p class="mt-2 text-danger text-xs">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full col-span-2 lg:col-span-2">
                            <div class="flex">
                                <label for="inputPasswordConfirmation"> Password Confirmation</label>
                                <span class="text-danger text-xs ">*</span>
                            </div>
                            <input id="inputPasswordConfirmation" type="password"
                                placeholder="Re Enter your current password" class="form-input"
                                name="password_confirmation" minlength="8" maxlength="100" />
                            @error('password_confirmation')
                                <p class="mt-2 text-danger text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-full col-span-2 lg:col-span-2" x-data="modal">
                            <button type="button" class="btn btn-primary w-full btn-sm" @click="toggle">Update
                                Password</button>
                            <x-dashboard.confirm-modal-action :modalId="$user->created_at" title="Update Password"
                                description="Are you sure change your password?"></x-dashboard.confirm-modal-action>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main content section -->
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/preview.js') }}"></script>
    <script>
        function onlyNumberKey(event) {
            const ASCIICode = (event.which) ? event.which : event.keyCode

            return !(ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57));
        }

        const inputPhoneNumber = document.getElementById('telp')
        const maxlength = inputPhoneNumber.getAttribute('maxlength')

        maxInputValue(inputPhoneNumber, maxlength)
    </script>

    <script>
        const preview = new Preview();
        preview.setImageNode('preview').setInputNode('inputAvatar').setParentNode('preview-container').set();
    </script>
@endpush
