<!-- Topbar Start -->
<header class="app-header flex items-center px-5 gap-4 no-print bg-white" id="navbar">

    <!-- Brand Logo -->
    <a href="javascript:void(0)">
        <img src="{{ asset('assets/images/logo.png') }}" class="h-6" alt="Small logo">
    </a>

    <!-- Sidenav Menu Toggle Button -->
    <button id="button-toggle-menu" class="nav-link p-2 waves-effect me-auto">
        <span class="sr-only">Menu Toggle Button</span>
        <span class="flex items-center justify-center h-6 w-6">
            <span class="mdi mdi-reorder-horizontal text-xl text-gray-400"></span>
        </span>
    </button>

    <div class="md:flex hidden items-center relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <span class="mdi mdi-magnify"></span>
        </div>
        <input type="search"
            class="form-input px-8 rounded-md bg-gray-500/10 border-transparent focus:border-transparent"
            placeholder="Search...">
    </div>

    <!-- Fullscreen Toggle Button -->
    <div class="md:flex hidden">
        <button data-toggle="fullscreen" type="button" class="nav-link p-2 waves-effect">
            <span class="sr-only">Fullscreen Mode</span>
            <span class="flex items-center justify-center h-6 w-6">
                <span class="mdi mdi-fullscreen text-3xl"></span>
            </span>
        </button>
    </div>

    <!-- Profile Dropdown Button -->
    <div class="relative">
        <button data-fc-type="dropdown" data-fc-placement="bottom-end" type="button"
            class="nav-link flex items-center gap-2.5 waves-effect p-2">
            <img src="{{ auth()->user()->avatar ? auth()->user()->avatar() : 'https://eu.ui-avatars.com/api/?name=' . auth()->user()->username . '&size=150' }}"
                alt="user-image" class="rounded-full h-8 w-8">
            <span class="md:flex items-center hidden">
                <span class="font-medium text-base">{{ auth()->user()->username }}</span>
                <i class='ph ph-chevron-down'></i>
            </span>
        </button>
        <div
            class="fc-dropdown fc-dropdown-open:opacity-100 hidden opacity-0 w-40 z-50 transition-[margin,opacity] duration-300 mt-2 bg-white shadow-lg border rounded-lg p-2">
            @if (auth()->user()->role->name == 'admin')
                <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100"
                    href="{{ route('admin.dashboard.profile.edit') }}">
                    Profile
                </a>
            @endif

            @if (auth()->user()->role->name == 'customer')
                <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100"
                    href="{{ route('customer.dashboard.profile.edit') }}">
                    Profile
                </a>
            @endif

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100">
                    Log Out
                </button>
            </form>

        </div>
    </div>
</header>
<!-- Topbar End -->
