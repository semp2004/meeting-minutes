<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Verwijder account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{/* __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') */ __('Zodra uw account is verwijderd, worden alle bronnen en gegevens van het account permanent verwijderd. Download eerst alle gegevens of informatie die u wilt behouden voordat u uw account verwijdert.')}}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Verwijder account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Weet u zeker dat u uw account wilt verwijderen?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Zodra  uw account is verwijderd, worden alle bronnen en gegevens permanent verwijderd. Voer uw wachtwoord in als u uw account wilt permanent verwijderen.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="Wachtwoord"
                />

                @if ($errors->userDeletion->get('password'))
                    <x-input-error messages="Het wachtwoord is incorrect." class="mt-2" />
                @endif
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Annuleren') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Verwijder account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
