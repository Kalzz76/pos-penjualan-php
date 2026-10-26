    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Laporan Pembelian Barang</h5>
                <a href="./index.php?aksi=pembelian&status=1" class="btn btn-light btn-sm fw-bold">
                    <i class="bi bi-arrow-left-circle me-1"></i> Back
                </a>
            </div>

            <div class="card-body"> 
                <form action="./index.php?aksi=laporanbeli&status=2" method="post">
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

    function printDiv() {
    var isi = document.getElementById("printArea").innerHTML;

    var printWindow = window.open('', '', 'width=850,height=1100');

        printWindow.document.write('<html><head>');
        printWindow.document.write('<title>Data Kategori</title>');
        printWindow.document.write('<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<h3 class="text-center mb-3">Data Pembelian Per Tanggal</h3>');
        printWindow.document.write(isi);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }

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