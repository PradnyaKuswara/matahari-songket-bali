@extends('layouts.dashboard')

@section('title')
    Product Report
@endsection

@push('css')
    <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }

            .no-print,
            .no-print * {
                display: none !important;
                margin: 0px;
                padding: 0px;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            table,
            th,
            td {
                border: 1px solid black;
            }

            th,
            td {
                padding: 8px;
                text-align: left;
            }
        }
    </style>
@endpush

@section('content')
    <div x-data="productReport">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Report</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Products</span>
            </li>
        </ul>

        <div class="grid grid-cols-12 gap-4 mt-5">
            <div class="col-span-12">
                <div class="panel max-w-screen-md mx-auto no-print">
                    <h1 class="text-lg text-center">Form Input Products Report</h1>
                    <label class="form-control w-full ">
                        <div class="label">
                            <span class="label-text">Year</span>
                        </div>
                        <select
                            class="select select-bordered bg-white dark:bg-black border border-primary focus:border-primary"
                            name="year" id="year" x-model="year">
                            <option disabled selected>Pick one</option>
                            @for ($i = 2023; $i <= date('Y'); $i++)
                                <option value="{{ $i }}" {{ $i == now()->format('Y') ? 'selected' : '' }}>
                                    {{ $i }}</option>
                            @endfor
                        </select>
                        <button @click="getProductReport()" class="btn btn-primary max-w-md mx-auto mt-4">Search</button>
                    </label>
                </div>
                <div class="panel mt-4 ">
                    <div class="flex gap-2 items-center justify-end print:hidden mt-4">
                        <a href="javascript:window.print()" class="btn bg-neutral text-white"><span
                                class="mdi mdi-printer-outline"></span>
                            Print</a>
                    </div>

                    <div id="table" class="mt-4">
                        @include('pages.admin.reports.results-products')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data('productReport', () => ({
                year: '{{ now()->format('Y') }}',
                endpoint: '{{ route('admin.dashboard.reports.products.store') }}',

                getProductReport() {
                    $.ajax({
                        url: this.endpoint,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            year: this.year,
                        },
                        beforeSend: () => {
                            $('#table').html('');
                            $('#submit-report').html('Loading...');
                        }
                    }).done((response) => {
                        $('#table').html(response.html);
                        $('#submit-report').html('Search');
                    }).fail((error) => {
                        console.log(error);
                        $('#submit-report').html('Search')
                    });
                },
            }));
        });
    </script>
@endpush
