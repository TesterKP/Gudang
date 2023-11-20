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
    // mengecek data session login user
    if (isset($_SESSION['id_user'])) {
      // ambil data hasil submit dari form
      $password_lama       = mysqli_real_escape_string($mysqli, $_POST['password_lama']);
      $password_baru       = mysqli_real_escape_string($mysqli, $_POST['password_baru']);
      $konfirmasi_password = mysqli_real_escape_string($mysqli, $_POST['konfirmasi_password']);
      // ambil data dari session login user
      $id_user             = $_SESSION['id_user'];

      // sql statement untuk menampilkan data "password" dari tabel "tbl_user" berdasarkan "id_user"
      $query = mysqli_query($mysqli, "SELECT password FROM tbl_user WHERE id_user=$id_user")
                                      or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
      // ambil data hasil query
      $data = mysqli_fetch_assoc($query);
      // tampilkan data "password" dari database
      $password_lama_hash = $data['password'];

      /*  
        validasi password lama menggunakan password_verify()
        $password_lama      ---> password yang diinputkan user melalui form ubah password
        $password_lama_hash ---> password user dalam database 
      */
      // jika input password lama sama dengan password di database, lanjutkan untuk pengecekan password baru
      if (password_verify($password_lama, $password_lama_hash)) {
        // jika input password baru tidak sama dengan input konfirmasi password baru
        if ($password_baru != $konfirmasi_password) {
          // alihkan ke halaman ubah password dan tampilkan pesan gagal ubah data
          header('location: ../../main.php?module=form_ubah_password&pesan=2');
        }
        // jika input password baru sama dengan input konfirmasi password baru
        else {
          // enkripsi password baru menggunakan password_hash()
          // tentukan cost (menentukan seberapa banyak proses hash dilakukan)
          $options = [
            'cost' => 12,
          ];
          // hashing password
          $password_baru_hash = password_hash($password_baru, PASSWORD_DEFAULT, $options);

          // sql statement untuk update data "password" di tabel "tbl_user" berdasarkan "id_user"
          $update = mysqli_query($mysqli, "UPDATE tbl_user 
                                           SET password='$password_baru_hash' 
                                           WHERE id_user='$id_user'")
                                           or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));
          // cek query
          // jika proses update berhasil
          if ($update) {
            // alihkan ke halaman ubah password dan tampilkan pesan berhasil ubah data
            header('location: ../../main.php?module=form_ubah_password&pesan=3');
          }
        }
      }
      // jika input password lama tidak sama dengan password di database
      else {
        // alihkan ke halaman ubah password dan tampilkan pesan gagal ubah data
        header('location: ../../main.php?module=form_ubah_password&pesan=1');
      }
    }
  }
}
