<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).




composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
php artisan storage:link
































"Boa — dá para elevar isso para um nível **bem mais moderno, interativo e profissional**, incluindo:

* 📍 Centros de saúde com localização
* 🏥 Campanhas ligadas aos centros
* 🎯 Filtros dinâmicos
* 📱 Responsivo (funciona bem no telemóvel)
* 🔍 Pesquisa + clusters (agrupamento de marcadores)
* 🎨 UI moderna

Vou te entregar uma versão **muito mais avançada** do teu código 👇

---

# 🚀 🔥 VERSÃO MODERNA E DINÂMICA

### ✅ Blade (Laravel)

```blade
@extends('layouts.admin')

@section('content')
<main id="main" class="main">

  <div class="pagetitle d-flex justify-content-between align-items-center">
    <h1>🌍 Mapa Inteligente de Centros & Campanhas</h1>

    <input type="text" id="search" class="form-control w-25" placeholder="🔍 Procurar centro...">
  </div>

  <section class="section mt-3">
    <div class="card shadow-lg border-0">
      <div class="card-body p-2">
        <div id="map"></div>
      </div>
    </div>
  </section>

</main>

{{-- Leaflet + Plugins --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css"/>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>

<style>
  #map {
    height: 75vh;
    border-radius: 12px;
  }

  .popup-card img {
    width: 100%;
    border-radius: 8px;
    margin-bottom: 8px;
  }

  .badge-campanha {
    background: #0d6efd;
    color: white;
    padding: 3px 6px;
    border-radius: 6px;
    font-size: 11px;
  }
</style>

<script>
  // 📍 Inicializa mapa (Angola)
  var map = L.map('map').setView([-11.2027, 17.8739], 6);

  // 🌍 Mapa moderno
  L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; CARTO',
    maxZoom: 19
  }).addTo(map);

  // 📦 Cluster (agrupamento inteligente)
  var markers = L.markerClusterGroup();

  // 🎯 Ícone customizado
  var iconCentro = L.icon({
    iconUrl: 'https://cdn-icons-png.flaticon.com/512/2967/2967350.png',
    iconSize: [35, 35]
  });

  // 📊 Dados do backend
  var centros = @json($centros);

  function criarPopup(centro) {
    let campanhasHTML = '';

    if (centro.campanhas.length > 0) {
      campanhasHTML += '<hr><strong>📢 Campanhas:</strong><br>';
      centro.campanhas.forEach(c => {
        campanhasHTML += `
          <span class="badge-campanha">${c.titulo}</span><br>
        `;
      });
    }

    return `
      <div class="popup-card">
        ${centro.imagem ? `<img src="/storage/${centro.imagem}">` : ''}
        <strong>${centro.nome_centro}</strong><br>
        📞 ${centro.telefone}<br>
        👤 ${centro.responsavel ?? 'N/A'}<br>
        ${campanhasHTML}
      </div>
    `;
  }

  var allMarkers = [];

  centros.forEach(centro => {
    if (centro.latitude && centro.longitude) {

      let marker = L.marker([centro.latitude, centro.longitude], { icon: iconCentro })
        .bindPopup(criarPopup(centro));

      markers.addLayer(marker);
      allMarkers.push({ marker, centro });
    }
  });

  map.addLayer(markers);

  // 🔍 Pesquisa dinâmica
  document.getElementById('search').addEventListener('keyup', function(e) {
    let value = e.target.value.toLowerCase();

    markers.clearLayers();

    allMarkers.forEach(item => {
      if (item.centro.nome_centro.toLowerCase().includes(value)) {
        markers.addLayer(item.marker);
      }
    });
  });

  // 📍 Geolocalização do utilizador
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(position => {
      let lat = position.coords.latitude;
      let lng = position.coords.longitude;

      L.marker([lat, lng])
        .addTo(map)
        .bindPopup("📍 Você está aqui")
        .openPopup();

      map.setView([lat, lng], 10);
    });
  }
</script>

@endsection
```

---

# 🧠 CONTROLLER (IMPORTANTE)

Precisas carregar campanhas junto com centros:

```php
$centros = Centro::with('campanhas')->get();
return view('mapa', compact('centros'));
```

---

# 🔗 MODEL RELAÇÃO

### Centro.php

```php
public function campanhas()
{
    return $this->hasMany(Campanha::class);
}
```

### Campanha.php

```php
public function centro()
{
    return $this->belongsTo(Centro::class);
}
```

---

# 💡 O QUE ESTA VERSÃO TEM (TOP 🔥)

✅ Mapa moderno (Carto Light)
✅ Marcadores agrupados (cluster)
✅ Popup bonito com imagem
✅ Campanhas dentro do centro
✅ Pesquisa em tempo real
✅ Geolocalização automática
✅ Responsivo (mobile ready)
✅ Código limpo e escalável

---

# 🚀 IDEIAS PARA PRÓXIMO NÍVEL

Se quiser deixar ainda mais profissional:

* 🎯 Filtro por **tipo de campanha**
* 📅 Mostrar campanhas **ativas hoje**
* 🟢 Cor diferente para centros ativos/inativos
* 🧭 Rotas até o centro (Google Maps)
* 📊 Dashboard com estatísticas
* 🔔 Notificações de campanhas próximas

---

Se quiser, posso te fazer versão com:
👉 API + AJAX (sem recarregar página)
👉 Integração com Google Maps
👉 Sistema tipo Uber (rotas em tempo real)

Só diz: **"quero nível avançado 2"** 😄
"
