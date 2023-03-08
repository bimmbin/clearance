<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('docTitle')</title>
    <link rel="icon" type="image/x-icon" href="asset/chcc vector logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        mont: "'Montserrat', sans-serif",
                    },
                    colors: {
                        darkblue: '#05041B',
                        grayish: '#d6d8f3',
                        dirtywhite: '#f1f1f1',
                        borderr: '#252440',
                        blacky: '#000000',
                        tableborderr: '#B5B5B5',
                        checkb: '#1812A4',
                        tablebg: '#FAFAFA',
                    }
                }
            }
        }
    </script>

    <style>
        .burger-menu {
            position: relative;
            display: inline-block;
        }

        .burger-menu input[type="checkbox"] {
            display: none;
        }

        .burger-menu label {
            display: block;
            width: 30px;
            height: 30px;
            position: relative;
            cursor: pointer;
        }

        .burger-menu label span {
            display: block;
            width: 100%;
            height: 3px;
            background-color: #333;
            position: absolute;
            top: 50%;
            transition: transform 0.3s ease;
        }

        .burger-menu label span:nth-child(1) {
            margin-top: 10px;
        }

        .burger-menu label span:nth-child(2) {
            margin-left: 10px;
        }

        .burger-menu label span:nth-child(3) {
            margin-bottom: 10px;

        }


        .burger-menu input[type="checkbox"]:checked+label span:nth-of-type(1) {
            transform: rotateX(200deg);
        }

        .burger-menu input[type="checkbox"]:checked+label span:nth-of-type(2) {
            transform: scale(0);
        }

        .burger-menu input[type="checkbox"]:checked+label span:nth-of-type(3) {
            transform: rotateX(-200deg);
        }

        .burger-content {
            display: none;
            position: absolute;
            right: 0;
            width: auto;
            margin-top: 40px;
            height: 430px;
        }

        .burger-menu input[type="checkbox"]:checked+label+.burger-content {
            display: block;
            animation: slide-down 0.3s ease;
        }

        .burger-content a {
            text-decoration: none;
        }

        /* ::-webkit-scrollbar {
      display: none;
    } */

        @keyframes slide-down {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(0);
            }
        }
    </style>
</head>

<body class="font-mont overflow-y-hidden">

    <section class="flex bg-dirtywhite max-w-[1920px]">

        <!-- leftcolumn -->
        @auth
            <div class="flex flex-col items-center relative w-[200px] bg-darkblue h-auto max-md:hidden">

                <div class="flex-col flex items-center my-[30px]">

                    <h1 class="text-white font-semibold text-2xl"><a href="{{ route('home') }}">Dashboard</a> </h1>

                </div>

                <ul class="flex flex-col items-center my-12 text-white">


                    @if (Auth::user()->role === 'admin')
                        <li
                            class="w-[130px] pt-3 flex gap-3 border-b items-center pb-4 hover:border-blu cursor-pointer hover:text-blu hover:font-medium">

                            <img class="w-[20px] h-[20px]" src="img/icons/Student Center.png" alt="">
                            <a class="" style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem);"
                                href="{{ route('createstudent') }}">Student</a>
                        </li>

                        <li
                            class="w-[130px] pt-3 flex gap-3 border-b items-center pb-4 hover:border-blu cursor-pointer hover:text-blu hover:font-medium">

                            <img class="w-[20px] h-[20px]" src="img/icons/School Director.png" alt="">
                            <a class="" style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem);"
                                href="{{ route('createOfficer') }}">Officer</a>
                        </li>

                        <li
                            class="w-[130px] pt-3 flex gap-3 border-b items-center pb-4 hover:border-blu cursor-pointer hover:text-blu hover:font-medium">

                            <img class="w-[20px] h-[20px]" src="img/icons/Tasklist.png" alt="">
                            <a class="" style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem);"
                                href="{{ route('createdepartment') }}">Department</a>
                        </li>
                    @endif


                    @if (Auth::user()->role === 'student')
                        <li
                            class="w-[130px] pt-3 flex gap-3 border-b items-center pb-4 hover:border-blu cursor-pointer hover:text-blu hover:font-medium">

                            <img class="w-[20px] h-[20px]" src="img/icons/Tasklist.png" alt="">
                            <a class="" style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem);"
                                href="{{ route('student.clearance') }}">Clearance</a>
                        </li>
                    @endif

                    {{-- <li
                    class="w-[130px] pt-3 flex gap-3 border-b gap-5 pb-4 hover:border-blu cursor-pointer hover:text-blu hover:font-medium">

                    <img class="w-[20px] h-[20px]" src="img/icons/School Director.png" alt="">
                    <a class="" style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem);"
                        href="#">Instructor Subject</a>
                </li>

                <li
                    class="w-[130px] flex gap-3 border-b gap-5 items-center pb-4 hover:border-blu cursor-pointer hover:text-blu hover:font-medium">

                    <img class="w-[20px] h-[20px]" src="img/icons/Tasklist.png" alt="">
                    <a class="" style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem);"
                        href="#">Section</a>
                </li> --}}

                </ul>

            </div>

        @endauth
        <!-- right-column -->
        <div class="w-screen h-screen overflow-y-scroll scrollbar-y-hidden">

            <!-- header -->
            <header class="flex w-[100%] bg-white items-center justify-between py-[20px] px-[50px]">

                <a href="{{ route('home') }}"><img class="w-[150px] max-2xl:w-[120px]" src="img/icons/CHCC logo.png"
                        alt=""></a>

                <ul class="flex items-center max-md:hidden">
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
                {{-- <div class="flex items-center gap-5">
          <img
            class="w-[57px] h-[57px] max-lg:w-[40px] max-lg:h-[40px] max-2xl:w-[45px] max-2xl:h-[45px] max-sm:h-[35px] max-sm:w-[35px] max-md:hidden"
            src="asset/user-profile.png" alt="user-profile">
        </div> --}}

                <div class="burger-menu hidden max-md:block">


                    <input type="checkbox" id="burger-toggle">
                    <label for="burger-toggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </label>
                    <div class="burger-content h-[35rem] bg-darkblue border border-blu">

                        <ul class="flex flex-col items-center my-5 text-white">

                            @auth
                                @if (Auth::user()->role === 'admin')
                                    <li
                                        class="w-[130px] pt-3 flex gap-3 border-b items-center pb-4 hover:border-blu cursor-pointer hover:text-blu hover:font-medium">

                                        <img class="w-[20px] h-[20px]" src="img/icons/Student Center.png" alt="">
                                        <a class="" style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem);"
                                            href="{{ route('createstudent') }}">Student</a>
                                    </li>

                                    <li
                                        class="w-[130px] pt-3 flex gap-3 border-b items-center pb-4 hover:border-blu cursor-pointer hover:text-blu hover:font-medium">

                                        <img class="w-[20px] h-[20px]" src="img/icons/School Director.png" alt="">
                                        <a class="" style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem);"
                                            href="{{ route('createOfficer') }}">Officer</a>
                                    </li>

                                    <li
                                        class="w-[130px] pt-3 flex gap-3 border-b items-center pb-4 hover:border-blu cursor-pointer hover:text-blu hover:font-medium">

                                        <img class="w-[20px] h-[20px]" src="img/icons/Tasklist.png" alt="">
                                        <a class="" style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem);"
                                            href="{{ route('createdepartment') }}">Department</a>
                                    </li>
                                @endif


                                @if (Auth::user()->role === 'student')
                                    <li
                                        class="w-[130px] pt-3 flex gap-3 border-b items-center pb-4 hover:border-blu cursor-pointer hover:text-blu hover:font-medium">

                                        <img class="w-[20px] h-[20px]" src="img/icons/Tasklist.png" alt="">
                                        <a class=""
                                            style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem);"
                                            href="{{ route('student.clearance') }}">Clearance</a>
                                    </li>
                                @endif
                            @endauth


                            @auth
                                <li
                                    class="w-[224px] flex items-center gap-3 py-3 hover:border-blu cursor-pointer hover:font-medium hover:text-blu max-xl:pl-6 border-l-2 hover:border-l-14 mt-2">
                                    <div class="bg-green-500 w-5 h-5 rounded-full"></div>
                                    <a href="" class="p-3">{{ auth()->user()->username }}</a>
                                </li>
                                <li
                                    class="w-[224px] flex items-center gap-3 py-3 hover:border-blu cursor-pointer hover:font-medium hover:text-blu max-xl:pl-6 border-l-2 hover:border-l-14 mt-2">
                                    <form action="{{ route('logout') }}" method="post" class="p-3 inline">
                                        @csrf
                                        <button type="submit"
                                            class="w-[224px] flex items-center gap-3 py-3 hover:border-blu cursor-pointer hover:font-medium hover:text-blu max-xl:pl-6 border-l-2 hover:border-l-14 mt-2">Logout</button>
                                    </form>
                                </li>
                            @endauth

                            @guest
                                <li
                                    class="w-[224px] flex items-center gap-3 py-3 hover:border-blu cursor-pointer hover:font-medium hover:text-blu max-xl:pl-6 border-l-2 hover:border-l-14 mt-2">
                                    <a href="{{ route('login') }}" class="p-3">Login</a>
                                </li>
                                <li
                                    class="w-[224px] flex items-center gap-3 py-3 hover:border-blu cursor-pointer hover:font-medium hover:text-blu max-xl:pl-6 border-l-2 hover:border-l-14 mt-2">
                                    <a href="{{ route('register') }}" class="p-3">Register</a>
                                </li>
                            @endguest

                        </ul>


                    </div>
                </div>
            </header>

            <main class="w-[97%] h-auto bg-white  mt-5 mx-auto rounded-xl flex-col mb-10">


                @yield('content')

            </main>

    </section>

</body>

</html>
