<div class="container mt-5">
    <div class="card shadow-sm">

        <!-- Header -->
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Form Input Penjualan</h5>
            <a href="./index.php?aksi=penjualan&status=1" 
               class="btn btn-light btn-sm fw-bold">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
        </div>

        <!-- Body -->
        <div class="card-body">

            <?php  
            // AMBIL DATA BARANG DARI fjual
            $barangList = $fpenjualan->ambil_barang();  
            ?>
            
            <form class="form-horizontal" action="./index.php?aksi=penjualan&status=3" method="post">

                <!-- Tanggal -->
                <div class="mb-3">
                    <label class="form-label">Tanggal Penjualan</label>
                    <input type="date" class="form-control" name="tanggal" required>
                </div>

                <!-- PILIH BARANG -->
                <div class="mb-3">
                    <label class="form-label">Id Barang</label>
                    <select class="form-select" id="id_barang" name="id_barang" required>
                        <option value="">-- Pilih Barang --</option>

                        <?php foreach ($barangList as $b): ?>
                            <option value="<?= $b['id_barang']; ?>"
                                    data-nama="<?= $b['nama_barang']; ?>"
                                    data-harga="<?= $b['harga_jual']; ?>"
                                    data-stok="<?= $b['stok']; ?>">
                                <?= $b['nama_barang']; ?> (Stok: <?= $b['stok']; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Nama Barang otomatis -->
                <div class="mb-3">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" readonly>
                </div>

                <!-- Harga Jual otomatis -->
                <div class="mb-3">
                    <label class="form-label">Harga Jual</label>
                    <input type="text" class="form-control" id="harga_jual_display" placeholder="Harga jual otomatis" readonly>
                    <input type="hidden" id="harga_jual" name="harga_jual">
                </div>

                <!-- Jumlah -->
                <div class="mb-3">
                    <label class="form-label">Jumlah Beli</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" required placeholder="Jumlah beli" min="1">
                </div>

                <!-- Total Harga -->
                <div class="mb-3">
                    <label class="form-label">Total Harga</label>
                    <input type="text" class="form-control" id="total_harga_display" placeholder="Total otomatis" readonly>
                </div>

                <!-- Nama Pembeli -->
                <div class="mb-3">
                    <label class="form-label">Nama Pembeli</label>
                    <input type="text" class="form-control" name="nama_pembeli" placeholder="Masukkan nama pembeli">
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
                <button type="reset" class="btn btn-secondary ms-2">Reset</button>

            </form>

        </div>
    </div>
</div>

<!-- SCRIPT: Auto Isi Nama, Harga -->
<script>
const selectBarang = document.getElementById("id_barang");
const inputNama = document.getElementById("nama_barang");
const inputHargaHidden = document.getElementById("harga_jual");
const inputHargaDisplay = document.getElementById("harga_jual_display");
const inputJumlah = document.getElementById("jumlah");
const inputTotalDisplay = document.getElementById("total_harga_display");

function formatRupiah(value) {
    if (!value) return '';
    const number = Number(value);
    if (Number.isNaN(number)) return '';
    return 'Rp ' + number.toLocaleString('id-ID');
}

function updateTotal() {
    const harga = Number(inputHargaHidden.value || 0);
    const jumlah = Number(inputJumlah.value || 0);
    const total = harga * jumlah;
    inputTotalDisplay.value = total ? formatRupiah(total) : '';
}

selectBarang.addEventListener("change", function() {
    const opt = this.options[this.selectedIndex];
    const nama = opt.getAttribute("data-nama") || '';
    const harga = opt.getAttribute("data-harga") || '';

    inputNama.value = nama;
    inputHargaHidden.value = harga;
    inputHargaDisplay.value = formatRupiah(harga);
    updateTotal();
});

inputJumlah.addEventListener("input", updateTotal);
</script>