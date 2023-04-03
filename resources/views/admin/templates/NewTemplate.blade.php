@extends('layouts.app')


@section('submit_button')
    <x-secondary-button class="ml w-full">
        <i class="fa-solid fa-pen-to-square"></i> Opslaan
    </x-secondary-button>
@endsection

@section('header')
    <h2>
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Maak Template</h1>
    </h2>
@endsection

@php
$lb = "
";
    $points = [
        "- Teveel leerlingen eten achter de tafel",
        "- Docenten zijn te luid",
        "- Teveel kauwgom onder de tafels",
        "- Teveel laptops worden gestolen",
        "- teveel leerlingen zitten op hun telefoon",
        "- docenten drinken teveel koffie",
        "- docenten moeten een beetje groeien",
        "- De haarlijn van docenten lopen te ver terug"
    ];

    $RandomPoint = "";
    for ($i = 0; $i < 5; $i++) {
        $random = rand(0, count($points) - 1);
        $RandomPoint .= $points[$random] . $lb;
    }
@endphp

@section('content')
    <form class="mt-10 ml-96 mr-96 text-xl" method="post" class="mt-4">
        @csrf
        <div
            class="dark:bg-gray-800 dark:text-gray-200 bg-gray-200 text-gray-800  rounded px-16 pt-6 pb-8 mb-4 ml-40 mr-40">
            @yield('submit_button')

            <div class="mb-4">
                <x-input-label for="name" class="w-full pl-0.5">Naam</x-input-label>
                <x-text-input class="block w-full mt-1 pl-2" name="name" placeholder="Template #1"></x-text-input>
            </div>
            <div class="mb-4">
                <x-input-label for="header" class="w-full pl-0.5">Bovenste gegevens</x-input-label>
                <x-text-input class="w-full pl-2" name="header"
                              placeholder="Deze vergadering is voor de bespreking van de cijfers"></x-text-input>
            </div>
            <div class="mb-4">
                <x-input-label for="points" class="w-full pl-0.5">Agenda punten</x-input-label>
                <x-textarea class="w-full pl-2" name="points"
                            placeholder="{{$RandomPoint}}" type=""></x-textarea>

            </div>

        </div>
    </form>
@endsection
