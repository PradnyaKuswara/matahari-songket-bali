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
            @forelse ($sellers as $seller)
                <tr>
                    @if ($seller->is_active)
                        <td>
                            <form action="{{ route('admin.dashboard.sellers.toggleActive', $seller) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <div x-data="modal">
                                    <button type="button" class="btn btn-outline btn-success btn-sm border-none"
                                        @click="toggle">Active</button>
                                    <x-dashboard.confirm-modal-action :modalId="$seller->created_at" title="Status"
                                        description="Are you sure update seller status?"></x-dashboard.confirm-modal-action>
                                </div>
                            </form>
                        </td>
                    @else
                        <td>
                            <form action="{{ route('admin.dashboard.sellers.toggleActive', $seller) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div x-data="modal">
                                    <button type="button" class="btn btn-outline btn-error btn-sm border-none"
                                        @click="toggle">Inactive</button>
                                    <x-dashboard.confirm-modal-action :modalId="$seller->created_at" title="Status"
                                        description="Are you sure update seller status?"></x-dashboard.confirm-modal-action>
                                </div>
                            </form>
                        </td>
                    @endif
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="mask mask-squircle w-10 h-10">
                                    <img src="{{ $seller->avatar ? $seller->avatar() : 'https://eu.ui-avatars.com/api/?name=' . $seller->username . '&size=150' }}"
                                        alt="Avatar Tailwind CSS Component" />
                                </div>
                            </div>
                            <div>
                                <div class="font-bold">{{ $seller->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $seller->email }}</td>
                    <td>{{ $seller->username ?? '-' }}</td>
                    <td>{{ $seller->gender ?? '-' }}</td>
                    <td>{{ $seller->phone_number ?? '-' }}</td>
                    <td>{{ $seller->date_of_birth ?? '-' }}</td>
                    <td>{{ $seller->email_verified_at ?? '-' }}</td>
                    <td>{{ $seller->created_at }}</td>
                    <td>{{ $seller->updated_at }}</td>
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
                                        'value' => $seller->name,
                                        'placeholder' => 'Enter your seller name',
                                        'is_required' => 'true',
                                    ],
                                    [
                                        'name' => 'username',
                                        'id' => 'inputUserName',
                                        'label' => 'User Name',
                                        'type' => 'text',
                                        'value' => $seller->username,
                                        'placeholder' => 'Enter your seller username',
                                        'is_required' => 'true',
                                    ],
                                    [
                                        'name' => 'gender',
                                        'id' => 'inputGender',
                                        'label' => 'Gender',
                                        'type' => 'select',
                                        'value' => $seller->gender,
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
                                        'value' => $seller->date_of_birth,
                                        'placeholder' => 'Enter your seller date of birth',
                                        'is_required' => 'false',
                                    ],
                                    [
                                        'name' => 'email',
                                        'id' => 'inputEmail',
                                        'label' => 'Email',
                                        'type' => 'email',
                                        'value' => $seller->email,
                                        'placeholder' => 'Enter your seller email',
                                        'is_required' => 'true',
                                    ],
                                ]" route="admin.dashboard.sellers.update"
                                    :idRoute="$seller" title="Edit seller" :idModal="$loop->iteration"></x-dashboard.edit-modal>
                            </div>
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
        {{ $sellers->links('components.dashboard.pagination') }}
    </div>
</div>
