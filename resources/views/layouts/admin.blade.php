<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin') — Admin Panel Portfolio</title>
  <meta name="description" content="Admin panel for managing portfolio content.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <style>
    body { background: #040218; }
  </style>
  @stack('head')
</head>
<body>

  {{-- Sidebar Overlay (mobile) --}}
  <div class="sidebar-overlay" id="sidebar-overlay" onclick="toggleSidebar()"></div>

  {{-- ── SIDEBAR ── --}}
  <aside class="sidebar" id="admin-sidebar">

    <div class="sidebar-header">
      <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
        <div class="sidebar-logo-icon">I</div>
        <span>Admin Panel</span>
      </a>
      <button class="sidebar-close" onclick="toggleSidebar()" aria-label="Close sidebar">
        <i class="fa-solid fa-xmark"></i>
      </button>
    </div>

    <nav class="sidebar-nav">
      <a href="{{ route('admin.dashboard') }}"
         class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fa-solid fa-chart-pie"></i>
        <span>Dashboard</span>
      </a>

      <span class="sidebar-section-label">Master Data</span>
      <a href="{{ route('admin.projects.index') }}"
         class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
        <i class="fa-solid fa-laptop-code"></i>
        <span>Projects</span>
      </a>
      <a href="{{ route('admin.certificates.index') }}"
         class="sidebar-link {{ request()->routeIs('admin.certificates.*') ? 'active' : '' }}">
        <i class="fa-solid fa-award"></i>
        <span>Sertifikat</span>
      </a>
      <a href="{{ route('admin.activities.index') }}"
         class="sidebar-link {{ request()->routeIs('admin.activities.*') ? 'active' : '' }}">
        <i class="fa-solid fa-calendar-star"></i>
        <span>Kegiatan</span>
      </a>

      <span class="sidebar-section-label">Identitas</span>
      <a href="{{ route('admin.about.edit') }}"
         class="sidebar-link {{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
        <i class="fa-solid fa-address-card"></i>
        <span>Profil & Bio</span>
      </a>
      <a href="{{ route('profile.edit') }}"
         class="sidebar-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
        <i class="fa-solid fa-user-gear"></i>
        <span>Akun Admin</span>
      </a>

      <span class="sidebar-section-label">Lainnya</span>
      <a href="/" target="_blank" class="sidebar-link">
        <i class="fa-solid fa-arrow-up-right-from-square"></i>
        <span>Lihat Portfolio</span>
      </a>
    </nav>

    <div class="sidebar-footer">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="sidebar-link" style="width:100%;border:none;background:none;cursor:pointer;text-align:left;">
          <i class="fa-solid fa-right-from-bracket"></i>
          <span>Keluar</span>
        </button>
      </form>
    </div>

  </aside>

  {{-- ── MAIN CONTENT ── --}}
  <main class="admin-main" id="admin-main">

    {{-- Topbar --}}
    <header class="topbar">
      <div class="topbar-left">
        <button class="mobile-sidebar-toggle" id="mobile-sidebar-toggle" onclick="toggleSidebar()" aria-label="Toggle sidebar">
          <i class="fa-solid fa-bars"></i>
        </button>
        <h1 class="topbar-title">@yield('title', 'Dashboard')</h1>
      </div>
      <div class="topbar-right">
        @yield('actions')
        <span class="topbar-user-name">{{ Auth::user()->name }}</span>
        <div class="topbar-avatar">
          {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
      </div>
    </header>

    {{-- Content --}}
    <div class="content-area">
      @if(session('success'))
        <div class="admin-alert admin-alert-success">
          <i class="fa-solid fa-circle-check"></i>
          {{ session('success') }}
        </div>
      @endif

      @if(session('error'))
        <div class="admin-alert admin-alert-error">
          <i class="fa-solid fa-circle-exclamation"></i>
          {{ session('error') }}
        </div>
      @endif

      @yield('content')
    </div>

  </main>

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('admin-sidebar');
      const overlay = document.getElementById('sidebar-overlay');
      const isActive = sidebar.classList.toggle('active');
      overlay.classList.toggle('active', isActive);
      document.body.style.overflow = isActive ? 'hidden' : '';
    }

    // Apply correct classes based on viewport
    function applyResponsive() {
      const main = document.getElementById('admin-main');
      if (window.innerWidth <= 1024) {
        main.style.marginLeft = '0';
      } else {
        const sidebar = document.getElementById('admin-sidebar');
        sidebar.classList.remove('active');
        document.getElementById('sidebar-overlay').classList.remove('active');
        document.body.style.overflow = '';
      }
    }
    window.addEventListener('resize', applyResponsive);
    applyResponsive();
  </script>

  @stack('scripts')
</body>
</html>
