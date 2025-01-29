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
        $this->student->create($request->all());

        return redirect()->back()->with('success', 'Student added successfully!');
    }

    public function delete($id)
    {

        $student = $this->student->find($id);
        $student->delete();

        return redirect()->back()->with('success', 'Student deleted successfully!');
    }

    public function update(Request $request, $id)
    {
        $student = $this->student->find($id);
        $student->update($request->all());

        return redirect()->back()->with('success', 'Student updated successfully!');
    }
}
