<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route(route: 'login');
        }
        return view('student', [
            'students' => Student::all()
        ]);
    }
}
