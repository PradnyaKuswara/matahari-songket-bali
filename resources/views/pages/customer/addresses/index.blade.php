@extends('layouts.dashboard')


@section('title')
    User Address
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
                <a href="javascript:;" class="text-primary hover:underline">Customer</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Address</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Index</span>
            </li>
        </ul>

        <div class="grid grid-cols-12 gap-4 mt-5">
            <div class="col-span-12">
                <div class="card-actions mb-4 items-center w-full justify-end">
                    <div class="w-full" x-data="modalCreate">
                        <label for="modal_create" class="btn btn-primary w-full lg:w-32" @click="toggle()">+ Create
                            Data</label>

                        <x-dashboard.create-modal :elements="[
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
                                'placeholder' => 'Enter your address',
                                'is_required' => 'true',
                            ],
                            [
                                'name' => 'postal_code',
                                'id' => 'inputPostalCode',
                                'label' => 'Postal Code',
                                'type' => 'number',
                                'placeholder' => 'Enter your postal code',
                                'is_required' => 'true',
                            ],
                            [
                                'name' => 'additional_information',
                                'id' => 'inputAdditionalInformation',
                                'label' => 'Additional Information',
                                'type' => 'text',
                                'placeholder' => 'Enter your additional information',
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
                        ]" route="customer.dashboard.address.store"
                            title="Create Address User"></x-dashboard.create-modal>
                    </div>
                </div>
                <div id="item">
                    @include('pages.customer.addresses.list')
                </div>
            </div>
        </div>
    </div>
@endsection
