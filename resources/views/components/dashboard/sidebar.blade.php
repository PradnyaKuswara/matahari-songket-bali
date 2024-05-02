 <!-- start sidebar section -->
 <div :class="{ 'dark text-white-dark': $store.app.semidark }">
     <nav x-data="sidebar"
         class="sidebar fixed bottom-0 top-0 z-50 h-full min-h-screen w-[260px] shadow-[5px_0_25px_0_rgba(94,92,154,0.1)] transition-all duration-300">
         <div class="h-full bg-white dark:bg-[#0e1726]">
             <div class="flex items-center justify-between px-4 py-3">
                 <a href="index.html" class="main-logo flex items-center overflow-hidden">
                     <img class="ml-[5px] w-20 flex-none" src="{{ asset('assets/images/logo.png') }}" alt="image" />
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

             <ul class="perfect-scrollbar relative h-[calc(100vh-80px)] space-y-0.5 overflow-y-auto overflow-x-hidden p-4 py-0 font-semibold"
                 x-data="{ activeDropdown: @js(request()->is('admin/dashboard', 'customer/dashboard') ? 'dashboard' : '') }">

                 <li class="nav-item">
                     <ul>
                         @if (auth()->user()->isAdmin())
                             <li class="nav-item">
                                 <a href="{{ route('admin.dashboard.index') }}"
                                     class="group {{ request()->is('admin/dashboard') ? 'bg-primary text-white' : '' }}">
                                     <div class="flex items-center">
                                         <span
                                             class="mdi mdi-home-outline text-xl {{ request()->is('admin/dashboard') ? 'text-white' : '' }}"></span>
                                         <span
                                             class="{{ request()->is('admin/dashboard') ? 'text-white dark:text-[#506690]' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3  dark:group-hover:text-white-dark">Dashboard</span>
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
                                             class="mdi mdi-home-outline text-xl {{ request()->is('customer/dashboard') ? 'text-white' : '' }}"></span>
                                         <span
                                             class="{{ request()->is('admin/dashboard') ? 'text-white dark:text-[#506690]' : 'text-black dark:text-[#506690]' }} ltr:pl-3 rtl:pr-3 dark:group-hover:text-white-dark">Dashboard</span>
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
                                 <a href="#" class="group">
                                     <div class="flex items-center">
                                         <span class="mdi mdi-apps text-xl"></span>
                                         <span
                                             class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Product</span>
                                     </div>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="#" class="group">
                                     <div class="flex items-center">
                                         <span class="mdi mdi-apps text-xl"></span>
                                         <span
                                             class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Order</span>
                                     </div>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="#}" class="group">
                                     <div class="flex items-center">
                                         <span class="mdi mdi-apps text-xl"></span>
                                         <span
                                             class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Invoice</span>
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
                                 <a href="{{ route('admin.dashboard.weavers.index') }}" class="group">
                                     <div class="flex items-center">
                                         <span class="mdi mdi-account-group-outline text-xl"></span>
                                         <span
                                             class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Weaver</span>
                                     </div>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ route('admin.dashboard.customers.index') }}" class="group">
                                     <div class="flex items-center">
                                         <span class="mdi mdi-account-group-outline text-xl"></span>
                                         <span
                                             class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Customer</span>
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
                                 <a href="{{ route('admin.dashboard.items.categories.index') }}" class="group">
                                     <div class="flex items-center">
                                         <span class="mdi mdi-hub-outline text-xl"></span>
                                         <span
                                             class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Item
                                             Category</span>
                                     </div>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ route('admin.dashboard.products.categories.index') }}" class="group">
                                     <div class="flex items-center">
                                         <span class="mdi mdi-hub-outline text-xl"></span>
                                         <span
                                             class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Product
                                             Category</span>
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
                                 <a href="{{ route('admin.dashboard.logs.index') }}" class="group">
                                     <div class="flex items-center">
                                         <span class="mdi mdi-math-log text-xl"></span>
                                         <span
                                             class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Logs
                                             Activity</span>
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
                         <span>Management Address</span>
                     </h2>

                     <li class="nav-item">
                         <ul>
                             <li class="nav-item">
                                 <a href="{{ route('customer.dashboard.address.index') }}" class="group">
                                     <div class="flex items-center">
                                         <span class="mdi mdi-math-log text-xl"></span>
                                         <span
                                             class="text-black ltr:pl-3 rtl:pr-3 dark:text-[#506690] dark:group-hover:text-white-dark">Address
                                             Detail</span>
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
