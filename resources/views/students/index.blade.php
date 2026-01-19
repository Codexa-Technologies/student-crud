@extends('layouts.app')

@section('content')
<div class="content-container">
    <div class="page-header">
        <h1 class="page-title">Student Management</h1>
        <p class="page-subtitle">Manage your student records efficiently</p>
    </div>
    
    <!-- Dashboard Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: #3b82f6;">
                <div class="card-body text-white text-center">
                    <i class="fas fa-users fa-3x mb-3"></i>
                    <h3 class="mb-1">{{ $totalStudents }}</h3>
                    <p class="mb-0">Total Students</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: #3b82f6;">
                <div class="card-body text-white text-center">
                    <i class="fas fa-user-plus fa-3x mb-3"></i>
                    <h3 class="mb-1">{{ $recentStudents }}</h3>
                    <p class="mb-0">New This Week</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100" style="background: #3b82f6;">
                <div class="card-body text-white text-center">
                    <i class="fas fa-chart-line fa-3x mb-3"></i>
                    <h3 class="mb-1">{{ $averageAge ? number_format($averageAge, 1) : 'N/A' }}</h3>
                    <p class="mb-0">Average Age</p>
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
                <input type="text" name="q" placeholder="Search by name, email, NIC, or age..." 
                       value="{{ request('q') }}" class="search-input">
            </form>
        </div>
        <div class="d-flex gap-3">
            <a href="{{ route('students.create') }}" class="btn-enhanced btn-success-enhanced">
                <i class="fas fa-plus-circle"></i>
                <span>Create Student</span>
            </a>
            <a href="{{ route('students.index') }}" class="btn-enhanced btn-secondary-enhanced">
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
                    <th>Email</th>
                    <th>NIC</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $index => $student)
                <tr>
                    <td>{{ $index + 1 + ($students->currentPage() - 1) * $students->perPage() }}</td>
                    <td>
                        <div class="fw-semibold">{{ $student->name }}</div>
                    </td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->nic ?? 'N/A' }}</td>
                    <td>
                        @if($student->age)
                            <span class="badge bg-info">{{ $student->age }}</span>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('students.show', $student) }}" 
                               class="btn-enhanced btn-info-enhanced" title="View {{ $student->name }}" aria-label="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('students.edit', $student) }}" 
                               class="btn-enhanced btn-primary-enhanced" title="Edit {{ $student->name }}" aria-label="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('students.destroy', $student) }}"
                                  method="POST" style="display:inline" class="confirm-delete" data-name="{{ $student->name }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-enhanced btn-danger-enhanced" title="Delete {{ $student->name }}" aria-label="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">
                        <div class="py-3">
                            <i class="fas fa-user-graduate fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No students found</h5>
                            <p class="text-muted mb-0">Create your first student record to get started</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    {{-- Always show pagination info --}}
    <div class="mt-4">
        @if($students->hasPages())
        <div class="d-flex justify-content-between align-items-center">
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
        <div class="text-center mt-2 text-muted small">
            Showing {{ $students->count() }} of {{ $students->total() }} students
        </div>
    </div>
    
    <script>
    (function(){
        const input = document.querySelector('.search-input');
        const form = input ? input.form : null;
        if (!input || !form) return;

        let timer = null;
        const minLen = 2; // require at least 2 chars to trigger search

        input.addEventListener('input', function(){
            clearTimeout(timer);
            const v = input.value.trim();

            // Auto-submit when cleared (show all) or when length >= minLen
            if (v.length === 0) {
                timer = setTimeout(function(){ form.submit(); }, 300);
                return;
            }

            if (v.length >= minLen) {
                timer = setTimeout(function(){ form.submit(); }, 300);
            }
        });

        // Prevent Enter/submit when query is present but shorter than minLen
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