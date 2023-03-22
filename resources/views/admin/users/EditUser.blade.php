@extends('layouts.app')
@props(['user' => $user])


@section('header')
    <h2>
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Gebruikers aanpassen</h1>
    </h2>
@endsection


@section('content')
    <form class="mx-48 w-3/4 text-xl" method="post">
        @csrf
        <div class="mt-4 w-full">
            <x-input-label for="name" value="Naam" class=""/>
            <x-text-input name="name" :value="$user->name" class="block mt-1 w-full"></x-text-input>

        </div>

        <div class="mt-4 w-full">
            <x-input-label for="email" value="Email"/>
            <x-text-input name="email" :value="$user->email" class="block mt-1 w-full"></x-text-input>
        </div>

        <br/>
        <x-secondary-button type="submit"><i class="fa-solid fa-pen-to-square fa-beat"></i> Opslaan</x-secondary-button>

    </form>
@endsection
