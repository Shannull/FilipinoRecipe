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
                    @can('update', $recipe)
                        <a href="{{ route('recipes.edit', $recipe->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            {{ __('Edit') }}
                        </a>
                    @endcan
                    @can('delete', $recipe)
                        <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this recipe?') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    @endcan
                    <a href="{{ url()->previous() }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Back to Recipes') }}
                    </a>
                </div>

                <div class="mt-6">
                    @if ($recipe->isLikedByUser())
                        <form action="{{ route('recipes.unlike', $recipe->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Unlike') }}
                            </button>
                        </form>
                    @else
                        <form action="{{ route('recipes.like', $recipe->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Like') }}
                            </button>
                        </form>
                    @endif
                    <p class="mt-4 text-gray-600"><strong>{{ __('Likes') }}:</strong> {{ $recipe->likes_count }}</p>
                </div>

                <div class="mt-6">
                    @if ($recipe->isFavoritedByUser())
                        <form action="{{ route('recipes.unfavorite', $recipe->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Unfavorite') }}
                            </button>
                        </form>
                    @else
                        <form action="{{ route('recipes.favorite', $recipe->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Favorite') }}
                            </button>
                        </form>
                    @endif
                </div>

                <div class="mt-6">
                    <h3 class="text-xl font-semibold text-gray-800">{{ __('Comments') }}</h3>
                    <form action="{{ route('recipes.comment', $recipe->id) }}" method="POST" class="mt-4">
                        @csrf
                        <textarea name="content" class="w-full p-2 border border-gray-300 rounded-md" rows="4" placeholder="{{ __('Add a comment...') }}" required></textarea>
                        <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">{{ __('Comment') }}</button>
                    </form>

                    <div class="mt-6">
                        @foreach ($recipe->comments as $comment)
                            <div class="mb-4 p-4 bg-gray-100 rounded-lg">
                                <p class="text-gray-800"><strong>{{ $comment->user->name }}</strong> {{ __('said') }}:</p>
                                <p class="mt-2 text-gray-600">{{ $comment->content }}</p>
                                <p class="mt-2 text-gray-400 text-sm">{{ $comment->created_at->diffForHumans() }}</p>
                                <button class="mt-2 text-blue-500" onclick="document.getElementById('reply-form-{{ $comment->id }}').classList.toggle('hidden')">{{ __('Reply') }}</button>
                                <form action="{{ route('recipes.comment', $recipe->id) }}" method="POST" id="reply-form-{{ $comment->id }}" class="mt-4 hidden">
                                    @csrf
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    <textarea name="content" class="w-full p-2 border border-gray-300 rounded-md" rows="2" placeholder="{{ __('Add a reply...') }}" required></textarea>
                                    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">{{ __('Reply') }}</button>
                                </form>
                                @foreach ($comment->replies as $reply)
                                    <div class="ml-6 mt-4 p-4 bg-gray-200 rounded-lg">
                                        <p class="text-gray-800"><strong>{{ $reply->user->name }}</strong> {{ __('replied') }}:</p>
                                        <p class="mt-2 text-gray-600">{{ $reply->content }}</p>
                                        <p class="mt-2 text-gray-400 text-sm">{{ $reply->created_at->diffForHumans() }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>