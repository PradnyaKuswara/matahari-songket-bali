<div class="table-responsive">
    <table class="table-hover ">
        <thead>
            <tr>
                <th class="text-left  font-bold text-sm">Name</th>
                <th class="text-left  font-bold text-sm">Created At</th>
                <th class="text-left  font-bold text-sm">Updated At</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($itemCategories as $itemCategory)
                <tr>
                    <td>{{ $itemCategory->name }}</td>
                    <td>{{ $itemCategory->created_at->format('d F Y H:i:s') }}</td>
                    <td>{{ $itemCategory->updated_at->format('d F Y H:i:s') }}</td>
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
