<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rental;
use App\Models\Student;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $books = Book::all()->count();
        $students = Student::all()->count();
        $already_returned = Rental::all()->where('status', 1)->count();
        $not_returned = Rental::all()->where('status', 0)->count();
        return view('dashboard', compact('books', 'students', 'already_returned', 'not_returned'));
    }
}
