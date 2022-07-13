<x-layout>
    @role('admin')
        <a href="{{ route('movies.manage') }}" class="inline-block text-black ml-4 mb-4">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    @else
        <a href="{{ route('movies.all') }}" class="inline-block text-black ml-4 mb-4">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
    @endunlessrole
    <div class="mx-4">
        <x-card class="p-10">
            <div class="flex flex-col items-center justify-center text-center">
                <img class="w-48 mr-6 mb-6"
                    src="{{ $movie->logo ? asset('storage/' . $movie->logo) : asset('/images/no-image.png') }}"
                    alt="" />
                <h3 class="text-2xl font-bold mb-2">{{ $movie->title }}</h3>
                <div class="text-basic mb-4"><b>Genre:</b>
                    @foreach ($movie->categories as $category)
                        <span class="text-lg">{{ $category->title }} | </span>
                    @endforeach
                </div>
                <div class="text-lg mb-4"><b>Rating:</b>
                    @if ($movie->rating)
                        {{ $movie->rating }} /10
                    @else
                        It is not rated yet.
                    @endif
                </div>
                <div class="text-base mt-4">
                    <b>Trailer:</b>
                    @if ($movie->trailer)
                        <a href="{{ $movie->trailer }}"><u>Press Here</u></a>
                    @else
                        <span>No Trailer Found</span>
                    @endif
                </div>
                <div class="text-basic mb-4"><b>Release Date:</b> {{ $movie->release_date }}</div>
                <div class="text-basic mb-4"><b>Production Date:</b> {{ $movie->production_date }}</div>
                <h3 class="text-3xl font-bold mb-4">
                    Actors
                </h3>
                <ul>
                    @foreach ($movie->actors as $actor)
                        <li class="text-lg font-bold">{{ $actor->first_name }} {{ $actor->last_name }} - <span
                                class="font-normal italic">{{ $actor->pivot->character_name }}</span></li>
                    @endforeach
                </ul>
                <div class="border-t border-gray-200 w-full p-4">
                    <h3 class="text-3xl font-bold mb-4">
                        Movie Description
                    </h3>
                    <div class="text-lg space-y-6">
                        {{ $movie->description }}
                    </div>
                </div>
            </div>
        </x-card>
        @unlessrole('admin')
            <x-card class="mt-4 p-2 flex space-x-6">
                <a href="{{ route('movies.rate', ['movie' => $movie->id]) }}">
                    <i class='fa fa-star' style='color: #ecbb21'></i> Rate
                </a>
            </x-card>
        @endunlessrole
    </div>
</x-layout>
