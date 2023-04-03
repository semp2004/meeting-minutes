@extends('layouts.app')

@section('head')
    <style>
        body {
            overflow: hidden;
        }
    </style>
@endsection

@section('content')
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <section class="bg-white dark:bg-gray-900">
        <div class="lg:grid lg:min-h-screen lg:grid-cols-12">
            <section
                class="relative flex h-32 bg-gray-900 lg:col-span-5 lg:h-full xl:col-span-6"
            >
                <img
                    alt="Meeting"
                    src="https://images.unsplash.com/photo-1554415707-c1426270e0da?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80"
                    class="absolute inset-0 h-full w-full object-cover opacity-80"
                />

                <div class="hidden lg:relative lg:block lg:p-12 absolute top-72 text-center left-[18%] text-gray-100">
                    <h2 class="text-2xl font-bold sm:text-3xl md:text-4xl">
                        Welkom tot meeting minutes
                    </h2>

                    <p class="mt-4 leading-relaxed text-black:90">
                        Gelieve hier in te loggen
                    </p>
                </div>
            </section>

            <main
                aria-label="Main"
                class="flex items-center justify-center px-8 py-8 sm:px-12 lg:col-span-7 lg:py-12 lg:px-16 xl:col-span-6"
            >
                <div class="max-w-xl lg:max-w-3xl">
                    <form action="{{route('login')}}" method="post" class="mt-8 grid grid-cols-6 gap-6">
                        @csrf
                        <div class="col-span-6">
                            <x-input-label for="email">Email</x-input-label>
                            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            @if ($errors->get('email') || $errors->get('password'))
                                <x-input-error messages="Deze inloggegevens komen niet overeen met onze gegevens." class="mt-2" />
                            @endif
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <x-input-label for="password">Wachtwoord</x-input-label>
                            <x-text-input type="password" id="password" name="password" class="w-full" required autocomplete="current-password"></x-text-input>
                        </div>

                        <div class="col-span-6">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Onthoud mij') }}</span>
                            </label>
                        </div>

                        <div class="col-span-6 sm:flex sm:items-center sm:gap-4">
                            <x-primary-button class="w-full">Login</x-primary-button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </section>

@endsection
