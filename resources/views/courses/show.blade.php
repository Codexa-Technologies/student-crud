@extends('layouts.app')

@section('title','Course Details')
@section('content')
<div class="content-container">
    <div class="page-header">
        <h1 class="page-title">{{ $course->name }}</h1>
        <p class="page-subtitle">{{ $course->description }}</p>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <strong>Course Code:</strong>
                    <div>{{ $course->course_code ?? 'N/A' }}</div>
                </div>
                <div class="col-md-4">
                    <strong>Start Date:</strong>
                    <div>{{ $course->start_date ? 
                        \Carbon\Carbon::parse($course->start_date)->toFormattedDateString() : 'N/A' }}</div>
                </div>
                <div class="col-md-4">
                    <strong>Duration:</strong>
                    <div>{{ $course->duration ?? 'N/A' }}</div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Course Leader:</strong>
                    <div>{{ $course->leader ?? 'N/A' }}</div>
                </div>
            </div>

            <h4>Enrolled Students ({{ $course->students()->count() }})</h4>
            @if($course->students->isEmpty())
                <p>No students enrolled yet.</p>
            @else
                <table class="table-enhanced">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>NIC</th>
                            <th>Age</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($course->students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->nic }}</td>
                                <td>{{ $student->age }}</td>
                                <td>{{ $student->email }}</td>
                                <td>
                                    <a href="{{ route('students.show', $student) }}" class="btn-enhanced btn-sm btn-info-enhanced">View</a>
                                    <a href="{{ route('students.edit', $student) }}" class="btn-enhanced btn-sm btn-warning-enhanced">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ route('courses.index') }}" class="btn-enhanced btn-secondary-enhanced">Back</a>
        <a href="{{ route('courses.edit', $course) }}" class="btn-enhanced btn-primary-enhanced">Edit Course</a>
    </div>
</div>
@endsection
