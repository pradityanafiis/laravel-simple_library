<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Repositories\BookRepository;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    private $bookRepository;

    public function __construct()
    {
        $this->bookRepository = new BookRepository();
    }

    public function index()
    {
        $data = $this->bookRepository->getAll();
        return view('book.index', ['data' => $data]);
    }

    public function create()
    {
        return view('book.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'unique:books'],
            'author' => ['required', 'string'],
            'publisher' => ['required', 'string'],
        ]);

        $data = $request->only(['title', 'author', 'publisher']);

        if ($this->bookRepository->create($data)) {
            return redirect()->back()->with('success_message', 'Book created!');
        } else {
            return redirect()->back()->with('error_message', 'Unable to create book!');
        }
    }

    public function show(Book $book)
    {
        //
    }

    public function edit(Book $book)
    {
        return view('book.edit', ['book' => $book]);
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => ['required', 'string', Rule::unique('books', 'title')->ignore($book->id)],
            'author' => ['required', 'string'],
            'publisher' => ['required', 'string'],
        ]);

        $data = $request->only(['title', 'author', 'publisher']);

        if ($this->bookRepository->update($data, $book->id)) {
            return redirect()->route('book.index')->with('success_message', 'Book updated!');
        } else {
            return redirect()->back()->with('error_message', 'Unable to update book!');
        }
    }

    public function destroy(Book $book)
    {
        if ($this->bookRepository->delete($book->id)) {
            return redirect()->back()->with('success_message', 'Book deleted!');
        } else {
            return redirect()->back()->with('error_message', 'Unable to delete book!');
        }
    }
}
