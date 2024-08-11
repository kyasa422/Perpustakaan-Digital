<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold mb-4">Daftar Buku Anda</h2>



        <div class="mb-4 flex items-center">
            <form action="{{ route('books.index') }}" method="GET" class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <label for="category_id" class="text-sm font-medium text-gray-700">Kategori:</label>
                    <select name="category_id" id="category_id" class="border-gray-300 rounded-md shadow-sm">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600">Filter</button>
            </form>
        </div>

        @if (session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
        @endif

        @if($books->isEmpty())
        <p class="text-gray-600">Anda belum menambahkan buku apapun.</p>
        <a href="{{ route('books.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600">Tambah Buku</a>
        @else
        <div class="mb-4">
            <a href="{{ route('books.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600">Tambah Buku</a>
        </div>

        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">#</th>
                    <th class="py-2 px-4 border-b">Judul</th>
                    <th class="py-2 px-4 border-b">sampul buku</th>
                    <th class="py-2 px-4 border-b">Kategori</th>
                    <th class="py-2 px-4 border-b">Jumlah</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $index => $book)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                    <td class="py-2 px-4 border-b">{{ $book->title }}</td>
                    <td class="py-2 px-4 border-b">
                        <img src="{{ asset('storage/public/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-20 h-20 object-cover">
                    <td class="py-2 px-4 border-b">{{ $book->category->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $book->quantity }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('books.edit', $book) }}" class="text-blue-500 hover:underline">Edit</a>

                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</x-app-layout>