@extends('layouts.dashboard')

@section('title')
    Main Dashboard
@endsection

@section('content')
    <!-- start main content section -->
    <div x-data="sales">
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
                <div class="mb-6 grid gap-6 xl:grid-cols-3">
                    <div class="panel h-full xl:col-span-2">
                        <div class="mb-5 flex items-center dark:text-white-light">
                            <h5 class="text-lg font-semibold">Revenue</h5>
                            <div x-data="dropdown" @click.outside="open = false"
                                class="dropdown ltr:ml-auto rtl:mr-auto">
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
                                    <li><a href="javascript:;" @click="toggle">Weekly</a></li>
                                    <li><a href="javascript:;" @click="toggle">Monthly</a></li>
                                    <li><a href="javascript:;" @click="toggle">Yearly</a></li>
                                </ul>
                            </div>
                        </div>
                        <p class="text-lg dark:text-white-light/90">Total Profit <span
                                class="ml-2 text-primary">$10,840</span>
                        </p>
                        <div class="relative overflow-hidden">
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

                    <div class="panel h-full">
                        <div class="mb-5 flex items-center">
                            <h5 class="text-lg font-semibold dark:text-white-light">Sales By Category</h5>
                        </div>
                        <div class="overflow-hidden">
                            <div x-ref="salesByCategory" class="rounded-lg bg-white dark:bg-black">
                                <!-- loader -->
                                <div
                                    class="grid min-h-[353px] place-content-center bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08]">
                                    <span
                                        class="inline-flex h-5 w-5 animate-spin rounded-full border-2 border-black !border-l-transparent dark:border-white"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-6 grid gap-6 sm:grid-cols-2 xl:grid-cols-2">

                    <div class="panel h-full">
                        <div class="mb-5 flex items-center dark:text-white-light">
                            <h5 class="text-lg font-semibold">Summary</h5>
                            <div x-data="dropdown" @click.outside="open = false"
                                class="dropdown ltr:ml-auto rtl:mr-auto">
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
                                    <li><a href="javascript:;" @click="toggle">View Report</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="space-y-9">
                            <div class="flex items-center">
                                <div class="h-9 w-9 ltr:mr-3 rtl:ml-3">
                                    <div
                                        class="grid h-9 w-9 place-content-center rounded-full bg-secondary-light text-secondary dark:bg-secondary dark:text-secondary-light">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M3.74157 18.5545C4.94119 20 7.17389 20 11.6393 20H12.3605C16.8259 20 19.0586 20 20.2582 18.5545M3.74157 18.5545C2.54194 17.1091 2.9534 14.9146 3.77633 10.5257C4.36155 7.40452 4.65416 5.84393 5.76506 4.92196M3.74157 18.5545C3.74156 18.5545 3.74157 18.5545 3.74157 18.5545ZM20.2582 18.5545C21.4578 17.1091 21.0464 14.9146 20.2235 10.5257C19.6382 7.40452 19.3456 5.84393 18.2347 4.92196M20.2582 18.5545C20.2582 18.5545 20.2582 18.5545 20.2582 18.5545ZM18.2347 4.92196C17.1238 4 15.5361 4 12.3605 4H11.6393C8.46374 4 6.87596 4 5.76506 4.92196M18.2347 4.92196C18.2347 4.92196 18.2347 4.92196 18.2347 4.92196ZM5.76506 4.92196C5.76506 4.92196 5.76506 4.92196 5.76506 4.92196Z"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <path opacity="0.5"
                                                d="M9.1709 8C9.58273 9.16519 10.694 10 12.0002 10C13.3064 10 14.4177 9.16519 14.8295 8"
                                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="mb-2 flex font-semibold text-white-dark">
                                        <h6>Income</h6>
                                        <p class="ltr:ml-auto rtl:mr-auto">$92,600</p>
                                    </div>
                                    <div class="h-2 rounded-full bg-dark-light shadow dark:bg-[#1b2e4b]">
                                        <div
                                            class="h-full w-11/12 rounded-full bg-gradient-to-r from-[#7579ff] to-[#b224ef]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="h-9 w-9 ltr:mr-3 rtl:ml-3">
                                    <div
                                        class="grid h-9 w-9 place-content-center rounded-full bg-success-light text-success dark:bg-success dark:text-success-light">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M4.72848 16.1369C3.18295 14.5914 2.41018 13.8186 2.12264 12.816C1.83509 11.8134 2.08083 10.7485 2.57231 8.61875L2.85574 7.39057C3.26922 5.59881 3.47597 4.70292 4.08944 4.08944C4.70292 3.47597 5.59881 3.26922 7.39057 2.85574L8.61875 2.57231C10.7485 2.08083 11.8134 1.83509 12.816 2.12264C13.8186 2.41018 14.5914 3.18295 16.1369 4.72848L17.9665 6.55812C20.6555 9.24711 22 10.5916 22 12.2623C22 13.933 20.6555 15.2775 17.9665 17.9665C15.2775 20.6555 13.933 22 12.2623 22C10.5916 22 9.24711 20.6555 6.55812 17.9665L4.72848 16.1369Z"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <circle opacity="0.5" cx="8.60699" cy="8.87891" r="2"
                                                transform="rotate(-45 8.60699 8.87891)" stroke="currentColor"
                                                stroke-width="1.5" />
                                            <path opacity="0.5" d="M11.5417 18.5L18.5208 11.5208" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="mb-2 flex font-semibold text-white-dark">
                                        <h6>Profit</h6>
                                        <p class="ltr:ml-auto rtl:mr-auto">$37,515</p>
                                    </div>
                                    <div class="h-2 w-full rounded-full bg-dark-light shadow dark:bg-[#1b2e4b]">
                                        <div class="h-full w-full rounded-full bg-gradient-to-r from-[#3cba92] to-[#0ba360]"
                                            style="width: 65%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="h-9 w-9 ltr:mr-3 rtl:ml-3">
                                    <div
                                        class="grid h-9 w-9 place-content-center rounded-full bg-warning-light text-warning dark:bg-warning dark:text-warning-light">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12C22 15.7712 22 17.6569 20.8284 18.8284C19.6569 20 17.7712 20 14 20H10C6.22876 20 4.34315 20 3.17157 18.8284C2 17.6569 2 15.7712 2 12Z"
                                                stroke="currentColor" stroke-width="1.5" />
                                            <path opacity="0.5" d="M10 16H6" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" />
                                            <path opacity="0.5" d="M14 16H12.5" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" />
                                            <path opacity="0.5" d="M2 10L22 10" stroke="currentColor" stroke-width="1.5"
                                                stroke-linecap="round" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="mb-2 flex font-semibold text-white-dark">
                                        <h6>Expenses</h6>
                                        <p class="ltr:ml-auto rtl:mr-auto">$55,085</p>
                                    </div>
                                    <div class="h-2 w-full rounded-full bg-dark-light shadow dark:bg-[#1b2e4b]">
                                        <div class="h-full w-full rounded-full bg-gradient-to-r from-[#f09819] to-[#ff5858]"
                                            style="width: 80%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel h-full">
                        <div class="mb-5 flex items-center justify-between dark:text-white-light">
                            <h5 class="text-lg font-semibold">Transactions</h5>
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
                                    <li><a href="javascript:;" @click="toggle">View Report</a></li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            @forelse ($transactions as $transaction)
                                <div class="space-y-6">
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

                <div class="mb-6 grid gap-6 sm:grid-cols-2 xl:grid-cols-3">

                </div>

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    <div class="panel h-full w-full">
                        <div class="mb-5 flex items-center justify-between">
                            <h5 class="text-lg font-semibold dark:text-white-light">Recent Orders</h5>
                        </div>
                        <div class="table-responsive">
                            <table>
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
                            <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">Rp.{{ number_format($totalPrice, 2, ',', '.') }}</div>
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
