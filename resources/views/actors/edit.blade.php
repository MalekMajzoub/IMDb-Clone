<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Edit Actor
            </h2>
            <p class="mb-4">Edit: {{ $actor->first_name }} {{ $actor->last_name }} </p>
        </header>

        <form method="POST" action="/cms/actors/{{ $actor->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="first_name" class="inline-block text-lg mb-2">First Name</label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="first_name"
                    value={{ $actor->first_name }}
                />
                @error('first_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="first_name" class="inline-block text-lg mb-2">Last Name</label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="last_name"
                    value={{ $actor->last_name }}
                />
                @error('last_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="gender" class="inline-block text-lg mb-2">Gender</label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="gender"
                    value={{ $actor->gender }}
                />
                @error('gender')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="image" class="inline-block text-lg mb-2">
                    Image
                </label>
                <input
                    type="file"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="image"
                />

                <img
                    class="w-48 mr-6 mb-6"
                    src="{{ $actor->image ? asset('storage/' . $actor->image) : asset('/images/no-image.png') }}"
                    alt=""
                />

                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="dob" class="inline-block text-lg mb-2">Date of Birth (YYYY-MM-DD)</label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="dob"
                    value="{{ $actor->dob }}"
                />

                @error('dob')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="nationality" class="inline-block text-lg mb-2">Nationality</label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="nationality"
                    value="{{ $actor->nationality }}"
                />
                @error('nationality')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button class="bg-yellow-500 text-white rounded py-2 px-4 hover:bg-black">
                    Edit Actor
                </button>

                <a href="/cms/actors/manageactors" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>