<table class="table table-sm md:table-md w-full ">
    <thead>
        <tr>
            <th class="text-left text-black font-bold text-sm">Name</th>
            <th class="text-left text-black font-bold text-sm">Created At</th>
            <th class="text-left text-black font-bold text-sm">Updated At</th>
            <th class="text-left text-black font-bold text-sm">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($productCategories as $productCategory)
            <tr>
                <td>{{ $productCategory->name }}</td>
                <td>{{ $productCategory->created_at }}</td>
                <td>{{ $productCategory->updated_at }}</td>
                <td>
                    <div class="flex gap-2">
                        <a href="{{ route('admin.dashboard.products.categories.edit', $productCategory->id) }}"
                            class=" text-black"><span class="mdi mdi-pencil text-xl text-success"></span></a>

                        <form action="{{ route('admin.dashboard.products.categories.destroy', $productCategory->id) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" data-fc-type="modal">
                                <span class="mdi mdi-trash-can-outline text-xl text-error"></span></button>
                            <x-dashboard.confirm-modal title="Delete Product Category"
                                description="Are you sure delete this data?"></x-dashboard.confirm-modal>
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
    {{ $productCategories->links('components.dashboard.pagination') }}
</div>
