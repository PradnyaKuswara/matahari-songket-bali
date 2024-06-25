@extends('layouts.auth')

@section('page-title')
    Payment | Matahari Songket Bali
@endsection

@push('css')
    <style>
        @media print {

            .no-print,
            .no-print * {
                display: none !important;
                margin: 0px;
                padding: 0px;
            }
        }
    </style>
@endpush

@section('content')
    @php
        session()->forget('link-direct-checkout');
    @endphp
    <section x-data="checkout"
        class="min-h-screen xl:max-w-screen-xl lg:max-w-screen-xl lg:mx-auto pt-10 py-14 md:px-14 lg:px-0 lg:pt-28 mx-4 md:mx-0 lg:mt-80 2xl:mt-10">
        <div x-intersect:enter="intersect=true" x-intersect:leave="intersect=false"
            class="flex flex-col md:flex-row px-4 lg:px-0">
            <h1 class="text-4xl font-bold " :class="intersect ? 'animate-fade-right' : 'opacity-0'">Payment Menu</h1>
        </div>

        <div class="grid lg:grid-cols-3 mt-4 gap-4">
            <div class="col-span-3 lg:col-span-2">
                <x-invoice :order="$order"></x-invoice>
            </div>
            <div class="col-span-3 lg:col-span-1 no-print">
                <div x-ref="snapContainer" id="snap-container-card" class="w-full h-full hidden lg:flex"></div>
            </div>
        </div>

        <div class="fixed bottom-0 left-0 right-0 bg-white opacity-100 p-4 shadow-lg z-[200] lg:hidden">
            <button @click="payNow()" type="button" class="btn btn-primary w-full mt-2">Pay Now</button>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client-key') }}">
    </script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('checkout', () => ({
                init() {
                    if (window.innerWidth > 1024) {
                        window.snap.embed(this.snapToken, {
                            embedId: 'snap-container-card',
                            onSuccess: function(result) {
                                window.location.href =
                                    '{{ route('checkout.successView') }}';
                            },
                            // Optional
                            onPending: function(result) {
                                const notify = new Notyf({
                                    duration: 5000,
                                    position: {
                                        x: 'right',
                                        y: 'top',
                                    },
                                });

                                notify.error('Payment is pending');

                                window.location.reload();
                            },
                            // Optional
                            onError: function(result) {
                                const notify = new Notyf({
                                    duration: 5000,
                                    position: {
                                        x: 'right',
                                        y: 'top',
                                    },
                                });

                                notify.error(
                                    'Payment is failed. Please try make a payment again'
                                );
                                window.location.href = '{{ route('products.indexFront') }}';
                            },

                            onClose: function(result) {
                                const notify = new Notyf({
                                    duration: 5000,
                                    position: {
                                        x: 'right',
                                        y: 'top',
                                    },
                                });

                                notify.error('Payment is close');

                                window.location.reload();
                            },
                        });
                    }
                },
                intersect: false,
                order: '{{ $order->id }}',
                snapToken: '{{ $order->transaction->snap_token }}',

                payNow() {
                    window.snap.pay(this.snapToken, {
                        onSuccess: function(result) {
                            window.location.href =
                                '{{ route('checkout.successView') }}';
                        },
                        // Optional
                        onPending: function(result) {
                            const notify = new Notyf({
                                duration: 5000,
                                position: {
                                    x: 'right',
                                    y: 'top',
                                },
                            });

                            notify.error('Payment is pending');
                        },
                        // Optional
                        onError: function(result) {
                            const notify = new Notyf({
                                duration: 5000,
                                position: {
                                    x: 'right',
                                    y: 'top',
                                },
                            });

                            notify.error(
                                'Payment is failed. Please try make a payment again'
                            );
                            window.location.href =
                                '{{ route('products.indexFront') }}';
                        },

                        onClose: function(result) {
                            const notify = new Notyf({
                                duration: 5000,
                                position: {
                                    x: 'right',
                                    y: 'top',
                                },
                            });

                            notify.error('Payment is close');
                        },
                    });
                },
            }));
        });
    </script>
@endpush
