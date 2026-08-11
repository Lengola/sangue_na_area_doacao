@extends('layouts.layouts')

@section('content')

<div class="container mt-3">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4>🏥 Centros Hospitalares Inteligentes</h4>
    <input type="text" id="search" class="form-control w-25" placeholder="🔍 Procurar centro...">
  </div>

  <div id="map"></div>

  <!-- Painel -->
  <div id="infoBox">
    <div>📏 <strong>Distância:</strong> <span id="distance">--</span></div>
    <div>⏱️ <strong>Tempo:</strong> <span id="duration">--</span></div>
  </div>

</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css"/>
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css"/>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

<style>

#map {
  height: 80vh;
  border-radius: 18px;
}

/* Painel flutuante */
#infoBox {
  position: absolute;
  bottom: 25px;
  left: 25px;
  background: rgba(255,255,255,0.95);
  padding: 14px 18px;
  border-radius: 14px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.2);
  z-index: 1000;
}

/* CARD BONITO */
.popup-card {
  font-family: sans-serif;
  width: 230px;
}

.popup-img {
  width: 100%;
  height: 120px;
  object-fit: cover;
  border-radius: 10px;
  margin-bottom: 8px;
}

.popup-title {
  font-weight: bold;
  font-size: 15px;
}

.popup-info {
  font-size: 13px;
  color: #555;
}

.btn-rota {
  margin-top: 8px;
  width: 100%;
  background: linear-gradient(45deg, #0d6efd, #0dcaf0);
  color: white;
  border: none;
  padding: 7px;
  border-radius: 8px;
  transition: 0.3s;
}

.btn-rota:hover {
  transform: scale(1.05);
}

/* Marker com imagem */
.marker-img {
  width: 45px;
  height: 45px;
  border-radius: 50%;
  border: 3px solid white;
  box-shadow: 0 4px 10px rgba(0,0,0,0.3);
}

/* Marker por província */
.provincia-marker {
  display: flex;
  flex-direction: column;
  align-items: center;
  font-size: 12px;
  font-weight: bold;
}

.provincia-marker img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  margin-bottom: 2px;
}

</style>

<script>

let map = L.map('map');

// Adicionar tiles
L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png').addTo(map);

// 🔹 Ajustar mapa para caber todo Angola
let angolaBounds = [
  [-18.038, 11.734], // sul-oeste
  [-4.385, 24.083]   // nordeste
];
map.fitBounds(angolaBounds);

let markers = L.markerClusterGroup();
let routingControl = null;
let userLat, userLng;
let destino = null;

let centros = @json($centros);

// 🧠 Criar popup bonito
function criarPopup(c) {

  let campanhasHtml = '';

  if (c.campanhas && c.campanhas.length > 0) {
    campanhasHtml = '<div class="popup-info mt-2"><strong>📢 Campanhas:</strong><br>';

    c.campanhas.forEach(cam => {
      campanhasHtml += `
        <div style="border-top:1px solid #eee; margin-top:5px; padding-top:5px;">
          🗓️ ${cam.titulo}<br>
          <small>${cam.data_inicio ?? ''} - ${cam.data_fim ?? ''}</small>

          <button class="btn-rota mt-1"
            onclick="agendar(${c.id}, ${cam.id})">
            📅 Agendar
          </button>
        </div>
      `;
    });

    campanhasHtml += '</div>';
  } else {
    campanhasHtml = '<div class="popup-info mt-2 text-muted">Sem campanhas ativas</div>';
  }

  return `
    <div class="popup-card">

      ${c.imagem 
        ? `<img src="/storage/${c.imagem}" class="popup-img">` 
        : `<img src="https://via.placeholder.com/300x120" class="popup-img">`
      }

      <div class="popup-title">${c.nome_centro}</div>

      <div class="popup-info">
        📞 ${c.telefone}<br>
        👤 ${c.responsavel ?? 'N/A'}
      </div>

      ${campanhasHtml}

      <button class="btn-rota" onclick="tracarRota(${c.latitude}, ${c.longitude})">
        🚗 Como chegar
      </button>

    </div>
  `;
}


function agendar(centroId, campanhaId) {
  window.location.href = `/agendamentos/create?centro=${centroId}&campanha=${campanhaId}`;
}

















// 🎯 Marker com imagem
function criarIcon(c) {
  return L.divIcon({
    html: `
      <img src="${c.imagem ? '/storage/' + c.imagem : 'https://cdn-icons-png.flaticon.com/512/2967/2967350.png'}"
           class="marker-img">
    `,
    className: ''
  });
}

let allMarkers = [];

centros.forEach(c => {
  if (c.latitude && c.longitude) {

    let marker = L.marker([c.latitude, c.longitude], {
      icon: criarIcon(c)
    }).bindPopup(criarPopup(c));

    markers.addLayer(marker);
    allMarkers.push({ marker, centro: c });
  }
});

map.addLayer(markers);

// 🔍 Pesquisa
document.getElementById('search').addEventListener('keyup', e => {
  let val = e.target.value.toLowerCase();
  markers.clearLayers();

  allMarkers.forEach(item => {
    if (item.centro.nome_centro.toLowerCase().includes(val)) {
      markers.addLayer(item.marker);
    }
  });
});

// 📍 GPS
navigator.geolocation.watchPosition(pos => {

  userLat = pos.coords.latitude;
  userLng = pos.coords.longitude;

  if (!window.userMarker) {
    window.userMarker = L.circleMarker([userLat, userLng], {
      radius: 8,
      color: '#0d6efd',
      fillColor: '#0d6efd',
      fillOpacity: 1
    }).addTo(map);
  } else {
    window.userMarker.setLatLng([userLat, userLng]);
  }

  if (destino) {
    tracarRota(destino.lat, destino.lng);
  }

});

// 🚗 ROTA
function tracarRota(lat, lng) {

  destino = { lat, lng };

  if (!userLat) {
    alert("A obter localização...");
    return;
  }

  if (routingControl) {
    map.removeControl(routingControl);
  }

  routingControl = L.Routing.control({

    waypoints: [
      L.latLng(userLat, userLng),
      L.latLng(lat, lng)
    ],

    showAlternatives: true,

    lineOptions: {
      styles: [{ color: '#0d6efd', weight: 6 }]
    },

    altLineOptions: {
      styles: [{ color: '#6c757d', weight: 4, opacity: 0.6 }]
    },

    createMarker: () => null

  }).addTo(map);

  routingControl.on('routesfound', e => {

    let r = e.routes[0];

    let dist = (r.summary.totalDistance / 1000).toFixed(2);
    let time = (r.summary.totalTime / 60).toFixed(0);

    document.getElementById('distance').innerText = dist + " km";
    document.getElementById('duration').innerText = time + " min";

  });
}

// ➕ Marcadores por província
let provinciaMarkers = {};
centros.forEach(c => {
  if (!c.provincia) return;

  if (!provinciaMarkers[c.provincia]) {
    provinciaMarkers[c.provincia] = {
      count: 0,
      latSum: 0,
      lngSum: 0
    };
  }

  provinciaMarkers[c.provincia].count += 1;
  provinciaMarkers[c.provincia].latSum += c.latitude;
  provinciaMarkers[c.provincia].lngSum += c.longitude;
});

Object.keys(provinciaMarkers).forEach(p => {
  let data = provinciaMarkers[p];
  let lat = data.latSum / data.count;
  let lng = data.lngSum / data.count;

  let icon = L.divIcon({
    html: `
      <div class="provincia-marker">
        <img src="https://cdn-icons-png.flaticon.com/512/2967/2967350.png">
        <span>${data.count} centros</span>
      </div>
    `,
    className: ''
  });

  L.marker([lat, lng], { icon }).addTo(map);
});

</script>

@endsection