<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Edit Movie
            </h2>
            <p class="mb-4">Edit: {{ $movie->title }}</p>
        </header>

        <form method="POST" action="{{ route('movies.update', ['movie' => $movie->id]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2">Movie Title</label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="title"
                    value="{{ $movie->title }}"
                />

                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="inline-block text-lg mb-2">Movie Description</label>
                <textarea
                    class="border border-gray-200 rounded p-2 w-full"
                    name="description"
                    rows="10"
                    placeholder="Include tasks, requirements, salary, etc">
                    {{ $movie->description }}
                    
                </textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="logo" class="inline-block text-lg mb-2">
                    Movie Logo
                </label>
                <input
                    type="file"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="logo"
                />

                <img
                    class="w-48 mr-6 mb-6"
                    src="{{ $movie->logo ? asset('storage/' . $movie->logo) : asset('/images/no-image.png') }}"
                    alt=""
                />

                @error('logo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="trailer"
                    class="inline-block text-lg mb-2">
                    Movie Trailer
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="trailer"
                    value="{{ $movie->trailer }}" 
                />

                @error('trailer')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="release_date"
                    class="inline-block text-lg mb-2"
                    >Movie Release Date (YYYY-MM-DD)
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="release_date"
                    value="{{ $movie->release_date }}"
                />

                @error('release_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="production_date"
                    class="inline-block text-lg mb-2">
                    Movie Production Date (YYYY-MM-DD
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="production_date"
                    value="{{ $movie->production_date }}"
                />

                @error('production_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button class="bg-yellow-500 text-white rounded py-2 px-4 hover:bg-black">Update Movie</button>

                <a href="{{ route('movies.manage') }}" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>