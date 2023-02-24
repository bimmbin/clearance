@extends('layout.layout')
@section('docTitle')
    Landing Page
@endsection


@section('content')
    <form action="{{ route('previewTable') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <button type="submit">Upload</button>

        <table class="table-auto text-center w-full max-w-[1480px] text-lg max-lg:text-md max-md:text-sm">
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
                    <tr class="border-2 bg-gray-100">
                        <td class="py-2">{{ ($students->currentPage() - 1) * $students->perPage() + $loop->iteration }}</td>
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
    </form>
@endsection
