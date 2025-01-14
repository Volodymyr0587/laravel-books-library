<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mt-2">
                        <a href="{{ route('books.create') }}"
                        class="select-none items-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        >
                        Add Book to Library
                        </a>
                    </div>
                    <form action="{{ route('books.index') }}" class="mt-6">
                        @csrf
                    <div class="relative h-10 w-full min-w-[200px]">
                        <button type="submit"
                            class="absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                </path>
                            </svg>
                        </button>
                        <input name="search" value="{{ request('search') }}"
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />

                        <label
                            class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                            Search by author, title, description
                        </label>
                    </form>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                    @forelse ($books as $book)
                        <div class="flex flex-col bg-white border border-gray-200 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <!-- Book Cover -->
                            <img class="object-cover w-full h-64 rounded-t-lg md:h-48"
                                 src="{{ $book->cover ? asset('storage/' . $book->cover) : asset('images/default-book-cover.jpg') }}"
                                 alt="Cover of {{ $book->title }}">

                            <!-- Book Details -->
                            <div class="flex flex-col justify-between p-4">
                                <h5 class="text-lg font-semibold text-gray-900 leading-tight truncate">
                                    <a href="{{ route('books.show', $book) }}"
                                       class="text-blue-600 hover:text-blue-800 hover:underline">
                                        {{ $book->title }}
                                    </a>
                                </h5>
                                <p class="mt-2 text-xs text-gray-900 font-bold">Author(s):</p>
                                <div class="mt-2  text-gray-700 flex flex-wrap gap-2">
                                    @forelse ($book->authors as $author)
                                        <a href="{{ route('books.index', ['author_id' => $author->id]) }}"
                                           class="text-yellow-600 hover:text-yellow-800 hover:underline text-sm font-medium me-2 px-2.5 py-0.5 rounded">
                                            {{ $author->name }}
                                        </a>
                                    @empty
                                        <span class="text-gray-500 italic">No authors</span>
                                    @endforelse
                                </div>
                                <p class="mt-2 text-xs text-gray-900 font-bold">Genre(s):</p>
                                <div class="mt-2 flex flex-wrap gap-2">
                                    @forelse ($book->genres as $genre)
                                        <a href="{{ route('books.index', ['genre_id' => $genre->id]) }}"
                                           class="{{ App\Helpers\GenreHelper::badgeColor($genre->name) }} text-xs font-medium me-2 px-2.5 py-0.5 rounded">
                                            {{ $genre->name }}
                                        </a>
                                    @empty
                                        <span class="text-gray-500 italic">No genres</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-gray-500">
                            No books available yet.
                        </div>
                    @endforelse
                </div>

                <div class="my-4 px-2">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
