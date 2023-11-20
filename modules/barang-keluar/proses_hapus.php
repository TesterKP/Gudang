<?php
session_start();      // mengaktifkan session

// pengecekan session login user 
// jika user belum login
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
  // alihkan ke halaman login dan tampilkan pesan peringatan login
  header('location: ../../login.php?pesan=2');
}
// jika user sudah login, maka jalankan perintah untuk delete
else {
  // panggil file "database.php" untuk koneksi ke database
  require_once "../../config/database.php";

  // mengecek data GET "id_transaksi"
  if (isset($_GET['id'])) {
    // ambil data GET dari tombol hapus
    $id_transaksi = mysqli_real_escape_string($mysqli, $_GET['id']);

    // sql statement untuk delete data dari tabel "tbl_barang_keluar" berdasarkan "id_transaksi"
    $delete = mysqli_query($mysqli, "DELETE FROM tbl_barang_keluar WHERE id_transaksi='$id_transaksi'")
                                     or die('Ada kesalahan pada query delete : ' . mysqli_error($mysqli));
    // cek query
    // jika proses delete berhasil
    if ($delete) {
      // alihkan ke halaman barang keluar dan tampilkan pesan berhasil hapus data
      header('location: ../../main.php?module=barang_keluar&pesan=2');
    }
  }
}
