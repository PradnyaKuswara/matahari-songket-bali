<div class="table-responsive">
    <table class="table-hover ">
        <thead>
            <tr>
                <th class="text-left  font-bold text-sm">Status</th>
                <th class="text-left  font-bold text-sm">Name</th>
                <th class="text-left  font-bold text-sm">Email</th>
                <th class="text-left  font-bold text-sm">User Name</th>
                <th class="text-left  font-bold text-sm">Gender</th>
                <th class="text-left  font-bold text-sm">Phone Number</th>
                <th class="text-left  font-bold text-sm">Date of Birth</th>
                <th class="text-left  font-bold text-sm">Email Verified</th>
                <th class="text-left  font-bold text-sm">Created At</th>
                <th class="text-left  font-bold text-sm">Updated At</th>
                <th class="text-left  font-bold text-sm">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($customers as $customer)
                <tr>
                    @if ($customer->is_active)
                        <td>
                            <form action="{{ route('admin.dashboard.customers.toggleActive', $customer) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')

                                <div x-data="modal">
                                    <button type="button" class="btn btn-outline btn-success btn-sm border-none"
                                        @click="toggle">Active</button>
                                    <x-dashboard.confirm-modal-action :modalId="$customer->created_at" title="Status"
                                        description="Are you sure update customer status?"></x-dashboard.confirm-modal-action>
                                </div>
                            </form>
                        </td>
                    @else
                        <td>
                            <form action="{{ route('admin.dashboard.customers.toggleActive', $customer) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')
                                <div x-data="modal">
                                    <button type="button" class="btn btn-outline btn-error btn-sm border-none"
                                        @click="toggle">Inactive</button>
                                    <x-dashboard.confirm-modal-action :modalId="$customer->created_at" title="Status"
                                        description="Are you sure update customer status?"></x-dashboard.confirm-modal-action>
                                </div>
                            </form>
                        </td>
                    @endif
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-squircle w-10 h-10">
                                    <img src="{{ $customer->avatar ? $customer->avatar() : 'https://eu.ui-avatars.com/api/?name=' . $customer->username . '&size=150' }}"
                                        alt="Avatar Tailwind CSS Component" />
                                </div>
                            </div>
                            <div>
                                <div class="font-bold">{{ $customer->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->username ?? '-' }}</td>
                    <td>{{ $customer->gender ?? '-' }}</td>
                    <td>{{ $customer->phone_number ?? '-' }}</td>
                    <td>{{ $customer->date_of_birth ?? '-' }}</td>
                    <td>{{ $customer->email_verified_at ?? '-' }}</td>
                    <td>{{ $customer->created_at }}</td>
                    <td>{{ $customer->updated_at }}</td>
                    <td>
                        <div class="flex gap-2">
                            <div class="w-full" x-data="modalEdit{{ $loop->iteration }}">
                                <label for="modal_edit_{{ $loop->iteration }}" class="cursor-pointer"
                                    @click="toggle()"><span class="mdi mdi-pencil text-xl text-success"></label>

                                <x-dashboard.edit-modal :elements="[
                                    [
                                        'name' => 'name',
                                        'id' => 'inputName',
                                        'label' => 'Name',
                                        'type' => 'text',
                                        'value' => $customer->name,
                                        'placeholder' => 'Enter your customer name',
                                        'is_required' => 'true',
                                    ],
                                    [
                                        'name' => 'username',
                                        'id' => 'inputUserName',
                                        'label' => 'User Name',
                                        'type' => 'text',
                                        'value' => $customer->username,
                                        'placeholder' => 'Enter your customer username',
                                        'is_required' => 'true',
                                    ],
                                    [
                                        'name' => 'gender',
                                        'id' => 'inputGender',
                                        'label' => 'Gender',
                                        'type' => 'select',
                                        'value' => $customer->gender,
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
                                        'placeholder' => 'Select your customer gender',
                                        'is_required' => 'false',
                                    ],
                                    [
                                        'name' => 'date_of_birth',
                                        'id' => 'inputDateOfBirth',
                                        'label' => 'Date of Birth',
                                        'type' => 'date',
                                        'value' => $customer->date_of_birth,
                                        'placeholder' => 'Enter your customer date of birth',
                                        'is_required' => 'false',
                                    ],
                                    [
                                        'name' => 'email',
                                        'id' => 'inputEmail',
                                        'label' => 'Email',
                                        'type' => 'email',
                                        'value' => $customer->email,
                                        'placeholder' => 'Enter your customer email',
                                        'is_required' => 'true',
                                    ],
                                ]" route="admin.dashboard.customers.update"
                                    :idRoute="$customer" title="Edit Customer" :idModal="$loop->iteration"></x-dashboard.edit-modal>
                            </div>

                            <a href="{{ route('admin.dashboard.customers.showMenu', $customer->id) }}"
                                class=" text-black"><span class="mdi mdi-cog text-primary text-xl"></span></a>
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
        {{ $customers->links('components.dashboard.pagination') }}
    </div>
</div>
