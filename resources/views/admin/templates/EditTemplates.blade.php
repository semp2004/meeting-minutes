@extends('layouts.app')

@section('header')
    <h1 class="mt-4 mb-6">Templates aanpassen</h1>
@endsection

@section('content')
    <div class="bg-gray-800 rounded pt-6 pb-8 mb-4 ml-20 mr-20">
        <table class="text-center text-gray-100 w-full">
            <tr>
                <th>Naam</th>
                <th>Agenda punten</th>
            </tr>

            @foreach($templates as $template)
                <tr>
                    <td>{{$template->name}}</td>
                    <td>{{$template->points}}</td>

                    <td class="grid grid-cols-1">
                        <form method="get" action="{{route('EditTemplate', ['id' => $template->id])}}">
                            <x-secondary-button type="submit">Aanpassen</x-secondary-button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>
@endsection
