<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit the Author Information') }} - {{ $author->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('authors.update', $author) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-12">

                            <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-base font-semibold leading-7 text-gray-900">Author Information</h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">Edit the author</p>

                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                                    <div class="col-span-full">
                                        <label for="name"
                                            class="block text-sm font-medium leading-6 text-gray-900">Name
                                        </label>
                                        <div class="mt-2">
                                            <input type="text" name="name" id="name" value="{{ old('name', $author->name) }}"
                                                autocomplete="name" placeholder="John Ronald Reuel Tolkien"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                        </div>
                                        @error('name')
                                            <span class="text-sm font-bold text-red-500 mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-span-full">
                                        <label for="bio"
                                            class="block text-sm font-medium leading-6 text-gray-900">Bio (optional)</label>
                                        <div class="mt-2">
                                            <textarea id="bio" name="bio" rows="3" placeholder="Write a bio"
                                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ old('bio', $author->bio) }}</textarea>
                                        </div>
                                        @error('bio')
                                            <span class="text-sm font-bold text-red-500 mt-2">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="border-b border-gray-900/10 pb-12">

                                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                                        <div class="col-span-full">
                                            <label for="author_photo"
                                                class="block text-sm font-medium leading-6 text-gray-900">Author photo (optional)</label>
                                            <div class="mt-2 flex items-center gap-x-3">
                                                <input type="file" name="author_photo" id="author_photo"
                                                    class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" />
                                            </div>
                                            @error('author_photo')
                                                <span class="text-sm font-bold text-red-500 mt-2">{{ $message }}</span>
                                            @enderror

                                            <!-- Preview Image Container -->
                                            <div id="photo-image-preview" class="mt-2 flex items-center gap-x-3">
                                                @if ($author->author_photo)
                                                    <img src="{{ asset('storage/' . $author->author_photo) }}" class="w-32 h-32 object-cover rounded-md" alt="">
                                                @endif
                                                <img id="preview-image" src="" alt="Photo Image Preview" class="hidden w-32 h-32 object-photo rounded-md">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 flex items-center justify-end gap-x-6">
                                <a href="{{ route('authors.index') }}"
                                    class="select-none rounded-lg border border-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button">
                                    Cancel
                                </a>
                                <button type="submit"
                                    class="flex select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    >
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="-mt-8">
                        <form action="{{ route('authors.destroy', $author) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?');"
                                class="flex select-none items-center gap-3 rounded-lg bg-red-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-red-900/10 transition-all hover:shadow-lg hover:shadow-red-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                >
                                Delete
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>


        document.getElementById('author_photo').addEventListener('change', function(event) {
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
