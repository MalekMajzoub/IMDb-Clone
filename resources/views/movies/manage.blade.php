<x-layout>
    <x-card class="p-10">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">
                Manage Movies
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
                @unless($movies->isEmpty())
                @foreach ($movies as $movie)
                
                <tr class="border-gray-300">
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <img
                            class="hidden w-48 mr-6 md:block"
                            src="{{ $movie->logo ? asset('storage/' . $movie->logo) : asset('/images/no-image.png') }}"
                            alt="" />
                    </td>

                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <a href="{{ route('movies.show', ['movie' => $movie->id]) }}" class="text-blue-400 px-6 py-2 rounded-xl">
                            {{ $movie->title }}
                        </a>
                        
                    </td>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <a href="{{ route('movies.addEditActorsForm', ['movie' => $movie->id]) }}" class="text-blue-400 px-6 py-2 rounded-xl">
                            <i class="fa-solid fa-pen-to-square"></i> Add/Edit Cast
                        </a>
                    </td>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <a href="{{ route('movies.addEditCategoriesForm', ['movie' => $movie->id]) }}" class="text-blue-400 px-6 py-2 rounded-xl">
                            <i class="fa-solid fa-pen-to-square"></i> Add/Edit Category
                        </a>
                    </td>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <a href="{{ route('movies.edit', ['movie' => $movie->id]) }}" class="text-blue-400 px-6 py-2 rounded-xl">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                    </td>
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <form method="POST" action="{{ route('movies.destroy', ['movie' => $movie->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr class="border-gray-300">
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <p class="text-center">No Movies Found</p>
                    </td>
                </tr>
                @endunless
            </tbody>
        </table>
    </x-card>
    <x-card class="mt-4 p-2 px-10 flex space-x-6">
        <a href="{{ route('movies.create') }}">
            <i class='fa fa-plus' style='color: #19a922'></i> Add
        </a>
    </x-card>
    <div class="mt-6 p-4">
        {{ $movies->links() }}
    </div>
                
</x-layout>