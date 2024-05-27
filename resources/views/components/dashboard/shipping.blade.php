@props(['shipping' => null, 'loop' => null])

<div class="card w-full lg:w-80 bg-base-100 shadow-xl">
    <div class="card-body">
        <h2 class="card-title">{{ $shipping->name }}</h2>
        @if ($shipping->status == 'cancel')
            <div class="badge badge-error badge-outline">Cancel</div>
        @endif
        @if ($shipping->status == 'pending')
            <div class="badge badge-warning badge-outline">Pending</div>
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
            <div class="card-actions justify-center mt-4 gap-4" x-data="modalEdit{{ $loop }}">
                <label for="modal_edit_{{ $loop }}" class="cursor-pointer btn btn-primary w-full"
                    @click="toggle()">Delivery</label>
                <x-dashboard.edit-modal :elements="[
                    [
                        'name' => 'courier',
                        'id' => 'inputCourier',
                        'label' => 'Courier',
                        'type' => 'select',
                        'value' => '',
                        'options' => [
                            [
                                'id' => 'JNE',
                                'name' => 'JNE',
                            ],
                            [
                                'id' => 'JNT',
                                'name' => 'JNT',
                            ],
                        ],
                        'placeholder' => 'Select your courier',
                        'is_required' => 'true',
                    ],
                    [
                        'name' => 'tracking_number',
                        'id' => 'inputTrackingNumber',
                        'label' => 'Tracking Number',
                        'type' => 'text',
                        'value' => '',
                        'placeholder' => 'Enter your tracking number',
                        'is_required' => 'true',
                    ],
                    [
                        'name' => 'shipped_at',
                        'id' => 'inputShippedAt',
                        'label' => 'Shipped At',
                        'type' => 'date',
                        'value' => '',
                        'placeholder' => 'Enter your shipped at',
                        'is_required' => 'true',
                    ],
                    [
                        'name' => 'delivered_at',
                        'id' => 'inputDeliveredAt',
                        'label' => 'Estimation Delivered At',
                        'type' => 'date',
                        'value' => '',
                        'placeholder' => 'Enter your delivered at',
                        'is_required' => 'true',
                    ],
                    [
                        'name' => 'notification',
                        'id' => 'inputNotification',
                        'label' => 'Notification',
                        'type' => 'select',
                        'value' => '',
                        'options' => [
                            [
                                'id' => 'yes',
                                'name' => 'yes',
                            ],
                            [
                                'id' => 'no',
                                'name' => 'no',
                            ],
                        ],
                        'placeholder' => 'Send notification email to customer',
                        'is_required' => 'true',
                    ],
                ]"
                    route="{{ request()->user()->role->name }}.dashboard.shippings.update" :idRoute="$shipping"
                    title="Update Shipping" :idModal="$loop"></x-dashboard.edit-modal>
            </div>
        @endif

    </div>
</div>
