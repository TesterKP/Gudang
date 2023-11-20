<?php
// mengaktifkan session
session_start();
// menghapus semua session
session_destroy();

// alihkan ke halaman login dan tampilkan pesan berhasil logout
header('location: login.php?pesan=3');
