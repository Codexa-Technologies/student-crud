@extends('layouts.app')

@section('title', 'Student Details')
@section('content')
<div class="content-container">
    <div class="page-header">
        <h1 class="page-title">Student Details</h1>
        <p class="page-subtitle">View complete student information</p>
    </div>
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Basic Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold">Full Name:</div>
                        <div class="col-md-8">{{ $student->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold">Email Address:</div>
                        <div class="col-md-8">
                            <a href="mailto:{{ $student->email }}" class="text-decoration-none">
                                {{ $student->email }}
                            </a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold">NIC Number:</div>
                        <div class="col-md-8">{{ $student->nic ?? 'N/A' }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 fw-semibold">Age:</div>
                        <div class="col-md-8">
                            @if($student->age)
                                <span class="badge bg-info">{{ $student->age }}</span>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="mb-0"><i class="fas fa-cogs me-2"></i>Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <a href="{{ route('students.edit', $student) }}" 
                           class="btn-enhanced btn-primary-enhanced">
                            <i class="fas fa-edit me-2"></i>
                            <span>Edit Student</span>
                        </a>
                        <form action="{{ route('students.destroy', $student) }}" 
                              method="POST" class="d-grid confirm-delete" data-name="{{ $student->name }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-enhanced btn-danger-enhanced">
                                <i class="fas fa-trash-alt me-2"></i>
                                <span>Delete Student</span>
                            </button>
                        </form>
                        <a href="{{ route('students.index') }}" 
                           class="btn-enhanced btn-secondary-enhanced">
                            <i class="fas fa-arrow-left me-2"></i>
                            <span>Back to List</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="mb-0"><i class="fas fa-history me-2"></i>Record Info</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6 fw-semibold">Created:</div>
                        <div class="col-6 text-muted">{{ $student->created_at->format('M d, Y') }}</div>
                    </div>
                    <div class="row">
                        <div class="col-6 fw-semibold">Last Updated:</div>
                        <div class="col-6 text-muted">{{ $student->updated_at->format('M d, Y') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection