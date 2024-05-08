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
                    <td>{{ $production->material }}</td>
                    <td>{{ $production->service }}</td>
                    <td>{{ $production->total }}</td>
                    <td>{{ $production->goods_price }}</td>
                    <td>{{ $production->estimate }}</td>
                    <td>{{ $production->created_at }}</td>
                    <td>{{ $production->updated_at }}</td>
                    <td>
                        <div class="flex gap-2">
                            <a href="{{ route(request()->user()->role->name . '.dashboard.productions.edit', $production->id) }}"
                                class=" text-black"><span class="mdi mdi-pencil text-xl text-success"></span></a>

                            <form
                                action="{{ route(request()->user()->role->name . '.dashboard.productions.destroy', $production->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <div x-data="modal">
                                    <button type="button" @click="toggle"><span
                                            class="mdi mdi-trash-can-outline text-xl text-error"></span></button>
                                    <x-dashboard.confirm-modal-action :modalId="$production->created_at" title="Delete Production"
                                        description="Are you sure delete this data?"></x-dashboard.confirm-modal-action>
                                </div>
                            </form>
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
