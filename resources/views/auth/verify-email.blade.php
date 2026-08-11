<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Confirmação de E-mail</title>
  <style>
    :root{
      --bg1: #667eea;
      --bg2: #764ba2;
      --card: #ffffff;
      --muted: #666;
      --accent: #667eea;
      --accent-2: #764ba2;
      --success-bg: #ecfdf5;
      --success-text: #065f46;
    }
    *{box-sizing:border-box}
    body{
      margin:0;
      min-height:100vh;
      font-family: Inter, "Segoe UI", Roboto, system-ui, -apple-system, "Helvetica Neue", Arial;
      background: linear-gradient(135deg,var(--bg1),var(--bg2));
      display:flex;
      align-items:center;
      justify-content:center;
      padding:24px;
      color:#222;
    }
    .card{
      width:100%;
      max-width:520px;
      background:var(--card);
      border-radius:16px;
      padding:34px;
      box-shadow: 0 20px 50px rgba(12,15,30,0.35);
      text-align:center;
      animation:pop .6s cubic-bezier(.2,.9,.3,1);
    }
    @keyframes pop{
      from {opacity:0; transform: translateY(18px) scale(.995);}
      to {opacity:1; transform: translateY(0) scale(1);}
    }
    .logo{
      width:110px;
      height:110px;
      border-radius:999px;
      object-fit:cover;
      border:5px solid rgba(102,126,234,0.18);
      box-shadow: 0 8px 30px rgba(102,126,234,0.18);
      margin:0 auto 18px;
      background:#fff;
    }
    h1{
      margin:0 0 12px;
      font-size:1.45rem;
      color:#111827;
      letter-spacing: -0.2px;
    }
    p.lead{
      margin:0 0 20px;
      color:var(--muted);
      line-height:1.6;
      font-size:0.98rem;
    }
    .notice{
      margin: 14px 0;
      padding:12px 14px;
      border-radius:10px;
      font-size:0.92rem;
      display:inline-block;
    }
    .notice.success{
      background: var(--success-bg);
      color: var(--success-text);
      box-shadow: 0 6px 18px rgba(6,95,70,0.06);
    }
    .form-resend{ margin-top:16px; }
    .btn{
      display:inline-block;
      padding:12px 20px;
      border-radius:10px;
      border:0;
      font-weight:600;
      cursor:pointer;
      font-size:0.98rem;
      transition:all .18s ease;
      text-decoration:none;
    }
    .btn-primary{
      background: linear-gradient(90deg,var(--accent),var(--accent-2));
      color:#fff;
      box-shadow: 0 12px 30px rgba(118,75,162,0.16);
    }
    .btn-primary:hover{ transform:translateY(-3px) scale(1.01); box-shadow: 0 18px 40px rgba(118,75,162,0.18); }
    .actions{
      margin-top:18px;
      display:flex;
      gap:12px;
      justify-content:center;
      align-items:center;
      flex-wrap:wrap;
    }
    .link{
      color:var(--accent);
      text-decoration:none;
      font-weight:600;
      font-size:0.95rem;
    }
    .link.logout{
      color:#ef4444;
    }
    .link:hover{ text-decoration:underline; color:var(--accent-2); }
    @media (max-width:520px){
      .card{ padding:22px; border-radius:12px; }
      .logo{ width:92px; height:92px; }
    }
  </style>
</head>
<body>
  <div class="card" role="main" aria-labelledby="titulo">
    <img src="{{ asset('inicio/assets/img/icon/pgf.png') }}" alt="Logo" class="logo">

    <h1 id="titulo">Confirme o seu endereço de e-mail</h1>

    @if (session('status') === 'verification-link-sent')
      <div class="notice success" role="status">
        ✅ Um novo link de verificação foi enviado para o seu e-mail. Verifique a caixa de entrada ou spam.
      </div>
    @endif

    <p class="lead">
      Antes de continuar, confirme o seu e-mail clicando no link que enviamos. Se não recebeu, peça o reenvio abaixo.
    </p>

    <!-- Reenviar link: rota named "verification.send" (POST) -->
    <form method="POST" action="{{ route('verification.send') }}" class="form-resend" style="margin-bottom:0;">
      @csrf
      <button type="submit" class="btn btn-primary" aria-label="Reenviar link de verificação">
        📩 Reenviar link de verificação
      </button>
    </form>

    <div class="actions" style="margin-top:18px;">
      <!-- Editar perfil: rota named "profile.show" (GET) -->
      {{-- <a href="{{ route('profile.show') }}" class="link">✏️ Editar perfil</a>--}}

      <!-- Sair: rota named "logout" (POST) -->
      <form method="POST" action="{{ route('logout') }}" style="display:inline;">
        @csrf
        <button type="submit" class="link logout" style="background:none;border:none;padding:0;cursor:pointer;font-weight:600;">
          🚪 Sair
        </button>
      </form>
    </div>
  </div>
</body>
</html>
