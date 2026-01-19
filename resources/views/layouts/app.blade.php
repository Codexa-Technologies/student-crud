<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Student CRUD')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body{background:#f8fafc;min-height:100vh;font-family:'Segoe UI',sans-serif;margin:0;padding:0}
        .navbar.site-navbar{background:#fff;border-bottom:1px solid #e2e8f0;padding:1rem 0;position:sticky;top:0;z-index:1030;box-shadow:0 1px 3px rgba(0,0,0,.1)}
        .navbar .navbar-brand{font-weight:700;color:#1e293b;font-size:1.5rem}
        .navbar .nav-link{color:#64748b;font-weight:500;padding:.75rem 1rem;border-radius:6px;transition:.2s}
        .navbar .nav-link:hover,.navbar .nav-link.active{color:#3b82f6;background:#f1f5f9}
        .navbar .dropdown-menu{border:1px solid #e2e8f0;border-radius:8px;box-shadow:0 4px 6px rgba(0,0,0,.1)}
        .navbar .dropdown-item{padding:.5rem 1rem;color:#64748b}
        .navbar .dropdown-item:hover{background:#f1f5f9;color:#3b82f6}
        .container{max-width:1200px;padding:0 1rem;margin:0 auto}
        .content-container{background:#fff;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,.1);padding:2rem;margin:1.5rem auto}
        .form-card{background:#fff;border-radius:8px;box-shadow:0 1px 3px rgba(0,0,0,.1);padding:2rem}
        .form-label{font-weight:600;color:#374151;margin-bottom:.5rem;display:block}
        .input-icon{position:relative}
        .input-icon i{position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#6b7280}
        .form-control-enhanced{width:100%;height:44px;padding:0 12px 0 40px;border:1px solid #d1d5db;border-radius:6px;font-size:14px;transition:.2s}
        .form-control-enhanced:focus{border-color:#3b82f6;outline:none;box-shadow:0 0 0 3px rgba(59,130,246,.1)}
        .btn-enhanced{height:44px;padding:0 1.5rem;border-radius:6px;font-weight:500;border:none;cursor:pointer;transition:.2s;display:inline-flex;align-items:center;justify-content:center;gap:.5rem}
        .btn-primary-enhanced{background:#3b82f6;color:#fff}
        .btn-success-enhanced{background:#10b981;color:#fff}
        .btn-danger-enhanced{background:#ef4444;color:#fff}
        .btn-info-enhanced{background:#06b6d4;color:#fff}
        .btn-secondary-enhanced{background:#6b7280;color:#fff}
        .btn-enhanced:hover{opacity:.9;transform:translateY(-1px)}
        .table-enhanced{border:1px solid #e5e7eb;border-radius:8px;overflow:hidden}
        .table-enhanced thead{background:#f9fafb}
        .table-enhanced th{padding:1rem;font-weight:600;color:#374151;border-bottom:1px solid #e5e7eb}
        .table-enhanced td{padding:1rem;border-bottom:1px solid #f3f4f6}
        .table-enhanced tbody tr:hover{background:#f9fafb}
        .alert-enhanced{padding:1rem;border-radius:6px;margin-bottom:1rem;display:flex;align-items:center;gap:.5rem}
        .alert-success-enhanced{background:#dcfce7;color:#166534;border-left:4px solid #22c55e}
        .alert-danger-enhanced{background:#fef2f2;color:#dc2626;border-left:4px solid #ef4444}
        .page-header{margin-bottom:2rem;padding-bottom:1rem;border-bottom:1px solid #e5e7eb}
        .page-title{font-size:2rem;font-weight:700;color:#1e293b;margin-bottom:.5rem}
        .page-subtitle{color:#64748b;font-size:1rem}
        .action-bar{background:#fff;border-radius:8px;padding:1.5rem;margin-bottom:1.5rem;box-shadow:0 1px 3px rgba(0,0,0,.1);display:flex;gap:1rem;align-items:center;flex-wrap:wrap}
        .search-box{flex:1;min-width:300px;position:relative}
        .search-input{width:100%;height:44px;padding:0 12px 0 40px;border:1px solid #d1d5db;border-radius:6px;font-size:14px}
        .search-input:focus{border-color:#3b82f6;outline:none;box-shadow:0 0 0 3px rgba(59,130,246,.1)}
        .search-icon{position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#6b7280}
        .action-buttons{display:flex;gap:.5rem}
        .action-buttons .btn-enhanced{height:36px;padding:0 1rem;font-size:13px}
        .error-input{border-color:#ef4444}
        .error-message{color:#ef4444;font-size:13px;margin-top:.25rem}
        .back-link{color:#3b82f6;text-decoration:none;display:inline-flex;align-items:center;gap:.5rem;padding:.5rem;border-radius:6px;transition:.2s}
        .back-link:hover{background:#f1f5f9}
        .toast-top-right{position:fixed;top:1rem;right:1rem;z-index:1100}
        @media(max-width:768px){
            .content-container{padding:1.5rem;margin:1rem auto}
            .action-bar{flex-direction:column;align-items:stretch}
            .search-box{min-width:100%}
        }
    </style>
</head>
<body>
    @if(request()->is('students*') || request()->is('courses*'))
    <nav class="navbar site-navbar navbar-expand-lg sticky-top shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-graduation-cap me-2"></i>Student Management
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}" href="{{ route('students.index') }}">
                            <i class="fas fa-users me-1"></i>Students
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}" href="{{ route('courses.index') }}">
                            <i class="fas fa-book me-1"></i>Courses
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('login')?'active':'' }}" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i>Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('register')?'active':'' }}" href="{{ route('register') }}">
                            <i class="fas fa-user-plus me-1"></i>Register
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    @endif
    
    <div class="container py-4">
        @if ($errors->any())
            <div class="alert-enhanced alert-danger-enhanced">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    <strong>There were some problems with your input:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="confirmDeleteMessage" class="mb-0">Are you sure you want to delete this item?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmDeleteButton" class="btn btn-danger">Yes, delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast container (top-right) -->
    <div id="toastContainer" class="toast-top-right" aria-live="polite" aria-atomic="true"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form validation styling
            document.querySelectorAll('.form-control-enhanced').forEach(input => {
                input.addEventListener('input', function() {
                    if(this.classList.contains('error-input')) {
                        this.classList.remove('error-input');
                        const parent = this.parentElement.parentElement;
                        const errorDiv = parent.querySelector('.error-message');
                        if(errorDiv) {
                            errorDiv.style.opacity = '0';
                            setTimeout(() => errorDiv.remove(), 300);
                        }
                    }
                });
            });
            
            // Set active navigation
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-link').forEach(link => {
                if(link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
            
            // Modal-based confirmation for delete forms with class 'confirm-delete'
            (function(){
                const modalEl = document.getElementById('confirmDeleteModal');
                if(!modalEl) return;
                const bsModal = new bootstrap.Modal(modalEl);
                const messageEl = document.getElementById('confirmDeleteMessage');
                const confirmBtn = document.getElementById('confirmDeleteButton');
                let currentForm = null;

                document.querySelectorAll('form.confirm-delete').forEach(form => {
                    form.addEventListener('submit', function(e){
                        e.preventDefault();
                        currentForm = this;
                        const name = this.dataset.name || '';
                        messageEl.textContent = name ? `Are you sure you want to delete "${name}"?` : 'Are you sure you want to delete this item?';
                        bsModal.show();
                    });
                });

                confirmBtn.addEventListener('click', function(){
                    if(currentForm){
                        // submit without triggering the handler again
                        currentForm.removeEventListener('submit', submitPreventer);
                        currentForm.submit();
                    }
                });

                // helper to allow safe removal above (no-op if not set)
                function submitPreventer(e){ e.preventDefault(); }
            })();

                // Convert inline alerts into top-right auto-dismiss toasts (3s)
                (function(){
                    const container = document.getElementById('toastContainer');
                    if(!container) return;

                    const alerts = document.querySelectorAll('.alert, .alert-enhanced');
                    alerts.forEach(alert => {
                        const html = alert.innerHTML.trim();
                        let type = 'secondary';
                        const classList = alert.className || '';
                        if(/success/i.test(classList)) type = 'success';
                        else if(/danger|error/i.test(classList)) type = 'danger';
                        else if(/info/i.test(classList)) type = 'info';

                        const bgClass = {
                            success: 'bg-success text-white',
                            danger: 'bg-danger text-white',
                            info: 'bg-info text-white',
                            secondary: 'bg-secondary text-white'
                        }[type] || 'bg-secondary text-white';

                        const toastEl = document.createElement('div');
                        toastEl.className = 'toast';
                        toastEl.setAttribute('role','alert');
                        toastEl.setAttribute('aria-live','assertive');
                        toastEl.setAttribute('aria-atomic','true');
                        toastEl.innerHTML = `
                            <div class="d-flex ${bgClass} rounded-3 align-items-start p-3">
                                <div class="toast-body me-3">${html}</div>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        `;
                        container.appendChild(toastEl);

                        const bsToast = new bootstrap.Toast(toastEl, { delay: 3000, autohide: true });
                        toastEl.addEventListener('hidden.bs.toast', () => toastEl.remove());
                        bsToast.show();

                        // remove original inline alert
                        alert.remove();
                    });
                })();
        });
    </script>
</body>
</html>
