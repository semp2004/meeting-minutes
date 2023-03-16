@extends('layouts.app')
@props(['users' => $users])


@section('header')
    <h1>Gebruikers aanpassen</h1>
@endsection



@section('content')
    <table class="text-center text-gray-100 w-full">
        <tr>
            <th>Naam</th>
            <th>Email</th>
            <th>Acties</th>


        @foreach($users as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>

                <td class="grid grid-cols-2">
                    <form method="get" action="{{route('EditUser', ['id' => $user -> id])}}">
                        <x-secondary-button type="submit">Aanpassen</x-secondary-button>
                    </form>

                    <form method="get" action="{{route('DeleteUser', ['id' => $user -> id])}}">
                        <x-secondary-button type="submit">Verwijderen</x-secondary-button>
                    </form>

                </td>
            </tr>
        @endforeach

    </table>
@endsection
