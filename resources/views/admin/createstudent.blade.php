@extends('layout.layout')
@section('docTitle')
    Landing Page
@endsection


@section('content')
    <div class="flex w-full p-10 flex-col gap-5 lg:flex-row">

        <h1 class="text-blacky font-semibold" style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);">Create
            Student Account</h1>

        <form action="{{ route('previewTable') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input class="border-none" style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);" type="file"
                name="file">
            <button type="submit"
                class="w-[300px] mx-10 mb-10 py-3 bg-darkblue text-white rounded-xl lg:w-[350px] lg:py-4 xl:w-[400px]"
                type="submit" style="font-size: clamp(1rem, 0.875rem + 0.3125vw, 1.25rem);">Upload</button>
        </form>

    </div>

    <div class="border w-[90%] mx-auto max-xl:h-[90%] max-xl:h-0 max-xl:mx-auto max-xl:my-0"></div>

    <div class="flex flex-col py-5 px-5 gap-4 md:px-10 xl:flex-row xl:justify-between">

        <h1 class="text-blacky font-semibold" style="font-size: clamp(1.1875rem, 0.9375rem + 0.625vw, 1.6875rem);">List
            of Students</h1>

    </div>
    <table class="table-auto text-left w-[1920px] max-lg:w-[1280px] max-sm:w-[900px] text-lg xl:w-full"
        style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem);">
        <thead >
            <tr class="space-y-3 pl-5">
                <th class="pl-12">Number</th>
                <th class="pl-5">Student No.</th>
                <th class="pl-5">First Name</th>
                <th class="pl-5">Last Name</th>
                <th class="pl-5">Middle Name</th>
                <th class="pl-5">Sex</th>
                <th class="pl-5">Year</th>
                <th class="pl-5">Course</th>
                <th class="pl-5">Section</th>
                <th class="pl-5"">Action</th>
            </tr>
        </thead>

        <tbody class="space-y-6 border text-left">

            @foreach ($students as $student)
                <tr class="border bg-tablebg">
                    <td class="py-2 text-center">{{ ($students->currentPage() - 1) * $students->perPage() + $loop->iteration }}
                    </td>
                    <td class="pl-5">{{ $student->studentno }}</td>
                    <td class="pl-5">{{ $student->firstname }}</td>
                    <td class="pl-5">{{ $student->lastname }}</td>
                    <td class="pl-5">{{ $student->middlename }}</td>
                    <td class="pl-5">{{ $student->sex }}</td>
                    <td class="pl-5">{{ $student->year }}</td>
                    <td class="pl-5">{{ $student->course }}</td>
                    <td class="pl-5">{{ $student->section }}</td>
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
                                    <button class="py-3 px-5 hover:bg-btnhoverbg">Edit Name</button>
                                    <button class="py-3 px-5 hover:bg-btnhoverbg">Edit Lastname</button>
                                </form>
                            </div>
                        </div>
                        <div class="relative">
                            <div class="bg-btnbg cursor-pointer hover:bg-btnhoverbg rounded-md"
                                onclick="dropSetting{{ $loop->index }}()">
                                <img class="max-w-[29px] max-h-[29px]" src="img/icons/setting-icon.png" alt="">

                            </div>
                            <div class="absolute bg-btnbg  rounded-md top-7 right-0 z-10 hidden"
                                id="setting-{{ $loop->index }}">
                                <form action="" method="post" class="flex flex-col">
                                    @csrf
                                    <button class="py-3 px-5 hover:bg-btnhoverbg">Approve</button>
                                    <button class="py-3 px-5 hover:bg-btnhoverbg">dispprove</button>
                                </form>
                            </div>
                        </div>
                      
                    </td>
                </tr>
            @endforeach



            <img class="cursor-pointer hover:bg-sky-700 max-md:w-7 max-md:h-7"
                src="/clearance-frontend/icons/setting-icon.png" alt="">
            </td>
            </tr>
        </tbody>
    </table>
    {{ $students->links() }}
@endsection
