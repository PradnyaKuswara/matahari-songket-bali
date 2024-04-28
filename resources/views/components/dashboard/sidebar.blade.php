<!-- Sidenav Menu Start -->
<div class="app-menu bg-gradient-to-t text-white from-indigo-900 to-[#040849]  ">

    <!-- Brand Logo -->
    <a href="javascript:void(0)" class="logo-box mt-4">
        <img src="{{ asset('assets/images/logo2.png') }}" class="h-12" alt="Light logo">
    </a>

    <!--- Menu -->
    <div data-simplebar>
        <ul class="menu" data-fc-type="accordion">
            <li class="menu-title">Menu</li>

            @if (auth()->user()->role->name == 'admin')
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

            @if (auth()->user()->role->name == 'customer')
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

            @if (auth()->user()->role->name != 'customer' && auth()->user()->role->name != 'weaver')
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

            @if (auth()->user()->role->name == 'admin')
                <li class="menu-title">Data Master</li>
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

            @if (auth()->user()->role->name == 'customer')
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
