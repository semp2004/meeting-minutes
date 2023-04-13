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
            <div class="bg-gray-200 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto p-6 bg-gray-200 dark:bg-gray-800">
                    <div class="min-w-full align-middle">
                        <table class="min-w-full border border-gray-600 divide-y divide-gray-600">
                            <thead>
                            <tr>
                                <th class="bg-gray-300 dark:bg-gray-800 px-6 py-3 text-left">
                                    <span class="text-xs leading-4 font-medium text-black dark:text-white uppercase tracking-wider">Naam van meeting</span>
                                </th>
                                <th class="bg-gray-300 dark:bg-gray-800 px-6 py-3 text-left border-l border-l-gray-700">
                                    <span class="text-xs leading-4 font-medium text-black dark:text-white uppercase tracking-wider">datum meeting</span>
                                </th>
                                <th class="bg-gray-300 dark:bg-gray-800 px-6 py-3 text-left border-l border-l-gray-700">
                                    <span class="text-xs leading-4 font-medium text-black dark:text-white uppercase tracking-wider">Deelnemers</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-gray-200 dark:bg-gray-800 divide-y divide-gray-700">
                            <tr>
                                <form method="post" action="{{ route('meeting.update', $meeting->id)}}">
                                    @csrf
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-black dark:text-white">
                                        <p class="text-sm leading-5 text-black dark:text-white">
                                            <x-text-input type="text" name="name" id="meetingname"
                                                          placeholder="Naam van meeting" value="{{ $meeting->name }}" class="w-full" required/>
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-black dark:text-white border-l border-l-gray-700">
                                        <p class="text-sm leading-5 text-black dark:text-white">
                                            <x-text-input type="datetime-local" name="planned_time" id="meetingdate" class="w-full" value="{{ $meeting->planned_time }}" required/>
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-black dark:text-white border-l border-l-gray-700">
                                        <div id="checkboxes"
                                             class="w-72 h-20 overflow-y-scroll overflow-x-hidden border border-gray-300">
                                            @foreach($users as $user)
                                                <label for="meetingparticipants"
                                                       class="block py-2 cursor-pointer hover:bg-blue-500">
                                                    <input name="meeting_participants[]" type="checkbox"
                                                           id="meetingparticipants"
                                                           class="inline-block align-middle mr-2" value="{{ $user->id }}" @checked($persons->contains($user))>
                                                    <span class="inline-block align-middle">{{ $user->name }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2 flex justify-center">
                        <x-secondary-button class="items-center">Meeting aanpassen</x-secondary-button>
                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection
