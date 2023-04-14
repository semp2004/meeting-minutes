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
                class="mt-10 shadow-sm sm:rounded-lg overflow-hidden overflow-x-auto p-6 bg-gray-200 dark:bg-gray-800 min-w-full align-middle">
                <form method="POST" action="/meeting/agenda-item">
                    @csrf
{{--                    <label for="content" class="leading-4 font-medium text-white uppercase tracking-wider">Agenda punt--}}
{{--                        aanmaken</label>--}}
                    <x-input-label class="text-xl">Agenda punt aanmaken</x-input-label>
                    <x-text-input name="category" id="category" class="mt-2 mb-2" placeholder="Categorie"
                                  maxlength="125" required/>
                    <div>
                    <textarea name="content" id="content" maxlength="200" placeholder="Agenda punt"
                              class="dark:bg-gray-800 bg-gray-200 dark:text-gray-200 text-gray-800 border-gray-700 border-[1px] focus:outline-none focus:border-gray-400 resize-none px-4 py-2 rounded-lg w-full pb-20 whitespace-pre-wrap"></textarea>
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
                class="mt-10 shadow-sm sm:rounded-lg overflow-hidden overflow-x-auto p-6 bg-gray-200 dark:bg-gray-800 min-w-full align-middle">
                <span class="leading-4 font-medium text-black dark:text-white uppercase tracking-wider">Agenda punten</span>
                @php
                    $currentDate = date('Y-m-d');
                    $currentDate = date('Y-m-d', strtotime($currentDate));

                    $agendaItemCount = 0;
                    $commentCount = 0;
                @endphp
                @foreach($agendaItems as $agendaItem)
                    @php
                        $nameArr = explode(' ', $agendaItem->user->name);

                        $shortenedName = "";
                        foreach ($nameArr as $seperated)
                            $shortenedName = $shortenedName . $seperated[0];
                        $agendaItemCount++;
                    @endphp
                        <!-- Agenda Items -->
                    <div class="relative mt-4">
                        <span>
                            <h2 class="absolute -right-0 text-xl"
                                title="{{ $agendaItem->name }}">{{ $shortenedName }}</h2>
                            <h2 class="text-xl">{{ $agendaItem->category }}</h2>
                        </span>
                        <div class="bg-gray-100 dark:bg-gray-700 sm:rounded-md py-1 pl-2">
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
                        @if($agendaItem->user_id === Auth::user()->id)
                            <a href="{{ route('agenda-item.edit', $agendaItem->id) }}">
                                <x-secondary-button><i class="fa-solid fa-pen-to-square"></i> Aanpassen
                                </x-secondary-button>
                            </a><br>
                        @endif

                        <x-secondary-button class="mt-2" id="button-{{ $agendaItemCount }}"> Opmerking maken
                        </x-secondary-button>

                        <form method="get" action="{{route('besluit', $agendaItem->id)}}">
                            <x-secondary-button>
                                Besluiten
                            </x-secondary-button>
                        </form>

                        <!-- make comment -->
                        <form method="POST" action="{{ route('comment.store') }}">
                            @csrf
                            <div>
                                <label for="textarea-{{$agendaItemCount}}"></label><textarea
                                    name="comment"
                                    class="dark:bg-gray-800 bg-gray-200 dark:text-gray-200 text-gray-800 border-gray-700 border-[1px] focus:outline-none focus:border-gray-400 resize-none pl-4 pr-4 rounded-lg w-full whitespace-pre-wrap hidden mt-2 pb-12"
                                    id="textarea-{{$agendaItemCount}}" maxlength="400" required></textarea>
                                <p class="select-none relative text-right bottom-8 right-2 hidden"
                                   id="textarea-result-{{$agendaItemCount}}">0 / 400</p>
                            </div>
                            <input type="hidden" name="agendaItem_id" value="{{ $agendaItem->id }}">
                            <x-primary-button class="mt-[-10px] pt-1 pb-1 hidden"
                                              id="commentButton-{{$agendaItemCount}}">Reageren
                            </x-primary-button>
                        </form>
                        <!-- Comments -->
                        @if(count($agendaItem->comments) > 0)
                            <div class="mt-2">
                                <span id="commentButton-{{$commentCount}}" class="select-none"><p id="commentButton-{{$commentCount}}" class="text-blue-400 cursor-pointer">
                                        <i class="fa-solid fa-arrow-down float-left rotate-180 w-[18px] mr-1" id="commentButtonIcon-{{$commentCount}}"></i>
                                        {{ count($agendaItem->comments) }}
                                        opmerkingen</p></span>
                                <div class="hidden" id="comment-{{ $commentCount }}">
                                    @foreach ($agendaItem->comments as $comment)
                                        @php
                                            $shortenedComName = "";

                                            foreach (explode(' ', $comment->user->name) as $comSeperated)
                                                $shortenedComName = $shortenedComName . $comSeperated[0];
                                        @endphp
                                        <div class="relative">
                                            <h2>{{ $shortenedComName }}</h2>
                                            @if($comment->user_id === Auth::user()->id)
                                                <a href="{{ route('comment.edit', $comment->id) }}">
                                                    <x-secondary-button
                                                        class="pl-2 pr-2 pt-2 pb-2 absolute -top-4 -right-[-30px]"
                                                        title="Aanpassen"><i class="fa-solid fa-pen-to-square"></i>
                                                    </x-secondary-button>
                                                </a>
                                                <a href="{{ route('comment.delete.confirmation', $comment->id) }}">
                                                    <x-secondary-button
                                                        class="pl-2 pr-2 pt-2 pb-2 absolute -top-4 -right-2"
                                                        title="Verwijderen"><i
                                                            class="fa-solid fa-eraser"></i></x-secondary-button>
                                                </a>
                                            @endif
                                        </div>
                                        <div class="bg-gray-100 dark:bg-gray-700 sm:rounded-md py-1 pl-2 mb-4">
                                                <?= "<p>$comment->comment</p>"; ?>
                                        </div>
                                    @endforeach
                                    <script>
                                        let isClicked{{$commentCount}} = false;

                                        window.addEventListener("click", function (event) {
                                            const commentSrc{{$commentCount}} = document.getElementById("comment-{{ $commentCount }}");
                                            const iconSrc{{$commentCount}} = document.getElementById("commentButtonIcon-{{$commentCount}}");

                                            if (event.target.id === "commentButton-{{$commentCount}}" || event.target.id === "commentButtonIcon-{{$commentCount}}") {
                                                if (isClicked{{$commentCount}}) {
                                                    commentSrc{{$commentCount}}.style.display = "none";
                                                    iconSrc{{$commentCount}}.classList.remove('fa-arrow-up')
                                                    iconSrc{{$commentCount}}.classList.add('fa-arrow-down')
                                                    isClicked{{$commentCount}} = false;
                                                } else {
                                                    commentSrc{{$commentCount}}.style.display = "block";
                                                    iconSrc{{$commentCount}}.classList.remove('fa-arrow-down')
                                                    iconSrc{{$commentCount}}.classList.add('fa-arrow-up')
                                                    isClicked{{$commentCount}} = true;
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                                @php
                                    $commentCount++;
                                @endphp
                            </div>
                        @endif

                        <script>
                            window.addEventListener("click", function (event) {
                                const textArea{!! $agendaItemCount !!} = document.getElementById('textarea-{{$agendaItemCount}}');
                                const result{!! $agendaItemCount !!} = document.getElementById('textarea-result-{{$agendaItemCount}}');
                                const commentBtn{!! $agendaItemCount !!} = document.getElementById('commentButton-{{$agendaItemCount}}');

                                if (event.target.id === 'button-{{ $agendaItemCount }}' || event.target.id === 'textarea-{{ $agendaItemCount }}' || event.target.id === 'textarea-result-{{$agendaItemCount}}') {
                                    textArea{!! $agendaItemCount !!}.style.display = 'block';
                                    result{!! $agendaItemCount !!}.style.display = 'block';
                                    commentBtn{!! $agendaItemCount !!}.style.display = 'block';
                                } else {
                                    textArea{!! $agendaItemCount !!}.style.display = 'none';
                                    result{!! $agendaItemCount !!}.style.display = 'none';
                                    commentBtn{!! $agendaItemCount !!}.style.display = 'none';
                                }
                            });

                            window.addEventListener('load', function () {
                                const ta_source{!! $agendaItemCount !!} = document.getElementById('textarea-{{$agendaItemCount}}');
                                const ta_result{!! $agendaItemCount !!} = document.getElementById('textarea-result-{{$agendaItemCount}}');

                                const onInputHandler{!! $agendaItemCount !!} = function (event) {
                                    ta_result{!! $agendaItemCount !!}.innerHTML = event.target.value.length + " / 400";
                                }

                                ta_source{!! $agendaItemCount !!}.addEventListener('input', onInputHandler{!! $agendaItemCount !!});
                            });
                        </script>
                    </div>
                @endforeach
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
