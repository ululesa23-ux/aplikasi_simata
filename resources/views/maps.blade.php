<!DOCTYPE html>
<html>
<head>
  <title>Rute ke Sekolah</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>
  <h2>Peta Rute ke Sekolah</h2>
  <div id="map" style="height: 500px;"></div>
  <div id="info"></div>

  <script>
    // Lokasi user (contoh random) & sekolah (fix)
    const start = { lat: -7.1643, lng: 112.6510 }; // contoh: Gresik
    const end = { lat: -5.7339, lng: 112.6000 };   // contoh: Bawean

    const map = L.map('map').setView([start.lat, start.lng], 10);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
    }).addTo(map);

    // marker
    L.marker([start.lat, start.lng]).addTo(map).bindPopup("Lokasi Kamu").openPopup();
    L.marker([end.lat, end.lng]).addTo(map).bindPopup("Sekolah").openPopup();

    // ambil rute dari Laravel API
    axios.get(`/api/rute?startLat=${start.lat}&startLng=${start.lng}&endLat=${end.lat}&endLng=${end.lng}`)
      .then(res => {
        const data = res.data;

        // info
        document.getElementById('info').innerHTML = `
          <p>Jarak: ${data.distance}</p>
          <p>Durasi: ${data.duration}</p>
          <p>ETA: ${data.eta}</p>
          <p>Status: <b>${data.status}</b></p>
        `;

        // gambar rute
        const routeLine = L.geoJSON(data.geometry).addTo(map);
        map.fitBounds(routeLine.getBounds());
      })
      .catch(err => {
        console.error(err);
        alert("Gagal ambil rute");
      });
  </script>
</body>
</html>
