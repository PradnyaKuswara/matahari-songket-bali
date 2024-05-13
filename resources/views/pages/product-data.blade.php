 @foreach ($products as $product)
     <x-product-card :product="$product" class="shadow-md"></x-product-card>
     <x-loading-card></x-loading-card>
 @endforeach
