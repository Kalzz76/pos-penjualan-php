<?php
include('database.php');

class fpembelian extends database {
    // ==== TAMPIL DATA PEMBELIAN ====
    public function tampil_pembelian() {
        $sql = mysqli_query($this->koneksi, "
            SELECT p.id_pembelian, p.tanggal, p.id_barang,
                   b.nama_barang, p.jumlah, p.harga_beli,
                   (p.jumlah * p.harga_beli) AS total,
                   p.supplier
            FROM tbl_pembelian p
            LEFT JOIN tbl_barang b ON p.id_barang = b.id_barang
            ORDER BY p.id_pembelian ASC
        ");

        if (!$sql) {
            die('Query Error: ' . mysqli_error($this->koneksi));
        }

        $hasil = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $hasil[] = $row;
        }

        return $hasil;
    }

    public function ambil_barang()
        {
            $sql = mysqli_query($this->koneksi, "SELECT id_barang, nama_barang FROM tbl_barang ORDER BY nama_barang ASC");

            $data = [];
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
            return $data;
        }

        
        function input_pembelian($tanggal, $id_barang, $jumlah, $harga_beli, $supplier)
    {
        $tanggal     = mysqli_real_escape_string($this->koneksi, $tanggal);
        $id_barang   = (int)$id_barang;
        $jumlah      = (int)$jumlah;
        $harga_beli  = (float)$harga_beli;
        $supplier    = mysqli_real_escape_string($this->koneksi, $supplier);

        // --- Hitung harga jual = harga beli + 10% ---
        $harga_jual = $harga_beli + ($harga_beli * 0.10);

        // =====================================================
        // 1) Insert ke tbl_pembelian
        // =====================================================
        $queryPembelian = "
            INSERT INTO tbl_pembelian (tanggal, id_barang, jumlah, harga_beli, supplier)
            VALUES ('$tanggal', '$id_barang', '$jumlah', '$harga_beli', '$supplier')
        ";

        $insertPembelian = mysqli_query($this->koneksi, $queryPembelian);

        if (!$insertPembelian) {
            echo "Gagal simpan pembelian: " . mysqli_error($this->koneksi);
            return false;
        }

        // =====================================================
        // 2) Update barang: tambah stok + update harga beli + harga jual
        // =====================================================
        $queryUpdateBarang = "
            UPDATE tbl_barang 
            SET 
                stok       = stok + $jumlah,
                harga_beli = $harga_beli,
                harga_jual = $harga_jual
            WHERE id_barang = $id_barang
        ";

        $updateBarang = mysqli_query($this->koneksi, $queryUpdateBarang);

        if (!$updateBarang) {
            echo "Gagal update barang: " . mysqli_error($this->koneksi);
            return false;
        }

        return true;
    }

    public function tampil_data() {
        $sql = mysqli_query($this->koneksi,
            "SELECT p.*, b.nama_barang 
             FROM tbl_pembelian p 
             LEFT JOIN tbl_barang b ON p.id_barang = b.id_barang
             ORDER BY p.id_pembelian ASC"
        );
        if (!$sql) die("Query gagal: " . mysqli_error($this->koneksi));
        $rows = [];
        while ($r = mysqli_fetch_assoc($sql)) $rows[] = $r;
        return $rows;
    }



    public function get_barang() {
        $sql = mysqli_query($this->koneksi, "SELECT id_barang, nama_barang FROM tbl_barang ORDER BY nama_barang ASC");
        if (!$sql) return [];
        $rows = [];
        while ($r = mysqli_fetch_assoc($sql)) $rows[] = $r;
        return $rows;
    }

    public function input_data($tanggal, $id_barang, $jumlah, $harga_beli, $supplier) {
        $tanggal = mysqli_real_escape_string($this->koneksi, $tanggal);
        $id_barang = (int)$id_barang;
        $jumlah = (int)$jumlah;
        $harga_beli = (float)$harga_beli;
        $supplier = mysqli_real_escape_string($this->koneksi, $supplier);

        // Tambah stok di tbl_barang
        $update_stok = mysqli_query($this->koneksi, "UPDATE tbl_barang SET stok = stok + $jumlah WHERE id_barang = $id_barang");
        if (!$update_stok) return false;

        $query = "INSERT INTO tbl_pembelian (tanggal, id_barang, jumlah, harga_beli, supplier) VALUES ('$tanggal', '$id_barang', '$jumlah', '$harga_beli', '$supplier')";
        $res = mysqli_query($this->koneksi, $query);
        return $res ? true : false;
    }

    public function hapus_data($id_pembelian) {
        $id_pembelian = (int)$id_pembelian;
        // Kurangi stok kembali
        $sql_get = mysqli_query($this->koneksi, "SELECT id_barang, jumlah FROM tbl_pembelian WHERE id_pembelian = $id_pembelian");
        $data = mysqli_fetch_assoc($sql_get);
        if ($data) {
            mysqli_query($this->koneksi, "UPDATE tbl_barang SET stok = stok - {$data['jumlah']} WHERE id_barang = {$data['id_barang']}");
        }
        $query = "DELETE FROM tbl_pembelian WHERE id_pembelian = $id_pembelian";
        $res = mysqli_query($this->koneksi, $query);
        return $res ? true : false;
    }

    function print_pembelian() {
        $sql = mysqli_query($this->koneksi, "
            SELECT p.id_pembelian, p.tanggal, p.id_barang,
                   b.nama_barang, p.jumlah, p.harga_beli,
                   (p.jumlah * p.harga_beli) AS total,
                   p.supplier
            FROM tbl_pembelian p
            LEFT JOIN tbl_barang b ON p.id_barang = b.id_barang
            ORDER BY p.id_pembelian ASC
        ");

        if (!$sql) {
            die('Query Error: ' . mysqli_error($this->koneksi));
        }

        $hasil = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $hasil[] = $row;
        }

        return $hasil;
    }
}

    
?>
