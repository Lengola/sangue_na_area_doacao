<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de Doação de Sangue">
    <meta name="author" content="">

    <title>Sistema de Doação de Sangue</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Fontes e ícones -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900" rel="stylesheet">

    <!-- Estilos do Template -->
      <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Estilos Customizados -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .bg-gradient-primary {
            background: linear-gradient(180deg, #b30000 10%, #800000 100%);
        }

        .sidebar .nav-item .nav-link {
            font-size: 1rem;
        }

        .sidebar-brand-text {
            font-size: 1.2rem;
            font-weight: 700;
        }

        .topbar {
            border-bottom: 1px solid #f0f0f0;
        }

        .nav-link .badge {
            font-size: 0.7rem;
        }

        .card-custom {
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .btn-primary {
            background-color: #b30000;
            border: none;
        }

        .btn-primary:hover {
            background-color: #800000;
        }



html, body {
    height: 100%;
    margin: 0;
    overflow: hidden; /* evita rolagem no body inteiro */
}

#wrapper {
    display: flex;
    height: 100%;
    overflow: hidden;
}

#content-wrapper {
    flex: 1;
    display: flex;
    flex-direction: column;
    height: 100%;
}

#content {
    flex: 1;
    overflow-y: auto; /* rolagem apenas no conteúdo central */
    padding: 1rem;
}

.container-fluid {
    min-height: 100%;
}




    </style>



</head>

<body id="page-top">

    <!-- Wrapper -->
    <div id="wrapper">
 {{-- {{ dd(auth()->user()?->role) }} --}}
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Logo -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-tint"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Doe Vida</div>
            </a>

            <hr class="sidebar-divider my-0">

            <!-- Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-heartbeat"></i>
                    <span>Painel Geral</span>
                </a>
            </li>

            <hr class="sidebar-divider">





            @can('acessar-Admin')
<div class="sidebar-heading">Administração</div>

<li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard') }}">
        <i class="fas fa-tachometer-alt"></i>
        <span>Painel Admin</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('users.index') }}">
        <i class="fas fa-users"></i>
        <span>Usuários</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="#"{{--"{{ route('admin.centros.index') }}"--}}>
        <i class="fas fa-hospital"></i>
        <span>Centros</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('medicos.index') }}">
        <i class="fas fa-user-md"></i>
        <span>Médicos</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="#"{{--"{{ route('admin.doadores.index') }}"--}}>
        <i class="fas fa-hand-holding-heart"></i>
        <span>Doadores</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('agendamentos.index') }}">
        <i class="fas fa-calendar-alt"></i>
        <span>Agendamentos</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('doacoes.index') }}">
        <i class="fas fa-tint"></i>
        <span>Doações</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('sangues.index') }}">
        <i class="fas fa-vial"></i>
        <span>Banco de Sangue</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="{{ route('campanhas.index') }}">
        <i class="fas fa-bullhorn"></i>
        <span>Campanhas</span>
    </a>
</li>

@endcan







            <!-- Menu Centro -->
         @can('acessar-Centro')
            <div class="sidebar-heading">Gerenciamento</div>

            <li class="nav-item">
                <a class="nav-link" href="{{ route("medicos.index") }}">
                    <i class="fas fa-user"></i>
                    <span>Medicos</span>
                </a>
            </li>

             <li class="nav-item">
        <a class="nav-link" href="{{ route('agendamentos.index') }}">
            <i class="fas fa-calendar-alt"></i>
            <span>Agendamentos</span> 
        </a>
    </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('doacoes.index') }}">
                    <i class="fas fa-history"></i>
                    <span>Histórico de Doações</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-warehouse"></i>
                    <span>Estoque de Sangue</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">Outros</div>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-users"></i>
                    <span>Doador & Receptor</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('campanhas.index')}}">
                    <i class="fas fa-hands-helping"></i>
                    <span>Campanhas</span>
                </a>
            </li>
            @endcan
<!-- end Menu Centro-->

            <!-- Menu Médico -->
@can('acessar-Medico')
    <div class="sidebar-heading">Médico</div>

    <!-- Agendamentos -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('agendamentos.index') }}">
            <i class="fas fa-calendar-alt"></i>
            <span>Agendamentos</span> 
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('sangues.index') }}">
           {{-- <i class="fas fa-vial"></i>
           <span>Sangue Exame</span> --}} 
        </a>
    </li>

    <li class="nav-item">
        {{--<a class="nav-link" href="#">
            <i class="fas fa-check-circle"></i>
            <span>Confirmar Agendamento</span>
        </a>--}}
    </li>

    <hr class="sidebar-divider">

    <!-- Doações -->
    <div class="sidebar-heading">Doações</div>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('doacoes.index') }}">
            <i class="fas fa-hand-holding-medical"></i>
            <span>Registrar Doação</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('doacoes.index') }}">
            <i class="fas fa-history"></i>
            <span>Histórico de Doações</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Doadores -->
    <div class="sidebar-heading">Doadores</div>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-users"></i>
            <span>Lista de Doadores</span>
        </a>
    </li>

    
@endcan


        <!-- Menu Doador -->
@can('acessar-Doador')
    <div class="sidebar-heading">Doador</div>

    <!-- Doações -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('doacoes.index') }}" data-toggle="collapse" data-target="#collapseDoacoesDoador"
            aria-expanded="false" aria-controls="collapseDoacoesDoador">
            <i class="fas fa-hand-holding-heart"></i>
            <span>Minhas Doações</span>
        </a>
        <div id="collapseDoacoesDoador" class="collapse" aria-labelledby="headingDoacoesDoador" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('agendamentos.index') }}">Agendamentos</a>
                <a class="collapse-item" href="{{ route('doacoes.index') }}">Histórico de Doações</a>
                
               {{--  <a class="collapse-item" href="#">Próximos Agendamentos</a> --}}
            </div>
        </div>
    </li>

    <!-- Centros de Saúde -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCentros"
            aria-expanded="false" aria-controls="collapseCentros">
            <i class="fas fa-hospital"></i>
            <span>Centros de Saúde</span>
        </a>
        <div id="collapseCentros" class="collapse" aria-labelledby="headingCentros" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{--<a class="collapse-item" href="#">Centros Associados</a>--}}
                <a class="collapse-item" href=" {{route('mapa')}} ">Unidades Hospitalar</a>
            </div>
        </div>
    </li>

    <!-- Perfil do Doador -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePerfil"
            aria-expanded="false" aria-controls="collapsePerfil">
            <i class="fas fa-user"></i>
            <span>Meu Perfil</span>
        </a>
        <div id="collapsePerfil" class="collapse" aria-labelledby="headingPerfil" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('profile.show') }}">Meus Dados</a>
                @if(auth()->user()->doador)
                <a class="collapse-item" href="{{ route('cartao.show', auth()->user()->doador->id) }}">Carteira de Doador</a>
                {{--<a class="collapse-item" href="#">Resultados de Exames</a>--}}
                @endif
            </div>
        </div>
    </li>

    <!-- Requisitos -->
    <li class="nav-item">
    <a class="nav-link" href="{{ route('requisitos.index') }}">
        <i class="fas fa-info-circle"></i>
        <span>Requisitos para Doação</span>
    </a>
</li>

    <!-- Campanhas -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('campanhas.index_centro') }}">
            <i class="fas fa-bullhorn"></i>
            <span>Campanhas de Doação</span>
        </a>
    </li>
@endcan




            <hr class="sidebar-divider d-none d-md-block">

            <!-- Botão Toggle -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- Fim Sidebar -->

        <!-- Conteúdo Principal -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    @can('acessar-Doador')
                    <h1>Doador(a)</h1>
                    @endcan
                    @can('acessar-Medico')
                    <h1>Médico</h1>
                    @endcan
                    @can('acessar-Centro')
                    <h1>Centro de Saúde</h1>
                    @endcan
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">

                        <!-- Notificações -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">Notificações</h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div>
                                        <span class="font-weight-bold">Nova campanha de doação aberta!</span>
                                    </div>
                                </a>
                            </div>
                        </li>

                        <!-- Usuário -->

                        <li class="nav-item dropdown no-arrow">


                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Bem-vindo, {{ Auth::user()->name ?? 'Usuário' }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ Auth::user()->profile_photo_path
                                        ? asset('storage/' . Auth::user()->profile_photo_path)
                                        : asset('img/semFoto.jpg') }}"
                                    alt="Foto de Perfil"
                                    width="40" height="40"
                                >
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile.show') }}"><i class="fas fa-user fa-sm fa-fw mr-2"></i>Perfil</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cogs fa-sm fa-fw mr-2"></i>Configurações</a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>Sair
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Fim Topbar -->

                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            <!-- Rodapé -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto text-center">
                    <span>&copy; Doe Vida {{ date('Y') }}</span>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
</body>
</html>
