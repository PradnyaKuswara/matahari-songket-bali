@props(['title', 'description', 'image', 'badges', 'link'])

<template x-if="card">
    <a href="" class="hidden md:flex">
        <div {{ $attributes->merge(['class' => 'card ']) }}>
            <figure><img src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" />
            </figure>
            <div class="card-body ">
                <div class="flex flex-col-reverse md:flex-row justify-between gap-2 lg:gap-2">
                    <p class="text-xs text-slate-400"><i class="fas fa-eye mr-2"></i>2.5k view</p>
                    <div class="badge badge-error badge-outline animate-pulse animate-infinite text-xs md:text-base">NEW
                    </div>
                </div>

                <h3 class="text-xs md:text-base font-extrabold">
                    Songket Cendana
                </h3>

                <h3 class="text-sm md:text-lg font-bold w-full">
                    Rp. 800000
                </h3>
                <p class="text-xs md:text-sm hidden md:flex">If a dog chews shoes whose shoes does he choose?</p>

                <div class="flex items-center gap-2 mt-3 mb-4">
                    <div class="p-2 md:p-3 w-1/6 rounded-lg bg-primary"></div>
                    <div class="p-2 md:p-3 w-1/6 rounded-lg bg-secondary"></div>
                    <div class="p-2 md:p-3 w-1/6 rounded-lg bg-accent"></div>
                </div>

                <div class="flex gap-2 mt-2">
                    <div class="badge badge-neutral badge-outline text-xs p-2 md:text-base">Songket</div>
                    <div class="badge badge-neutral badge-outline text-xs p-2 md:text-base">Kamen</div>
                </div>

            </div>
        </div>
    </a>
</template>

<template x-if="card">
    <a href="" class="flex md:hidden">
        <div class="card w-96 bg-base-100 shadow-xl   ">
            <figure><img src="https://daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.jpg" alt="Shoes" />
            </figure>

            <div class="p-4">
                <div class="flex items-center gap-2 mt-3 mb-4">
                    <div class="p-2 rounded-lg bg-primary"></div>
                    <div class="p-2 rounded-lg bg-secondary"></div>
                    <div class="p-2 rounded-lg bg-accent"></div>
                </div>
                <h3 class="text-base font-extrabold">
                    Songket Cendana
                </h3>
                <h3 class="text-base text-error  font-bold w-full">
                    Rp. 800000
                </h3>

                <p class="text-xs mt-2">If a dog chews shoes whose shoes does he choose?</p>

                <div class="flex mt-2 justify-between gap-4">
                    <p class="text-xs text-slate-400"><i class="fas fa-eye mr-2"></i>2.5k view</p>
                    <div class="badge badge-error badge-outline animate-pulse animate-infinite text-xs md:text-base">NEW
                    </div>
                </div>
            </div>
        </div>
    </a>
</template>
