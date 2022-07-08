<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>TAMBAH DATA</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
    <!-- import elemen dasar mapbox -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js"></script>
    <!-- import geocoder mapbox -->
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">
    <!-- import tailwind dan daisyui css -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.18.1/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>

    <?php
    // Load file koneksi.php
    include "koneksi.php";
    // Ambil data no yang dikirim oleh index.php melalui URL
    $no = $_GET['no'];
    // Query untuk menampilkan data lokasi berdasarkan no yang dikirim
    $query = "SELECT * FROM lokasi WHERE no='" . $no . "'";
    $sql = mysqli_query($connect, $query);  // Eksekusi/Jalankan query dari variabel $query
    $data = mysqli_fetch_array($sql); // Ambil data dari hasil eksekusi $sql
    ?>
    <form method="post" action="proses_ubah.php?no=<?php echo $no; ?>" enctype="multipart/form-data" onsubmit="return validateForm()">
        <div class="h-screen w-screen space-y-5 text-white px-5" data-theme="dark">
            <div class="text-xl font-bold pt-5 text-center">
                UBAH DATA
            </div>
            <div id="map" class="w-full h-2/5 top-0 text-black rounded"></div>
            <p class="font-bold">➡ Beri nomor data beserta nama lokasi untuk ditambahkan</p>
            <div id="formLokasi" class="grid-none md:grid md:grid-cols-2 md:space-x-5 space-x-none">
                <div>
                    <p>Ubah nama lokasi : </p>
                    <div>
                        <input type="text" name="alamat" id="alamat" class="text-black h-9 rounded w-full" value="<?php echo $data['alamat']; ?>" />
                    </div>
                </div>
                <div>
                    <p>Cari lokasi : </p>
                    <div name="geocoder" id="geocoder" class="w-full"></div>
                </div>
            </div>
            <p class="font-bold">➡ Lalu klik lokasi di dalam peta untuk mengubah latitude dan longitude</p>
            <div id="formLatLng" class="grid-none md:grid md:grid-cols-2 md:space-x-5 space-x-none">
                <div>
                    <p>Latitude : </p>
                    <div>
                        <input type="text" name="latitude" id="latitude" class="text-black h-9 rounded w-full" value="<?php echo $data['latitude']; ?>" />
                    </div>
                </div>
                <div>
                    <p>Longitude : </p>
                    <div>
                        <input type="text" name="longitude" id="longitude" class="text-black h-9 rounded w-full" value="<?php echo $data['longitude']; ?>" />
                    </div>
                </div>
            </div>
            <div class="text-center pt-5">
                <button type="submit" class="text-center btn btn-wide text-white bg-blue-500 width-30">SIMPAN</button>
            </div>
        </div>
    </form>

    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoiZ2luYW5qYXIzMjEiLCJhIjoiY2w0cnpnMjUwMGdyYjNqbzAwZ2YxMjRqZCJ9.bY5MEP_r2eGAblD7ZNxESA';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [107.6145, -6.9167],
            zoom: 12
        });
        // menambahkan control geocoder
        const geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            mapboxgl: mapboxgl
        });
        document.getElementById('geocoder').appendChild(geocoder.onAdd(map));
        map.on('style.load', function() {
            map.on('click', function(e) {
                var longitude = e.lngLat.lng;
                var latitude = e.lngLat.lat;
                document.getElementById("latitude").value = latitude;
                document.getElementById("longitude").value = longitude;
            });
        });
        // validasi input
        function validateForm() {
            var a = document.getElementById("alamat").value;
            var b = document.getElementById("latitude").value;
            var c = document.getElementById("longitude").value;
            if (a == null || a == "" || b == null || b == "" || c == null || c == "") {
                alert("Harap melengkapi semua data yang diperlukan");
                return false;
            }
        }
    </script>
</body>

</html>