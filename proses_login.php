<?php
// panggil file "database.php" untuk koneksi ke database
require_once "config/database.php";

// ambil data hasil submit dari form
$username = mysqli_real_escape_string($mysqli, $_POST['username']);
$password = mysqli_real_escape_string($mysqli, $_POST['password']);

// sql statement untuk menampilkan data dari tabel "tbl_user" berdasarkan "username"
$query = mysqli_query($mysqli, "SELECT * FROM tbl_user WHERE username='$username'")
                                or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
// ambil jumlah baris data hasil query
$rows = mysqli_num_rows($query);

// cek hasil query
// jika data "username" ada, lanjutkan untuk pengecekan "password"
if ($rows <> 0) {
  // ambil data hasil query
  $data = mysqli_fetch_assoc($query);
  // tampilkan data "password" dari database
  $password_hash = $data['password'];

  /* 	
		validasi password saat login menggunakan password_verify()
		$password	      ---> password yang diinputkan user melalui form login
		$password_hash  ---> password user dalam database 
	*/
  // jika password valid
  if (password_verify($password, $password_hash)) {
    // mengaktifkan session
    session_start();
    // membuat session user
    $_SESSION['id_user']   = $data['id_user'];
    $_SESSION['nama_user'] = $data['nama_user'];
    $_SESSION['username']  = $data['username'];
    $_SESSION['password']  = $data['password'];
    $_SESSION['hak_akses'] = $data['hak_akses'];

    // lalu alihkan ke halaman dashboard dan tampilkan pesan selamat datang
    header('location: main.php?module=dashboard&pesan=1');
  }
  // jika password tidak valid
  else {
    // alihkan ke halaman login dan tampilkan pesan gagal login
    header('location: login.php?pesan=1');
  }
}
// jika data "username" tidak ada
else {
  // alihkan ke halaman login dan tampilkan pesan gagal login
  header('location: login.php?pesan=1');
}
