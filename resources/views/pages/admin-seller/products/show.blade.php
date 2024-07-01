@extends('layouts.dashboard')

@section('title')
    Products
@endsection

@section('content')
    <div>
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Dashboard</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Products</span>
            </li>
        </ul>

        <div x-data="products" class="grid grid-cols-2 gap-2 lg:grid-cols-4 2xl:grid-cols-5 lg:gap-4 mt-5">
            @forelse ($products as $product)
                <div class="col-span-1">
                    <x-product-card :product="$product" class="shadow-md border bg-white dark:bg-black"></x-product-card>
                </div>
            @empty
                <div class="card col-span-5">
                    <div class="card-body bg-white dark:bg-black">
                        <div class="text-center">
                            <p class="text-lg">There is no products</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
        <div class="mt-2">
            {{ $products->links('components.dashboard.pagination') }}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('products', () => ({
                init() {
                    this.loading = false;
                    this.card = true;
                },
                loading: false,
                card: false,
            }));
        });
    </script>
@endpush
