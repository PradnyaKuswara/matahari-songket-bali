@extends('layouts.dashboard')

@section('title')
    Management Weaver
@endsection

@section('content')
    <div style="display: none;" id="loading-address"
        class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-[9999999999] overflow-hidden bg-gray-800 opacity-75 flex flex-col items-center justify-center">
        <div class="loading loading-dots w-12 rounded-full text-white h-12 mb-4"></div>
        <h2 class="text-center text-white text-xl font-semibold">Loading...</h2>
        <p class="lg:w-1/3 w-2/3 text-center text-white">This may take a few seconds</p>
    </div>
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Weaver</a>
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
                                'placeholder' => 'Enter your weaver name',
                                'is_required' => 'true',
                            ],
                            [
                                'name' => 'phone_number',
                                'id' => 'inputPhone',
                                'label' => 'Phone Number (08)',
                                'type' => 'text',
                                'placeholder' => 'Enter your weaver phone',
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
                                'placeholder' => 'Select your weaver gender',
                                'is_required' => 'true',
                            ],
                            [
                                'name' => 'date_of_birth',
                                'id' => 'inputDateOfBirth',
                                'label' => 'Date of Birth',
                                'type' => 'date',
                                'placeholder' => 'Enter your weaver date of birth',
                                'is_required' => 'true',
                            ],
                            [
                                'name' => 'provinceSelect',
                                'id' => 'inputProvinceSelect',
                                'label' => 'Province',
                                'type' => 'select',
                                'options' => $provinces,
                                'placeholder' => 'Enter your province',
                                'is_required' => 'true',
                            ],
                            [
                                'name' => 'citySelect',
                                'id' => 'inputCitySelect',
                                'label' => 'City',
                                'type' => 'select',
                                'options' => [],
                                'placeholder' => 'Enter your city',
                                'is_required' => 'true',
                            ],
                            [
                                'name' => 'subdistrictSelect',
                                'id' => 'inputSubdistrictSelect',
                                'label' => 'District',
                                'type' => 'select',
                                'options' => [],
                                'placeholder' => 'Enter your district',
                                'is_required' => 'true',
                            ],
                            [
                                'name' => 'address',
                                'id' => 'inputAddress',
                                'label' => 'Address',
                                'type' => 'text',
                                'placeholder' => 'Enter your weaver address',
                                'is_required' => 'true',
                            ],
                        ]" route="admin.dashboard.weavers.store"
                            title="Create Weaver"></x-dashboard.create-modal>
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
                    @include('pages.admin.weavers.table')
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/search.js') }}"></script>
    <script>
        search("search", "table", "{{ url('admin/dashboard/weavers/search?') }}")
    </script>
@endpush
