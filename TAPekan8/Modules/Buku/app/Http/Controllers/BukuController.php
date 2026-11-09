<?php

namespace Modules\Buku\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Modules\Buku\Http\Requests\BookRequest;
use Modules\Buku\Models\Book;

class BukuController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $books = Book::query()
            ->when($search !== '', fn ($query) => $query->where(function ($query) use ($search) {
                $query->where('judul', 'like', "%{$search}%")
                    ->orWhere('penulis', 'like', "%{$search}%")
                    ->orWhere('penerbit', 'like', "%{$search}%");
            }))
            ->orderBy('judul')
            ->paginate(10)
            ->withQueryString();

        return view('buku::index', compact('books', 'search'));
    }

    public function create(): View
    {
        return view('buku::form', ['book' => new Book(), 'action' => route('buku.store'), 'method' => 'POST']);
    }

    public function store(BookRequest $request): RedirectResponse
    {
        Book::create($request->validated());

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book): View
    {
        return view('buku::form', ['book' => $book, 'action' => route('buku.update', $book), 'method' => 'PUT']);
    }

    public function update(BookRequest $request, Book $book): RedirectResponse
    {
        $book->update($request->validated());

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}
