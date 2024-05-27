@props(['title', 'description', 'image', 'badges', 'link', 'product' => null])

<template x-if="card">
    <a href="{{ route('products.detailFront', $product) }}"
        class="hidden lg:flex {{ $product->stock <= 0 ? 'pointer-events-none' : '' }}">
        <div {{ $attributes->merge(['class' => 'card h-full']) }}>
            <figure class="aspect-video border"><img
                    class="w-full h-full object-cover" src="{{ $product->image1() }}" alt="Shoes" />
            </figure>
            <div class="card-body ">
                @if ($product->stock <= 0)
                    <div
                        class="absolute top-0 left-0 w-full h-full bg-gray-700 bg-opacity-50 rounded-md flex items-center justify-center">
                        <div class="badge badge-lg badge-error font-bold text-xs md:text-base shadow-xl">SOLD OUT</div>
                    </div>
                @endif
                <div class="flex flex-col-reverse md:flex-row justify-between gap-2 lg:gap-2">
                    <p class="text-xs text-slate-400"><i
                            class="fas fa-eye mr-2"></i>{{ visits(\App\Models\Visitor::TYPE_PRODUCT, $product)->getVisitorCountPerSite() }}
                        view</p>
                    @if ($product->created_at->diffInDays() < 7)
                        <div
                            class="badge badge-error badge-outline animate-pulse animate-infinite text-xs md:text-base">
                            NEW
                        </div>
                    @endif
                </div>

                <h3 class="text-xs md:text-lg font-extrabold">
                    {{ $product->name }}
                </h3>

                <h3 class="text-sm md:text-lg font-bold w-full text-primary font-sans">
                    Rp. {{ number_format($product->sell_price, 2, ',', '.') }}
                </h3>
                <p class="text-xs md:text-sm hidden md:flex">{{ Str::limit(strip_tags($product->description), 100) }}
                </p>

                <div class="flex items-center gap-2 mt-1 mb-2">
                    <div class="p-2 md:p-3 w-1/6 rounded-lg" style="background-color: {{ $product->color }}"></div>
                </div>

                <div class="flex gap-2">
                    <div class="badge badge-primary badge-outline text-xs p-2 md:text-base">
                        Songket</div>
                    <div class="badge badge-primary badge-outline text-xs p-2 md:text-base">
                        {{ $product->productCategory->name }}</div>
                </div>
            </div>
        </div>
    </a>
</template>

<template x-if="card">
    <a href="" class="flex lg:hidden  {{ $product->stock <= 0 ? 'pointer-events-none' : '' }}">
        <div class="card w-96 bg-base-100 shadow-xl   ">
            <figure style="width: 180px; height: 110px; border: 2px solid rgb(219, 219, 219);"><img
                    src="{{ $product->image1() }}" class="w-full h-full object-cover" alt="{{ $product->name }}" />
            </figure>

            <div class="p-4">
                @if ($product->stock <= 0)
                    <div
                        class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-50 rounded-md flex items-center justify-center">
                        <div class="badge badge-lg badge-error font-bold text-xs md:text-base shadow-md">SOLD OUT</div>
                    </div>
                @endif
                <div class="flex items-center gap-2 mt-1 mb-2">
                    <div class="p-2 md:p-3 w-1/6 rounded-lg" style="background-color: {{ $product->color }}"></div>
                </div>
                <h3 class="text-base font-extrabold">
                    {{ $product->name }}
                </h3>
                <h3 class="text-base text-primary font-sans font-bold w-full">
                    Rp. {{ number_format($product->sell_price, 2, ',', '.') }}
                </h3>

                <p class="text-xs mt-2">{{ Str::limit(strip_tags($product->description), 50) }}</p>

                <div class="flex mt-2 justify-between gap-4">
                    <p class="text-xs text-slate-400"><i
                            class="fas fa-eye mr-2"></i>{{ visits(\App\Models\Visitor::TYPE_PRODUCT, $product)->getVisitorCountPerSite() }}
                        view</p>
                    @if ($product->created_at->diffInDays() < 7)
                        <div
                            class="badge badge-error badge-outline animate-pulse animate-infinite text-xs md:text-base">
                            NEW
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </a>
</template>
