@props(['movie'])

<x-card>
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src="{{ $movie->logo ? asset('storage/' . $movie->logo) : asset('/images/no-image.png') }}"
            alt=""
        />
        <div>
            <h3 class="text-2xl">
                <a href="{{ route('movies.show', ['movie' => $movie->id]) }}">{{ $movie->title }}</a>
            </h3>
            <div class="text-base mt-4">
                <b>Description:</b> {{ Str::limit($movie->description, 100) }}
            </div>
        </div>
    </div>
</x-card>