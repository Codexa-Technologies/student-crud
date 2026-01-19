<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');

        $courses = Course::withCount('students')
            ->when($q, function ($query, $q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('name', 'like', "%{$q}%")
                        ->orWhere('description', 'like', "%{$q}%")
                        ->orWhere('course_code', 'like', "%{$q}%")
                        ->orWhere('leader', 'like', "%{$q}%");
                });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        // Dashboard stats
        $totalCourses = Course::count();
        $newThisWeek = Course::where('created_at', '>=', Carbon::now()->subDays(7))->count();

        return view('courses.index', compact('courses', 'totalCourses', 'newThisWeek'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:courses,name',
            'description' => 'nullable|string|max:2000',
            'course_code' => 'nullable|string|max:100|unique:courses,course_code',
            'start_date' => 'nullable|date',
            'duration' => 'nullable|string|max:100',
            'leader' => 'nullable|string|max:255',
        ]);

        Course::create($data);

        return redirect()->route('courses.index')->with('success', 'Course created successfully');
    }

    public function show(Course $course)
    {
        $students = $course->students()->paginate(10);
        return view('courses.show', compact('course', 'students'));
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:courses,name,' . $course->id,
            'description' => 'nullable|string|max:2000',
            'course_code' => 'nullable|string|max:100|unique:courses,course_code,' . $course->id,
            'start_date' => 'nullable|date',
            'duration' => 'nullable|string|max:100',
            'leader' => 'nullable|string|max:255',
        ]);

        $course->update($data);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully');
    }
}
