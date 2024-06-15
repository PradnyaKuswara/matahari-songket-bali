@props(['shipping' => null, 'loop' => null])

<div class="card w-full lg:w-80 bg-base-100 shadow-xl">
    <div class="card-body">
        <h2 class="card-title">{{ $shipping->name }}</h2>
        @if ($shipping->status == 'cancel')
            <div class="badge badge-error badge-outline">Cancel</div>
        @endif
        @if ($shipping->status == 'pending')
            <div class="badge badge-warning badge-outline">Unpaid</div>
        @endif
        @if ($shipping->status == 'packing')
            <div class="badge badge-accent badge-outline">Packing</div>
        @endif
        @if ($shipping->status == 'shipping')
            <div class="badge badge-primary badge-outline">Shipping</div>
        @endif

        @if ($shipping->status == 'delivered')
            <div class="badge badge-success badge-outline">Delivered</div>
        @endif
        <p class="text-gray-500 text-sm"><b>Courier:</b> {{ $shipping->courier ?? '-' }}</p>
        <p class="text-gray-500 text-sm"><b>Number:</b> {{ $shipping->tracking_number ?? '-' }}</p>
        <p class="text-gray-500 text-sm"><b>Shipped at: </b>
            {{ $shipping->shipped_at ? $shipping->shipped_at->format('d F Y') : '-' }}</p>
        <p class="text-gray-500 text-sm"><b>Estimate Delivered at:</b>
            {{ $shipping->delivered_at ? $shipping->delivered_at->format('d F Y') : '-' }}</p>

        @if (auth()->user()->isCustomer())
            <div class="card-actions justify-center mt-4 gap-4">
                <div class="w-full flex gap-4">
                    <a href="{{ route('customer.dashboard.shipping.show', $shipping) }}" class="btn btn-primary">Detail
                        Shipping</a>

                    @if ($shipping->tracking_link && $shipping->status == 'shipping')
                        <a href="{{ $shipping->tracking_link }}" class="btn btn-accent btn-outline"
                            target="__blank">Tracking</a>
                    @endif
                </div>
                @if ($shipping->status == 'shipping')
                    <div class="w-full" x-data="modal">
                        <form action="{{ route('customer.dashboard.shipping.confirmation', $shipping) }}"
                            method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="button" class="btn btn-success text-white w-full btn-md"
                                @click="toggle">Confirmation</button>
                            <x-dashboard.confirm-modal-action :modalId="$shipping->created_at" title="Confirmation"
                                description="Are you sure your order is delivered ?. This action will be confirm your order is finish"></x-dashboard.confirm-modal-action>
                        </form>

                    </div>
                @endif
            </div>
        @endif

        @if (auth()->user()->isSeller())
            <div class="card-actions justify-start mt-4 gap-4" x-data="modalEdit{{ $loop }}">
                <a href="{{ route('seller.dashboard.shippings.show', $shipping) }}" class="btn btn-primary w-full"
                    target="__blank">Detail Shipping</a>
            </div>
        @endif

        @if (auth()->user()->isAdmin())
            <div class="card-actions justify-start mt-4 gap-4" x-data="modalEdit{{ $loop }}">
                <a href="{{ route(request()->user()->role->name . '.dashboard.shippings.detail-shipping', $shipping) }}"
                    class="btn btn-primary w-full">Detail Shipping</a>
            </div>
        @endif
    </div>
</div>
