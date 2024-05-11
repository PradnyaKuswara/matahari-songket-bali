@extends('layouts.dashboard')


@section('title')
    User Address
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
                                'name' => 'country',
                                'id' => 'inputCountry',
                                'label' => 'Country',
                                'type' => 'text',
                                'placeholder' => 'Enter your country',
                                'is_required' => 'true',
                            ],
                            [
                                'name' => 'province',
                                'id' => 'inputProvince',
                                'label' => 'Province',
                                'type' => 'text',
                                'placeholder' => 'Enter your province',
                                'is_required' => 'true',
                            ],
                            [
                                'name' => 'city',
                                'id' => 'inputCity',
                                'label' => 'City',
                                'type' => 'text',
                                'placeholder' => 'Enter your city',
                                'is_required' => 'true',
                            ],
                            [
                                'name' => 'postal_code',
                                'id' => 'inputPostalCode',
                                'label' => 'Postal Code',
                                'type' => 'text',
                                'placeholder' => 'Enter your postal code',
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
                                'name' => 'additional_information',
                                'id' => 'inputAdditionalInformation',
                                'label' => 'Additional Information',
                                'type' => 'text',
                                'placeholder' => 'Enter your additional information',
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
