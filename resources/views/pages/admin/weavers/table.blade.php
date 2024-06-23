<div class="table-responsive">
    <table class="table-hover">
        <thead>
            <tr>
                <th class="text-left font-bold text-sm">Status</th>
                <th class="text-left font-bold text-sm">Name</th>
                <th class="text-left font-bold text-sm">Phone Number</th>
                <th class="text-left font-bold text-sm">Gender</th>
                <th class="text-left font-bold text-sm">Date of Birth</th>
                <th class="text-left font-bold text-sm">Address</th>
                <th class="text-left font-bold text-sm">Village</th>
                <th class="text-left font-bold text-sm">District</th>
                <th class="text-left font-bold text-sm">City</th>
                <th class="text-left font-bold text-sm">Province</th>
                <th class="text-left font-bold text-sm">Created At</th>
                <th class="text-left font-bold text-sm">Updated At</th>
                <th class="text-left font-bold text-sm">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($weavers as $weaver)
                <tr>
                    @if ($weaver->is_active)
                        <td>
                            <form action="{{ route('admin.dashboard.weavers.toggleActive', $weaver) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div x-data="modal">
                                    <button type="button" class="btn btn-outline btn-success btn-sm border-none"
                                        @click="toggle">Active</button>
                                    <x-dashboard.confirm-modal-action :modalId="$weaver->created_at" title="Status"
                                        description="Are you sure update weaver status?"></x-dashboard.confirm-modal-action>
                                </div>
                            </form>
                        </td>
                    @else
                        <td>
                            <form action="{{ route('admin.dashboard.weavers.toggleActive', $weaver) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div x-data="modal">
                                    <button type="button" class="btn btn-outline btn-error btn-sm border-none"
                                        @click="toggle">Inactive</button>
                                    <x-dashboard.confirm-modal-action :modalId="$weaver->created_at" title="Status"
                                        description="Are you sure update weaver status?"></x-dashboard.confirm-modal-action>
                                </div>
                            </form>
                        </td>
                    @endif
                    <td>{{ $weaver->name }}</td>
                    <td>{{ $weaver->phone_number }}</td>
                    <td>{{ $weaver->gender }}</td>
                    <td>{{ $weaver->date_of_birth->format('d F Y') }}</td>
                    @foreach ($weaver->addresses as $itemAddress)
                        <td>{{ $itemAddress->address }}</td>
                        <td>{{ $itemAddress->village }}</td>
                        <td>{{ $itemAddress->subdistrict }}</td>
                        <td>{{ $itemAddress->city }}</td>
                        <td>{{ $itemAddress->province }}</td>
                    @endforeach
                    <td>{{ $weaver->created_at->format('d F Y H:i:s') }}</td>
                    <td>{{ $weaver->updated_at->format('d F Y H:i:s') }}</td>
                    <td>
                        <div class="w-full" x-data="modalEdit{{ $loop->iteration }}">
                            <label for="modal_edit_{{ $loop->iteration }}" class="cursor-pointer"
                                @click="toggle()"><span class="mdi mdi-pencil text-xl text-success"></label>

                            <x-dashboard.edit-modal :elements="[
                                [
                                    'name' => 'provinceSelect',
                                    'id' => 'inputProvinceSelectEdit',
                                    'label' => 'Province',
                                    'type' => 'select',
                                    'options' => $provinces,
                                    'value' => $weaver->addresses->first()->idProvince,
                                    'placeholder' => 'Enter your province',
                                    'is_required' => 'true',
                                ],
                                [
                                    'name' => 'citySelect',
                                    'id' => 'inputCitySelectEdit',
                                    'label' => 'City',
                                    'type' => 'select',
                                    'options' => [],
                                    'value' => $weaver->addresses->first()->idCity,
                                    'placeholder' => 'Enter your city',
                                    'is_required' => 'true',
                                ],
                                [
                                    'name' => 'subdistrictSelect',
                                    'id' => 'inputSubdistrictSelectEdit',
                                    'label' => 'District',
                                    'type' => 'select',
                                    'options' => [],
                                    'value' => $weaver->addresses->first()->idDistrict,
                                    'placeholder' => 'Enter your district',
                                    'is_required' => 'true',
                                ],
                                [
                                    'name' => 'name',
                                    'id' => 'inputName',
                                    'label' => 'Name',
                                    'type' => 'text',
                                    'value' => $weaver->name,
                                    'placeholder' => 'Enter your weaver name',
                                    'is_required' => 'true',
                                ],
                                [
                                    'name' => 'phone_number',
                                    'id' => 'inputPhone',
                                    'label' => 'Phone Number (08)',
                                    'type' => 'text',
                                    'value' => $weaver->phone_number,
                                    'placeholder' => 'Enter your weaver phone',
                                    'is_required' => 'true',
                                ],
                                [
                                    'name' => 'gender',
                                    'id' => 'inputGender',
                                    'label' => 'Gender',
                                    'type' => 'select',
                                    'value' => $weaver->gender,
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
                                    'value' => $weaver->date_of_birth->format('Y-m-d'),
                                    'placeholder' => 'Enter your weaver date of birth',
                                    'is_required' => 'true',
                                ],
                                [
                                    'name' => 'address',
                                    'id' => 'inputAddress',
                                    'label' => 'Address',
                                    'type' => 'text',
                                    'value' => $weaver->addresses->first()->address,
                                    'placeholder' => 'Enter your address',
                                    'is_required' => 'true',
                                ],
                            ]" route="admin.dashboard.weavers.update"
                                :data="$weaver->addresses->first()" :idRoute="$weaver" title="Edit Weaver"
                                :idModal="$loop->iteration"></x-dashboard.edit-modal>
                        </div>
                    </td>


                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-2">
        {{ $weavers->links('components.dashboard.pagination') }}
    </div>
</div>
