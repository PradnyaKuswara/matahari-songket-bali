@extends('layouts.mail')

@section('title')
    Invoice Unpaid
@endsection

@section('content')
    <div class="max-w-screen-md mx-auto">
        <div class="flex flex-col">
            <h1 class="text-3xl font-extrabold">Reminder Invoice</h1>
            <p class="text-xl">Halo </p>
            <p class="text-lg">Reminder untuk invoice ... milikmu. Berikut detail invoice pembelian anda. </p>
        </div>

        <div class="card p-6 bg-white animate-fade mt-10">
            <div class="flex justify-between gap-4">
                <div class="">
                    <img class="h-8 md:h-16" src="{{ asset('assets/images/logo.png') }}" alt="Logo">
                </div>

                <div class="text-end">
                    <h2 class="text-2xl md:text-3xl font-semibold text-gray-800">Invoice # </h2>
                    <span class="badge badge-error bg-error rounded ms-auto text-white">Unpaid</span>

                    <address class="mt-4 not-italic text-gray-800">
                        1093 Coleman Avenue<br>
                        Escondido<br>
                        CA 92025<br>
                        United States<br>
                    </address>
                </div>
            </div>

            <div class="mt-8 grid grid-cols-2 gap-3 ">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Bill to:</h3>
                    <h3 class="text-lg font-semibold text-gray-800">Sara Williams</h3>
                    <address class="mt-2 not-italic text-gray-500">
                        1274 Stark Hollow Road,<br>
                        Denver, CO 80202,<br>
                        United States<br>
                    </address>
                </div>

                <div class="text-end space-y-2">
                    <div class="grid md:grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
                        <dl class="grid  gap-x-3">
                            <dt class=" font-semibold text-gray-800">Invoice date:</dt>
                            <dd class=" text-gray-500">07/08/2023</dd>
                        </dl>
                        <dl class="grid gap-x-3 place-content-end place-items-end">
                            <dt class=" font-semibold text-gray-800">Due date:</dt>
                            <dd class=" text-gray-500">05/12/2023</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="mt-6">
                <div class="border border-gray-200 p-4 rounded-lg space-y-4">
                    <div class="grid grid-cols-5">
                        <div class="sm:col-span-2 text-xs font-medium text-gray-500 uppercase">Item</div>
                        <div class="text-left text-xs font-medium text-gray-500 uppercase">Qty</div>
                        <div class="text-left text-xs font-medium text-gray-500 uppercase">Rate</div>
                        <div class="text-end text-xs font-medium text-gray-500 uppercase">Amount</div>
                    </div>

                    <div class="hidden sm:block border-b border-gray-200"></div>

                    <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                        <div class="col-span-full sm:col-span-2">
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Item</h5>
                            <p class="font-medium text-gray-800">Admin Design</p>
                        </div>
                        <div>
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Qty</h5>
                            <p class="text-gray-800">1</p>
                        </div>
                        <div>
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Rate</h5>
                            <p class="text-gray-800">8</p>
                        </div>
                        <div>
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Amount</h5>
                            <p class="sm:text-end text-gray-800">$500</p>
                        </div>
                    </div>

                    <div class="sm:hidden border-b border-gray-200"></div>

                    <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                        <div class="col-span-full sm:col-span-2">
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Item</h5>
                            <p class="font-medium text-gray-800">Website Desgin project</p>
                        </div>
                        <div>
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Qty</h5>
                            <p class="text-gray-800">1</p>
                        </div>
                        <div>
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Rate</h5>
                            <p class="text-gray-800">32</p>
                        </div>
                        <div>
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Amount</h5>
                            <p class="sm:text-end text-gray-800">$1550</p>
                        </div>
                    </div>

                    <div class="sm:hidden border-b border-gray-200"></div>

                    <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                        <div class="col-span-full sm:col-span-2">
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Item</h5>
                            <p class="font-medium text-gray-800">SEO Marketing</p>
                        </div>
                        <div>
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Qty</h5>
                            <p class="text-gray-800">1</p>
                        </div>
                        <div>
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Rate</h5>
                            <p class="text-gray-800">6</p>
                        </div>
                        <div>
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase">Amount</h5>
                            <p class="sm:text-end text-gray-800">$3000</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Table -->

            <div class="mt-8 flex justify-end">
                <div class="w-full max-w-2xl sm:text-end space-y-2">
                    <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
                        <dl class="grid sm:grid-cols-5 gap-x-3">
                            <dt class="col-span-3 font-semibold text-gray-800">Subtotal:</dt>
                            <dd class="col-span-2 text-gray-500">$3000.00</dd>
                        </dl>

                        <dl class="grid sm:grid-cols-5 gap-x-3">
                            <dt class="col-span-3 font-semibold text-gray-800">Total:</dt>
                            <dd class="col-span-2 text-gray-500">$3000.00</dd>
                        </dl>

                        <dl class="grid sm:grid-cols-5 gap-x-3">
                            <dt class="col-span-3 font-semibold text-gray-800">Tax:</dt>
                            <dd class="col-span-2 text-gray-500">$300.00</dd>
                        </dl>

                        <dl class="grid sm:grid-cols-5 gap-x-3">
                            <dt class="col-span-3 font-semibold text-gray-800">Amount paid:</dt>
                            <dd class="col-span-2 text-gray-500">$3300.00</dd>
                        </dl>

                        <dl class="grid sm:grid-cols-5 gap-x-3">
                            <dt class="col-span-3 font-semibold text-gray-800">Due balance:</dt>
                            <dd class="col-span-2 text-gray-500">$0.00</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="mt-8 sm:mt-12">
                <h4 class="text-lg font-semibold text-gray-800">Thank you!</h4>
                <p class="text-gray-500">If you have any questions concerning this invoice, use the following contact
                    information:</p>
                <div class="mt-2">
                    <p class="block text-sm font-medium text-gray-800">example@site.com</p>
                    <p class="block text-sm font-medium text-gray-800">+1 (062) 109-9222</p>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <p class="mt-5 text-sm text-gray-500">© {{ now()->format('Y') }} Matahari Songket Bali.</p>
            </div>
        </div>

        <div class="flex flex-col mt-10">
            <p class="md:text-xl">Pembayran akan jatuh tempo dalam hari kedepan maksimal tanggal .... Segera lakukan pembayaran
                dengan mengakses menu dashboard anda atau klik bayar sekarang dibawah ini </p>
            <a href="#" class="btn btn-primary mt-4 w-52 mx-auto">Bayar Sekarang</a>
            <p class="text-center font-bold mt-4">Note: ini adalah email notifikasi sistem kami. Silahkan akses dashboard
                area anda untuk terhubung dengan layanan anda. </p>
        </div>
    </div>
@endsection
