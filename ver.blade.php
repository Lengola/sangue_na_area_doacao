Ótimo, vou te passar um **menu dinâmico com controle de acesso baseado em roles e permissões usando Gates e @can no Laravel**.

### ✅ Passos para Implementar:

---

### **1. Criar coluna `role` na tabela `users`**

Adicione no migration de `users` ou crie um novo migration:

```php
php artisan make:migration add_role_to_users_table --table=users
```

No método `up()`:

```php
Schema::table('users', function (Blueprint $table) {
    $table->enum('role', ['admin', 'medico', 'centro', 'doador'])->default('doador');
});
```

Depois:

```bash
php artisan migrate
```

---

### **2. Definir as Gates no `AuthServiceProvider`**

Em `app/Providers/AuthServiceProvider.php`:

```php
public function boot()
{
    $this->registerPolicies();

    Gate::define('isAdmin', function ($user) {
        return $user->role === 'admin';
    });

    Gate::define('isMedico', function ($user) {
        return $user->role === 'medico';
    });

    Gate::define('isCentro', function ($user) {
        return $user->role === 'centro';
    });

    Gate::define('isDoador', function ($user) {
        return $user->role === 'doador';
    });
}
```

---

### **3. Criar o menu dinâmico na view (Blade)**

Exemplo de menu em `resources/views/layouts/menu.blade.php`:

```html
<ul class="navbar-nav">
    {{-- Menu para Admin --}}
    @can('isAdmin')
        <li class="nav-item"><a href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
        <li class="nav-item"><a href="{{ route('medicos.index') }}">Gerenciar Médicos</a></li>
        <li class="nav-item"><a href="{{ route('centros.index') }}">Gerenciar Centros</a></li>
        <li class="nav-item"><a href="{{ route('doadores.index') }}">Gerenciar Doadores</a></li>
    @endcan

    {{-- Menu para Médico --}}
    @can('isMedico')
        <li class="nav-item"><a href="{{ route('medico.dashboard') }}">Painel Médico</a></li>
        <li class="nav-item"><a href="{{ route('consultas.index') }}">Minhas Consultas</a></li>
        <li class="nav-item"><a href="{{ route('doadores.index') }}">Listar Doadores</a></li>
    @endcan

    {{-- Menu para Centro de Saúde --}}
    @can('isCentro')
        <li class="nav-item"><a href="{{ route('centro.dashboard') }}">Painel Centro</a></li>
        <li class="nav-item"><a href="{{ route('estoque.index') }}">Gerenciar Estoque</a></li>
        <li class="nav-item"><a href="{{ route('campanhas.index') }}">Campanhas</a></li>
    @endcan

    {{-- Menu para Doador --}}
    @can('isDoador')
        <li class="nav-item"><a href="{{ route('doador.dashboard') }}">Painel Doador</a></li>
        <li class="nav-item"><a href="{{ route('agendamentos.index') }}">Agendar Doação</a></li>
        <li class="nav-item"><a href="{{ route('historico.index') }}">Meu Histórico</a></li>
    @endcan
</ul>
```

---

### **4. Middleware para proteger rotas**

Crie um middleware `RoleMiddleware`:

```bash
php artisan make:middleware RoleMiddleware
```

No método `handle()`:

```php
public function handle($request, Closure $next, $role)
{
    if (auth()->user()->role !== $role) {
        abort(403, 'Acesso negado');
    }
    return $next($request);
}
```

Registre no `Kernel.php`:

```php
'role' => \App\Http\Middleware\RoleMiddleware::class,
```

Use nas rotas:

```php
Route::middleware(['role:admin'])->group(function () {
    Route::resource('medicos', MedicoController::class);
    Route::resource('centros', CentroController::class);
});
```

---

⚡ **Quer que eu também gere o código Blade completo com **Bootstrap 5 + ícones + menu responsivo** (com dropdown e colapso para mobile) já aplicando esse controle dinâmico?**
Ou prefere que eu te entregue **um menu em formato Vue.js / React** para uma SPA Laravel + Inertia ou Laravel + API?
