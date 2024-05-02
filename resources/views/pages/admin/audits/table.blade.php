<div class="table-responsive">
    <table class="table-hover ">
        <thead>
            <tr>
                <th class="text-left text-black font-bold text-sm">Account</th>
                <th class="text-left text-black font-bold text-sm">Event</th>
                <th class="text-left text-black font-bold text-sm">Type</th>
                <th class="text-left text-black font-bold text-sm">Created At</th>
                <th class="text-left text-black font-bold text-sm">Updated At</th>
                <th class="text-left text-black font-bold text-sm">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($audits as $audit)
                <tr>
                    <td>{{ $audit->user_name ?? 'system' }}</td>
                    <td>{{ $audit->event }}</td>
                    <td>{{ $audit->auditable_type }}</td>
                    <td>{{ $audit->created_at }}</td>
                    <td>{{ $audit->updated_at }}</td>
                    <td x-data="modal">
                        <button type="button" @click="toggle"><span
                                class="mdi mdi-note-outline text-primary text-lg"></span></button>
                        <x-dashboard.table-modal title="Information Log" :description="$audit"></x-dashboard.table-modal>
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
        {{ $audits->links('components.dashboard.pagination') }}
    </div>
</div>
