@extends('layouts.base')
<div class="flex flex-col justify-center min-h-30 py-12 bg-gray-50 sm:px-6 lg:px-8">
    <div class="absolute top-0 right-0 mt-4 mr-4">
        @if (Route::has('login'))
            <div class="space-x-4">
                @auth
                    <a href="{{ route('create-email') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Send Email</a>
                    <a href="/history" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Show Emails</a>
                    <a
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                    >
                        Log out
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
    @section('body')
        @yield('content')
        
        @isset($slot)
            {{ $slot }}
        @endisset
    @endsection
</div>
