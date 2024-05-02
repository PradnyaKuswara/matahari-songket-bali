<div class="table-responsive">
    <table class="table-hover ">
        <thead>
            <tr>
                <th class="text-left text-black font-bold text-sm">Name</th>
                <th class="text-left text-black font-bold text-sm">Created At</th>
                <th class="text-left text-black font-bold text-sm">Updated At</th>
                <th class="text-left text-black font-bold text-sm">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($itemCategories as $itemCategory)
                <tr>
                    <td>{{ $itemCategory->name }}</td>
                    <td>{{ $itemCategory->created_at }}</td>
                    <td>{{ $itemCategory->updated_at }}</td>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.dashboard.items.categories.edit', $itemCategory->id) }}"
                                class=" text-black"><span class="mdi mdi-pencil text-xl text-success"></span></a>

                            <form action="{{ route('admin.dashboard.items.categories.destroy', $itemCategory->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <div x-data="modal">
                                    <button type="button" 
                                        @click="toggle"><span
                                            class="mdi mdi-trash-can-outline text-xl text-error"></span></button>
                                    <x-dashboard.confirm-modal-action :modalId="$itemCategory->created_at" title="Delete Item Category"
                                        description="Are you sure delete this data?"></x-dashboard.confirm-modal-action>
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-2">
        {{ $itemCategories->links('components.dashboard.pagination') }}
    </div>
</div>
