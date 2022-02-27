@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold underline">
        Previous messages
    </h1>
    <livewire:history-table>
    @livewireScripts
@endsection