<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;


class StudentsController extends Controller
{
    //
    public function index()
    {
        return view('pages.students');
    }


    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string',
            'parents_name' => 'required|string',
            'class' => 'required|string',
            'contact' => 'required|integer',
            'balance' => 'required|numeric',
        ]);
        dd($request->all());
        // Create a new student instance
        $student = new Student();
        $student->name = $request->input('name');
        $student->parents_name = $request->input('parents_name');
        $student->class = $request->input('class');
        $student->contact = $request->input('contact');
        $student->balance = $request->input('balance');

        // Save the student details to the database
        $student->save();

        // Optionally, you can redirect the user to a specific page or return a response
        return redirect()->route('students.index')->with('success', 'Student added successfully');
    }

    public function getStudents(Request $request)
    {
        $pageNumber = $request->input('page', 1);
        $pageSize = $request->input('size', 10);

        $students = Student::paginate($pageSize, ['*'], 'page', $pageNumber);

        return response()->json([
            'students' => $students->items(),
            'page' => $students->currentPage(),
            'totalPages' => $students->lastPage(),
        ]);
    }
}
