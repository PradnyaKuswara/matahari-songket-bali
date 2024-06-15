@extends('layouts.dashboard')

@section('title')
    Main Dashboard
@endsection

@section('content')
    <!-- start main content section -->
    <div x-data="">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                @if ($user->isAdmin())
                    <a href="{{ route('admin.dashboard.index') }}" class="text-primary hover:underline">Dashboard</a>
                @endif
                @if ($user->isCustomer())
                    <a href="{{ route('customer.dashboard.index') }}" class="text-primary hover:underline">Dashboard</a>
                @endif
                @if ($user->isSeller())
                    <a href="{{ route('seller.dashboard.index') }}" class="text-primary hover:underline">Dashboard</a>
                @endif
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Main</span>
            </li>
        </ul>

        @if ($user->isAdmin() || $user->isSeller())
            <div class="pt-5">
                <div class="mb-6 grid gap-6 xl:grid-cols-3" x-data="revenueReport">
                    <div class="panel h-full xl:col-span-3">
                        <div class="mb-5 flex items-center justify-between dark:text-white-light">
                            <h5 class="text-lg font-semibold">Revenue {{ $year }}</h5>
                            <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                                <a href="javascript:;" @click="toggle">
                                    <svg class="h-5 w-5 text-black/70 hover:!text-primary dark:text-white/70"
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="5" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <circle cx="19" cy="12" r="2" stroke="currentColor"
                                            stroke-width="1.5" />
                                    </svg>
                                </a>
                                <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                                    class="ltr:right-0 rtl:left-0">
                                    <li><a href="{{ route('admin.dashboard.reports.indexRevenue') }}" @click="toggle">View
                                            Report</a></li>
                                </ul>
                            </div>
                        </div>
                        <p class="text-lg dark:text-white-light/90">Total Net Profit <span class="ml-2 text-primary">Rp.
                                {{ number_format($dataTotalNetProfit, 2, ',', '.') }}</span>
                        </p>
                        <div class="relative overflow-hidden">
                            <div x-ref="revenueChartReport" class="rounded-lg bg-white dark:bg-black">
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

                <div class="mb-6 grid gap-6 sm:grid-cols-2 xl:grid-cols-2">

                    <div class="panel h-full w-[22.5rem] lg:w-full">
                        <div class="mb-5 flex items-center justify-between">
                            <h5 class="text-lg font-semibold dark:text-white-light">Recent Orders</h5>
                        </div>
                        <div class="table-responsive overflow-x-auto">
                            <table class="table-hover overflow-auto">
                                <thead>
                                    <tr>
                                        <th class="ltr:rounded-l-md rtl:rounded-r-md">Customer</th>
                                        <th>Order ID</th>
                                        <th>Invoice</th>
                                        <th>Price</th>
                                        <th class="ltr:rounded-r-md rtl:rounded-l-md">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentOrders as $order)
                                        <tr class="group text-white-dark hover:text-black dark:hover:text-white-light/90">
                                            <td class="min-w-[150px] text-black dark:text-white">
                                                <div class="flex items-center">
                                                    <img class="h-8 w-8 rounded-md object-cover ltr:mr-3 rtl:ml-3"
                                                        src="{{ $order->user->avatar ? $order->user->avatar() : 'https://eu.ui-avatars.com/api/?name=' . $order->user->username . '&size=150' }}"
                                                        alt="avatar" />
                                                    <span class="whitespace-nowrap">{{ $order->user->name }}</span>
                                                </div>
                                            </td>
                                            <td><a
                                                    href="{{ route(request()->user()->role->name . '.dashboard.orders.detail-order', $order) }}">{{ $order->generate_id }}</a>
                                            </td>
                                            <td><a
                                                    href="{{ route(request()->user()->role->name . '.dashboard.transactions.detail-transaction', $order->transaction) }}">{{ $order->transaction->generate_id }}</a>
                                            </td>
                                            <td>Rp.{{ number_format($order->transaction->total_price, 2, ',', '.') }}</td>
                                            <td>
                                                @if ($order->transaction->status == 'cancel')
                                                    <div class="badge badge-error badge-outline">Cancel</div>
                                                @endif

                                                @if ($order->transaction->status == 'pending')
                                                    <div class="badge badge-warning badge-outline">Unpaid</div>
                                                @endif

                                                @if ($order->transaction->status == 'settlement')
                                                    <div class="badge badge-success badge-outline">Paid</div>
                                                @endif

                                                @if ($order->transaction->status == 'failed')
                                                    <div class="badge badge-error badge-outline">Failed</div>
                                                @endif

                                                @if ($order->transaction->status == 'refund')
                                                    <div class="badge badge-error badge-outline">Refund</div>
                                                @endif

                                                @if ($order->transaction->status == 'expired')
                                                    <div class="badge badge-error badge-outline">Expired</div>
                                                @endif

                                                @if ($order->transaction->status == 'deny')
                                                    <div class="badge badge-error badge-outline">Deny</div>
                                                @endif

                                                @if ($order->transaction->status == 'capture')
                                                    <div class="badge badge-success badge-outline">Capture</div>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No data available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="panel h-full">
                        <div class="mb-5 flex items-center justify-between dark:text-white-light">
                            <h5 class="text-lg font-semibold">Transactions</h5>
                        </div>
                        <div>
                            @forelse ($transactions as $transaction)
                                <div class="space-y-6 mb-4">
                                    <div class="flex">
                                        <span
                                            class="grid h-9 w-9 shrink-0 place-content-center rounded-md bg-success-light text-base text-success dark:bg-success dark:text-success-light"><img
                                                src="" alt=""></span>
                                        <div class="flex-1 px-3">
                                            <div>{{ $transaction->generate_id }}</div>
                                            <div class="text-xs text-white-dark dark:text-gray-500">
                                                {{ $transaction->updated_at->format('d F Y H:i:s') }}</div>
                                        </div>
                                        <span
                                            class="whitespace-pre px-1 text-base text-success ltr:ml-auto rtl:mr-auto">+Rp.{{ number_format($transaction->total_price, 2, ',', '.') }}</span>
                                    </div>
                                </div>
                            @empty
                            @endforelse

                        </div>
                    </div>
                </div>


                <div class="grid grid-cols-1 gap-6 lg:grid-cols-1">
                    <div class="panel h-full w-full">
                        <div class="mb-5 flex items-center justify-between">
                            <h5 class="text-lg font-semibold dark:text-white-light">Top View Product</h5>
                        </div>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr class="border-b-0">
                                        <th class="ltr:rounded-l-md rtl:rounded-r-md">Product</th>
                                        <th>Goods Price</th>
                                        <th>Sells Price</th>
                                        <th>Viewed</th>
                                        <th class="ltr:rounded-r-md rtl:rounded-l-md">Source</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($popularProducts as $productItem)
                                        <tr class="group text-white-dark hover:text-black dark:hover:text-white-light/90">
                                            <td class="min-w-[150px] text-black dark:text-white">
                                                <div class="flex">
                                                    <img class="h-8 w-8 rounded-md object-cover ltr:mr-3 rtl:ml-3"
                                                        src="{{ $productItem->image1() }}" alt="avatar" />
                                                    <p class="whitespace-nowrap">{{ $productItem->name }} <span
                                                            class="block text-xs text-primary">{{ $productItem->productCategory->name }}</span>
                                                    </p>
                                                </div>
                                            </td>
                                            <td>Rp.{{ number_format($productItem->goods_price, 2, ',', '.') }}</td>
                                            <td>Rp.{{ number_format($productItem->sell_price, 2, ',', '.') }}</td>
                                            <td>{{ $productItem->total }}</td>
                                            <td>
                                                <a class="flex items-center text-danger"
                                                    href="{{ route('products.detailFront', $productItem) }}">
                                                    <svg class="h-3.5 w-3.5 ltr:mr-1 rtl:ml-1 rtl:rotate-180"
                                                        viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12.6644 5.47875L16.6367 9.00968C18.2053 10.404 18.9896 11.1012 18.9896 11.9993C18.9896 12.8975 18.2053 13.5946 16.6367 14.989L12.6644 18.5199C11.9484 19.1563 11.5903 19.4746 11.2952 19.342C11 19.2095 11 18.7305 11 17.7725V15.4279C7.4 15.4279 3.5 17.1422 2 19.9993C2 10.8565 7.33333 8.57075 11 8.57075V6.22616C11 5.26817 11 4.78917 11.2952 4.65662C11.5903 4.52407 11.9484 4.8423 12.6644 5.47875Z"
                                                            stroke="currentColor" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round" />
                                                        <path opacity="0.5"
                                                            d="M15.5386 4.5L20.7548 9.34362C21.5489 10.081 22.0001 11.1158 22.0001 12.1994C22.0001 13.3418 21.4989 14.4266 20.629 15.1671L15.5386 19.5"
                                                            stroke="currentColor" stroke-width="1.5"
                                                            stroke-linecap="round" />
                                                    </svg>
                                                    Direct
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No data available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($user->isCustomer())
            <div class="pt-5">
                <div class="mb-6 grid grid-cols-1 gap-6 text-white sm:grid-cols-2 xl:grid-cols-4">
                    <!-- Users Visit -->
                    <div class="panel bg-gradient-to-r from-cyan-500 to-cyan-400">
                        <div class="flex justify-between">
                            <div class="text-md font-semibold ltr:mr-1 rtl:ml-1">Orders</div>
                        </div>
                        <div class="mt-5 flex items-center">
                            <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{ $totalOrder }}</div>
                        </div>
                        <div class="mt-5 flex items-center font-semibold">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                <path opacity="0.5"
                                    d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                    d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                            The order you have made
                        </div>
                    </div>

                    <!-- Time On-Site -->
                    <div class="panel bg-gradient-to-r from-blue-500 to-blue-400">
                        <div class="flex justify-between">
                            <div class="text-md font-semibold ltr:mr-1 rtl:ml-1">Shipping</div>
                        </div>
                        <div class="mt-5 flex items-center">
                            <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{ $totalShipping }}</div>
                        </div>
                        <div class="mt-5 flex items-center font-semibold">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                <path opacity="0.5"
                                    d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                    d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                            The shipping you have made
                        </div>
                    </div>

                    <!-- Bounce Rate -->
                    <div class="panel bg-gradient-to-r from-fuchsia-500 to-fuchsia-400">
                        <div class="flex justify-between">
                            <div class="text-md font-semibold ltr:mr-1 rtl:ml-1">Product</div>
                        </div>
                        <div class="mt-5 flex items-center">
                            <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{ $totalQuantityProduct }}</div>
                        </div>
                        <div class="mt-5 flex items-center font-semibold">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                <path opacity="0.5"
                                    d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                    d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                            The product you have bought and paid
                        </div>
                    </div>

                    <!-- Sessions -->
                    <div class="panel bg-gradient-to-r from-violet-500 to-violet-400">
                        <div class="flex justify-between">
                            <div class="text-md font-semibold ltr:mr-1 rtl:ml-1">Transaction</div>
                        </div>
                        <div class="mt-5 flex items-center">
                            <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">
                                Rp.{{ number_format($totalPrice, 2, ',', '.') }}</div>
                        </div>
                        <div class="mt-5 flex items-center font-semibold">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                <path opacity="0.5"
                                    d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                    d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                                    stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                            The transaction you have made and paid
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <!-- end main content section -->
@endsection

@push('scripts')
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
                        this.revenueChartReport = new ApexCharts(
                            this.$refs.revenueChartReport,
                            this.revenueChartReportOptions
                        );
                        this.$refs.revenueChartReport.innerHTML = "";
                        this.revenueChartReport.render();
                    }, 300);

                    this.$watch("$store.app.theme", () => {
                        isDark =
                            this.$store.app.theme === "dark" ||
                            this.$store.app.isDarkMode ?
                            true :
                            false;

                        this.revenueChartReport.updateOptions(this.revenueChartReportOptions);
                    });

                    this.$watch("$store.app.rtlClass", () => {
                        isRtl = this.$store.app.rtlClass === "rtl" ? true : false;
                        this.revenueChartReport.updateOptions(this.revenueChartReportOptions);
                    });
                },

                revenueChartReport: null,
                dataChartExpenses: @json($dataChartExpenses),
                dataChartNetIncome: @json($dataChartNetIncome),

                get revenueChartReportOptions() {
                    return {
                        series: [{
                                name: "Net Income",
                                data: this.dataChartNetIncome,
                            },
                            {
                                name: "Expenses",
                                data: this.dataChartExpenses,
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
                                    show: false,
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
                                show: false,
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
