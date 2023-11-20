TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER `stok_masuk` AFTER INSERT ON `tbl_barang_masuk` FOR EACH ROW BEGIN\nUPDATE tbl_barang SET stok=stok+NEW.jumlah\nWHERE id_barang=NEW.barang;\nEND' 'CREATE DEFINER=`root`@`localhost` TRIGGER `hapus_stok_masuk` BEFORE DELETE ON `tbl_barang_masuk` FOR EACH ROW BEGIN\nUPDATE tbl_barang SET stok=stok-OLD.jumlah\nWHERE id_barang=OLD.barang;\nEND'
sql_modes=524288 524288
definers='root@localhost' 'root@localhost'
client_cs_names='utf8mb4' 'utf8mb4'
connection_cl_names='utf8mb4_general_ci' 'utf8mb4_general_ci'
db_cl_names='utf8mb4_general_ci' 'utf8mb4_general_ci'
created=169871549279 169871549265
