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
    $nama_user = mysqli_real_escape_string($mysqli, trim($_POST['nama_user']));
    $username  = mysqli_real_escape_string($mysqli, trim($_POST['username']));
    $email  = mysqli_real_escape_string($mysqli, trim($_POST['email']));
    $password  = mysqli_real_escape_string($mysqli, $_POST['password']);
    $hak_akses = mysqli_real_escape_string($mysqli, trim($_POST['hak_akses']));

    // enkripsi password menggunakan password_hash()
    // tentukan cost (menentukan seberapa banyak proses hash dilakukan)
    $option = [
      'cost' => 12,
    ];
    // hashing password
    $password_hash = password_hash($password, PASSWORD_DEFAULT, $option);

    // mengecek "username" untuk mencegah data duplikat
    // sql statement untuk menampilkan data "username" dari tabel "tbl_user" berdasarkan input "username"
    $query = mysqli_query($mysqli, "SELECT username FROM tbl_user WHERE username='$username'")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil jumlah baris data hasil query
    $rows = mysqli_num_rows($query);

    // cek hasil query
    // jika "username" sudah ada di tabel "tbl_user"
    if ($rows <> 0) {
      // alihkan ke halaman user dan tampilkan pesan gagal simpan data
      header("location: ../../main.php?module=user&pesan=4&username=$username");
    }
    // jika "username" belum ada di tabel "tbl_user"
    else {
      // sql statement untuk insert data ke tabel "tbl_user"
      $insert = mysqli_query($mysqli, "INSERT INTO tbl_user(nama_user, username, email, password, hak_akses)
                                       VALUES('$nama_user', '$username', '$email', '$password_hash', '$hak_akses')")
                                       or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));
      // cek query
      // jika proses insert berhasil
      if ($insert) {
        // alihkan ke halaman user dan tampilkan pesan berhasil simpan data
        header('location: ../../main.php?module=user&pesan=1');
      }
    }
  }
}
