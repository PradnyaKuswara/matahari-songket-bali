<div class="table-responsive">
    <table class="table-hover ">
        <thead>
            <tr>
                <th class="text-left  font-bold text-sm">Status</th>
                <th class="text-left  font-bold text-sm">Image</th>
                <th class="text-left  font-bold text-sm">Color</th>
                <th class="text-left  font-bold text-sm">Category</th>
                <th class="text-left  font-bold text-sm">Name</th>
                <th class="text-left  font-bold text-sm">Stock</th>
                <th class="text-left  font-bold text-sm">Goods Price</th>
                <th class="text-left  font-bold text-sm">Sell Price</th>
                <th class="text-left  font-bold text-sm">Description</th>
                <th class="text-left  font-bold text-sm">Type</th>
                <th class="text-left  font-bold text-sm">Created At</th>
                <th class="text-left  font-bold text-sm">Updated At</th>
                <th class="text-left  font-bold text-sm">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    @if ($product->is_active)
                        <td>
                            <form
                                action="{{ route(request()->user()->role->name . '.dashboard.products.toggleActive', $product) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')

                                <div x-data="modal">
                                    <button type="button" class="btn btn-outline btn-success btn-sm border-none"
                                        @click="toggle">Active</button>
                                    <x-dashboard.confirm-modal-action :modalId="$product->created_at" title="Status"
                                        description="Are you sure update product status?"></x-dashboard.confirm-modal-action>
                                </div>
                            </form>
                        </td>
                    @else
                        <td>
                            <form
                                action="{{ route(request()->user()->role->name . '.dashboard.products.toggleActive', $product) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')
                                <div x-data="modal">
                                    <button type="button" class="btn btn-outline btn-error btn-sm border-none"
                                        @click="toggle">Inactive</button>
                                    <x-dashboard.confirm-modal-action :modalId="$product->created_at" title="Status"
                                        description="Are you sure update product status?"></x-dashboard.confirm-modal-action>
                                </div>
                            </form>
                        </td>
                    @endif
                    <td>
                        @if ($product->image_1)
                            <div class="flex flex-wrap">
                                <div class="flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="mask mask-squircle w-10 h-10">
                                            <img src="{{ $product->image_1 ? $product->image1() : '' }}"
                                                alt="Product Image" />
                                        </div>
                                    </div>
                                </div>
                                @if ($product->image_2)
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle w-10 h-10">
                                                <img src="{{ $product->image2() }}" alt="Product Image" />
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if ($product->image_3)
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle w-10 h-10">
                                                <img src="{{ $product->image3() }}" alt="Product Image" />
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if ($product->image_4)
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle w-10 h-10">
                                                <img src="{{ $product->image4() }}" alt="Product Image" />
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($product->color)
                            <div class="w-7 h-7 rounded-sm" style="background-color: {{ $product->color }}"></div>
                        @else
                            -
                        @endif

                    </td>
                    <td>{{ $product->productCategory->name }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->goods_price }}</td>
                    <td>{{ $product->sell_price }}</td>
                    <td>{{ $product->description ?? '-' }}</td>
                    <td>{{ $product->type }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>{{ $product->updated_at }}</td>
                    <td>
                        <div class="w-full" x-data="modalEdit{{ $loop->iteration }}">
                            <label for="modal_edit_{{ $loop->iteration }}" class="cursor-pointer"
                                @click="toggle()"><span class="mdi mdi-pencil text-xl text-success"></label>

                            <x-dashboard.edit-modal :elements="[
                                [
                                    'name' => 'name',
                                    'id' => 'inputName',
                                    'label' => 'Name',
                                    'type' => 'text',
                                    'value' => $product->name,
                                    'placeholder' => 'Enter your product name',
                                    'is_required' => 'true',
                                ],
                                [
                                    'name' => 'product_category_id',
                                    'id' => 'inputCategory',
                                    'label' => 'Select Category',
                                    'type' => 'select',
                                    'value' => $product->product_category_id,
                                    'options' => $productCategories,
                                    'is_required' => 'true',
                                ],
                                [
                                    'name' => 'stock',
                                    'id' => 'inputStock',
                                    'label' => 'Stock',
                                    'type' => 'number',
                                    'value' => $product->stock,
                                    'placeholder' => 'Enter your product stock',
                                    'is_required' => 'true',
                                ],
                                [
                                    'name' => 'goods_price',
                                    'id' => 'inputGoodsPrice',
                                    'label' => 'Goods Price',
                                    'type' => 'number',
                                    'value' => $product->goods_price,
                                    'placeholder' => 'Enter your product goods price',
                                    'is_required' => 'true',
                                ],
                                [
                                    'name' => 'sell_price',
                                    'id' => 'inputSellPrice',
                                    'label' => 'Sell Price',
                                    'type' => 'number',
                                    'value' => $product->sell_price,
                                    'placeholder' => 'Enter your product sell price',
                                    'is_required' => 'true',
                                ],
                                [
                                    'name' => 'color',
                                    'id' => 'inputColor',
                                    'label' => 'Color',
                                    'type' => 'text',
                                    'value' => $product->color,
                                    'placeholder' => 'Enter your product color',
                                    'is_required' => 'true',
                                ],
                                [
                                    'name' => 'image_1',
                                    'id' => 'inputImage1',
                                    'label' => 'Image 1',
                                    'type' => 'file',
                                    'placeholder' => 'Choose your product image 1',
                                    'is_required' => 'false',
                                    'accept' => '.jpg, .jpeg, .png',
                                ],
                                [
                                    'name' => 'image_2',
                                    'id' => 'inputImage2',
                                    'label' => 'Image 2',
                                    'type' => 'file',
                                    'placeholder' => 'Choose your product image 2',
                                    'is_required' => 'false',
                                    'accept' => '.jpg, .jpeg, .png',
                                ],
                                [
                                    'name' => 'image_3',
                                    'id' => 'inputImage3',
                                    'label' => 'Image 3',
                                    'type' => 'file',
                                    'placeholder' => 'Choose your product image 3',
                                    'is_required' => 'false',
                                    'accept' => '.jpg, .jpeg, .png',
                                ],
                                [
                                    'name' => 'image_4',
                                    'id' => 'inputImage4',
                                    'label' => 'Image 4',
                                    'type' => 'file',
                                    'placeholder' => 'Choose your product image 4',
                                    'is_required' => 'false',
                                    'accept' => '.jpg, .jpeg, .png',
                                ],
                                [
                                    'name' => 'description',
                                    'id' => 'inputDescription',
                                    'label' => 'Description',
                                    'type' => 'textarea',
                                    'value' => $product->description,
                                    'placeholder' => 'Enter your product description',
                                    'is_required' => 'true',
                                ],
                            ]"
                                route="{{ request()->user()->role->name }}.dashboard.products.update" :idRoute="$product"
                                title="Edit Product Post" :idModal="$loop->iteration"></x-dashboard.edit-modal>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" class="text-center">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-2">
        {{ $products->links('components.dashboard.pagination') }}
    </div>
</div>
