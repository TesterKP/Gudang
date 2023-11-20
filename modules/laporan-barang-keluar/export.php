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
  // panggil file "fungsi_tanggal_indo.php" untuk membuat format tanggal indonesia
  require_once "../../helper/fungsi_tanggal_indo.php";

  // ambil data GET dari tombol export
  $tanggal_awal  = $_GET['tanggal_awal'];
  $tanggal_akhir = $_GET['tanggal_akhir'];

  // fungsi header untuk mengirimkan raw data excel
  header("Content-type: application/vnd-ms-excel");
  // mendefinisikan nama file hasil ekspor "Laporan Data Barang Keluar.xls"
  header("Content-Disposition: attachment; filename=Laporan Data Barang Keluar.xls");
?>
  <!-- halaman HTML yang akan diexport ke excel -->
  <!-- judul tabel -->
  <center>
    <h4>
      LAPORAN DATA BARANG KELUAR<br>
      Tanggal <?php echo $tanggal_awal; ?> s.d <?php echo $tanggal_akhir; ?>
    </h4>
  </center>
  <!-- tabel untuk menampilkan data dari database -->
  <table border="1">
    <thead>
      <tr style="background-color:#6861ce;color:#fff">
        <th height="30" align="center" vertical="center">No.</th>
        <th height="30" align="center" vertical="center">ID Transaksi</th>
        <th height="30" align="center" vertical="center">Tanggal</th>
        <th height="30" align="center" vertical="center">Barang</th>
        <th height="30" align="center" vertical="center">Jumlah Keluar</th>
        <th height="30" align="center" vertical="center">Satuan</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // ubah format tanggal menjadi Tahun-Bulan-Hari (Y-m-d)
      $tanggal_awal  = date('Y-m-d', strtotime($tanggal_awal));
      $tanggal_akhir = date('Y-m-d', strtotime($tanggal_akhir));

      // variabel untuk nomor urut tabel 
      $no = 1;

      // sql statement untuk menampilkan data dari tabel "tbl_barang_keluar", tabel "tbl_barang", dan tabel "tbl_satuan" berdasarkan "tanggal"
      $query = mysqli_query($mysqli, "SELECT a.id_transaksi, a.tanggal, a.barang, a.jumlah, b.nama_barang, c.nama_satuan
                                      FROM tbl_barang_keluar as a INNER JOIN tbl_barang as b INNER JOIN tbl_satuan as c 
                                      ON a.barang=b.id_barang AND b.satuan=c.id_satuan 
                                      WHERE a.tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ORDER BY a.id_transaksi ASC")
                                      or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
      // ambil data hasil query
      while ($data = mysqli_fetch_assoc($query)) { ?>
        <!-- tampilkan data -->
        <tr>
          <td width="70" align="center"><?php echo $no++; ?></td>
          <td width="150" align="center"><?php echo $data['id_transaksi']; ?></td>
          <td width="130" align="center"><?php echo date('d-m-Y', strtotime($data['tanggal'])); ?></td>
          <td width="300"><?php echo $data['barang']; ?> - <?php echo $data['nama_barang']; ?></td>
          <td width="130" align="right"><?php echo number_format($data['jumlah'], 0, '', '.'); ?></td>
          <td width="130"><?php echo $data['nama_satuan']; ?></td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  <br>
  <div style="text-align:right">............, <?php echo tanggal_indo(date('Y-m-d')); ?></div>
<?php } ?>