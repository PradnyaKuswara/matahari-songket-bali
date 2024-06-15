@extends('layouts.dashboard')

@section('title')
    Revenue Report
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
    <div x-data="revenueReport">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Report</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Revenue</span>
            </li>
        </ul>

        <div class="grid grid-cols-12 gap-4 mt-5">
            <div class="col-span-12">
                <div class="panel max-w-screen-md mx-auto no-print">
                    <h1 class="text-lg text-center">Form Input Revenue Report</h1>
                    <label class="form-control w-full ">
                        <div class="label">
                            <span class="label-text">Year</span>
                        </div>
                        <select class="select select-bordered" name="year" id="year" x-model="year">
                            <option disabled selected>Pick one</option>
                            @for ($i = 2023; $i <= date('Y'); $i++)
                                <option value="{{ $i }}" {{ $i == now()->format('Y') ? 'selected' : '' }}>
                                    {{ $i }}</option>
                            @endfor
                        </select>
                        <button @click="getReportRevenue()" class="btn btn-primary max-w-md mx-auto mt-4">Search</button>
                    </label>
                </div>
                <div class="panel mt-4 ">
                    <div class="flex gap-2 items-center justify-end print:hidden mt-4">
                        <a href="javascript:window.print()" class="btn bg-neutral text-white"><span
                                class="mdi mdi-printer-outline"></span>
                            Print</a>
                    </div>

                    <div id="table" class="mt-4">
                        @include('pages.admin.reports.results-revenue')
                    </div>

                    <div id="chart" class="mt-10 max-w-screen-lg mx-auto">
                        <div x-ref="revenueChart" class="rounded-lg bg-white dark:bg-black">
                            <!-- loader -->
                            <div
                                class="grid min-h-[325px] place-content-center bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08]">
                                <span
                                    class="inline-flex h-5 w-5 animate-spin rounded-full border-2 border-black !border-l-transparent dark:border-white"></span>
                            </div>
                        </div>
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
            Alpine.data('revenueReport', () => ({
                init() {
                    isDark =
                        this.$store.app.theme === "dark" || this.$store.app.isDarkMode ?
                        true :
                        false;
                    isRtl = this.$store.app.rtlClass === "rtl" ? true : false;

                    setTimeout(() => {
                        this.revenueChart = new ApexCharts(
                            this.$refs.revenueChart,
                            this.revenueChartOptions
                        );
                        this.$refs.revenueChart.innerHTML = "";
                        this.revenueChart.render();
                    }, 300);

                    this.$watch("$store.app.theme", () => {
                        isDark =
                            this.$store.app.theme === "dark" ||
                            this.$store.app.isDarkMode ?
                            true :
                            false;

                        this.revenueChart.updateOptions(this.revenueChartOptions);
                    });

                    this.$watch("$store.app.rtlClass", () => {
                        isRtl = this.$store.app.rtlClass === "rtl" ? true : false;
                        this.revenueChart.updateOptions(this.revenueChartOptions);
                    });
                },

                year: '{{ now()->format('Y') }}',
                endpoint: '{{ route('admin.dashboard.reports.revenue.store') }}',
                revenueChart: null,

                getReportRevenue() {
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
                            //chart display hidden
                            this.$refs.revenueChart.innerHTML = "";
                        }
                    }).done((response) => {
                        $('#table').html(response.html);
                        $('#submit-report').html('Search');
                        //update chart
                        this.revenueChart.updateSeries([{
                                name: "Net Income",
                                data: response.dataChartNetIncome,
                            },
                            {
                                name: "Expenses",
                                data: response.dataChartExpenses,
                            },
                        ]);

                    }).fail((error) => {
                        console.log(error);
                        $('#submit-report').html('Search')
                    });
                },

                get revenueChartOptions() {
                    return {
                        series: [{
                                name: "Net Income",
                                data: [
                                    0, 0, 0, 0, 0, 0, 0,
                                    0, 0, 0, 0, 0,
                                ],
                            },
                            {
                                name: "Expenses",
                                data: [
                                    0, 0, 0, 0, 0, 0, 0,
                                    0, 0, 0, 0, 0,
                                ],
                            },
                        ],
                        chart: {
                            height: 325,
                            type: "area",
                            fontFamily: "Nunito, sans-serif",
                            zoom: {
                                enabled: true,
                            },
                            toolbar: {
                                show: true,
                            },
                        },
                        dataLabels: {
                            enabled: true,
                        },
                        stroke: {
                            show: true,
                            curve: "smooth",
                            width: 2,
                            lineCap: "square",
                        },
                        dropShadow: {
                            enabled: true,
                            opacity: 0.2,
                            blur: 10,
                            left: -7,
                            top: 22,
                        },
                        colors: isDark ? ["#4600ff", "#ff6f00"] : ["#4600ff", "#ff6f00"],
                        markers: {
                            discrete: [{
                                    seriesIndex: 0,
                                    dataPointIndex: 6,
                                    fillColor: "#4600ff",
                                    strokeColor: "transparent",
                                    size: 7,
                                },
                                {
                                    seriesIndex: 1,
                                    dataPointIndex: 5,
                                    fillColor: "#ff6f00",
                                    strokeColor: "transparent",
                                    size: 7,
                                },
                            ],
                        },
                        labels: [
                            "Jan",
                            "Feb",
                            "Mar",
                            "Apr",
                            "May",
                            "Jun",
                            "Jul",
                            "Aug",
                            "Sep",
                            "Oct",
                            "Nov",
                            "Dec",
                        ],
                        xaxis: {
                            axisBorder: {
                                show: false,
                            },
                            axisTicks: {
                                show: false,
                            },
                            crosshairs: {
                                show: true,
                            },
                            labels: {
                                offsetX: isRtl ? 2 : 0,
                                offsetY: 5,
                                style: {
                                    fontSize: "12px",
                                    cssClass: "apexcharts-xaxis-title",
                                },
                            },
                        },
                        yaxis: {
                            tickAmount: 7,
                            labels: {
                                formatter: (value) => {
                                    return value / 1000 + "K";
                                },
                                offsetX: isRtl ? -30 : -10,
                                offsetY: 0,
                                style: {
                                    fontSize: "12px",
                                    cssClass: "apexcharts-yaxis-title",
                                },
                            },
                            opposite: isRtl ? true : false,
                        },
                        grid: {
                            borderColor: isDark ? "#191e3a" : "#e0e6ed",
                            strokeDashArray: 5,
                            xaxis: {
                                lines: {
                                    show: true,
                                },
                            },
                            yaxis: {
                                lines: {
                                    show: true,
                                },
                            },
                            padding: {
                                top: 0,
                                right: 0,
                                bottom: 0,
                                left: 0,
                            },
                        },
                        legend: {
                            position: "top",
                            horizontalAlign: "right",
                            fontSize: "16px",
                            markers: {
                                width: 10,
                                height: 10,
                                offsetX: -2,
                            },
                            itemMargin: {
                                horizontal: 10,
                                vertical: 5,
                            },
                        },
                        tooltip: {
                            marker: {
                                show: true,
                            },
                            x: {
                                show: true,
                            },
                        },
                        fill: {
                            type: "gradient",
                            gradient: {
                                shadeIntensity: 1,
                                inverseColors: !1,
                                opacityFrom: isDark ? 0.19 : 0.28,
                                opacityTo: 0.05,
                                stops: isDark ? [100, 100] : [45, 100],
                            },
                        },
                    };
                },
            }));
        });
    </script>
@endpush
