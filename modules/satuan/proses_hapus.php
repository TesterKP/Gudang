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

  // mengecek data GET "id_satuan"
  if (isset($_GET['id'])) {
    // ambil data GET dari tombol hapus
    $id_satuan = mysqli_real_escape_string($mysqli, $_GET['id']);

    // mengecek data satuan untuk mencegah penghapusan data satuan yang sudah digunakan di tabel "tbl_barang"
    // sql statement untuk menampilkan data "satuan" dari tabel "tbl_barang" berdasarkan input "id_satuan"
    $query = mysqli_query($mysqli, "SELECT satuan FROM tbl_barang WHERE satuan='$id_satuan'")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil jumlah baris data hasil query
    $rows = mysqli_num_rows($query);

    // cek hasil query
    // jika data satuan sudah ada di tabel "tbl_barang"
    if ($rows <> 0) {
      // alihkan ke halaman satuan dan tampilkan pesan gagal hapus data
      header('location: ../../main.php?module=satuan&pesan=5');
    }
    // jika data satuan belum ada di tabel "tbl_barang"
    else {
      // sql statement untuk delete data dari tabel "tbl_satuan" berdasarkan "id_satuan"
      $delete = mysqli_query($mysqli, "DELETE FROM tbl_satuan WHERE id_satuan='$id_satuan'")
                                       or die('Ada kesalahan pada query delete : ' . mysqli_error($mysqli));
      // cek query
      // jika proses delete berhasil
      if ($delete) {
        // alihkan ke halaman satuan dan tampilkan pesan berhasil hapus data
        header('location: ../../main.php?module=satuan&pesan=3');
      }
    }
  }
}
