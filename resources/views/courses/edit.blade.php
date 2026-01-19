@extends('layouts.app')

@section('title','Edit Course')
@section('content')
<div class="content-container">
    <div class="page-header">
        <h1 class="page-title">Edit Course</h1>
        <p class="page-subtitle">Update course details</p>
    </div>

    <div class="form-card">
        <form method="POST" action="{{ route('courses.update', $course) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Course Name</label>
                <input type="text" name="name" value="{{ old('name', $course->name) }}" class="form-control-enhanced @error('name') error-input @enderror" required>
                @error('name')<div class="error-message">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control-enhanced @error('description') error-input @enderror" rows="4">{{ old('description', $course->description) }}</textarea>
                @error('description')<div class="error-message">{{ $message }}</div>@enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Course Code</label>
                    <input type="text" name="course_code" value="{{ old('course_code', $course->course_code) }}" class="form-control-enhanced @error('course_code') error-input @enderror">
                    @error('course_code')<div class="error-message">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Course Leader</label>
                    <input type="text" name="leader" value="{{ old('leader', $course->leader) }}" class="form-control-enhanced @error('leader') error-input @enderror">
                    @error('leader')<div class="error-message">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" value="{{ old('start_date', $course->start_date) }}" class="form-control-enhanced @error('start_date') error-input @enderror">
                    @error('start_date')<div class="error-message">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Duration</label>
                    <input type="text" name="duration" value="{{ old('duration', $course->duration) }}" class="form-control-enhanced @error('duration') error-input @enderror" placeholder="e.g. 8 weeks, 3 months">
                    @error('duration')<div class="error-message">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="d-flex justify-content-end gap-3">
                <a href="{{ route('courses.index') }}" class="btn-enhanced btn-secondary-enhanced">Cancel</a>
                <button type="submit" class="btn-enhanced btn-primary-enhanced">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
