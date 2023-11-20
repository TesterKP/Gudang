<?php
// mencegah direct access file PHP agar file PHP tidak bisa diakses secara langsung dari browser dan hanya dapat dijalankan ketika di include oleh file lain
// jika file diakses secara langsung
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
  // alihkan ke halaman error 404
  header('location: 404.html');
}
// jika file di include oleh file lain, tampilkan isi file
else {
  // mengecek data GET "id_barang"
  if (isset($_GET['id'])) {
    // ambil data GET dari tombol detail
    $id_barang = $_GET['id'];

    // sql statement untuk menampilkan data dari tabel "tbl_barang", tabel "tbl_jenis", dan tabel "tbl_satuan" berdasarkan "id_barang"
    $query = mysqli_query($mysqli, "SELECT a.id_barang, a.nama_barang, a.jenis, a.stok_minimum, a.stok, a.satuan, a.foto, b.nama_jenis, c.nama_satuan
                                    FROM tbl_barang as a INNER JOIN tbl_jenis as b INNER JOIN tbl_satuan as c 
                                    ON a.jenis=b.id_jenis AND a.satuan=c.id_satuan 
                                    WHERE a.id_barang='$id_barang'")
                                    or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
    // ambil data hasil query
    $data = mysqli_fetch_assoc($query);
  }
?>
  <div class="panel-header bg-secondary-gradient">
    <div class="page-inner py-45">
      <div class="d-flex align-items-left align-items-md-top flex-column flex-md-row">
        <div class="page-header text-white">
          <!-- judul halaman -->
          <h4 class="page-title text-white"><i class="fas fa-clone mr-2"></i> Barang</h4>
          <!-- breadcrumbs -->
          <ul class="breadcrumbs">
            <li class="nav-home"><a href="?module=dashboard"><i class="flaticon-home text-white"></i></a></li>
            <li class="separator"><i class="flaticon-right-arrow"></i></li>
            <li class="nav-item"><a href="?module=barang" class="text-white">Barang</a></li>
            <li class="separator"><i class="flaticon-right-arrow"></i></li>
            <li class="nav-item"><a>Detail</a></li>
          </ul>
        </div>
        <div class="ml-md-auto py-2 py-md-0">
          <!-- tombol kembali ke halaman data barang -->
          <a href="?module=barang" class="btn btn-secondary btn-round">
            <span class="btn-label"><i class="far fa-arrow-alt-circle-left mr-2"></i></span> Kembali
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="page-inner mt--5">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <!-- judul form -->
            <div class="card-title">Detail Data Barang</div>
          </div>
          <!-- detail data -->
          <div class="card-body">
            <table class="table table-striped">
              <tr>
                <td width="120">ID Barang</td>
                <td width="10">:</td>
                <td><?php echo $data['id_barang']; ?></td>
              </tr>
              <tr>
                <td>Nama Barang</td>
                <td>:</td>
                <td><?php echo $data['nama_barang']; ?></td>
              </tr>
              <tr>
                <td>Jenis Barang</td>
                <td>:</td>
                <td><?php echo $data['nama_jenis']; ?></td>
              </tr>
              <tr>
                <td>Stok Minimum</td>
                <td>:</td>
                <td><?php echo $data['stok_minimum']; ?></td>
              </tr>
              <tr>
                <td>Stok</td>
                <td>:</td>
                <td><?php echo $data['stok']; ?></td>
              </tr>
              <tr>
                <td>Satuan</td>
                <td>:</td>
                <td><?php echo $data['nama_satuan']; ?></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body text-center">
            <?php
            // mengecek data foto barang
            // jika data "foto" tidak ada di database
            if (is_null($data['foto'])) { ?>
              <!-- tampilkan foto default -->
              <img style="max-height:375px" src="images/no_image.png" class="img-fluid" alt="Foto Barang">
            <?php
            }
            // jika data "foto" ada di database
            else { ?>
              <!-- tampilkan foto barang dari database -->
              <img style="max-height:375px" src="images/<?php echo $data['foto']; ?>" class="img-fluid" alt="Foto Barang">
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php } ?>