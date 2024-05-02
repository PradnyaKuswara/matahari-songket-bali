<div class="table-responsive">
    <table class="table-hover ">
        <thead>
            <tr>
                <th class="text-left text-black font-bold text-sm">Status</th>
                <th class="text-left text-black font-bold text-sm">Name</th>
                <th class="text-left text-black font-bold text-sm">Email</th>
                <th class="text-left text-black font-bold text-sm">User Name</th>
                <th class="text-left text-black font-bold text-sm">Gender</th>
                <th class="text-left text-black font-bold text-sm">Phone Number</th>
                <th class="text-left text-black font-bold text-sm">Date of Birth</th>
                <th class="text-left text-black font-bold text-sm">Email Verified</th>
                <th class="text-left text-black font-bold text-sm">Created At</th>
                <th class="text-left text-black font-bold text-sm">Updated At</th>
                <th class="text-left text-black font-bold text-sm">Action</th>
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
                            <a href="{{ route('admin.dashboard.customers.edit', $customer->id) }}"
                                class=" text-black"><span class="mdi mdi-pencil text-xl text-success"></span></a>

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
