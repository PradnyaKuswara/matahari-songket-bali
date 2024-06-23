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
        class="min-h-screen xl:max-w-screen-xl lg:max-w-screen-xl lg:mx-auto pt-10 py-14 md:px-14 lg:px-0 lg:pt-28 mx-4 md:mx-0 lg:mt-80">
        <div x-intersect:enter="intersect=true" x-intersect:leave="intersect=false"
            class="flex flex-col md:flex-row px-4 lg:px-0">
            <h1 class="text-4xl font-bold " :class="intersect ? 'animate-fade-right' : 'opacity-0'">Payment Menu</h1>
        </div>

        <div class="grid md:grid-cols-3 mt-4 gap-4">
            <div class="col-span-3 md:col-span-2">
                <x-invoice :order="$order"></x-invoice>
            </div>
            <div class="col-span-3 md:col-span-1 no-print">
                {{-- //information payment --}}
                {{-- <div class="bg-white p-4 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold">Payment Information</h2>
                    <p class="text-sm my-2">Please complete your payment before the due date</p>
                    <button @click="payNow()" type="button" class="btn btn-primary w-full mt-2">Pay Now</button>

                </div> --}}
                <div id="snap-container-card" class="w-full h-full"></div>
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
                    window.snap.embed(this.snapToken, {
                        embedId: 'snap-container-card',
                        onSuccess: function(result) {
                            window.location.href = '{{ route('checkout.successView') }}';
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
                                'Payment is failed. Please try make a payment again');
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
                },
                intersect: false,
                order: '{{ $order->id }}',
                snapToken: '{{ $order->transaction->snap_token }}',
                endpointCheckStock: '{{ route('checkout.checkStock') }}',

                checkStock() {
                    $.ajax({
                        url: this.endpointCheckStock,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            order_id: this.order,
                        }
                    }).done(response => {
                        console.log(response);
                        this.payNow();
                    }).fail((jqXHR, textStatus, errorThrown) => {
                        const notify = new Notyf({
                            duration: 5000,
                            position: {
                                x: 'right',
                                y: 'top',
                            },
                        });

                        notify.error(
                            'Sorry, the stock is not enough. Please make a payment again.');
                        window.location.href = '{{ route('index') }}';
                    });
                },

                payNow() {
                    snap.pay(this.snapToken, {
                        // Optional
                        onSuccess: function(result) {
                            window.location.href = '{{ route('checkout.successView') }}';
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

                            notify.error('Payment failed');
                        },
                    });
                }
            }));
        });
    </script>
@endpush
