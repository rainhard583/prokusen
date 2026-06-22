<?php $title = 'Riwayat Pesanan - PSG'; ?>
<?= view('frontend/header2') ?>

<style>

.page-wrapper{
    max-width:900px;
    margin:0 auto;
    padding: 85px 60px 80px;
}

.page-title{
    font-size:26px;
    font-weight:800;
    color:#111827;
    margin-bottom:4px;
}

.page-sub{
    color:#6b7280;
    font-size:14px;
    margin-bottom:28px;
}

/* RESULT */
.result-info{
    color:#6b7280;
    font-size:13px;
    margin-bottom:16px;
}

/* CARD */
.pesanan-card{
    background:white;
    border-radius:16px;
    border:1px solid #f1f5f9;
    box-shadow:0 2px 12px rgba(0,0,0,0.05);
    overflow:hidden;
    margin-bottom:16px;
    border-left:4px solid #b8860b;
}

.pesanan-card.cancelled{
    border-left:4px solid #ef4444;
    opacity:0.85;
}

.pesanan-head{
    padding:18px 22px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:10px;
}

.order-num{
    font-size:13px;
    font-weight:600;
    color:#6b7280;
    margin-bottom:2px;
}

.order-name{
    font-size:15px;
    font-weight:700;
    color:#111827;
}

.order-date{
    font-size:12px;
    color:#9ca3af;
    margin-top:2px;
}

.status-badge{
    padding:6px 14px;
    border-radius:8px;
    font-size:12px;
    font-weight:600;
}

.status-pending{
    background:#fef3c7;
    color:#92400e;
}

.status-proses{
    background:#dbeafe;
    color:#1e40af;
}

.status-selesai{
    background:#d1fae5;
    color:#065f46;
}

.status-batal{
    background:#fee2e2;
    color:#991b1b;
}

.status-success{
    background:#d1fae5;
    color:#065f46;
}

.status-cancelled{
    background:#fee2e2;
    color:#991b1b;
}

.pesanan-items{
    padding:0 22px 16px;
    border-top:1px solid #f8fafc;
}

.item-line{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:10px 0;
    border-bottom:1px solid #f8fafc;
    font-size:13px;
}

.item-line:last-child{
    border-bottom:none;
}

.item-line-name{
    display:flex;
    align-items:center;
    gap:8px;
    color:#374151;
}

.item-line-name i{
    color:#b8860b;
}

.item-line-total{
    color:#374151;
    font-weight:600;
}

.pesanan-foot{
    padding:14px 22px;
    background:#fdf8e8;
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:8px;
}

.pesanan-card.cancelled .pesanan-foot{
    background:#fff5f5;
}

.total-label{
    font-size:12px;
    color:#9a7200;
    font-weight:600;
}

.pesanan-card.cancelled .total-label{
    color:#991b1b;
}

.total-pesanan{
    font-size:15px;
    font-weight:800;
    color:#b8860b;
}

.pesanan-card.cancelled .total-pesanan{
    color:#ef4444;
    text-decoration:line-through;
}

.btn-detail{
    display:flex;
    align-items:center;
    gap:6px;
    padding:8px 16px;
    border-radius:8px;
    border:1.5px solid #b8860b;
    color:#b8860b;
    font-size:13px;
    font-weight:600;
    transition:.2s;
    text-decoration:none;
}

.btn-detail:hover{
    background:#b8860b;
    color:white;
}

.btn-cancel{
    display:flex;
    align-items:center;
    gap:6px;
    padding:8px 16px;
    border-radius:8px;
    border:1.5px solid #ef4444;
    color:#ef4444;
    font-size:13px;
    font-weight:600;
    transition:.2s;
    background:transparent;
    cursor:pointer;
}

.btn-cancel:hover{
    background:#ef4444;
    color:white;
}

.btn-hapus-riwayat{
    display:flex;
    align-items:center;
    gap:6px;
    padding:8px 16px;
    border-radius:8px;
    border:1.5px solid #6b7280;
    color:#6b7280;
    font-size:13px;
    font-weight:600;
    transition:.2s;
    background:transparent;
    cursor:pointer;
}

.btn-hapus-riwayat:hover{
    background:#6b7280;
    color:white;
}

/* PAGINATION */
.pagination-wrap{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:6px;
    margin-top:28px;
    flex-wrap:wrap;
}

.page-btn{
    width:38px;
    height:38px;
    border-radius:10px;
    border:1.5px solid #e5e7eb;
    background:white;
    color:#374151;
    font-size:14px;
    font-weight:600;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
    transition:.2s;
}

.page-btn:hover{
    border-color:#b8860b;
    color:#b8860b;
}

.page-btn.active{
    background:#b8860b;
    border-color:#b8860b;
    color:white;
}

.page-btn.disabled{
    opacity:.4;
    pointer-events:none;
}

.btn-group{
    display:flex;
    gap:8px;
    align-items:center;
    flex-wrap:wrap;
}

/* ALERT */
.alert-success-bar{
    background:#d1fae5;
    color:#065f46;
    border:1px solid #a7f3d0;
    border-radius:12px;
    padding:14px 20px;
    margin-bottom:20px;
    font-size:14px;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:10px;
}

.alert-error-bar{
    background:#fee2e2;
    color:#991b1b;
    border:1px solid #fca5a5;
    border-radius:12px;
    padding:14px 20px;
    margin-bottom:20px;
    font-size:14px;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:10px;
}

/* LOGIN GATE */
.login-gate{
    background:white;
    border-radius:16px;
    border:1px solid #f1f5f9;
    box-shadow:0 2px 12px rgba(0,0,0,0.05);
    padding:60px 20px;
    text-align:center;
}

.login-gate i{
    font-size:52px;
    color:#d4a017;
    opacity:.3;
    display:block;
    margin-bottom:14px;
}

.btn-login-gate{
    display:inline-flex;
    align-items:center;
    gap:8px;
    margin-top:16px;
    padding:12px 28px;
    background:#b8860b;
    color:white;
    border-radius:10px;
    font-size:14px;
    font-weight:600;
    text-decoration:none;
    transition:.3s;
}

.btn-login-gate:hover{
    background:#9a7200;
    color:white;
}

/* =============================================
   EMPTY STATE ELEGAN
   ============================================= */
.empty-state{
    position:relative;
    border-radius:24px;
    padding:80px 20px;
    text-align:center;
    overflow:hidden;
    background:white;
    border:1px solid #f1f5f9;
    box-shadow:0 2px 12px rgba(0,0,0,0.05);
}

/* Lingkaran dekoratif transparan */
.empty-state::before{
    content:'';
    position:absolute;
    width:320px;
    height:320px;
    border-radius:50%;
    background:radial-gradient(circle, rgba(184,134,11,0.07) 0%, transparent 70%);
    top:-80px;
    right:-80px;
    pointer-events:none;
}

.empty-state::after{
    content:'';
    position:absolute;
    width:220px;
    height:220px;
    border-radius:50%;
    background:radial-gradient(circle, rgba(184,134,11,0.05) 0%, transparent 70%);
    bottom:-60px;
    left:-60px;
    pointer-events:none;
}

.empty-icon-wrap{
    position:relative;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    width:100px;
    height:100px;
    margin:0 auto 24px;
}

/* Cincin luar */
.empty-icon-wrap::before{
    content:'';
    position:absolute;
    inset:0;
    border-radius:50%;
    background:rgba(184,134,11,0.07);
}

/* Cincin tengah */
.empty-icon-wrap::after{
    content:'';
    position:absolute;
    inset:14px;
    border-radius:50%;
    background:rgba(184,134,11,0.10);
}

.empty-icon-wrap i{
    position:relative;
    z-index:1;
    font-size:36px;
    color:#b8860b;
    opacity:0.55;
}

.empty-title{
    font-size:22px;
    font-weight:800;
    color:#111827;
    margin-bottom:10px;
    position:relative;
    z-index:1;
}

.empty-sub{
    color:#6b7280;
    font-size:14px;
    line-height:1.8;
    margin-bottom:0;
    position:relative;
    z-index:1;
}

.empty-btn{
    display:inline-flex;
    align-items:center;
    gap:8px;
    margin-top:24px;
    padding:12px 28px;
    background:#b8860b;
    color:white;
    border-radius:10px;
    font-size:14px;
    font-weight:600;
    text-decoration:none;
    transition:.3s;
    position:relative;
    z-index:1;
}

.empty-btn:hover{
    background:#9a7200;
    color:white;
}

/* MODAL CONFIRM */
.modal-overlay{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,0.45);
    z-index:9999;
    align-items:center;
    justify-content:center;
}

.modal-overlay.active{
    display:flex;
}

.modal-box{
    background:white;
    border-radius:20px;
    padding:36px 32px;
    max-width:420px;
    width:90%;
    box-shadow:0 20px 60px rgba(0,0,0,0.15);
    text-align:center;
}

.modal-icon{
    font-size:48px;
    margin-bottom:16px;
}

.modal-icon.cancel-icon{
    color:#ef4444;
}

.modal-icon.hapus-icon{
    color:#6b7280;
}

.modal-title{
    font-size:20px;
    font-weight:800;
    color:#111827;
    margin-bottom:8px;
}

.modal-sub{
    font-size:14px;
    color:#6b7280;
    line-height:1.7;
    margin-bottom:28px;
}

.modal-order-num{
    font-weight:700;
    color:#b8860b;
}

.modal-actions{
    display:flex;
    gap:12px;
    justify-content:center;
}

.btn-modal-batal{
    padding:11px 28px;
    border-radius:10px;
    border:1.5px solid #e5e7eb;
    background:white;
    color:#374151;
    font-size:14px;
    font-weight:600;
    cursor:pointer;
    transition:.2s;
}

.btn-modal-batal:hover{
    border-color:#9ca3af;
    background:#f9fafb;
}

.btn-modal-confirm-cancel{
    padding:11px 28px;
    border-radius:10px;
    border:none;
    background:#ef4444;
    color:white;
    font-size:14px;
    font-weight:600;
    cursor:pointer;
    transition:.2s;
}

.btn-modal-confirm-cancel:hover{
    background:#dc2626;
}

.btn-modal-confirm-hapus{
    padding:11px 28px;
    border-radius:10px;
    border:none;
    background:#6b7280;
    color:white;
    font-size:14px;
    font-weight:600;
    cursor:pointer;
    transition:.2s;
}

.btn-modal-confirm-hapus:hover{
    background:#4b5563;
}

@media(max-width:1024px){
    .page-wrapper{
        padding:30px 24px 60px;
    }
}

</style>

<!-- MODAL CONFIRM CANCEL -->
<div class="modal-overlay" id="modalCancel">
    <div class="modal-box">

        <div class="modal-icon cancel-icon">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>

        <div class="modal-title">
            Batalkan Pesanan?
        </div>

        <div class="modal-sub">
            Apakah Anda yakin ingin membatalkan pesanan
            <span class="modal-order-num" id="modalCancelNum"></span>?
            <br>Tindakan ini tidak dapat dikembalikan.
        </div>

        <div class="modal-actions">

            <button class="btn-modal-batal"
                    onclick="tutupModal('modalCancel')">
                Tidak, Kembali
            </button>

            <form id="formCancel" method="post" action="">
                <?= csrf_field() ?>
                <button type="submit"
                        class="btn-modal-confirm-cancel">
                    <i class="fa-solid fa-xmark"></i>
                    Ya, Batalkan
                </button>
            </form>

        </div>

    </div>
</div>

<!-- MODAL CONFIRM HAPUS RIWAYAT -->
<div class="modal-overlay" id="modalHapus">
    <div class="modal-box">

        <div class="modal-icon hapus-icon">
            <i class="fa-solid fa-trash-can"></i>
        </div>

        <div class="modal-title">
            Hapus dari Riwayat?
        </div>

        <div class="modal-sub">
            Pesanan <span class="modal-order-num" id="modalHapusNum"></span>
            akan disembunyikan dari daftar riwayat Anda.
            <br>Data pesanan tetap aman dan admin masih bisa melihatnya.
        </div>

        <div class="modal-actions">

            <button class="btn-modal-batal"
                    onclick="tutupModal('modalHapus')">
                Batal
            </button>

            <form id="formHapus" method="post" action="">
                <?= csrf_field() ?>
                <button type="submit"
                        class="btn-modal-confirm-hapus">
                    <i class="fa-solid fa-trash-can"></i>
                    Ya, Hapus
                </button>
            </form>

        </div>

    </div>
</div>

<div class="page-wrapper">

    <h1 class="page-title">
        Riwayat Pesanan
    </h1>

    <p class="page-sub">
        Semua pesanan yang terhubung dengan akun Anda
    </p>

    <!-- ALERT SUCCESS -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert-success-bar">
            <i class="fa-solid fa-circle-check"></i>
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- ALERT ERROR -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert-error-bar">
            <i class="fa-solid fa-circle-xmark"></i>
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (!session()->get('logged_in_user')): ?>

        <!-- BELUM LOGIN -->
        <div class="login-gate">

            <i class="fa-solid fa-lock"></i>

            <h3 style="
                margin-bottom:10px;
                color:#111827;
                font-size:22px;
                font-weight:700;
            ">
                Silakan Login Terlebih Dahulu
            </h3>

            <p style="
                color:#6b7280;
                font-size:14px;
                line-height:1.7;
            ">
                Anda perlu login untuk melihat riwayat pesanan.
            </p>

            <a href="<?= base_url('login') ?>"
               class="btn-login-gate">
                <i class="fa-solid fa-right-to-bracket"></i>
                Login Sekarang
            </a>

        </div>

    <?php elseif (!empty($pesanan)): ?>

        <p class="result-info">
            Ditemukan <?= $total ?? count($pesanan) ?> pesanan
            <?php if (!empty($totalPages) && $totalPages > 1): ?>
                — Halaman <?= $currentPage ?> dari <?= $totalPages ?>
            <?php endif; ?>
        </p>

        <?php foreach ($pesanan as $p): ?>

            <?php

            $statusClass = match($p['status']) {
                'pending'   => 'status-pending',
                'proses'    => 'status-proses',
                'selesai'   => 'status-selesai',
                'batal'     => 'status-batal',
                'success'   => 'status-success',
                'cancelled' => 'status-cancelled',
                default     => 'status-pending'
            };

            $cardClass = $p['status'] === 'cancelled'
                ? 'pesanan-card cancelled'
                : 'pesanan-card';

            ?>

            <div class="<?= $cardClass ?>">

                <div class="pesanan-head">

                    <div>

                        <div class="order-num">
                            <?= esc($p['order_number']) ?>
                        </div>

                        <div class="order-name">
                            <?= esc($p['customer_name']) ?>
                        </div>

                        <div class="order-date">
                            <?= date('d M Y, H:i', strtotime($p['created_at'])) ?>
                        </div>

                    </div>

                    <span class="status-badge <?= $statusClass ?>">
                        <?= esc($p['status']) ?>
                    </span>

                </div>

                <?php if (!empty($p['items_decoded'])): ?>

                    <div class="pesanan-items">

                        <?php foreach ($p['items_decoded'] as $item): ?>

                            <div class="item-line">

                                <div class="item-line-name">

                                    <i class="fa-solid fa-tag"></i>

                                    <?= esc($item['product_name'] ?? $item['name'] ?? $item['title'] ?? '-') ?>
                                    &times;
                                    <?= (int)($item['qty'] ?? 1) ?>

                                </div>

                                <div class="item-line-total">
                                    Rp <?= number_format($item['subtotal'] ?? 0, 0, ',', '.') ?>
                                </div>

                            </div>

                        <?php endforeach; ?>

                    </div>

                <?php endif; ?>

                <div class="pesanan-foot">

                    <div>

                        <div class="total-label">
                            Total Pesanan
                        </div>

                        <div class="total-pesanan">
                            Rp <?= number_format($p['total_price'], 0, ',', '.') ?>
                        </div>

                    </div>

                    <!-- TOMBOL AKSI BERDASARKAN STATUS -->
                    <div class="btn-group">

                        <?php if ($p['status'] === 'pending'): ?>

                            <!-- PENDING: Detail + Cancel -->
                            <a href="<?= base_url('riwayat/detail/' . $p['order_number']) ?>"
                               class="btn-detail">
                                <i class="fa-solid fa-eye"></i>
                                Detail
                            </a>

                            <button class="btn-cancel"
                                    onclick="bukaModalCancel('<?= esc($p['order_number']) ?>', '<?= base_url('riwayat/cancel/' . $p['order_number']) ?>')">
                                <i class="fa-solid fa-xmark"></i>
                                Cancel
                            </button>

                        <?php elseif ($p['status'] === 'success'): ?>

                            <!-- SUCCESS: hanya Detail -->
                            <a href="<?= base_url('riwayat/detail/' . $p['order_number']) ?>"
                               class="btn-detail">
                                <i class="fa-solid fa-eye"></i>
                                Detail
                            </a>

                        <?php elseif ($p['status'] === 'cancelled'): ?>

                            <!-- CANCELLED: Hapus Riwayat -->
                            <button class="btn-hapus-riwayat"
                                    onclick="bukaModalHapus('<?= esc($p['order_number']) ?>', '<?= base_url('riwayat/hapus/' . $p['order_number']) ?>')">
                                <i class="fa-solid fa-trash-can"></i>
                                Hapus Riwayat
                            </button>

                        <?php else: ?>

                            <!-- STATUS LAIN: tampil Detail -->
                            <a href="<?= base_url('riwayat/detail/' . $p['order_number']) ?>"
                               class="btn-detail">
                                <i class="fa-solid fa-eye"></i>
                                Detail
                            </a>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

        <!-- PAGINATION -->
        <?php if (!empty($totalPages) && $totalPages > 1): ?>
        <div class="pagination-wrap">

            <!-- Prev -->
            <a href="?page=<?= $currentPage - 1 ?>"
               class="page-btn <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                <i class="fa-solid fa-chevron-left" style="font-size:12px;"></i>
            </a>

            <!-- Nomor halaman -->
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>"
                   class="page-btn <?= $i === $currentPage ? 'active' : '' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <!-- Next -->
            <a href="?page=<?= $currentPage + 1 ?>"
               class="page-btn <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                <i class="fa-solid fa-chevron-right" style="font-size:12px;"></i>
            </a>

        </div>
        <?php endif; ?>

    <?php else: ?>

        <!-- EMPTY STATE ELEGAN -->
        <div class="empty-state">

            <div class="empty-icon-wrap">
                <i class="fa-solid fa-box-open"></i>
            </div>

            <div class="empty-title">
                Belum ada pesanan
            </div>

            <p class="empty-sub">
                Anda belum pernah melakukan pesanan.<br>
                Yuk mulai belanja dan temukan produk terbaik kami!
            </p>

            <a href="<?= base_url('produk-user') ?>"
               class="empty-btn">
                <i class="fa-solid fa-bag-shopping"></i>
                Lihat Produk
            </a>

        </div>

    <?php endif; ?>

</div>

<script>

// =============================================
// MODAL CANCEL
// =============================================

function bukaModalCancel(orderNumber, actionUrl) {
    document.getElementById('modalCancelNum').textContent = orderNumber;
    document.getElementById('formCancel').action          = actionUrl;
    document.getElementById('modalCancel').classList.add('active');
}

// =============================================
// MODAL HAPUS RIWAYAT
// =============================================

function bukaModalHapus(orderNumber, actionUrl) {
    document.getElementById('modalHapusNum').textContent = orderNumber;
    document.getElementById('formHapus').action          = actionUrl;
    document.getElementById('modalHapus').classList.add('active');
}

// =============================================
// TUTUP MODAL (universal)
// =============================================

function tutupModal(id) {
    document.getElementById(id).classList.remove('active');
}

// Klik di luar modal = tutup
document.getElementById('modalCancel').addEventListener('click', function(e) {
    if (e.target === this) tutupModal('modalCancel');
});

document.getElementById('modalHapus').addEventListener('click', function(e) {
    if (e.target === this) tutupModal('modalHapus');
});

</script>

<?= view('frontend/footer2') ?>