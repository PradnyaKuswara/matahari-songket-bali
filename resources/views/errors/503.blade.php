@extends('layouts.error')

@section('page-title')
    Maintenance
@endsection

@section('content')
    <div class="w-full h-screen flex flex-col items-center justify-between ">
        <div class="xl:w-1/2 flex-1 flex flex-col items-center justify-center text-center px-4 lg:px-0">
            <p class="text-4xl font-bold text-gray-700 capitalize tracking-wide mt-8">Website under maintenance!</p>
            <p class="text-xl text-gray-700 uppercase mt-4">We'll be back soon</p>
        </div>
        <div class="w-full py-4 border-t border-gray-300">
            <div
                class="container mx-auto gap-4 flex flex-col md:flex-row items-center justify-center text-gray-600 text-sm md:space-x-8 space-y-1 md:space-y-0">
                <span class="font-bold">You can contact us:</span>
                <a href="javascript:void(0);" class="flex items-center space-x-1" target="_blank" title="Email">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                    </svg>
                    <span>mataharisongketbali@gmail.com</span>
                </a>
            </div>

        </div>
    </div>
@endsection
