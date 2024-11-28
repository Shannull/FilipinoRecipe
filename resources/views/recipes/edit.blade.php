<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Recipe') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('recipes.update', $recipe->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1">
                            <x-label for="title" value="{{ __('Title') }}" />
                            <x-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $recipe->title }}" required autofocus />
                        </div>

                        <div class="col-span-1">
                            <x-label for="category" value="{{ __('Category') }}" />
                            <select id="category" name="category[]" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" multiple required>
                                <option value="Rice" {{ in_array('Rice', explode(',', $recipe->category)) ? 'selected' : '' }}>Rice</option>
                                <option value="Soup and Stews" {{ in_array('Soup and Stews', explode(',', $recipe->category)) ? 'selected' : '' }}>Soup and Stews</option>
                                <option value="Pulutan" {{ in_array('Pulutan', explode(',', $recipe->category)) ? 'selected' : '' }}>Pulutan</option>
                                <option value="Fiesta Food" {{ in_array('Fiesta Food', explode(',', $recipe->category)) ? 'selected' : '' }}>Fiesta Food</option>
                                <option value="Sweets" {{ in_array('Sweets', explode(',', $recipe->category)) ? 'selected' : '' }}>Sweets</option>
                            </select>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <x-label for="introductions" value="{{ __('Introductions') }}" />
                            <textarea id="introductions" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" name="introductions" required>{{ $recipe->introductions }}</textarea>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <x-label for="ingredients" value="{{ __('Ingredients') }}" />
                            <textarea id="ingredients" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" name="ingredients" required>{{ $recipe->ingredients }}</textarea>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <x-label for="directions" value="{{ __('Directions') }}" />
                            <textarea id="directions" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" name="directions" required>{{ $recipe->directions }}</textarea>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <x-label for="image" value="{{ __('Image') }}" />
                            <x-input id="image" class="block mt-1 w-full" type="file" name="image" />
                            @if ($recipe->image)
                                <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="mt-4 max-w-xs h-auto rounded-md shadow-md">
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-button class="ml-4">
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>