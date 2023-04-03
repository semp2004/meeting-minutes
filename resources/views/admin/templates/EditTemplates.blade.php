@extends('layouts.app')

@section('header')
    <h2>
        <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Templates aanpassen</h1>
    </h2>
@endsection


@section('content')
    <div class="bg-gray-200 text-gray-800 dark:bg-gray-800 dark:text-gray-100 rounded pt-6 pb-8 mb-4 ml-20 mr-20">
        <table class="text-center w-full">
            <tr>
                <th>Naam</th>
                <th>Agenda punten</th>
            </tr>

            @foreach($templates as $Template)
                <tr>
                    <td>{{$Template->name}}</td>
                    <td>{{$Template->points}}</td>

                    <td class="grid grid-cols-1">
                        <form method="get" action="{{route('EditTemplate', ['id' => $Template->id])}}">
                            <x-secondary-button type="submit"><i class="fa-solid fa-pencil"></i> Aanpassen</x-secondary-button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>
@endsection
