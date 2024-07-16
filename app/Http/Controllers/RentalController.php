<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRentalRequest;
use App\Http\Requests\UpdateRentalRequest;
use App\Models\Book;
use App\Models\Rental;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $rentals = Rental::latest()->paginate(10);
        $books = Book::all();
        $students = Student::all();
        return view('pages.rentals.index', compact('rentals', 'books', 'students'));
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
    public function store(StoreRentalRequest $request)
    {
        //
        $data = $request->validated();
        $book = DB::table('books')->where('id', $data['book_id'])->first();
        $current_amount = $book->current_amount - 1;
        DB::table('books')->where('id', $data['book_id'])->update(['current_amount' => $current_amount]);
        Rental::create($request->validated());
        return redirect()->route('rentals.index')
            ->with('success', 'Data created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rental $rental)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rental $rental)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRentalRequest $request, Rental $rental)
    {
        //
        $data = $request->validated();
        if ($data['status'] == 1) {
            $book = DB::table('books')->where('id', $rental->book_id)->first();
            $current_amount = $book->current_amount + 1;
            DB::table('books')->where('id', $rental->book_id)->update(['current_amount' => $current_amount]);

            $start_date_string = $rental->rental_length;
            $start_date = Carbon::parse($start_date_string);
            $end_date = Carbon::now();
            $range  = date_diff( $start_date, $end_date );

            if ($start_date < $end_date) {
                $data['penalty'] = 500 * $range->days;
            }
        }

        $rental->update($data);
        return redirect()->route('rentals.index')
            ->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental)
    {
        //
        $book = DB::table('books')->where('id', $rental->book_id)->first();
        $current_amount = $book->current_amount + 1;
        DB::table('books')->where('id', $rental->book_id)->update(['current_amount' => $current_amount]);
        $rental->delete();
        return redirect()->route('rentals.index')
            ->with('success', 'Data deleted successfully');
    }
}
