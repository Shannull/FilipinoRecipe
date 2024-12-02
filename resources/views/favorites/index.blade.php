<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Favorite Recipes') }}
        </h2>
    </x-slot>
    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            @if ($favorites->isEmpty())
                <p class="text-gray-600">{{ __('You have no favorite recipes.') }}</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($favorites as $favorite)
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            @if ($favorite->recipe->image)
                                <img src="{{ asset('storage/' . $favorite->recipe->image) }}" alt="{{ $favorite->recipe->title }}" class="w-full h-48 object-cover">
                            @endif
                            <div class="p-4">
                                <h3 class="text-lg font-semibold">{{ $favorite->recipe->title }}</h3>
                                <p class="text-gray-600 mt-2">{{ $favorite->recipe->introductions }}</p>
                                <a href="{{ route('recipes.show', $favorite->recipe->id) }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    {{ __('View Recipe') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
</x-app-layout>