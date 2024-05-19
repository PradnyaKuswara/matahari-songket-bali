@props(['order' => null])

<div
    class="card w-full lg:w-80 bg-base-100 {{ $order->status == true ? 'border-success border' : 'border-warning border' }} shadow-xl">
    <div class="card-body">
        <h2 class="card-title">{{ $order->generate_id }}</h2>
        @if ($order->status == false)
            <div class="badge badge-warning badge-outline">Not Accepted</div>
        @endif

        @if ($order->status == true)
            <div class="badge badge-success badge-outline">Accepted</div>
        @endif
        <p class="text-gray-500 mt-2">Rp. {{ number_format($order->transaction->total_price, 2, ',', '.') }}</p>
        <p class="text-gray-500">Order created at {{ $order->created_at->format('d M Y') }}</p>
        <div class="card-actions justify-end items-center mt-4">
            <a href="{{ route('customer.dashboard.order.show', $order) }}" class="btn btn-primary w-full">View Order</a>
        </div>
    </div>
</div>
