@extends('layouts.mail')

@section('title')
    Thank you for your purchase
@endsection

@section('content')
    <div class="card md:max-w-screen-md mx-auto p-6 bg-white">
        <section class="px-6 py-8">
            <header>
                <a href="#">
                    <img class="w-auto h-16 " src="{{ asset('assets/images/logo.png') }}" alt="">
                </a>
            </header>

            <main class="mt-8">
                <h1 class="text-primary text-lg font-bold">Hi Olivia,</h1>

                <p class="mt-2 leading-loose text-gray-600 text-justify">
                    Thank you for shopping with Mahari Songket Bali. We are thrilled to have you as our customer and hope
                    you are delighted with your recent purchase. We are committed to providing you with the best quality
                    products and exceptional customer service. If you have any questions or need assistance with your order,
                    please do not hesitate to contact us
                </p>



                <p class="mt-8 text-gray-600">
                    Best regards, <br>
                    Matahari Songket Bali Team
                </p>
            </main>


            <footer class="mt-8">

                <p class="text-gray-500">
                    This email was sent to <a href="#" class="text-blue-600 hover:underline dark:text-blue-400"
                        target="_blank">contact@merakiui.com</a>.
                </p>

                <div class="mt-8">
                    <p class="block text-sm font-medium text-gray-800">mataharisongketbali@gmail.com</p>
                    <p class="block text-sm font-medium text-gray-800">+1 (062) 109-9222</p>
                </div>

                <p class="mt-3 text-gray-500">© {{ now()->format('Y') }} Matahari Songket Bali. All
                    Rights
                    Reserved.</p>
            </footer>
        </section>
    </div>
@endsection
