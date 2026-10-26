<?php
include('function/fbarang.php'); 
$fbarang = new fbarang();   

$status = $_GET['status'];

if ($status == '1') { 
    $dataku = $fbarang->tampil_data();
    include "./view/vbarang.php";   
} else if ($status == '2') { 
    $kategori = $fbarang->get_kategori(); 
    include "./view/barang_tambah.php";   
} else if ($status == '3') {
    if (isset($_POST['simpan'])) {  
        $id_kategori = $_POST['id_kategori'];
        $kode_barang = $_POST['kode_barang'];
        $nama_barang = $_POST['nama_barang'];
        $harga_beli = $_POST['harga_beli'];
        $harga_jual = $_POST['harga_jual'];
        $stok = $_POST['stok']; 
        $satuan = $_POST['satuan'];

        $result = $fbarang->input_data($id_kategori, $kode_barang, $nama_barang, 
                                     $harga_beli, $harga_jual, $stok, $satuan);

        if ($result) {
            echo '<div class="alert alert-success">Data barang berhasil disimpan.</div>';
        } else {
            echo '<div class="alert alert-danger">Data barang gagal disimpan.</div>';
        }

        echo "<meta http-equiv='refresh' content='1;url=./index.php?aksi=barang&status=1'>";
    }
} else if ($status == '4') {
    $id = $_GET['id'];
    $dataku = $fbarang->cari_data($id);
    $kategori = $fbarang->get_kategori(); 
    include "./view/barang_ubah.php";   
} else if ($status == '5') {  
    if (isset($_POST['update'])) {
        $id_barang = $_POST['id_barang'];
        $id_kategori = $_POST['id_kategori'];
        $kode_barang = $_POST['kode_barang'];
        $nama_barang = $_POST['nama_barang'];
        $harga_beli = $_POST['harga_beli'];
        $harga_jual = $_POST['harga_jual'];
        $stok = $_POST['stok'];
        $satuan = $_POST['satuan'];

        $result = $fbarang->ubah_data($id_barang, $id_kategori, $kode_barang, 
                                     $nama_barang, $harga_beli, $harga_jual, 
                                     $stok, $satuan);

        if ($result) {
            echo '<div class="alert alert-success">Data barang berhasil diubah.</div>';
        } else {
            echo '<div class="alert alert-danger">Data barang gagal diubah.</div>';
        }

        echo '<meta http-equiv="refresh" content="1;url=index.php?aksi=barang&status=1">';
    }
} else if ($status == '6') { 
    $id = $_GET['id'];  
    $result = $fbarang->hapus_data($id);  
    
    if ($result) {  
        $_SESSION['alert'] = ['type' => 'success', 'message' => 'Data barang berhasil dihapus'];
    } else {
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Data barang gagal dihapus'];
    }
    
    echo '<meta http-equiv="refresh" content="0;url=index.php?aksi=barang&status=1">';
    exit;
}

else if($status=='7') 
{ 
      $dataku = $fbarang->print_barang();
      include "./view/vbarang_print.php";   
}
?>