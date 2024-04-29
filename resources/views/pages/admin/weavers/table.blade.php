<table class="table table-sm md:table-md w-full ">
    <thead>
        <tr>
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
                        <a href="{{ route('admin.dashboard.weavers.edit', $weaver->id) }}" class=" text-black"><span
                                class="mdi mdi-pencil text-xl text-success"></span></a>

                        <form action="{{ route('admin.dashboard.weavers.destroy', $weaver->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" data-fc-type="modal">
                                <span class="mdi mdi-trash-can-outline text-xl text-error"></span></button>
                            <x-dashboard.confirm-modal title="Delete Weaver"
                                description="Are you sure delete this data?"></x-dashboard.confirm-modal>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center">No data available</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-2">
    {{ $weavers->links('components.dashboard.pagination') }}
</div>
