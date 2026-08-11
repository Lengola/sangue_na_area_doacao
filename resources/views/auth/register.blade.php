<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cadastro - Bleed To Save</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background: #f8f9fa;
        }
        .navbar {
            background: #fff;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .navbar-brand img {
            height: 50px;
        }
        .section-heading {
            color: #dc3545;
            font-weight: 700;
            margin-top: 100px;
        }
        .register-card {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }
        .btn-primary {
            background: #dc3545;
            border: none;
            font-size: 18px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background: #b52a36;
        }
        .modal-header {
            background: #dc3545;
            color: #fff;
        }
        .modal-footer .btn-secondary {
            background: #6c757d;
            border: none;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #dc3545;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a href="{{ url('/') }}" class="navbar-brand">
                <img src="{{ asset('v/imgs/nav-logo.png') }}" alt="Logo">
            </a>
        </div>
    </nav>

    <!-- Formulário Principal (envolve tudo) -->
    <div class="container">
        <h1 class="text-center section-heading">Cadastro</h1>

        <div class="col-lg-6 col-md-8 mx-auto register-card mt-4">

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Erros encontrados:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form id="full-form" method="POST" action="{{ route('cadastro.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Campos principais -->
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="role">Tipo de Conta</label>
                    <select id="role" name="role" class="form-control">
                        <option value="doador" selected>Doador</option>
                        <option value="centro">Centro de Saúde</option>
                    </select>
                </div>

                <!-- Botão para abrir modal -->
                <div class="text-right">
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#extraModal">
                        Próximo
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="extraModal" tabindex="-1" aria-labelledby="extraModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="extraModalLabel">Informações Adicionais</h5>
                                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">

                                <!-- Campos DOADOR -->
                                <div id="doador-fields" class="row">

    <!-- Foto do Doador -->
    <div class="col-md-4">
        <label for="imagem">
            <div class="foto mb-2">
                <img src="{{ asset('img/semFoto.jpg') }}" width="120px" id="imagem-preview" alt="Imagem Preview" class="rounded shadow">
            </div>
            <div class="form-floating">
                <input type="file" class="form-control mark" name="imagem" id="imagem" onchange="previewImagem()">
                <label for="imagem">Anexar Foto</label>
            </div>
        </label>
    </div>

    <!-- Dados Pessoais -->
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="numero_identificacao">Número de Identificação (BI)</label>
                <input type="text" name="numero_identificacao" class="form-control" placeholder="Ex: 005487613LA045" >
            </div>

            <div class="col-md-3 mb-3">
                <label for="data_nascimento">Data de Nascimento</label>
                <input type="date" name="data_nascimento" class="form-control">
            </div>

            <div class="col-md-3 mb-3">
                <label for="sexo">Sexo</label>
                <select name="sexo" class="form-control">
                    <option value="">Selecione</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                    <option value="O">Outro</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="tipo_sanguineo">Tipo Sanguíneo</label>
                <select name="tipo_sanguineo" class="form-control" >
                    <option value="">Selecione</option>
                    <option>A+</option>
                    <option>A-</option>
                    <option>B+</option>
                    <option>B-</option>
                    <option>AB+</option>
                    <option>AB-</option>
                    <option>O+</option>
                    <option>O-</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" class="form-control" placeholder="Ex: +244 923 000 000">
            </div>

            <div class="col-md-4 mb-3">
                <label for="peso_kg">Peso (kg)</label>
                <input type="number" name="peso_kg" class="form-control" step="0.01" placeholder="Ex: 68.5">
            </div>
        </div>
    </div>

    <!-- Endereço -->
    <div class="col-md-12 mt-3">
        <h5 class="text-muted">Endereço</h5>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="cidade">Cidade</label>
                <input type="text" name="cidade" class="form-control" placeholder="Ex: Luanda">
            </div>

            <div class="col-md-4 mb-3">
                <label for="provincia">Província</label>
                <input type="text" name="provincia" class="form-control" placeholder="Ex: Luanda">
            </div>

            <div class="col-md-4 mb-3">
                <label for="pais">País</label>
                <input type="text" name="pais" class="form-control" value="Angola">
            </div>
        </div>
    </div>

    <!-- Observações -->
    <div class="col-md-12 mt-3">
        <label for="observacoes">Observações</label>
        <textarea name="observacoes" class="form-control" rows="3" placeholder="Observações sobre o doador..."></textarea>
    </div>

</div>

{{-- --------------------------------------------------------------------- --}}
                                <!-- Campos CENTRO -->
                                <div id="centro-fields" style="display:none;">
    <div class="row">

        <!-- Nome do Centro -->
        <div class="col-md-6 mb-3">
            <label for="nome_centro">Nome do Centro</label>
            <input type="text" name="nome_centro" id="nome_centro" class="form-control">
        </div>

        <!-- Telefone -->
        <div class="col-md-3 mb-3">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" id="telefone" class="form-control">
        </div>

        <!-- E-mail
        <div class="col-md-3 mb-3">
            <label for="email">E-mail do Centro</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>-->

        <!-- Responsável -->
        <div class="col-md-4 mb-3">
            <label for="responsavel">Responsável</label>
            <input type="text" name="responsavel" id="responsavel" class="form-control">
        </div>

        <!-- NIF -->
        <div class="col-md-4 mb-3">
            <label for="nif">NIF</label>
            <input type="text" name="nif" id="nif" class="form-control">
        </div>

        <!-- Imagem (Logo ou Foto) -->
        <div class="col-md-4 mb-3">
            <label for="imagem">Imagem / Logotipo</label>
            <input type="file" name="imagem" id="imagem" class="form-control">
        </div>

        <!-- Latitude -->
        <div class="col-md-3 mb-3">
            <label for="latitude">Latitude</label>
            <input type="text" name="latitude" id="latitude" class="form-control" placeholder="Ex: -8.8390">
        </div>

        <!-- Longitude -->
        <div class="col-md-3 mb-3">
            <label for="longitude">Longitude</label>
            <input type="text" name="longitude" id="longitude" class="form-control" placeholder="Ex: 13.2894">
        </div>

    </div>
</div>


                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                                <!-- SUBMITE TODO FORM -->
                                <button type="submit" class="btn btn-primary">Finalizar Cadastro</button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Mostra os campos corretos ao abrir o modal
        $('#extraModal').on('show.bs.modal', function () {
            const role = $('#role').val();
            $('#doador-fields').toggle(role === 'doador');
            $('#centro-fields').toggle(role === 'centro');
        });
    </script>

    <script>
        function previewImagem() {
            var input = document.getElementById('imagem');
            var imagemPreview = document.getElementById('imagem-preview');
            if (input.files && input.files[0]) {
                var leitor = new FileReader();
                leitor.onload = function(e) {
                    imagemPreview.src = e.target.result;
                }
                leitor.readAsDataURL(input.files[0]);
            }
        }
    </script>

</body>
</html>
