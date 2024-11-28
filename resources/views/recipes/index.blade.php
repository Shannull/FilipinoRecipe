<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Recipes') }}
            </h2>
            <a href="{{ route('recipes.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                {{ __('Add Recipe') }}
            </a>
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if ($recipes->count() > 0)
                <!-- Loop through recipes and display them -->
                @foreach ($recipes as $recipe)
                    <div class="mb-4 p-4 bg-white shadow rounded-lg">
                        <h3 class="text-lg font-semibold">{{ $recipe->title }}</h3>
                        <p>{{ $recipe->introductions }}</p>
                        <div class="mt-4 flex space-x-2">
                            <a href="{{ route('recipes.show', $recipe->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('View Recipe') }}
                            </a>
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
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-gray-600">{{ __('You have no recipes yet.') }}</p>
            @endif
        </div>
    </div>
</x-app-layout>