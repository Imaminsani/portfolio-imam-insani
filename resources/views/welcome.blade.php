<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->full_name ?? 'Muhammad Imam Insani' }} - Portofolio</title>
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
            --surface-bg: #111113;
            --accent-color: #3b82f6;
            --accent-hover: #60a5fa;
            --text-main: #ffffff;
            --text-muted: #d1d5db;
            --border-color: #27272a;
        }

        body {
            background-color: var(--primary-bg);
            color: var(--text-main);
            font-family: 'Outfit', sans-serif;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        .text-muted {
            color: var(--text-muted) !important;
        }

        /* Ambient Glow background */
        .ambient-glow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
            pointer-events: none;
        }

        .glow-1 {
            position: absolute;
            top: -10%;
            right: -5%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, rgba(9, 9, 11, 0) 70%);
            filter: blur(60px);
        }

        .glow-2 {
            position: absolute;
            bottom: 10%;
            left: -5%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.1) 0%, rgba(9, 9, 11, 0) 70%);
            filter: blur(50px);
        }

        .navbar {
            backdrop-filter: blur(10px);
            background-color: rgba(9, 9, 11, 0.8);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--text-main) !important;
            letter-spacing: -0.02em;
        }

        .nav-link {
            color: var(--text-muted) !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--accent-color) !important;
        }

        /* Hero Section */
        .hero-section {
            padding: 100px 0 80px;
            text-align: center;
        }

        .hero-title {
            font-size: clamp(2.5rem, 8vw, 4.5rem);
            font-weight: 800;
            margin-bottom: 1.5rem;
            letter-spacing: -0.04em;
            background: linear-gradient(to bottom, #ffffff, #e2e8f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 10px 30px rgba(255, 255, 255, 0.1);
        }

        .profile-img-container {
            position: relative;
            width: 180px;
            height: 180px;
            margin: 0 auto 2rem;
        }

        .profile-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid var(--surface-bg);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            z-index: 2;
            position: relative;
        }

        .profile-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 110%;
            height: 110%;
            background: var(--accent-color);
            filter: blur(30px);
            opacity: 0.3;
            border-radius: 50%;
            z-index: 1;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 3rem;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 40px;
            height: 4px;
            background-color: var(--accent-color);
            border-radius: 2px;
        }

        /* Content Cards */
        .card-portfolio {
            background-color: var(--surface-bg);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            height: 100%;
            overflow: hidden;
        }

        .card-portfolio:hover {
            transform: translateY(-10px);
            border-color: var(--accent-color);
            box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.5);
        }

        .card-img-wrapper {
            height: 300px;
            overflow: hidden;
            background-color: #111113;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.6s ease;
            background-color: #000;
        }

        .card-portfolio:hover .card-img-wrapper img {
            transform: scale(1.1);
        }

        .card-body-custom {
            padding: 1.5rem;
        }

        .card-tag {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--accent-color);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 0.75rem;
            display: block;
        }

        .btn-visit {
            background-color: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-main);
            padding: 0.5rem 1.2rem;
            border-radius: 10px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-visit:hover {
            background-color: white;
            color: black;
            border-color: white;
        }

        /* Footer */
        footer {
            padding: 60px 0;
            border-top: 1px solid var(--border-color);
            text-align: center;
        }

        .social-link {
            font-size: 1.5rem;
            color: var(--text-muted);
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .social-link:hover {
            color: var(--accent-color);
        }
    </style>
</head>
<body>

    <div class="ambient-glow">
        <div class="glow-1"></div>
        <div class="glow-2"></div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">IMAM.</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto text-center py-3 py-lg-0">
                    <li class="nav-item">
                        <a class="nav-link px-lg-3" href="#projects">Proyek</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-lg-3" href="#certificates">Sertifikat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-lg-3" href="#activities">Aktivitas</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link px-lg-3 text-primary" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link px-lg-3" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section container">
        <div class="profile-img-container">
            <div class="profile-glow"></div>
            @if($user->profile_photo)
                <img src="{{ asset('uploads/' . $user->profile_photo) }}" alt="Imam" class="profile-img">
            @else
                <div class="profile-img d-flex align-items-center justify-content-center bg-dark text-muted">
                    <i class="bi bi-person" style="font-size: 4rem;"></i>
                </div>
            @endif
        </div>
        <h1 class="hero-title">{{ $user->full_name ?? 'Muhammad Imam Insani' }}</h1>
        <div class="col-lg-6 mx-auto">
            <p class="text-white fs-5 mb-5 opacity-90">
                {{ $user->about_me ?? 'I build beautiful, high-performance web applications using Laravel and modern frontend technologies.' }}
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#projects" class="btn btn-primary px-4 py-2 rounded-pill fw-bold shadow">Lihat Proyek</a>
                <a href="#contact" class="btn btn-outline-light px-4 py-2 rounded-pill fw-bold">Kontak</a>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="container py-5 mt-5">
        <h2 class="section-title text-center d-block mx-auto">Hasil Proyek</h2>
        <div class="row g-5 mt-2 justify-content-center">
            @forelse($projects as $project)
                <div class="col-lg-6">
                    <div class="card-portfolio">
                        <div class="card-img-wrapper">
                            @if($project->image)
                                <img src="{{ asset('uploads/' . $project->image) }}" alt="{{ $project->title }}">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-dark opacity-50">
                                    <i class="bi bi-code-slash text-muted h1"></i>
                                </div>
                            @endif
                        </div>
                        <div class="card-body-custom p-4">
                            <span class="card-tag">Project</span>
                            <h3 class="fw-bold mb-3">{{ $project->title }}</h3>
                            <p class="text-muted mb-4">
                                {{ $project->description }}
                            </p>
                            @if($project->link)
                                <a href="{{ $project->link }}" target="_blank" class="btn btn-primary rounded-pill px-4">
                                    Lihat Project <i class="bi bi-arrow-up-right ms-1"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    <p>Belum ada proyek yang dipublikasikan.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Certificates Section -->
    <section id="certificates" class="container py-5">
        <h2 class="section-title text-center d-block mx-auto">Sertifikasi</h2>
        <div class="row g-4 mt-2 justify-content-center">
            @forelse($certificates as $cert)
                <div class="col-lg-6">
                    <div class="card-portfolio overflow-hidden">
                        @if($cert->image)
                            <div class="card-img-wrapper" style="height: 250px;">
                                <img src="{{ asset('uploads/' . $cert->image) }}" alt="{{ $cert->title }}">
                            </div>
                        @else
                            <div class="p-4 d-flex align-items-center gap-3">
                                <div style="width: 60px; height: 60px; background: rgba(59, 130, 246, 0.1); border-radius: 12px;" class="d-flex align-items-center justify-content-center">
                                    <i class="bi bi-patch-check-fill text-primary h3 mb-0"></i>
                                </div>
                            </div>
                        @endif
                        <div class="p-4">
                            <h4 class="fw-bold mb-1">{{ $cert->title }}</h4>
                            <p class="text-muted mb-0">Diterbitkan oleh: <span class="text-white fw-bold">{{ $cert->issued_by ?? 'N/A' }}</span></p>
                            <p class="text-muted small mt-2">{{ $cert->issue_date ? \Carbon\Carbon::parse($cert->issue_date)->format('M Y') : '' }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">Belum ada sertifikat.</p>
            @endforelse
        </div>
    </section>

    <!-- Activities Section -->
    <section id="activities" class="container py-5">
        <h2 class="section-title text-center d-block mx-auto">Aktivitas & Event</h2>
        <div class="row g-4 mt-2">
            @forelse($activities as $activity)
                <div class="col-md-12">
                    <div class="card-portfolio">
                        <div class="row g-0 align-items-center">
                            @if($activity->image)
                                <div class="col-md-4">
                                    <div class="card-img-wrapper" style="height: 250px; border-radius: 20px 0 0 20px;">
                                        <img src="{{ asset('uploads/' . $activity->image) }}" alt="{{ $activity->title }}">
                                    </div>
                                </div>
                            @endif
                            <div class="{{ $activity->image ? 'col-md-8' : 'col-12' }} p-4">
                                <div class="d-flex align-items-center gap-4">
                                    <div class="activity-date flex-shrink-0 text-center" style="width: 80px;">
                                        <span class="d-block h3 fw-bold mb-0 text-primary">{{ $activity->date ? \Carbon\Carbon::parse($activity->date)->format('d') : '' }}</span>
                                        <span class="text-muted text-uppercase small">{{ $activity->date ? \Carbon\Carbon::parse($activity->date)->format('M Y') : '' }}</span>
                                    </div>
                                    <div class="vr bg-secondary d-none d-md-block" style="height: 60px;"></div>
                                    <div>
                                        <h3 class="fw-bold mb-2">{{ $activity->title }}</h3>
                                        <p class="text-muted mb-0 fs-5">{{ $activity->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">Belum ada aktivitas.</p>
            @endforelse
        </div>
    </section>

    <footer id="contact">
        <div class="container">
            <h3 class="fw-bold mb-4">Mari Terhubung!</h3>
            <div class="mb-4">
                <a href="#" class="social-link"><i class="bi bi-github"></i></a>
                <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
                <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                <a href="mailto:{{ $user->email }}" class="social-link"><i class="bi bi-envelope-at-fill"></i></a>
            </div>
            <p class="text-muted">&copy; {{ date('Y') }} Muhammad Imam Insani. All rights reserved.</p>
            <p class="text-muted small">Crafted with Laravel & Bootstrap</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
