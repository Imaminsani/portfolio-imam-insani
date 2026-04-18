<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Portfolio profesional {{ $about->name ?? 'Muhammad Imam Insani' }} — Software Engineer & Web Developer.">
  <title>{{ $about->name ?? 'Muhammad Imam Insani' }} | Software Engineer</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- 3D & Animation Libraries -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
</head>
<body>

  <!-- Background Canvas -->
  <canvas id="bg-canvas"></canvas>

  {{-- ── NAVBAR ── --}}
  <nav class="navbar" id="navbar">
    <div class="container navbar-inner">
      <a href="/" class="navbar-logo">
        <div class="logo-box">I</div>
        <span>{{ $about->name ?? 'Imam Insani' }}<span class="gradient-text">.</span></span>
      </a>

      <div class="navbar-links">
        <a href="#about">About</a>
        <a href="#projects">Projects</a>
        <a href="#certificates">Certificates</a>
        <a href="#activities">Events</a>
        <a href="#contact" class="btn-premium btn-fill" style="padding:0.5rem 1.4rem;font-size:0.85rem;">Contact</a>
      </div>

      <button class="nav-toggle" id="nav-toggle" aria-label="Toggle menu">
        <i class="fa-solid fa-bars-staggered"></i>
      </button>
    </div>
  </nav>

  <!-- Mobile Overlay -->
  <div class="mobile-overlay" id="mobile-overlay">
    <a href="#about" class="overlay-link">About</a>
    <a href="#projects" class="overlay-link">Projects</a>
    <a href="#certificates" class="overlay-link">Certificates</a>
    <a href="#activities" class="overlay-link">Events</a>
    <a href="#contact" class="overlay-link gradient-text">Contact Me</a>
  </div>

  {{-- ── HERO ── --}}
  <section class="hero" id="home">
    <div class="container">
      <div class="hero-eyebrow">
        <div class="badge-premium reveal">
          <i class="fa-solid fa-circle" style="font-size:0.45rem;color:#22c55e;"></i>
          Open for Opportunities
        </div>
      </div>
      <h1 class="hero-title reveal">
        {{ $about->hero_title ?? 'Membangun Masa Depan Digital yang Elegan.' }}
      </h1>
      <p class="hero-description reveal">
        {{ $about->hero_subtitle ?? 'Saya adalah Muhammad Imam Insani, seorang Software Engineer yang berfokus pada performa, estetika, dan kode yang bersih.' }}
      </p>
      <div class="hero-actions reveal">
        <a href="#projects" class="btn-premium btn-fill"><i class="fa-solid fa-eye"></i> Lihat Projects</a>
        <a href="#contact" class="btn-premium btn-outline"><i class="fa-solid fa-paper-plane"></i> Hubungi Saya</a>
      </div>
    </div>
  </section>

  {{-- ── ABOUT ── --}}
  @if($about->about_description || $about->profile_image)
  <section class="section" id="about">
    <div class="container">
      <div class="about-grid">
        {{-- Image --}}
        <div class="about-image-wrap reveal">
          @if($about->profile_image)
            <img src="{{ $about->profile_image == 'profile.png' ? asset('img/profile.png') : asset('storage/' . $about->profile_image) }}"
                 alt="{{ $about->name ?? 'Profile' }}">
          @else
            <div class="about-image-placeholder">👨‍💻</div>
          @endif
        </div>

        {{-- Content --}}
        <div class="about-content">
          <div class="badge-premium reveal">{{ $about->about_eyebrow ?? 'Who I Am' }}</div>
          <h2 class="reveal" style="font-size:var(--font-h2);font-weight:800;line-height:1.1;letter-spacing:-0.03em;margin-top:0.75rem;">
            {{ $about->about_title ?? 'Seni Mengubah' }} <span class="gradient-text">Logika</span> menjadi Visual.
          </h2>
          @if($about->about_description)
            <p class="about-description reveal">{{ $about->about_description }}</p>
          @endif

          {{-- Social / Action buttons --}}
          <div class="hero-actions reveal" style="margin-top:2rem;">
            @if($about->github_url)
              <a href="{{ $about->github_url }}" target="_blank" class="btn-premium btn-outline">
                <i class="fa-brands fa-github"></i> GitHub
              </a>
            @endif
            @if($about->linkedin_url)
              <a href="{{ $about->linkedin_url }}" target="_blank" class="btn-premium btn-outline">
                <i class="fa-brands fa-linkedin"></i> LinkedIn
              </a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
  @endif

  {{-- ── PROJECTS ── --}}
  <section class="section" id="projects">
    <div class="container">
      <div class="section-header">
        <div class="badge-premium reveal">Portfolio</div>
        <h2 class="reveal">Selected <span class="gradient-text">Works</span></h2>
      </div>

      <div class="projects-grid">
        @forelse ($projects as $project)
          <div class="project-card-premium reveal">
            <div class="project-image-box">
              @if($project->image)
                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
              @else
                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--bg-card);font-size:3.5rem;">💻</div>
              @endif
            </div>
            <div class="project-info">
              @if($project->is_featured)
                <span style="display:inline-flex;align-items:center;gap:0.3rem;font-size:0.68rem;font-weight:700;color:var(--accent-amber);letter-spacing:0.08em;text-transform:uppercase;margin-bottom:0.5rem;">
                  <i class="fa-solid fa-star"></i> Featured
                </span>
              @endif
              <h3>{{ $project->title }}</h3>
              <p>{{ Str::limit($project->description, 110) }}</p>
              @if($project->link)
                <a href="{{ $project->link }}" target="_blank" class="btn-premium btn-outline" style="padding:0.5rem 1.2rem;font-size:0.83rem;">
                  View Project <i class="fa-solid fa-arrow-right"></i>
                </a>
              @endif
            </div>
          </div>
        @empty
          <div style="text-align:center;grid-column:1/-1;padding:5rem;color:var(--text-dim);">
            <i class="fa-solid fa-code" style="font-size:3rem;margin-bottom:1rem;display:block;"></i>
            Projects coming soon.
          </div>
        @endforelse
      </div>
    </div>
  </section>

  {{-- ── CERTIFICATES ── --}}
  <section class="section" id="certificates">
    <div class="container">
      <div class="section-header" style="text-align:center;">
        <div class="badge-premium reveal">Achievements</div>
        <h2 class="reveal">Verified <span class="gradient-text">Skills</span></h2>
      </div>

      <div class="certificates-grid">
        @forelse ($certificates as $cert)
          <div class="cert-card-premium reveal">
            <div class="cert-image-box">
              @if($cert->image)
                <img src="{{ asset('storage/' . $cert->image) }}" alt="{{ $cert->title }}">
              @else
                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;background:var(--bg-darker);font-size:3.5rem;">🎓</div>
              @endif
            </div>
            <div class="cert-body">
              <h3>{{ $cert->title }}</h3>
              <p class="cert-meta">{{ $cert->issuer }} &middot; {{ $cert->year }}</p>
              @if($cert->link)
                <a href="{{ $cert->link }}" target="_blank" class="cert-verify">
                  Verify Credential <i class="fa-solid fa-external-link" style="font-size:0.7rem;"></i>
                </a>
              @endif
            </div>
          </div>
        @empty
          <p style="text-align:center;grid-column:1/-1;color:var(--text-dim);padding:3rem;">Coming soon.</p>
        @endforelse
      </div>
    </div>
  </section>

  {{-- ── ACTIVITIES ── --}}
  <section class="section" id="activities">
    <div class="container">
      <div class="section-header">
        <div class="badge-premium reveal">Experiences</div>
        <h2 class="reveal">Event & <span class="gradient-text">Kegiatan</span></h2>
      </div>

      <div class="activities-grid">
        @forelse ($activities as $activity)
          <div class="activity-card reveal">
            <div class="activity-image-box">
              @if($activity->image)
                <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->title }}">
              @else
                <div class="activity-image-placeholder">📅</div>
              @endif
            </div>
            <div class="activity-body">
              <span class="activity-type-badge">{{ $activity->type }}</span>
              <h3>{{ $activity->title }}</h3>
              <p class="activity-meta">
                <i class="fa-solid fa-location-dot" style="font-size:0.75rem;"></i>
                {{ $activity->location ?? 'Indonesia' }} &middot; {{ $activity->year }}
              </p>
              @if($activity->description)
                <p>{{ Str::limit($activity->description, 120) }}</p>
              @endif
            </div>
          </div>
        @empty
          <p style="grid-column:1/-1;text-align:center;color:var(--text-dim);padding:3rem;">Updated regularly.</p>
        @endforelse
      </div>
    </div>
  </section>

  {{-- ── CONTACT ── --}}
  <section class="section" id="contact" style="padding-bottom:8rem;">
    <div class="container">
      <div class="contact-wrapper reveal">
        <h2>
          Ready to build something <span class="gradient-text">Amazing?</span>
        </h2>
        <p>
          Hubungi saya untuk kolaborasi proyek, freelance, atau hanya sekedar menyapa. Saya selalu terbuka untuk peluang baru.
        </p>
        <div class="contact-actions">
          <a href="mailto:{{ $about->email ?? 'imaminsani@email.com' }}" class="btn-premium btn-fill">
            <i class="fa-solid fa-paper-plane"></i> Kirim Email
          </a>
          @if($about->github_url)
            <a href="{{ $about->github_url }}" target="_blank" class="btn-premium btn-outline">
              <i class="fa-brands fa-github"></i> GitHub
            </a>
          @endif
          @if($about->linkedin_url)
            <a href="{{ $about->linkedin_url }}" target="_blank" class="btn-premium btn-outline">
              <i class="fa-brands fa-linkedin"></i> LinkedIn
            </a>
          @endif
        </div>
      </div>
    </div>
  </section>

  {{-- ── FOOTER ── --}}
  <footer class="site-footer">
    <div class="container">
      <div class="footer-logo">
        <div style="width:28px;height:28px;background:var(--accent-gradient);border-radius:7px;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:0.8rem;">I</div>
        {{ $about->name ?? 'Muhammad Imam Insani' }}
      </div>
      <p class="footer-copy">&copy; {{ date('Y') }} {{ $about->name ?? 'Muhammad Imam Insani' }}. All rights reserved.</p>
    </div>
  </footer>

  <!-- Scripts -->
  <script>
    const isMobile = window.innerWidth < 768;

    // ── THREE.JS BACKGROUND ──
    const canvas = document.querySelector('#bg-canvas');
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: !isMobile });

    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.setSize(window.innerWidth, window.innerHeight);
    camera.position.setZ(30);

    const pointsCount = isMobile ? 350 : 900;
    const posArray = new Float32Array(pointsCount * 3);
    for (let i = 0; i < pointsCount * 3; i++) posArray[i] = (Math.random() - 0.5) * 100;

    const geometry = new THREE.BufferGeometry();
    geometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));

    const material = new THREE.PointsMaterial({
      size: isMobile ? 0.1 : 0.06,
      color: 0x6366f1,
      transparent: true,
      opacity: 0.55
    });

    const mesh = new THREE.Points(geometry, material);
    scene.add(mesh);

    (function animate() {
      requestAnimationFrame(animate);
      mesh.rotation.y += isMobile ? 0.0004 : 0.0008;
      mesh.rotation.x += 0.0002;
      renderer.render(scene, camera);
    })();

    window.addEventListener('resize', () => {
      camera.aspect = window.innerWidth / window.innerHeight;
      camera.updateProjectionMatrix();
      renderer.setSize(window.innerWidth, window.innerHeight);
    });

    // ── MOBILE NAV ──
    const navToggle = document.getElementById('nav-toggle');
    const mobileOverlay = document.getElementById('mobile-overlay');

    navToggle.addEventListener('click', () => {
      const open = mobileOverlay.classList.toggle('active');
      navToggle.innerHTML = open
        ? '<i class="fa-solid fa-xmark"></i>'
        : '<i class="fa-solid fa-bars-staggered"></i>';
      document.body.style.overflow = open ? 'hidden' : '';
    });

    document.querySelectorAll('.overlay-link').forEach(link => {
      link.addEventListener('click', () => {
        mobileOverlay.classList.remove('active');
        navToggle.innerHTML = '<i class="fa-solid fa-bars-staggered"></i>';
        document.body.style.overflow = '';
      });
    });

    // ── NAVBAR SCROLL ──
    window.addEventListener('scroll', () => {
      document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 40);
    });

    // ── GSAP SCROLL ANIMATIONS ──
    gsap.registerPlugin(ScrollTrigger);

    document.querySelectorAll('.reveal').forEach(el => {
      gsap.fromTo(el,
        { opacity: 0, y: isMobile ? 15 : 28 },
        {
          opacity: 1, y: 0,
          duration: isMobile ? 0.8 : 1.1,
          ease: 'expo.out',
          scrollTrigger: {
            trigger: el,
            start: 'top 92%',
            toggleActions: 'play none none none'
          }
        }
      );
    });
  </script>
</body>
</html>
