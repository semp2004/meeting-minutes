@extends('layouts.app')

@props(['template' => $template])

@section('Javascript_Post')
    <script>
        function SpecialCharsToNormalChars(string) {
            string = string.replaceAll("&lt;", "<");
            string = string.replaceAll("&gt;", ">");
            string = string.replaceAll("&amp;", "&");
            string = string.replaceAll("&quot;", "\"");
            string = string.replaceAll("&apos;", "'");
            return string;
        }


        let EditorOBJ = document.getElementById('editor');
        let string = "{{$template}}"

        string = SpecialCharsToNormalChars(string);
        string = string.replaceAll('<div>', '');
        string = string.replaceAll('</div>', '');
        string = string.replaceAll('<br>', '\n');

        EditorOBJ.editor.insertString(string);

        function submit() {
            const currentUrl = window.location.href;

            fetch(currentUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    content: EditorOBJ.value,
                })
            }).then(id => {
                swal("Template geupdate!", "Template is succesvol opgeslagen!", "success");
            });
        }
    </script>
@endsection

@section('submit_button')
    <button class="bg-gray-800 text-gray-100 w-full h-12" onclick="submit()">Opslaan</button>
@endsection

@section('head')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
@endsection

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <h1>Edit template</h1>
    </h2>
@endsection

@section('content')
    <form class="text-gray-900 bg-gray-100" method="post">
        @csrf
        <input id="x" name="values" type="hidden">
        <trix-editor class="text-gray-100 bg-gray-900 h-full" id="editor" name="content"></trix-editor>
    </form>
    @yield('Javascript_Post')
    @yield('submit_button')
@endsection
