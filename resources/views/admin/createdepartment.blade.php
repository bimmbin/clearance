@extends('layout.layout')
@section('docTitle')
    Landing Page
@endsection


@section('content')
    <div class="flex w-full p-10 max-sm:p-2 max-sm:pt-8 flex-col gap-5 lg:flex-row">

        <form class="flex flex-col max-sm:m-0  items-center mx-10 gap-5 mt-14 max-xl:mb-14 sm:gap-3"
            action="{{ route('store.department') }}" method="post">
            @csrf
            <h1 class="text-blacky text-center font-semibold"
                style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);">Create
                Department</h1>
            {{-- max-lg:w-6/12 max-sm:w-11/12 --}}
            <input
                class="py-2 border-2 max-sm:w-11/12  rounded-xl px-5 mt-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[350px] @error('name') border-red-500 @enderror"
                value="{{ old('name') }}" type="text" placeholder="Department Name" name="name">

            @error('name')
                <div class="text-red-500 max-sm:mt-[-1rem] mt-[-0.5rem] text-sm">
                    {{ $message }}
                </div>
            @enderror

            <button
                class="py-2 rounded-xl px-5 max-sm:w-11/12 placeholder:text-sm w-[400px] lg:py-3 lg:w-[350px] bg-darkblue text-white hover:bg-sky-700">Submit</button>
        </form>

        <div class="border h-[90%] my-auto max-xl:w-[90%] max-xl:h-0 max-xl:mx-auto max-xl:my-0"></div>

        <div class="w-full pb-28 overflow-x-auto  overflow-y-hidden my-14 px-10 h-full max-sm:px-5 max-sm:my-6 ">
            <h1 class="text-blacky text-left font-semibold mb-5"
                style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);">List of Department Officers</h1>

            <table class="table-auto text-center w-[1920px] max-lg:w-[900px] max-sm:w-[640px]  text-lg xl:w-full whitespace-nowrap"
                style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem);">
                <thead>
                    <tr class="space-y-3">
                        <th>Number</th>
                        <th>Department Name</th>
                        <th>Assigned Officer</th>
                        <th class="flex justify-center pb-3">Action</th>
                    </tr>
                </thead>

                <tbody class="space-y-6 font-semibold bg-tablebg">

                    @foreach ($departments as $department)
                        <tr class="border">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $department->name }}</td>
                            @if (empty(optional($department)->profiles->firstname))
                                <td>None</td>
                            @else
                            <td>{{ $department->profiles->firstname . ' ' . $department->profiles->lastname }}</td>
                            @endif

                            <td class="py-2 flex gap-2">

                                <div class="relative">
                                    <div class="bg-btnbg cursor-pointer hover:bg-btnhoverbg rounded-md"
                                        onclick="dropEdit{{ $loop->index }}()">
                                        <img class="max-w-[29px] max-h-[29px]" src="img/icons/edit-icon.png" alt="">

                                    </div>
                                    <div class="absolute bg-btnbg  rounded-md top-7 right-0 z-10 hidden"
                                        id="edit-{{ $loop->index }}">
                                        <form action="" method="post" class="flex flex-col">
                                            @csrf
                                            <button class="py-3 px-5 hover:bg-btnhoverbg">Edit Info</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="relative">
                                    <div class="bg-btnbg cursor-pointer hover:bg-btnhoverbg rounded-md"
                                        onclick="dropSetting{{ $loop->index }}()">
                                        <img class="max-w-[29px] max-h-[29px]" src="img/icons/setting-icon.png"
                                            alt="">

                                    </div>
                                    <div class="absolute bg-btnbg  rounded-md top-7 right-0 z-10 hidden"
                                        id="setting-{{ $loop->index }}">
                                        <form action="" method="post" class="flex flex-col">
                                            @csrf
                                            <button class="py-3 px-5 hover:bg-btnhoverbg">Remove Officer</button>
                                           
                                        </form>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
@endsection
