<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('generate') }}">
        @csrf

            <!-- String of characters -->
            <div>
                <x-label for="string" :value="__('Introduzca una cadena de 12 caracteres')" />

                <x-input id="string" class="block mt-1 w-full" type="text" name="string" :value="old('string')" required autofocus />
            </div>

            <!-- length of words -->
            <div class="mt-4">
                <x-label for="length" :value="__('Longitud')" />

                <x-input id="length" class="block mt-1 w-full" min="3" max="12" type="number" name="length" :value="old('length')" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Generar Palabras') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
