@extends('layouts.app')

@section('title', 'Student Details')
@section('content')
<div class="content-container">
    <div class="page-header">
        <h1 class="page-title">Student Details</h1>
        <p class="page-subtitle">View student information</p>
    </div>
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card" style="border:1px solid #e5e7eb;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,.1)">
                <div class="card-header" style="background:#f9fafb;border-bottom:1px solid #e5e7eb;padding:1rem">
                    <h5 class="mb-0" style="color:#374151;font-weight:600"><i class="fas fa-info-circle me-2"></i>Basic Information</h5>
                </div>
                <div class="card-body" style="padding:1.5rem">
                    <div class="row mb-3">
                        <div class="col-md-4" style="font-weight:600;color:#374151">Full Name:</div>
                        <div class="col-md-8" style="color:#1f2937">{{ $student->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4" style="font-weight:600;color:#374151">Email Address:</div>
                        <div class="col-md-8">
                            <a href="mailto:{{ $student->email }}" style="color:#3b82f6;text-decoration:none">
                                {{ $student->email }}
                            </a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4" style="font-weight:600;color:#374151">NIC Number:</div>
                        <div class="col-md-8" style="color:#1f2937">{{ $student->nic ?? 'N/A' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4" style="font-weight:600;color:#374151">Course:</div>
                        <div class="col-md-8" style="color:#1f2937">{{ $student->course->name ?? 'N/A' }}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4" style="font-weight:600;color:#374151">Age:</div>
                        <div class="col-md-8">
                            @if($student->age)
                                <span style="background:#06b6d4;color:#fff;padding:.25rem .5rem;border-radius:4px;font-size:12px">{{ $student->age }}</span>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card mb-4" style="border:1px solid #e5e7eb;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,.1)">
                <div class="card-header" style="background:#f9fafb;border-bottom:1px solid #e5e7eb;padding:1rem">
                    <h5 class="mb-0" style="color:#374151;font-weight:600"><i class="fas fa-cogs me-2"></i>Actions</h5>
                </div>
                <div class="card-body" style="padding:1.5rem">
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
                                <i class="fas fa-trash me-2"></i>
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
            
            <div class="card" style="border:1px solid #e5e7eb;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,.1)">
                <div class="card-header" style="background:#f9fafb;border-bottom:1px solid #e5e7eb;padding:1rem">
                    <h5 class="mb-0" style="color:#374151;font-weight:600"><i class="fas fa-history me-2"></i>Record Info</h5>
                </div>
                <div class="card-body" style="padding:1.5rem">
                    <div class="row mb-2">
                        <div class="col-6" style="font-weight:600;color:#374151">Created:</div>
                        <div class="col-6 text-muted">{{ $student->created_at->format('M d, Y') }}</div>
                    </div>
                    <div class="row">
                        <div class="col-6" style="font-weight:600;color:#374151">Last Updated:</div>
                        <div class="col-6 text-muted">{{ $student->updated_at->format('M d, Y') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection