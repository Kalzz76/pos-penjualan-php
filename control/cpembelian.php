<?php
include('function/fpembelian.php');
$fpembelian = new fpembelian();
$status = $_GET['status'];

if ($status == '1') {
    $dataku = $fpembelian->tampil_data();
    include "./view/vpembelian.php";
} else if ($status == '2') {
    $barang = $fpembelian->get_barang();
    include "./view/pembelian_tambah.php";
} else if ($status == '3') {
   // Simpan pembelian baru
   if (isset($_POST['simpan'])) {

    // --- Validasi dasar ---
    $tanggal    = !empty($_POST['tanggal']) ? $_POST['tanggal'] : null;
    $id_barang  = !empty($_POST['id_barang']) ? (int)$_POST['id_barang'] : 0;
    $jumlah     = !empty($_POST['jumlah']) ? (int)$_POST['jumlah'] : 0;
    $harga_beli = !empty($_POST['harga_beli']) ? (float)$_POST['harga_beli'] : 0;
    $supplier   = !empty($_POST['supplier']) ? $_POST['supplier'] : '';

    // Cek form wajib diisi
    if ($tanggal == null || $id_barang == 0 || $jumlah == 0 || $harga_beli == 0) {
        $_SESSION['alert'] = [
            'type' => 'danger',
            'message' => 'Semua field wajib diisi!'
        ];
        echo "<meta http-equiv='refresh' content='1;url=./index.php?aksi=pembelian&status=2'>";
        exit;
    }

    // Jalankan function simpan pembelian
    $result = $fpembelian->input_pembelian($tanggal, $id_barang, $jumlah, $harga_beli, $supplier);

    if ($result) {
        $_SESSION['alert'] = [
            'type' => 'success',
            'message' => 'Pembelian berhasil disimpan'
        ];
    } else {
        $_SESSION['alert'] = [
            'type' => 'danger',
            'message' => 'Pembelian gagal disimpan'
        ];
    }

    // Redirect setelah 1 detik
    echo "<meta http-equiv='refresh' content='1;url=./index.php?aksi=pembelian&status=1'>";
}
} else if ($status == '6') {
    $id = $_GET['id'];
    $result = $fpembelian->hapus_data($id);
    if ($result) {
        $_SESSION['alert'] = ['type' => 'success', 'message' => 'Data pembelian berhasil dihapus'];
    } else {
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Gagal menghapus data pembelian'];
    }
    header('Location: ./index.php?aksi=pembelian&status=1');
    exit;
}

else if($status=='7') 
{ 
      $dataku = $fpembelian->print_pembelian();
      include "./view/vpembelian_print.php";   
}
?>
