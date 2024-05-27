@forelse ($products as $index => $product)
    <x-cart-list :product="$product" :index="$index"></x-cart-list>
@empty
    <template x-if="cart">
        <div class="flex justify-center items-center my-52 2xl:my-80 text-slate-300">
            No items
        </div>
    </template>
@endforelse
