@extends('layout.layout')
@section('docTitle')
    Create Officer
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

            <select class="py-2 border-2 rounded-xl max-sm:w-11/12 px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[350px]"
                name="sex">

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


            <table
                class="whitespace-nowrap table-auto text-center w-[1920px] max-lg:w-[1280px] max-sm:w-[900px] text-lg xl:w-full "
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
                            <tr class="font-medium border">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $officer->firstname . ' ' . $officer->lastname }}</td>
                                <td>{{ $officer->employeeno }}</td>
                                <td>{{ $officer->department->name }}</td>
                                <td class="py-2 flex gap-2">


                                    <div class="bg-btnbg cursor-pointer hover:bg-btnhoverbg rounded-md"
                                        onclick="editOfficer(

                                    '{{ $officer->employeeno }}',
                                    '{{ $officer->lastname }}',
                                    '{{ $officer->firstname }}',
                                    '{{ $officer->middlename }}',
                                    '{{ $officer->id }}',

                                    )">
                                        <img class="max-w-[29px] max-h-[29px]" src="img/icons/edit-icon.png" alt="">

                                    </div>

                                    <div class="bg-btnbg cursor-pointer hover:bg-btnhoverbg rounded-md"
                                        onclick="delOfficer({{ $officer->id }})">
                                        <img class="max-w-[29px] max-h-[29px]" src="img/icons/delete.png" alt="">

                                    </div>


                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <div class="absolute left-0 top-0 w-[100vw] h-[100vh] flex flex-col justify-center items-center hidden"
                id="editDiaglogBox">
                <div class="absolute z-50 bg-white py-5 px-5 rounded-lg ">

                    <form action="{{ route('edit.officer') }}" method="post" class="flex justify-center items-center">
                        @csrf

                        <div class="flex max-sm:flex-col items-center">
                            <div
                                class="flex w-[45rem] max-sm:w-full  flex-wrap gap-2 justify-center items-center max-sm:flex-col">


                                <div class="flex flex-col max-sm:w-full">
                                    <label for="a" class="font-semibold text-sm">Employee No.</label>
                                    <input type="number"
                                        class="w-[150px] max-sm:w-full border border-gray-300 py-2 px-3 text-lg rounded-md"
                                        id="a" placeholder="Employee No." name="employeeno">
                                </div>

                                <div class="flex flex-col">
                                    <label for="b" class="font-semibold text-sm">Lastname</label>
                                    <input type="text"
                                        class="w-[150px] max-sm:w-full border border-gray-300 py-2 px-3 text-lg rounded-md"
                                        id="b" placeholder="Lastname" name="lastname" pattern="[A-Za-z -]+"
                                        required>
                                </div>

                                <div class="flex flex-col">
                                    <label for="c" class="font-semibold text-sm">First Name</label>
                                    <input type="text"
                                        class="w-[150px] max-sm:w-full border border-gray-300 py-2 px-3 text-lg rounded-md"
                                        id="c" placeholder="First Name" name="firstname" pattern="[A-Za-z -]+"
                                        required>
                                </div>

                                <div class="flex flex-col">
                                    <label for="d" class="font-semibold text-sm">Middle Initial</label>
                                    <input type="text"
                                        class="w-[150px] max-sm:w-full border border-gray-300 py-2 px-3 text-lg rounded-md"
                                        id="d" placeholder="Middle Initial" name="middlename" maxlength="1"
                                        pattern="[A-Za-z -]+" required>
                                </div>

                                <input type="hidden" id="f" name="id">
                            </div>

                            <div class="flex flex-col gap-2  max-sm:w-full  max-sm:mt-2">
                                <span type="submit" id="cancelBtn"
                                    class=" w-[100px] max-sm:w-full bg-gray-400 hover:bg-gray-500 py-2 px-3 text-lg rounded-md text-white text-center cursor-pointer flex-1 flex items-center justify-center">Cancel</span>
                                <button type="submit"
                                    class=" w-[100px] max-sm:w-full bg-darkblue hover:bg-blue-400 py-2 px-3 text-lg rounded-md text-white flex-1">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="absolute bg-black opacity-60 w-[100vw] h-[100vh] z-20" id="bgBlack"></div>

            </div>



        </div>
    </div>


    <div class="absolute left-0 top-0 w-[100vw] h-[100vh] flex flex-col justify-center items-center hidden" id="delDiaglogBox">
        <div class="absolute z-50 bg-white py-5 px-5 rounded-lg ">
            
            <form action="{{ route('delete.officer') }}" method="post" class="flex flex-col justify-center items-center gap-20 px-10 pt-5">
                @csrf

                <h1 class="text-center text-xl font-medium">Are you sure you want to delete this officer?</h1>
                <input type="hidden" id="idss" name="id">

                <div class="flex gap-2  max-sm:w-full  max-sm:mt-2">
                    <span type="submit" id="cancelBtn2"
                        class=" w-[100px] max-sm:w-full bg-gray-400 hover:bg-gray-500 py-2 px-3 text-lg rounded-md text-white text-center cursor-pointer flex-1 flex items-center justify-center">Cancel</span>
                    <button type="submit"
                        class=" w-[100px] max-sm:w-full bg-red-500 hover:bg-red-700 py-2 px-3 text-lg rounded-md text-white flex-1">Delete</button>
                </div>
            </form>
        </div>
        <div class="absolute bg-black opacity-60 w-[100vw] h-[100vh] z-20" id="bgBlack2"></div>

    </div>
@endsection


@section('script')
    function editOfficer(a,b,c,d,f) {
    document.getElementById("editDiaglogBox").classList.toggle("hidden");


    document.getElementById("a").value = a;
    document.getElementById("b").value = b;
    document.getElementById("c").value = c;
    document.getElementById("d").value = d;
    document.getElementById("f").value = f;
    };

    document.querySelector("#bgBlack").addEventListener("click", function () {

    document.getElementById("editDiaglogBox").classList.toggle("hidden");
    });
    document.querySelector("#cancelBtn").addEventListener("click", function () {

    document.getElementById("editDiaglogBox").classList.toggle("hidden");
    });


    function delOfficer(f) {
    document.getElementById("delDiaglogBox").classList.toggle("hidden");

    document.getElementById("idss").value = f;
    };

    document.querySelector("#bgBlack2").addEventListener("click", function () {

    document.getElementById("delDiaglogBox").classList.toggle("hidden");
    });
    document.querySelector("#cancelBtn2").addEventListener("click", function () {

    document.getElementById("delDiaglogBox").classList.toggle("hidden");
    });
@endsection
