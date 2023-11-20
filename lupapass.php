

  <!-- Title -->
  <title>Aplikasi Gudang Wong Coco</title>

  <!-- Favicon icon -->
  <link rel="icon" href="assets/img/favicon.png" type="image/x-icon" />

  <!-- Fonts and icons -->
  <script src="assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: {
        "families": ["Lato:300,400,700,900"]
      },
      custom: {
        "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
        urls: ['assets/css/fonts.min.css']
      },
      active: function() {
        sessionStorage.fonts = true;
      }
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/atlantis.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
</head>

<body class="login">
  <?php
  // menampilkan pesan sesuai dengan proses yang dijalankan
  // jika pesan tersedia
  if (isset($_GET['pesan'])) {
    // jika pesan = 1
    if ($_GET['pesan'] == 1) {
      // tampilkan pesan gagal login
      echo '<div class="alert alert-notify alert-danger alert-dismissible fade show" role="alert">
              <span data-notify="icon" class="fas fa-times"></span> 
              <span data-notify="title" class="text-danger">Gagal Login!</span> 
              <span data-notify="message">Username salah. Cek kembali Username Anda.</span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>';
    }
    // jika pesan = 2
    elseif ($_GET['pesan'] == 2) {
      // tampilkan pesan peringatan login
      echo '<div class="alert alert-notify alert-success alert-dismissible fade show" role="alert">
      <span data-notify="icon" class="fas fa-check"></span> 
      <span data-notify="title" class="text-success">Sukses!</span> 
      <span data-notify="message">Anda telah berhasil reset password silakan cek email anda!.</span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>';
    }
  }
  ?>

  <div class="wrapper wrapper-login">
    <div class="container container-login animated fadeIn">
      <!-- logo -->
      <div class="text-center mb-4"><img src="assets/img/logo.png" alt="Logo" width="95px"></div>
      <!-- judul -->
      <h3 class="text-center">Aplikasi Gudang <br>Wong Coco </h3>
      <!-- form login --> 
      <form action="proses_reset.php" method="post" class="needs-validation" novalidate>
        <div class="form-group form-floating-label">
          <div class="user-icon"><i class="fas fas fa-user"></i></div>
          <input type="text" id="username" name="username" class="form-control input-border-bottom" autocomplete="off" required>
          <label for="username" class="placeholder">Username</label>
          <div class="invalid-feedback">Username tidak boleh kosong.</div>
        </div>

        <div class="form-action mt-2">
          <!-- tombol login -->
          <input type="submit" name="reset" value="RESET" class="btn btn-secondary btn-rounded btn-login btn-block">
        </div>
        <div class="text-center pt-5">
        <a href="index.php" class="btn btn-secondary btn-round">
          <span class="btn-label"><i class="fas fa-home mr-2"></i></span> Kembali ke Aplikasi
        </a>
      </div>
      

        <!-- footer -->
        <div class="login-footer mt-4">
          <span class="msg">&copy; Coco Karunia</span>
         </div>
      </form>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.3.2.1.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery UI -->
  <script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>

  <!-- Template JS -->
  <script src="assets/js/ready.js"></script>

  <!-- Custom Scripts -->
  <script src="assets/js/form-validation.js"></script>
</body>

</html>