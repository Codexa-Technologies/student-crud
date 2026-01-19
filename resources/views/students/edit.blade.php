@extends('layouts.app')

@section('title', 'Edit Student')
@section('content')
<div class="content-container">
    <div class="page-header">
        <h1 class="page-title">Edit Student</h1>
        <p class="page-subtitle">Update student information</p>
    </div>
    
    <div class="form-card">
        <form method="POST" action="{{ route('students.update', $student) }}" id="editForm">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Full Name *</label>
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" name="name" value="{{ old('name', $student->name) }}" 
                               class="form-control-enhanced @error('name') error-input @enderror" 
                               placeholder="Enter full name" required>
                    </div>
                    @error('name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email Address *</label>
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" value="{{ old('email', $student->email) }}" 
                               class="form-control-enhanced @error('email') error-input @enderror" 
                               placeholder="Enter email address" required>
                    </div>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">NIC Number</label>
                    <div class="input-icon">
                        <i class="fas fa-id-card"></i>
                        <input type="text" name="nic" value="{{ old('nic', $student->nic) }}" 
                               class="form-control-enhanced @error('nic') error-input @enderror" 
                               placeholder="Enter NIC number">
                    </div>
                    @error('nic')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Age</label>
                    <div class="input-icon">
                        <i class="fas fa-birthday-cake"></i>
                        <input type="number" name="age" value="{{ old('age', $student->age) }}" 
                               class="form-control-enhanced @error('age') error-input @enderror" 
                               placeholder="Enter age" min="1" max="120">
                    </div>
                    @error('age')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Course</label>
                    <select name="course_id" class="form-control-enhanced @error('course_id') error-input @enderror">
                        <option value="">-- Select course (optional) --</option>
                        @foreach($courses as $c)
                            <option value="{{ $c->id }}" {{ old('course_id', $student->course_id) == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                        @endforeach
                    </select>
                    @error('course_id')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="{{ route('students.index') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i>
                    Back to Students
                </a>
                <div class="d-flex gap-2">
                    <button type="reset" class="btn-enhanced btn-secondary-enhanced">
                        <i class="fas fa-redo"></i>
                        <span>Reset</span>
                    </button>
                    <button type="submit" class="btn-enhanced btn-primary-enhanced">
                        <i class="fas fa-save"></i>
                        <span>Update Student</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection