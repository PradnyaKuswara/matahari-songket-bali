@props(['propName'])

<div class="navbar z-50 fixed shadow-sm bg-transparent text-base-content py-4 md:px-12 lg:px-36" id="navbar">
    <div class="flex-1 gap-8 ">
        <a href="{{ route('index') }}" class="btn hover:bg-white btn-ghost text-xl">
            <img class="h-10" src="{{ asset('assets/images/logo.png') }}" alt="">
        </a>
        <ul class="menu menu-horizontal px-1 hidden lg:flex text-xs">
            <li><a href="{{ route('index') }}">Home</a></li>
            <li><a href="{{ route('products.indexFront') }}">Product</a></li>
            <li><a href="{{ route('whats-new.index') }}">Whats News</a></li>
            <li><a href="{{ route('about.index') }}">About us</a></li>
        </ul>
    </div>

    <div class="flex-none gap-2 md:gap-2 ">

        @if (auth()->check())
            @if (auth()->user()->isCustomer())
                <div class="dropdown dropdown-end">
                    <a href="{{ route('carts.indexFront') }}">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
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
            @endif

            <div class="hidden lg:flex dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img alt="Tailwind CSS Navbar component"
                            src="{{ auth()->user()->avatar ? auth()->user()->avatar() : 'https://eu.ui-avatars.com/api/?name=' . auth()->user()->username . '&size=150' }}" />
                    </div>
                </div>
                <ul tabindex="0"
                    class="menu menu-md dropdown-content mt-16 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    @if (auth()->user()->role->name == 'admin')
                        <li><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                        <li>
                            <a href="{{ route('admin.dashboard.profile.edit') }}" class="justify-between">
                                Profile
                            </a>
                        </li>
                    @endif

                    @if (auth()->user()->role->name == 'customer')
                        <li><a href="{{ route('customer.dashboard.index') }}">Dashboard</a></li>
                        <li>
                            <a href="{{ route('customer.dashboard.profile.edit') }}" class="justify-between">
                                Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customer.dashboard.order.index') }}" class="justify-between">
                                Order
                                <span class="badge badge-primary animate-pulse animate-infinite">New</span>
                            </a>
                        </li>
                    @endif

                    @if (auth()->user()->role->name == 'seller')
                        <li><a href="{{ route('seller.dashboard.index') }}">Dashboard</a></li>
                        <li>
                            <a href="{{ route('seller.dashboard.profile.edit') }}" class="justify-between">
                                Profile
                            </a>
                        </li>
                    @endif

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <li><button type="submit" class="w-full">Logout</button></li>
                    </form>

                </ul>
            </div>
        @else
            <div>
                <x-button-link link="{{ route('login') }}" class="btn btn-sm text-xs">Login</x-button-link>
            </div>

            <div>
                <x-button-link link="{{ route('register') }}"
                    class="btn btn-sm text-xs text-white bg-primary">Register</x-button-link>
            </div>
        @endif


        <div class="lg:hidden dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li><a href="{{ route('products.indexFront') }}">Product</a></li>
                <li><a href="{{ route('whats-new.index') }}">Whats News</a></li>
                <li><a href="{{ route('about.index') }}">About us</a></li>
                <div class="mt-4">
                    @if (auth()->check() && auth()->user()->role->name == 'admin')
                        <li><a href="{{ route('admin.dashboard.index') }}">Dashboard</a></li>
                        <li>
                            <a href="{{ route('admin.dashboard.profile.edit') }}" class="justify-between">
                                Profile
                            </a>
                        </li>
                    @endif

                    @if (auth()->check() && auth()->user()->role->name == 'customer')
                        <div class="mt-4">
                            <li><a href="{{ route('customer.dashboard.index') }}">Dashboard</a></li>
                            <li>
                                <a href="{{ route('customer.dashboard.profile.edit') }}" class="justify-between">
                                    Profile

                                </a>
                            </li>
                            <li>
                                <a href="{{ route('customer.dashboard.order.index') }}" class="justify-between">
                                    Order
                                    <span class="badge badge-primary animate-pulse animate-infinite">New</span>
                                </a>
                            </li>
                    @endif

                    @if (auth()->check() && auth()->user()->role->name == 'seller')
                        <div class="mt-4">
                            <li><a href="{{ route('seller.dashboard.index') }}">Dashboard</a></li>
                            <li>
                                <a href="{{ route('seller.dashboard.profile.edit') }}" class="justify-between">
                                    Profile
                                </a>
                            </li>
                    @endif

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <li><button type="submit" class="w-full">Logout</button></li>
                    </form>
                </div>
            </ul>
        </div>
    </div>
</div>
