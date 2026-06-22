<?php $title = 'Pesanan Anda - PSG'; ?>
<?= view('frontend/header2') ?>

<style>
    .page-wrapper{max-width:1100px;margin:0 auto;padding:40px 60px 80px;}
    .back-link{display:inline-flex;align-items:center;gap:6px;color:#6b7280;font-size:14px;margin-bottom:24px;transition:.2s;}
    .back-link:hover{color:#b8860b;}
    .page-title{font-size:26px;font-weight:800;color:#111827;margin-bottom:28px;}

    .pesanan-grid{display:grid;grid-template-columns:1.2fr 1fr;gap:28px;align-items:start;}

    /* Keranjang */
    .keranjang-card{
        background:white;border-radius:18px;
        border:1px solid #f1f5f9;
        box-shadow:0 2px 12px rgba(0,0,0,0.05);
        padding:28px;
    }
    .keranjang-title{font-size:16px;font-weight:700;color:#111827;margin-bottom:20px;display:flex;align-items:center;gap:8px;}
    .keranjang-title i{color:#b8860b;}

    .item-row{
        display:flex;align-items:center;gap:14px;
        padding:16px 0;border-bottom:1px solid #f1f5f9;
    }
    .item-row:last-child{border-bottom:none;}
    .item-img{
        width:56px;height:56px;border-radius:10px;
        background:#fdf8e8;display:flex;align-items:center;justify-content:center;
        flex-shrink:0;overflow:hidden;
    }
    .item-img img{width:100%;height:100%;object-fit:cover;}
    .item-img i{font-size:22px;color:#d4a017;opacity:.6;}
    .item-info{flex:1;}
    .item-name{font-size:14px;font-weight:600;color:#111827;margin-bottom:3px;}
    .item-price{font-size:13px;color:#b8860b;font-weight:600;}

    .item-qty{display:flex;align-items:center;gap:6px;}
    .qty-btn-sm{
        width:28px;height:28px;border-radius:6px;
        border:1px solid #e5e7eb;background:white;
        cursor:pointer;font-size:14px;transition:.2s;
        display:flex;align-items:center;justify-content:center;
    }
    .qty-btn-sm:hover{border-color:#b8860b;color:#b8860b;}
    .qty-num{font-size:14px;font-weight:600;color:#111827;min-width:24px;text-align:center;}

    .item-subtotal{font-size:14px;font-weight:700;color:#111827;min-width:90px;text-align:right;}
    .btn-hapus{background:none;border:none;color:#9ca3af;cursor:pointer;padding:4px;transition:.2s;}
    .btn-hapus:hover{color:#ef4444;}

    .total-row{
        display:flex;justify-content:space-between;align-items:center;
        padding-top:16px;margin-top:4px;border-top:2px solid #f1f5f9;
    }
    .total-label{font-size:14px;font-weight:600;color:#374151;}
    .total-amount{font-size:20px;font-weight:800;color:#b8860b;}

    /* Form Pemesan */
    .form-card{
        background:white;border-radius:18px;
        border:1px solid #f1f5f9;
        box-shadow:0 2px 12px rgba(0,0,0,0.05);
        padding:28px;
    }
    .form-title{font-size:16px;font-weight:700;color:#111827;margin-bottom:20px;}
    .form-group{margin-bottom:16px;}
    .form-label{font-size:13px;font-weight:600;color:#374151;margin-bottom:6px;display:block;}
    .form-label span{color:#ef4444;}
    .form-control{
        width:100%;padding:11px 14px;
        border:1.5px solid #e5e7eb;border-radius:10px;
        font-size:14px;color:#111827;outline:none;
        transition:border-color .2s;font-family:'Poppins',sans-serif;
    }
    .form-control:focus{border-color:#b8860b;box-shadow:0 0 0 3px rgba(184,134,11,0.1);}
    textarea.form-control{resize:vertical;min-height:80px;}

    .btn-kirim{
        width:100%;padding:15px;border-radius:12px;
        background:#b8860b;color:white;
        font-size:15px;font-weight:700;border:none;
        cursor:pointer;transition:.3s;
        display:flex;align-items:center;justify-content:center;gap:8px;
    }
    .btn-kirim:hover{background:#9a7200;transform:translateY(-2px);box-shadow:0 8px 20px rgba(184,134,11,0.3);}

    /* Empty */
    .empty-cart{text-align:center;padding:60px 20px;grid-column:1/-1;}
    .empty-cart i{font-size:64px;color:#d4a017;opacity:.3;display:block;margin-bottom:16px;}
    .empty-cart p{color:#6b7280;font-size:15px;margin-bottom:20px;}
    .btn-shop{
        display:inline-flex;align-items:center;gap:8px;
        background:#b8860b;color:white;
        padding:12px 24px;border-radius:10px;font-weight:600;font-size:14px;
        transition:.3s;
    }
    .btn-shop:hover{background:#9a7200;}

    @media(max-width:1024px){
        .page-wrapper{padding:30px 24px 60px;}
        .pesanan-grid{grid-template-columns:1fr;}
    }
</style>

<div class="page-wrapper">
    <a href="<?= base_url('produk') ?>" class="back-link">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Produk
    </a>
    <h1 class="page-title">Pesanan Anda</h1>

    <?php if (!empty($keranjang)): ?>
    <form method="post" action="<?= base_url('pesanan/kirim') ?>" id="formPesanan">
        <?= csrf_field() ?>
        <div class="pesanan-grid">

            <!-- KERANJANG -->
            <div class="keranjang-card">
                <div class="keranjang-title">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Keranjang (<?= count($keranjang) ?> item)
                </div>

                <?php foreach ($keranjang as $item): ?>
                <div class="item-row">
                    <div class="item-img">
                        <?php if (!empty($item['image'])): ?>
                            <img src="<?= base_url('uploads/produk/' . $item['image']) ?>" alt="">
                        <?php else: ?>
                            <i class="fa-solid <?= $item['category'] == 'Cat' ? 'fa-paint-roller' : 'fa-door-open' ?>"></i>
                        <?php endif; ?>
                    </div>
                    <div class="item-info">
                        <div class="item-name"><?= esc($item['name']) ?></div>
                        <div class="item-price">Rp <?= number_format($item['price'], 0, ',', '.') ?></div>
                    </div>
                    <div class="item-qty">
                        <a href="<?= base_url('keranjang/update/' . $item['id']) ?>?qty=<?= $item['qty'] - 1 ?>"
                           class="qty-btn-sm" onclick="this.href=this.href.replace(/qty=\d+/,'qty='+(<?= $item['qty'] ?>-1))">−</a>
                        <span class="qty-num"><?= $item['qty'] ?></span>
                        <a href="<?= base_url('keranjang/update/' . $item['id']) ?>?qty=<?= $item['qty'] + 1 ?>"
                           class="qty-btn-sm">+</a>
                    </div>
                    <div class="item-subtotal">Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></div>
                    <a href="<?= base_url('keranjang/hapus/' . $item['id']) ?>" class="btn-hapus">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </div>
                <?php endforeach; ?>

                <div class="total-row">
                    <span class="total-label">Total (<?= count($keranjang) ?> item)</span>
                    <span class="total-amount">Rp <?= number_format($total, 0, ',', '.') ?></span>
                </div>
            </div>

            <!-- FORM PEMESAN -->
            <div class="form-card">
                <div class="form-title">Informasi Pemesan</div>

                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span>*</span></label>
                    <input type="text" name="customer_name" class="form-control"
                           placeholder="Masukkan nama lengkap" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nomor Telepon <span>*</span></label>
                    <input type="text" name="customer_phone" class="form-control"
                           placeholder="Contoh: 08123456789" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email (opsional)</label>
                    <input type="email" name="customer_email" class="form-control"
                           placeholder="email@contoh.com">
                </div>
                <div class="form-group">
                    <label class="form-label">Alamat Pengiriman</label>
                    <textarea name="address" class="form-control"
                              placeholder="Masukkan alamat lengkap"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Catatan (opsional)</label>
                    <textarea name="notes" class="form-control"
                              placeholder="Catatan tambahan untuk pesanan"></textarea>
                </div>

                <button type="button" class="btn-kirim" id="btnBayarSekarang">
                    <i class="fa-solid fa-credit-card"></i> Bayar Sekarang
                </button>

                <div id="payLoading" style="display:none; text-align:center; margin-top:10px; font-size:13px; color:#6b7280;">
                    <i class="fa-solid fa-spinner fa-spin"></i> Memproses pesanan...
                </div>
            </div>

        </div>
    </form>

    <?php else: ?>
    <div class="pesanan-grid">
        <div class="empty-cart">
            <i class="fa-solid fa-cart-shopping"></i>
            <p>Keranjang Anda masih kosong</p>
            <a href="<?= base_url('produk') ?>" class="btn-shop">
                <i class="fa-solid fa-box"></i> Lihat Produk
            </a>
        </div>
    </div>
    <?php endif; ?>
</div>

<!-- =====================================================================
     MIDTRANS SNAP INTEGRATION
===================================================================== -->
<?php if (!empty($keranjang)) : ?>

<!-- Snap.js dari Midtrans -->
<script
    src="<?= esc($midtrans_snap_url ?? 'https://app.sandbox.midtrans.com/snap/snap.js') ?>"
    data-client-key="<?= esc($midtrans_client_key ?? '') ?>"
></script>

<script>
const btnBayar  = document.getElementById('btnBayarSekarang');
const payLoading = document.getElementById('payLoading');
const formPesanan = document.getElementById('formPesanan');

btnBayar.addEventListener('click', async function () {

    // Validasi field wajib
    const nama  = formPesanan.querySelector('[name="customer_name"]');
    const hp    = formPesanan.querySelector('[name="customer_phone"]');

    if (!nama.value.trim()) { nama.focus(); return alert('Nama lengkap wajib diisi!'); }
    if (!hp.value.trim())   { hp.focus();   return alert('Nomor telepon wajib diisi!'); }

    btnBayar.disabled = true;
    payLoading.style.display = 'block';

    try {
        // ============================================
        // STEP 1: Simpan pesanan ke database (status pending)
        // ============================================
        const formData = new FormData(formPesanan);

        const resOrder = await fetch('<?= base_url('pesanan/proses-ajax') ?>', {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            body: formData
        });

        const dataOrder = await resOrder.json();

        if (!dataOrder.success) {
            alert(dataOrder.message || 'Gagal membuat pesanan');
            btnBayar.disabled = false;
            payLoading.style.display = 'none';
            return;
        }

        // ============================================
        // STEP 2: Minta Snap Token dari backend
        // ============================================
        const resToken = await fetch('<?= base_url('payment/snap-token') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: 'order_id=' + encodeURIComponent(dataOrder.order_id)
        });

        const dataToken = await resToken.json();

        payLoading.style.display = 'none';

        if (!dataToken.success) {
            alert(dataToken.message || 'Gagal membuat token pembayaran');
            btnBayar.disabled = false;
            return;
        }

        // ============================================
        // STEP 3: Buka Snap Popup
        // ============================================
        snap.pay(dataToken.snap_token, {

            onSuccess: function (result) {
                updateStatusFrontend(dataOrder.order_id, result.transaction_status);
                window.location.href = '<?= base_url('riwayat') ?>';
            },

            onPending: function (result) {
                updateStatusFrontend(dataOrder.order_id, result.transaction_status);
                window.location.href = '<?= base_url('riwayat') ?>';
            },

            onError: function (result) {
                updateStatusFrontend(dataOrder.order_id, 'deny');
                alert('Pembayaran gagal. Anda bisa mencoba lagi dari halaman Riwayat.');
                window.location.href = '<?= base_url('riwayat') ?>';
            },

            onClose: function () {
                // User menutup popup tanpa bayar -> status tetap pending
                window.location.href = '<?= base_url('riwayat') ?>';
            }
        });

    } catch (err) {
        console.error(err);
        alert('Terjadi kesalahan, silakan coba lagi.');
        btnBayar.disabled = false;
        payLoading.style.display = 'none';
    }
});

// Update status cepat ke server (UX), status final tetap via webhook notification()
function updateStatusFrontend(orderId, transactionStatus) {
    fetch('<?= base_url('payment/update-status') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: 'order_id=' + encodeURIComponent(orderId)
            + '&transaction_status=' + encodeURIComponent(transactionStatus)
    });
}
</script>

<?php endif; ?>

<?= view('frontend/footer2') ?>