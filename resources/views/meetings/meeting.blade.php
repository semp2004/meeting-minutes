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
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto p-6 bg-gray-800">
                    <div class="min-w-full align-middle">
                        <table class="min-w-full border border-gray-600 divide-y divide-gray-600">
                            <thead>
                            <tr>
                                <th class="bg-gray-800 px-6 py-3 bg-gray-700 text-left">
                                    <span class="text-xs leading-4 font-medium text-white uppercase tracking-wider">Naam van meeting</span>
                                </th>
                                <th class="bg-gray-800 px-6 py-3 bg-gray-700 text-left border-l border-l-gray-700">
                                    <span class="text-xs leading-4 font-medium text-white uppercase tracking-wider">datum meeting</span>
                                </th>
                                <th class="bg-gray-800 px-6 py-3 bg-gray-700 text-left border-l border-l-gray-700">
                                    <span class="text-xs leading-4 font-medium text-white uppercase tracking-wider">Naam eigenaar</span>
                                </th>
                                <th class="bg-gray-800 px-6 py-3 bg-gray-700 text-left border-l border-l-gray-700">
                                    <span class="text-xs leading-4 font-medium text-white uppercase tracking-wider">Meeting aanpassen</span>
                                </th>
                            </tr>
                            </thead>

                            <tbody class="bg-gray-800 divide-y divide-gray-700">


                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-white">
                                    <p class="text-sm leading-5 text-white">{{$meeting->name}}</p>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-white border-l border-l-gray-700">
                                    <p class="text-sm leading-5 text-white">{{$meeting->planned_time}}</p>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-white border-l border-l-gray-700">
                                    <p class="text-sm leading-5 text-white">{{$meeting->user->name}}</p>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-white border-l border-l-gray-700">
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
