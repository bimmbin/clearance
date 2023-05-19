@extends('layout.layout')
@section('docTitle')
    Landing Page
@endsection


@section('content')
    <div class="absolute left-0 top-0 w-[100vw] h-[100vh] flex flex-col justify-center items-center" id="editDiaglogBox">
        <div class="absolute z-50 bg-white py-5 px-5 rounded-lg max-sm:w-full">

            <form action="{{ route('user.changepass') }}" method="post" class="flex justify-center items-center w-full">
                @csrf

                <div class="flex flex-col items-center w-[20rem] max-sm:w-full">
                    <div class="flex w-full flex-col flex-wrap gap-2 justify-center items-center">

                        <h1 class="font-semibold text-2xl mb-5">New password</h1>

                        <div class="flex flex-col w-full">
                            <label for="a" class="font-semibold text-sm">Password</label>
                            <input type="password" class="w-full border border-gray-300 py-2 px-3 text-lg rounded-md @error('password') border-2 border-red-400 @enderror"
                                id="a" placeholder="Password" name="password">
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="b" class="font-semibold text-sm">Repeat password</label>
                            <input type="password" class="w-full border border-gray-300 py-2 px-3 text-lg rounded-md @error('password') border-2 border-red-400 @enderror"
                                name="password_confirmation" id="password_confirmation" placeholder="Repeat password"
                                required>
                        </div>

                        @error('password')
                            <div class="text-red-500 mb-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror

                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    </div>

                    <div class="flex flex-col gap-2  w-full mt-2">
                        <button type="submit"
                            class=" w-full bg-darkblue hover:bg-blue-900 py-2 px-3 text-lg rounded-md text-white flex-1">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="absolute bg-black opacity-60 w-[100vw] h-[100vh] z-20" id="bgBlack"></div>

    </div>
@endsection
