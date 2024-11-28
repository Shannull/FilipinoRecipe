<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $recipe->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex flex-col lg:flex-row">
                    @if ($recipe->image)
                        <div class="lg:w-1/3">
                            <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-auto object-cover rounded-lg shadow-md">
                        </div>
                    @endif
                    <div class="lg:w-2/3 lg:pl-6 mt-6 lg:mt-0">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $recipe->title }}</h3>
                        <p class="mt-4 text-gray-600"><strong>{{ __('Introduction') }}:</strong> {{ $recipe->introductions }}</p>
                        <p class="mt-4 text-gray-600"><strong>{{ __('Ingredients') }}:</strong></p>
                        <ul class="list-disc list-inside mt-2 text-gray-600">
                            @foreach (explode("\n", $recipe->ingredients) as $ingredient)
                                <li>{{ $ingredient }}</li>
                            @endforeach
                        </ul>
                        <p class="mt-4 text-gray-600"><strong>{{ __('Instructions') }}:</strong></p>
                        <ol class="list-decimal list-inside mt-2 text-gray-600">
                            @foreach (explode("\n", $recipe->directions) as $instruction)
                                <li>{{ $instruction }}</li>
                            @endforeach
                        </ol>
                        <p class="mt-4 text-gray-600"><strong>{{ __('Category') }}:</strong> {{ $recipe->category }}</p>
                    </div>
                </div>
                <div class="mt-6 flex space-x-2">
                    <a href="{{ route('recipes.edit', $recipe->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Edit') }}
                    </a>
                    <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this recipe?') }}');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Delete') }}
                        </button>
                    </form>
                    <a href="{{ route('recipes.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Back to Recipes') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>