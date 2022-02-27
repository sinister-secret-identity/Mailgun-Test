@extends('layouts.base')
<style>
    .rotated {
        transform: rotate(90deg);
        display: inline-block;
    }
</style>
<div class="flex flex-col justify-center min-h-10 py-10 sm:px-6 lg:px-8">
    <div class="absolute top-0 right-0 mt-4 mr-4">
        @if (Route::has('login'))
            <div class="space-x-4">
                @auth
                    <div x-data="{ open: false }" x-on:click.outside="open = false" class="font-medium text-indigo-600">
                        <button x-on:click="open = !open">
                            Menu
                            <span :class="{'rotated': open}">&raquo;</span>
                        </button>
                        <ul x-show="open" x-transition.opacity>
                            <li class="hover:text-indigo-500 focus:outline-none focus:underline"><a href="{{ route('create-email') }}">Send</a></li>
                            <li class="hover:text-indigo-500 focus:outline-none focus:underline"><a href="/history">History</a></li>
                            <li> </li>
                            <li class="hover:text-indigo-500 focus:outline-none focus:underline"><a
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Log out
                                </a>
                            </li>
                        </ul>
                    </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
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
