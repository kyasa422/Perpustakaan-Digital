<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4 my-10 text-gray-100 ">
        <div class="flex justify-between">
            <h2 class="text-3xl font-bold mb-4">Daftar Buku Anda</h2>

            <div class="mb-4 flex items-center">
                <form action="{{ route('books.index') }}" method="GET" class="flex items-center space-x-4 w-full">
                    <div class="flex items-center space-x-2">
                        <select name="category_id" id="category_id" class="border-gray-300 rounded-md shadow-sm w-full sm:w-auto text-gray-950">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                <p class="text-gray-950">{{ $category->name }}</p>
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

            
        </div>
        @if($books->isEmpty())
            <p class="text-gray-300 my-10">Anda belum menambahkan buku apapun.</p>
            <a href="{{ route('books.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md my-10 hover:bg-blue-600">Tambah Buku</a>
            @else

        <div class="mb-4">
            <a href="{{ route('books.create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600">Tambah Buku</a>
        </div>

        <div class="overflow-x-auto">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th>
                            No
                        </th>
                        <th>Judul</th>
                        <th>Jumlah</th>
                        <th>Kategori</th>
                        <th>Pdf Buku</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @foreach($books as $index => $book)
                <tbody>
                    <tr>
                        <th>
                            {{ $index + 1 }}
                        </th>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="mask mask-squircle h-12 w-12">
                                        <img src="{{ asset('/storage/covers/' . $book->cover_image) }}" alt="{{ $book->title }}">
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold">{{ $book->title }}</div>
                                    <div class="text-sm opacity-50">{{$book->description}}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            {{ $book->quantity }}
                        <td>
                            {{ $book->category->name }}

                        </td>
                        <td>
                            <a href="{{ asset('/storage/books/' . $book->file_path) }}" download="{{$book->file_path}}">
                                <button class="btn btn-success"> unduh</button>
                            </a>
                            <button class="btn btn-show-pdf btn-neutral" data-pdf-url="{{ asset('/storage/books/' . $book->file_path) }}">Show PDF</button>
                        </td>
                        <td>
                            <a href="{{ route('books.edit', $book->id) }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600">Edit</a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white font-bold py-2 px-4 rounded-md hover:bg-red-600">Hapus</button>
                            </form>
                        </td>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>







        <div id="pdfModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
            <div class="bg-white p-4 w-full max-w-4xl">
                <button id="closeModal" class="text-red-500 float-right text-xl">&times;</button>
                <iframe id="pdfViewer" class="w-full h-96" src="" frameborder="0"></iframe>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const showPdfButtons = document.querySelectorAll('.btn-show-pdf');
                const pdfModal = document.getElementById('pdfModal');
                const pdfViewer = document.getElementById('pdfViewer');
                const closeModal = document.getElementById('closeModal');

                showPdfButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const pdfUrl = this.getAttribute('data-pdf-url');
                        pdfViewer.src = pdfUrl;
                        pdfModal.classList.remove('hidden');
                    });
                });

                closeModal.addEventListener('click', function() {
                    pdfModal.classList.add('hidden');
                    pdfViewer.src = '';
                });

                pdfModal.addEventListener('click', function(e) {
                    if (e.target === pdfModal) {
                        pdfModal.classList.add('hidden');
                        pdfViewer.src = '';
                    }
                });
            });
        </script>
</x-app-layout>