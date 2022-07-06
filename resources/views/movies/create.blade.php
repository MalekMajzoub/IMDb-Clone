<x-layout>
    <x-card class="p-5 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Add a Movie
            </h2>
        </header>

        <form method="POST" action="{{ route('movies.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-2">
                <label for="title" class="inline-block text-lg mb-2">Movie Title</label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="title"
                    value="{{ old('title') }}"
                />
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-2">
                <label
                    for="description"
                    class="inline-block text-lg mb-2"
                >
                    Movie Description
                </label>
                <textarea
                    class="border border-gray-200 rounded p-2 w-full text-sm"
                    name="description"
                    rows="3"
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-2">
                <label for="logo" class="inline-block text-lg mb-2">
                    Movie Logo
                </label>
                <input
                    type="file"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="logo"
                />

                @error('logo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-2">
                <label
                    for="trailer"
                    class="inline-block text-lg mb-2"
                >
                    Trailer URL
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="trailer"
                    value="{{ old('trailer') }}"
                />
                @error('trailer')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-2">
                <label
                    for="release_date"
                    class="inline-block text-lg mb-2"
                    >Movie Release Date (YYYY-MM-DD)</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="release_date"
                    value="{{ old('release_date') }}"
                />

                @error('release_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-2">
                <label
                    for="production_date"
                    class="inline-block text-lg mb-2"
                    >Movie Production Date (YYYY-MM-DD)</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="production_date"
                    value="{{ old('production_date') }}"
                />

                @error('production_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-2">
                <button class="bg-yellow-500 text-white rounded py-2 px-4 hover:bg-black">
                    Add Movie
                </button>

                <a href="{{ route('movies.manage') }}" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>