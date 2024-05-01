<!-- Sidenav Menu Start -->
<div class="app-menu bg-gradient-to-t text-white from-indigo-900 to-[#040849]">

    <!-- Brand Logo -->
    <a href="javascript:void(0)" class="logo-box mt-4">
        <img src="{{ asset('assets/images/logo2.png') }}" class="h-12" alt="Light logo">
    </a>

    <!--- Menu -->
    <div data-simplebar="init">
        <ul class="menu" data-fc-type="accordion">
            <li class="menu-title">Menu</li>

            @if (auth()->user()->isAdmin())
                <li class="menu-item">
                    <a href="{{ route('admin.dashboard.index') }}"
                        class="hover:bg-primary hover:text-primary-content waves-effect p-2 {{ request()->is('admin/dashboard') ? 'bg-primary text-primary-content' : '' }}">
                        <div
                            class="rounded-sm px-2 py-[0.2rem] {{ request()->is('admin/dashboard') ? 'bg-blue-600' : 'bg-[#292C64]' }}">
                            <span class="menu-icon"><span class="mdi mdi-home text-md "></span></span>
                        </div>

                        <span class="menu-text font-extrabold"> Dashboard </span>
                        <span class="badge bg-accent rounded ms-auto text-white">01</span>
                    </a>
                </li>
            @endif

            @if (auth()->user()->isCustomer())
                <li class="menu-item">
                    <a href="{{ route('customer.dashboard.index') }}"
                        class="hover:bg-primary hover:text-primary-content waves-effect p-2 {{ request()->is('customer/dashboard') ? 'bg-primary text-primary-content' : '' }}">
                        <div
                            class="bg-[#292C64] rounded-sm px-2 py-[0.2rem] {{ request()->is('customer/dashboard') ? 'bg-blue-600' : 'bg-[#292C64]' }}">
                            <span class="menu-icon"><span class="mdi mdi-home text-md "></span></span>
                        </div>

                        <span class="menu-text font-extrabold"> Dashboard </span>
                        <span class="badge bg-accent rounded ms-auto text-white">01</span>
                    </a>
                </li>
            @endif

            @if (!auth()->user()->isCustomer() && !auth()->user()->isWeaver())
                <li class="menu-item">
                    <a href="#" class="hover:bg-primary hover:text-primary-content waves-effect p-2">
                        <div class="bg-[#292C64] rounded-sm px-2 py-[0.2rem]">
                            <span class="menu-icon"><span class="mdi mdi-view-agenda-outline text-md"></span></span>
                        </div>
                        <span class="menu-text font-extrabold"> Product </span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="#" class="hover:bg-primary hover:text-primary-content waves-effect p-2">
                        <div class="bg-[#292C64] rounded-sm px-2 py-[0.2rem]">
                            <span class="menu-icon"><span class="mdi mdi-order-bool-descending text-md"></span></span>
                        </div>
                        <span class="menu-text font-extrabold"> Order </span>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="#" class="hover:bg-primary hover:text-primary-content waves-effect p-2">
                        <div class="bg-[#292C64] rounded-sm px-2 py-[0.2rem]">
                            <span class="menu-icon"><span class="mdi mdi-invoice-list-outline text-md"></span></span>
                        </div>
                        <span class="menu-text font-extrabold"> Invoice </span>
                    </a>
                </li>
            @endif

            @if (auth()->user()->isAdmin())
                <li class="menu-title">Data Master</li>

                <li class="menu-item">
                    <a href="javascript:void(0)" data-fc-type="collapse"
                        class="menu-link hover:bg-primary hover:text-primary-content waves-effect p-2 fc-collapse focus:bg-none focus:text-primary-content bg-primary text-primary-content">
                        <div class="rounded-sm px-2 py-[0.2rem] bg-[#292C64]">
                            <span class="menu-icon">
                                <span class="mdi mdi-account-multiple text-md"></span>
                            </span>
                        </div>
                        <span class="menu-text font-extrabold"> Management User</span>

                        <div class="menu-arrow"></div>
                    </a>

                    <ul class="sub-menu  {{ request()->is('admin/dashboard/weavers') || request()->is('admin/dashboard/weavers/create') || request()->is('admin/dashboard/weavers/edit/*') || request()->is('admin/dashboard/customers') || request()->is('admin/dashboard/customers/create') || request()->is('admin/dashboard/customers/edit/*')  ? '' : 'hidden' }}"
                        style="">
                        <li class="menu-item">
                            <a href="{{ route('admin.dashboard.weavers.index') }}"
                                class="menu-link p-2 {{ request()->is('admin/dashboard/weavers') || request()->is('admin/dashboard/weavers/create') || request()->is('admin/dashboard/weavers/edit/*') ? 'active' : '' }}">
                                <span class="menu-dot text-white"></span>

                                <span class="menu-text font-extrabold"> Weavers </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('admin.dashboard.customers.index') }}"
                                class="menu-link p-2 {{ request()->is('admin/dashboard/customers') || request()->is('admin/dashboard/customers/create') || request()->is('admin/dashboard/customers/edit/*') ? 'active' : '' }}">
                                <span class="menu-dot text-white"></span>

                                <span class="menu-text font-extrabold"> Customers </span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="menu-item">
                    <a href="{{ route('admin.dashboard.items.categories.index') }}"
                        class="hover:bg-primary hover:text-primary-content waves-effect p-2 {{ request()->is('admin/dashboard/items/categories') || request()->is('admin/dashboard/items/categories/create') || request()->is('admin/dashboard/items/categories/edit/*') ? 'bg-primary text-primary-content' : '' }}">
                        <div
                            class="rounded-sm px-2 py-[0.2rem] {{ request()->is('admin/dashboard/items/categories') || request()->is('admin/dashboard/items/categories/create') || request()->is('admin/dashboard/items/categories/edit/*') ? 'bg-blue-600' : 'bg-[#292C64]' }}"">
                            <span class="menu-icon">
                                <span class="mdi mdi-account-multiple text-md"></span>
                            </span>
                        </div>

                        <span class="menu-text font-extrabold"> Management Item Category </span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.dashboard.products.categories.index') }}"
                        class="hover:bg-primary hover:text-primary-content waves-effect p-2 {{ request()->is('admin/dashboard/products/categories') || request()->is('admin/dashboard/products/categories/create') || request()->is('admin/dashboard/products/categories/edit/*') ? 'bg-primary text-primary-content' : '' }}">
                        <div
                            class="rounded-sm px-2 py-[0.2rem] {{ request()->is('admin/dashboard/products/categories') || request()->is('admin/dashboard/products/categories/create') || request()->is('admin/dashboard/products/categories/edit/*') ? 'bg-blue-600' : 'bg-[#292C64]' }}"">
                            <span class="menu-icon">
                                <span class="mdi mdi-account-multiple text-md"></span>
                            </span>
                        </div>

                        <span class="menu-text font-extrabold"> Management Product Category </span>
                    </a>
                </li>

                <li class="menu-title">Report</li>
                <li class="menu-item">
                    <a href="{{ route('admin.dashboard.logs.index') }}"
                        class="hover:bg-primary hover:text-primary-content waves-effect p-2 {{ request()->is('admin/dashboard/logs') ? 'bg-primary text-primary-content' : '' }}">
                        <div
                            class="rounded-sm px-2 py-[0.2rem] {{ request()->is('admin/dashboard/logs') ? 'bg-blue-600' : 'bg-[#292C64]' }}"">
                            <span class="menu-icon">
                                <span class="mdi mdi-history text-md"></span>
                            </span>
                        </div>

                        <span class="menu-text font-extrabold">History Log </span>
                    </a>
                </li>

            @endif

            @if (auth()->user()->isCustomer())
                {{-- <li class="menu-title">Data Master</li> --}}
                <li class="menu-item">
                    <a href="{{ route('customer.dashboard.address.index') }}"
                        class="hover:bg-primary hover:text-primary-content waves-effect p-2 {{ request()->is('customer/dashboard/address') || request()->is('customer/dashboard/address/create') || request()->is('customer/dashboard/address/edit/*') ? 'bg-primary text-primary-content' : '' }}">
                        <div
                            class="rounded-sm px-2 py-[0.2rem] {{ request()->is('customer/dashboard/address') || request()->is('customer/dashboard/address/create') || request()->is('customer/dashboard/address/edit/*') ? 'bg-blue-600' : 'bg-[#292C64]' }}"">
                            <span class="menu-icon">

                                <span class="mdi mdi-map-marker-outline text-md"></span>
                            </span>
                        </div>

                        <span class="menu-text font-extrabold"> Management Address </span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>
<!-- Sidenav Menu End  -->
