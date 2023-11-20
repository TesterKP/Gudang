<?php
// mencegah direct access file PHP agar file PHP tidak bisa diakses secara langsung dari browser dan hanya dapat dijalankan ketika di include oleh file lain
// jika file diakses secara langsung
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
  // alihkan ke halaman error 404
  header('location: 404.html');
}
// jika file di include oleh file lain, tampilkan isi file
else {
  // mengecek data GET "id_satuan"
  if (isset($_GET['id'])) {
    // ambil data GET dari tombol ubah
    $id_satuan = $_GET['id'];

    // sql statement untuk menampilkan data dari tabel "tbl_satuan" berdasarkan "id_satuan"
    $query = mysqli_query($mysqli, "SELECT * FROM tbl_satuan WHERE id_satuan='$id_satuan'")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil data hasil query
    $data = mysqli_fetch_assoc($query);
  }
?>
  <div class="panel-header bg-secondary-gradient">
    <div class="page-inner py-4">
      <div class="page-header text-white">
        <!-- judul halaman -->
        <h4 class="page-title text-white"><i class="fas fa-clone mr-2"></i> Satuan</h4>
        <!-- breadcrumbs -->
        <ul class="breadcrumbs">
          <li class="nav-home"><a href="?module=dashboard"><i class="flaticon-home text-white"></i></a></li>
          <li class="separator"><i class="flaticon-right-arrow"></i></li>
          <li class="nav-item"><a href="?module=satuan" class="text-white">Satuan</a></li>
          <li class="separator"><i class="flaticon-right-arrow"></i></li>
          <li class="nav-item"><a>Ubah</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="page-inner mt--5">
    <div class="card">
      <div class="card-header">
        <!-- judul form -->
        <div class="card-title">Ubah Data Satuan</div>
      </div>
      <!-- form ubah data -->
      <form action="modules/satuan/proses_ubah.php" method="post" class="needs-validation" novalidate>
        <div class="card-body">
          <input type="hidden" name="id_satuan" value="<?php echo $data['id_satuan']; ?>">

          <div class="form-group">
            <label>Satuan <span class="text-danger">*</span></label>
            <input type="text" name="nama_satuan" class="form-control col-lg-5" autocomplete="off" value="<?php echo $data['nama_satuan']; ?>" required>
            <div class="invalid-feedback">Satuan tidak boleh kosong.</div>
          </div>
        </div>
        <div class="card-action">
          <!-- tombol simpan data -->
          <input type="submit" name="simpan" value="Simpan" class="btn btn-secondary btn-round pl-4 pr-4 mr-2">
          <!-- tombol kembali ke halaman data satuan -->
          <a href="?module=satuan" class="btn btn-default btn-round pl-4 pr-4">Batal</a>
        </div>
      </form>
    </div>
  </div>
<?php } ?>