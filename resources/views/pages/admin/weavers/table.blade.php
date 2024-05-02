<div class="table-responsive">
    <table class="table-hover">
        <thead>
            <tr>
                <th class="text-left text-black font-bold text-sm">Status</th>
                <th class="text-left text-black font-bold text-sm">Name</th>
                <th class="text-left text-black font-bold text-sm">Phone Number</th>
                <th class="text-left text-black font-bold text-sm">Gender</th>
                <th class="text-left text-black font-bold text-sm">Date of Birth</th>
                <th class="text-left text-black font-bold text-sm">Address</th>
                <th class="text-left text-black font-bold text-sm">Province</th>
                <th class="text-left text-black font-bold text-sm">City</th>
                <th class="text-left text-black font-bold text-sm">Created At</th>
                <th class="text-left text-black font-bold text-sm">Updated At</th>
                <th class="text-left text-black font-bold text-sm">Action</th>
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
                    <td>{{ $weaver->date_of_birth }}</td>
                    @foreach ($weaver->addresses as $itemAddress)
                        <td>{{ $itemAddress->address }}</td>
                        <td>{{ $itemAddress->province }}</td>
                        <td>{{ $itemAddress->city }}</td>
                    @endforeach
                    <td>{{ $weaver->created_at }}</td>
                    <td>{{ $weaver->updated_at }}</td>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.dashboard.weavers.edit', $weaver->id) }}"
                                class=" text-black"><span class="mdi mdi-pencil text-xl text-success"></span></a>
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
