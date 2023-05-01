@extends('layout.layout')
@section('docTitle')
    Landing Page
@endsection


@section('content')
    <div class="flex justify-center max-lg:justify-start  flex-col max-lg:gap-0">
        <form method="POST" action="{{ route('admin.updateview') }}"
            class="flex flex-col justify-center items-center gap-2 mt-5 max-lg:mt-5 max-sm:w-full max-sm:px-5 px-48">
            @csrf

            <h1 class="" style="font-size: clamp(1.0625rem, 0.9471rem + 0.5128vw, 1.5625rem);">The current view is</h1>
            <select class="w-full text-center border border-gray-300 py-2 px-3 text-lg rounded-md"
                style="font-size: clamp(0.9375rem, 0.8942rem + 0.1923vw, 1.125rem);" name="id">

                @foreach ($allYears as $allYear)
                    <option class="bg-darkblue text-white" value="{{ $allYear->id }}"
                        @empty(!$currentyear)
                        @if ($allYear->id == $currentyear->school_year_id) selected @endif
                        @endempty>
                        {{ $allYear->year }}</option>
                @endforeach
            </select>


            <button type="submit"
                class=" w-full bg-darkblue hover:bg-blue-900 py-2 px-3 text-lg rounded-md text-white">Update</button>

        </form>

        <div class="flex max-xl:flex-col border-t border-gray-300 mt-16 max-sm:mt-5 max-sm:py-10 mx-20 max-xl:mx-0">

            <form class="flex flex-col max-sm:m-0  items-center mx-10 gap-5 mt-14 max-xl:mb-14 sm:gap-3"
                action="{{ route('admin.addyear') }}" method="post">
                @csrf
                <h1 class="text-blacky text-center font-semibold"
                    style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);">Add Year</h1>
                {{-- max-lg:w-6/12 max-sm:w-11/12 --}}
                <input
                    class="py-2 border-2 max-sm:w-11/12  rounded-md px-5 mt-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[350px] @error('name') border-red-500 @enderror"
                    value="{{ old('year') }}" type="text" placeholder="Year" name="year" required>

                @error('year')
                    <div class="text-red-500 max-sm:mt-[-1rem] mt-[-0.5rem] text-sm">
                        {{ $message }}
                    </div>
                @enderror

                <button
                    class="py-2 rounded-md px-5 max-sm:w-11/12 placeholder:text-sm w-[400px] lg:py-3 lg:w-[350px] bg-darkblue text-white hover:bg-sky-700">Submit</button>
            </form>

            <div class="w-full pb-28 overflow-x-auto  overflow-y-hidden my-14  h-full max-sm:px-5 max-sm:my-6">
                <h1 class="text-blacky text-left font-semibold mb-5"
                    style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);">List of Years</h1>

                <table
                    class="table-auto text-center w-[1100px] max-lg:w-[900px] max-sm:w-[640px]  text-lg xl:w-full whitespace-nowrap"
                    style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem);">
                    <thead>
                        <tr class="space-y-3">
                            <th>Number</th>
                            <th>Year</th>
                            <th>Date Modified</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody class="space-y-6 font-semibold bg-tablebg">

                        @foreach ($allYears as $allYear)
                            <tr class="border">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $allYear->year }}</td>
                                <td>{{ \Carbon\Carbon::parse($allYear->updated_at)->format('F/d/Y') }}</td>
                                <td class="py-2 flex gap-2 justify-center">

                                    <div class="bg-btnbg cursor-pointer hover:bg-btnhoverbg rounded-md"
                                        onclick="delregistrar('{{ $allYear->year }}', '{{ $allYear->id }}')">
                                        <img class="max-w-[29px] max-h-[29px]" src="img/icons/delete.png" alt="">

                                    </div>


                                </td>

                            </tr>
                        @endforeach



                    </tbody>
                </table>
            </div>
        </div>


    </div>

    {{-- //delete --}}
    <div class="absolute left-0 top-0 w-[100vw] h-[100vh] flex flex-col justify-center items-center hidden"
        id="delDiaglogBox">
        <div class="absolute z-50 bg-white py-5 px-5 rounded-lg ">

            <form action="{{ route('delete.year') }}" method="post"
                class="flex flex-col justify-center items-center gap-20 px-10 pt-5">
                @csrf

                <div class="flex flex-col items-center justify-center gap-2">
                    <h1 class="text-center text-2xl font-semibold">Are you sure you want to delete this year?</h1>
                    <h1 class="text-center text-xl max-sm:w-full w-[30rem]">Keep in mind that if you remove this year, all
                        clearances from the <span id="year" class="font-medium"></span> academic year will be deleted
                    </h1>
                </div>

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
    function delregistrar(year,f) {
    document.getElementById("delDiaglogBox").classList.toggle("hidden");

    document.getElementById("year").innerText = year;
    document.getElementById("idss").value = f;
    };

    document.querySelector("#bgBlack2").addEventListener("click", function () {

    document.getElementById("delDiaglogBox").classList.toggle("hidden");
    });
    document.querySelector("#cancelBtn2").addEventListener("click", function () {

    document.getElementById("delDiaglogBox").classList.toggle("hidden");
    });
@endsection

{{-- <form method="POST" action="{{ route('admin.updateview') }}"
    class="flex flex-col justify-center items-center gap-2 mt-[-15rem] max-lg:mt-5 max-sm:w-full max-sm:px-5">
    @csrf


    <h1 class="" style="font-size: clamp(1.0625rem, 0.9471rem + 0.5128vw, 1.5625rem);">Add Year</h1>
    <input type="text" class="w-full border border-gray-300 py-2 px-3 text-lg rounded-md" placeholder="Year"
        name="year">


    <button type="submit"
        class=" w-full bg-darkblue hover:bg-blue-900 py-2 px-3 text-lg rounded-md text-white">Add</button>

</form> --}}
