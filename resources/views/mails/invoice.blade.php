@extends('layouts.mail')

@section('title')
    Invoice
@endsection

@section('content')
    <div class="hero p-20 md:p-32" style="background-image: url({{ asset('assets/images/hero2.jpg') }});">
        <div class="hero-overlay bg-opacity-60"></div>
    </div>

    <!-- start main content section -->
    <div x-data="invoicePreview" class="mx-0 lg:mx-72 lg:p-4">
        <div class="panel p-8 lg:p-10">
            <div class="flex flex-wrap justify-between items-center gap-4 px-4">
                <div>
                    <div class="text-2xl font-semibold uppercase">Invoice</div>
                    <div class="badge badge-success text-white badge-md px-4 py-2">PAID</div>
                </div>

                <div class="shrink-0">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="image" class="w-32 lg:w-40 ltr:ml-auto rtl:mr-auto" />
                </div>
            </div>

            <div class="px-4 ltr:text-right rtl:text-left">
                <div class="mt-6 space-y-1 text-white-dark">
                    <div>13 Tetrick Road, Cypress Gardens, Florida, 33884, US</div>
                    <div>vristo@gmail.com</div>
                    <div>+1 (070) 123-4567</div>
                </div>
            </div>

            <hr class="my-6 border-[#e0e6ed] dark:border-[#1b2e4b]" />
            <div class="flex flex-col flex-wrap justify-between gap-6 lg:flex-row">
                <div class="flex-1">
                    <div class="space-y-1 text-white-dark">
                        <div>Issue For:</div>
                        <div class="font-semibold text-black dark:text-white">John Doe</div>
                        <div>405 Mulberry Rd. Mc Grady, NC, 28649</div>
                        <div>redq@company.com</div>
                        <div>(128) 666 070</div>
                    </div>
                </div>
                <div class="flex flex-col justify-between gap-6 sm:flex-row lg:w-2/3">
                    <div class="xl:1/3 sm:w-1/2 lg:w-2/5">
                        <div class="mb-2 flex w-full items-center justify-between">
                            <div class="text-white-dark">Invoice :</div>
                            <div>#8701</div>
                        </div>
                        <div class="mb-2 flex w-full items-center justify-between">
                            <div class="text-white-dark">Issue Date :</div>
                            <div>13 Sep 2022</div>
                        </div>
                        <div class="mb-2 flex w-full items-center justify-between">
                            <div class="text-white-dark">Order ID :</div>
                            <div>#OD-85794</div>
                        </div>
                        <div class="flex w-full items-center justify-between">
                            <div class="text-white-dark">Shipment ID :</div>
                            <div>#SHP-8594</div>
                        </div>
                    </div>
                    <div class="xl:1/3 sm:w-1/2 lg:w-2/5">
                        <div class="mb-2 flex w-full items-center justify-between">
                            <div class="text-white-dark">Bank Name:</div>
                            <div class="whitespace-nowrap">Bank Of America</div>
                        </div>
                        <div class="mb-2 flex w-full items-center justify-between">
                            <div class="text-white-dark">Account Number:</div>
                            <div>1234567890</div>
                        </div>
                        <div class="mb-2 flex w-full items-center justify-between">
                            <div class="text-white-dark">SWIFT Code:</div>
                            <div>S58K796</div>
                        </div>
                        <div class="mb-2 flex w-full items-center justify-between">
                            <div class="text-white-dark">IBAN:</div>
                            <div>L5698445485</div>
                        </div>
                        <div class="mb-2 flex w-full items-center justify-between">
                            <div class="text-white-dark">Country:</div>
                            <div>United States</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive mt-6">
                <table class="table-striped">
                    <thead>
                        <tr>
                            <template x-for="item in columns" :key="item.key">
                                <th :class="[item.class]" x-text="item.label"></th>
                            </template>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="item in items" :key="item.id">
                            <tr>
                                <td x-text="item.id"></td>
                                <td x-text="item.title"></td>
                                <td x-text="item.quantity"></td>
                                <td class="ltr:text-right rtl:text-left" x-text="`$${item.price}`"></td>
                                <td class="ltr:text-right rtl:text-left" x-text="`$${item.amount}`"></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            <div class="mt-6 grid grid-cols-1 sm:grid-cols-1">
                <div></div>
                <div class="space-y-2 ltr:text-right rtl:text-left">
                    <div class="flex items-center">
                        <div class="flex-1">Subtotal</div>
                        <div class="w-[37%]">$3255</div>
                    </div>
                    <div class="flex items-center">
                        <div class="flex-1">Tax</div>
                        <div class="w-[37%]">$700</div>
                    </div>
                    <div class="flex items-center">
                        <div class="flex-1">Shipping Rate</div>
                        <div class="w-[37%]">$0</div>
                    </div>
                    <div class="flex items-center">
                        <div class="flex-1">Discount</div>
                        <div class="w-[37%]">$10</div>
                    </div>
                    <div class="flex items-center text-lg font-semibold">
                        <div class="flex-1">Grand Total</div>
                        <div class="w-[37%]">$3945</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main content section -->
@endsection
