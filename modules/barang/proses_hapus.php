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

  // mengecek data GET "id_barang"
  if (isset($_GET['id'])) {
    // ambil data GET dari tombol hapus
    $id_barang = mysqli_real_escape_string($mysqli, $_GET['id']);

    // mengecek data barang untuk mencegah penghapusan data barang yang sudah digunakan di tabel "tbl_barang_masuk"
    // sql statement untuk menampilkan data "barang" dari tabel "tbl_barang_masuk" berdasarkan input "id_barang"
    $query = mysqli_query($mysqli, "SELECT barang FROM tbl_barang_masuk WHERE barang='$id_barang'")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil jumlah baris data hasil query
    $rows = mysqli_num_rows($query);

    // cek hasil query
    // jika data barang sudah ada di tabel "tbl_transaksi"
    if ($rows <> 0) {
      // alihkan ke halaman barang dan tampilkan pesan gagal hapus data
      header('location: ../../main.php?module=barang&pesan=4');
    }
    // jika data barang belum ada di tabel "tbl_transaksi"
    else {
      // mengecek data foto barang
      // sql statement untuk menampilkan data "foto" dari tabel "tbl_barang" berdasarkan "id_barang"
      $query = mysqli_query($mysqli, "SELECT foto FROM tbl_barang WHERE id_barang='$id_barang'")
                                      or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
      // ambil data hasil query
      $data = mysqli_fetch_assoc($query);
      // tampilkan data
      $foto = $data['foto'];

      // jika data "foto" tidak kosong
      if (!empty($foto)) {
        // hapus file foto dari folder images
        $hapus_file = unlink("../../images/$foto");
      }

      // sql statement untuk delete data dari tabel "tbl_barang" berdasarkan "id_barang"
      $delete = mysqli_query($mysqli, "DELETE FROM tbl_barang WHERE id_barang='$id_barang'")
                                       or die('Ada kesalahan pada query delete : ' . mysqli_error($mysqli));
      // cek query
      // jika proses delete berhasil
      if ($delete) {
        // alihkan ke halaman barang dan tampilkan pesan berhasil hapus data
        header('location: ../../main.php?module=barang&pesan=3');
      }
    }
  }
}
