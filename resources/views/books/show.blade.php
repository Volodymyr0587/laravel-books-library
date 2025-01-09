<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book') }} {{ $book->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @can('editBook', $book)
                    <div class="mt-4 flex justify-end">
                        <a href="{{ route('books.edit', $book) }}"
                            class="select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                            Edit
                        </a>
                    </div>
                    @endcan

                    <div class="mt-2 p-6">
                        <div class="flex flex-col sm:flex-row items-start">
                            <!-- Book Image -->
                            <div class="w-full sm:w-1/3 mb-6 sm:mb-0">
                                <img src="{{ $book->cover ? asset('storage/' . $book->cover) : asset('images/default-book-cover.png') }}"
                                    alt="Cover of {{ $book->title }}" class="rounded-md shadow-md w-full">
                            </div>

                            <!-- Book Details -->
                            <div class="sm:ml-6 w-full">
                                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $book->title }}</h1>
                                <div class="text-gray-600 mb-6">
                                    <p><strong>Author(s):</strong>
                                        @foreach($book->authors as $author)
                                        <a href="{{ route('authors.show', $author) }}"
                                            class="text-indigo-600 hover:underline">
                                            {{ $author->name }}
                                        </a>{{ !$loop->last ? ',' : '' }}
                                        @endforeach
                                    </p>
                                    <p><strong>Year of Publication:</strong> {{ $book->year_of_publication }}</p>
                                    <p><strong>Number of Pages:</strong> {{ $book->num_of_pages }}</p>
                                    <p><strong>Genre(s):</strong>
                                        @foreach($book->genres as $genre)
                                        <span class="">
                                            {{ $genre->name }}
                                        </span>{{ !$loop->last ? ',' : '' }}
                                        @endforeach
                                    </p>
                                </div>
                                <a href="{{ route('books.index') }}"
                                    class="inline-block mt-4 text-indigo-600 hover:underline">
                                    &larr; Back to Books
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Book Description -->
                @if ($book->description)
                <div class="mt-6 p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Description</h2>
                    <p class="text-gray-700 leading-relaxed overflow-hidden text-ellipsis break-words">
                        {{ $book->description }}
                    </p>
                </div>
                @else
                <div class="mt-6 p-6 text-gray-500 text-center">
                    <p>No description available for this book.</p>
                </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
