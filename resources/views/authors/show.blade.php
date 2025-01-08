<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Author:') }} {{ $author->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @can('editAuthor', $author)
                    <div class="mt-4 flex justify-between">
                        <a href="{{ route('authors.index') }}" class="inline-block text-indigo-600 hover:underline">
                            &larr; Back to Authors
                        </a>
                        <a href="{{ route('authors.edit', $author) }}"
                        class="select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        >
                        Edit
                        </a>
                    </div>
                    @endcan

                    <div class="mt-2 p-6">
                        <div class="flex flex-col sm:flex-row items-start">
                            <!-- Author Image -->
                            <div class="w-full sm:w-1/3 mb-6 sm:mb-0">
                                <img src="{{ $author->author_photo ? asset('storage/' . $author->author_photo) : asset('images/default-author-photo.jpg') }}" class="rounded-md shadow-md w-full">
                            </div>

                            <!-- Author Details -->
                            <div class="sm:ml-6 w-full">
                                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $author->name }}</h1>
                                <div class="text-gray-600 mb-6">
                                    <p><strong>Books by {{ $author->name }}:</strong></p>
                                    <ul class="list-disc pl-6 mt-2">
                                        @forelse($author->books as $book)
                                            <li>
                                                <a href="{{ route('books.show', $book) }}" class="text-indigo-600 hover:underline">
                                                    {{ $book->title }}
                                                </a>
                                                ({{ $book->year_of_publication }})
                                            </li>
                                        @empty
                                            <li class="text-gray-500">No books found.</li>
                                        @endforelse
                                    </ul>
                                </div>
                                <div class="mb-6">
                                    <h4 class="font-semibold text-lg">About author</h4>
                                    {{ $author->bio }}
                                </div>
                            </div>
                        </div>
                    </div>




                </div>




            </div>
        </div>
    </div>
</x-app-layout>
