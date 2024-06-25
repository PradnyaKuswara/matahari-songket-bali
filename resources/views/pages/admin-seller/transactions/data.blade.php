 @forelse ($transactions as $transaction)
     <x-dashboard.transaction :order="$transaction->order"></x-dashboard.transaction>
 @empty
     <div class="card col-span-5">
         <div class="card-body bg-white dark:bg-black">
             <div class="text-center">
                 <p class="text-lg">There is no transactions</p>
             </div>
         </div>
     </div>
 @endforelse
