<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login — Portfolio Imam</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Inter', sans-serif;
      background: #030712;
      color: #f8fafc;
      min-height: 100vh;
      display: flex;
      overflow: hidden;
    }

    /* Left Panel */
    .left-panel {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      padding: 4rem;
      background:
        radial-gradient(ellipse at 30% 50%, rgba(99,102,241,0.15) 0%, transparent 60%),
        radial-gradient(ellipse at 80% 80%, rgba(6,182,212,0.08) 0%, transparent 50%),
        #030712;
      position: relative;
      overflow: hidden;
    }

    .left-panel::before {
      content: '';
      position: absolute;
      inset: 0;
      background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.02'%3E%3Ccircle cx='30' cy='30' r='1'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
      pointer-events: none;
    }

    .panel-logo {
      display: flex; align-items: center; gap: 0.75rem;
      font-size: 1.5rem; font-weight: 800;
      margin-bottom: 4rem; position: relative; z-index: 1;
    }
    .panel-logo-icon {
      width: 44px; height: 44px;
      background: linear-gradient(135deg, #6366f1, #8b5cf6);
      border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      font-size: 1.2rem;
    }

    .panel-heading {
      position: relative; z-index: 1;
      max-width: 420px;
    }
    .panel-heading .tag {
      display: inline-flex; align-items: center; gap: 0.4rem;
      padding: 0.3rem 0.8rem;
      background: rgba(99,102,241,0.15);
      border: 1px solid rgba(99,102,241,0.3);
      border-radius: 99px;
      font-size: 0.72rem; font-weight: 600; letter-spacing: 0.1em;
      text-transform: uppercase; color: #818cf8;
      margin-bottom: 1.5rem;
    }
    .panel-heading h1 {
      font-size: 3rem; font-weight: 900; line-height: 1.15;
      letter-spacing: -0.03em; margin-bottom: 1.25rem;
    }
    .panel-heading h1 span {
      background: linear-gradient(135deg, #818cf8, #06b6d4);
      -webkit-background-clip: text;
      background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    .panel-heading p {
      color: #64748b; font-size: 1rem; line-height: 1.7;
    }

    /* Code Card */
    .code-card {
      position: absolute; bottom: 2.5rem; right: 2.5rem;
      background: #0a0f1e;
      border: 1px solid rgba(255,255,255,0.08);
      border-radius: 12px; padding: 1.25rem 1.5rem;
      font-family: 'JetBrains Mono', monospace; font-size: 0.78rem;
      color: #64748b; z-index: 1;
      box-shadow: 0 20px 40px -10px rgba(0,0,0,0.5);
      min-width: 260px;
    }
    .code-card .kw { color: #c084fc; }
    .code-card .fn { color: #60a5fa; }
    .code-card .st { color: #34d399; }
    .code-card .cm { color: #475569; }
    .code-line { margin-bottom: 3px; }

    /* Right Panel (Form) */
    .right-panel {
      width: 480px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      background: #0a0f1e;
      border-left: 1px solid rgba(255,255,255,0.06);
      padding: 3rem 3rem;
    }

    .form-box { width: 100%; max-width: 360px; }

    .form-title {
      font-size: 1.75rem; font-weight: 800; letter-spacing: -0.02em;
      margin-bottom: 0.5rem;
    }
    .form-subtitle { color: #475569; font-size: 0.9rem; margin-bottom: 2.5rem; }

    .form-group { margin-bottom: 1.25rem; }
    .form-label {
      display: block; font-size: 0.82rem; font-weight: 600;
      color: #94a3b8; margin-bottom: 0.5rem;
    }
    .form-input {
      width: 100%;
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 10px;
      padding: 0.8rem 1rem;
      color: #f8fafc;
      font-family: 'Inter', sans-serif;
      font-size: 0.9rem;
      transition: all 0.2s;
      outline: none;
    }
    .form-input:focus {
      border-color: #6366f1;
      background: rgba(99,102,241,0.05);
      box-shadow: 0 0 0 3px rgba(99,102,241,0.15);
    }
    .form-input::placeholder { color: #334155; }

    .form-options {
      display: flex; justify-content: space-between; align-items: center;
      margin-bottom: 1.75rem;
    }
    .form-check { display: flex; align-items: center; gap: 0.5rem; }
    .form-check input[type="checkbox"] { accent-color: #6366f1; }
    .form-check label { font-size: 0.82rem; color: #64748b; cursor: pointer; }
    .form-forgot { font-size: 0.82rem; color: #6366f1; text-decoration: none; }
    .form-forgot:hover { color: #818cf8; }

    .btn-login {
      width: 100%;
      padding: 0.9rem;
      background: linear-gradient(135deg, #6366f1, #8b5cf6);
      border: none; border-radius: 10px;
      color: white; font-family: 'Inter', sans-serif;
      font-size: 0.95rem; font-weight: 700;
      cursor: pointer; transition: all 0.2s;
      display: flex; align-items: center; justify-content: center; gap: 0.5rem;
      box-shadow: 0 0 25px rgba(99,102,241,0.3);
    }
    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 0 40px rgba(99,102,241,0.4);
    }
    .btn-login:active { transform: translateY(0); }

    .form-back {
      display: flex; align-items: center; gap: 0.5rem;
      margin-bottom: 2rem;
      color: #475569; font-size: 0.82rem; text-decoration: none;
      transition: color 0.2s;
    }
    .form-back:hover { color: #94a3b8; }

    /* Error */
    .error-box {
      background: rgba(239,68,68,0.1);
      border: 1px solid rgba(239,68,68,0.3);
      border-radius: 8px; padding: 0.75rem 1rem;
      margin-bottom: 1.25rem;
      color: #fca5a5; font-size: 0.83rem;
      display: flex; align-items: center; gap: 0.5rem;
    }

    @media (max-width: 900px) {
      body { flex-direction: column; }
      .left-panel { display: none; }
      .right-panel { width: 100%; flex: 1; }
    }
  </style>
</head>
<body>

  {{-- Left Brand Panel --}}
  <div class="left-panel">
    <div class="panel-logo">
      <div class="panel-logo-icon">I</div>
      Portfolio Imam
    </div>

    <div class="panel-heading">
      <div class="tag">
        <i class="fa-solid fa-shield-halved"></i> Secure Admin
      </div>
      <h1>Kelola Portfolio<br>Anda dengan <span>Mudah</span></h1>
      <p>Tambah project, upload foto, dan update konten portfolio Anda tanpa menyentuh kode sama sekali.</p>
    </div>

    <div class="code-card">
      <div class="code-line"><span class="kw">class</span> Admin <span style="color:#fbbf24">{</span></div>
      <div class="code-line">&nbsp;&nbsp;<span class="fn">login</span>(<span class="st">'admin@portfolio.com'</span>)</div>
      <div class="code-line">&nbsp;&nbsp;<span class="cm">// Manage your content</span></div>
      <div class="code-line">&nbsp;&nbsp;<span class="fn">addProject</span>(<span class="st">$data</span>)</div>
      <div class="code-line"><span style="color:#fbbf24">}</span></div>
    </div>
  </div>

  {{-- Right Login Form --}}
  <div class="right-panel">
    <div class="form-box">
      <a href="/" class="form-back">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Portfolio
      </a>

      <h2 class="form-title">Selamat Datang 👋</h2>
      <p class="form-subtitle">Login untuk mengelola portfolio Anda</p>

      {{-- Session Status --}}
      @if (session('status'))
        <div class="error-box" style="background:rgba(16,185,129,0.1);border-color:rgba(16,185,129,0.3);color:#6ee7b7;">
          <i class="fa-solid fa-circle-check"></i> {{ session('status') }}
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Errors --}}
        @if ($errors->any())
          <div class="error-box">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ $errors->first() }}
          </div>
        @endif

        <div class="form-group">
          <label class="form-label" for="email">Email Address</label>
          <input id="email" type="email" name="email" class="form-input"
            placeholder="admin@portfolio.com"
            value="{{ old('email') }}" required autofocus>
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <input id="password" type="password" name="password" class="form-input"
            placeholder="••••••••" required>
        </div>

        <div class="form-options">
          <div class="form-check">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Ingat saya</label>
          </div>
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="form-forgot">Lupa password?</a>
          @endif
        </div>

        <button type="submit" class="btn-login">
          <i class="fa-solid fa-right-to-bracket"></i> Masuk ke Dashboard
        </button>
      </form>
    </div>
  </div>

</body>
</html>
