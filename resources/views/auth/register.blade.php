<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Naam')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Wachtwoord')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            @php
                $passErrorArray = $errors->get('password');
            @endphp

            @if (isset($passErrorArray[0]))
                @if ($passErrorArray[0] == 'The password field confirmation does not match.')
                    <x-input-error messages="De bevestiging van het wachtwoordveld komt niet overeen." class="mt-2"/>
                @else
                    <x-input-error messages="Het wachtwoordveld moet minimaal 8 tekens lang zijn." class="mt-2"/>
                @endif

                @if (isset($passErrorArray[1]))
                    @if ($passErrorArray[1] == 'The password field confirmation does not match.')
                        <x-input-error messages="De bevestiging van het wachtwoordveld komt niet overeen." class="mt-2"/>
                    @else
                        <x-input-error messages="Het wachtwoordveld moet minimaal 8 tekens lang zijn." class="mt-2"/>
                    @endif
                @endif
            @endif
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Bevestig wachtwoord')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Registreer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
