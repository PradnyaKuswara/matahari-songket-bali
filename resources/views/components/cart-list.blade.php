@props(['product' => null, 'index' => null])

<template x-if="cart" id="cart-item-{{ $index }}">
    <div class="flex gap-4 flex-col md:flex-row  p-2 md:p-1 2xl:p-4 border-gray-200 ">
        <div class="flex w-full gap-6 md:gap-12 xl:gap-4">
            <div class="flex item gap-4">
                <input type="checkbox" x-bind:checked="forms[{{ $index }}].is_active == 1"
                    @click="toggleCheck({{ $index }})" class="checkbox checkbox-accent" />
                <img src="{{ $product->image1() }}" class="w-32 md:w-40 rounded-md" alt="Album" />
            </div>
            <div class="flex flex-col gap-2">
                <div class="badge badge-neutral py-3 px-3 badge-outline text-xs md:text-xs">
                    Songket
                </div>
                <div class="flex flex-col md:flex-row justify-between gap-4 md:gap-0">
                    <div class="flex flex-col gap-2 w-full">
                        <p class="text-sm font-bold ">{{ $product->name }}</p>
                        <div class="flex gap-4">
                            <div class="flex gap-4">
                                <p class="text-xs">Type: <b>{{ $product->productCategory->name }}</b></p>
                                <p class="text-xs">Color: <b>Red</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-end gap-2 w-full">
            <p class="font-bold text-xl font-sans">Rp. <span
                    class="text-primary">{{ number_format($product->sell_price, 2, ',', '.') }}</span> </p>
            <div class="flex items-center gap-4">
                <button onclick="delete_cart_{{ $index }}.showModal()"><i
                        class="fas fa-trash-can cursor-pointer"></i> </button>
                <dialog id="delete_cart_{{ $index }}" class="modal">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg">Confirmation</h3>
                        <p class="pt-4">Are you sure delete this item?</p>
                        <div class="modal-action">
                            <form method="dialog">
                                <!-- if there is a button in form, it will close the modal -->
                                <button @click="deleteCart({{ $index }})" class="btn btn-error">Sure</button>
                                <button class="btn">Close</button>
                            </form>
                        </div>
                    </div>
                </dialog>
                <div class="custom-number-input h-10 w-32">
                    <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                        <button
                            class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-7 md:h-8 w-20 rounded-l cursor-pointer outline-none"
                            @click="minusQuantity({{ $index }})">
                            <span class="m-auto text-xl">−</span>
                        </button>
                        <input type="number" readonly
                            class=" focus:outline-none text-center w-20 h-7 md:h-8 bg-gray-100 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none"
                            name="custom-input-number" name="quantity"
                            x-model="forms[{{ $index }}].quantity"></input>
                        <button data-action="increment"
                            class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-7 md:h-8 w-20 rounded-r cursor-pointer"
                            @click="plusQuantity({{ $index }})">
                            <span class="m-auto text-xl">+</span>
                        </button>
                    </div>
                </div>
            </div>
            @if ($product->stock < $product->pivot->quantity)
                <div id="alert-stock" class="w-full flex justify-end">
                    <p class="text-xs text-red-500">Update your cart because stock is uptodated</p>
                </div>
            @endif
        </div>
    </div>
</template>
