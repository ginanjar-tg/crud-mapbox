<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>UBAH DATA</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.18.1/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js"></script>

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
    <form method="post" action="proses_ubah.php?no=<?php echo $no; ?>" enctype="multipart/form-data">
        <div class="h-screen w-screen space-y-5 text-center text-white" data-theme="dark">
            <div class="text-xl font-bold pt-5">
                UBAH DATA
            </div>
            <div id="map" class="w-full h-1/2 top-0 text-black"></div>
            <div class="grid-none md:grid md:grid-cols-2">
                <div id="formAlamat" class="space-y-5">
                    <p>Ubah nama alamat secara manual</p>
                    Alamat : <input type="text" name="alamat" id="alamat" placeholder="Alamat" class="input input-bordered w-1/4" value="<?php echo $data['alamat']; ?>" />
                    <br>
                </div>

                <div id="formLatLng" class="space-y-5">
                    <p>Klik lokasi di dalam peta untuk mendapatkan latitude dan longitude</p>
                    Latitude : <input type="text" name="latitude" id="latitude" placeholder="Latitude" class="input input-bordered w-1/4" value="<?php echo $data['latitude']; ?>" />
                    <br>
                    Longitude : <input type="text" name="longitude" id="longitude" placeholder="Longitude" class="input input-bordered w-1/4" value="<?php echo $data['longitude']; ?>" />
                </div>
                <br>
            </div>
            <button type="submit" class="btn btn-wide text-white bg-blue-500 width-30">UBAH</button>
            <button class="btn btn-wide text-white bg-blue-500 width-30"><a href="index.php">BATAL</a> </button>
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
        map.on('style.load', function() {
            map.on('click', function(e) {
                var longitude = e.lngLat.lng;
                var latitude = e.lngLat.lat;
                document.getElementById("latitude").value = latitude;
                document.getElementById("longitude").value = longitude;
            });
        });
    </script>
</body>

</html>