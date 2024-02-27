@extends('layouts.app')

@section('page-title')
    Home | Matahari Songket Bali
@endsection

@section('content')
    <div class="hero min-h-screen" id="hero">
        <div class="hero-content text-center">
            <div class="max-w-md">
                <div id="typed-strings">
                    <span>Welcome to My Channel.</span>
                </div>
                <span id="typed" class="text-4xl"></span>
                <p class="py-6">Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem
                    quasi. In deleniti eaque aut repudiandae et a id nisi.</p>
                <button class="btn btn-primary">About Product</button>
                <button class="btn btn-neutral">Explore Now</button>
            </div>
        </div>
    </div>

    <div class="container max-w-screen-lg py-20 mx-auto">
        <div class="flex align-middle justify-start p-5">
            <h1 class="text-4xl font-bold">Our Products</h1>
        </div>
        <div class="flex align-middle justify-start p-5">
            <h1 class="text-4xl font-bold">Our Products</h1>
        </div>
        <div class="flex align-middle justify-start p-5">
            <h1 class="text-4xl font-bold">Our Products</h1>
        </div>
        <div class="flex align-middle justify-start p-5">
            <h1 class="text-4xl font-bold">Our Products</h1>
        </div>
        <div class="flex align-middle justify-start p-5">
            <h1 class="text-4xl font-bold">Our Products</h1>
        </div>
        <div class="flex align-middle justify-start p-5">
            <h1 class="text-4xl font-bold">Our Products</h1>
        </div>
        <div class="flex align-middle justify-start p-5">
            <h1 class="text-4xl font-bold">Our Products</h1>
        </div>
        <div class="flex align-middle justify-start p-5">
            <h1 class="text-4xl font-bold">Our Products</h1>
        </div>
        <div class="flex align-middle justify-start p-5">
            <h1 class="text-4xl font-bold">Our Products</h1>
        </div>
    </div>
@endsection

@push('script')
    <script type="module">
        const typed = new Typed('#typed', {
            stringsElement: '#typed-strings',
            loop: true,
            loopCount: Infinity,
            typeSpeed: 50,
            backSpeed: 50,
        });
    </script>
@endpush
