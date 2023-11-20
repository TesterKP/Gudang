<?php
// mencegah direct access file PHP agar file PHP tidak bisa diakses secara langsung dari browser dan hanya dapat dijalankan ketika di include oleh file lain
// jika file diakses secara langsung
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
  // alihkan ke halaman error 404
  header('location: 404.html');
}
// jika file di include oleh file lain, tampilkan isi file
else { ?>
  <!-- menampilkan pesan kesalahan unggah file -->
  <div id="pesan"></div>

  <div class="panel-header bg-secondary-gradient">
    <div class="page-inner py-4">
      <div class="page-header text-white">
        <!-- judul halaman -->
        <h4 class="page-title text-white"><i class="fas fa-clone mr-2"></i> Barang</h4>
        <!-- breadcrumbs -->
        <ul class="breadcrumbs">
          <li class="nav-home"><a href="?module=dashboard"><i class="flaticon-home text-white"></i></a></li>
          <li class="separator"><i class="flaticon-right-arrow"></i></li>
          <li class="nav-item"><a href="?module=barang" class="text-white">Barang</a></li>
          <li class="separator"><i class="flaticon-right-arrow"></i></li>
          <li class="nav-item"><a>Entri</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="page-inner mt--5">
    <div class="card">
      <div class="card-header">
        <!-- judul form -->
        <div class="card-title">Entri Data Barang</div>
      </div>
      <!-- form entri data -->
      <form action="modules/barang/proses_entri.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        <div class="card-body">
          <div class="row">
            <div class="col-md-7">
              <div class="form-group">
                <?php
                // membuat "id_barang"
                // sql statement untuk menampilkan 4 digit terakhir dari "id_barang" pada tabel "tbl_barang"
                $query = mysqli_query($mysqli, "SELECT RIGHT(id_barang,4) as nomor FROM tbl_barang ORDER BY id_barang DESC LIMIT 1")
                                                or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
                // ambil jumlah baris data hasil query
                $rows = mysqli_num_rows($query);

                // cek hasil query
                // jika "id_barang" sudah ada
                if ($rows <> 0) {
                  // ambil data hasil query
                  $data = mysqli_fetch_assoc($query);
                  // nomor urut "id_barang" yang terakhir + 1 (contoh nomor urut yang terakhir adalah 2, maka 2 + 1 = 3, dst..)
                  $nomor_urut = $data['nomor'] + 1;
                }
                // jika "id_barang" belum ada
                else {
                  // nomor urut "id_barang" = 1
                  $nomor_urut = 1;
                }

                // menambahkan karakter "B" diawal dan karakter "0" disebelah kiri nomor urut
                $id_barang = "B" . str_pad($nomor_urut, 4, "0", STR_PAD_LEFT);
                ?>
                <label>ID Barang <span class="text-danger">*</span></label>
                <!-- tampilkan "id_barang" -->
                <input type="text" name="id_barang" class="form-control" value="<?php echo $id_barang; ?>" readonly>
              </div>

              <div class="form-group">
                <label>Nama Barang <span class="text-danger">*</span></label>
                <input type="text" name="nama_barang" class="form-control" autocomplete="off" required>
                <div class="invalid-feedback">Nama barang tidak boleh kosong.</div>
              </div>

              <div class="form-group">
                <label>Jenis Barang <span class="text-danger">*</span></label>
                <select name="jenis" class="form-control chosen-select" autocomplete="off" required>
                  <option selected disabled value="">-- Pilih --</option>
                  <?php
                  // sql statement untuk menampilkan data dari tabel "tbl_jenis"
                  $query_jenis = mysqli_query($mysqli, "SELECT * FROM tbl_jenis ORDER BY nama_jenis ASC")
                                                        or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
                  // ambil data hasil query
                  while ($data_jenis = mysqli_fetch_assoc($query_jenis)) {
                    // tampilkan data
                    echo "<option value='$data_jenis[id_jenis]'>$data_jenis[nama_jenis]</option>";
                  }
                  ?>
                </select>
                <div class="invalid-feedback">Jenis Barang tidak boleh kosong.</div>
              </div>

              <div class="form-group">
                <label>Stok Minimum <span class="text-danger">*</span></label>
                <input type="text" name="stok_minimum" class="form-control" autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)" required>
                <div class="invalid-feedback">Stok minimum tidak boleh kosong.</div>
              </div>

              <div class="form-group">
                <label>Satuan <span class="text-danger">*</span></label>
                <select name="satuan" class="form-control chosen-select" autocomplete="off" required>
                  <option selected disabled value="">-- Pilih --</option>
                  <?php
                  // sql statement untuk menampilkan data dari tabel "tbl_satuan"
                  $query_satuan = mysqli_query($mysqli, "SELECT * FROM tbl_satuan ORDER BY nama_satuan ASC")
                                                         or die('Ada kesalahan pada query tampil data : ' . mysqli_error($mysqli));
                  // ambil data hasil query
                  while ($data_satuan = mysqli_fetch_assoc($query_satuan)) {
                    // tampilkan data
                    echo "<option value='$data_satuan[id_satuan]'>$data_satuan[nama_satuan]</option>";
                  }
                  ?>
                </select>
                <div class="invalid-feedback">Satuan tidak boleh kosong.</div>
              </div>
            </div>
            <div class="col-md-5 ml-auto">
              <div class="form-group">
                <label>Foto Barang</label>
                <input type="file" id="foto" name="foto" class="form-control" autocomplete="off">
                <div class="card mt-3 mb-3">
                  <div class="card-body text-center">
                    <img style="max-height:200px" src="images/no_image.png" class="img-fluid foto-preview" alt="Foto Barang">
                  </div>
                </div>
                <small class="form-text text-secondary">
                  Keterangan : <br>
                  - Tipe file yang bisa diunggah adalah *.jpg atau *.png. <br>
                  - Ukuran file yang bisa diunggah maksimal 1 Mb.
                </small>
              </div>
            </div>
          </div>
        </div>
        <div class="card-action">
          <!-- tombol simpan data -->
          <input type="submit" name="simpan" value="Simpan" class="btn btn-secondary btn-round pl-4 pr-4 mr-2">
          <!-- tombol kembali ke halaman data barang -->
          <a href="?module=barang" class="btn btn-default btn-round pl-4 pr-4">Batal</a>
        </div>
      </form>
    </div>
  </div>

  <script type="text/javascript">
    $(document).ready(function() {
      // validasi file dan preview file sebelum diunggah
      $('#foto').change(function() {
        // mengambil value dari file
        var filePath = $('#foto').val();
        var fileSize = $('#foto')[0].files[0].size;
        // tentukan extension file yang diperbolehkan
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

        // Jika tipe file yang diunggah tidak sesuai dengan "allowedExtensions"
        if (!allowedExtensions.exec(filePath)) {
          // tampilkan pesan peringatan tipe file tidak sesuai
          $('#pesan').html('<div class="alert alert-notify alert-danger alert-dismissible fade show" role="alert"><span data-notify="icon" class="fas fa-times"></span><span data-notify="title" class="text-danger">Gagal!</span> <span data-notify="message">Tipe file tidak sesuai. Harap unggah file yang memiliki tipe *.jpg atau *.png.</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          // reset input file
          $('#foto').val('');
          // tampilkan file default
          $('.foto-preview').attr('src', 'images/no_image.png');

          return false;
        }
        // jika ukuran file yang diunggah lebih dari 1 Mb
        else if (fileSize > 1000000) {
          // tampilkan pesan peringatan ukuran file tidak sesuai
          $('#pesan').html('<div class="alert alert-notify alert-danger alert-dismissible fade show" role="alert"><span data-notify="icon" class="fas fa-times"></span><span data-notify="title" class="text-danger">Gagal!</span> <span data-notify="message">Ukuran file lebih dari 1 Mb. Harap unggah file yang memiliki ukuran maksimal 1 Mb.</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          // reset input file
          $('#foto').val('');
          // tampilkan file default
          $('.foto-preview').attr('src', 'images/no_image.png');

          return false;
        }
        // jika file yang diunggah sudah sesuai, tampilkan preview file
        else {
          var fileInput = document.getElementById('foto');

          if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
              // preview file
              $('.foto-preview').attr('src', e.target.result);
            };
          };
          reader.readAsDataURL(fileInput.files[0]);
        }
      });
    });
  </script>
<?php } ?>