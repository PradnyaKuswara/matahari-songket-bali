@forelse ($orders as $order)
    <x-dashboard.order :order="$order"></x-dashboard.order>
@empty
    <div class="card col-span-5">
        <div class="card-body bg-white dark:bg-black">
            <div class="text-center">
                <p class="text-lg">There is no orders</p>
            </div>
        </div>
    </div>
@endforelse
