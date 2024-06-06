<div>
    <h1 class="text-base font-bold">Year: {{ $year }}</h1>
</div>
<div class="table-responsive mt-4">
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
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    @if ($product->is_active)
                        <td>
                            <div class="badge badge-success badge-outline">Active</div>
                        </td>
                    @else
                        <td>
                            <div class="badge badge-error badge-outline">Inactive</div>
                        </td>
                    @endif
                    <td>
                        @if ($product->image_1)
                            <div class="flex flex-nowrap">
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
                    <td>Rp.{{ number_format($product->goods_price, 2, ',', '.') }}</td>
                    <td>Rp.{{ number_format($product->sell_price, 2, ',', '.') }}</td>
                    <td>{{ $product->description ? Str::limit(strip_tags($product->description), 30) : '-' }}</td>
                    <td>{{ $product->type }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
