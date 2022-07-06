<x-layout>
    <x-card class="p-2 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Add/Edit Cast
            </h2>
            <p class="mb-4">Add/Edit Cast for: {{ $movie->title }}</p>
        </header>

        <form method="POST" action="{{ route('movies.addEditActors', ['movie' => $movie->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0">
                <div class="inline-block relative w-56 justify-content">
                    <h3 class="mb-1">Choose Cast</h3>
                    <select name='id' class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <option value="" disabled>Choose Cast</option>
                        @if(count($actors))
                            @foreach ($actors as $actor)
                                @unless ($movie->actors()->where('actor_id', $actor->id)->exists())
                                <option value="{{ $actor->id }}">{{ $actor->first_name }} {{ $actor->last_name }}</option>
                                @endunless
                            @endforeach
                        @endif
                    </select>
                    <div class="pointer-events-none absolute bottom-5 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
                <div class="">
                    <h3 class="mb-1">Choose Character Name</h3>
                    <input
                        type="text"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="character_name"
                        />
                        @error('character_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                </div>
            </div>
    
            <div class="mb-6">
                <button class="bg-yellow-500 text-white rounded py-2 px-4 hover:bg-black">
                    Add/Edit Cast
                </button>

                <a href="{{ route('movies.manage') }}" class="text-black ml-4"> Back </a>
            </div>
        </form>
            <div>
                <ul>
                @foreach ($movie->actors as $actor)
                <div class="flex justify-between">
                    <li class="text-lg font-bold">
                        {{ $actor->first_name }} {{ $actor->last_name }} - <span class="font-normal italic">{{ $actor->pivot->character_name }}</span>
                    </li>
                        <form method="POST" action="{{ route('movies.destroyActors', ['movie' => $movie->id, 'actor' => $actor->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button> <i class="fa-solid fa-trash" style='color: #9c1f1f'></i> Delete </button>
                        </form>
                </div>
                @endforeach
                </ul>
            </div>
    </x-card>
</x-layout>