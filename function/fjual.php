<?php
include('database.php');

class fjual extends database {

    // ===============================
    // TAMPIL DATA PENJUALAN
    // ===============================
    public function tampil_data() {
        $sql = mysqli_query($this->koneksi,
            "SELECT j.*, b.nama_barang 
             FROM tbl_jual j
             LEFT JOIN tbl_barang b ON j.id_barang = b.id_barang
             ORDER BY j.id_jual ASC"
        );

        $data = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
        return $data;
    }

    // ===============================
    // AMBIL LIST BARANG
    // ===============================
    public function ambil_barang() {
        $sql = mysqli_query($this->koneksi,
            "SELECT id_barang, nama_barang, harga_jual, stok 
             FROM tbl_barang 
             ORDER BY nama_barang ASC"
        );

        $data = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
        return $data;
    }

    // ===============================
    // INPUT PENJUALAN
    // ===============================
    public function input_penjualan($tanggal, $id_barang, $jumlah, $harga_jual, $nama_pembeli)
    {
        $tanggal       = mysqli_real_escape_string($this->koneksi, $tanggal);
        $id_barang     = (int)$id_barang;
        $jumlah        = (int)$jumlah;
        $harga_jual    = (float)$harga_jual;
        $nama_pembeli  = mysqli_real_escape_string($this->koneksi, $nama_pembeli);

        // Cek stok
        $cek = mysqli_query($this->koneksi,
            "SELECT stok FROM tbl_barang WHERE id_barang=$id_barang"
        );
        $stok = mysqli_fetch_assoc($cek)['stok'];

        if ($jumlah > $stok) {
            echo "Stok tidak cukup!";
            return false;
        }

        // 1) Insert penjualan
        $queryjual = "
            INSERT INTO tbl_jual (tanggal, id_barang, jumlah, harga_jual, total, nama_pembeli)
            VALUES ('$tanggal', '$id_barang', '$jumlah', '$harga_jual', ($jumlah * $harga_jual), '$nama_pembeli')
        ";

        $insertjual = mysqli_query($this->koneksi, $queryjual);

        if (!$insertjual) {
            echo "Gagal simpan penjualan: " . mysqli_error($this->koneksi);
            return false;
        }

        // 2) Kurangi stok
        mysqli_query($this->koneksi,
            "UPDATE tbl_barang SET stok = stok - $jumlah WHERE id_barang = $id_barang"
        );

        return true;
    }

    // ===============================
    // HAPUS PENJUALAN + KEMBALIKAN STOK
    // ===============================
    public function hapus_data($id_jual) {
        $id_jual = (int)$id_jual;

        $get = mysqli_query($this->koneksi,
            "SELECT id_barang, jumlah FROM tbl_jual WHERE id_jual=$id_jual"
        );
        $data = mysqli_fetch_assoc($get);

        if ($data) {
            mysqli_query($this->koneksi,
                "UPDATE tbl_barang 
                 SET stok = stok + {$data['jumlah']}
                 WHERE id_barang = {$data['id_barang']}"
            );
        }

        return mysqli_query($this->koneksi,
            "DELETE FROM tbl_jual WHERE id_jual=$id_jual"
        );
    }

    function print_jual() {
        $sql = mysqli_query($this->koneksi,
            "SELECT j.*, b.nama_barang 
             FROM tbl_jual j
             LEFT JOIN tbl_barang b ON j.id_barang = b.id_barang
             ORDER BY j.id_jual ASC"
        );

        $data = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
        return $data;
    }
}
?>