@extends('layouts.app')
@props(['Template' => [
    'name' => '',
    'header' => '',
]])

@section('submit_button')
    <x-secondary-button class="ml">
        <i class="fa-solid fa-eraser"></i> Aanpassen
    </x-secondary-button>
@endsection

@section('header')
    <h2>
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Template aanpassen</h1>
    </h2>
@endsection


@section('content')
    @php
        $topics = "";
        $i = 1;
        foreach ($Template->topics as $topic) {
            $topics = $topics . $topic->topic;

            if (count($Template->topics) !== $i)
                $topics = $topics . "\r\n";
            $i++;
        }
    @endphp
    <form class="mt-10 ml-96 mr-96 text-xl" method="post" class="mt-4">
        @csrf
        <div class="bg-gray-200 dark:bg-gray-800 rounded px-16 pt-6 pb-8 mb-4 ml-40 mr-40">
            <div class="mb-4">
                <x-input-label for="name" class="w-full pl-0.5">Naam</x-input-label>
                <x-text-input class="block w-full mt-1 pl-2" name="name" placeholder="Template #1"
                              value="{{$Template->name}}"></x-text-input>
            </div>
            <div class="mb-4">
                <x-input-label for="header" class="w-full pl-0.5">Bovenste gegevens</x-input-label>
                <x-text-input class="w-full pl-2" name="header"
                              placeholder="Deze vergadering is voor de bespreking van de cijfers"
                              value="{{$Template->header}}"></x-text-input>
            </div>
            <div class="mb-4">
                <x-input-label for="topics" class="w-full pl-0.5">Hoofdstukken</x-input-label>
                <x-textarea name="topics" id="topics" class="w-full pl-2" placeholder="Hoofdstuk #1&#10;Hoofdstuk #2"
                            value="{{$topics}}"></x-textarea>
            </div>
            @yield('submit_button')
        </div>
    </form>
@endsection
