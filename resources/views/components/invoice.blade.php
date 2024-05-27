@props(['order' => null])

<div class="card shadow-md p-6 bg-white animate-fade">
    <div class="flex flex-wrap justify-between items-center gap-4 px-4">
        <div>
            <div class="text-2xl font-semibold font-sans uppercase">{{ $order->transaction->generate_id }}</div>
            @if ($order->transaction->status == 'cancel')
                <div class="badge badge-error badge-outline">Cancel</div>
            @endif

            @if ($order->transaction->status == 'pending')
                <div class="badge badge-warning badge-outline">Pending</div>
            @endif

            @if ($order->transaction->status == 'settlement')
                <div class="badge badge-success badge-outline">Settlement</div>
            @endif

            @if ($order->transaction->status == 'failed')
                <div class="badge badge-error badge-outline">Failed</div>
            @endif

            @if ($order->transaction->status == 'refund')
                <div class="badge badge-error badge-outline">Refund</div>
            @endif

            @if ($order->transaction->status == 'expired')
                <div class="badge badge-error badge-outline">Expired</div>
            @endif

            @if ($order->transaction->status == 'deny')
                <div class="badge badge-error badge-outline">Deny</div>
            @endif

            @if ($order->transaction->status == 'capture')
                <div class="badge badge-success badge-outline">Capture</div>
            @endif

        </div>

        <div class="shrink-0">
            <img src="{{ asset('assets/images/logo.png') }}" alt="image"
                class="w-32 lg:w-40 ltr:ml-auto rtl:mr-auto" />
        </div>
    </div>

    <div class="px-4 ltr:text-right rtl:text-left">
        <div class="mt-6 space-y-1 text-white-dark">
            <divc class="font-sans">Jalan Matahari Lingkungan Kemoning Klod, Klungkung, Bali, Indonesia</divc>
            <div class="font-sans">mataharisongketbali@gmail.com</div>
            <div class="font-sans">(+62) 8124 6058 15</div>
        </div>
    </div>

    <hr class="my-6 border-[#e0e6ed] dark:border-[#1b2e4b]" />
    <div class="ml-10 grid md:grid-cols-2">
        <div class="w-full">
            <div class="space-y-1 text-white-dark">
                <div>Issue For:</div>
                <div class="font-semibold text-black dark:text-white">{{ $order->user->name }} -
                    {{ $order->user->email }}</div>
                @foreach ($order->user->addresses->where('is_active') as $address)
                    <div>{{ $address->address }}</div>
                    <div>{{ $address->city }} {{ $address->postal_code }}</div>
                    <div>{{ $address->province }}</div>
                @endforeach
            </div>
        </div>

        <div class="w-full mt-4 md:mt-0">
            <div class="mb-2 flex flex-col md:flex-row w-full md:items-center md:justify-between">
                <div class="text-white-dark">Order ID :</div>
                <div class="font-sans">#{{ $order->generate_id }}</div>
            </div>
            <div class="mb-2 flex flex-col md:flex-row w-full md:items-center md:justify-between">
                <div class="text-white-dark">Issue Date :</div>
                <div class="font-sans">{{ $order->created_at->format('d F Y') }}</div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="mt-6">
        <div class="border border-gray-200 p-4 rounded-lg space-y-4">
            <div class="hidden sm:grid sm:grid-cols-5">
                <div class="sm:col-span-2 text-xs font-medium text-gray-500 uppercase">Item</div>
                <div class="text-left text-xs font-medium text-gray-500 uppercase">Qty</div>
                <div class="text-left text-xs font-medium text-gray-500 uppercase">Price</div>
                <div class="text-end text-xs font-medium text-gray-500 uppercase">Total Price</div>
            </div>

            <div class="hidden sm:block border-b border-gray-200"></div>

            @foreach ($order->products as $product)
                <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">

                    <div class="col-span-full sm:col-span-2">
                        <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Item</h5>
                        <p class="font-medium text-gray-800 font-sans">{{ $product->name }}</p>
                    </div>
                    <div>
                        <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Qty</h5>
                        <p class="text-gray-800 font-sans">{{ $product->pivot->quantity }}</p>
                    </div>
                    <div>
                        <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Price</h5>
                        <p class="text-gray-800 font-sans">Rp. {{ number_format($product->pivot->price, 2, ',', '.') }}
                        </p>
                    </div>
                    <div>
                        <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Total Price</h5>
                        <p class="sm:text-end text-gray-800 font-sans">Rp.
                            {{ number_format($product->pivot->total_price, 2, ',', '.') }}</p>
                    </div>

                </div>

                <div class="sm:hidden border-b border-gray-200"></div>
            @endforeach
        </div>
    </div>
    <!-- End Table -->

    <div class="mt-6 grid grid-cols-1 sm:grid-cols-1">
        <div></div>
        <div class="space-y-2 ltr:text-right rtl:text-left">
            <div class="flex items-center">
                <div class="flex-1">Item Total</div>
                <div class="w-[37%] font-sans">Rp.
                    {{ number_format($order->transaction->item_total_price, 2, ',', '.') }}</div>
            </div>
            <div class="flex items-center">
                <div class="flex-1">Tax</div>
                <div class="w-[37%] font-sans">Rp. {{ number_format($order->transaction->tax, 2, ',', '.') }}</div>
            </div>
            <div class="flex items-center">
                <div class="flex-1">Shipping Price</div>
                <div class="w-[37%] font-sans">Rp.
                    {{ number_format($order->transaction->shipping_price, 2, ',', '.') }}
                </div>
            </div>
            <div class="flex items-center text-lg font-semibold">
                <div class="flex-1">Grand Total</div>
                <div class="w-[37%] font-sans">Rp. {{ number_format($order->transaction->total_price, 2, ',', '.') }}
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 sm:mt-12">
        <h4 class="text-lg font-semibold text-gray-800">Thank you!</h4>
        <p class="text-gray-500">If you have any questions concerning this invoice, use the following contact
            information:</p>
        <div class="mt-2">
            <p class="block text-sm font-medium text-gray-800">mataharisongketbali@gmail.com</p>
            <p class="block text-sm font-medium text-gray-800 font-sans">(+62) 8124 6058 15</p>
        </div>
    </div>

    <div class="flex items-center justify-between">
        <p class="mt-5 text-sm text-gray-500">© {{ now()->format('Y') }} Matahari Songket Bali.</p>
    </div>
</div>
