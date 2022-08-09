<section class="relative h-72 bg-yellow-500 flex flex-col justify-center align-center text-center space-y-4 mb-4">
    <div class="z-10">
        <h1 class="text-6xl font-bold uppercase text-black">IMDb Clone</h1>
        @if(Auth::guest())
        <div>
            <a
                href="{{ route('users.login') }}"
                class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black">
                Sign In to rate your favorite movie
            </a>
        </div>
        @endif
    </div>
</section>
