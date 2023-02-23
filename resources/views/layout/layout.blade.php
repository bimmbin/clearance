<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    @vite('resources/css/app.css')

    <title>@yield('docTitle')</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="bg-grey">

    <section class="flex">
        <!-- leftcolumn -->
        <div class="bg-darkblue w-[213px] h-screen text-white sticky top-0">
            <h1 class="p-5 text-2xl font-bold text-center"><a href="{{ route('home') }}">Dashboard</a></h1>

            <ul class="mt-20">
                <li class="flex gap-5 border-b-2 pl-3 pb-4 border-borderr mx-4 pt-5 mt-2 hover:bg-sky-700 cursor-pointer items-center">
                    <img class="w-7 h-7" src="img/icons/Tasklist.png" alt="">
                    <a class="text-[17px] font-semibold" href="#">Section</a>
                </li>

                <li class="flex gap-5 border-b-2 pb-4 ml-4 mr-4 px-2 border-borderr pt-5 pl-3 hover:bg-sky-700 cursor-pointer">
                    <img class="w-7 h-7" src="img/icons/Tasklist.png" alt="">
                    <a class="text-[17px] font-semibold" href="#">Subject</a>
                </li>

                <li class="flex gap-5 border-b-2 pb-4 ml-4 mr-4 px-2 border-borderr pt-5 pl-3 hover:bg-sky-700 cursor-pointer">
                    <img class="w-7 h-7" src="img/icons/Student Center.png" alt="">
                    <a class="text-[17px] font-semibold" href="#">Student</a>
                </li>

                <li class="flex gap-5 border-b-2 pb-4 ml-4 mr-4 px-2 border-borderr pt-5 pl-3 hover:bg-sky-700 cursor-pointer">

                    <img class="w-7 h-7" src="img/icons/School Director.png" alt="">
                    <a class="text-[17px] font-semibold" href="#">Instructor</a>
                </li>

                <li class="flex gap-5 pb-4 ml-4 mr-4 px-2 border-borderr pt-5 pl-3 hover:bg-sky-700 cursor-pointer">

                    <img class="w-7 h-7" src="img/icons/School Director.png" alt="">
                    <a class="text-[17px] font-semibold" href="#">Instructor Subjects</a>
                </li>

            </ul>

        </div>

        <!-- rightcolumn -->
        <div class="w-screen bg-dirtywhite flex flex-col items-center">

            <!-- header -->
            <div class="w-full flex items-center justify-between mx-auto bg-white py-2 pl-12 pr-28 h-20">

                <a href="#"><img class="w-32" src="img/icons/CHCC logo.png" alt=""></a>

                <ul class="flex items-center">
                    @auth
                        <li>
                            <a href="" class="p-3">{{ auth()->user()->username }}</a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="post" class="p-3 inline">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        </li>
                    @endauth

                    @guest
                        <li>
                            <a href="{{ route('login') }}" class="p-3">Login</a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}" class="p-3">Register</a>
                        </li>
                    @endguest
                </ul>

                {{-- <a href="#"><img class="w-14 h-14" src="img/icons/user-profile.png" alt=""></a> --}}

            </div>
            <div class="w-[97%] h-auto pb-20 bg-white my-8 rounded-xl flex flex-col p-10">

                @yield('content')

            </div>

        </div>



    </section>

</body>

</html>
