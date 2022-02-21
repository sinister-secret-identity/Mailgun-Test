@extends('layouts.app')

@section('content')
    <div class="absolute top-0 right-0 mt-4 mr-4">
        <a href="{{ route('create-email') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Send Email</a>
        <a href="{{ route('history') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Show Emails</a>
    </div>

    <div class="container mt-4">
    @include('livewire.show-emails')
    </div>
@endsection