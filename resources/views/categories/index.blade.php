<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto text-gray-100 my-5">
        <h2 class="text-3xl font-bold mb-4">Daftar Kategori</h2>

        @if (session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600">Tambah Kategori</a>
        </div>

        @if($categories->isEmpty())
        <p class="text-gray-600 my-7">Belum ada kategori.</p>
        @else

        <div class="overflow-x-auto">

            <table class="table ">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">#</th>
                        <th class="py-2 px-4 border-b">Nama Kategori</th>
                        <th class="py-2 px-4 border-b">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $index => $category)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                        <td class="py-2 px-4 border-b">{{ $category->name }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('categories.edit', $category) }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600">Edit</a>

                            <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white font-bold py-2 px-4 rounded-md hover:bg-red-600" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini? jika di hapus buku yang berhubungan dengan kategori ini akan terhapus')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>





</x-app-layout>