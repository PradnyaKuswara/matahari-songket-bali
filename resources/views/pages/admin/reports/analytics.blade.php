@extends('layouts.dashboard')

@section('title')
    Analytic Report
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
    <div x-data="analyticsReport">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Report</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Analytics</span>
            </li>
        </ul>

        <div class="grid grid-cols-12 gap-4 mt-5">
            <div class="col-span-12">
                <div class="panel mt-4 ">
                    <div class="flex justify-between items-center mt-4">
                        <div class="flex flex-col">
                            <h1 class="text-base font-bold" x-text="totalActiveUser"></h1>
                            <h1 class="text-base font-bold" x-text="totalScreenPageViews"></h1>
                        </div>
                        <div class="flex flex-col">
                            <label class="form-control w-full max-w-lg">
                                <div class="label">
                                    <span class="label-text">Filter</span>
                                </div>
                                <select
                                    class="select select-bordered bg-white dark:bg-black border border-primary focus:border-primary w-full md:max-w-80"
                                    x-on:change.debounce="getDataAnalytic" x-model="year">
                                    <option disabled selected>Pick one</option>
                                    <option value="7" selected>Last 7 days</option>
                                    <option value="14">Last 14 days</option>
                                    <option value="30">Last 30 days</option>
                                    <option value="60">Last 60 days</option>
                                </select>
                            </label>
                        </div>

                    </div>

                    <div id="chart" class="mt-10 max-w-screen-lg mx-auto">
                        <div x-ref="analyticsChart" class="rounded-lg bg-white dark:bg-black">
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


            <div class="col-span-12">
                <div class="panel mt-4">
                    <div class="panel-header">
                        <h1 class="text-xl font-bold">Most Visited Pages</h1>
                    </div>
                    <div class="panel-body mt-4">
                        <div x-ref="tableMostVisited" class="overflow-x-auto">
                            <table class="table w-full">
                                <thead>
                                    <tr>
                                        <th>Page</th>
                                        <th>Full Page URL</th>
                                        <th>Views</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="mostVisitedPage in mostVisitedPages"
                                        :key="mostVisitedPage.fullPageUrl">
                                        <tr>
                                            <td x-text="mostVisitedPage.pageTitle"></td>
                                            <td class="max-w-xl break-words" x-text="mostVisitedPage.fullPageUrl"></td>
                                            <td x-text="mostVisitedPage.screenPageViews"></td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12">
                <div class="panel mt-4">
                    <div class="panel-header">
                        <h1 class="text-xl font-bold">Top Countries</h1>
                    </div>
                    <div class="panel-body mt-4">
                        <div x-ref="tableTopCountries" class="overflow-x-auto">
                            <table class="table w-full">
                                <thead>
                                    <tr>
                                        <th>Country</th>
                                        <th>Views</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="topCountry in topCountries" :key="topCountry.country">
                                        <tr>
                                            <td x-text="topCountry.country"></td>
                                            <td x-text="topCountry.screenPageViews"></td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
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
            Alpine.data('analyticsReport', () => ({
                init() {
                    this.mostVisitedPages = this.analyticsData.mostVisitedPages;
                    this.topCountries = this.analyticsData.topCountries;

                    isDark =
                        this.$store.app.theme === "dark" || this.$store.app.isDarkMode ?
                        true :
                        false;
                    isRtl = this.$store.app.rtlClass === "rtl" ? true : false;

                    setTimeout(() => {
                        this.analyticsChart = new ApexCharts(
                            this.$refs.analyticsChart,
                            this.analyticsChartOptions
                        );
                        this.$refs.analyticsChart.innerHTML = "";
                        this.analyticsChart.render();
                    }, 300);

                    this.$watch("$store.app.theme", () => {
                        isDark =
                            this.$store.app.theme === "dark" ||
                            this.$store.app.isDarkMode ?
                            true :
                            false;

                        this.analyticsChart.updateOptions(this.analyticsChartOptions);
                    });

                    this.$watch("$store.app.rtlClass", () => {
                        isRtl = this.$store.app.rtlClass === "rtl" ? true : false;
                        this.analyticsChart.updateOptions(this.analyticsChartOptions);
                    });

                    this.totalActiveUser = `Total Active User: ${this.analyticsData.totalActiveUsers}`;
                    this.totalScreenPageViews =
                        `Total Screen Page Views: ${this.analyticsData.totalScreenPageViews}`;
                },

                year: '{{ now()->format('Y') }}',
                analyticsChart: null,
                totalActiveUser: "Total Active User: 0",
                totalScreenPageViews: "Total Screen Page Views: 0",
                endpoint: '{{ route('admin.dashboard.reports.analytics') }}',
                analyticsData: @json($data),
                mostVisitedPages: [],
                topCountries: [],

                getDataAnalytic() {
                    $.ajax({
                        url: this.endpoint,
                        type: 'GET',
                        data: {
                            period: this.year
                        },
                        beforeSend: () => {
                            //chart display hidden
                            this.$refs.analyticsChart.innerHTML = "";
                        }
                    }).done((response) => {
                        //update table mostVIsitedPages
                        this.mostVisitedPages = response.mostVisitedPages;



                        //update chart
                        this.analyticsChart.updateSeries([{
                            name: "Screen Page Views",
                            data: response.analyticsData.map(day => {
                                return day.screenPageViews
                            }),
                        }, ]);

                        this.analyticsChart.updateOptions({
                            labels: response.analyticsData.map(day => {
                                return day.date
                            }),
                        });

                    }).fail((error) => {
                        console.log(error);
                    });
                },

                get analyticsChartOptions() {
                    return {
                        series: [{
                            name: "Screen Page Views",
                            data: this.analyticsData.analyticsData.map(day => {
                                return day.screenPageViews ? day.screenPageViews : 0
                            }),
                        }, ],
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
                        labels: this.analyticsData.analyticsData.map(day => {
                            return day.date
                        }),
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
                                    return value;
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
