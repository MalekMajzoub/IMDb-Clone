<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Rate Movie
            </h2>
            <p class="mb-4">Rate: {{ $movie->title }}</p>
        </header>

        <form method="POST" action="{{ route('movies.addRating', ['movie' => $movie->id]) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-6" flex>
                <label for="title" class="inline-block text-lg mb-2 w-full">
                    Hi <b>{{ auth()->user()->name }}</b>. Feel free to share your rating with us!
                </label>

                <div class="form-check">
                    <input
                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-yellow-500 checked:border-black focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                        type="radio" name="rating" value="1">
                    <label class="form-check-label inline-block text-gray-800">
                        1
                    </label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-yellow-500 checked:border-black focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                        type="radio" name="rating" value="2">
                    <label class="form-check-label inline-block text-gray-800">
                        2
                    </label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-yellow-500 checked:border-black focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                        type="radio" name="rating" value="3">
                    <label class="form-check-label inline-block text-gray-800">
                        3
                    </label>
                </div>
                <div class="form-check">
                    <input
                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-yellow-500 checked:border-black focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                        type="radio" name="rating" value="4">
                    <label class="form-check-label inline-block text-gray-800">
                        4
                    </label>
                </div>
                <div class="form-check">
                    <input checked
                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-yellow-500 checked:border-black focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                        type="radio" name="rating" value="5">
                    <label class="form-check-label inline-block text-gray-800">
                        5
                    </label>
                </div>
                <div class="form-check">
                    <input checked
                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-yellow-500 checked:border-black focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                        type="radio" name="rating" value="6">
                    <label class="form-check-label inline-block text-gray-800">
                        6
                    </label>
                </div>
                <div class="form-check">
                    <input checked
                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-yellow-500 checked:border-black focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                        type="radio" name="rating" value="7">
                    <label class="form-check-label inline-block text-gray-800">
                        7
                    </label>
                </div>
                <div class="form-check">
                    <input checked
                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-yellow-500 checked:border-black focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                        type="radio" name="rating" value="8">
                    <label class="form-check-label inline-block text-gray-800">
                        8
                    </label>
                </div>
                <div class="form-check">
                    <input checked
                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-yellow-500 checked:border-black focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                        type="radio" name="rating" value="9">
                    <label class="form-check-label inline-block text-gray-800">
                        9
                    </label>
                </div>
                <div class="form-check">
                    <input checked
                        class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-yellow-500 checked:border-black focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                        type="radio" name="rating" value="10">
                    <label class="form-check-label inline-block text-gray-800">
                        10
                    </label>
                </div>

                <div class="mb-6">
                    <button class="bg-yellow-500 text-white rounded py-2 px-4 hover:bg-black">
                        Add Rating
                    </button>

                    <a href="{{ route('movies.show', ['movie' => $movie->id]) }}}}" class="text-black ml-4"> Back </a>
                </div>
            </div>
        </form>
    </x-card>
</x-layout>
