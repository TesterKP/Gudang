<?php
session_start();      // mengaktifkan session

// pengecekan session login user 
// jika user belum login
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
  // alihkan ke halaman login dan tampilkan pesan peringatan login
  header('location: ../../login.php?pesan=2');
}
// jika user sudah login, maka jalankan perintah untuk update
else {
  // panggil file "database.php" untuk koneksi ke database
  require_once "../../config/database.php";

  // mengecek data hasil submit dari form
  if (isset($_POST['simpan'])) {
    // ambil data hasil submit dari form
    $id_satuan   = mysqli_real_escape_string($mysqli, $_POST['id_satuan']);
    $nama_satuan = mysqli_real_escape_string($mysqli, trim($_POST['nama_satuan']));

    // mengecek "nama_satuan" untuk mencegah data duplikat
    // sql statement untuk menampilkan data "nama_satuan" dari tabel "tbl_satuan" berdasarkan input "nama_satuan"
    $query = mysqli_query($mysqli, "SELECT nama_satuan FROM tbl_satuan WHERE nama_satuan='$nama_satuan' AND id_satuan!='$id_satuan'")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil jumlah baris data hasil query
    $rows = mysqli_num_rows($query);

    // cek hasil query
    // jika "nama_satuan" sudah ada di tabel "tbl_satuan"
    if ($rows <> 0) {
      // alihkan ke halaman satuan dan tampilkan pesan gagal ubah data
      header("location: ../../main.php?module=satuan&pesan=4&satuan=$nama_satuan");
    }
    // jika "nama_satuan" belum ada di tabel "tbl_satuan"
    else {
      // sql statement untuk update data di tabel "tbl_satuan" berdasarkan "id_satuan"
      $update = mysqli_query($mysqli, "UPDATE tbl_satuan
                                       SET nama_satuan='$nama_satuan'
                                       WHERE id_satuan='$id_satuan'")
                                       or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));
      // cek query
      // jika proses update berhasil
      if ($update) {
        // alihkan ke halaman satuan dan tampilkan pesan berhasil ubah data
        header('location: ../../main.php?module=satuan&pesan=2');
      }
    }
  }
}
