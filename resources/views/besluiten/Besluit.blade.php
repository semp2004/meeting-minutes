@props(['id' => 0])

@extends('layouts.app')

@section('content')
    <div class="w-1/2 ml-[25vw] mt-12 mb-12 bg-gray-200 dark:bg-gray-800">
        <h1 class="text-center text-xl text-gray-800 dark:text-gray-100">Nieuw besluit</h1>
        <form method="post" action="{{route('besluit.post', $id)}}">
            @csrf
            <x-textarea rows="12" name="besluit">

            </x-textarea>

            <div class="grid grid-cols-2">
                <x-primary-button class="w-full">Maak besluit</x-primary-button>
                <a href="{{route('dashboard')}}">
                    <x-secondary-button class="w-full" type="button">Annuleer</x-secondary-button>
                </a>
            </div>
        </form>
    </div>
@endsection
