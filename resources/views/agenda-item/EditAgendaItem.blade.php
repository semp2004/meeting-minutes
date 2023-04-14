@extends('layouts.app')

@section('content')
    @php
        $agendaItem->content = str_replace("<br>", "\r\n", $agendaItem->content);
    @endphp
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 text-gray-800 dark:text-gray-100">
        <div
            class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg overflow-x-auto p-6 min-w-full align-middle">
            <form id="updateForm" method="POST" action="{{ route('agenda-item.update') }}">
                @csrf
                <label for="content" class="leading-4 font-medium text-white uppercase tracking-wider">Agenda punt
                    aanpassen</label>
                <x-text-input name="category" id="category" class="mt-2 mb-2" placeholder="Categorie"
                              maxlength="125" value="{{ $agendaItem->category }}" required/>
                <div>
                    <textarea name="content" id="content" maxlength="200" placeholder="Agenda punt"
                              class="dark:bg-gray-800 bg-gray-200 dark:text-gray-200 text-gray-800 border-gray-700 border-[1px] focus:outline-none focus:border-gray-400 resize-none px-4 py-2 rounded-lg w-full pb-20 whitespace-pre-wrap">{{ $agendaItem->content }}</textarea>
                    <p id="result" class="select-none relative text-right bottom-8 right-2">0 / 200</p>
                </div>
                <div class="relative mt-2">
                    <x-input-label class="absolute -top-6 uppercase">Datum agenda punt</x-input-label>
                    <x-text-input type="date" name="planned_time"
                                  value="{{ date('Y-m-d', strtotime($agendaItem->finish_date)) }}"
                                  placeholder="Datum van meeting" class="w-full mb-4" required/>
                    <input type="hidden" name="id" value="{{$agendaItem->id}}">
                </div>
            </form>
            <div class="relative">
                <x-secondary-button form="updateForm">Aanpassen</x-secondary-button>
                <a href="{{ route('agenda-item.delete.confirm', $agendaItem->id) }}">
                    <x-danger-button class="absolute right-0 py-3">verwijderen</x-danger-button>
                </a>
            </div>
        </div>
    </div>

    <script>
        window.onload = () => {
            const source = document.getElementById('content');
            const result = document.getElementById('result');

            result.innerHTML = source.value.length + " / 200";

            const onInputHandler = function (e) {
                const strLength = e.target.value.length;
                result.innerHTML = strLength + " / 200";
            }

            source.addEventListener('input', onInputHandler);
        }
    </script>
@endsection
