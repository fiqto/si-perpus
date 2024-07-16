<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Rental;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $books = Book::latest()->paginate(10);
        return view('pages.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        //
        $data = $request->validated();
        $data['current_amount'] = $data['amount'];
        Book::create($data);
        return redirect()->route('books.index')
            ->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        //
        $data = $request->validated();
        if( $book->amount <= $data['amount']){
            $add = $data['amount'] - $book->amount;
            $data['current_amount'] = $book->current_amount + $add;
        } else {
            $add = $book->amount - $data['amount'];
            $data['current_amount'] = $book->current_amount - $add;
        }
        $book->update($data);
        return redirect()->route('books.index')
            ->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
        $hasRental = Rental::where('book_id', $book->id)->exists();

        if ($hasRental) {
            return redirect()->route('books.index')
                ->with('error', 'Data tidak bisa dihapus.');
        }

        $book->delete();
        return redirect()->route('books.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
