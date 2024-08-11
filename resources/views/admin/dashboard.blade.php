<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4 text-gray-100">
        <h2 class="text-3xl font-bold mb-4 text-center text-gray-100">Selamat Datang di Dashboard</h2>
        <p class="text-gray-100 text-center mb-6">Silahkan pilih menu yang ingin Anda akses.</p>

        <div class="flex flex-wrap justify-center space-x-4 mb-10">
            <a href="{{ route('books.index') }}" class="bg-primary hover:bg-blue-400 btn text-white mb-4 border-0 m-2 px-6 py-3 rounded-lg shadow-md">Daftar Buku</a>
            <a href="{{ route('categories.index') }}" class="bg-primary hover:bg-blue-400 btn text-white mb-4 border-0 m-2 px-6 py-3 rounded-lg shadow-md">Daftar Kategori</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            @foreach ($buku as $book)
                <div class="card card-side bg-base-100 shadow-xl">
                    <figure>
                        <img src="{{ $book->cover_image ? asset('storage/covers/' . $book->cover_image) : 'https://via.placeholder.com/150' }}" alt="{{ $book->title }}" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">{{ $book->title }}</h2>
                        <p>{{ Str::limit($book->description, 100) }}</p>
                        <p><strong>Category:</strong> {{ $book->category->name }}</p>
                        <p><strong>Quantity:</strong> {{ $book->quantity }}</p>
                       
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
