 <div class="flex gap-4 flex-col md:flex-row  p-2 md:p-1 2xl:p-4 border-gray-200 ">
     <div class="flex w-full gap-6 md:gap-12 xl:gap-4">
         <div class="flex item gap-4">
             <input type="checkbox" x-bind:checked="checkAll" class="checkbox checkbox-accent" />
             <img src="{{ asset('assets/images/hero2.jpg') }}" class="w-32 md:w-40 rounded-md" alt="Album" />
         </div>
         <div class="flex flex-col gap-2">
             <div class="badge badge-neutral py-3 px-3 badge-outline text-xs md:text-xs">Songket
             </div>
             <div class="flex flex-col md:flex-row justify-between gap-4 md:gap-0">
                 <div class="flex flex-col gap-2 w-full">
                     <p class="text-sm font-bold ">Songket Cendana</p>
                     <div class="flex gap-4">
                         <div class="flex gap-4">
                             <p class="text-xs">Type: <b>Kamen</b></p>
                             <p class="text-xs">Color: <b>Red</b></p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="flex flex-col items-end gap-2 w-full">
         <p class="font-bold text-xl font-sans">Rp. <span class="text-primary">1000000</span> </p>
         <div class="flex items-center gap-4">
             <i class="fas fa-trash-can"></i>
             <div class="custom-number-input h-10 w-32">
                 <div x-data="{ quantity: 0 }" class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                     <button
                         class=" bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-7 md:h-8 w-20 rounded-l cursor-pointer outline-none"
                         @click="quantity > 0 ? quantity-- : null">
                         <span class="m-auto text-xl">−</span>
                     </button>
                     <input type="number" readonly
                         class=" focus:outline-none text-center w-20 h-7 md:h-8 bg-gray-100 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none"
                         name="custom-input-number" name="quantity" x-model="quantity"></input>
                     <button data-action="increment"
                         class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-7 md:h-8 w-20 rounded-r cursor-pointer"
                         @click="quantity < 2 ? quantity++ : ''">
                         <span class="m-auto text-xl">+</span>
                     </button>
                 </div>
             </div>
         </div>
     </div>
 </div>
