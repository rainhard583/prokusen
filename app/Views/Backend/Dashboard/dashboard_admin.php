<?= view('Backend/Template/header') ?>

<!-- PAGE TITLE -->
<div class="d-flex align-items-center mb-4">
    <div style="
        width:44px; height:44px;
        background: linear-gradient(135deg, #b8860b, #f0c040);
        border-radius:12px;
        display:flex; align-items:center; justify-content:center;
        margin-right:14px;
        box-shadow: 0 4px 12px rgba(184,134,11,0.3);
    ">
        <i class="fas fa-tachometer-alt" style="color:#1a1008; font-size:18px;"></i>
    </div>
    <div>
        <h1 class="h4 mb-0" style="font-weight:800; color:#1a1008;">Dashboard</h1>
        <p class="mb-0" style="font-size:13px; color:#9a8060;">Selamat datang, <?= ucfirst(session()->get('username')) ?>! 👋</p>
    </div>
</div>

<!-- Summary Cards -->
<div class="row mb-4">

    <!-- Total Pesanan -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100" style="border-left:4px solid #b8860b !important;">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div style="font-size:11px; font-weight:700; color:#b8860b; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">
                        Total Pesanan
                    </div>
                    <div style="font-size:28px; font-weight:800; color:#1a1008;">
                        <?= $total_pesanan ?>
                    </div>
                    <div style="font-size:12px; color:#9a8060; margin-top:4px;">
                        Semua pesanan masuk
                    </div>
                </div>
                <div style="
                    width:54px; height:54px;
                    background: linear-gradient(135deg, #fef3c7, #fde68a);
                    border-radius:16px;
                    display:flex; align-items:center; justify-content:center;
                ">
                    <i class="fas fa-clipboard-list" style="font-size:22px; color:#b8860b;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pendapatan -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100" style="border-left:4px solid #16a34a !important;">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div style="font-size:11px; font-weight:700; color:#16a34a; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">
                        Total Pendapatan
                    </div>
                    <div style="font-size:22px; font-weight:800; color:#1a1008;">
                        Rp <?= number_format($total_pendapatan, 0, ',', '.') ?>
                    </div>
                    <div style="font-size:12px; color:#9a8060; margin-top:4px;">
                        Dari pesanan sukses
                    </div>
                </div>
                <div style="
                    width:54px; height:54px;
                    background: linear-gradient(135deg, #dcfce7, #bbf7d0);
                    border-radius:16px;
                    display:flex; align-items:center; justify-content:center;
                ">
                    <i class="fas fa-wallet" style="font-size:22px; color:#16a34a;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Produk -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100" style="border-left:4px solid #0ea5e9 !important;">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div style="font-size:11px; font-weight:700; color:#0ea5e9; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">
                        Total Produk
                    </div>
                    <div style="font-size:28px; font-weight:800; color:#1a1008;">
                        <?= $total_produk ?>
                    </div>
                    <div style="font-size:12px; color:#9a8060; margin-top:4px;">
                        Produk terdaftar
                    </div>
                </div>
                <div style="
                    width:54px; height:54px;
                    background: linear-gradient(135deg, #e0f2fe, #bae6fd);
                    border-radius:16px;
                    display:flex; align-items:center; justify-content:center;
                ">
                    <i class="fas fa-box-open" style="font-size:22px; color:#0ea5e9;"></i>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Tabel Pesanan Terbaru -->
<div class="card">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <div style="
                width:32px; height:32px;
                background: linear-gradient(135deg, #b8860b, #f0c040);
                border-radius:8px;
                display:flex; align-items:center; justify-content:center;
                margin-right:10px;
            ">
                <i class="fas fa-history" style="color:#1a1008; font-size:13px;"></i>
            </div>
            <span style="font-weight:700; color:#1a1008; font-size:15px;">Pesanan Terbaru</span>
        </div>
        <a href="<?= base_url('pesanan') ?>" class="btn btn-primary btn-sm px-3">
            <i class="fas fa-arrow-right mr-1"></i> Lihat Semua
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered mb-0" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>No. Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pesanan_terbaru)) : ?>
                        <?php $no = 1; foreach ($pesanan_terbaru as $row) : ?>
                        <tr>
                            <td style="width:40px; color:#9a8060;"><?= $no++ ?></td>
                            <td>
                                <span style="font-weight:700; color:#1a1008; font-size:13px;">
                                    <?= $row['order_number'] ?>
                                </span>
                            </td>
                            <td><?= $row['customer_name'] ?></td>
                            <td style="font-weight:700; color:#16a34a;">
                                Rp <?= number_format($row['total_price'], 0, ',', '.') ?>
                            </td>
                            <td>
                                <?php $s = strtolower($row['status']); ?>
                                <?php if ($s == 'pending') : ?>
                                    <span class="badge badge-warning">⏳ Pending</span>
                                <?php elseif ($s == 'success') : ?>
                                    <span class="badge badge-success">✅ Success</span>
                                <?php elseif ($s == 'cancelled') : ?>
                                    <span class="badge badge-danger">❌ Cancelled</span>
                                <?php else : ?>
                                    <span class="badge badge-secondary"><?= ucfirst($s) ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="text-center py-4" style="color:#9a8060;">
                                <i class="fas fa-inbox fa-2x mb-2 d-block" style="color:#e2d9c5;"></i>
                                Belum ada data pesanan
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= view('Backend/Template/footer') ?>
