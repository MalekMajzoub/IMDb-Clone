<x-layout>
    <x-card class="p-10 rounded max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Forgot Your Password?
            </h2>
            <p class="mb-4">No Worries. Please provide your registered email.</p>
        </header>

        <form method="POST" action="/users/forgotpassword">
            @csrf
            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2">Email</label>
                <input
                    type="email"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="email"
                    value="{{ old('email') }}"
                />
                @error('email')
                    <p class="text-red-500 text-xs mt-1"></p>{{ $message }}
                @enderror
            </div>
            <div class="mb-6">
                <button type="submit" class="bg-yellow-500 text-white py-2 px-4 hover:bg-black rounded">Send Email</button>
            </div>
        </form>
    </x-card>
</x-layout>