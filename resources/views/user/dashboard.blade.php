<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4 text-gray-100">
        <a href="{{ route('books.index') }}" class="bg-primary hover:bg-blue-400 btn text-white mb-10 border-0 m-10 px-6 py-3 rounded-lg shadow-md">Daftar Buku</a>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($buku as $book)
                <div class="card card-side bg-base-100 shadow-xl rounded-lg overflow-hidden">
                    <figure class="flex-shrink-0">
                        <img src="{{ $book->cover_image ? asset('storage/covers/' . $book->cover_image) : 'https://via.placeholder.com/150' }}" alt="{{ $book->title }}" class="object-cover w-40 h-full">
                    </figure>
                    <div class="card-body flex flex-col justify-between p-4">
                        <div>
                            <h2 class="card-title text-lg font-bold mb-2">{{ $book->title }}</h2>
                            <p class="text-gray-300">{{ Str::limit($book->description, 100) }}</p>
                            <p class="text-gray-300"><strong>Category:</strong> {{ $book->category->name }}</p>
                            <p class="text-gray-300"><strong>Quantity:</strong> {{ $book->quantity }}</p>
                        </div>
                        <div class="card-actions mt-4">
                            <button class="btn btn-show-pdf btn-neutral w-full text-gray-100 bg-gray-600" data-pdf-url="{{ asset('/storage/books/' . $book->file_path) }}">Show PDF</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div id="pdfModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white p-4 w-full max-w-4xl relative">
            <button id="closeModal" class="absolute top-2 right-2 text-red-500 text-2xl">&times;</button>
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
