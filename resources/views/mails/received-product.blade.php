@extends('layouts.mail')

@section('title')
    Confirmation Order Shipped
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

                <div class="mt-4">
                    <h2 class="text-lg font-semibold text-gray-800">Order # </h2>
                    <span class="badge badge-success bg-success rounded ms-auto text-white">Shipped</span>
                    <div class="mt-4 not-italic text-gray-800">
                        <p><strong>Shipped Address</strong> : 1093 Coleman Avenue Escondido CA 92025 United States</p>
                        <p><strong>Province</strong> : Bali</p>
                        <p><strong>Postal Code</strong> : 19735</p>
                        <p><strong>Estimated Delivery Date</strong> : 20 Januari 2024 - 27 Januari 2024</p>
                    </div>
                </div>

                <h1 class="text-2xl font-bold mt-8">JNT</h1>
                <p class="text-2xl font-bold">#2122335</p>

                <p class="mt-2 leading-loose text-gray-600 text-justify">
                    We hope this message finds you well. We would like to confirm if your order has been safely received.
                </p>

                <p class="mt-2 leading-loose text-gray-600 text-justify">Please click the link below to confirm the receipt
                    of the goods:</p>

                <div class="flex justify-center">
                    <button class="btn btn-primary mt-4 flex justify-center">Confirmation Receive Product</button>
                </div>


                <p class="mt-8 leading-loose text-gray-600 text-justify">Kindly confirm the receipt of the goods before
                    [confirmation deadline]. If no confirmation is received after due date, we will assume that the goods
                    have
                    been received successfully. You can track your shipment by clicking on the link
                    below:[Tracking Link]</p>

                <p class="mt-4 leading-loose text-gray-600 text-justify">If you have any questions, please do not hesitate
                    to contact us </p>

            </main>


            <footer class="mt-8">

                <p class="text-gray-500">
                    This email was sent to <a href="#" class="text-blue-600 hover:underline"
                        target="_blank">contact@merakiui.com</a>.
                </p>

                <div class="mt-4">
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
