<?php
// mencegah direct access file PHP agar file PHP tidak bisa diakses secara langsung dari browser dan hanya dapat dijalankan ketika di include oleh file lain
// jika file diakses secara langsung
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
  // alihkan ke halaman error 404
  header('location: 404.html');
}
// jika file di include oleh file lain, tampilkan isi file
else {
  // panggil file "database.php" untuk koneksi ke database
  require_once "config/database.php";

  // pemanggilan file halaman konten sesuai "module" yang dipilih
  // jika module yang dipilih "dashboard"
  if ($_GET['module'] == 'dashboard') {
    // panggil file tampil data dashboard
    include "modules/dashboard/tampil_data.php";
  }
  // jika module yang dipilih "barang" dan hak akses bukan "Kepala Gudang"
  elseif ($_GET['module'] == 'barang' && $_SESSION['hak_akses'] != 'Owner') {
    // panggil file tampil data barang
    include "modules/barang/tampil_data.php";
  }
  // jika module yang dipilih "form_entri_barang" dan hak akses bukan "Kepala Gudang"
  elseif ($_GET['module'] == 'form_entri_barang' && $_SESSION['hak_akses'] != 'Owner') {
    // panggil file form entri barang
    include "modules/barang/form_entri.php";
  }
  // jika module yang dipilih "form_ubah_barang" dan hak akses bukan "Kepala Gudang"
  elseif ($_GET['module'] == 'form_ubah_barang' && $_SESSION['hak_akses'] != 'Owner') {
    // panggil file form ubah barang
    include "modules/barang/form_ubah.php";
  }
  // jika module yang dipilih "tampil_detail_barang" dan hak akses bukan "Kepala Gudang"
  elseif ($_GET['module'] == 'tampil_detail_barang' && $_SESSION['hak_akses'] != 'Owner') {
    // panggil file tampil detail barang
    include "modules/barang/tampil_detail.php";
  }
  // jika module yang dipilih "jenis" dan hak akses bukan "Kepala Gudang"
  elseif ($_GET['module'] == 'jenis' && $_SESSION['hak_akses'] != 'Owner') {
    // panggil file tampil data jenis
    include "modules/jenis/tampil_data.php";
  }
  // jika module yang dipilih "form_entri_jenis" dan hak akses bukan "Kepala Gudang"
  elseif ($_GET['module'] == 'form_entri_jenis' && $_SESSION['hak_akses'] != 'Owner') {
    // panggil file form entri jenis
    include "modules/jenis/form_entri.php";
  }
  // jika module yang dipilih "form_ubah_jenis" dan hak akses bukan "Kepala Gudang"
  elseif ($_GET['module'] == 'form_ubah_jenis' && $_SESSION['hak_akses'] != 'Owner') {
    // panggil file form ubah jenis
    include "modules/jenis/form_ubah.php";
  }
  // jika module yang dipilih "satuan" dan hak akses bukan "Kepala Gudang"
  elseif ($_GET['module'] == 'satuan' && $_SESSION['hak_akses'] != 'Owner') {
    // panggil file tampil data satuan
    include "modules/satuan/tampil_data.php";
  }
  // jika module yang dipilih "form_entri_satuan" dan hak akses bukan "Kepala Gudang"
  elseif ($_GET['module'] == 'form_entri_satuan' && $_SESSION['hak_akses'] != 'Owner') {
    // panggil file form entri satuan
    include "modules/satuan/form_entri.php";
  }
  // jika module yang dipilih "form_ubah_satuan" dan hak akses bukan "Kepala Gudang"
  elseif ($_GET['module'] == 'form_ubah_satuan' && $_SESSION['hak_akses'] != 'Owner') {
    // panggil file form ubah satuan
    include "modules/satuan/form_ubah.php";
  }
  // jika module yang dipilih "barang_masuk" dan hak akses bukan "Kepala Gudang"
  elseif ($_GET['module'] == 'barang_masuk' && $_SESSION['hak_akses'] != 'Owner') {
    // panggil file tampil data barang masuk
    include "modules/barang-masuk/tampil_data.php";
  }
  // jika module yang dipilih "form_entri_barang_masuk" dan hak akses bukan "Kepala Gudang"
  elseif ($_GET['module'] == 'form_entri_barang_masuk' && $_SESSION['hak_akses'] != 'Owner') {
    // panggil file form entri barang masuk
    include "modules/barang-masuk/form_entri.php";
  }
  // jika module yang dipilih "barang_keluar" dan hak akses bukan "Kepala Gudang"
  elseif ($_GET['module'] == 'barang_keluar' && $_SESSION['hak_akses'] != 'Owner') {
    // panggil file tampil data barang keluar
    include "modules/barang-keluar/tampil_data.php";
  }
  // jika module yang dipilih "form_entri_barang_keluar" dan hak akses bukan "Kepala Gudang"
  elseif ($_GET['module'] == 'form_entri_barang_keluar' && $_SESSION['hak_akses'] != 'Owner') {
    // panggil file form entri barang keluar
    include "modules/barang-keluar/form_entri.php";
  }
  // jika module yang dipilih "laporan_stok"
  elseif ($_GET['module'] == 'laporan_stok') {
    // panggil file tampil data laporan stok
    include "modules/laporan-stok/tampil_data.php";
  }
  // jika module yang dipilih "laporan_barang_masuk"
  elseif ($_GET['module'] == 'laporan_barang_masuk') {
    // panggil file tampil data laporan barang masuk
    include "modules/laporan-barang-masuk/tampil_data.php";
  }
  // jika module yang dipilih "laporan_barang_keluar"
  elseif ($_GET['module'] == 'laporan_barang_keluar') {
    // panggil file tampil data laporan barang keluar
    include "modules/laporan-barang-keluar/tampil_data.php";
  }
  // jika module yang dipilih "user" dan hak akses "Administrator"
  elseif ($_GET['module'] == 'user' && $_SESSION['hak_akses'] == 'Administrator') {
    // panggil file tampil data user
    include "modules/user/tampil_data.php";
  }
  // jika module yang dipilih "form_entri_user" dan hak akses "Administrator"
  elseif ($_GET['module'] == 'form_entri_user' && $_SESSION['hak_akses'] == 'Administrator') {
    // panggil file form entri user
    include "modules/user/form_entri.php";
  }
  // jika module yang dipilih "form_ubah_user" dan hak akses "Administrator"
  elseif ($_GET['module'] == 'form_ubah_user' && $_SESSION['hak_akses'] == 'Administrator') {
    // panggil file form ubah user
    include "modules/user/form_ubah.php";
  }
  // jika module yang dipilih "form_ubah_password"
  elseif ($_GET['module'] == 'form_ubah_password') {
    // panggil file form ubah password
    include "modules/password/form_ubah.php";
  }
}
