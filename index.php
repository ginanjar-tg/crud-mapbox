<html>

<head>
    <meta charset="utf-8">
    <title>CRUD MAPBOX</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.18.1/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.9.1/mapbox-gl.js"></script>
</head>

<body>
    <div class="h-screen text-white w-screen space-y-5" data-theme="dark">
        <div class="text-xl font-bold pt-5 text-center">
            CRUD MAPBOX
        </div>
        <p class=" text-center">By Ginanjar Tubagus Gumilar (10119032)</p>
        <br><br>
        <a class="px-5" href="form_tambah.php"><button class="btn btn-primary">Tambah Data</button></a><br>
        <div class="overflow-x-auto">
            <table class="table w-full text-white text-center">
                <!-- head -->
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Alamat</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th colspan="2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Load file koneksi.php
                    include "koneksi.php";

                    $query = "SELECT * FROM lokasi"; // Query untuk menampilkan semua data lokasi
                    $sql = mysqli_query($connect, $query); // Eksekusi/Jalankan query dari variabel $query

                    while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql
                        echo "<tr>";
                        echo "<td>" . $data['no'] . "</td>";
                        echo "<td>" . $data['alamat'] . "</td>";
                        echo "<td>" . $data['latitude'] . "</td>";
                        echo "<td>" . $data['longitude'] . "</td>";
                        echo "<td><button class='btn btn-primary'><a href='form_ubah.php?no=" . $data['no'] . "'>Ubah</a></button></td>";
                        echo "<td><button class='btn btn-primary'><a href='proses_hapus.php?no=" . $data['no'] . "'>Hapus</a></button></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>