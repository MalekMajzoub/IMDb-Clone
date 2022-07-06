<x-layout>
    <x-card class="p-10 rounded max-w-lg mx-auto mt-24" >
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Login
            </h2>
            <p class="mb-4">Login into your account to rate movies</p>
        </header>

        <form method="POST" action="{{ route('users.authenticate') }}">
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
                <label for="password" class="inline-block text-lg mb-2">Password</label>
                <input
                    type="password"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="password"
                    value="{{ old('password') }}"
                />
                @error('password')
                    <p class="text-red-500 text-xs mt-1"></p>{{ $message }}
                @enderror
            </div>

            <div class="mb-6">
                <button type="submit" class="bg-yellow-500 text-white py-2 px-4 hover:bg-black rounded">Sign In</button>
            </div>
            <div class="mt-8">
                <p>
                    Don't have an account?
                    <a href="{{ route('users.register') }}" class="text-yellow-600 font-bold">Register</a>
                </p>
            </div>
            <div class="mt-8">
                <p>
                    <a href="{{ route('users.forgotPasswordForm') }}" class="text-yellow-600 font-bold">Forgot your password?</a>
                </p>
            </div>
        </form>
    </x-card>
</x-layout>