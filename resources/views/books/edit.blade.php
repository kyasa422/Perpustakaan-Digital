<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Edit Buku</title>
</head>
<body>
<div class="container mx-auto">
    <h2 class="text-3xl font-bold mb-4">Edit Buku</h2>

    <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Judul Buku</label>
            <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('title', $book->title) }}" required>
            @error('title')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
            <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $book->description) }}</textarea>
            @error('description')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah Buku</label>
            <input type="number" name="quantity" id="quantity" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('quantity', $book->quantity) }}" required>
            @error('quantity')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="file_path" class="block text-sm font-medium text-gray-700">File PDF</label>
            <input type="file" name="file_path" id="file_path" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('file_path')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="cover_image" class="block text-sm font-medium text-gray-700">Cover Buku</label>
            <input type="file" name="cover_image" id="cover_image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('cover_image')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        @if($book->cover_image)
            <div class="mb-4">
                <p class="text-sm font-medium text-gray-700">Sampul Buku Saat Ini</p>
                <img src="{{ asset('storage/public/' . $book->cover_image) }}" alt="{{ $book->title }}" class="w-32 h-32 object-cover mt-2">
            </div>
        @endif

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600">Update</button>
        </div>
    </form>
</div>
</body>
</html>
