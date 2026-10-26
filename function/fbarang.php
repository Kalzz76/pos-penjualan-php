<?php
include('database.php');

class fbarang extends database {

    public function tampil_data() {
        $sql = mysqli_query($this->koneksi,
            "SELECT b.*, k.nama_kategori 
             FROM tbl_barang b 
             LEFT JOIN tbl_kategori k ON b.id_kategori = k.id_kategori
             ORDER BY b.id_barang ASC"
        );
        if (!$sql) {
            die("Query gagal: " . mysqli_error($this->koneksi));
        }
        $rows = [];
        while ($r = mysqli_fetch_assoc($sql)) {
            $rows[] = $r;
        }
        return $rows;
    }

    public function get_kategori() {
        $sql = mysqli_query($this->koneksi, "SELECT id_kategori, nama_kategori FROM tbl_kategori ORDER BY nama_kategori ASC");
        if (!$sql) return [];
        $rows = [];
        while ($r = mysqli_fetch_assoc($sql)) $rows[] = $r;
        return $rows;
    }

    public function input_data($id_kategori, $kode_barang, $nama_barang, $harga_beli, $harga_jual, $stok, $satuan) {
        $id_kategori = (int)$id_kategori;
        $kode_barang = mysqli_real_escape_string($this->koneksi, $kode_barang);
        $nama_barang = mysqli_real_escape_string($this->koneksi, $nama_barang);
        $harga_beli = (float)str_replace([',',' '], ['', ''], $harga_beli);
        $harga_jual = (float)str_replace([',',' '], ['', ''], $harga_jual);
        $stok = (int)$stok;
        $satuan = mysqli_real_escape_string($this->koneksi, $satuan);

        $query = "INSERT INTO tbl_barang (id_kategori, kode_barang, nama_barang, harga_beli, harga_jual, stok, satuan)
                  VALUES ('$id_kategori', '$kode_barang', '$nama_barang', '$harga_beli', '$harga_jual', '$stok', '$satuan')";
        $res = mysqli_query($this->koneksi, $query);
        if (!$res) {
            return false;
        }
        return true;
    }

    public function cari_data($id) {
        $id = (int)$id;
        $sql = mysqli_query($this->koneksi, "SELECT * FROM tbl_barang WHERE id_barang='$id'");
        if (!$sql) return [];
        $num = mysqli_num_rows($sql);
        if ($num == 0) {
            return [];
        }
        $result = [];
        while ($d = mysqli_fetch_assoc($sql)) $result[] = $d;
        return $result;
    }

    public function ubah_data($id_barang, $id_kategori, $kode_barang, $nama_barang, $harga_beli, $harga_jual, $stok, $satuan) {
        $id_barang = (int)$id_barang;
        $id_kategori = (int)$id_kategori;
        $kode_barang = mysqli_real_escape_string($this->koneksi, $kode_barang);
        $nama_barang = mysqli_real_escape_string($this->koneksi, $nama_barang);
        $harga_beli = (float)str_replace([',',' '], ['', ''], $harga_beli);
        $harga_jual = (float)str_replace([',',' '], ['', ''], $harga_jual);
        $stok = (int)$stok;
       
       $query = "UPDATE tbl_barang 
                  SET id_kategori='$id_kategori',
                      kode_barang='$kode_barang',
                      nama_barang='$nama_barang',
                      harga_beli='$harga_beli',
                      harga_jual='$harga_jual',
                      stok='$stok',
                      satuan='$satuan'
                  WHERE id_barang='$id_barang'"; 

        $result = mysqli_query($this->koneksi, $query); 
        if($result){
            return true;
        } else {
            echo "Error: " . mysqli_error($this->koneksi);
            return false;
        }
    }

    public function hapus_data($id_barang) {
       $id_barang = mysqli_real_escape_string($this->koneksi, $id_barang);
        $queryhapus = "DELETE FROM tbl_barang WHERE id_barang='$id_barang'";
        $deleteResult = mysqli_query($this->koneksi, $queryhapus);  

        if ($deleteResult) {
            return true; 
        } else {
            echo "Error: " . mysqli_error($this->koneksi);
            return false;
        }
    }

        function print_barang() {
        $sql = mysqli_query($this->koneksi,
            "SELECT b.*, k.nama_kategori 
             FROM tbl_barang b 
             LEFT JOIN tbl_kategori k ON b.id_kategori = k.id_kategori
             ORDER BY b.id_barang ASC"
        );
        if (!$sql) {
            die("Query gagal: " . mysqli_error($this->koneksi));
        }
        $rows = [];
        while ($r = mysqli_fetch_assoc($sql)) {
            $rows[] = $r;
        }
        return $rows;
    }
    
}
?>