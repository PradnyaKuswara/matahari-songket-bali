@forelse ($orders as $order)
    <x-dashboard.order :order="$order"></x-dashboard.order>
@empty
    <div class="card col-span-4">
        <div class="card-body bg-white">
            <div class="text-center">
                <p class="text-lg">There is no orders</p>
            </div>
        </div>
    </div>
@endforelse
