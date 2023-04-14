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
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
