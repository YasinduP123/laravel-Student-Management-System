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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'student_image',
        ]);

        $imagePath = null;
        if ($request->hasFile('student_image')) {
            $imagePath = $request->file('student_image')->store('images', 'public');
        }

        $this->student->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'student_image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Student added successfully!');
    }
    // public function storeImgToLocalStorage(Request $request){
    //     $request->validate([
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5072',
    //     ]);
    //     $imagePath = $request->file(key: 'student_image')->store('images', 'public');

    //     $student = new Student();
    //     $student->student_image = $imagePath;
    //     $student->update($request,$id);

    //     return redirect()->back()->with('success', 'Image uploaded successfully!');
    // }

    public function delete($id)
    {

        $student = $this->student->find($id);
        $student->delete();

        return redirect()->back()->with('success', 'Student deleted successfully!');
    }

    public function update(Request $request, $id)
    {
        $student = $this->student->find($id);
        $imagePath = null;
        if ($request->hasFile('student_image')) {
            $imagePath = $request->file('student_image')->store('images', 'public');
        }
        // dd($imagePath);

        $student->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone'),
            'student_image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Student updated successfully!');
    }

    public function find(){
        $id = request(key: 'search');
        $students = $this->student->find($id);

        return view('student',['students' => $students]);
    }

}
