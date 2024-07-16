<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Rental;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $students = Student::latest()->paginate(10);
        return view('pages.students.index', compact('students'));
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
    public function store(StoreStudentRequest $request)
    {
        //
        Student::create($request->validated());
        return redirect()->route('students.index')
            ->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        //
        $student->update($request->validated());
        return redirect()->route('students.index')
            ->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
        $hasRental = Rental::where('student_id', $student->id)->exists();

        if ($hasRental) {
            return redirect()->route('students.index')
                ->with('error', 'Data tidak bisa dihapus.');
        }

        $student->delete();
        return redirect()->route('students.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
