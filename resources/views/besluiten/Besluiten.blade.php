@props(['besluiten' => []])

@extends('layouts.app')

@section('content')
    <div class="w-1/2 ml-[25vw] mt-12 mb-12 bg-gray-200 dark:bg-gray-800">
        <h1 class="text-center text-xl text-gray-800 dark:text-gray-100">Besluiten</h1>

        <div class="grid grid-cols-2">
            @foreach($besluiten as $besluit)
                <div class="mx-auto max-w-md rounded-lg bg-gray-300 dark:bg-gray-700 shadow w-full text-center">
                    <div class="p-4">
                        <p class="mt-1 text-white">{{$besluit->besluit}}</p>
                        <x-decision-like decision-id="{{$besluit->id}}"/>
                        <x-decision-dislike decision-id="{{$besluit->id}}"/>
                        <x-decision-total-likes decision-id="{{$besluit->id}}"/>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
