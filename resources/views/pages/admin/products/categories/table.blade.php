<div class="table-responsive">


    <table class="table-hover">
        <thead>
            <tr>
                <th class="text-left font-bold text-sm">Name</th>
                <th class="text-left font-bold text-sm">Created At</th>
                <th class="text-left font-bold text-sm">Updated At</th>
                <th class="text-left font-bold text-sm">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($productCategories as $productCategory)
                <tr>
                    <td>{{ $productCategory->name }}</td>
                    <td>{{ $productCategory->created_at->format('d F Y H:i:s') }}</td>
                    <td>{{ $productCategory->updated_at->format('d F Y H:i:s') }}</td>
                    <td>
                        <div class="w-full" x-data="modalEdit{{ $loop->iteration }}">
                            <label for="modal_edit_{{ $loop->iteration }}" class="cursor-pointer" @click="toggle()"><span
                                    class="mdi mdi-pencil text-xl text-success"></label>

                            <x-dashboard.edit-modal :elements="[
                                [
                                    'name' => 'name',
                                    'id' => 'inputName',
                                    'label' => 'Input Name',
                                    'type' => 'text',
                                    'value' => $productCategory->name,
                                    'placeholder' => 'Enter your item name',
                                    'is_required' => 'true',
                                ],
                            ]" route="admin.dashboard.products.categories.update"
                                :idRoute="$productCategory" title="Edit Product Post" :idModal="$loop->iteration"></x-dashboard.edit-modal>
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

</div>
