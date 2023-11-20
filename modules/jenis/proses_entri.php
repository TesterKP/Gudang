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
    $nama_jenis = mysqli_real_escape_string($mysqli, trim($_POST['nama_jenis']));

    // mengecek "nama_jenis" untuk mencegah data duplikat
    // sql statement untuk menampilkan data "nama_jenis" dari tabel "tbl_jenis" berdasarkan input "nama_jenis"
    $query = mysqli_query($mysqli, "SELECT nama_jenis FROM tbl_jenis WHERE nama_jenis='$nama_jenis'")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil jumlah baris data hasil query
    $rows = mysqli_num_rows($query);

    // cek hasil query
    // jika "nama_jenis" sudah ada di tabel "tbl_jenis"
    if ($rows <> 0) {
      // alihkan ke halaman jenis barang dan tampilkan pesan gagal simpan data
      header("location: ../../main.php?module=jenis&pesan=4&jenis=$nama_jenis");
    }
    // jika "nama_jenis" belum ada di tabel "tbl_jenis"
    else {
      // sql statement untuk insert data ke tabel "tbl_jenis"
      $insert = mysqli_query($mysqli, "INSERT INTO tbl_jenis(nama_jenis) 
                                       VALUES('$nama_jenis')")
                                       or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));
      // cek query
      // jika proses insert berhasil
      if ($insert) {
        // alihkan ke halaman jenis barang dan tampilkan pesan berhasil simpan data
        header('location: ../../main.php?module=jenis&pesan=1');
      }
    }
  }
}
