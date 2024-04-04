@props(['title', 'description', 'image', 'badges', 'link'])

<div {{ $attributes->merge(['class' => 'card']) }}>
    <figure><img src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" /></figure>
    <div class="card-body">
        <div class="flex justify-between">
            <p class="text-xs text-slate-400"><i class="fas fa-eye mr-2"></i>2.5k view this product</p>
            <div class="badge badge-error badge-outline animate-pulse animate-infinite">NEW</div>
        </div>

        <h2 class="card-title">
            Shoes!

        </h2>
        <h3 class="card-title">
            IDR. 1,400,000.00
        </h3>
        <p class="text-sm">If a dog chews shoes whose shoes does he choose?</p>
        <div class="card-actions mb-4">
            <div class="badge badge-outline">Fashion</div>
            <div class="badge badge-outline">Products</div>
        </div>
        <div class="flex items-center gap-2 mb-4">
            <div class="p-3 w-1/6 rounded-lg bg-primary"></div>
            <div class="p-3 w-1/6 rounded-lg bg-secondary"></div>
            <div class="p-3 w-1/6 rounded-lg bg-accent"></div>
        </div>

        <div class="card-actions justify-end">
            <x-button-link class="bg-primary text-white btn-sm">See Product</x-button-link>
            <x-button-link class="btn-outline btn-primary text-white btn-sm">Buy now</x-button-link>
        </div>
    </div>
</div>
