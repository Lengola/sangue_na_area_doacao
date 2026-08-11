@extends('layouts.layouts')
 
@section('content')



  <main id="main" class="main">

    <div class="pagetitle">
      <h2>Perfil</h2>
      
    </div><!-- End Page Title   -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="{{ Auth::user()->profile_photo_path
                                        ? asset('storage/' . Auth::user()->profile_photo_path)
                                        : asset('img/semFoto.jpg') }}"
                                        width="200" height="250"
                                         alt="Profile" class="rounded-circle">
              <h3>{{auth()->user()->name}}</h3>
              
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Ver</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Editar Perfil</button>
                </li>

                {{--<li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Definições</button>
                </li>--}}

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">guardar Senha</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  
                  <h5 class="card-title">Detalhes do perfil</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nome Completo</div>
                    <div class="col-lg-9 col-md-8">{{auth()->user()->name}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Utente</div>
                    <div class="col-lg-9 col-md-8">{{auth()->user()->role}}</div>
                  </div>

                  {{-- <div class="row">
                    <div class="col-lg-3 col-md-4 label">Cargo</div>
                    <div class="col-lg-9 col-md-8">Analista e enfermeiro</div>
                  </div> --}}

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">País</div>
                    <div class="col-lg-9 col-md-8">{{auth()->user()->endereco->pais}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Província</div>
                    <div class="col-lg-9 col-md-8">{{auth()->user()->endereco->provincia}}</div>
                  </div>


                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Cidade</div>
                    <div class="col-lg-9 col-md-8">{{auth()->user()->endereco->cidade}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Telefone</div>
                    <div class="col-lg-9 col-md-8">(+244) 925956247</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"> {{auth()->user()->email}}  </div>

                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"> </label>
                      <div class="col-md-8 col-lg-9">
                        <img id="profilePreview" src="{{ Auth::user()->profile_photo_path
                                        ? asset('storage/' . Auth::user()->profile_photo_path)
                                        : asset('img/semFoto.jpg') }}" 
                                         width="100" height="150"
                                        alt="Profile">

                     <input type="file" id="imageUpload" name="profile_photo" accept="image/*" style="display: none;">                        <a href="#" onclick="document.getElementById('imageUpload').click(); return false;"
                        class="btn btn-primary btn-sm" title="Upload new profile image">
                        <i class="bi bi-upload">carregar</i>
                        </a>

                        {{--<div class="pt-2">
                          <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    
                    
                {{--
                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Utente</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="company" type="text" class="form-control" id="company" value="Medico">
                      </div>
                    </div>
                
                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Cargo</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="job" type="text" class="form-control" id="Job" value="Medico">
                      </div>
                    </div>
                    --}}

                   

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nome completo</label>
                      <div class="col-md-8 col-lg-9">
                        
                        <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">
                      </div>
                    </div>


                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Pais</label>
                      <div class="col-md-8 col-lg-9">
                         <input type="text" name="pais" class="form-control" value="{{ old('pais', $user->endereco->pais ?? '') }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Provincia</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" name="provincia" class="form-control" value="{{ old('provincia', $user->endereco->provincia ?? '') }}">
                      </div>
                    </div>

                     <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Cidade</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="text" name="cidade" class="form-control" value="{{ old('cidade', $user->endereco->cidade ?? '') }}">
                      </div>
                    </div>
                   

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">telefone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="Phone" value="(+244) 925956247">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input type="email" name="email"  class="form-control" value="{{ old('email', $user->email) }}"> 
                    </div>
                    </div>

                    
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Salvar Dados</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  
                    
                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password Anterior</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nova Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Comfirmar Nova Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Salvar Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->

  <script>
document.getElementById('imageUpload').addEventListener('change', function(event) {
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById('profilePreview').src = e.target.result;
        }

        reader.readAsDataURL(file);
    }
});
</script>
  
@endsection


