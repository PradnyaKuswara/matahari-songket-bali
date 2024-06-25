@extends('layouts.dashboard')

@section('title')
    Management Seller
@endsection

@section('content')
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Seller</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Index</span>
            </li>
        </ul>

        <div class="mt-5">
            <div class="panel">
                <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
                    <div class="w-full" x-data="modalCreate">
                        <label for="modal_create" class="btn btn-primary w-full lg:w-32" @click="toggle()">+ Create
                            Data</label>

                        <x-dashboard.create-modal :elements="[
                            [
                                'name' => 'name',
                                'id' => 'inputName',
                                'label' => 'Name',
                                'type' => 'text',
                                'placeholder' => 'Enter your seller name',
                                'is_required' => 'true',
                            ],
                            [
                                'name' => 'username',
                                'id' => 'inputUserName',
                                'label' => 'User Name',
                                'type' => 'text',
                                'placeholder' => 'Enter your seller username',
                                'is_required' => 'true',
                            ],
                            [
                                'name' => 'gender',
                                'id' => 'inputGender',
                                'label' => 'Gender',
                                'type' => 'select',
                                'options' => [
                                    [
                                        'id' => 'men',
                                        'name' => 'men',
                                    ],
                                    [
                                        'id' => 'women',
                                        'name' => 'women',
                                    ],
                                ],
                                'placeholder' => 'Select your seller gender',
                                'is_required' => 'false',
                            ],
                            [
                                'name' => 'date_of_birth',
                                'id' => 'inputDateOfBirth',
                                'label' => 'Date of Birth',
                                'type' => 'date',
                                'placeholder' => 'Enter your seller date of birth',
                                'is_required' => 'false',
                            ],
                            [
                                'name' => 'email',
                                'id' => 'inputEmail',
                                'label' => 'Email',
                                'type' => 'email',
                                'placeholder' => 'Enter your seller email',
                                'is_required' => 'true',
                            ],
                            [
                                'name' => 'password',
                                'id' => 'inputPassword',
                                'label' => 'Password',
                                'type' => 'password',
                                'placeholder' => 'Enter your seller password',
                                'is_required' => 'true',
                            ]
                        ]" route="admin.dashboard.sellers.store"
                            title="Create Customer"></x-dashboard.create-modal>
                    </div>
                    <label
                        class="input input-bordered input-md w-full md:w-80  flex items-center gap-2 border border-primary dark:bg-black">
                        <input type="text" id="search" class="grow border-none outline-none text-black dark:text-white "
                            placeholder="Search by keyword"
                            @if (session('keyword')) value="{{ session('keyword') }}" @endif />
                        <span class="mdi mdi-magnify"></span>
                    </label>
                </div>
                <div id="table" class="overflow-x-scroll max-h-[28rem] 2xl:max-h-screen mt-4">
                    @include('pages.admin.sellers.table')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/search.js') }}"></script>
    <script>
        search("search", "table", "{{ url('admin/dashboard/sellers/search?') }}")
    </script>
@endpush
