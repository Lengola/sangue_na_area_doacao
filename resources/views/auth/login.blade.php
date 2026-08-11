<style>

    body{
min-height:100vh;
background:linear-gradient(135deg,#fef2f2,#ffe5e5);
font-family:'Poppins',sans-serif;
overflow-x:hidden;
}

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
background:rgba(230,57,70,.15);
animation:float 10s infinite ease-in-out;
}

.circle:nth-child(1){
width:350px;
height:350px;
top:-100px;
left:-100px;
}

.circle:nth-child(2){
width:250px;
height:250px;
bottom:-80px;
right:-80px;
}

@keyframes float{
0%,100%{transform:translateY(0);}
50%{transform:translateY(-40px);}
}

header{
padding:20px 8%;
}

.navbar{
display:flex;
justify-content:space-between;
align-items:center;
}

.logo{
font-size:24px;
font-weight:700;
text-decoration:none;
color:#e63946;
}

.menu a{
margin-left:20px;
text-decoration:none;
color:#444;
font-weight:500;
}

.menu a:hover{
color:#e63946;
}

.login-container{
display:flex;
justify-content:center;
align-items:center;
min-height:85vh;
padding:20px;
}

.login-card{
width:100%;
max-width:450px;
padding:40px;
background:rgba(255,255,255,.85);
backdrop-filter:blur(15px);
border-radius:25px;
box-shadow:0 15px 40px rgba(0,0,0,.1);
}

.logo-icon{
font-size:60px;
text-align:center;
margin-bottom:10px;
}

.login-card h1{
text-align:center;
color:#e63946;
margin-bottom:10px;
}

.login-card p{
text-align:center;
color:#666;
margin-bottom:25px;
}

.input-group{
margin-bottom:20px;
}

.input-group label{
display:block;
margin-bottom:8px;
font-weight:500;
}

.input-group input{
width:100%;
padding:15px;
border:none;
border-radius:12px;
background:#f4f4f4;
outline:none;
}

.input-group input:focus{
background:#fff;
box-shadow:0 0 0 3px rgba(230,57,70,.2);
}

.remember-box{
margin-bottom:20px;
font-size:14px;
color:#555;
}

.btn-login{
width:100%;
padding:15px;
border:none;
border-radius:50px;
background:#e63946;
color:white;
font-size:16px;
font-weight:600;
cursor:pointer;
transition:.3s;
}

.btn-login:hover{
transform:translateY(-3px);
box-shadow:0 10px 25px rgba(230,57,70,.35);
}

.register{
text-align:center;
margin-top:25px;
}

.register a{
color:#e63946;
font-weight:600;
text-decoration:none;
}

.alert-danger{
background:#ffe5e5;
color:#b91c1c;
padding:12px;
border-radius:10px;
margin-bottom:15px;
}

.alert-warning{
background:#fff7e6;
color:#92400e;
padding:12px;
border-radius:10px;
margin-bottom:15px;
}

@media(max-width:768px){

.navbar{
flex-direction:column;
gap:15px;
}

.login-card{
padding:30px;
}

}

</style>
<body>

<div class="background">
    <div class="circle"></div>
    <div class="circle"></div>
</div>

<header>
    <nav class="navbar">
        <a href="{{ url('/') }}" class="logo">
            🩸 Sangue Para Salvar
        </a>

        <div class="menu">
            <a href="{{ url('/') }}">Início</a>
            <a href="{{ url('register') }}">Registrar</a>
        </div>
    </nav>
</header>

<div class="login-container">

    <div class="login-card">

        <div class="logo-icon">🩸</div>

        <h1>Faça O Login</h1>

        <p>
            Entre na sua conta e continue ajudando a salvar vidas.
        </p>

        @if(session('error'))
        <div class="alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert-warning">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <label>E-mail</label>
                <input
                    type="email"
                    name="email"
                    placeholder="Digite seu e-mail"
                    required>
            </div>

            <div class="input-group">
                <label>Senha</label>
                <input
                    type="password"
                    name="password"
                    placeholder="Digite sua senha"
                    required>
            </div>

            <div class="remember-box">
                <label>
                    <input type="checkbox" name="remember">
                    Lembrar-me
                </label>
            </div>

            <button type="submit" class="btn-login">
                Entrar
            </button>

        </form>

        <div class="register">
            Ainda não possui conta?
            <a href="{{ url('register') }}">
                Criar conta
            </a>
        </div>

    </div>

</div>

</body>