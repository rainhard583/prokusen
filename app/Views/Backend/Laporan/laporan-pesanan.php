<?= $this->include('Backend/Template/header'); ?>

<?php
// ============================================================
// HITUNG STATISTIK UTAMA — hanya dari data SUCCESS
// (data['laporan'] sudah difilter status=success di controller)
// ============================================================
$totalPendapatan = 0;
$totalPesanan    = count($laporan);
$customerList    = [];

foreach ($laporan as $row) {
    $totalPendapatan += $row['total_price'];
    $customerList[]   = $row['customer_name'];
}

$totalCustomer = count(array_unique($customerList));
$rataRata      = $totalPesanan ? $totalPendapatan / $totalPesanan : 0;

// ============================================================
// DATA CHART — dikirim dari controller
// ============================================================
$grafikBulan      = $grafikBulan      ?? [];
$grafikPendapatan = $grafikPendapatan ?? [];
$pieChart         = $pieChart         ?? ['success' => 0, 'pending' => 0, 'cancelled' => 0];
$produkLabel      = $produkLabel      ?? [];
$produkQty        = $produkQty        ?? [];
?>

<div class="content-wrapper">
    <section class="content pt-4">
        <div class="container-fluid">

            <!-- =============================================== -->
            <!-- JUDUL                                          -->
            <!-- =============================================== -->
            <div class="mb-4">
                <h2>Laporan Pesanan</h2>
                <p class="text-muted">Analisis bisnis untuk pemilik UMKM &mdash; hanya menghitung pesanan <strong>berhasil (success)</strong></p>
            </div>

            <!-- =============================================== -->
            <!-- STATISTIK UTAMA                                -->
            <!-- =============================================== -->
            <div class="row mb-4">

                <!-- TOTAL PENDAPATAN -->
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card bg-success text-white shadow h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="mr-3" style="font-size:2rem;"><i class="fas fa-money-bill-wave"></i></div>
                            <div>
                                <div class="text-uppercase" style="font-size:0.75rem;letter-spacing:1px;">Total Pendapatan</div>
                                <div style="font-size:1.4rem;font-weight:700;">
                                    Rp <?= number_format($totalPendapatan, 0, ',', '.'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TOTAL PESANAN -->
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card bg-primary text-white shadow h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="mr-3" style="font-size:2rem;"><i class="fas fa-shopping-cart"></i></div>
                            <div>
                                <div class="text-uppercase" style="font-size:0.75rem;letter-spacing:1px;">Total Pesanan</div>
                                <div style="font-size:1.4rem;font-weight:700;"><?= $totalPesanan; ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TOTAL CUSTOMER -->
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card bg-warning text-white shadow h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="mr-3" style="font-size:2rem;"><i class="fas fa-users"></i></div>
                            <div>
                                <div class="text-uppercase text-white" style="font-size:0.75rem;letter-spacing:1px;">Customer</div>
                                <div class="text-white" style="font-size:1.4rem;font-weight:700;"><?= $totalCustomer; ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RATA-RATA ORDER -->
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card bg-danger text-white shadow h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="mr-3" style="font-size:2rem;"><i class="fas fa-chart-line"></i></div>
                            <div>
                                <div class="text-uppercase" style="font-size:0.75rem;letter-spacing:1px;">Rata-rata Order</div>
                                <div style="font-size:1.4rem;font-weight:700;">
                                    Rp <?= number_format($rataRata, 0, ',', '.'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- =============================================== -->
            <!-- FILTER + TOMBOL EXPORT                         -->
            <!-- =============================================== -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                        <!-- DROPDOWN FILTER -->
                        <form method="GET" class="mb-0">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-filter"></i></span>
                                </div>
                                <select name="filter" class="form-control" onchange="this.form.submit()">
                                    <option value="">Semua Waktu</option>
                                    <option value="hari"   <?= ($filter == 'hari')   ? 'selected' : ''; ?>>Hari Ini</option>
                                    <option value="7hari"  <?= ($filter == '7hari')  ? 'selected' : ''; ?>>7 Hari Terakhir</option>
                                    <option value="30hari" <?= ($filter == '30hari') ? 'selected' : ''; ?>>30 Hari Terakhir</option>
                                </select>
                            </div>
                        </form>

                        <!-- TOMBOL EXPORT -->
                        <div class="d-flex gap-2">
                            <a href="<?= base_url('laporan/cetak?filter=' . $filter); ?>"
                               target="_blank"
                               class="btn btn-danger">
                                <i class="fas fa-file-pdf mr-1"></i> Cetak PDF
                            </a>
                            <a href="<?= base_url('laporan/csv?filter=' . $filter); ?>"
                               class="btn btn-success ml-2">
                                <i class="fas fa-file-csv mr-1"></i> Export CSV
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <!-- =============================================== -->
            <!-- GRAFIK BARIS 1: Line Chart + Pie Chart         -->
            <!-- =============================================== -->
            <div class="row mb-4">

                <!-- LINE CHART — PENDAPATAN BULANAN -->
                <div class="col-lg-8 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white border-bottom-0 pt-3">
                            <h6 class="font-weight-bold text-primary mb-0">
                                <i class="fas fa-chart-area mr-1"></i>
                                Pendapatan Bulanan (12 Bulan Terakhir)
                            </h6>
                            <small class="text-muted">Hanya pesanan berstatus <strong>Success</strong></small>
                        </div>
                        <div class="card-body">
                            <canvas id="chartPendapatanBulanan" height="100"></canvas>
                        </div>
                    </div>
                </div>

                <!-- PIE CHART — STATUS PESANAN -->
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white border-bottom-0 pt-3">
                            <h6 class="font-weight-bold text-primary mb-0">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Status Pesanan
                            </h6>
                            <small class="text-muted">Semua status pada periode terpilih</small>
                        </div>
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <canvas id="chartStatusPesanan" height="200"></canvas>
                            <!-- LEGENDA MANUAL -->
                            <div class="mt-3 d-flex justify-content-center flex-wrap" style="gap:12px;font-size:0.82rem;">
                                <span><span style="display:inline-block;width:12px;height:12px;background:#28a745;border-radius:50%;margin-right:4px;"></span>
                                    Success (<?= $pieChart['success']; ?>)</span>
                                <span><span style="display:inline-block;width:12px;height:12px;background:#ffc107;border-radius:50%;margin-right:4px;"></span>
                                    Pending (<?= $pieChart['pending']; ?>)</span>
                                <span><span style="display:inline-block;width:12px;height:12px;background:#dc3545;border-radius:50%;margin-right:4px;"></span>
                                    Cancelled (<?= $pieChart['cancelled']; ?>)</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- =============================================== -->
            <!-- GRAFIK BARIS 2: Bar Chart Produk Terlaris      -->
            <!-- =============================================== -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white border-bottom-0 pt-3">
                            <h6 class="font-weight-bold text-primary mb-0">
                                <i class="fas fa-boxes mr-1"></i>
                                5 Produk Terlaris
                            </h6>
                            <small class="text-muted">Berdasarkan total qty dari pesanan <strong>Success</strong></small>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($produkLabel)) : ?>
                                <canvas id="chartProdukTerlaris" height="80"></canvas>
                            <?php else : ?>
                                <p class="text-center text-muted py-4">
                                    <i class="fas fa-box-open fa-2x mb-2 d-block"></i>
                                    Belum ada data produk terlaris
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- =============================================== -->
            <!-- TABEL DATA PESANAN (hanya SUCCESS)             -->
            <!-- =============================================== -->
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-table mr-1"></i>
                        Data Pesanan Berhasil
                    </h3>
                    <span class="badge badge-success"><?= $totalPesanan; ?> pesanan</span>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="18%">No Order</th>
                                <th width="22%">Customer</th>
                                <th width="18%">Total</th>
                                <th width="12%">Status</th>
                                <th width="15%">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($laporan)) : ?>
                                <?php $no = 1; foreach ($laporan as $row) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= esc($row['order_number']); ?></td>
                                        <td><?= esc($row['customer_name']); ?></td>
                                        <td class="text-right">
                                            Rp <?= number_format($row['total_price'], 0, ',', '.'); ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-success">Success</span>
                                        </td>
                                        <td>
                                            <?= date('d-m-Y H:i', strtotime($row['created_at'])); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="fas fa-inbox fa-2x text-muted mb-2 d-block"></i>
                                        Belum ada data pesanan success pada periode ini
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
</div>

<!-- ============================================================ -->
<!-- CHART.JS + SCRIPT GRAFIK                                     -->
<!-- ============================================================ -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
// ──────────────────────────────────────────────────────────────
// DATA DARI PHP (di-encode ke JSON agar aman)
// ──────────────────────────────────────────────────────────────
const grafikBulan      = <?= json_encode($grafikBulan); ?>;
const grafikPendapatan = <?= json_encode(array_map('intval', $grafikPendapatan)); ?>;
const pieData          = {
    success:   <?= (int)$pieChart['success']; ?>,
    pending:   <?= (int)$pieChart['pending']; ?>,
    cancelled: <?= (int)$pieChart['cancelled']; ?>,
};
const produkLabel      = <?= json_encode($produkLabel); ?>;
const produkQty        = <?= json_encode(array_map('intval', $produkQty)); ?>;

// Helper format Rupiah untuk tooltip
function formatRupiah(value) {
    return 'Rp ' + value.toLocaleString('id-ID');
}

// ──────────────────────────────────────────────────────────────
// 1. LINE CHART — PENDAPATAN BULANAN
// ──────────────────────────────────────────────────────────────
(function () {
    const ctx = document.getElementById('chartPendapatanBulanan');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: grafikBulan,
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: grafikPendapatan,
                fill: true,
                backgroundColor: 'rgba(40,167,69,0.12)',
                borderColor: '#28a745',
                borderWidth: 2.5,
                pointBackgroundColor: '#28a745',
                pointRadius: 5,
                pointHoverRadius: 7,
                tension: 0.35,
            }]
        },
        options: {
            responsive: true,
            interaction: { intersect: false, mode: 'index' },
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => formatRupiah(ctx.parsed.y)
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: val => 'Rp ' + (val / 1000000 >= 1
                            ? (val / 1000000).toFixed(1) + 'jt'
                            : (val / 1000).toFixed(0) + 'rb')
                    },
                    grid: { color: 'rgba(0,0,0,0.05)' }
                },
                x: { grid: { display: false } }
            }
        }
    });
})();

// ──────────────────────────────────────────────────────────────
// 2. PIE CHART — STATUS PESANAN
// ──────────────────────────────────────────────────────────────
(function () {
    const ctx = document.getElementById('chartStatusPesanan');
    if (!ctx) return;

    const total = pieData.success + pieData.pending + pieData.cancelled;

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Success', 'Pending', 'Cancelled'],
            datasets: [{
                data: [pieData.success, pieData.pending, pieData.cancelled],
                backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
                borderColor: ['#fff', '#fff', '#fff'],
                borderWidth: 3,
                hoverOffset: 10,
            }]
        },
        options: {
            responsive: true,
            cutout: '62%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => {
                            const pct = total > 0
                                ? ((ctx.parsed / total) * 100).toFixed(1)
                                : 0;
                            return ` ${ctx.label}: ${ctx.parsed} (${pct}%)`;
                        }
                    }
                }
            }
        }
    });
})();

// ──────────────────────────────────────────────────────────────
// 3. BAR CHART — PRODUK TERLARIS
// ──────────────────────────────────────────────────────────────
(function () {
    const ctx = document.getElementById('chartProdukTerlaris');
    if (!ctx) return;

    const colors = ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'];

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: produkLabel,
            datasets: [{
                label: 'Qty Terjual',
                data: produkQty,
                backgroundColor: colors.slice(0, produkLabel.length),
                borderColor:     colors.slice(0, produkLabel.length),
                borderWidth: 1,
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y',   // horizontal bar — lebih mudah dibaca
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ` ${ctx.parsed.x} unit terjual`
                    }
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 },
                    grid: { color: 'rgba(0,0,0,0.05)' }
                },
                y: { grid: { display: false } }
            }
        }
    });
})();
</script>

<?= $this->include('Backend/Template/footer'); ?>