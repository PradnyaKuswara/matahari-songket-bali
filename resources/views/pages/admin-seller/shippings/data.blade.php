 @forelse ($shippings as $shipping)
     <x-dashboard.shipping :shipping="$shipping" :loop="$loop->iteration"></x-dashboard.shipping>
 @empty
     <div class="card col-span-5">
         <div class="card-body bg-white dark:bg-black">
             <div class="text-center">
                 <p class="text-lg">There is no shippings</p>
             </div>
         </div>
     </div>
 @endforelse
