<div class="flex justify-between gap-4 border-b pb-4 mt-4">
    <div class="flex gap-4">
        <div class="indicator">
            <img src="{{ $cart->image1() }}" class="w-20 h-20 rounded-lg" />
            <span class="badge badge-sm indicator-item">{{ $cart->pivot->quantity }}</span>
        </div>

        <div class="flex flex-col gap-1">
            <h1 class="font-bold">{{ $cart->name }}</h1>
            <p class="text-xs"> Color: <span class="ml-2 py-[0.1rem] px-2 w-5 h-5 rounded-sm"
                    style="background-color: {{ $cart->color }}"></span> </p>
            <p class="text-xs"> Type: {{ $cart->productCategory->name }} </p>
        </div>
    </div>

    <div class="font-sans">Rp. {{ number_format($cart->sell_price, 2, ',', '.') }}</div>
</div>
