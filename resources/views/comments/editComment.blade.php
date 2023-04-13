@extends('layouts.app')

@section('content')
    @php
        $comment->comment = str_replace("<br>", "\r\n", $comment->comment);
    @endphp
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 text-gray-800 dark:text-gray-100">
        <div
            class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg overflow-hidden overflow-x-auto p-6 bg-gray-800 min-w-full align-middle">
            <form method="POST" action="{{ route('comment.update') }}">
                @csrf
                <label for="content" class="leading-4 font-medium text-white uppercase tracking-wider">Opmerking
                    aanpassen</label>
                <div>
                    <textarea name="comment" id="content" maxlength="400" placeholder="Opmerking"
                              class="dark:bg-gray-800 bg-gray-200 dark:text-gray-200 text-gray-800 border-gray-700 border-[1px] focus:outline-none focus:border-gray-400 resize-none px-4 py-2 rounded-lg w-full pb-20 whitespace-pre-wrap whitespace-pre-wrap">{{ $comment->comment }}</textarea>
                    <p id="result" class="select-none relative text-right bottom-8 right-2">0 / 400</p>
                </div>
                <div class="relative mt-2">
                    <input type="hidden" name="id" value="{{$comment->id}}">
                    <x-secondary-button onclick="submit()">Aanpassen</x-secondary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        window.onload = () => {
            const source = document.getElementById('content');
            const result = document.getElementById('result');

            result.innerHTML = source.value.length + " / 400";

            const onInputHandler = function (e) {
                const strLength = e.target.value.length;
                result.innerHTML = strLength + " / 400";
            }

            source.addEventListener('input', onInputHandler);
        }
    </script>
@endsection
