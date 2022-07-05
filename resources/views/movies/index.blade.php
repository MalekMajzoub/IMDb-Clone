<x-layout>

@include('partials._hero')
@include('partials._search')
    
<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

@unless (count($movies) == 0)
    

@foreach ($movies as $movie)
    <x-movie-card :movie="$movie" />
@endforeach

@else
<p>No listings found!</p>
@endunless
</div>

<div class="mt-6 p-4">
    {{ $movies->links() }}
</div>
</x-layout>
