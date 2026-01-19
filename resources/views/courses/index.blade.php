@extends('layouts.app')

@section('title','Courses')
@section('content')
<div class="content-container">
    <div class="page-header">
        <h1 class="page-title">Courses</h1>
        <p class="page-subtitle">Manage courses and view enrolled students</p>
    </div>

    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: #3b82f6;">
                <div class="card-body text-white text-center">
                    <i class="fas fa-book fa-3x mb-3"></i>
                    <h3 class="mb-1">{{ $totalCourses }}</h3>
                    <p class="mb-0">Total Courses</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: #3b82f6;">
                <div class="card-body text-white text-center">
                    <i class="fas fa-calendar-plus fa-3x mb-3"></i>
                    <h3 class="mb-1">{{ $newThisWeek }}</h3>
                    <p class="mb-0">New This Week</p>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-enhanced alert-success-enhanced">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="action-bar mb-3">
        <div class="search-box">
            <i class="fas fa-search search-icon"></i>
            <form method="GET" class="d-flex" action="{{ route('courses.index') }}">
                <input type="text" name="q" placeholder="Search courses by name, code, leader..." 
                       value="{{ request('q') }}" class="search-input">
            </form>
        </div>

        <div class="d-flex gap-3 ms-auto">
            <a href="{{ route('courses.create') }}" class="btn-enhanced btn-success-enhanced">
                <i class="fas fa-plus-circle"></i>
                <span>Create Course</span>
            </a>
            <a href="{{ route('courses.index') }}" class="btn-enhanced btn-secondary-enhanced">
                <i class="fas fa-sync-alt"></i>
                <span>Reset</span>
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-enhanced">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Students</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $index => $course)
                <tr>
                    <td>{{ $index + 1 + ($courses->currentPage() - 1) * $courses->perPage() }}</td>
                    <td class="fw-semibold">{{ $course->name }}</td>
                    <td>{{ Str::limit($course->description, 80) }}</td>
                    <td><span class="badge bg-info">{{ $course->students_count }}</span></td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('courses.show', $course) }}" class="btn-enhanced btn-info-enhanced"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('courses.edit', $course) }}" class="btn-enhanced btn-primary-enhanced"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('courses.destroy', $course) }}" method="POST" style="display:inline" class="confirm-delete" data-name="{{ $course->name }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-enhanced btn-danger-enhanced"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4">No courses found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $courses->links() }}
    </div>
</div>
@endsection
