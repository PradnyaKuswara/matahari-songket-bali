@props(['order' => null])

<div
    class="card w-full lg:w-80 bg-base-100 {{ $order->status == true ? 'border-success border' : 'border-warning border' }} shadow-xl">
    <div class="card-body">
        <h2 class="card-title">{{ $order->generate_id }}</h2>

        <p class="text-gray-500 mt-4">Rp. {{ number_format($order->transaction->total_price, 2, ',', '.') }}</p>
        <p class="text-gray-500">{{ $order->transaction->generate_id }}</p>
        <p class="text-gray-500">Order created at {{ $order->created_at->format('d M Y') }}</p>
        <div class="card-actions justify-between items-center mt-4">
            @if ($order->status == false)
                <div class="badge badge-warning badge-outline">Pending</div>
            @endif

            @if ($order->status == true)
                <div class="badge badge-success badge-outline">Success</div>
            @endif
            @if ($order->status == false)
                <a href="{{ route('checkout.showPayment', $order) }}" class="btn btn-primary">Pay Now</a>
            @endif
            @if ($order->status == true)
                <a href="{{ route('customer.dashboard.transaction.show', $order->transaction) }}"
                    class="btn btn-primary">Invoice</a>
            @endif
        </div>
    </div>
</div>
