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
    $id_jenis   = mysqli_real_escape_string($mysqli, $_POST['id_jenis']);
    $nama_jenis = mysqli_real_escape_string($mysqli, trim($_POST['nama_jenis']));

    // mengecek "nama_jenis" untuk mencegah data duplikat
    // sql statement untuk menampilkan data "nama_jenis" dari tabel "tbl_jenis" berdasarkan input "nama_jenis"
    $query = mysqli_query($mysqli, "SELECT nama_jenis FROM tbl_jenis WHERE nama_jenis='$nama_jenis' AND id_jenis!='$id_jenis'")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil jumlah baris data hasil query
    $rows = mysqli_num_rows($query);

    // cek hasil query
    // jika "nama_jenis" sudah ada di tabel "tbl_jenis"
    if ($rows <> 0) {
      // alihkan ke halaman jenis barang dan tampilkan pesan gagal ubah data
      header("location: ../../main.php?module=jenis&pesan=4&jenis=$nama_jenis");
    }
    // jika "nama_jenis" belum ada di tabel "tbl_jenis"
    else {
      // sql statement untuk update data di tabel "tbl_jenis" berdasarkan "id_jenis"
      $update = mysqli_query($mysqli, "UPDATE tbl_jenis
                                       SET nama_jenis='$nama_jenis'
                                       WHERE id_jenis='$id_jenis'")
                                       or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));
      // cek query
      // jika proses update berhasil
      if ($update) {
        // alihkan ke halaman jenis barang dan tampilkan pesan berhasil ubah data
        header('location: ../../main.php?module=jenis&pesan=2');
      }
    }
  }
}
