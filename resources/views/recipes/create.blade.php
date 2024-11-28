<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Recipe') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <x-label for="title" value="{{ __('Title') }}" />
                    <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                </div>

                <div class="mb-4">
                    <x-label for="introductions" value="{{ __('Introductions') }}" />
                    <textarea id="introductions" class="block mt-1 w-full" name="introductions" required>{{ old('introductions') }}</textarea>
                </div>

                <div class="mb-4">
                    <x-label for="ingredients" value="{{ __('Ingredients') }}" />
                    <textarea id="ingredients" class="block mt-1 w-full" name="ingredients" required>{{ old('ingredients') }}</textarea>
                </div>

                <div class="mb-4">
                    <x-label for="directions" value="{{ __('Directions') }}" />
                    <textarea id="directions" class="block mt-1 w-full" name="directions" required>{{ old('directions') }}</textarea>
                </div>

                <div class="mb-4">
                    <x-label for="image" value="{{ __('Image') }}" />
                    <x-input id="image" class="block mt-1 w-full" type="file" name="image" />
                </div>

                <div class="mb-4">
                    <x-label for="category" value="{{ __('Category') }}" />
                    <select id="category" name="category[]" class="block mt-1 w-full" multiple required>
                        <option value="Rice">Rice</option>
                        <option value="Soup and Stews">Soup and Stews</option>
                        <option value="Pulutan">Pulutan</option>
                        <option value="Fiesta Food">Fiesta Food</option>
                        <option value="Sweets">Sweets</option>
                    </select>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4">
                        {{ __('Create') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>