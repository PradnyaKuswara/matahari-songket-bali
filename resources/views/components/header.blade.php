@props(['propName'])

<div class="navbar z-50 fixed shadow-sm bg-transparent text-base-content py-4 md:px-12 lg:px-36" id="navbar">
    <div class="flex-1 gap-8 ">
        <a href="{{ route('index') }}" class="btn hover:bg-white btn-ghost text-xl">
            <img class="h-10" src="{{ asset('assets/images/logo.png') }}" alt="">
        </a>
        <ul class="menu menu-horizontal px-1 hidden lg:flex text-xs">
            <li><a href="{{ route('index') }}">Home</a></li>
            <li><a href="{{ route('products') }}">Product</a></li>
            <li><a>Whats News</a></li>
            <li><a>About us</a></li>
        </ul>
    </div>

    <div class="flex-none gap-2 md:gap-2 ">

        @if (!auth()->check())
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                    <div class="indicator">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="badge badge-sm indicator-item">8</span>
                    </div>
                </div>

                <div tabindex="0" class="mt-3 z-[1] card card-compact dropdown-content w-52 bg-base-100 shadow">
                    <div class="card-body text-black dark:text-white">
                        <p class="" data-theme="">8 Items</p>
                        <span class="text-info">Subtotal: $999</span>
                        <div class="card-actions">
                            <button class="btn btn-primary btn-block">View cart</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hidden lg:flex dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img alt="Tailwind CSS Navbar component"
                            src="https://daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
                    </div>
                </div>
                <ul tabindex="0"
                    class="menu menu-md dropdown-content mt-16 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li>
                        <a class="justify-between">
                            Profile
                            <span class="badge">New</span>
                        </a>
                    </li>
                    <li><a>Settings</a></li>
                    <li><a>Logout</a></li>
                </ul>
            </div>
        @else
            <div>
                <x-button-link href="{{ route('login') }}" class="btn btn-sm text-xs">Login</x-button-link>
            </div>

            <div>
                <x-button-link href="{{ route('register') }}" class="btn btn-sm text-xs text-white bg-primary">Register</x-button-link>
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
                <li><a>Home</a></li>
                <li><a>Product</a></li>
                <li><a>Whats News</a></li>
                <li><a>About us</a></li>
            </ul>
        </div>
    </div>
</div>
