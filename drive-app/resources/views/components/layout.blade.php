<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drive</title>
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <script src="/tailwind.js"></script>
    <script src="/alpine.js"></script>
</head>

<body>
    <nav class="bg-slate-600 h-16 w-full flex items-center justify-between px-2 md:px-5">
        <a href="/">
            <h1 class="text-2xl text-gray-200">
                <img class="h-8" src="/drive.png" alt="">
            </h1>
        </a>
        <form class="ml-auto mr-0 mr-5" action="/docs" method="get">
            @csrf 
            <input type="text" class="w-44 md:w-80 p-2 px-3 rounded" placeholder="Search documents..." name="search" value="{{ request()->search }}">
            <input type="submit" class="py-2 px-3 rounded bg-green-600 text-white cursor-pointer" value="Search">
        </form>
        <ul class="flex">
            @auth
                <li class="text-orange-400 hover:underline">
                    <a href="/logout">
                        <i class="fa fa-sign-out text-3xl"></i>
                    </a>
                </li>
            @else
                <li class="ml-3 md:ml-4 text-gray-300 hover:underline">
                    <a href="/login">Login</a>
                </li>
                <li class="ml-3 md:ml-4 text-gray-300 hover:underline">
                    <a href="/register">Register</a>
                </li>

                {{-- <li class="text-green-500 hover:underline">
                    <a href="/register">
                        <i class="fa fa-sign-in text-3xl"></i>
                    </a>
                </li> --}}
            @endauth
        </ul>
    </nav>

    <main class="flex relative">
        <nav id="sdb" class="sidebar bg-slate-500 w-24 py-6 -left-24 absolute md:static transition-all duration-500 h-full lg:h-auto" style="min-height: calc(100vh - 64px);">
            <ul class="flex flex-col items-center">

                <li id="left" class="md:hidden h-12 w-12 hover:bg-slate-600 my-0 rounded-full flex items-center justify-center text-2xl text-slate-800 transition ease-in-out duration-500" onclick="hide()">
                    <i class="fa fas fa-chevron-circle-left"></i>
                </li>

                <li class="h-12 w-12 hover:bg-slate-600 my-2 rounded-full flex items-center justify-center text-2xl text-slate-800 transition ease-in-out duration-500">
                    <a href="/">
                        <i class="fa fa-home"></i>
                    </a>
                </li>

                @auth
                
                <li class="h-12 w-12 hover:bg-slate-600 my-2 rounded-full flex items-center justify-center text-2xl text-slate-800 transition ease-in-out duration-500">
                    <a href="/docs?user={{auth()->user()->id}}">
                        <i class="fa far fa-list-alt"></i>
                    </a>
                </li>
                
                <li class="h-12 w-12 hover:bg-slate-600 my-2 rounded-full flex items-center justify-center text-2xl text-slate-800 transition ease-in-out duration-500">
                    <a href="/bookmarks?user={{ auth()->user()->id }}">
                        <i class="fa fa-star"></i>
                    </a>
                </li>

                <li class="h-12 w-12 hover:bg-slate-600 my-2 rounded-full flex items-center justify-center text-2xl text-slate-800 transition ease-in-out duration-500">
                    <a href="/docs/create">
                        <i class="fa far far fa-plus-square"></i>
                    </a>
                </li>

                @endauth

                <li class="h-12 w-12 hover:bg-slate-600 my-2 rounded-full flex items-center justify-center text-2xl text-slate-800 transition ease-in-out duration-500">
                    <a href="/docs">
                        <i class="fa fas fa-globe"></i>
                    </a>
                </li>


                @guest
                    
                <li class="h-12 w-12 hover:bg-slate-600 my-2 rounded-full flex items-center justify-center text-2xl text-slate-800 transition ease-in-out duration-500">
                    <a href="/login">
                        <i class="fa fas fa-sign-in"></i>
                    </a>
                </li>

                @endguest

                @auth

                <li class="h-12 w-12 hover:bg-slate-600 my-2 rounded-full flex items-center justify-center text-2xl text-slate-800 transition ease-in-out duration-500">
                    <a href="/users">
                        <i class="fa fas fa-users"></i>
                    </a>
                </li>

                <li class="h-12 w-12 hover:bg-slate-600 my-2 rounded-full flex items-center justify-center text-2xl text-slate-800 transition ease-in-out duration-500">
                    <a href="/users/{{ auth()->user()->id }}">
                        <i class="fa far fa-user"></i>
                    </a>
                </li>

                <li class="h-12 w-12 hover:bg-slate-600 my-2 rounded-full flex items-center justify-center text-2xl text-slate-800 transition ease-in-out duration-500">
                    <a href="/logout">
                        <i class="fa far fas fa-power-off"></i>
                    </a>
                </li>

                @endauth

                <li class="h-12 w-12 hover:bg-slate-600 my-2 rounded-full flex items-center justify-center text-2xl text-slate-800 transition ease-in-out duration-500">
                    <a @if(Auth::check() && auth()->user()->position == 'admin') href="/report/reports" @else href="/report" @endif>
                        <i class="fa far fas fa-info-circle"></i>
                    </a>
                </li>
            </ul>

        </nav>
        <p id="right" class="absolute p-5 text-2xl text-slate-500 md:hidden transition-all ease-in duration-500" onclick="show()">
            <i class="fa fas fa-chevron-circle-right"></i>
        </p>

        <div class="main bg-slate-200 w-full pt-14 md:pt-10 p-4 sm:p-10" style="min-height: calc(100vh - 64px);">
            
            {{ $slot }}

        </div>
    </main>

    <x-flash-message />

    <script>
        const sdb = document.getElementById('sdb')
        const right = document.getElementById('right')
        const left = document.getElementById('left')

        function show() {
            sdb.classList.remove('-left-24')
            sdb.classList.add('left-0')
            right.classList.add('hidden')
            left.classList.remove('hidden')
            left.classList.add('block')
        }

        function hide() {
            sdb.classList.remove('left-0')
            sdb.classList.add('-left-24')
            right.classList.remove('hidden')
            right.classList.add('block')

        }
    </script>
</body>

</html>