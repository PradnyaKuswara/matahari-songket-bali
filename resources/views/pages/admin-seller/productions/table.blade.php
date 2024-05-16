<div class="table-responsive">
    <table class="table-hover">
        <thead>
            <tr>
                <th class="text-left font-bold text-sm">Name</th>
                <th class="text-left font-bold text-sm">Date</th>
                <th class="text-left font-bold text-sm">Material</th>
                <th class="text-left font-bold text-sm">Service</th>
                <th class="text-left font-bold text-sm">Total</th>
                <th class="text-left font-bold text-sm">Goods Price</th>
                <th class="text-left font-bold text-sm">Estimate</th>
                <th class="text-left font-bold text-sm">Created At</th>
                <th class="text-left font-bold text-sm">Updated At</th>
                <th class="text-left font-bold text-sm">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($productions as $production)
                <tr>
                    <td>{{ $production->name }}</td>
                    <td>{{ $production->date }}</td>
                    <td>Rp.{{ number_format($production->material, 2, ',', '.') }}</td>
                    <td>Rp.{{ number_format($production->service, 2, ',', '.') }}</td>
                    <td>Rp.{{ number_format($production->total, 2, ',', '.') }}</td>
                    <td>Rp.{{ number_format($production->goods_price, 2, ',', '.') }}</td>
                    <td>{{ $production->estimate }} month</td>
                    <td>{{ $production->created_at->format('d F Y H:i:s') }}</td>
                    <td>{{ $production->updated_at->format('d F Y H:i:s') }}</td>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route(request()->user()->role->name . '.dashboard.productions.edit', $production) }}"
                                class=" text-black"><span class="mdi mdi-pencil text-xl text-success"></span></a>

                            <a href="{{ route(request()->user()->role->name . '.dashboard.productions.show', $production) }}"
                                class=" text-black"><span class="mdi mdi-eye text-xl text-primary"></span></a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-2">
        {{ $productions->links('components.dashboard.pagination') }}
    </div>

</div>
