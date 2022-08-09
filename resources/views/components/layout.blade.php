<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="images/favicon.ico" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script src="https://cdn.tailwindcss.com"></script>
        <title>IMDB Clone</title>
    </head>
    <body class="mb-48" flex>
        <nav class="flex justify-between items-center mb-4">
            @unlessrole('admin')
            <a href="/">
                <img class="w-24" src="{{ asset('images/logo.png') }}" alt="" class="logo"/>
            </a>
            @else
                <h1 class="text-lg font-bold uppercase">Dashboard</h1>
            @endunlessrole
            <ul class="flex space-x-6 mr-6 text-lg">
                @auth
                <li>
                    <span class="font-bold uppercase">
                        Welcome {{ auth()->user()->name }}
                    </span>
                </li>
                @role('admin')
                <li>
                    <a href="{{ route('movies.manage') }}" class="hover:text-yellow-500">
                        <i class="fa-solid fa-gear"></i>
                        Manage Movies
                    </a>
                </li>
                <li>
                    <a href="{{ route('categories.manage') }}" class="hover:text-yellow-500">
                        <i class="fa-solid fa-gear"></i>
                        Manage Categories
                    </a>
                </li>
                <li>
                    <a href="{{ route('actors.manage') }}" class="hover:text-yellow-500">
                        <i class="fa-solid fa-gear"></i>
                        Manage Actors
                    </a>
                </li>
                @endrole
                <li>
                    <form class="inline" method="POST" action="{{ route('users.logout') }}">
                        @csrf
                        <button type="submit">
                            <i class="fa-solid fa-door-closed"></i> Logout
                        </button>
                    </form>
                </li>
                @else

                <li>
                    <a href="{{ route('users.register') }}" class="hover:text-yellow-500"
                        ><i class="fa-solid fa-user-plus"></i> Register</a
                    >
                </li>
                <li>
                    <a href="{{ route('users.login') }}" class="hover:text-yellow-500">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                        Login
                    </a>
                </li>
                @endauth
            </ul>
        </nav>
        <main>
    {{ $slot }}
        </main>
    </body>
</html>
