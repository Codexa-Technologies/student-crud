<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('course');

        if ($request->filled('q')) {
            $q = trim($request->q);

            // Digit-only queries -> search `age` (exact) and `nic` (partial)
            if (ctype_digit($q)) {
                $query->where(function ($b) use ($q) {
                    $b->where('age', $q)
                      ->orWhere('nic', 'like', "%{$q}%");
                });

            // Letter-only queries -> search name, email, nic
            } elseif (preg_match('/[A-Za-z]/', $q) && !preg_match('/\\d/', $q)) {
                $query->where(function ($b) use ($q) {
                    $b->where('name', 'like', "%{$q}%")
                      ->orWhere('email', 'like', "%{$q}%")
                      ->orWhere('nic', 'like', "%{$q}%");
                });

            // Mixed queries (alphanumeric) -> search across name, email, nic, and age when numeric part present
            } else {
                $query->where(function ($b) use ($q) {
                    $b->where('name', 'like', "%{$q}%")
                      ->orWhere('email', 'like', "%{$q}%")
                      ->orWhere('nic', 'like', "%{$q}%");

                    if (is_numeric($q)) {
                        $b->orWhere('age', $q);
                    }
                });
            }
        }

        $students = $query->orderBy('created_at', 'desc')
                  ->paginate(10)
                  ->withQueryString();

        // Dashboard statistics
        $totalStudents = Student::count();
        $recentStudents = Student::where('created_at', '>=', now()->subDays(7))->count();
        $averageAge = Student::whereNotNull('age')->avg('age');

        return view('students.index', compact('students', 'totalStudents', 'recentStudents', 'averageAge'));
    }

    public function create()
    {
        $courses = Course::orderBy('name')->get();
        return view('students.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255|min:5',
            'email' => 'required|email:rfc,dns|unique:students,email|max:255|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'nic'   => 'nullable|string|min:9|max:12|unique:students,nic',
            'age'   => 'nullable|integer|min:6|max:100',
            'course_id' => 'nullable|exists:courses,id'
        ]);

        Student::create($data);

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully');
    }

    public function show(Student $student)
    {
        $student->load('course');
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $courses = Course::orderBy('name')->get();
        return view('students.edit', compact('student', 'courses'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name'  => 'required|string|max:255|min:2',
            'email' => 'required|email:rfc,dns|unique:students,email,' . $student->id . '|max:255|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'nic'   => 'nullable|string|max:20|unique:students,nic,' . $student->id,
            'age'   => 'nullable|integer|min:1|max:120',
            'course_id' => 'nullable|exists:courses,id'
        ]);

        $student->update($data);

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }
}
