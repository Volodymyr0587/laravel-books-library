<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book\'s Covers ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                    @forelse ($books as $book)
                        <div class="flex flex-col bg-white border border-gray-200 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <!-- Book Cover -->
                            <img class="object-cover w-full h-64 rounded-t-lg md:h-48"
                                 src="{{ $book->cover ? asset('storage/' . $book->cover) : asset('images/default-book-cover.jpg') }}"
                                 alt="Cover of {{ $book->title }}">
                            <span class=" p-2 text-xs font-bold italic">{{ $book->title }}</span>
                            <a href="{{ asset('storage/' . $book->cover) }}" download="{{ now()->format('Y-m-d-H-i-s') . '-' . Str::slug($book->title) }}"
                                class="flex select-none items-center justify-center gap-3 rounded-lg bg-gray-900 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                            Download
                            </a>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-gray-500">
                            No covers available yet.
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
