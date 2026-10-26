<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Laporan Penjualan Barang</h5>
            <a href="./index.php?aksi=penjualan&status=1" class="btn btn-light btn-sm fw-bold">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
        </div>

        <div class="card-body"> 
            <form action="./index.php?aksi=laporanjual&status=2" method="post">
                <!-- Tanggal -->
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                </div>

                <!-- Bulan -->
                <div class="mb-3">
                    <label class="form-label">Bulan</label>
                    <select class="form-select" id="bulan" name="bulan">
                        <option value="">-- Pilih Bulan --</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>

                <!-- Tahun -->
                <div class="mb-3">
                    <label class="form-label">Tahun</label>
                    <select class="form-select" id="tahun" name="tahun">
                        <option value="">-- Pilih Tahun --</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                    </select>
                </div>

                <!-- Tombol -->
                <button type="submit" class="btn btn-success" name="cetak">Cetak</button>
                <button type="reset" class="btn btn-secondary ms-2">Reset</button>
            </form>
        </div>
    </div>
</div>

<script>
// Set tahun default ke tahun sekarang
const currentYear = new Date().getFullYear();
document.getElementById('tahun').value = currentYear;

// Set bulan default ke bulan sekarang  
const currentMonth = new Date().getMonth() + 1;
document.getElementById('bulan').value = currentMonth;

// Set tanggal default ke hari ini
const today = new Date().toISOString().split('T')[0];
document.getElementById('tanggal').value = today;

// Tanggal → Isi Otomatis Bulan & Tahun
document.getElementById('tanggal').addEventListener('change', function() {
    if (this.value) {
        const [tahun, bulan] = this.value.split('-');
        document.getElementById('bulan').value = parseInt(bulan);
        document.getElementById('tahun').value = tahun;
    }
});

// Bulan/Tahun → Isi Otomatis Tanggal
document.getElementById('bulan').addEventListener('change', updateTanggal);
document.getElementById('tahun').addEventListener('change', updateTanggal);

function updateTanggal() {
    const bulan = document.getElementById('bulan').value;
    const tahun = document.getElementById('tahun').value;
    
    if (bulan && tahun) {
        document.getElementById('tanggal').value = `${tahun}-${bulan.padStart(2, '0')}-01`;
    }
}
</script>