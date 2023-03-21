@extends('layouts.app')


@section('submit_button')
    <button class="bg-gray-800 border-t-green-500 border-t-2 text-gray-100 w-full h-12 absolute bottom-0 left-0" onclick="submit()">Opslaan</button>
@endsection

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <h1>Maak template</h1>
    </h2>
@endsection

@php
    $points = [
        "Teveel leerlingen eten achter de tafel",
        "Docenten zijn te luid",
        "Teveel kauwgom onder de tafels",
        "Teveel laptops worden gestolen",
        "teveel leerlingen zitten op hun telefoon",
        "docenten drinken teveel koffie",
        "docenten moeten een beetje groeien (vooral Luuk)",
        "De haarlijn van docenten lopen te ver terug"
    ];
    $random = rand(0, count($points) - 1);

    $RandomPoint = $points[$random];
@endphp

@section('content')
    <form method="post" class="mt-4">
        @csrf
        <x-input-label for="name" class="w-full text-center text-xl">Naam</x-input-label>
        <x-text-input class="w-full text-center" name="name" placeholder="Template #1"></x-text-input>

        <x-input-label for="header" class="w-full text-center text-xl">Bovenste gegevens</x-input-label>
        <x-text-input class="w-full text-center" name="header" placeholder="Deze vergadering is voor de bespreking van de cijfers"></x-text-input>

        <x-input-label for="points" class="w-full text-center text-xl">Agenda punten</x-input-label>
        <x-text-input class="w-full text-center" name="points" placeholder="{{$RandomPoint}}"></x-text-input>

        @yield('submit_button')
    </form>
@endsection
