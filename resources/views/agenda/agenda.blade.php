@extends('layouts.app')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    {{--naam meeting, datum meeting, naam van eigenaar van meeting--}}
    {{--knop aanpassen, nieuwe meeting knop--}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto p-6 bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-100">
                    <div class="min-w-full align-middle">
                        <table class="min-w-full border border-gray-600 divide-y divide-gray-600">
                            <thead>
                            <tr>
                                <th class="px-6 py-3  text-left">
                                    <span class="text-xs leading-4 font-medium uppercase tracking-wider">Naam van meeting</span>
                                </th>
                                <th class="px-6 py-3  text-left border-l border-l-gray-700">
                                    <span class="text-xs leading-4 font-medium uppercase tracking-wider">datum meeting</span>
                                </th>
                                <th class="px-6 py-3  text-left border-l border-l-gray-700">
                                    <span class="text-xs leading-4 font-medium uppercase tracking-wider">Naam eigenaar</span>
                                </th>
                                <th class="px-6 py-3  text-left border-l border-l-gray-700">
                                    <span class="text-xs leading-4 font-medium uppercase tracking-wider">Meeting bekijken</span>
                                </th>
                            </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-700">


                            @foreach($meetings as $meeting)

                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                        <p class="text-sm leading-5">{{$meeting->name}}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 border-l border-l-gray-700">
                                        <p class="text-sm leading-5">{{$meeting->planned_time}}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 border-l border-l-gray-700">
                                        <p class="text-sm leading-5">{{$meeting->user->name}}</p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 border-l border-l-gray-700 text-center">
                                        <form action="/meeting/{{$meeting->id}}">
                                            <x-secondary-button onclick="submit()">Bekijken</x-secondary-button>
                                        </form>
                                    </td>


                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                    <br>

                    <div class="mt-2 flex justify-center">
                        <form action="/meeting/new">
                            <x-secondary-button class="items-center" onclick="submit()">Nieuwe meeting</x-secondary-button>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
