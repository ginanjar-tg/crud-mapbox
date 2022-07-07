<?php
// Load file koneksi.php
include "koneksi.php";

// Ambil data no yang dikirim oleh form_ubah.php melalui URL
$no = $_GET['no'];

// Ambil Data yang Dikirim dari Form
$alamat = $_POST['alamat'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

// Proses ubah data ke Database
$query = "UPDATE lokasi SET alamat='" . $alamat . "', latitude='" . $latitude . "', longitude='" . $longitude . "' WHERE no='" . $no . "'";
$sql = mysqli_query($connect, $query); // Eksekusi/ Jalankan query dari variabel $query

if ($sql) { // Cek jika proses simpan ke database sukses atau tidak
	// Jika Sukses, Lakukan :
	header("location: index.php"); // Redirect ke halaman index.php
} else {
	// Jika Gagal, Lakukan :
	echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
	echo "<br><a href='form_ubah.php'>Kembali Ke Form</a>";
}
