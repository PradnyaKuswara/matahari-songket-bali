<div class="table-responsive">
    <table class="table-hover ">
        <thead>
            <tr>
                <th class="text-left  font-bold text-sm">Category Name</th>
                <th class="text-left  font-bold text-sm">Production</th>
                <th class="text-left  font-bold text-sm">Name</th>
                <th class="text-left  font-bold text-sm">Price</th>
                <th class="text-left  font-bold text-sm">Created At</th>
                <th class="text-left  font-bold text-sm">Updated At</th>
                <th class="text-left  font-bold text-sm">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr>
                    <td>{{ $item->itemCategory->name }}</td>

                    @if ($item->productions->isNotEmpty())
                        <td>
                            @foreach ($item->productions as $production)
                                @if ($loop->last)
                                    *{{ $production->name }}
                                @else
                                    *{{ $production->name . ', ' }}
                                @endif
                            @endforeach
                        </td>
                    @else
                        <td>-</td>
                    @endif
                    <td>{{ $item->name }}</td>
                    <td>Rp.{{ number_format($item->price, 2, ',', '.') }}</td>
                    <td>{{ $item->created_at->format('d F Y H:i:s') }}</td>
                    <td>{{ $item->updated_at->format('d F Y H:i:s') }}</td>
                    <td>
                        @if ($item->productions()->exists())
                            <p>Edit on your data production</p>
                        @else
                            <div class="w-full flex gap-1" x-data="modalEdit{{ $loop->iteration }}">
                                <label for="modal_edit_{{ $loop->iteration }}" class="cursor-pointer"
                                    @click="toggle()"><span class="mdi mdi-pencil text-xl text-success"></label>
                                <x-dashboard.edit-modal :elements="[
                                    [
                                        'name' => 'name',
                                        'id' => 'inputName',
                                        'label' => 'Name',
                                        'type' => 'text',
                                        'value' => $item->name,
                                        'placeholder' => 'Enter your item name',
                                        'is_required' => 'true',
                                    ],
                                    [
                                        'name' => 'price',
                                        'id' => 'inputPrice',
                                        'label' => 'Price',
                                        'type' => 'text',
                                        'value' => $item->price,
                                        'placeholder' => 'Enter your item price',
                                        'is_required' => 'true',
                                    ],
                                    [
                                        'name' => 'item_category_id',
                                        'id' => 'inputCategory',
                                        'label' => 'Select Category',
                                        'type' => 'select',
                                        'value' => $item->item_category_id,
                                        'options' => $itemCategories,
                                        'is_required' => 'true',
                                    ],
                                ]"
                                    route="admin.dashboard.items.update" :idRoute="$item"
                                    title="Edit Item Post" :idModal="$loop->iteration"></x-dashboard.edit-modal>
                            </div>
                        @endif

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-2">
        {{ $items->links('components.dashboard.pagination') }}
    </div>
</div>
