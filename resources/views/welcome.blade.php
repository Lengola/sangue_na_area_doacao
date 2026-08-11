
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Sangue na Área</title>

<link rel="shortcut icon" href="{{ asset('assets/img/icons8-blood-64.png') }}">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:#fafafa;
overflow-x:hidden;
}

/* Fundo animado */

.background{
position:fixed;
width:100%;
height:100%;
z-index:-1;
overflow:hidden;
}

.circle{
position:absolute;
border-radius:50%;
background:rgba(230,57,70,0.15);
animation:float 12s infinite linear;
}

.circle:nth-child(1){
width:300px;
height:300px;
top:10%;
left:-100px;
}

.circle:nth-child(2){
width:250px;
height:250px;
bottom:10%;
right:-80px;
animation-duration:18s;
}

@keyframes float{
0%{transform:translateY(0px);}
50%{transform:translateY(-40px);}
100%{transform:translateY(0px);}
}

/* Navbar */

header{
padding:20px 8%;
position:sticky;
top:0;
background:rgba(255,255,255,0.95);
backdrop-filter:blur(10px);
box-shadow:0 2px 20px rgba(0,0,0,.08);
z-index:999;
}

nav{
display:flex;
justify-content:space-between;
align-items:center;
}

.logo{
font-size:30px;
font-weight:700;
color:#e63946;
text-decoration:none;
}

.menu a{
text-decoration:none;
color:#444;
margin-left:25px;
font-weight:500;
transition:.3s;
}

.menu a:hover{
color:#e63946;
}

/* Hero */

.hero{
min-height:90vh;
display:flex;
justify-content:space-between;
align-items:center;
padding:0 8%;
}

.hero-text{
max-width:650px;
}

.hero-text h1{
font-size:65px;
line-height:1.1;
color:#1d3557;
margin-bottom:20px;
}

.hero-text span{
color:#e63946;
}

.hero-text p{
font-size:20px;
color:#555;
line-height:1.8;
margin-bottom:35px;
}

.btn{
padding:16px 35px;
border:none;
border-radius:50px;
cursor:pointer;
font-size:16px;
font-weight:600;
text-decoration:none;
display:inline-block;
transition:.4s;
}

.btn-primary{
background:#e63946;
color:white;
}

.btn-primary:hover{
transform:translateY(-5px);
box-shadow:0 15px 30px rgba(230,57,70,.35);
}

.btn-secondary{
background:white;
color:#e63946;
border:2px solid #e63946;
margin-left:15px;
}

.btn-secondary:hover{
background:#e63946;
color:white;
}

.hero-image{
font-size:250px;
animation:pulse 2s infinite;
}

@keyframes pulse{
0%{transform:scale(1);}
50%{transform:scale(1.08);}
100%{transform:scale(1);}
}

/* Estatísticas */

.stats{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:25px;
padding:80px 8%;
}

.stat-card{
background:rgba(255,255,255,.8);
backdrop-filter:blur(15px);
padding:35px;
border-radius:20px;
text-align:center;
box-shadow:0 10px 30px rgba(0,0,0,.08);
transition:.4s;
}

.stat-card:hover{
transform:translateY(-10px);
}

.stat-card h2{
font-size:40px;
color:#e63946;
}

.stat-card p{
color:#666;
}

/* Funcionalidades */

.section{
padding:90px 8%;
}

.section-title{
text-align:center;
margin-bottom:60px;
}

.section-title h2{
font-size:45px;
color:#1d3557;
}

.features{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(300px,1fr));
gap:30px;
}

.feature{
background:white;
padding:35px;
border-radius:20px;
box-shadow:0 8px 25px rgba(0,0,0,.08);
transition:.4s;
}

.feature:hover{
transform:translateY(-10px);
}

.feature h3{
margin-bottom:15px;
color:#e63946;
}

/* Impacto */

.impact{
background:linear-gradient(135deg,#e63946,#c1121f);
color:white;
padding:100px 8%;
text-align:center;
}

.impact h2{
font-size:50px;
margin-bottom:20px;
}

.impact p{
font-size:20px;
max-width:800px;
margin:auto;
line-height:1.8;
}

/* CTA */

.cta{
padding:100px 8%;
text-align:center;
}

.cta h2{
font-size:50px;
color:#1d3557;
margin-bottom:20px;
}

.cta p{
font-size:20px;
color:#666;
margin-bottom:30px;
}

footer{
background:#111827;
color:white;
padding:30px;
text-align:center;
}

@media(max-width:900px){

.hero{
flex-direction:column;
text-align:center;
padding-top:50px;
}

.hero h1{
font-size:45px;
}

.hero-image{
font-size:150px;
margin-top:40px;
}

.menu{
display:flex;
flex-wrap:wrap;
justify-content:center;
}

}

</style>
</head>
<body>

<div class="background">
    <div class="circle"></div>
    <div class="circle"></div>
</div>

<header>
    <nav>

        <a href="{{ url('/') }}" class="logo">
            🩸 Sangue na Área
        </a>

        <div class="menu">
            <a href="{{ url('/') }}">Início</a>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Registrar</a>
        </div>

    </nav>
</header>

<section class="hero">

    <div class="hero-text">

        <h1>
            Conectando
            <span>Doadores</span>
            e Centros de Saúde para Salvar Vidas
        </h1>

        <p>
            Uma plataforma moderna que permite aos hospitais encontrar
            doadores rapidamente e aos cidadãos localizar centros de
            doação próximos com facilidade.
        </p>

        <a href="{{ route('register') }}" class="btn btn-primary">
            Quero Doar
        </a>

        <a href="{{ route('login') }}" class="btn btn-secondary">
            Já Tenho Conta
        </a>

    </div>

    <div class="hero-image">
        ❤️
    </div>

</section>

<section class="stats">

    <div class="stat-card">
        <h2>12.500+</h2>
        <p>Doadores Ativos</p>
    </div>

    <div class="stat-card">
        <h2>340+</h2>
        <p>Centros de Saúde</p>
    </div>

    <div class="stat-card">
        <h2>48.000+</h2>
        <p>Doações Realizadas</p>
    </div>

    <div class="stat-card">
        <h2>150.000+</h2>
        <p>Vidas Impactadas</p>
    </div>

</section>

<section class="section">

    <div class="section-title">
        <h2>Como Funciona</h2>
    </div>

    <div class="features">

        <div class="feature">
            <h3>📍 Localização Inteligente</h3>
            <p>Encontre rapidamente centros de doação próximos da sua localização.</p>
        </div>

        <div class="feature">
            <h3>🔔 Alertas de Emergência</h3>
            <p>Receba notificações quando houver necessidade urgente do seu tipo sanguíneo.</p>
        </div>

        <div class="feature">
            <h3>🏥 Hospitais Conectados</h3>
            <p>Centros de saúde podem localizar doadores compatíveis em poucos segundos.</p>
        </div>

        <div class="feature">
            <h3>📊 Histórico Completo</h3>
            <p>Acompanhe suas doações e o impacto gerado na comunidade.</p>
        </div>

        <div class="feature">
            <h3>🩸 Compatibilidade Automática</h3>
            <p>O sistema cruza tipos sanguíneos para agilizar o atendimento.</p>
        </div>

        <div class="feature">
            <h3>🌍 Rede Solidária</h3>
            <p>Construa uma comunidade de apoio e solidariedade.</p>
        </div>

    </div>

</section>

<section class="impact">

    <h2>Uma única doação pode salvar até 3 vidas</h2>

    <p>
        Cada bolsa de sangue representa esperança para pacientes
        em cirurgias, tratamentos oncológicos, emergências e maternidades.
    </p>

</section>

<section class="cta">

    <h2>Faça Parte Desta Missão</h2>

    <p>
        Cadastre-se agora e ajude a construir a maior rede de doação
        de sangue de Angola.
    </p>

    <a href="{{ route('register') }}" class="btn btn-primary">
        Cadastrar Gratuitamente
    </a>

</section>

<footer>
    © {{ date('Y') }} Sangue na Área • Doar Sangue é Compartilhar Vida ❤️
</footer>

</body>
</html>

