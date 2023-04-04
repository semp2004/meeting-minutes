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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-gray-800 dark:text-gray-100">
            <div class=" overflow-hidden shadow-sm sm:rounded-lg bg-gray-200 dark:bg-gray-800">
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
                                @if($meeting->user_id == Auth::user()->id)

                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-white border-l border-l-gray-700">
                                        <form action="/meeting/edit/{{$meeting->id}}">
                                            <x-secondary-button onclick="submit()">Aanpassen</x-secondary-button>
                                        </form>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-white border-l border-l-gray-700">
                                        <form method="post" action="{{route('meeting.delete', $meeting->id)}}">
                                            @csrf
                                            <x-secondary-button onclick="submit()">Verwijderen</x-secondary-button>
                                        </form>
                                    </td>

                                @endif

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div
                class="mt-10 bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg overflow-hidden overflow-x-auto p-6 bg-gray-800 min-w-full align-middle">
                <form method="POST" action="/meeting/agenda-item">
                    @csrf
                    <label for="content" class="leading-4 font-medium text-white uppercase tracking-wider">Agenda punt
                        aanmaken</label>
                    <x-text-input name="category" id="category" class="mt-2 mb-2" placeholder="Categorie"
                                  maxlength="125" required/>
                    <div>
                    <textarea name="content" id="content" maxlength="200" placeholder="Agenda punt"
                              class="dark:bg-gray-800 bg-gray-200 dark:text-gray-200 text-gray-800 border-gray-700 border-[1px] focus:outline-none focus:border-gray-400 resize-none px-4 py-2 rounded-lg w-full pb-20 whitespace-pre-wrap whitespace-pre-wrap"></textarea>
                        <p id="result" class="select-none relative text-right bottom-8 right-2">0 / 200</p>
                    </div>
                    <div class="relative mt-2">
                        <x-input-label class="absolute -top-6 uppercase">Datum agenda punt</x-input-label>
                        <x-text-input type="date" name="planned_time"
                                      placeholder="Datum van meeting" class="w-full mb-4" required/>
                        <input type="hidden" name="id" value="{{$meeting->id}}">
                        <x-secondary-button onclick="submit()">Aanmaken</x-secondary-button>
                    </div>
                </form>
            </div>
            <div
                class="mt-10 bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg overflow-hidden overflow-x-auto p-6 bg-gray-800 min-w-full align-middle">
                <span class="leading-4 font-medium text-white uppercase tracking-wider">Agenda punten</span>
                @php
                    $currentDate = date('Y-m-d');
                    $currentDate = date('Y-m-d', strtotime($currentDate));
                @endphp
                @foreach($agendaItems as $agendaItem)
                    @php
                        $nameArr = explode(' ', $agendaItem->name);

                        $shortenedName = "";
                        foreach ($nameArr as $seperated)
                            $shortenedName = $shortenedName . $seperated[0];
                    @endphp
                    <div class="relative mt-4">
                        <span>
                            <h2 class="absolute -right-0 text-xl"
                                title="{{ $agendaItem->name }}">{{ $shortenedName }}</h2>
                            <h2 class="text-xl">{{ $agendaItem->category }}</h2>
                        </span>
                        <div class="bg-gray-700 sm:rounded-md py-1 pl-2">
                            <p><?= $agendaItem->content ?></p>
                        </div>
                        <span>
                            @php
                                $finishDate = date('Y-m-d', strtotime($agendaItem->finish_date));
                            @endphp
                            @if($currentDate > $finishDate)
                                <h2 class="text-gray-400"><s>Einddatum: {{ date('d-m-Y', strtotime($finishDate)) }}</s></h2>
                            @else
                                <h2>Einddatum: {{ date('d-m-Y', strtotime($finishDate)) }}</h2>
                            @endif
                        </span>
                    </div>
                    @if($agendaItem->user_id == Auth::user()->id)
                        <a href="/agenda-item/{{ $agendaItem->id }}">
                            <x-secondary-button><i class="fa-solid fa-pen-to-square"></i> Aanpassen
                            </x-secondary-button>
                        </a>
                    @endif
                @endforeach
                <div>
                    <textarea
                        class="dark:bg-gray-800 bg-gray-200 dark:text-gray-200 text-gray-800 border-gray-700 border-[1px] focus:outline-none focus:border-gray-400 resize-none pl-4 pr-4 rounded-lg w-full whitespace-pre-wrap whitespace-pre-wrap"></textarea>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = () => {
            const source = document.getElementById('content');
            const result = document.getElementById('result');

            const onInputHandler = function (e) {
                const strLength = e.target.value.length;
                result.innerHTML = strLength + " / 200";
            }

            source.addEventListener('input', onInputHandler);
        }
    </script>
@endsection
