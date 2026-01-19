<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Student CRUD')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Light Blue Professional Colors - Keep All Elements */
        body{background:linear-gradient(135deg,#eff6ff 0%,#dbeafe 100%);min-height:100vh;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;padding-top:0;margin:0}
        .navbar.site-navbar{background:linear-gradient(135deg,rgba(255,255,255,.98),rgba(255,255,255,.95));backdrop-filter:blur(10px);border-bottom:1px solid rgba(255,255,255,.2);box-shadow:0 4px 20px rgba(59,130,246,.08),0 1px 4px rgba(59,130,246,.04),inset 0 1px 0 rgba(255,255,255,.8);padding:.5rem 0;transition:.3s;width:100%;position:sticky;top:0;z-index:1030}
        .navbar.site-navbar .container{max-width:100%!important;padding:0 2rem;margin:0 auto}
        .navbar.site-navbar:hover{box-shadow:0 6px 25px rgba(59,130,246,.1),0 2px 6px rgba(59,130,246,.06),inset 0 1px 0 rgba(255,255,255,.9)}
        .navbar .navbar-brand{font-weight:800;background:linear-gradient(135deg,#3b82f6,#60a5fa);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;font-size:1.8rem;padding:0;margin-left:.5rem;transition:.3s}
        .navbar .navbar-brand:hover{transform:translateY(-1px);background:linear-gradient(135deg,#60a5fa,#3b82f6);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
        .navbar .nav-link{color:#2d3748;font-weight:600;font-size:.95rem;padding:.7rem 1.2rem;margin:0 .2rem;border-radius:10px;transition:.3s;position:relative;overflow:hidden}
        .navbar .nav-link::before{content:'';position:absolute;bottom:0;left:50%;transform:translateX(-50%);width:0;height:2px;background:linear-gradient(135deg,#3b82f6,#60a5fa);transition:.3s}
        .navbar .nav-link:hover{color:#3b82f6;background:rgba(59,130,246,.08);transform:translateY(-1px)}
        .navbar .nav-link:hover::before{width:70%}
        .navbar .nav-link.active{color:#3b82f6;background:rgba(59,130,246,.1)}
        .navbar .dropdown-toggle{position:relative;padding-right:2rem!important}
        .navbar .dropdown-toggle::after{position:absolute;right:.8rem;top:50%;transform:translateY(-50%);transition:.3s}
        .navbar .dropdown-toggle.show::after{transform:translateY(-50%) rotate(180deg)}
        .navbar .dropdown-menu{min-width:200px;background:rgba(255,255,255,.98);backdrop-filter:blur(10px);border-radius:12px;box-shadow:0 10px 30px rgba(59,130,246,.1);padding:.5rem;margin-top:.5rem!important;animation:dropdownSlide .3s ease;border:none}
        @keyframes dropdownSlide{from{opacity:0;transform:translateY(-10px)}to{opacity:1;transform:translateY(0)}}
        .navbar .dropdown-item{padding:.7rem 1rem;border-radius:8px;color:#4a5568;font-weight:500;transition:.2s;margin:.15rem 0}
        .navbar .dropdown-item:hover{background:linear-gradient(135deg,rgba(59,130,246,.1),rgba(96,165,250,.1));color:#3b82f6;transform:translateX(3px)}
        .navbar .dropdown-item[type="submit"]{background:none;border:none;width:100%;text-align:left;cursor:pointer;color:#f87171}
        .navbar .dropdown-item[type="submit"]:hover{background:rgba(248,113,113,.1);color:#ef4444}
        .navbar-toggler{border:none;padding:.5rem;border-radius:10px;background:rgba(59,130,246,.1);transition:.3s;margin-right:.5rem}
        .navbar-toggler:hover{background:rgba(59,130,246,.2);transform:scale(1.05)}
        .navbar-toggler:focus{box-shadow:0 0 0 3px rgba(59,130,246,.2)}
        
        /* Enhanced Container & Content Styles */
        .container{max-width:1200px;width:100%;padding:20px 15px;margin:0 auto}
        .content-container{background:#fff;border-radius:18px;overflow:hidden;box-shadow:0 12px 30px rgba(59,130,246,.12);transition:transform .3s,box-shadow .3s;padding:30px;margin:20px auto}
        .content-container:hover{transform:translateY(-3px);box-shadow:0 15px 35px rgba(59,130,246,.15)}
        
        /* Enhanced Form Styles */
        .form-card{background:#fff;border-radius:18px;overflow:hidden;box-shadow:0 12px 30px rgba(59,130,246,.12);transition:transform .3s,box-shadow .3s;padding:30px}
        .form-card:hover{transform:translateY(-3px);box-shadow:0 15px 35px rgba(59,130,246,.15)}
        
        .form-label{font-weight:600;color:#2d3748;margin-bottom:8px;font-size:14px;display:block}
        .input-icon{position:relative;width:100%}
        .input-icon i{position:absolute;left:16px;top:50%;transform:translateY(-50%);color:#3b82f6;font-size:16px;z-index:2}
        .form-control-enhanced{width:100%;height:48px;padding:12px 16px 12px 48px;border-radius:10px;border:2px solid #eef2f7;font-size:15px;transition:.3s;background:#fff;color:#2d3748}
        .form-control-enhanced:focus{border-color:#3b82f6;box-shadow:0 0 0 .25rem rgba(59,130,246,.2);outline:none}
        .form-control-enhanced::placeholder{color:#a0aec0;font-size:14px}
        
        /* Enhanced Button Styles */
        .btn-enhanced{border-radius:10px;height:52px;font-weight:600;font-size:16px;display:flex;align-items:center;justify-content:center;gap:8px;transition:.3s;border:none;padding:14px}
        .btn-primary-enhanced{background:linear-gradient(135deg,#3b82f6,#60a5fa);color:#fff}
        .btn-success-enhanced{background:linear-gradient(135deg,#60a5fa,#93c5fd);color:#fff}
        .btn-danger-enhanced{background:linear-gradient(135deg,#f87171,#fca5a5);color:#fff}
        .btn-info-enhanced{background:linear-gradient(135deg,#60a5fa,#93c5fd);color:#fff}
        .btn-secondary-enhanced{background:linear-gradient(135deg,#718096,#4a5568);color:#fff}
        .btn-enhanced:hover{transform:translateY(-2px);box-shadow:0 8px 20px rgba(59,130,246,.12);filter:brightness(105%)}
        
        /* Enhanced Table Styles */
        .table-enhanced{border-radius:12px;overflow:hidden;box-shadow:0 8px 25px rgba(59,130,246,.08);border:1px solid #eef2f7}
        .table-enhanced thead{background:linear-gradient(135deg,#3b82f6,#60a5fa);color:#fff}
        .table-enhanced th{padding:16px 20px;font-weight:600;border:none}
        .table-enhanced td{padding:16px 20px;border-color:#eef2f7;vertical-align:middle}
        .table-enhanced tbody tr:hover{background:rgba(59,130,246,.04)}
        
        /* Enhanced Alert Styles */
        .alert-enhanced{border-radius:10px;border:none;padding:14px 18px;font-size:14px;margin-bottom:20px;display:flex;align-items:center}
        .alert-enhanced i{font-size:16px;margin-right:8px;min-width:20px}
        .alert-success-enhanced{background:#eff6ff;color:#3b82f6;border-left:4px solid #60a5fa}
        .alert-danger-enhanced{background:#fef2f2;color:#dc2626;border-left:4px solid #f87171}
        .alert-info-enhanced{background:#eff6ff;color:#3b82f6;border-left:4px solid #3b82f6}
        
        /* Enhanced Page Headers */
        .page-header{margin-bottom:30px;padding-bottom:20px;border-bottom:2px solid #eef2f7}
        .page-title{font-weight:800;background:linear-gradient(135deg,#3b82f6,#60a5fa);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;font-size:2.2rem;margin-bottom:10px}
        .page-subtitle{color:#718096;font-size:1.1rem}
        
        /* Search and Action Bar */
        .action-bar{background:#fff;border-radius:12px;padding:20px;margin-bottom:25px;box-shadow:0 4px 15px rgba(59,130,246,.06);display:flex;flex-wrap:wrap;gap:15px;align-items:center}
        .search-box{flex:1;min-width:300px;position:relative}
        .search-input{width:100%;height:52px;padding:12px 20px 12px 50px;border-radius:10px;border:2px solid #eef2f7;font-size:15px;transition:.3s}
        .search-input:focus{border-color:#3b82f6;box-shadow:0 0 0 .25rem rgba(59,130,246,.2);outline:none}
        .search-icon{position:absolute;left:18px;top:50%;transform:translateY(-50%);color:#3b82f6;font-size:18px}
        
        /* Pagination Styles */
        .pagination-enhanced .page-link{color:#3b82f6;border:none;padding:10px 18px;margin:0 3px;border-radius:8px;font-weight:500;transition:.3s}
        .pagination-enhanced .page-link:hover{background:rgba(59,130,246,.1);color:#60a5fa}
        .pagination-enhanced .page-item.active .page-link{background:linear-gradient(135deg,#3b82f6,#60a5fa);color:#fff}
        
        /* Responsive Design */
        @media(max-width:992px){
            .navbar.site-navbar{padding:.4rem 0}
            .navbar.site-navbar .container{padding:0 1rem}
            .navbar .nav-link{padding:.6rem 1rem;margin:.1rem 0}
            .navbar-collapse{background:rgba(255,255,255,.98);border-radius:0 0 12px 12px;padding:1rem;margin-top:.5rem;box-shadow:0 8px 24px rgba(59,130,246,.08);border-top:1px solid rgba(0,0,0,.05)}
            .content-container{padding:25px}
            .action-bar{flex-direction:column;align-items:stretch}
            .search-box{min-width:100%}
        }
        @media(max-width:768px){
            .navbar.site-navbar .container{padding:0 .8rem}
            .navbar .navbar-brand{font-size:1.6rem}
            .navbar .nav-link{padding:.5rem .8rem;font-size:.9rem}
            .content-container{padding:20px}
            .table-responsive{margin:0 -20px;width:calc(100% + 40px)}
            .page-title{font-size:1.8rem}
        }
        @media(max-width:576px){
            .navbar.site-navbar .container{padding:0 .5rem}
            .navbar .navbar-brand{font-size:1.4rem}
            .navbar .navbar-brand i{margin-right:.3rem!important}
            .content-container{padding:15px;border-radius:15px}
            .btn-enhanced{height:48px;font-size:15px;padding:12px}
            .form-control-enhanced{height:46px;padding:11px 14px 11px 44px}
        }
        
        /* Action Buttons in Table */
        .action-buttons{display:flex;gap:8px;flex-wrap:wrap}
        .action-buttons .btn-enhanced{height:38px;padding:8px 16px;font-size:14px}
        
        /* Form Error Styles */
        .error-input{border-color:#fc8181;background:#fff5f5}
        .error-input:focus{box-shadow:0 0 0 .25rem rgba(252,129,129,.2)}
        .error-message{color:#fc8181;font-size:13px;margin-top:5px;font-weight:500;padding-left:4px}
        
        /* Back Link */
        .back-link{color:#3b82f6;font-weight:600;text-decoration:none;display:inline-flex;align-items:center;gap:8px;transition:.3s;padding:8px 12px;border-radius:8px}
        .back-link:hover{color:#60a5fa;background:rgba(59,130,246,.08);transform:translateY(-1px)}
        /* Top-right toast container */
        .toast-top-right{position:fixed;top:1rem;right:1rem;z-index:1100;display:flex;flex-direction:column;gap:.75rem}
        .toast{min-width:240px}
    </style>
</head>
<body>
    @if(request()->is('students*'))
    <nav class="navbar site-navbar navbar-expand-lg sticky-top shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-graduation-cap me-2"></i>Student CRUD
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('students.index')?'active':'' }}" href="{{ route('students.index') }}">
                            <i class="fas fa-users me-1"></i>Students
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