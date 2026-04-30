<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Portfolio</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --primary-bg: #09090b;
            --surface-bg: #18181b;
            --accent-color: #3b82f6;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border-color: #27272a;
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--primary-bg);
            color: var(--text-main);
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background-color: var(--surface-bg);
            border-right: 1px solid var(--border-color);
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            padding: 1.5rem;
        }

        .sidebar-brand {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 2.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text-main);
            text-decoration: none;
        }

        .nav-link {
            color: var(--text-muted);
            padding: 0.75rem 1rem;
            border-radius: 10px;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            color: var(--text-main);
            background-color: rgba(255, 255, 255, 0.05);
        }

        .nav-link.active {
            color: var(--text-main);
            background-color: rgba(59, 130, 246, 0.1);
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .nav-link i {
            font-size: 1.1rem;
        }

        /* Main Content area */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem;
            min-height: 100vh;
        }

        .top-navbar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .card-custom {
            background-color: var(--surface-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.5rem;
        }

        .btn-custom {
            background: linear-gradient(to right, var(--accent-color), #60a5fa);
            border: none;
            color: white;
            font-weight: 500;
            padding: 0.6rem 1.2rem;
            border-radius: 10px;
        }

        .form-control, .form-select {
            background-color: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            border-radius: 10px;
            padding: 0.7rem 1rem;
        }

        .form-control:focus, .form-select:focus {
            background-color: rgba(255, 255, 255, 0.05);
            border-color: var(--accent-color);
            color: var(--text-main);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #34d399;
            border-radius: 12px;
        }
        
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <i class="bi bi-stack text-primary"></i>
            <span>Admin Panel</span>
        </a>

        <div class="nav flex-column">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.projects.index') }}" class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                <i class="bi bi-folder2"></i>
                <span>Proyek</span>
            </a>
            <a href="{{ route('admin.certificates.index') }}" class="nav-link {{ request()->routeIs('admin.certificates.*') ? 'active' : '' }}">
                <i class="bi bi-patch-check"></i>
                <span>Sertifikat</span>
            </a>
            <a href="{{ route('admin.activities.index') }}" class="nav-link {{ request()->routeIs('admin.activities.*') ? 'active' : '' }}">
                <i class="bi bi-calendar-event"></i>
                <span>Aktivitas</span>
            </a>
            <a href="{{ route('admin.profile.index') }}" class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                <i class="bi bi-person"></i>
                <span>Profil</span>
            </a>
            
            <div class="mt-auto pt-5">
                <hr style="border-color: var(--border-color);">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link border-0 bg-transparent w-100 text-danger">
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="top-navbar">
            <div class="text-muted d-flex align-items-center gap-2">
                <span>Halo, {{ Auth::user()->full_name ?? Auth::user()->name }}</span>
                <i class="bi bi-circle-fill text-success" style="font-size: 8px;"></i>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
