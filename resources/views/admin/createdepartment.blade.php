@extends('layout.layout')
@section('docTitle')
    Landing Page
@endsection


@section('content')

<div class="flex w-full p-10 flex-col gap-5 lg:flex-row">

    <form class="flex flex-col items-center mx-10 gap-5 mt-14 max-xl:mb-14 sm:gap-3" action="{{ route('store.department') }}"
        method="post">
        @csrf
        <h1 class="text-blacky text-center font-semibold"
            style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);">Create
            Department</h1>

        <input class="py-2 border-2 rounded-xl px-5 mt-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[450px]" type="text"
            placeholder="Department Name" name="name">

        <button
            class="py-2 rounded-xl px-5 placeholder:text-sm w-[400px] lg:py-3 lg:w-[450px] bg-darkblue text-white hover:bg-sky-700">Submit</button>
    </form>

    <div class="border h-[90%] my-auto max-xl:w-[90%] max-xl:h-0 max-xl:mx-auto max-xl:my-0"></div>

    <div class="w-full pb-10 overflow-x-auto my-14 px-10">
        <h1 class="text-blacky text-left font-semibold mb-5"
            style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);">List of Department Officers</h1>

        <table class="table-auto text-center w-[1920px] text-lg xl:w-full "
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
                    <td>{{ $department->profiles->firstname }}</td>
                    <td class="flex gap-2 justify-center align-center p-3">
                        <img class="cursor-pointer hover:bg-sky-700" src="asset/edit-icon.png" alt="">

                        <img class="cursor-pointer hover:bg-sky-700" src="asset/setting-icon.png" alt="">
                    </td>
                </tr>
            @endforeach


            </tbody>
        </table>
    </div>
</div>
@endsection
