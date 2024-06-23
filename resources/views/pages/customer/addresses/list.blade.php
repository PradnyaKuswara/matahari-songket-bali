<div
    class="grid gap-4 @if (count($addresses) == 1) md:grid-cols-1 @endif @if (count($addresses) == 2) md:grid-cols-2 @endif @if (count($addresses) >= 3) md:grid-cols-3 @endif">
    @forelse ($addresses as $address)
        <div class="bg-white overflow-hidden shadow rounded-lg border">
            <div class="px-4 py-5 ">
                <div class="flex gap-2 justify-between items-center">
                    <div class="flex gap-2">
                        <div class="badge badge-primary badge-xs"></div>
                        <div class="badge badge-primary badge-xs"></div>
                        <div class="badge badge-primary badge-xs"></div>

                    </div>
                    @if ($address->is_active && auth()->user()->isCustomer())
                        <div>
                            <div class="badge badge-primary badge-outline p-4">Default</div>
                        </div>
                    @elseif(!$address->is_active && auth()->user()->isCustomer())
                        <form action="{{ route('customer.dashboard.address.update-status', $address) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            @if (!$address->is_active)
                                <button type="submit"
                                    class="btn btn-primary btn-sm disabled">{{ $address->is_active ? 'Deactivate' : 'Activate' }}</button>
                            @endif
                        </form>
                    @endif
                </div>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                <dl class="sm:divide-y sm:divide-gray-200">
                    <div
                        class="py-3 grid grid-cols-2 place-content-center sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Phone Number
                        </dt>
                        <dd class="text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $address->phone_number }}
                        </dd>
                    </div>
                    <div class="py-3 grid grid-cols-2 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Province
                        </dt>
                        <dd class="text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $address->province }}
                        </dd>
                    </div>
                    <div class="py-3 grid grid-cols-2 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            City
                        </dt>
                        <dd class="text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $address->city }}
                        </dd>
                    </div>
                    <div class="py-3 grid grid-cols-2 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            District
                        </dt>
                        <dd class="text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $address->subdistrict }}
                        </dd>
                    </div>
                    <div class="py-3 grid grid-cols-2 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Postal Code
                        </dt>
                        <dd class="text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $address->postal_code }}
                        </dd>
                    </div>
                    <div class="py-3 grid grid-cols-2 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Address
                        </dt>
                        <dd class="text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $address->address }}
                        </dd>
                    </div>
                    <div class="py-3 grid grid-cols-2 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Additional Information
                        </dt>
                        <dd class="text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $address->additional_information }}
                        </dd>
                    </div>

                    @if (auth()->user()->isCustomer())
                        <div class="py-3 sm:py-5  sm:px-6">
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <div class="flex gap-4  items-center">

                                    <div x-data="modalEdit{{ $loop->iteration }}">
                                        <label for="modal_edit_{{ $loop->iteration }}"
                                            class="btn btn-warning btn-sm text-white" @click="toggle()">Edit
                                            address</label>

                                        <x-dashboard.edit-modal :elements="[
                                            [
                                                'name' => 'provinceSelect',
                                                'id' => 'inputProvinceSelectEdit',
                                                'label' => 'Province',
                                                'type' => 'select',
                                                'options' => $provinces,
                                                'value' => $address->idProvince,
                                                'placeholder' => 'Enter your province',
                                                'is_required' => 'true',
                                            ],
                                            [
                                                'name' => 'citySelect',
                                                'id' => 'inputCitySelectEdit',
                                                'label' => 'City',
                                                'type' => 'select',
                                                'options' => [],
                                                'value' => $address->idCity,
                                                'placeholder' => 'Enter your city',
                                                'is_required' => 'true',
                                            ],
                                            [
                                                'name' => 'subdistrictSelect',
                                                'id' => 'inputSubdistrictSelectEdit',
                                                'label' => 'District',
                                                'type' => 'select',
                                                'options' => [],
                                                'value' => $address->idSubdistrict,
                                                'placeholder' => 'Enter your district',
                                                'is_required' => 'true',
                                            ],
                                            [
                                                'name' => 'postal_code',
                                                'id' => 'inputPostalCodeEdit',
                                                'label' => 'Postal Code',
                                                'type' => 'text',
                                                'value' => $address->postal_code,
                                                'placeholder' => 'Enter your postal code',
                                                'is_required' => 'true',
                                            ],
                                            [
                                                'name' => 'address',
                                                'id' => 'inputAddress',
                                                'label' => 'Address',
                                                'type' => 'text',
                                                'value' => $address->address,
                                                'placeholder' => 'Enter your address',
                                                'is_required' => 'true',
                                            ],
                                            [
                                                'name' => 'additional_information',
                                                'id' => 'inputAdditionalInformation',
                                                'label' => 'Additional Information',
                                                'type' => 'text',
                                                'value' => $address->additional_information,
                                                'placeholder' => 'Enter your additional information',
                                                'is_required' => 'true',
                                            ],
                                            [
                                                'name' => 'phone_number',
                                                'id' => 'inputPhoneNumber',
                                                'label' => 'Phone Number',
                                                'type' => 'text',
                                                'value' => $address->phone_number,
                                                'placeholder' => 'Enter your phone number',
                                                'is_required' => 'true',
                                            ],
                                        ]"
                                            route="customer.dashboard.address.update" :idRoute="$address" :data="$address"
                                            title="Edit Address User" :idModal="$loop->iteration"></x-dashboard.edit-modal>
                                    </div>

                                    <div>
                                        <form action="{{ route('customer.dashboard.address.destroy', $address) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div x-data="modal">
                                                <button type="button" class="btn btn-error btn-sm text-white"
                                                    @click="toggle">Delete address</button>
                                                <x-dashboard.confirm-modal-action :modalId="$address->created_at" title="Status"
                                                    description="Are you sure delete this data?"></x-dashboard.confirm-modal-action>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </dd>
                        </div>
                    @endif
                </dl>
            </div>
        </div>
    @empty
        <div class="card col-span-3">
            <div class="card-body bg-white">
                <div class="text-center">
                    <p class="text-lg">There is no address. Please insert your address detail</p>
                </div>
            </div>
        </div>
    @endforelse
</div>
<div class="mt-4">
    {{ $addresses->links('components.dashboard.pagination') }}
</div>
