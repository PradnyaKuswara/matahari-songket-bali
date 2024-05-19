 @props(['shipping' => null])

 <div class="card md:max-w-screen-md mx-auto p-6 bg-white">
     <section class="px-6 py-8">
         <header>
             <a href="#">
                 <img class="w-auto h-16 " src="{{ asset('assets/images/logo.png') }}" alt="">
             </a>
         </header>

         <main class="mt-8">
             <h1 class="text-primary text-lg font-bold">Hi {{ $shipping->user->name }},</h1>

             <p class="mt-2 leading-loose text-gray-600 text-justify">
                 We're excited to let you know that your order has been shipped! Here are the shipping details:
             </p>

             <div class="mt-4">
                 <h2 class="text-lg font-semibold text-gray-800">#{{ $shipping->order->generate_id }} </h2>
                 @if ($shipping->status == 'pending')
                     <span class="badge badge-warning bg-warning rounded ms-auto text-white">Packing</span>
                 @endif
                 @if ($shipping->status == 'shipping')
                     <span class="badge badge-primary bg-primary rounded ms-auto text-white">Shipping</span>
                 @endif
                 @if ($shipping->status == 'delivered')
                     <span class="badge badge-success bg-success rounded ms-auto text-white">Delivered</span>
                 @endif
                 <div class="mt-4 not-italic text-gray-800">
                     <p><strong>Shipped Address</strong> : {{ $shipping->order->address->address }}</p>
                     <p><strong>Country</strong> : {{ $shipping->order->address->country }}</p>
                     <p><strong>Province</strong> : {{ $shipping->order->address->province }}</p>
                     <p><strong>City</strong> : {{ $shipping->order->address->city }}</p>
                     <p><strong>Postal Code</strong> : {{ $shipping->order->address->postal_code }}</p>
                     <p><strong>Estimated Delivery Date</strong> : {{ $shipping->shipped_at ?? 'On Process' }}</p>
                 </div>
             </div>

             <h1 class="text-2xl font-bold mt-8">{{ $shipping->courier ?? 'Courier: On Process' }}</h1>
             <p class="text-2xl font-bold">{{ $shipping->tracking_number ?? 'Number: On Process' }}</p>

             @if ($shipping->status == 'shipping')
                 <p class="mt-8 leading-loose text-gray-600 text-justify">You can track your shipment by clicking on the
                     link
                     below. For more detailed shipping information, please log in to your service dashboard.
                     Thank you for shopping with us!</p>
                 <div class="flex justify-center">
                     <a href="{{ $shipping->tracking_link }}" class="btn btn-primary mt-8" target="__blank">Tracking
                         Order</a>
                 </div>
             @endif

         </main>


         <footer class="mt-8">
             <div class="mt-4">
                 <p class="block text-sm font-medium text-gray-800">mataharisongketbali@gmail.com</p>
                 <p class="block text-sm font-medium text-gray-800">(+62) 8124 6058 15</p>
             </div>

             <p class="mt-3 text-gray-500">© {{ now()->format('Y') }} Matahari Songket Bali. All
                 Rights
                 Reserved.</p>
         </footer>
     </section>
 </div>
