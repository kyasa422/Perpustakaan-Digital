<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category; // Add this line
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
            $books = Book::all();
        } else {
            // Regular user: view only their own books
            $books = Book::where('user_id', Auth::id())->get();
        }

        $query = Book::where('user_id', Auth::id());

        // Filter berdasarkan kategori jika parameter ada
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }
    
        $books = $query->get();
        $categories = Category::all(); // Ambil semua kategori untuk dropdown
    
        return view('books.index', compact('books', 'categories'));
    }

    //===================================================================================================

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
        $data['file_path'] = $request->file('file_path')->store('books');
    }

    if ($request->hasFile('cover_image')) {
        $imageName = time().'.'.$request->cover_image->extension();  
        $request->cover_image->storeAs('public/covers', $imageName);
        $data['cover_image'] = 'covers/'.$imageName;
    }

    Book::create($data);

    return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan');
}


    public function edit(Book $book)
    {
        if (Auth::user()->role != 2 && $book->user_id != Auth::id()) {
            return redirect()->route('books.index');
        }

        $this->authorize('update', $book);
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $this->authorize('update', $book);
        if (Auth::user()->role != 2 && $book->user_id != Auth::id()) {
            return redirect()->route('books.index');
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
            $data['file_path'] = $request->file('file_path')->store('books');
        }
        if ($request->hasFile('cover_image')) {
            $imageName = time().'.'.$request->cover_image->extension();  
            $request->cover_image->storeAs('public/covers', $imageName);
            $data['cover_image'] = 'covers/'.$imageName;
        }

        $book->update($data);

        return redirect()->route('books.index');
    }

    public function destroy(Book $book)
    {

        if (Auth::user()->role != 2 && $book->user_id != Auth::id()) {
            return redirect()->route('books.index');
        }
        $this->authorize('delete', $book);
        $book->delete();

        return redirect()->route('books.index');
    }
}
