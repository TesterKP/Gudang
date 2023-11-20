<?php
session_start();      // mengaktifkan session

// pengecekan session login user 
// jika user belum login
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
  // alihkan ke halaman login dan tampilkan pesan peringatan login
  header('location: ../../login.php?pesan=2');
}
// jika user sudah login, maka jalankan perintah untuk export
else {
  // panggil file "database.php" untuk koneksi ke database
  require_once "../../config/database.php";

  // fungsi header untuk mengirimkan raw data excel
  header("Content-type: application/vnd-ms-excel");
  // mendefinisikan nama file hasil ekspor "Data-Satuan.xls"
  header("Content-Disposition: attachment; filename=Data-Satuan.xls");
?>
  <!-- halaman HTML yang akan diexport ke excel -->
  <!-- judul tabel -->
  <center>
    <h4>DATA SATUAN</h4>
  </center>
  <!-- tabel untuk menampilkan data dari database -->
  <table border="1">
    <thead>
      <tr style="background-color:#6861ce;color:#fff">
        <th height="30" align="center" vertical="center">No.</th>
        <th height="30" align="center" vertical="center">Satuan</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // variabel untuk nomor urut tabel 
      $no = 1;
      // sql statement untuk menampilkan data dari tabel "tbl_satuan"
      $query = mysqli_query($mysqli, "SELECT * FROM tbl_satuan ORDER BY nama_satuan ASC")
                                      or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
      // ambil data hasil query
      while ($data = mysqli_fetch_assoc($query)) { ?>
        <!-- tampilkan data -->
        <tr>
          <td width="70" align="center"><?php echo $no++; ?></td>
          <td width="500"><?php echo $data['nama_satuan']; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
<?php } ?>