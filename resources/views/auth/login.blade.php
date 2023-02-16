@extends('layout.layout')
@section('docTitle')
    Landing Page
@endsection


@section('content')


    @foreach ($samples as $sample)
        <p>{{ $sample }}</p>
    @endforeach

    <div class="w-full flex flex-col items-center">
        <div class="w-4/12 bg-white p-6 rounded-lg">
            <form action="" method="post">
                @csrf

                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" name="email" id="email" placeholder="Your email"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ old('email') }}">

                </div>

                <div class="mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('password') border-red-500 @enderror"
                        value="">


                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">login</button>
            </form>
        </div>
    </div>
@endsection
