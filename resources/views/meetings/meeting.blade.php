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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-100">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto p-6 ">
                    <div class="min-w-full align-middle">
                        <table class="min-w-full border border-gray-600 divide-y divide-gray-600">
                            <thead>
                            <tr>
                                <th class=" px-6 py-3  text-left">
                                    <span class="text-xs leading-4 font-medium  uppercase tracking-wider">Naam van meeting</span>
                                </th>
                                <th class=" px-6 py-3  text-left border-l border-l-gray-700">
                                    <span
                                        class="text-xs leading-4 font-medium  uppercase tracking-wider">datum meeting</span>
                                </th>
                                <th class=" px-6 py-3  text-left border-l border-l-gray-700">
                                    <span
                                        class="text-xs leading-4 font-medium  uppercase tracking-wider">Naam eigenaar</span>
                                </th>
                                <th class=" px-6 py-3  text-left border-l border-l-gray-700">
                                    <span class="text-xs leading-4 font-medium  uppercase tracking-wider">Meeting deelnemers</span>
                                </th>
                            </tr>
                            </thead>

                            <tbody class=" divide-y divide-gray-700">


                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 ">
                                    <p class="text-sm leading-5 ">{{$meeting->name}}</p>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5  border-l border-l-gray-700">
                                    <p class="text-sm leading-5 ">{{$meeting->planned_time}}</p>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5  border-l border-l-gray-700">
                                    <p class="text-sm leading-5 ">{{$meeting->user->name}}</p>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5  border-l border-l-gray-700">
                                    <p class="text-sm leading-5 ">
                                        @foreach($persons as $person)
                                            {{$person->name}},
                                        @endforeach
                                    </p>
                                </td>
                                <td></td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5  border-l border-l-gray-700">
                                    <form action="/meeting/{{$meeting->id}}">
                                        <x-secondary-button onclick="submit()">Aanpassen</x-secondary-button>
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
