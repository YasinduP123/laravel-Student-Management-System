<x-layout>
    @if (isset($selectedStudents))
        {{-- @dd($selectedStudents) --}}
        <form class="max-w-md mx-auto shadow-xl p-10" action={{ route('student.update', $selectedStudents) }}
            method="POST" enctype="multipart/form-data">
            @csrf
            {{-- @dd(  Vite::asset("public/storage/". $selectedStudents->student_image ) ) --}}
            <div class="flex items-center justify-center w-full">
                <label for="student_image" class="relative flex flex-col items-center justify-center w-40 h-40 border-2 border-gray-300 border-dashed rounded-full cursor-pointer bg-gray-50 dark:bg-gray-200 hover:bg-gray-100 dark:hover:bg-gray-100 overflow-hidden">
                    <img id="imagePreview" src="{{ Vite::asset("public/storage/". $selectedStudents->student_image ) }}" class="absolute w-full h-full object-cover rounded-full hidden" alt="Uploaded Image">
                    <div id="uploadPlaceholder" class="flex flex-col items-center justify-center">
                        <svg class="w-10 h-10 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                        </svg>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Upload Image</p>
                    </div>
                    <input id="student_image" name="student_image" type="file" accept="image/*" class="hidden" />
                </label>
            </div>

            <script>
                document.getElementById("student_image").addEventListener("change", function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const imagePreview = document.getElementById("imagePreview");
                            imagePreview.src = e.target.result;
                            imagePreview.classList.remove("hidden");
                            document.getElementById("uploadPlaceholder").classList.add("hidden");
                        };
                        reader.readAsDataURL(file);
                    }
                });
            </script>
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
                    {{-- <div class="relative z-0 w-full mb-5 group">
                        <input type="file" name="student_image" id="student_image"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder="" value={{ $selectedStudents->student_image }}  />
                    </div> --}}
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
