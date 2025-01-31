<x-layout>
    @if (isset($selectedStudents))
        {{-- @dd($selectedStudents) --}}
        <form class="max-w-md mx-auto shadow-xl p-10" action={{ route('student.update', $selectedStudents) }}
            method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4 mb-4 grid-cols-2">
                <div class="col-span-2">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Name</label>
                    <input type="text" name="name" id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                        placeholder="Type Student name" value={{ $selectedStudents->name }} required>
                </div>
                <div class="col-span-2">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                    <input type="email" name="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                        placeholder="Type Student email" value={{ $selectedStudents->email }} required>
                </div>
                <div class="col-span-2">
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900 ">Address</label>
                    <input type="text" name="address" id="address"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                        placeholder="Type Student address" value={{ $selectedStudents->address }} required>
                </div>
                <div class="col-span-2">
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 ">Phone</label>
                    <input type="tel" name="phone" id="phone"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                        placeholder="Type Student phone" pattern="[0-9]{10}" value={{ $selectedStudents->phone }}
                        required>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="file" name="student_image" id="student_image"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder="" value={{ $selectedStudents->student_image }}  />
                </div>
            </div>

            <button type="submit"
                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                Update
            </button>
            <a href="/students"
                class="text-white mt-4 inline-flex items-center bg-yellow-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">
                Back
            </a>
        </form>
    @elseif (!isset($selectedStudents))
        <h1>404 Error</h1>
        <h1>Student NOT Found</h1>
    @endif
</x-layout>
