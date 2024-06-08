 <!-- start sidebar section -->
 <div :class="{ 'dark text-white-dark': $store.app.semidark }">
     <nav x-data="sidebar"
         class="sidebar fixed bottom-0 top-0 z-50 h-full min-h-screen w-[260px] shadow-[5px_0_25px_0_rgba(94,92,154,0.1)] transition-all duration-300 no-print">
         <div class="h-full bg-white dark:bg-[#0e1726]">
             <div class="flex items-center justify-between px-4 py-3">
                 <a href="javascript:void(0)" class="main-logo flex items-center shrink-0 overflow-hidden">
                     <img class=" w-10 flex-none" src="{{ asset('assets/images/logo_icon.png') }}" alt="image" />
                     <span>
                         <img class="ml-2 w-20 flex-none" src="{{ asset('assets/images/logo_text.png') }}"
                             alt="image" />
                     </span>
                 </a>
                 <a href="javascript:;"
                     class="collapse-icon flex h-8 w-8 items-center rounded-full transition duration-300 hover:bg-gray-500/10 rtl:rotate-180 dark:text-white-light dark:hover:bg-dark-light/10"
                     @click="$store.app.toggleSidebar()">
                     <svg class="m-auto h-5 w-5" width="20" height="20" viewBox="0 0 24 24" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                         <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                             stroke-linejoin="round" />
                         <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor"
                             stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                     </svg>
                 </a>
             </div>

             <ul class="perfect-scrollbar relative h-[calc(100vh-80px)] space-y-0.5 overflow-y-auto overflow-x-hidden p-4 py-0 font-semibold "
                 x-data="{ activeDropdown: null }">

                 <li class="nav-item">
                     <ul>
                         @if (auth()->user()->isAdmin())
                             <li class="nav-item">
                                 <a href="{{ route('admin.dashboard.index') }}"
                                     class="group {{ request()->is('admin/dashboard') ? 'bg-primary text-white' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-gauge text-xl {{ request()->is('admin/dashboard') ? 'text-white' : '' }}"></span>
                                         <span
                                             class="{{ request()->is('admin/dashboard') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3  dark:group-hover:text-white-dark">Dashboard</span>
                                     </div>
                                 </a>
                             </li>
                         @endif

                         @if (auth()->user()->isCustomer())
                             <li class="nav-item">
                                 <a href="{{ route('customer.dashboard.index') }}"
                                     class="group {{ request()->is('customer/dashboard') ? 'bg-primary text-white' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-gauge text-xl {{ request()->is('customer/dashboard') ? 'text-white' : '' }}"></span>
                                         <span
                                             class="{{ request()->is('customer/dashboard') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:group-hover:text-white-dark">Dashboard</span>
                                     </div>
                                 </a>
                             </li>
                         @endif

                         @if (auth()->user()->isSeller())
                             <li class="nav-item">
                                 <a href="{{ route('seller.dashboard.index') }}"
                                     class="group {{ request()->is('seller/dashboard') ? 'bg-primary text-white' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-gauge text-xl {{ request()->is('seller/dashboard') ? 'text-white' : '' }}"></span>
                                         <span
                                             class="{{ request()->is('seller/dashboard') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:group-hover:text-white-dark">Dashboard</span>
                                     </div>
                                 </a>
                             </li>
                         @endif
                     </ul>
                 </li>


                 @if (!auth()->user()->isCustomer())
                     <li class="nav-item">
                         <ul>
                             <li class="nav-item">
                                 <a href="{{ route(request()->user()->role->name . '.dashboard.products.show') }}"
                                     class="group {{ request()->is(request()->user()->role->name . '/dashboard/products/show') ? 'bg-primary text-white' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-apps text-xl {{ request()->is(request()->user()->role->name . '/dashboard/products/show') ? 'text-white' : '' }}"></span>
                                         <span
                                             class="{{ request()->is(request()->user()->role->name . '/dashboard/products/show') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Product</span>
                                     </div>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ route(request()->user()->role->name . '.dashboard.orders.show') }}"
                                     class="group {{ request()->is(request()->user()->role->name . '/dashboard/orders/show') || request()->is(request()->user()->role->name . '/dashboard/orders/detail-order/*') ? 'bg-primary text-white' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-order-bool-descending-variant text-xl {{ request()->is(request()->user()->role->name . '/dashboard/orders/show') || request()->is(request()->user()->role->name . '/dashboard/orders/detail-order/*') ? 'text-white' : '' }}"></span>
                                         <span
                                             class="{{ request()->is(request()->user()->role->name . '/dashboard/orders/show') || request()->is(request()->user()->role->name . '/dashboard/orders/detail-order/*') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Order</span>
                                     </div>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ route(request()->user()->role->name . '.dashboard.transactions.show') }}"
                                     class="group {{ request()->is(request()->user()->role->name . '/dashboard/transactions/show') || request()->is(request()->user()->role->name . '/dashboard/transactions/detail-transaction/*') ? 'bg-primary text-white' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-invoice-text-multiple-outline text-xl {{ request()->is(request()->user()->role->name . '/dashboard/transactions/show') || request()->is(request()->user()->role->name . '/dashboard/transactions/detail-transaction/*') ? 'text-white' : '' }}"></span>
                                         <span
                                             class="{{ request()->is(request()->user()->role->name . '/dashboard/transactions/show') || request()->is(request()->user()->role->name . '/dashboard/transactions/detail-transaction/*') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Invoice</span>
                                     </div>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ route(request()->user()->role->name . '.dashboard.shippings.showAdminSeller') }}"
                                     class="group {{ request()->is(request()->user()->role->name . '/dashboard/shippings/show') || request()->is(request()->user()->role->name . '/dashboard/shippings/detail-shipping/*') ? 'bg-primary text-white' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-shipping-pallet text-xl {{ request()->is(request()->user()->role->name . '/dashboard/shippings/show') || request()->is(request()->user()->role->name . '/dashboard/shippings/detail-shipping/*') ? 'text-white' : '' }}"></span>
                                         <span
                                             class="{{ request()->is(request()->user()->role->name . '/dashboard/shippings/show') || request()->is(request()->user()->role->name . '/dashboard/shippings/detail-shipping/*') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Shipping</span>
                                     </div>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     <h2
                         class="-mx-4 mb-1 flex items-center bg-white-light/30 px-7 py-3 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
                         <svg class="hidden h-5 w-4 flex-none" viewBox="0 0 24 24" stroke="currentColor"
                             stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <line x1="5" y1="12" x2="19" y2="12"></line>
                         </svg>
                         <span>Management Production</span>
                     </h2>

                     <li class="nav-item">
                         <ul>
                             <li class="nav-item">
                                 <a href="{{ route(request()->user()->role->name . '.dashboard.productions.index') }}"
                                     class="group {{ request()->is(request()->user()->role->name . '/dashboard/productions') || request()->is(request()->user()->role->name . '/dashboard/productions/*') ? 'bg-primary text-white' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-cube-outline text-xl {{ request()->is(request()->user()->role->name . '/dashboard/productions') || request()->is(request()->user()->role->name . '/dashboard/productions/*') ? 'text-white' : '' }}"></span>
                                         <span
                                             class=" {{ request()->is(request()->user()->role->name . '/dashboard/productions') || request()->is(request()->user()->role->name . '/dashboard/productions/*') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Production
                                             Product</span>
                                     </div>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     <li class="nav-item" x-data="{ activeDropdown: @js(request()->is(request()->user()->role->name . '/dashboard/items') || request()->is(request()->user()->role->name . '/dashboard/items/*') ? 'managementItem' : null) }">
                         <button type="button" class="nav-link group"
                             :class="{ 'bg-primary': activeDropdown === 'managementItem' }"
                             @click="activeDropdown === 'managementItem' ? activeDropdown = null : activeDropdown = 'managementItem'">
                             <div class="flex items-center">
                                 <span :class="{ 'text-white': activeDropdown === 'managementItem' }"
                                     class="mdi mdi-card-text-outline text-xl"></span>
                                 <span :class="{ 'text-white': activeDropdown === 'managementItem' }"
                                     class="{{ request()->is(request()->user()->role->name . '/dashboard/items') || request()->is(request()->user()->role->name . '/dashboard/items/*') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Management
                                     Item</span>
                             </div>
                             <div class="rtl:rotate-180"
                                 :class="{ '!rotate-90': activeDropdown === 'managementItem' }">

                                 <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                         stroke-linecap="round" stroke-linejoin="round" />
                                 </svg>
                             </div>
                         </button>
                         <ul x-cloak x-show="activeDropdown === 'managementItem'" x-collapse
                             class="sub-menu text-gray-500">
                             <li>
                                 <a href="{{ route(request()->user()->role->name . '.dashboard.items.index') }}"
                                     class="group {{ request()->is(request()->user()->role->name . '/dashboard/items') ? 'active' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Item
                                             Post</span>
                                     </div>
                                 </a>
                             </li>
                             <li>
                                 <a href="{{ route(request()->user()->role->name . '.dashboard.items.categories.index') }}"
                                     class="group {{ request()->is(request()->user()->role->name . '/dashboard/items/categories') ? 'active' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Item
                                             Category</span>
                                     </div>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     <li class="nav-item" x-data="{ activeDropdown: @js(request()->is(request()->user()->role->name . '/dashboard/products') || request()->is(request()->user()->role->name . '/dashboard/products/categories') ? 'managementProduct' : null) }">
                         <button type="button" class="nav-link group"
                             :class="{ 'bg-primary': activeDropdown === 'managementProduct' }"
                             @click="activeDropdown === 'managementProduct' ? activeDropdown = null : activeDropdown = 'managementProduct'">
                             <div class="flex items-center">
                                 <span :class="{ 'text-white': activeDropdown === 'managementProduct' }"
                                     class="mdi mdi-list-box-outline text-xl"></span>
                                 <span :class="{ 'text-white': activeDropdown === 'managementProduct' }"
                                     class="{{ request()->is(request()->user()->role->name . '/dashboard/products') || request()->is(request()->user()->role->name . '/dashboard/products/categories') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Management
                                     Product</span>
                             </div>
                             <div class="rtl:rotate-180"
                                 :class="{ '!rotate-90': activeDropdown === 'managementProduct' }">

                                 <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path d="M9 5L15 12L9 19" stroke="currentColor" stroke-width="1.5"
                                         stroke-linecap="round" stroke-linejoin="round" />
                                 </svg>
                             </div>
                         </button>

                         <ul x-cloak x-show="activeDropdown === 'managementProduct'" x-collapse
                             class="sub-menu text-gray-500">
                             <li>
                                 <a href="{{ route(request()->user()->role->name . '.dashboard.products.index') }}"
                                     class="group {{ request()->is(request()->user()->role->name . '/dashboard/products') ? 'active' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class=" text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Product
                                             Post</span>
                                     </div>
                                 </a>
                             </li>
                             <li>
                                 <a href="{{ route(request()->user()->role->name . '.dashboard.products.categories.index') }}"
                                     class="group {{ request()->is(request()->user()->role->name . '/dashboard/products/categories') ? 'active' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class=" text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Product
                                             Category</span>
                                     </div>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     <li class="nav-item">
                         <ul>
                             <li class="nav-item">
                                 <a href="{{ route(request()->user()->role->name . '.dashboard.articles.index') }}"
                                     class="group {{ request()->is(request()->user()->role->name . '/dashboard/articles') || request()->is(request()->user()->role->name . '/dashboard/articles/*') ? 'bg-primary text-white' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-post-outline  text-xl {{ request()->is(request()->user()->role->name . '/dashboard/articles') || request()->is(request()->user()->role->name . '/dashboard/articles/*') ? 'text-white' : '' }}"></span>
                                         <span
                                             class=" {{ request()->is(request()->user()->role->name . '/dashboard/articles') || request()->is(request()->user()->role->name . '/dashboard/articles/*') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">What's
                                             new</span>
                                     </div>
                                 </a>
                             </li>
                         </ul>
                     </li>
                 @endif

                 @if (auth()->user()->isSeller())
                     <h2
                         class="-mx-4 mb-1 flex items-center bg-white-light/30 px-7 py-3 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
                         <svg class="hidden h-5 w-4 flex-none" viewBox="0 0 24 24" stroke="currentColor"
                             stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <line x1="5" y1="12" x2="19" y2="12"></line>
                         </svg>
                         <span>Management Shipping</span>
                     </h2>

                     <li class="nav-item">
                         <ul>
                             <li class="nav-item">
                                 <a href="{{ route('seller.dashboard.shippings.index') }}"
                                     class="group {{ request()->is('seller/dashboard/shippings') || request()->is('seller/dashboard/shippings/show/*') ? 'bg-primary text-white' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-truck-cargo-container text-xl {{ request()->is('seller/dashboard/shippings') || request()->is('seller/dashboard/shippings/show/*') ? 'text-white' : '' }}"></span>
                                         <span
                                             class="{{ request()->is('seller/dashboard/shippings') || request()->is('seller/dashboard/shippings/show/*') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Placed
                                             Order</span>
                                     </div>
                                 </a>
                             </li>
                         </ul>
                     </li>
                 @endif

                 @if (auth()->user()->isAdmin())
                     <h2
                         class="-mx-4 mb-1 flex items-center bg-white-light/30 px-7 py-3 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
                         <svg class="hidden h-5 w-4 flex-none" viewBox="0 0 24 24" stroke="currentColor"
                             stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <line x1="5" y1="12" x2="19" y2="12"></line>
                         </svg>
                         <span>Management Users</span>
                     </h2>

                     <li class="nav-item">
                         <ul>
                             <li class="nav-item">
                                 <a href="{{ route('admin.dashboard.weavers.index') }}"
                                     class="group {{ request()->is('admin/dashboard/weavers') ? 'bg-primary text-white' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-account-group-outline text-xl {{ request()->is('admin/dashboard/weavers') ? 'text-white' : '' }}"></span>
                                         <span
                                             class="{{ request()->is('admin/dashboard/weavers') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Weaver</span>
                                     </div>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ route('admin.dashboard.customers.index') }}"
                                     class="group {{ request()->is('admin/dashboard/customers') || request()->is('admin/dashboard/customers/*') ? 'bg-primary text-white' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-account-details-outline text-xl {{ request()->is('admin/dashboard/customers') || request()->is('admin/dashboard/customers/*') ? 'text-white' : '' }}"></span>
                                         <span
                                             class="{{ request()->is('admin/dashboard/customers') || request()->is('admin/dashboard/customers/*') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Customer</span>
                                     </div>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ route('admin.dashboard.sellers.index') }}"
                                     class="group {{ request()->is('admin/dashboard/sellers') ? 'bg-primary text-white' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-account-details-outline text-xl {{ request()->is('admin/dashboard/sellers') ? 'text-white' : '' }}"></span>
                                         <span
                                             class="{{ request()->is('admin/dashboard/sellers') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Seller</span>
                                     </div>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     <h2
                         class="-mx-4 mb-1 flex items-center bg-white-light/30 px-7 py-3 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
                         <svg class="hidden h-5 w-4 flex-none" viewBox="0 0 24 24" stroke="currentColor"
                             stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <line x1="5" y1="12" x2="19" y2="12"></line>
                         </svg>
                         <span>Report</span>
                     </h2>

                     <li class="nav-item">
                         <ul>
                             <li class="nav-item">
                                 <a href="{{ route('admin.dashboard.logs.index') }}"
                                     class="group {{ request()->is('admin/dashboard/logs') ? 'bg-primary text-white' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-math-log text-xl {{ request()->is('admin/dashboard/logs') ? 'text-white' : '' }}"></span>
                                         <span
                                             class="{{ request()->is('admin/dashboard/logs') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark"">Logs
                                             Activity</span>
                                     </div>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ route('admin.dashboard.reports.indexRevenue') }}"
                                     class="group {{ request()->is('admin/dashboard/reports/revenue') ? 'bg-primary text-white' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-cash text-xl {{ request()->is('admin/dashboard/reports/revenue') ? 'text-white' : '' }}"></span>
                                         <span
                                             class="{{ request()->is('admin/dashboard/reports/revenue') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark"">Revenue</span>
                                     </div>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ route('admin.dashboard.reports.indexProducts') }}"
                                     class="group {{ request()->is('admin/dashboard/reports/products') ? 'bg-primary text-white' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-apps text-xl {{ request()->is('admin/dashboard/reports/products') ? 'text-white' : '' }}"></span>
                                         <span
                                             class="{{ request()->is('admin/dashboard/reports/products') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark"">Product</span>
                                     </div>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ route('admin.dashboard.reports.indexAnalytics') }}"
                                     class="group {{ request()->is('admin/dashboard/reports/analytics') ? 'bg-primary text-white' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-eye-settings-outline text-xl {{ request()->is('admin/dashboard/reports/analytics') ? 'text-white' : '' }}"></span>
                                         <span
                                             class="{{ request()->is('admin/dashboard/reports/analytics') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark"">Analytics</span>
                                     </div>
                                 </a>
                             </li>
                         </ul>
                     </li>
                 @endif

                 @if (auth()->user()->isCustomer())
                     <h2
                         class="-mx-4 mb-1 flex items-center bg-white-light/30 px-7 py-3 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
                         <svg class="hidden h-5 w-4 flex-none" viewBox="0 0 24 24" stroke="currentColor"
                             stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <line x1="5" y1="12" x2="19" y2="12"></line>
                         </svg>
                         <span>Order Product</span>
                     </h2>

                     <li class="nav-item">
                         <ul>
                             <li class="nav-item">
                                 <a href="{{ route('products.indexFront') }}" class="group ">
                                     <div class="flex items-center">
                                         <span class="mdi mdi-apps text-xl"></span>
                                         <span
                                             class="{{ request()->is('products') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:group-hover:text-white-dark">Buy
                                             Product</span>
                                     </div>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ route('customer.dashboard.trackingOrder') }}"
                                     class="group {{ request()->is('customer/dashboard/tracking-order') ? 'bg-primary text-white' : '' }} ">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-radar text-xl {{ request()->is('customer/dashboard/tracking-order') ? 'text-white' : '' }}"></span>
                                         <span
                                             class="{{ request()->is('customer/dashboard/tracking-order') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:group-hover:text-white-dark">Tracking
                                             Order</span>
                                     </div>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     <h2
                         class="-mx-4 mb-1 flex items-center bg-white-light/30 px-7 py-3 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
                         <svg class="hidden h-5 w-4 flex-none" viewBox="0 0 24 24" stroke="currentColor"
                             stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <line x1="5" y1="12" x2="19" y2="12"></line>
                         </svg>
                         <span>Management Address</span>
                     </h2>

                     <li class="nav-item">
                         <ul>
                             <li class="nav-item">
                                 <a href="{{ route('customer.dashboard.address.index') }}"
                                     class="group {{ request()->is('customer/dashboard/address') ? 'bg-primary text-white' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-format-list-text text-xl {{ request()->is('customer/dashboard/address') ? 'text-white' : '' }}"></span>
                                         <span
                                             class="{{ request()->is('customer/dashboard/address') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:group-hover:text-white-dark">Address
                                             Detail</span>
                                     </div>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     <h2
                         class="-mx-4 mb-1 flex items-center bg-white-light/30 px-7 py-3 font-extrabold uppercase dark:bg-dark dark:bg-opacity-[0.08]">
                         <svg class="hidden h-5 w-4 flex-none" viewBox="0 0 24 24" stroke="currentColor"
                             stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                             <line x1="5" y1="12" x2="19" y2="12"></line>
                         </svg>
                         <span>Management History</span>
                     </h2>

                     <li class="nav-item">
                         <ul>
                             <li class="nav-item">
                                 <a href="{{ route('customer.dashboard.order.index') }}"
                                     class="group {{ request()->is('customer/dashboard/order') || request()->is('customer/dashboard/order/*') ? 'bg-primary text-white' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-order-bool-descending-variant text-xl {{ request()->is('customer/dashboard/order') || request()->is('customer/dashboard/order/*') ? 'text-white' : '' }}"></span>
                                         <span
                                             class="{{ request()->is('customer/dashboard/order') || request()->is('customer/dashboard/order/*') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:group-hover:text-white-dark">Order</span>
                                     </div>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ route('customer.dashboard.transaction.index') }}"
                                     class="group {{ request()->is('customer/dashboard/transaction') || request()->is('customer/dashboard/transaction/*') ? 'bg-primary text-white' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-invoice-text-multiple-outline text-xl {{ request()->is('customer/dashboard/transaction') || request()->is('customer/dashboard/transaction/*') ? 'text-white' : '' }}"></span>
                                         <span
                                             class="{{ request()->is('customer/dashboard/transaction') || request()->is('customer/dashboard/transaction/*') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:group-hover:text-white-dark">Invoice</span>
                                     </div>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ route('customer.dashboard.shipping.index') }}"
                                     class="group {{ request()->is('customer/dashboard/shipping') || request()->is('customer/dashboard/shipping/*') ? 'bg-primary text-white' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-truck-cargo-container text-xl {{ request()->is('customer/dashboard/shipping') || request()->is('customer/dashboard/shipping/*') ? 'text-white' : '' }}"></span>
                                         <span
                                             class="{{ request()->is('customer/dashboard/shipping') || request()->is('customer/dashboard/shipping/*') ? 'text-white dark:text-white' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:group-hover:text-white-dark">Shipping</span>
                                     </div>
                                 </a>
                             </li>
                         </ul>
                     </li>
                 @endif


             </ul>
         </div>
     </nav>
 </div>
 <!-- end sidebar section -->
