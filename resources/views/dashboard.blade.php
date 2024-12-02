<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Maligayang Pasko!') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <x-application-logo class="block h-12 w-auto" />

                    <h1 class="mt-8 text-2xl font-medium text-gray-900">
                        Welcome to the World of Filipino Recipes! 
                    </h1>

                    <p class="mt-6 text-gray-500 leading-relaxed">
                        The holidays in the Philippines are a time of joy, love, and of course, delicious food! From the heartwarming aroma of Bibingka and Puto Bumbong after Simbang Gabi to the festive spread of Lechon, Pancit, and sweet Leche Flan on Noche Buena, every dish brings families closer together.

                        Get ready to fill your kitchen with the magic of Filipino Christmas flavors, where every recipe feels like a hug from home. Maligayang Pasko!
                    </p>
                </div>

                <div class="bg-gray-200 bg-opacity-25 p-6 lg:p-8">
                    <form method="GET" action="{{ route('dashboard') }}" class="mb-6">
                        <div class="flex items-center space-x-4">
                            <input type="text" name="search" placeholder="Search for recipes by title, ingredients, or category..." class="w-full p-2 border border-gray-300 rounded-md" value="{{ request('search') }}" />
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">Search</button>
                        </div>
                    </form>

                    <div class="flex flex-wrap gap-2 mb-6">
                        <a href="{{ route('dashboard', ['category' => 'All']) }}" class="px-5 py-2 text-sm bg-blue-500 text-white rounded-md hover:bg-blue-700 {{ request('category') == 'All' ? 'bg-blue-700' : '' }}">All</a>
                        <a href="{{ route('dashboard', ['category' => 'Rice']) }}" class="px-5 py-2 text-sm bg-blue-500 text-white rounded-md hover:bg-blue-700 {{ request('category') == 'Rice' ? 'bg-blue-700' : '' }}">Rice</a>
                        <a href="{{ route('dashboard', ['category' => 'Soup and Stews']) }}" class="px-4 py-2 text-sm bg-blue-500 text-white rounded-md hover:bg-blue-700 {{ request('category') == 'Soup and Stews' ? 'bg-blue-700' : '' }}">Soup and Stews</a>
                        <a href="{{ route('dashboard', ['category' => 'Pulutan']) }}" class="px-5 py-2 text-sm bg-blue-500 text-white rounded-md hover:bg-blue-700 {{ request('category') == 'Pulutan' ? 'bg-blue-700' : '' }}">Pulutan</a>
                        <a href="{{ route('dashboard', ['category' => 'Fiesta Food']) }}" class="px-5 py-2 text-sm bg-blue-500 text-white rounded-md hover:bg-blue-700 {{ request('category') == 'Fiesta Food' ? 'bg-blue-700' : '' }}">Fiesta Food</a>
                        <a href="{{ route('dashboard', ['category' => 'Sweets']) }}" class="px-5 py-2 text-sm bg-blue-500 text-white rounded-md hover:bg-blue-700 {{ request('category') == 'Sweets' ? 'bg-blue-700' : '' }}">Sweets</a>
                    </div>

                    <div>
                        @if (isset($recipes) && $recipes->count() > 0)
                            <!-- Loop through categories and display recipes -->
                            @foreach ($recipes as $category => $categoryRecipes)
                                <h2 class="text-xl font-semibold text-gray-800">{{ $category }}</h2>
                                @foreach ($categoryRecipes as $recipe)
                                    <div class="mb-4 p-4 bg-white shadow rounded-lg flex">
                                        @if ($recipe->image)
                                            <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-32 h-32 object-cover rounded-md mr-4">
                                        @endif
                                        <div>
                                            <h3 class="text-lg font-semibold">{{ $recipe->title }}</h3>
                                            <p>{{ $recipe->introductions }}</p>
                                            <div class="mt-4 flex space-x-2">
                                                <a href="{{ route('recipes.show', $recipe->id) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                                    {{ __('View Recipe') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        @else
                            <p class="text-gray-600">{{ __('No recipes found.') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>