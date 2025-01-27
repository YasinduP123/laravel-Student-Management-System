<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    protected $student;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function store(Request $request)
    {
        dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:10',
            'address' => 'required|string|max:255',
        ]);

        $this->student->create($validatedData);

        return redirect()->back()->with('success', 'Student added successfully!');
    }
}
