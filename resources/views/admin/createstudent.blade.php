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
        <table class="table-auto text-center w-[1920px] text-lg xl:w-full"
            style="font-size: clamp(0.875rem, 0.75rem + 0.3125vw, 1.125rem);">
            <thead>
                <tr class="space-y-3">
                    <th>Number</th>
                    <th>Student No.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Middle Name</th>
                    <th>Sex</th>
                    <th>Year</th>
                    <th>Course</th>
                    <th>Section</th>
                    <th class="flex justify-center pb-3">Action</th>
                </tr>
            </thead>

            <tbody class="space-y-6 border text-center">

                @foreach ($students as $student)
                    <tr class="border bg-tablebg">
                        <td class="py-2">{{ ($students->currentPage() - 1) * $students->perPage() + $loop->iteration }}
                        </td>
                        <td>{{ $student->studentno }}</td>
                        <td>{{ $student->firstname }}</td>
                        <td>{{ $student->lastname }}</td>
                        <td>{{ $student->middlename }}</td>
                        <td>{{ $student->sex }}</td>
                        <td>{{ $student->year }}</td>
                        <td>{{ $student->course }}</td>
                        <td>{{ $student->section }}</td>
                        <td class="flex gap-2 justify-center align-center p-3">
                            <img class="cursor-pointer hover:bg-sky-700 max-md:w-7 max-md:h-7"
                                src="/clearance-frontend/icons/edit-icon.png" alt="">

                            <img class="cursor-pointer hover:bg-sky-700 max-md:w-7 max-md:h-7"
                                src="/clearance-frontend/icons/setting-icon.png" alt="">
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
