<!-- start header section -->
<header class="z-40" :class="{ 'dark': $store.app.semidark && $store.app.menu === 'horizontal' }">
    <div class="shadow-sm">
        <div class="relative flex w-full items-center gap-4 bg-white px-5 py-2.5 dark:bg-[#0e1726]">
            <div class="horizontal-logo flex items-center justify-between ltr:mr-2 rtl:ml-2 lg:hidden">
                <a href="javascript:void(0);" class="main-logo flex shrink-0 items-center">
                    <img class="inline w-24  ltr:-ml-1 rtl:-mr-1" src="{{ asset('assets/images/logo.png') }}"
                        alt="image" />
                </a>

                <a href="javascript:;"
                    class="collapse-icon flex flex-none rounded-full bg-white-light/40 p-2 hover:bg-white-light/90 hover:text-primary ltr:ml-2 rtl:mr-2 dark:bg-dark/40 dark:text-[#d0d2d6] dark:hover:bg-dark/60 dark:hover:text-primary lg:hidden"
                    @click="$store.app.toggleSidebar()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 7L4 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        <path opacity="0.5" d="M20 12L4 12" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" />
                        <path d="M20 17L4 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </a>
            </div>

            <div x-data="header"
                class="flex items-center space-x-1.5 ltr:ml-auto rtl:mr-auto rtl:space-x-reverse dark:text-[#d0d2d6] sm:flex-1 ltr:sm:ml-0 sm:rtl:mr-0 lg:space-x-2">
                <div class="sm:ltr:mr-auto sm:rtl:ml-auto" x-data="{ search: false }" @click.outside="search = false">
                    <form
                        class="absolute inset-x-0 top-1/2 z-10 mx-4 hidden -translate-y-1/2 sm:relative sm:top-0 sm:mx-0 sm:block sm:translate-y-0"
                        :class="{ '!block': search }" @submit.prevent="search = false">
                        <div class="relative">
                            <input type="text"
                                class="peer form-input bg-gray-100 text-xs ltr:pl-9 ltr:pr-9 rtl:pl-9 rtl:pr-9 sm:bg-transparent ltr:sm:pr-4 rtl:sm:pl-4"
                                placeholder="Search by keyword" />
                            <button type="button"
                                class="absolute inset-0 h-9 w-9 appearance-none peer-focus:text-primary ltr:right-auto rtl:left-auto">
                                <svg class="mx-auto" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor"
                                        stroke-width="1.5" opacity="0.5" />
                                    <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" />
                                </svg>
                            </button>
                            <button type="button"
                                class="absolute top-1/2 block -translate-y-1/2 hover:opacity-80 ltr:right-2 rtl:left-2 sm:hidden"
                                @click="search = false">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle opacity="0.5" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="1.5" />
                                    <path d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>
                    </form>
                    <button type="button"
                        class="search_btn rounded-full bg-white-light/40 p-2 hover:bg-white-light/90 dark:bg-dark/40 dark:hover:bg-dark/60 sm:hidden"
                        @click="search = ! search">
                        <svg class="mx-auto h-4.5 w-4.5 dark:text-[#d0d2d6]" width="20" height="20"
                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor" stroke-width="1.5"
                                opacity="0.5" />
                            <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" />
                        </svg>
                    </button>
                </div>

                <div>
                    <a href="{{ route('carts.indexFront') }}"
                        class="flex items-center rounded-full bg-white-light/40 p-2 hover:bg-white-light/90 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60">
                        <div tabindex="0" role="button" class="">
                            <div class="indicator">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <span class="badge badge-sm indicator-item bg-red-500"></span>
                            </div>
                        </div>
                    </a>

                </div>

                <div>
                    <a href="javascript:;" x-cloak x-show="$store.app.theme === 'light'" href="javascript:;"
                        class="flex items-center rounded-full bg-white-light/40 p-2 hover:bg-white-light/90 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60"
                        @click="$store.app.toggleTheme('dark')">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="5" stroke="currentColor" stroke-width="1.5" />
                            <path d="M12 2V4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M12 20V22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M4 12L2 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M22 12L20 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path opacity="0.5" d="M19.7778 4.22266L17.5558 6.25424" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" />
                            <path opacity="0.5" d="M4.22217 4.22266L6.44418 6.25424" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" />
                            <path opacity="0.5" d="M6.44434 17.5557L4.22211 19.7779" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" />
                            <path opacity="0.5" d="M19.7778 19.7773L17.5558 17.5551" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </a>
                    <a href="javascript:;" x-cloak x-show="$store.app.theme === 'dark'" href="javascript:;"
                        class="flex items-center rounded-full bg-white-light/40 p-2 hover:bg-white-light/90 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60"
                        @click="$store.app.toggleTheme('system')">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M21.0672 11.8568L20.4253 11.469L21.0672 11.8568ZM12.1432 2.93276L11.7553 2.29085V2.29085L12.1432 2.93276ZM21.25 12C21.25 17.1086 17.1086 21.25 12 21.25V22.75C17.9371 22.75 22.75 17.9371 22.75 12H21.25ZM12 21.25C6.89137 21.25 2.75 17.1086 2.75 12H1.25C1.25 17.9371 6.06294 22.75 12 22.75V21.25ZM2.75 12C2.75 6.89137 6.89137 2.75 12 2.75V1.25C6.06294 1.25 1.25 6.06294 1.25 12H2.75ZM15.5 14.25C12.3244 14.25 9.75 11.6756 9.75 8.5H8.25C8.25 12.5041 11.4959 15.75 15.5 15.75V14.25ZM20.4253 11.469C19.4172 13.1373 17.5882 14.25 15.5 14.25V15.75C18.1349 15.75 20.4407 14.3439 21.7092 12.2447L20.4253 11.469ZM9.75 8.5C9.75 6.41182 10.8627 4.5828 12.531 3.57467L11.7553 2.29085C9.65609 3.5593 8.25 5.86509 8.25 8.5H9.75ZM12 2.75C11.9115 2.75 11.8077 2.71008 11.7324 2.63168C11.6686 2.56527 11.6538 2.50244 11.6503 2.47703C11.6461 2.44587 11.6482 2.35557 11.7553 2.29085L12.531 3.57467C13.0342 3.27065 13.196 2.71398 13.1368 2.27627C13.0754 1.82126 12.7166 1.25 12 1.25V2.75ZM21.7092 12.2447C21.6444 12.3518 21.5541 12.3539 21.523 12.3497C21.4976 12.3462 21.4347 12.3314 21.3683 12.2676C21.2899 12.1923 21.25 12.0885 21.25 12H22.75C22.75 11.2834 22.1787 10.9246 21.7237 10.8632C21.286 10.804 20.7293 10.9658 20.4253 11.469L21.7092 12.2447Z"
                                fill="currentColor" />
                        </svg>
                    </a>
                    <a href="javascript:;" x-cloak x-show="$store.app.theme === 'system'" href="javascript:;"
                        class="flex items-center rounded-full bg-white-light/40 p-2 hover:bg-white-light/90 hover:text-primary dark:bg-dark/40 dark:hover:bg-dark/60"
                        @click="$store.app.toggleTheme('light')">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3 9C3 6.17157 3 4.75736 3.87868 3.87868C4.75736 3 6.17157 3 9 3H15C17.8284 3 19.2426 3 20.1213 3.87868C21 4.75736 21 6.17157 21 9V14C21 15.8856 21 16.8284 20.4142 17.4142C19.8284 18 18.8856 18 17 18H7C5.11438 18 4.17157 18 3.58579 17.4142C3 16.8284 3 15.8856 3 14V9Z"
                                stroke="currentColor" stroke-width="1.5" />
                            <path opacity="0.5" d="M22 21H2" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" />
                            <path opacity="0.5" d="M15 15H9" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" />
                        </svg>
                    </a>
                </div>

                <div class="dropdown flex-shrink-0" x-data="dropdown" @click.outside="open = false">
                    <a href="javascript:;" class="group relative" @click="toggle()">
                        <span><img class="h-9 w-9 rounded-full object-cover saturate-50 group-hover:saturate-100"
                                src="{{ auth()->user()->avatar ? auth()->user()->avatar() : 'https://eu.ui-avatars.com/api/?name=' . auth()->user()->username . '&size=150' }}"
                                alt="image" /></span>
                    </a>
                    <ul x-cloak x-show="open" x-transition x-transition.duration.300ms
                        class="top-11 w-[230px] !py-0 font-semibold text-dark ltr:right-0 rtl:left-0 dark:text-white-dark dark:text-white-light/90">
                        <li>
                            <div class="flex items-center px-4 py-4">
                                <div class="flex-none">
                                    <img class="h-10 w-10 rounded-md object-cover"
                                        src="{{ auth()->user()->avatar ? auth()->user()->avatar() : 'https://eu.ui-avatars.com/api/?name=' . auth()->user()->username . '&size=150' }}"
                                        alt="image" />
                                </div>
                                <div class="truncate ltr:pl-4 rtl:pr-4">
                                    <h4 class="text-base">
                                        {{ auth()->user()->username }}
                                    </h4>
                                    <a class="text-black/60 hover:text-primary dark:text-dark-light/60 dark:hover:text-white"
                                        href="javascript:;">{{ auth()->user()->email }}</a>
                                </div>
                            </div>
                        </li>
                        @if (auth()->user()->isAdmin())
                            <li>
                                <a href="{{ route('admin.dashboard.profile.edit') }}" class="dark:hover:text-white"
                                    @click="toggle">
                                    <svg class="h-4.5 w-4.5 shrink-0 ltr:mr-2 rtl:ml-2" width="18" height="18"
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="6" r="4" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <path opacity="0.5"
                                            d="M20 17.5C20 19.9853 20 22 12 22C4 22 4 19.9853 4 17.5C4 15.0147 7.58172 13 12 13C16.4183 13 20 15.0147 20 17.5Z"
                                            stroke="currentColor" stroke-width="1.5" />
                                    </svg>
                                    Profile</a>
                            </li>
                        @endif

                        @if (auth()->user()->isCustomer())
                            <li>
                                <a href="{{ route('customer.dashboard.profile.edit') }}" class="dark:hover:text-white"
                                    @click="toggle">
                                    <svg class="h-4.5 w-4.5 shrink-0 ltr:mr-2 rtl:ml-2" width="18" height="18"
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="6" r="4" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <path opacity="0.5"
                                            d="M20 17.5C20 19.9853 20 22 12 22C4 22 4 19.9853 4 17.5C4 15.0147 7.58172 13 12 13C16.4183 13 20 15.0147 20 17.5Z"
                                            stroke="currentColor" stroke-width="1.5" />
                                    </svg>
                                    Profile</a>
                            </li>
                        @endif

                        @if (auth()->user()->isSeller())
                            <li>
                                <a href="{{ route('seller.dashboard.profile.edit') }}" class="dark:hover:text-white"
                                    @click="toggle">
                                    <svg class="h-4.5 w-4.5 shrink-0 ltr:mr-2 rtl:ml-2" width="18" height="18"
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="6" r="4" stroke="currentColor"
                                            stroke-width="1.5" />
                                        <path opacity="0.5"
                                            d="M20 17.5C20 19.9853 20 22 12 22C4 22 4 19.9853 4 17.5C4 15.0147 7.58172 13 12 13C16.4183 13 20 15.0147 20 17.5Z"
                                            stroke="currentColor" stroke-width="1.5" />
                                    </svg>
                                    Profile</a>
                            </li>
                        @endif

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <li class="border-t border-white-light dark:border-white-light/10">
                                <button type="submit" class="!py-3 text-danger" @click="toggle">
                                    <svg class="h-4.5 w-4.5 shrink-0 rotate-90 ltr:mr-2 rtl:ml-2" width="18"
                                        height="18" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path opacity="0.5"
                                            d="M17 9.00195C19.175 9.01406 20.3529 9.11051 21.1213 9.8789C22 10.7576 22 12.1718 22 15.0002V16.0002C22 18.8286 22 20.2429 21.1213 21.1215C20.2426 22.0002 18.8284 22.0002 16 22.0002H8C5.17157 22.0002 3.75736 22.0002 2.87868 21.1215C2 20.2429 2 18.8286 2 16.0002L2 15.0002C2 12.1718 2 10.7576 2.87868 9.87889C3.64706 9.11051 4.82497 9.01406 7 9.00195"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        <path d="M12 15L12 2M12 2L15 5.5M12 2L9 5.5" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Sign Out
                                </button>
                            </li>
                        </form>
                    </ul>
                </div>
            </div>
        </div>

        <!-- horizontal menu -->
        <ul
            class="horizontal-menu hidden border-t border-[#ebedf2] bg-white px-6 py-1.5 font-semibold text-black rtl:space-x-reverse dark:border-[#191e3a] dark:bg-[#0e1726] dark:text-white-dark lg:space-x-1.5 xl:space-x-8">
            <li class="menu nav-item relative ">
                <a href="javascript:;"
                    class="nav-link  {{ request()->is('admin/dashboard', 'customer/dashboard') ? 'bg-primary text-white ' : 'text-black dark:text-white' }}">
                    <div class="flex items-center">
                        <span class="mdi mdi-home-outline text-xl"></span>
                        <span class="px-1">Dashboard</span>
                    </div>
                    <div class="right_arrow">
                        <svg class="h-4 w-4 rotate-90" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                </a>
                <ul class="sub-menu">
                    @if (auth()->user()->isAdmin())
                        <li>
                            <a href="{{ route('admin.dashboard.index') }}"
                                class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">Main Dashboard</a>
                        </li>
                    @endif

                    @if (auth()->user()->isCustomer())
                        <li>
                            <a href="{{ route('customer.dashboard.index') }}"
                                class="{{ request()->is('customer/dashboard') ? 'active' : '' }}">Main Dashboard</a>
                        </li>
                    @endif

                </ul>
            </li>
            @if (auth()->user()->isAdmin())
                <li class="menu nav-item relative">
                    <a href="javascript:;" class="nav-link ">
                        <div class="flex items-center">
                            <span class="mdi mdi-apps text-lg"></span>
                            <span class="px-1">Daily Activity</span>
                        </div>
                        <div class="right_arrow">
                            <svg class="h-4 w-4 rotate-90" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="#" ">Product</a>
                        </li>
                        <li>
                            <a
                                href="#" ">Order</a>
                        </li>
                        <li>
                            <a
                                href="#" ">Invoice</a>
                        </li>
                    </ul>
                </li>
                <li class="menu nav-item relative">
                    <a href="javascript:;"
                        class="nav-link {{ request()->is('admin/dashboard/weavers/*', 'admin/dashboard/customers/*') ? 'bg-primary text-white' : 'text-black dark:text-white' }}"">
                                <div class="flex items-center">
                                    <span class="mdi mdi-account-group-outline text-xl"></span>
                                    <span class="px-1">Management Users</span>
                                </div>
                                <div class="right_arrow">
                                    <svg class="h-4 w-4 rotate-90" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('admin.dashboard.weavers.index') }}"
                                        class="{{ request()->is('admin/dashboard/weavers', 'admin/dashboard/weavers/create', 'admin/dashboard/weavers/edit/*') ? 'active' : '' }}">Weaver</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.dashboard.customers.index') }}"
                                        class="{{ request()->is('admin/dashboard/customers', 'admin/dashboard/customers/create', 'admin/dashboard/customers/edit/*') ? 'active' : '' }}">Customer</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu nav-item relative">
                            <a href="javascript:;"
                                class="nav-link {{ request()->is('admin/dashboard/products/*', 'admin/dashboard/items/*') ? 'bg-primary text-white' : 'text-black dark:text-white' }}"">
                                <div class="flex items-center">
                                    <span class="mdi mdi-hub-outline text-lg"></span>
                                    <span class="px-1">Management Production</span>
                                </div>
                                <div class="right_arrow">
                                    <svg class="h-4 w-4 rotate-90" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('admin.dashboard.items.categories.index') }}"
                                        class="{{ request()->is('admin/dashboard/items/*') ? 'active' : '' }}">Item
                                        Category</a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.dashboard.products.categories.index') }}"
                                        class="{{ request()->is('admin/dashboard/products/*') ? 'active' : '' }}">Product
                                        Category</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu nav-item relative">
                            <a href="javascript:;"
                                class="nav-link {{ request()->is('admin/dashboard/logs') ? 'bg-primary text-white' : 'text-black dark:text-white' }}"">
                                <div class="flex items-center">
                                    <span class="mdi mdi-math-log text-lg"></span>
                                    <span class="px-1">Logs</span>
                                </div>
                                <div class="right_arrow">
                                    <svg class="h-4 w-4 rotate-90" width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{ route('admin.dashboard.logs.index') }}"
                                        class="{{ request()->is('admin/dashboard/logs') ? 'active' : '' }}">Recent
                                        Activities</a>
                                </li>
                            </ul>
                        </li>
            @endif

            @if (auth()->user()->isCustomer())
                <li class="menu nav-item relative">
                    <a href="javascript:;"
                        class="nav-link {{ request()->is('customer/dashboard/address', 'customer/dashboard/address/*') ? 'bg-primary text-white' : 'text-black dark:text-white' }}"">
                        <div class="flex items-center">
                            <span class="mdi mdi-apps text-lg"></span>
                            <span class="px-1">Information Address</span>
                        </div>
                        <div class="right_arrow">
                            <svg class="h-4 w-4 rotate-90" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{ route('customer.dashboard.address.index') }}" ">Your Address</a>
                        </li>
                    </ul>
                </li>
 @endif
                    </ul>
    </div>
</header>
