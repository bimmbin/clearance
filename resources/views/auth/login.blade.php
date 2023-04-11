@extends('layout.layout')
@section('docTitle')
    Landing Page
@endsection


@section('content')
    <div class="absolute top-0 left-0 w-[100vw] h-[100vh] flex max-lg:flex-col items-center justify-center bg-checkb gap-48">
        <div class="text-white flex flex-col gap-2 max-lg:hidden">
            <img src="img/icons/chcclogo-white.png" class="w-[40rem] absolute opacity-5 mt-[-10rem] ml-[-10rem]" alt="">
            <p class="text-3xl">Concepcion Holy Cross College Inc</p>
            <h1 class="text-6xl font-semibold">Clearance System</h1>
            <p class="w-[33rem] text-xl ">Introducing our innovative school clearance system. Say goodbye to long wait times and complicated procedures. Our digital platform streamlines clearance, so you can focus on your studies.</p>
        </div>
        <div class="w-4/12 max-lg:w-6/12 max-sm:w-11/12 bg-white p-6 rounded-lg">

            @empty(!$student)
                <p>Student Account:</p>
                <p>Username: {{ $student->username }}</p>
                <p>Password: {{ $student->profiles->studentno }}</p></br>
            @endempty

            @empty(!$officer)
                <p>Officer Account:</p>
                <p>Username: {{ $officer->username }}</p>
                <p>Password: {{ $officer->profiles->employeeno }}</p></br>
            @endempty

            @empty(!$registrar)
                <p>Registrar Account:</p>
                <p>Username: {{ $registrar->username }}</p>
                <p>Password: {{ $registrar->profiles->employeeno }}</p></br>
            @endempty

            @empty(!$admin)
                <p>Admin Account:</p>
                <p>Username: {{ $admin->username }}</p>
                <p>Password: 123</p>
            @endempty
            
            @if (session('status'))
                <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                    {{ session('status') }}
                </div>
            @endif


            <form action="{{ route('login') }}" method="post">
                @csrf

                <div class="mb-4">
                    <label for="username" class="sr-only">Email</label>
                    <input type="text" name="username" id="email" placeholder="Your username"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ old('email') }}">


                    @error('username')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror"
                        value="">

                    @error('password')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="bg-checkb hover:bg-blue-800 text-white px-4 py-3 rounded font-medium w-full">login</button>
            </form>
        </div>
    </div>
@endsection
