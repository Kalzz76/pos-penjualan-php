<?php
include('database.php');

class flappenjualan extends database {
    
    // 1. LAPORAN PENJUALAN PER TANGGAL 
    public function lap_pertanggal($tanggal)
    { 
        $tanggal = mysqli_real_escape_string($this->koneksi, $tanggal);
        $sql = mysqli_query($this->koneksi, "
            SELECT j.id_jual, j.tanggal, j.id_barang,
                   b.nama_barang, j.jumlah, j.harga_jual,
                   j.total, j.nama_pembeli
            FROM tbl_jual j
            LEFT JOIN tbl_barang b ON j.id_barang = b.id_barang
            WHERE j.tanggal = '$tanggal'
            ORDER BY j.id_jual ASC
        ");

        if (!$sql) {
            die('Query Error (pertanggal): ' . mysqli_error($this->koneksi));
        }

        $hasil = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $hasil[] = $row;
        }

        return $hasil;
    }

    // 2. LAPORAN PENJUALAN PER BULAN 
    public function lap_perbulan($bulan, $tahun)
    {
        $bulan = mysqli_real_escape_string($this->koneksi, $bulan);
        $tahun = mysqli_real_escape_string($this->koneksi, $tahun);

        $sql = mysqli_query($this->koneksi, "
            SELECT j.id_jual, j.tanggal, j.id_barang,
                   b.nama_barang, j.jumlah, j.harga_jual,
                   j.total, j.nama_pembeli
            FROM tbl_jual j
            LEFT JOIN tbl_barang b ON j.id_barang = b.id_barang
            WHERE MONTH(j.tanggal) = '$bulan'
              AND YEAR(j.tanggal) = '$tahun'
            ORDER BY j.id_jual ASC
        ");

        if (!$sql) {
            die('Query Error (perbulan): ' . mysqli_error($this->koneksi));
        }

        $hasil = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $hasil[] = $row;
        }

        return $hasil;
    }

    // 3. LAPORAN PENJUALAN PER TAHUN 
    public function lap_pertahun($tahun)
    {
        $tahun = mysqli_real_escape_string($this->koneksi, $tahun); 
        $sql = mysqli_query($this->koneksi, "
            SELECT j.id_jual, j.tanggal, j.id_barang,
                   b.nama_barang, j.jumlah, j.harga_jual,
                   j.total, j.nama_pembeli
            FROM tbl_jual j
            LEFT JOIN tbl_barang b ON j.id_barang = b.id_barang
            WHERE YEAR(j.tanggal) = '$tahun'
            ORDER BY j.id_jual ASC
        ");

        if (!$sql) {
            die('Query Error (pertahun): ' . mysqli_error($this->koneksi));
        }

        $hasil = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $hasil[] = $row;
        }

        return $hasil;
    }

    // 4. AMBIL BULAN YANG TERSEDIA DI DATABASE
    public function get_bulan_tersedia()
    {
        $sql = mysqli_query($this->koneksi, "
            SELECT DISTINCT MONTH(tanggal) as bulan
            FROM tbl_jual 
            ORDER BY bulan ASC
        ");

        $hasil = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $hasil[] = $row['bulan'];
        }
        return $hasil;
    }

    // 5. AMBIL TAHUN YANG TERSEDIA DI DATABASE
    public function get_tahun_tersedia()
    {
        $sql = mysqli_query($this->koneksi, "
            SELECT DISTINCT YEAR(tanggal) as tahun
            FROM tbl_jual 
            ORDER BY tahun DESC
        ");

        $hasil = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $hasil[] = $row['tahun'];
        }
        return $hasil;
    }

    // 6. AMBIL TANGGAL YANG TERSEDIA DI DATABASE
    public function get_tanggal_tersedia()
    {
        $sql = mysqli_query($this->koneksi, "
            SELECT DISTINCT tanggal
            FROM tbl_jual 
            ORDER BY tanggal DESC
        ");

        $hasil = [];
        while ($row = mysqli_fetch_assoc($sql)) {
            $hasil[] = $row['tanggal'];
        }
        return $hasil;
    }
}
?>