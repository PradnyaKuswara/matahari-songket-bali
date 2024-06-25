@props(['order' => null])

<div
    class="card w-full lg:w-80 bg-base-100 {{ $order->status == true ? 'border-success border' : 'border-warning border' }} shadow-xl dark:bg-black">
    <div class="card-body">
        <h2 class="card-title">{{ $order->transaction->generate_id }}</h2>

        <p class="text-gray-500 mt-4">Rp. {{ number_format($order->transaction->total_price, 2, ',', '.') }}</p>
        <p class="text-gray-500">{{ $order->generate_id }}</p>
        <p class="text-gray-500">Order created at {{ $order->created_at->format('d M Y') }}</p>
        <div class="card-actions justify-between items-center mt-4">
            @if ($order->transaction->status == 'cancel')
                <div class="badge badge-error badge-outline">Cancel</div>
            @endif

            @if ($order->transaction->status == 'pending')
                <div class="badge badge-warning badge-outline">Unpaid</div>
            @endif

            @if ($order->transaction->status == 'settlement')
                <div class="badge badge-success badge-outline">Paid</div>
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

            @if ($order->status == false && auth()->user()->isCustomer() == 'customer')
                <a href="{{ route('checkout.showPayment', $order) }}" class="btn btn-primary">Pay Now</a>
            @endif
            @if ($order->status == true && auth()->user()->isCustomer())
                <a href="{{ route('customer.dashboard.transaction.show', $order->transaction) }}"
                    class="btn btn-primary">Invoice</a>
            @endif

            @if (auth()->user()->isSeller() || auth()->user()->isAdmin())
                <a href="{{ route(request()->user()->role->name . '.dashboard.transactions.detail-transaction', $order->transaction) }}"
                    class="btn btn-primary">Invoice</a>
            @endif
        </div>
    </div>
</div>
