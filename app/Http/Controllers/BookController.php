<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        if (Auth::user()->role == 2) {
            // Admin: view all books
            $query = Book::query();
        } else {
            // Regular user: view only their own books
            $query = Book::where('user_id', Auth::id());
        }

        // Filter berdasarkan kategori jika parameter ada
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        $books = $query->get();
        $categories = Category::all(); // Ambil semua kategori untuk dropdown

        return view('books.index', compact('books', 'categories'));
    }


    public function show()
    {
        $buku = Book::all();
        return view('admin.dashboard', compact('buku'));
    }

    public function showUser()
    {
        $buku = Book::where('user_id', Auth::id())->get();
        return view('user.dashboard', compact('buku'));
    }




    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
            'file_path' => 'nullable|file|mimes:pdf',
            'cover_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);

        $data['user_id'] = Auth::id();

        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->storeAs('books', $request->file('file_path')->getClientOriginalName());
            $data['file_path'] = basename($filePath);
        }

        if ($request->hasFile('cover_image')) {
            $imageName = time() . '.' . $request->cover_image->extension();
            $request->cover_image->storeAs('covers', $imageName);
            $data['cover_image'] = $imageName;
        }

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit(Book $book)
    {
        // Periksa apakah pengguna saat ini adalah admin atau pemilik buku
        if (Auth::user()->role != 2 && $book->user_id != Auth::id()) {
            return redirect()->route('books.index')->with('error', 'Anda tidak memiliki akses untuk mengedit buku ini.');
        }

        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        // Periksa apakah pengguna saat ini adalah admin atau pemilik buku
        if (Auth::user()->role != 2 && $book->user_id != Auth::id()) {
            return redirect()->route('books.index')->with('error', 'Anda tidak memiliki akses untuk mengubah buku ini.');
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
            'file_path' => 'nullable|file|mimes:pdf',
            'cover_image' => 'nullable|image|mimes:jpeg,jpg,png',
        ]);

        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->storeAs('public/books', $request->file('file_path')->getClientOriginalName());
            $data['file_path'] = basename($filePath);
        }

        if ($request->hasFile('cover_image')) {
            $imageName = time() . '.' . $request->cover_image->extension();
            $request->cover_image->storeAs('covers', $imageName);
            $data['cover_image'] = $imageName;
        }

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy(Book $book)
    {
        // Periksa apakah pengguna saat ini adalah admin atau pemilik buku
        if (Auth::user()->role != 2 && $book->user_id != Auth::id()) {
            return redirect()->route('books.index')->with('error', 'Anda tidak memiliki akses untuk menghapus buku ini.');
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus');
    }
}
