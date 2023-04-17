@extends('layouts.app')

@section('content')
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 text-gray-800 dark:text-gray-100">
        <div
            class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg overflow-hidden overflow-x-auto p-6 bg-gray-800 min-w-full align-middle">
            <form method="POST" action="{{ route('action-item.store') }}">
                @csrf
                <label for="content" class="leading-4 font-medium text-white uppercase tracking-wider">Actie punt
                    toevoegen</label>
                <x-text-input name="title" id="title" class="mt-2 mb-2" placeholder="Title actie punt"
                              maxlength="125" value="" required/>
                <div>
                    <textarea name="content" id="content" maxlength="200" placeholder="Actie punt"
                              class="dark:bg-gray-800 bg-gray-200 dark:text-gray-200 text-gray-800 border-gray-700 border-[1px] focus:outline-none focus:border-gray-400 resize-none px-4 py-2 rounded-lg w-full pb-20 whitespace-pre-wrap whitespace-pre-wrap"></textarea>
                    <p id="result" class="select-none relative text-right bottom-8 right-2">0 / 200</p>
                </div>
                <div class="relative mt-2">
                    <x-input-label class="absolute -top-6 uppercase">Datum actie punt</x-input-label>
                    <x-text-input type="date" name="assigned_date"
                                  value=""
                                  placeholder="Datum van meeting" class="w-full mb-4" required/>
                </div>
                <div class="relative mt-2">
                    <x-input-label class="absolute -top-6 uppercase" for="assigned_to">Aangewezen persoon</x-input-label>
                    <p>Max. 1 persoon</p>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5  border-l border-l-gray-700">
                        <div id="checkboxes"
                             class="w-72 h-12 overflow-y-scroll overflow-x-hidden border border-gray-300">

                            <select name="assigned_to" id="assigned_to" class="w-full h-full bg-gray-100 dark:bg-gray-800">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    @if($errors->$user->has('assigned_to'))
                        <p class="text-red-500 text-xs italic">{{ $errors->$user->first('assigned_to') }}</p>
                    @endif

                    <input type="hidden" name="id" value="{{$agendaItem}}">
                    <x-secondary-button onclick="submit()">Toevoegen</x-secondary-button>
                </div>
            </form>
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
