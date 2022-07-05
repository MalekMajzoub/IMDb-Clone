<x-layout>
    <x-card class="p-2 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Add/Edit Category
            </h2>
            <p class="mb-4">Add/Edit Category for: {{ $movie->title }}</p>
        </header>

        <form method="POST" action="/cms/movies/{{ $movie->id }}/categories" enctype="multipart/form-data">
            @csrf
            <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0">
                <div class="inline-block relative w-56 ">
                    <h3 class="mb-1">Choose Category</h3>
                    <select name='id' class="mb-2 block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        <option value="" disabled>Choose Category</option>
                        @if(count($categories))
                            @foreach ($categories as $category)
                                @unless ($movie->categories()->where('category_id', $category->id)->exists())
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endunless
                            @endforeach
                        @endif
                    </select>
                    <div class="pointer-events-none absolute bottom-5 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </div>
    
            <div class="mb-6">
                <button class="bg-yellow-500 text-white rounded py-2 px-4 hover:bg-black">
                    Add/Edit Category
                </button>

                <a href="/cms/movies/managemovies" class="text-black ml-4"> Back </a>
            </div>

            <div>
                <ul>
                @foreach ($movie->categories as $category)
                    <li class="text-lg font-bold">{{ $category->title }}</span></li>
                @endforeach
                </ul>
            </div>
        </form>
    </x-card>
</x-layout>