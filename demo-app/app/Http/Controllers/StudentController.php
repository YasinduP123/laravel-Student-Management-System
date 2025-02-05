<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('student', [
            'students' => Student::all()
        ]);
    }


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'student_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5072',
        ]);

        $imagePath = null;
        if ($request->hasFile('student_image')) {
            $imagePath = $request->file('student_image')->store('images', 'public');
        }

        Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'student_image' => $imagePath,
        ]);

        return redirect()->back()->with('success', value: 'Student added successfully!');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('student-edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students,email,' . $id,
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:10',
            'student_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5072',
        ]);

        if ($request->hasFile('student_image')) {
            if ($student->student_image) {
                Storage::disk('public')->delete($student->student_image);
            }
            $student->student_image = $request->file('student_image')->store('images', 'public');
        }

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return redirect()->back()->with('success', 'Student updated successfully!');
    }

    public function delete($id)
    {
        $student = Student::findOrFail($id);

        if ($student->student_image) {
            Storage::disk('public')->delete($student->student_image);
        }

        $student->delete();

        return redirect()->back()->with('success', 'Student deleted successfully!');
    }

    // public function find(Request $request)
    // {
    //     $id = $request->input('search');
    //     $student = Student::find($id);

    //     return view('student', ['students' => $student ? [$student] : []]);
    // }

    public function findByEmail(Request $request)
    {
        $email = $request->input('search');
        $students = Student::where('email', $email)->get();
        // dd($students);

        return view('student', ['students' => $students]);
    }

}
