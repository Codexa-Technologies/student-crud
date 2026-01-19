@extends('layouts.app')

@section('content')
<div class="content-container">
    <div class="page-header">
        <h1 class="page-title">Students</h1>
        <p class="page-subtitle">Manage student records</p>
    </div>
    
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card border-0 h-100" style="background:#3b82f6;color:#fff;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,.1)">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-2x mb-2"></i>
                    <h3 class="mb-1">{{ $totalStudents }}</h3>
                    <p class="mb-0">Total Students</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card border-0 h-100" style="background:#10b981;color:#fff;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,.1)">
                <div class="card-body text-center">
                    <i class="fas fa-user-plus fa-2x mb-2"></i>
                    <h3 class="mb-1">{{ $recentStudents }}</h3>
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
    
    @if(session('error'))
        <div class="alert-enhanced alert-danger-enhanced">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif
    
    <div class="action-bar">
        <div class="search-box">
            <i class="fas fa-search search-icon"></i>
            <form method="GET" class="d-flex">
                <input type="text" name="q" placeholder="Search students..." 
                       value="{{ request('q') }}" class="search-input">
            </form>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('students.create') }}" class="btn-enhanced btn-success-enhanced">
                <i class="fas fa-plus"></i>
                <span>Add Student</span>
            </a>
            <a href="{{ route('students.index') }}" class="btn-enhanced btn-secondary-enhanced">
                <i class="fas fa-refresh"></i>
                <span>Reset</span>
            </a>
        </div>
    </div>
    
    <div class="table-responsive">
        <table class="table table-enhanced">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>NIC</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $index => $student)
                <tr>
                    <td>{{ $index + 1 + ($students->currentPage() - 1) * $students->perPage() }}</td>
                    <td class="fw-semibold">{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->course->name ?? 'N/A' }}</td>
                    <td>{{ $student->nic ?? 'N/A' }}</td>
                    <td>
                        @if($student->age)
                            <span class="badge" style="background:#06b6d4;color:#fff;padding:.25rem .5rem;border-radius:4px;font-size:12px">{{ $student->age }}</span>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('students.show', $student) }}" 
                               class="btn-enhanced btn-info-enhanced" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('students.edit', $student) }}" 
                               class="btn-enhanced btn-primary-enhanced" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('students.destroy', $student) }}"
                                  method="POST" style="display:inline" class="confirm-delete" data-name="{{ $student->name }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-enhanced btn-danger-enhanced" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5">
                        <i class="fas fa-users fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No students found</h5>
                        <p class="text-muted">Add your first student to get started</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($students->hasPages())
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div>
            @if ($students->onFirstPage())
                <button class="btn btn-secondary" disabled>
                    <i class="fas fa-chevron-left me-1"></i>Previous
                </button>
            @else
                <a href="{{ $students->previousPageUrl() }}" class="btn btn-primary">
                    <i class="fas fa-chevron-left me-1"></i>Previous
                </a>
            @endif
        </div>
        
        <div class="text-muted">
            Page {{ $students->currentPage() }} of {{ $students->lastPage() }}
        </div>
        
        <div>
            @if ($students->hasMorePages())
                <a href="{{ $students->nextPageUrl() }}" class="btn btn-primary">
                    Next<i class="fas fa-chevron-right ms-1"></i>
                </a>
            @else
                <button class="btn btn-secondary" disabled>
                    Next<i class="fas fa-chevron-right ms-1"></i>
                </button>
            @endif
        </div>
    </div>
    @endif
    
    <div class="text-center mt-3 text-muted small">
        Showing {{ $students->count() }} of {{ $students->total() }} students
    </div>
    
    <script>
    (function(){
        const input = document.querySelector('.search-input');
        const form = input ? input.form : null;
        if (!input || !form) return;

        let timer = null;
        const minLen = 2;

        input.addEventListener('input', function(){
            clearTimeout(timer);
            const v = input.value.trim();

            if (v.length === 0) {
                timer = setTimeout(function(){ form.submit(); }, 300);
                return;
            }

            if (v.length >= minLen) {
                timer = setTimeout(function(){ form.submit(); }, 300);
            }
        });

        form.addEventListener('submit', function(e){
            const v = input.value.trim();
            if (v.length > 0 && v.length < minLen) {
                e.preventDefault();
                return false;
            }
        });
    })();
    </script>
</div>
@endsection