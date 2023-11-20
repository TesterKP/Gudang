<?php
session_start();      // mengaktifkan session

// pengecekan session login user 
// jika user belum login
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
  // alihkan ke halaman login dan tampilkan pesan peringatan login
  header('location: ../../login.php?pesan=2');
}
// jika user sudah login, maka jalankan perintah untuk insert
else {
  // panggil file "database.php" untuk koneksi ke database
  require_once "../../config/database.php";

  // mengecek data hasil submit dari form
  if (isset($_POST['simpan'])) {
    // ambil data hasil submit dari form
    $id_barang          = mysqli_real_escape_string($mysqli, $_POST['id_barang']);
    $nama_barang        = mysqli_real_escape_string($mysqli, trim($_POST['nama_barang']));
    $jenis              = mysqli_real_escape_string($mysqli, $_POST['jenis']);
    $stok_minimum       = mysqli_real_escape_string($mysqli, $_POST['stok_minimum']);
    $satuan             = mysqli_real_escape_string($mysqli, $_POST['satuan']);

    // ambil data file hasil submit dari form
    $nama_file          = $_FILES['foto']['name'];
    $tmp_file           = $_FILES['foto']['tmp_name'];
    $extension          = array_pop(explode(".", $nama_file));
    // enkripsi nama file
    $nama_file_enkripsi = sha1(md5(time() . $nama_file)) . '.' . $extension;
    // tentukan direktori penyimpanan file foto
    $path               = "../../images/" . $nama_file_enkripsi;

    // mengecek data foto dari form entri data
    // jika data foto tidak ada
    if (empty($nama_file)) {
      // sql statement untuk insert data ke tabel "tbl_barang"
      $insert = mysqli_query($mysqli, "INSERT INTO tbl_barang(id_barang, nama_barang, jenis, stok_minimum, satuan) 
                                       VALUES('$id_barang', '$nama_barang', '$jenis', '$stok_minimum', '$satuan')")
                                       or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));
      // cek query
      // jika proses insert berhasil
      if ($insert) {
        // alihkan ke halaman barang dan tampilkan pesan berhasil simpan data
        header('location: ../../main.php?module=barang&pesan=1');
      }
    }
    // jika data foto ada
    else {
      // lakukan proses unggah file
      // jika file berhasil diunggah
      if (move_uploaded_file($tmp_file, $path)) {
        // sql statement untuk insert data ke tabel "tbl_barang"
        $insert = mysqli_query($mysqli, "INSERT INTO tbl_barang(id_barang, nama_barang, jenis, stok_minimum, satuan, foto) 
                                         VALUES('$id_barang', '$nama_barang', '$jenis', '$stok_minimum', '$satuan', '$nama_file_enkripsi')")
                                         or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));
        // cek query
        // jika proses insert berhasil
        if ($insert) {
          // alihkan ke halaman barang dan tampilkan pesan berhasil simpan data
          header('location: ../../main.php?module=barang&pesan=1');
        }
      }
    }
  }
}
