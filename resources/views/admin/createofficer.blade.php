@extends('layout.layout')
@section('docTitle')
    Landing Page
@endsection


@section('content')
    <div class="flex w-full p-10 max-sm:p-2 max-sm:pt-8 flex-col gap-5 lg:flex-row">
        <form class="flex flex-col items-center max-sm:my-1 max-sm:mx-0  mx-10 gap-5 mt-14 max-xl:mb-14 sm:gap-3"
            action="{{ route('admin.createofficer') }}" method="post">

            @csrf
            <h1 class="text-blacky text-center font-semibold"
                style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);">Create
                Department Officer Account</h1>

            <input
                class="py-2 border-2 rounded-xl max-sm:w-11/12 px-5 mt-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[350px] @error('employeeno') border-red-500 @enderror"
                value="{{ old('employeeno') }}" type="text" placeholder="Employee Number" name="employeeno">

            @error('employeeno')
                <div class="text-red-500 max-sm:mt-[-1rem] mt-[-0.5rem] text-sm">
                    {{ $message }}
                </div>
            @enderror

            <input
                class="py-2 border-2 rounded-xl max-sm:w-11/12 px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[350px] @error('firstname') border-red-500 @enderror"
                value="{{ old('firstname') }}" type="text" placeholder="First name" name="firstname">

            @error('firstname')
                <div class="text-red-500 max-sm:mt-[-1rem] mt-[-0.5rem] text-sm">
                    {{ $message }}
                </div>
            @enderror

            <input
                class="py-2 border-2 rounded-xl max-sm:w-11/12 px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[350px] @error('lastname') border-red-500 @enderror"
                value="{{ old('lastname') }}" type="text" placeholder="Last name" name="lastname">

            @error('lastname')
                <div class="text-red-500 max-sm:mt-[-1rem] mt-[-0.5rem] text-sm">
                    {{ $message }}
                </div>
            @enderror

            <input
                class="py-2 border-2 rounded-xl max-sm:w-11/12 px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[350px] @error('middlename') border-red-500 @enderror"
                value="{{ old('middlename') }}" type="text" placeholder="Middle name" name="middlename">

            @error('middlename')
                <div class="text-red-500 max-sm:mt-[-1rem] mt-[-0.5rem] text-sm">
                    {{ $message }}
                </div>
            @enderror
            {{-- <input class="py-2 border-2 rounded-xl max-sm:w-11/12 px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[450px]"
                type="text" placeholder="Sex" name="sex"> --}}

            <select class="py-2 border-2 rounded-xl max-sm:w-11/12 px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[350px]">

                <option class="bg-darkblue text-white" value="Male">Male</option>
                <option class="bg-darkblue text-white" value="Female">Female</option>

            </select>



            <select class="py-2 border-2 rounded-xl max-sm:w-11/12 px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[350px]"
                name="department" id="department" name="department">

                @foreach ($departments as $department)
                    <option class="bg-darkblue text-white" value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach


            </select>


            <button
                class="py-2 rounded-xl px-5 max-sm:w-11/12 placeholder:text-sm w-[400px] lg:py-3 lg:w-[350px] bg-darkblue text-white hover:bg-sky-700   @if ($departments->isEmpty()) !bg-gray-500 line-through !hover:bg-gray-500 @endif "
                @if ($departments->isEmpty()) disabled @endif>Submit</button>
        </form>

        <div class="border h-[90%] my-auto max-xl:w-[90%] max-xl:h-0 max-xl:mx-auto max-xl:my-0"></div>

        <div class="w-full pb-10 overflow-x-auto overflow-y-hidden my-14 px-10 max-sm:px-5 max-sm:my-6">
            <h1 class="text-blacky text-left font-semibold mb-5"
                style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);">List of Department Officers</h1>


            <table class="whitespace-nowrap table-auto text-center w-[1920px] max-lg:w-[1280px] max-sm:w-[900px] text-lg xl:w-full "
                style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem) ;">
                <thead>
                    <tr class="space-y-3">
                        <th>Number</th>
                        <th>Name</th>
                        <th>Employee No.</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody class="space-y-6 font-semibold bg-tablebg">
                    @if (!$officers->isEmpty())
                        @foreach ($officers as $officer)
                            <tr class="border">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $officer->firstname . ' ' . $officer->lastname }}</td>
                                <td>{{ $officer->employeeno }}</td>
                                <td>{{ $officer->department->name }}</td>
                                <td class="py-2 flex gap-2">

                                    <div class="relative">
                                        <div class="bg-btnbg cursor-pointer hover:bg-btnhoverbg rounded-md"
                                            onclick="dropEdit{{ $loop->index }}()">
                                            <img class="max-w-[29px] max-h-[29px]" src="img/icons/edit-icon.png"
                                                alt="">

                                        </div>
                                        <div class="absolute bg-btnbg  rounded-md top-7 right-0 z-10 hidden"
                                            id="edit-{{ $loop->index }}">
                                            <form action="" method="post" class="flex flex-col">
                                                @csrf
                                                <button class="py-3 px-5 hover:bg-btnhoverbg">Edit Info</button>
                                                
                                            </form>
                                        </div>
                                    </div>
                                    

                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
