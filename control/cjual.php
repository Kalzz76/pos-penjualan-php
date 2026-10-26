<?php
include('function/fjual.php');
$fpenjualan = new fjual();
$status = $_GET['status'];

if ($status == '1') {

    // Tampilkan data penjualan
    $dataku = $fpenjualan->tampil_data();
    include "./view/vjual.php";

} else if ($status == '2') {

    // Form tambah penjualan
    $barang = $fpenjualan->ambil_barang();
    include "./view/jual_tambah.php";

} else if ($status == '3') {

    // SIMPAN PENJUALAN BARU
    if (isset($_POST['simpan'])) {

        $tanggal      = $_POST['tanggal'] ?? null;
        $id_barang    = isset($_POST['id_barang']) ? (int)$_POST['id_barang'] : 0;
        $jumlah       = isset($_POST['jumlah']) ? (int)$_POST['jumlah'] : 0;
        $harga_jual   = isset($_POST['harga_jual']) ? (float)$_POST['harga_jual'] : 0;
        $nama_pembeli = $_POST['nama_pembeli'] ?? '';

        // Validasi
        if ($tanggal == null || $id_barang == 0 || $jumlah == 0 || $harga_jual == 0) {
            $_SESSION['alert'] = [
                'type'    => 'danger',
                'message' => 'Semua field wajib diisi!'
            ];
            echo "<meta http-equiv='refresh' content='1;url=./index.php?aksi=penjualan&status=2'>";
            exit;
        }

        // Eksekusi input
        $result = $fpenjualan->input_penjualan($tanggal, $id_barang, $jumlah, $harga_jual, $nama_pembeli);

        if ($result) {
            $_SESSION['alert'] = [
                'type'    => 'success',
                'message' => 'Penjualan berhasil disimpan'
            ];
        } else {
            $_SESSION['alert'] = [
                'type'    => 'danger',
                'message' => 'Penjualan gagal disimpan'
            ];
        }

        // Redirect
        echo "<meta http-equiv='refresh' content='1;url=./index.php?aksi=penjualan&status=1'>";
        exit;
    }

} else if ($status == '6') {

    // HAPUS DATA PENJUALAN
    $id = $_GET['id'];
    $result = $fpenjualan->hapus_data($id);

    if ($result) {
        $_SESSION['alert'] = ['type' => 'success', 'message' => 'Data penjualan berhasil dihapus'];
    } else {
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Gagal menghapus data penjualan'];
    }

    header('Location: ./index.php?aksi=penjualan&status=1');
    exit;
}

else if($status=='7') 
{ 
      // PERBAIKAN: Gunakan $fpenjualan yang sudah didefinisikan, bukan $fjual
      // PERBAIKAN: Gunakan print_jual() bukan print_penjualan()
      $dataku = $fpenjualan->print_jual();
      include "./view/vjual_print.php";   
}

?>