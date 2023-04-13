@extends('layouts.app')

@section('content')
    <div class="flex h-screen">
        <div class="m-auto bg-gray-800 rounded-2xl px-10 py-5">
            <p>Weet u zeker dat u deze opmerking wilt verwijderen?</p>
            <form method="POST" action="{{ route('comment.delete') }}">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <x-danger-button class="relative left-[25%] mt-2 w-1/2 text-center pl-10">Verwijderen</x-danger-button>
            </form>
        </div>
    </div>
@endsection
