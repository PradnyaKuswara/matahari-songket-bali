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
                 @if ($shipping->status == 'cancel')
                     <div class="badge badge-error badge-outline">Cancel</div>
                 @endif
                 @if ($shipping->status == 'pending')
                     <div class="badge badge-warning badge-outline">Pending</div>
                 @endif
                 @if ($shipping->status == 'packing')
                     <div class="badge badge-accent badge-outline">Packing</div>
                 @endif
                 @if ($shipping->status == 'shipping')
                     <div class="badge badge-primary badge-outline">Shipping</div>
                 @endif
                 @if ($shipping->status == 'delivered')
                     <div class="badge badge-success badge-outline">Delivered</div>
                 @endif
                 <div class="mt-4 not-italic text-gray-800">
                     <p><strong>Shipped Address</strong> : {{ $shipping->address }}</p>
                     <p><strong>Country</strong> : {{ $shipping->country }}</p>
                     <p><strong>Province</strong> : {{ $shipping->province }}</p>
                     <p><strong>City</strong> : {{ $shipping->city }}</p>
                     <p><strong>Postal Code</strong> : {{ $shipping->postal_code }}</p>
                     <p><strong>Estimated Delivery Date</strong> :
                         {{ $shipping->delivered_at ? $shipping->delivered_at->format('d F Y') : 'On Process' }}</p>
                 </div>
             </div>

             <h1 class="text-2xl font-bold mt-8">{{ $shipping->courier ?? 'Courier: On Process' }}</h1>
             <p class="text-2xl font-bold">{{ $shipping->tracking_number ?? 'Number: On Process' }}</p>


             <p class="mt-2 leading-loose text-gray-600 text-justify">
                 We hope this message finds you well. We would like to confirm if your order has been safely
                 received.
             </p>

             <p class="mt-2 leading-loose text-gray-600 text-justify">Please click the link below to confirm the
                 receipt
                 of the goods:</p>

             <div class="flex justify-center">
                 <a href="{{ route('customer.dashboard.shipping.index') }}"
                     class="btn btn-primary mt-4 flex justify-center">Confirmation Receive Product</a>
             </div>

             <p class="mt-8 leading-loose text-gray-600 text-justify">Kindly confirm the receipt of the goods before
                 [{{ $shipping->max_confirm->format('d F Y') }}]. If no confirmation is received after due date, we
                 will assume that
                 the goods have been received successfully. You can track your shipment by clicking on the link
                 below</p>

             <div class="flex justify-center">
                 <a href="{{ $shipping->tracking_link }}" class="btn btn-primary mt-8" target="__blank">Tracking
                     Order</a>
             </div>

             <p class="mt-4 leading-loose text-gray-600 text-justify">If you have any questions, please do not
                 hesitate
                 to contact us </p>
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
