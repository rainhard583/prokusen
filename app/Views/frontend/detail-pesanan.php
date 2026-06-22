<?php $title = 'Detail Pesanan - PSG'; ?>
<?= view('frontend/header2') ?>

<style>

.page-wrapper {
    max-width: 1100px;
    margin: 0 auto;
    padding: 40px 24px 80px;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    color: #6b7280;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 28px;
    transition: .3s;
}

.back-link:hover {
    color: #b8860b;
    transform: translateX(-3px);
}

.detail-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    margin-bottom: 24px;
    flex-wrap: wrap;
}

.detail-title h1 {
    font-size: 34px;
    font-weight: 800;
    color: #111827;
    margin-bottom: 6px;
}

.detail-title p {
    color: #6b7280;
    font-size: 15px;
}

.status-badge {
    padding: 10px 18px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .5px;
}

.status-pending    { background: #fff7d6; color: #b8860b; }
.status-processing { background: #dbeafe; color: #1d4ed8; }
.status-shipped    { background: #ede9fe; color: #6d28d9; }
.status-completed,
.status-lunas      { background: #d1fae5; color: #065f46; }
.status-cancelled,
.status-dibatalkan { background: #fee2e2; color: #991b1b; }

.detail-grid {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 24px;
}

.card {
    background: #fff;
    border-radius: 22px;
    padding: 28px;
    box-shadow: 0 10px 30px rgba(0,0,0,.05);
    border: 1px solid #f1f5f9;
}

.card-title {
    font-size: 18px;
    font-weight: 800;
    margin-bottom: 22px;
    color: #111827;
    padding-bottom: 14px;
    border-bottom: 1px solid #f1f5f9;
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.info-label {
    font-size: 13px;
    color: #9ca3af;
    font-weight: 600;
}

.info-value {
    font-size: 15px;
    color: #111827;
    font-weight: 700;
}

.payment-info {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #f1f5f9;
}

.payment-badge {
    display: inline-block;
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 700;
    background: #f3f4f6;
    color: #374151;
}

.order-items {
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.order-item {
    display: flex;
    gap: 18px;
    padding-bottom: 18px;
    border-bottom: 1px solid #f1f5f9;
}

.order-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.item-image {
    width: 90px;
    height: 90px;
    border-radius: 16px;
    overflow: hidden;
    background: #f8fafc;
    flex-shrink: 0;
    border: 1px solid #e5e7eb;
}

.item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.empty-image {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    color: #d4a017;
}

.item-info { flex: 1; }

.item-name {
    font-size: 16px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 8px;
}

.item-meta {
    font-size: 14px;
    color: #6b7280;
    margin-bottom: 4px;
}

.item-subtotal {
    font-size: 15px;
    font-weight: 800;
    color: #b8860b;
    margin-top: 6px;
}

.summary-box {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 15px;
    color: #374151;
}

.summary-total {
    padding-top: 14px;
    border-top: 2px solid #e5e7eb;
    font-size: 18px;
    font-weight: 800;
    color: #111827;
}

.sp-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 700;
}

.sp-pending { background: #fff7d6; color: #b8860b; }
.sp-lunas   { background: #d1fae5; color: #065f46; }
.sp-gagal   { background: #fee2e2; color: #991b1b; }

.btn-wa {
    width: 100%;
    margin-top: 20px;
    background: #25D366;
    color: white;
    border: none;
    padding: 14px;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 700;
    text-decoration: none;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    transition: .3s;
    cursor: pointer;
}

.btn-wa:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(37,211,102,.3);
    color: white;
}

.empty-state {
    padding: 32px 20px;
    border-radius: 14px;
    background: #f8fafc;
    color: #9ca3af;
    text-align: center;
}

.empty-state i {
    font-size: 32px;
    margin-bottom: 12px;
    display: block;
}

.empty-state p {
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 4px;
}

@media (max-width: 992px) {
    .detail-grid { grid-template-columns: 1fr; }
    .info-grid   { grid-template-columns: 1fr; }
    .detail-title h1 { font-size: 26px; }
}

</style>

<div class="page-wrapper">

    <!-- BACK -->
    <a href="<?= base_url('riwayat') ?>" class="back-link">
        <i class="fa-solid fa-arrow-left"></i>
        Kembali ke Riwayat
    </a>

    <!-- HEADER -->
    <div class="detail-header">

        <div class="detail-title">
            <h1>Detail Pesanan</h1>
            <p><?= esc($pesanan['order_number'] ?? '-') ?></p>
        </div>

        <?php
            $status      = strtolower($pesanan['status'] ?? 'pending');
            $statusClass = 'status-' . $status;
        ?>

        <span class="status-badge <?= $statusClass ?>">
            <?= esc(strtoupper($pesanan['status'] ?? 'Pending')) ?>
        </span>

    </div>

    <div class="detail-grid">

        <!-- ===================== LEFT ===================== -->
        <div style="display:flex; flex-direction:column; gap:24px;">

            <!-- INFORMASI PEMESAN -->
            <div class="card">

                <div class="card-title">
                    <i class="fa-solid fa-user" style="color:#b8860b; margin-right:8px;"></i>
                    Informasi Pemesan
                </div>

                <div class="info-grid">

                    <div class="info-item">
                        <span class="info-label">Nama</span>
                        <span class="info-value">
                            <?= esc($pesanan['customer_name'] ?? '-') ?>
                        </span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Nomor Telepon</span>
                        <span class="info-value">
                            <?= esc($pesanan['phone'] ?? '-') ?>
                        </span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Alamat</span>
                        <span class="info-value">
                            <?= esc($pesanan['address'] ?? '-') ?>
                        </span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value">
                            <?= esc($pesanan['customer_email'] ?? '-') ?>
                        </span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Tanggal Pesanan</span>
                        <span class="info-value">
                            <?php if (!empty($pesanan['created_at'])): ?>
                                <?= date('d M Y, H:i', strtotime($pesanan['created_at'])) ?> WIB
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </span>
                    </div>

                    <?php if (!empty($pesanan['notes'])): ?>
                    <div class="info-item">
                        <span class="info-label">Catatan</span>
                        <span class="info-value">
                            <?= esc($pesanan['notes']) ?>
                        </span>
                    </div>
                    <?php endif; ?>

                </div>

                <!-- METODE PEMBAYARAN -->
                <?php if (!empty($pesanan['metode_bayar'])): ?>
                <div class="payment-info">
                    <div class="info-label" style="margin-bottom:10px;">
                        Metode Pembayaran
                    </div>
                    <div style="display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
                        <span class="payment-badge">
                            <i class="fa-solid fa-wallet" style="margin-right:6px;"></i>
                            <?= esc($pesanan['metode_bayar']) ?>
                        </span>
                        <?php if (!empty($pesanan['detail_bayar'])): ?>
                        <span style="color:#6b7280; font-size:14px;">
                            &mdash; <?= esc($pesanan['detail_bayar']) ?>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

            </div>

            <!-- PRODUK DIPESAN -->
            <div class="card">

                <div class="card-title">
                    <i class="fa-solid fa-box-open" style="color:#b8860b; margin-right:8px;"></i>
                    Produk Dipesan
                    <?php if (!empty($items)): ?>
                        <span style="font-size:13px; color:#9ca3af; font-weight:500; margin-left:6px;">
                            (<?= count($items) ?> item)
                        </span>
                    <?php endif; ?>
                </div>

                <div class="order-items">

                    <?php if (!empty($items)): ?>

                        <?php foreach ($items as $item): ?>

                        <div class="order-item">

                            <!-- GAMBAR -->
                            <div class="item-image">
                                <?php if (!empty($item['image'])): ?>
                                    <img
                                        src="<?= base_url('uploads/produk/' . esc($item['image'])) ?>"
                                        alt="<?= esc($item['product_name']) ?>"
                                        onerror="this.parentElement.innerHTML='<div class=\'empty-image\'><i class=\'fa-solid fa-box\'></i></div>'"
                                    >
                                <?php else: ?>
                                    <div class="empty-image">
                                        <i class="fa-solid fa-box"></i>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- INFO -->
                            <div class="item-info">

                                <div class="item-name">
                                    <?= esc($item['product_name'] ?? '-') ?>
                                </div>

                                <div class="item-meta">
                                    Harga satuan:
                                    <strong>
                                        Rp <?= number_format($item['price'] ?? 0, 0, ',', '.') ?>
                                    </strong>
                                </div>

                                <div class="item-meta">
                                    Jumlah:
                                    <strong>
                                        <?= (int)($item['qty'] ?? 1) ?> pcs
                                    </strong>
                                </div>

                                <div class="item-subtotal">
                                    Subtotal: Rp <?= number_format($item['subtotal'] ?? 0, 0, ',', '.') ?>
                                </div>

                            </div>

                        </div>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <div class="empty-state">
                            <i class="fa-solid fa-box-open"></i>
                            <p>Detail produk tidak ditemukan.</p>
                            <small>Hubungi admin jika ini adalah kesalahan.</small>
                        </div>

                    <?php endif; ?>

                </div>

            </div>

        </div>

        <!-- ===================== RIGHT ===================== -->
        <div>

            <div class="card">

                <div class="card-title">
                    <i class="fa-solid fa-receipt" style="color:#b8860b; margin-right:8px;"></i>
                    Ringkasan Pembayaran
                </div>

                <div class="summary-box">

                    <?php
                        $totalDariItems = 0;
                        if (!empty($items)) {
                            foreach ($items as $it) {
                                $totalDariItems += ($it['subtotal'] ?? 0);
                            }
                        }
                        $totalTampil = $totalDariItems > 0
                            ? $totalDariItems
                            : ($pesanan['total_price'] ?? 0);
                    ?>

                    <div class="summary-row">
                        <span>Subtotal Produk</span>
                        <span>
                            Rp <?= number_format($totalTampil, 0, ',', '.') ?>
                        </span>
                    </div>

                    <div class="summary-row">
                        <span>Ongkos Kirim</span>
                        <span style="color:#10b981; font-weight:700;">
                            Gratis
                        </span>
                    </div>

                    <div class="summary-row summary-total">
                        <span>Total Bayar</span>
                        <span style="color:#b8860b;">
                            Rp <?= number_format($pesanan['total_price'] ?? 0, 0, ',', '.') ?>
                        </span>
                    </div>

                    <!-- STATUS PEMBAYARAN -->
                    <?php if (!empty($pesanan['status_pembayaran'])): ?>
                    <div class="summary-row">
                        <span>Status Bayar</span>
                        <?php
                            $sp      = strtolower($pesanan['status_pembayaran']);
                            $spClass = 'sp-pending';
                            if ($sp === 'lunas') $spClass = 'sp-lunas';
                            if ($sp === 'gagal') $spClass = 'sp-gagal';
                        ?>
                        <span class="sp-badge <?= $spClass ?>">
                            <?= esc(ucfirst($pesanan['status_pembayaran'])) ?>
                        </span>
                    </div>
                    <?php endif; ?>

                </div>

                <!-- TOMBOL AKSI BERDASARKAN STATUS -->
                <?php
                    $waMessage = 'Halo Admin PSG, saya ingin menanyakan pesanan saya.' . "\n"
                               . 'No. Pesanan: ' . ($pesanan['order_number'] ?? '') . "\n"
                               . 'Nama: ' . ($pesanan['customer_name'] ?? '');
                    $waUrl = 'https://wa.me/6282218967866?text=' . rawurlencode($waMessage);
                ?>

                <?php if ($status === 'pending'): ?>

                    <!-- LANJUTKAN PEMBAYARAN -->
                    <button type="button"
                            id="btnLanjutkanBayar"
                            data-order-id="<?= (int)($pesanan['id'] ?? 0) ?>"
                            class="btn-wa"
                            style="background:#b8860b; margin-top:20px; border:none; cursor:pointer;">
                        <i class="fa-solid fa-credit-card"></i>
                        Lanjutkan Pembayaran
                    </button>
                    <div id="payNotif" style="display:none; margin-top:10px; padding:11px 13px; border-radius:10px; font-size:13px; font-weight:500;"></div>

                    <!-- BATALKAN PESANAN -->
                    <form method="post"
                          action="<?= base_url('riwayat/cancel/' . ($pesanan['order_number'] ?? '')) ?>"
                          onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?');"
                          style="margin-top:10px;">
                        <?= csrf_field() ?>
                        <button type="submit"
                                style="
                                    width:100%;
                                    padding:13px;
                                    border-radius:12px;
                                    border:1.5px solid #ef4444;
                                    background:white;
                                    color:#ef4444;
                                    font-size:14px;
                                    font-weight:700;
                                    cursor:pointer;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    gap:8px;
                                    transition:.3s;
                                "
                                onmouseover="this.style.background='#fee2e2'"
                                onmouseout="this.style.background='white'">
                            <i class="fa-solid fa-xmark"></i>
                            Batalkan Pesanan
                        </button>
                    </form>

                <?php elseif ($status === 'success'): ?>

                    <!-- BADGE PEMBAYARAN BERHASIL -->
                    <div style="
                        margin-top:20px;
                        padding:16px;
                        border-radius:12px;
                        background:#d1fae5;
                        border:1.5px solid #6ee7b7;
                        display:flex;
                        align-items:center;
                        gap:12px;
                        color:#065f46;
                    ">
                        <i class="fa-solid fa-circle-check" style="font-size:24px;"></i>
                        <div>
                            <div style="font-weight:700; font-size:15px;">
                                Pembayaran Berhasil
                            </div>
                            <div style="font-size:13px; margin-top:2px; opacity:.8;">
                                Terima kasih, pesanan Anda sedang diproses.
                            </div>
                        </div>
                    </div>

                    <!-- TETAP ADA TOMBOL WA UNTUK FOLLOW UP -->
                    <a href="<?= $waUrl ?>"
                       target="_blank"
                       class="btn-wa"
                       style="margin-top:12px;">
                        <i class="fa-brands fa-whatsapp"></i>
                        Hubungi Admin via WhatsApp
                    </a>

                <?php elseif ($status === 'cancelled'): ?>

                    <!-- BADGE PESANAN DIBATALKAN -->
                    <div style="
                        margin-top:20px;
                        padding:16px;
                        border-radius:12px;
                        background:#fee2e2;
                        border:1.5px solid #fca5a5;
                        display:flex;
                        align-items:center;
                        gap:12px;
                        color:#991b1b;
                    ">
                        <i class="fa-solid fa-circle-xmark" style="font-size:24px;"></i>
                        <div>
                            <div style="font-weight:700; font-size:15px;">
                                Pesanan Dibatalkan
                            </div>
                            <div style="font-size:13px; margin-top:2px; opacity:.8;">
                                Pesanan ini telah dibatalkan.
                            </div>
                        </div>
                    </div>

                <?php else: ?>

                    <!-- STATUS LAIN (processing, shipped, dll) - tampilkan tombol WA -->
                    <a href="<?= $waUrl ?>"
                       target="_blank"
                       class="btn-wa">
                        <i class="fa-brands fa-whatsapp"></i>
                        Hubungi Admin via WhatsApp
                    </a>

                <?php endif; ?>

            </div>

        </div>

    </div>

</div>

<?php if ($status === 'pending'): ?>
<script src="<?= esc($midtrans_snap_url ?? 'https://app.sandbox.midtrans.com/snap/snap.js') ?>"
        data-client-key="<?= esc($midtrans_client_key ?? '') ?>"></script>
<script>
(function () {
    const btn     = document.getElementById('btnLanjutkanBayar');
    const notif   = document.getElementById('payNotif');
    const orderId = btn ? btn.dataset.orderId : null;
    if (!btn || !orderId) return;

    function showNotif(msg, ok) {
        notif.style.display    = 'block';
        notif.style.background = ok ? '#d1fae5' : '#fee2e2';
        notif.style.color      = ok ? '#065f46' : '#991b1b';
        notif.textContent      = msg;
    }

    function setLoading(on) {
        btn.disabled  = on;
        btn.innerHTML = on
            ? '<i class="fa-solid fa-spinner fa-spin"></i> Memuat...'
            : '<i class="fa-solid fa-credit-card"></i> Lanjutkan Pembayaran';
    }

    function updateStatus(txStatus) {
        fetch('<?= base_url('payment/update-status') ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'order_id=' + encodeURIComponent(orderId) + '&transaction_status=' + encodeURIComponent(txStatus)
        });
    }

    btn.addEventListener('click', async function () {
        setLoading(true);
        notif.style.display = 'none';
        try {
            const res  = await fetch('<?= base_url('payment/lanjutkan') ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest' },
                body: 'order_id=' + encodeURIComponent(orderId)
            });
            const data = await res.json();
            setLoading(false);
            if (!data.success) { showNotif(data.message || 'Gagal memuat pembayaran.', false); return; }
            snap.pay(data.snap_token, {
                onSuccess: function (r) { updateStatus(r.transaction_status); window.location.href = '<?= base_url('riwayat') ?>'; },
                onPending: function (r) { updateStatus(r.transaction_status); window.location.href = '<?= base_url('riwayat') ?>'; },
                onError:   function ()  { showNotif('Pembayaran gagal. Silakan coba lagi.', false); },
                onClose:   function ()  { showNotif('Popup ditutup. Klik tombol lagi kapanpun siap.', false); }
            });
        } catch (e) {
            setLoading(false);
            showNotif('Kesalahan koneksi. Silakan coba lagi.', false);
        }
    });
})();
</script>
<?php endif; ?>

<?= view('frontend/footer2') ?>