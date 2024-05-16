@forelse ($products as $index => $product)
    <x-cart-list :product="$product" :index="$index"></x-cart-list>
    <x-loading-cart></x-loading-cart>
@empty
    <x-loading-cart></x-loading-cart>
    <x-loading-cart></x-loading-cart>
    <x-loading-cart></x-loading-cart>
    <template x-if="cart">
        <div class="flex justify-center items-center my-52 2xl:my-80 text-slate-300">
            No items
        </div>
    </template>
@endforelse
