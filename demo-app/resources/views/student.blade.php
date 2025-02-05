<x-layout>

    <div class="mb-4 border-b shadow-lg border-gray-200">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
            data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="false">View</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-blue-800" id="dashboard-tab"
                    data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard"
                    aria-selected="false">Create</button>
            </li>
        </ul>
    </div>
    <div id="default-tab-content">
        <div class="hidden p-4 rounded-lg" id="dashboard" role="tabpanel" aria-labelledby="profile-tab">
            <x-save-student></x-save-student>
        </div>
        <div class="hidden p-4 rounded-lg" id="profile" role="tabpanel" aria-labelledby="dashboard-tab">

            <div class="relative overflow-x-auto sm:rounded-lg">
                <div
                    class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 pb-4 bg-white ">
                    <a href="/students"
                        class="text-white bg-blue-600 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center me-2 ">
                        Reload
                    </a>
                </div>
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 "aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <form action="/students/find-by-email" method="post">
                        @csrf
                        <input type="text" name="search"
                            class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 "
                            placeholder="Search students by Email" required>
                    </form>
                </div>
            </div>

            <table class="w-full text-sm text-left rtl:text-right shadow-lg  text-gray-500 " >
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Address
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Phone
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @if (count($students) == 0)
                            <tr>
                                <td colspan="4" class="text-center">No data found</td>
                            </tr> --}}
                    @if (is_iterable($students))
                        @foreach ($students as $student)
                            <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 ">
                                <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap ">
                                    <img class="w-10 h-10 rounded-full" src={{ Vite::asset("public/storage/". $student->student_image ) }}
                                        alt="Jese image">
                                    <div class="ps-3">
                                        <div class="text-base font-semibold">{{ $student->name }} </div>
                                    </div>
                                </th>
                                <td class="px-6 py-4">
                                    {{ $student->email }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        {{ $student->address }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        {{ $student->phone }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <a href={{ route('student.delete', $student->id) }}
                                        class="text-white bg-red-600 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center me-2 ">
                                        Delete
                                    </a>
                                    <a href="/students/edit/{{ $student->id }}" data-modal-target="crud-modal"
                                        data-modal-toggle="crud-modal"
                                        class="text-white bg-blue-600 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center me-2 ">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 ">
                            <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap ">
                                <img class="w-10 h-10 rounded-full" src={{ Vite::asset("public/storage/". $student->student_image ) }}>
                                <div class="ps-3">
                                    <div class="text-base font-semibold">{{ $students->name }} </div>
                                </div>
                            </th>
                            <td class="px-6 py-4">
                                {{ $students->email }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    {{ $students->address }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    {{ $students->phone }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <a href={{ route('student.delete', $students->id) }}
                                    class="text-white bg-red-600 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center me-2 ">
                                    Delete
                                </a>
                                <a href="/students/edit/{{ $students->id }}" data-modal-target="crud-modal"
                                    data-modal-toggle="crud-modal"
                                    class="text-white bg-blue-600 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center me-2 ">
                                    Edit
                                </a>
                            </td>
                        </tr>

                    @endif
                </tbody>
            </table>

            {{-- <div id="crud-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow-sm">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    Edit Student Details
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                    data-modal-toggle="crud-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div> --}}
            <!-- Main modal -->
        </div>

    </div>
    </div>


</x-layout>
