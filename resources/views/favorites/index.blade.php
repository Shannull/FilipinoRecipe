<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Favorites') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if ($favorites->isEmpty())
                <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                    {{ __('No favorites yet.') }}
                </p>
            @else
                <ul class="mt-4 space-y-2">
                    @foreach ($favorites as $favorite)
                        <li class="bg-white p-4 rounded-md shadow">
                            <h3 class="font-semibold text-lg">{{ $favorite->title }}</h3>
                            <p class="text-gray-500 text-sm">{{ $favorite->description }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>