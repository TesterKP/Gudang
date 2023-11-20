<?php
// mencegah direct access file PHP agar file PHP tidak bisa diakses secara langsung dari browser dan hanya dapat dijalankan ketika di include oleh file lain
// jika file diakses secara langsung
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
  // alihkan ke halaman error 404
  header('location: 404.html');
}
// jika file di include oleh file lain, tampilkan isi file
else {
  // menampilkan pesan selamat datang
  // jika pesan tersedia
  if (isset($_GET['pesan'])) {
    // jika pesan = 1
    if ($_GET['pesan'] == 1) {
      // tampilkan pesan selamat datang
      echo '<div class="alert alert-notify alert-secondary alert-dismissible fade show" role="alert">
              <span data-notify="icon" class="fas fa-user-alt"></span> 
              <span data-notify="title" class="text-secondary">Hi! ' . $_SESSION['nama_user'] . '</span> 
              <span data-notify="message">Selamat Datang di Aplikasi Gudang UD.Wong Coco.</span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
    }
  }
?>
  <div class="panel-header bg-secondary-gradient">
    <div class="page-inner py-5">
      <div class="d-flex align-items-left align-items-md-top flex-column flex-md-row">
        <div class="page-header text-white">
          <!-- judul halaman -->
          <h4 class="page-title text-white"><i class="fas fa-home mr-2"></i> Dashboard</h4>
        </div>
      </div>
    </div>
  </div>
  <div class="page-inner mt--5">
    <div class="row row-card-no-pd mt--2">
      <!-- menampilkan informasi jumlah data barang -->
      <div class="col-sm-12 col-md-4">
        <div class="card card-stats card-round">
          <div class="card-body ">
            <div class="row">
              <div class="col-5">
                <div class="icon-big2 text-center">
                  <i class="flaticon-box-2 text-secondary"></i>
                </div>
              </div>
              <div class="col-7 col-stats">
                <div class="numbers">
                  <p class="card-category">Data Barang</p>
                  <?php
                  // sql statement untuk menampilkan jumlah data pada tabel "tbl_barang"
                  $query = mysqli_query($mysqli, "SELECT * FROM tbl_barang")
                                                  or die('Ada kesalahan pada query jumlah data barang : ' . mysqli_error($mysqli));
                  // ambil jumlah data dari hasil query
                  $jumlah_barang = mysqli_num_rows($query);
                  ?>
                  <!-- tampilkan data -->
                  <h4 class="card-title"><?php echo number_format($jumlah_barang, 0, '', '.'); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- menampilkan informasi jumlah data barang masuk -->
      <div class="col-sm-12 col-md-4">
        <div class="card card-stats card-round">
          <div class="card-body ">
            <div class="row">
              <div class="col-5">
                <div class="icon-big2 text-center">
                  <i class="flaticon-inbox text-success"></i>
                </div>
              </div>
              <div class="col-7 col-stats">
                <div class="numbers">
                  <p class="card-category">Data Barang Masuk</p>
                  <?php
                  // sql statement untuk menampilkan jumlah data pada tabel "tbl_barang_masuk"
                  $query = mysqli_query($mysqli, "SELECT * FROM tbl_barang_masuk")
                                                  or die('Ada kesalahan pada query jumlah data barang masuk : ' . mysqli_error($mysqli));
                  // ambil jumlah data dari hasil query
                  $jumlah_barang_masuk = mysqli_num_rows($query);
                  ?>
                  <!-- tampilkan data -->
                  <h4 class="card-title"><?php echo number_format($jumlah_barang_masuk, 0, '', '.'); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- menampilkan informasi jumlah data barang keluar -->
      <div class="col-sm-12 col-md-4">
        <div class="card card-stats card-round">
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <div class="icon-big2 text-center">
                  <i class="flaticon-archive text-warning"></i>
                </div>
              </div>
              <div class="col-7 col-stats">
                <div class="numbers">
                  <p class="card-category">Data Barang Keluar</p>
                  <?php
                  // sql statement untuk menampilkan jumlah data pada tabel "tbl_barang_keluar"
                  $query = mysqli_query($mysqli, "SELECT * FROM tbl_barang_keluar")
                                                  or die('Ada kesalahan pada query jumlah data barang keluar : ' . mysqli_error($mysqli));
                  // ambil jumlah data dari hasil query
                  $jumlah_barang_keluar = mysqli_num_rows($query);
                  ?>
                  <!-- tampilkan data -->
                  <h4 class="card-title"><?php echo number_format($jumlah_barang_keluar, 0, '', '.'); ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php } ?>