@extends('layouts.app')

@section('css')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Leaflet Geocoder CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

    <style>
        #map {
            height: 500px;
            width: 100%;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        #infoJarak {
            border-left: 5px solid #0d6efd;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .instruction-text {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .map-container {
            position: relative;
        }

        .leaflet-control-geocoder {
            margin-top: 10px;
        }
    </style>
@endsection

@section('navbar')
    @include('components.navbar')
@endsection

@section('content')
    {{-- header --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
        <div class="container">
          <a class="navbar-brand" href="#">
            <i class="fas fa-map-marked-alt"></i> Peta Jarak Pembeli - Penjual
          </a>
        </div>
      </nav>

      <div class="container mb-4">
        <!-- Instructions -->
        <div class="row mb-3">
          <div class="col-12">
            <div class="card rounded">
              <div class="card-body">
                <h5 class="card-title"><i class="fas fa-info-circle"></i> <b>Petunjuk Penggunaan</b></h5>
                <p class="card-text">Klik peta atau cari lokasi Anda untuk melihat jarak & rute.</p>
                <p class="card-text text-muted instruction-text">Pastikan alamat yang Anda kirimkan benar-benar sesuai dengan alamat yang ada di Google Maps.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Map -->
        <div class="row mb-3">
          <div class="col-12">
            <div class="map-container">
              <div id="map"></div>
            </div>
          </div>
        </div>

        <!-- Distance Info -->
        <div class="row">
          <div class="col-12">
            <div id="infoJarak" class="p-3 rounded text-center fw-bold"></div>
          </div>
        </div>
      </div>
@endsection

@section('footer')
    @include('components.footer')
@endsection

@section('script')
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Leaflet Geocoder JS -->
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script>

        // --- Data Penjual (Contoh - Ganti dengan data dari database Anda) ---
        const koordinatPenjual = { lat: -7.567949869414833, lng: 110.82362095927864 };
        const namaPenjual = "Toko Pusat";
        // ------------------------------------------------------------------

        const map = L.map('map').setView(koordinatPenjual, 29); // Set view awal ke lokasi penjual
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const iconPenjual = L.divIcon({
          className: 'custom-icon',
          html: '<i class="fas fa-store fa-2x" style="color: green;"></i>',
          iconSize: [30, 42],
          iconAnchor: [15, 42]
        });

        const iconPembeli = L.divIcon({
          className: 'custom-icon',
          html: '<i class="fas fa-user fa-2x" style="color: red;"></i>',
          iconSize: [30, 42],
          iconAnchor: [15, 42]
        });

        let penjualMarker = null;
        let pembeliMarker = null;
        let routeLine = null;

        const infoDiv = document.getElementById("infoJarak");

        // Fungsi untuk menghapus hanya marker pembeli dan rute
        function resetPembeliDanRute() {
          if (pembeliMarker) map.removeLayer(pembeliMarker);
          if (routeLine) map.removeLayer(routeLine);
          pembeliMarker = routeLine = null;
          // Kembalikan teks info ke keadaan setelah penjual dimuat
          infoDiv.textContent = "Tentukan lokasi Anda Bossqu";
          // Mungkin reset view peta jika perlu
          // map.setView(koordinatPenjual, 13);
        }

        // Fungsi untuk menangani penentuan lokasi pembeli dan menampilkan rute
        function setLokasiPembeli(lat, lng) {
            // Hapus marker pembeli dan rute sebelumnya jika ada
            resetPembeliDanRute();

            pembeliMarker = L.marker([lat, lng], { icon: iconPembeli })
                              .addTo(map)
                              .bindPopup("Lokasi Pembeli")
                              .openPopup();

            // Ambil rute dari Penjual ke Pembeli yang baru
            const url = `https://router.project-osrm.org/route/v1/driving/${koordinatPenjual.lng},${koordinatPenjual.lat};${lng},${lat}?overview=full&geometries=geojson`;

            fetch(url)
              .then(res => res.json())
              .then(data => {
                  if (data.routes && data.routes.length > 0) {
                    const route = data.routes[0];
                    const distanceKm = (route.distance / 1000).toFixed(2);

                    routeLine = L.geoJSON(route.geometry, {
                        style: { color: '#0d6efd', weight: 4 }
                    }).addTo(map);

                    // Buat batas dari kedua marker dan sesuaikan tampilan peta
                    const bounds = L.latLngBounds(koordinatPenjual, [lat, lng]);
                    map.fitBounds(bounds.pad(0.1)); // pad(0.1) memberi sedikit ruang ekstra

                    if(distanceKm > 4){
                        infoDiv.innerHTML = `<i class="fas fa-frown me-2"></i> Jarak dari ${namaPenjual}: <span class="text-danger">${distanceKm} km</span>, yuh adoh e males mas saestu`;
                    } else if(distanceKm < 1){
                        infoDiv.innerHTML = `<i class="fas fa-laugh-beam me-2"></i> Jarak dari ${namaPenjual}: <span class="text-success">${distanceKm} km</span>, bajirut moro wae`;
                    } else {
                        infoDiv.innerHTML = `<i class="fas fa-smile me-2"></i> Jarak dari ${namaPenjual}: <span class="text-primary">${distanceKm} km</span>, cedak mending moro toko mas`;
                    }
                  } else {
                    infoDiv.innerHTML = `<i class="fas fa-exclamation-triangle me-2"></i> Tidak dapat menghitung rute ke lokasi Pembeli.`;
                    // Hapus marker pembeli jika rute tidak ditemukan
                    if (pembeliMarker) map.removeLayer(pembeliMarker);
                    pembeliMarker = null;
                  }
              })
              .catch(error => {
                console.error("Error fetching route:", error);
                infoDiv.innerHTML = `<i class="fas fa-times-circle me-2"></i> Gagal mengambil data rute.`;
                // Hapus marker pembeli jika terjadi error
                if (pembeliMarker) map.removeLayer(pembeliMarker);
                pembeliMarker = null;
              });
        }

        // --- Inisialisasi Peta dengan Lokasi Penjual ---
        function initMap() {
            penjualMarker = L.marker(koordinatPenjual, { icon: iconPenjual })
                               .addTo(map)
                               .bindPopup(namaPenjual) // Tampilkan nama penjual
                               .openPopup(); // Langsung buka popup penjual

            // Update teks info awal
            infoDiv.innerHTML = `<i class="fas fa-info-circle me-2"></i> Lokasi ${namaPenjual} ditampilkan. Tentukan lokasi Anda (Pembeli).`;
        }

        initMap(); // Panggil fungsi inisialisasi


        // Event listener untuk klik di peta (hanya untuk set Pembeli)
        map.on('click', function(e) {
          setLokasiPembeli(e.latlng.lat, e.latlng.lng);
        });

        // Geocoder (hanya untuk set Pembeli)
        L.Control.geocoder({
          defaultMarkGeocode: false,
          placeholder: 'Cari lokasimu Bossqquuu...'
        })
        .on('markgeocode', function(e) {
          const center = e.geocode.center;
          setLokasiPembeli(center.lat, center.lng);
        })
        .addTo(map);
      </script>
@endsection
