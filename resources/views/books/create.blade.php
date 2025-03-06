<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add the Book to Your Library') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-12">

                            <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-base font-semibold leading-7 text-gray-900">Book Information</h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">Add the book to your library.</p>

                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                                    <div class="col-span-full">
                                        <label for="authors"
                                            class="block text-sm font-medium leading-6 text-gray-900">Authors</label>
                                        <div class="mt-2">
                                            <select id="authors" name="authors[]" multiple autocomplete="authors"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                @foreach ($authors as $author)
                                                    <option value="{{ $author->id }}" {{ in_array($author->id, old('authors', [])) ? 'selected' : '' }}>
                                                        {{ $author->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('authors')
                                            <span class="text-sm font-bold text-red-500 mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-span-full">
                                        <label for="title"
                                            class="block text-sm font-medium leading-6 text-gray-900">Title
                                        </label>
                                        <div class="mt-2">
                                            <input type="text" name="title" id="title" value="{{ old('title') }}"
                                                autocomplete="title" placeholder="The Lord of the Rings"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                        @error('title')
                                            <span class="text-sm font-bold text-red-500 mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-span-full">
                                        <label for="year_of_publication"
                                            class="block text-sm font-medium leading-6 text-gray-900">Year of Publishing</label>
                                        <div class="mt-2">
                                            <input type="text" name="year_of_publication" id="year_of_publication" value="{{ old('year_of_publication') }}"
                                                autocomplete="year_of_publication"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                        @error('year_of_publication')
                                            <span class="text-sm font-bold text-red-500 mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-span-full">
                                        <label for="num_of_pages"
                                            class="block text-sm font-medium leading-6 text-gray-900">Number of pages (optional)</label>
                                        <div class="mt-2">
                                            <input type="number" name="num_of_pages" id="num_of_pages" value="{{ old('num_of_pages') }}"
                                                autocomplete="num_of_pages"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                        @error('num_of_pages')
                                            <span class="text-sm font-bold text-red-500 mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-span-full">
                                        <label for="genres"
                                            class="block w-full text-sm font-medium leading-6 text-gray-900">Genres</label>
                                        <div class="grid grid-cols-4 gap-2 mt-2">
                                            @foreach ($genres as $genre)
                                                <label class="flex items-center space-x-2">
                                                    <input type="checkbox" name="genres[]" value="{{ $genre->id }}" class="rounded-md text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 sm:text-sm sm:leading-6"
                                                           {{ in_array($genre->id, old('genres', [])) ? 'checked' : '' }}>
                                                    <span class="text-sm">{{ $genre->name }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                        @error('genres')
                                            <span class="text-sm font-bold text-red-500 mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-span-full">
                                        <label for="description"
                                            class="block text-sm font-medium leading-6 text-gray-900">Description (optional)</label>
                                        <div class="mt-2">
                                            <textarea id="description" name="description" rows="3" placeholder="Write a description"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ old('description') }}</textarea>
                                        </div>
                                        @error('description')
                                            <span class="text-sm font-bold text-red-500 mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>



                                </div>
                            </div>

                            <div class="border-b border-gray-900/10 pb-12">

                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                                    <div class="col-span-full">
                                        <label for="cover"
                                            class="block text-sm font-medium leading-6 text-gray-900">Cover</label>
                                        <div class="mt-2 flex items-center gap-x-3">
                                            <input type="file" name="cover" id="cover"
                                                class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" />
                                        </div>
                                        @error('cover')
                                            <span class="text-sm font-bold text-red-500 mt-2">{{ $message }}</span>
                                        @enderror

                                        <!-- Preview Image Container -->
                                        <div id="cover-image-preview" class="mt-2 flex items-center gap-x-3">
                                            <img id="preview-image" src="" alt="Cover Image Preview" class="hidden w-32 h-32 object-cover rounded-md">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <a href="{{ route('books.index') }}"
                                class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                type="button">
                                Cancel
                            </a>
                            <button type="submit"
                                class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                >
                                Save book
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <script>


        document.getElementById('cover').addEventListener('change', function(event) {
            const file = event.target.files[0]; // Access the file correctly
            const previewImage = document.getElementById('preview-image');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden'); // Show the image preview
                };
                reader.readAsDataURL(file); // Read file as data URL
            } else {
                previewImage.src = '';
                previewImage.classList.add('hidden'); // Hide the image preview if no file is selected
            }
        });

    </script>

</x-app-layout>
