<?php $title = 'Pesanan Anda - PSG'; ?>
<?= view('frontend/header2') ?>

<style>
    .page-wrapper{
        max-width:1100px;
        margin:0 auto;
        padding:40px 60px 80px;
    }

    .back-link{
        display:inline-flex;
        align-items:center;
        gap:6px;
        color:#6b7280;
        font-size:14px;
        margin-bottom:24px;
        transition:.2s;
        text-decoration:none;
    }

    .back-link:hover{ color:#b8860b; }

    .page-title{
        font-size:26px;
        font-weight:800;
        color:#111827;
        margin-bottom:28px;
    }

    .pesanan-grid{
        display:grid;
        grid-template-columns:1.2fr 1fr;
        gap:28px;
        align-items:start;
    }

    .keranjang-card,
    .form-card{
        background:white;
        border-radius:18px;
        border:1px solid #f1f5f9;
        box-shadow:0 2px 12px rgba(0,0,0,0.05);
        padding:28px;
    }

    .keranjang-title,
    .form-title{
        font-size:16px;
        font-weight:700;
        color:#111827;
        margin-bottom:20px;
        display:flex;
        align-items:center;
        gap:8px;
    }

    .keranjang-title i{ color:#b8860b; }

    .item-row{
        display:flex;
        align-items:center;
        gap:14px;
        padding:16px 0;
        border-bottom:1px solid #f1f5f9;
    }

    .item-row:last-child{ border-bottom:none; }

    .item-img{
        width:56px;
        height:56px;
        border-radius:10px;
        background:#fdf8e8;
        display:flex;
        align-items:center;
        justify-content:center;
        overflow:hidden;
        flex-shrink:0;
    }

    .item-img img{ width:100%; height:100%; object-fit:cover; }

    .item-info{ flex:1; }

    .item-name{
        font-size:14px;
        font-weight:600;
        color:#111827;
    }

    .item-price{
        font-size:13px;
        color:#b8860b;
        font-weight:600;
        margin-top:4px;
    }

    .item-qty{
        display:flex;
        align-items:center;
        gap:6px;
    }

    .qty-btn-sm{
        width:28px;
        height:28px;
        border-radius:6px;
        border:1px solid #e5e7eb;
        background:white;
        cursor:pointer;
        font-size:14px;
        display:flex;
        align-items:center;
        justify-content:center;
        transition:.2s;
    }

    .qty-btn-sm:hover{ border-color:#b8860b; color:#b8860b; }

    .qty-num{
        min-width:24px;
        text-align:center;
        font-size:14px;
        font-weight:600;
    }

    .item-subtotal{
        min-width:90px;
        text-align:right;
        font-weight:700;
        font-size:14px;
    }

    .btn-hapus{ color:#ef4444; text-decoration:none; }

    .total-row{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-top:20px;
        padding-top:20px;
        border-top:2px solid #f1f5f9;
    }

    .total-amount{
        font-size:22px;
        font-weight:800;
        color:#b8860b;
    }

    .form-group{
        margin-bottom:16px;
        position:relative;
    }

    .form-label{
        display:block;
        margin-bottom:6px;
        font-size:13px;
        font-weight:600;
        color:#374151;
    }

    .form-control{
        width:100%;
        padding:12px 14px;
        border:1.5px solid #e5e7eb;
        border-radius:10px;
        outline:none;
        font-size:14px;
        font-family:'Poppins',sans-serif;
        transition:border-color .2s, box-shadow .2s;
        box-sizing:border-box;
    }

    .form-control:focus{
        border-color:#b8860b;
        box-shadow:0 0 0 3px rgba(184,134,11,0.12);
    }

    .form-control.is-error{
        border-color:#ef4444 !important;
        box-shadow:0 0 0 3px rgba(239,68,68,0.15) !important;
        background:#fff5f5;
    }

    .form-error-msg{
        display:none;
        font-size:12px;
        color:#ef4444;
        font-weight:600;
        margin-top:5px;
        align-items:center;
        gap:4px;
    }

    .form-error-msg.show{ display:flex; }

    @keyframes shake{
        0%,100%{ transform:translateX(0); }
        15%     { transform:translateX(-7px); }
        30%     { transform:translateX(7px); }
        45%     { transform:translateX(-5px); }
        60%     { transform:translateX(5px); }
        75%     { transform:translateX(-3px); }
        90%     { transform:translateX(3px); }
    }

    .shake{ animation:shake .45s ease; }

    .btn-kirim{
        width:100%;
        padding:15px;
        border:none;
        border-radius:12px;
        background:#b8860b;
        color:white;
        font-weight:700;
        font-size:15px;
        cursor:pointer;
        display:flex;
        align-items:center;
        justify-content:center;
        gap:8px;
        transition:.3s;
        font-family:'Poppins',sans-serif;
    }

    .btn-kirim:hover{
        background:#9a7200;
        transform:translateY(-2px);
        box-shadow:0 8px 20px rgba(184,134,11,0.3);
    }

    .btn-kirim:disabled{
        background:#d1d5db;
        cursor:not-allowed;
        transform:none;
        box-shadow:none;
    }

    .empty-cart{
        min-height:350px;
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        text-align:center;
        opacity:.75;
    }

    .empty-cart i{
        font-size:60px;
        color:#b8860b;
        margin-bottom:16px;
    }

    .empty-cart h3{
        font-size:22px;
        margin-bottom:8px;
        color:#111827;
    }

    .empty-cart p{
        color:#6b7280;
        margin-bottom:20px;
    }

    .btn-kembali-belanja{
        padding:12px 22px;
        background:#b8860b;
        color:white;
        border-radius:10px;
        text-decoration:none;
        font-weight:600;
    }

    .empty-form-info{
        min-height:350px;
        display:flex;
        align-items:center;
        justify-content:center;
        text-align:center;
        color:#6b7280;
        font-size:15px;
    }

    @media(max-width:1024px){
        .page-wrapper{ padding:30px 24px 60px; }
        .pesanan-grid{ grid-template-columns:1fr; }
    }
</style>

<div class="page-wrapper">

    <a href="<?= base_url('produk-user') ?>" class="back-link">
        <i class="fa-solid fa-arrow-left"></i>
        Kembali ke Produk
    </a>

    <h1 class="page-title">Pesanan Anda</h1>

    <?php if (!empty($keranjang)): ?>

    <form id="checkout-form" method="post" action="<?= base_url('pesanan/kirim') ?>">

        <?= csrf_field() ?>

        <div class="pesanan-grid">

            <!-- ==================== KERANJANG ==================== -->
            <div class="keranjang-card">

                <div class="keranjang-title">
                    <i class="fa-solid fa-cart-shopping"></i>
                    Keranjang (<?= count($keranjang) ?> item)
                </div>

                <?php
                // Ambil stok langsung dari DB (tidak andalkan session)
                $db = \Config\Database::connect();
                $stokMap = [];
                foreach ($keranjang as $_item) {
                    $p = $db->table('products')->select('id, stock')->where('id', $_item['id'])->get()->getRowArray();
                    $stokMap[$_item['id']] = $p ? (int)$p['stock'] : 999;
                }
                ?>
                <?php foreach ($keranjang as $item): ?>
                <div class="item-row" data-item-id="<?= $item['id'] ?>" data-price="<?= $item['price'] ?? $item['harga'] ?>" data-stock="<?= $stokMap[$item['id']] ?? 999 ?>">

                    <div class="item-img">
                        <?php if (!empty($item['image'] ?? $item['gambar'])): ?>
                            <img src="<?= base_url('uploads/produk/' . ($item['image'] ?? $item['gambar'])) ?>">
                        <?php else: ?>
                            <i class="fa-solid fa-box" style="color:#d4a017;font-size:22px;opacity:.5;"></i>
                        <?php endif; ?>
                    </div>

                    <div class="item-info">
                        <div class="item-name"><?= esc($item['name'] ?? $item['nama']) ?></div>
                        <div class="item-price">Rp <?= number_format($item['price'] ?? $item['harga'], 0, ',', '.') ?></div>
                    </div>

                    <div class="item-qty">
                        <button type="button" class="qty-btn-sm"
                                data-action="update"
                                data-id="<?= $item['id'] ?>"
                                data-qty="<?= $item['qty'] - 1 ?>">−</button>
                        <span class="qty-num"><?= $item['qty'] ?></span>
                        <button type="button" class="qty-btn-sm"
                                data-action="update"
                                data-id="<?= $item['id'] ?>"
                                data-qty="<?= $item['qty'] + 1 ?>">+</button>
                    </div>

                    <div class="item-subtotal">Rp <?= number_format($item['subtotal'], 0, ',', '.') ?></div>

                    <button type="button" class="btn-hapus"
                            data-action="hapus"
                            data-id="<?= $item['id'] ?>">
                        <i class="fa-solid fa-trash"></i>
                    </button>

                </div>
                <?php endforeach; ?>

                <div class="total-row">
                    <div>Total</div>
                    <div class="total-amount">Rp <?= number_format($total, 0, ',', '.') ?></div>
                </div>

            </div>

            <!-- ==================== FORM PEMESAN ==================== -->
            <div class="form-card">

                <div class="form-title">Informasi Pemesan</div>

                <!-- Nama Lengkap -->
                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span style="color:#ef4444">*</span></label>
                    <input type="text"
                           id="customer_name"
                           name="customer_name"
                           class="form-control"
                           placeholder="Masukkan nama lengkap">
                    <div class="form-error-msg" id="err-nama">
                        <i class="fa-solid fa-circle-exclamation"></i> Harap isi nama lengkap
                    </div>
                </div>

                <!-- No HP -->
                <div class="form-group">
                    <label class="form-label">Nomor Telepon <span style="color:#ef4444">*</span></label>
                    <input type="text"
                           id="customer_phone"
                           name="customer_phone"
                           class="form-control"
                           placeholder="Contoh: 08123456789">
                    <div class="form-error-msg" id="err-hp">
                        <i class="fa-solid fa-circle-exclamation"></i> Harap isi nomor telepon
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email"
                           name="customer_email"
                           class="form-control"
                           placeholder="email@contoh.com">
                </div>

                <!-- Alamat -->
                <div class="form-group">
                    <label class="form-label">Alamat</label>
                    <textarea name="address"
                              class="form-control"
                              rows="3"
                              placeholder="Masukkan alamat lengkap"></textarea>
                </div>

                <!-- Catatan -->
                <div class="form-group">
                    <label class="form-label">Catatan</label>
                    <textarea name="notes"
                              class="form-control"
                              rows="2"
                              placeholder="Catatan tambahan"></textarea>
                </div>

                <!-- TOMBOL BAYAR -->
                <button type="button" class="btn-kirim" id="btnBayar">
                    <i class="fa-solid fa-credit-card"></i>
                    Bayar Sekarang
                </button>

                <div id="payLoading" style="display:none; text-align:center; margin-top:10px; font-size:13px; color:#6b7280;">
                    <i class="fa-solid fa-spinner fa-spin"></i> Memproses pesanan...
                </div>

            </div>

        </div>

    </form>

    <?php else: ?>

    <div class="pesanan-grid">

        <div class="keranjang-card">
            <div class="empty-cart">
                <i class="fa-solid fa-cart-shopping"></i>
                <h3>Keranjang Masih Kosong</h3>
                <p>Silakan pilih produk terlebih dahulu</p>
                <a href="<?= base_url('produk-user') ?>" class="btn-kembali-belanja">
                    Belanja Sekarang
                </a>
            </div>
        </div>

        <div class="form-card">
            <div class="form-title">Informasi Pemesan</div>
            <div class="empty-form-info">
                Form pemesanan akan muncul setelah ada produk di keranjang.
            </div>
        </div>

    </div>

    <?php endif; ?>

</div>


<?php if (!empty($keranjang)): ?>

<!-- =====================================================================
     MIDTRANS SNAP.JS
===================================================================== -->
<script
    src="<?= esc($midtrans_snap_url ?? 'https://app.sandbox.midtrans.com/snap/snap.js') ?>"
    data-client-key="<?= esc($midtrans_client_key ?? '') ?>">
</script>

<script>

const btnBayar   = document.getElementById('btnBayar');
const payLoading = document.getElementById('payLoading');
const form       = document.getElementById('checkout-form');

/* ===== VALIDASI FIELD ===== */
function validateForm() {
    const nama = document.getElementById('customer_name');
    const hp   = document.getElementById('customer_phone');
    let valid  = true;

    // Reset dulu
    [nama, hp].forEach(el => {
        el.classList.remove('is-error', 'shake');
    });
    document.getElementById('err-nama').classList.remove('show');
    document.getElementById('err-hp').classList.remove('show');

    if (!nama.value.trim()) {
        nama.classList.add('is-error', 'shake');
        document.getElementById('err-nama').classList.add('show');
        nama.addEventListener('animationend', () => nama.classList.remove('shake'), { once: true });
        valid = false;
    }

    if (!hp.value.trim()) {
        hp.classList.add('is-error', 'shake');
        document.getElementById('err-hp').classList.add('show');
        hp.addEventListener('animationend', () => hp.classList.remove('shake'), { once: true });
        valid = false;
    }

    return valid;
}

// Hapus error saat user mulai mengetik
document.getElementById('customer_name').addEventListener('input', function(){
    this.classList.remove('is-error');
    document.getElementById('err-nama').classList.remove('show');
});

document.getElementById('customer_phone').addEventListener('input', function(){
    this.classList.remove('is-error');
    document.getElementById('err-hp').classList.remove('show');
});

/* ===== KLIK BAYAR ===== */
btnBayar.addEventListener('click', async function () {

    if (!validateForm()) return;

    btnBayar.disabled = true;
    payLoading.style.display = 'block';

    try {
        // ============================================
        // STEP 1 — Simpan pesanan ke DB (status pending)
        // ============================================
        const formData = new FormData(form);

        const resOrder = await fetch('<?= base_url('pesanan/proses-ajax') ?>', {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            body: formData
        });

        const dataOrder = await resOrder.json();

        if (!dataOrder.success) {
            alert(dataOrder.message || 'Gagal membuat pesanan, coba lagi.');
            btnBayar.disabled = false;
            payLoading.style.display = 'none';
            return;
        }

        // ============================================
        // STEP 2 — Ambil Snap Token
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
            alert(dataToken.message || 'Gagal membuat token pembayaran.');
            btnBayar.disabled = false;
            return;
        }

        // ============================================
        // STEP 3 — Buka Midtrans Snap Popup
        // ============================================
        snap.pay(dataToken.snap_token, {

            onSuccess: function (result) {
                kirimStatusKeFrontend(dataOrder.order_id, result.transaction_status);
                window.location.href = '<?= base_url('riwayat') ?>';
            },

            onPending: function (result) {
                kirimStatusKeFrontend(dataOrder.order_id, result.transaction_status);
                window.location.href = '<?= base_url('riwayat') ?>';
            },

            onError: function (result) {
                kirimStatusKeFrontend(dataOrder.order_id, 'deny');
                alert('Pembayaran gagal. Silakan coba lagi dari halaman Riwayat.');
                window.location.href = '<?= base_url('riwayat') ?>';
            },

            onClose: function () {
                // User tutup popup tanpa bayar — status tetap pending
                window.location.href = '<?= base_url('riwayat') ?>';
            }

        });

    } catch (err) {
        console.error(err);
        alert('Terjadi kesalahan koneksi, silakan coba lagi.');
        btnBayar.disabled = false;
        payLoading.style.display = 'none';
    }

});

/* ===== UPDATE STATUS CEPAT KE SERVER ===== */
function kirimStatusKeFrontend(orderId, transactionStatus) {
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

/* ===== UPDATE QTY & HAPUS — optimistic UI tanpa reload ===== */
var BASE_UPDATE = '<?= base_url("keranjang/update/") ?>';
var BASE_HAPUS  = '<?= base_url("keranjang/hapus/") ?>';

function formatRp(num) {
    return 'Rp ' + parseInt(num).toLocaleString('id-ID');
}

function recalcTotal() {
    var total = 0, jumlah = 0;
    document.querySelectorAll('.item-row').forEach(function(row) {
        var price = parseInt(row.dataset.price || 0);
        var qty   = parseInt(row.querySelector('.qty-num').textContent || 0);
        row.querySelector('.item-subtotal').textContent = formatRp(price * qty);
        total  += price * qty;
        jumlah++;
    });
    document.querySelector('.total-amount').textContent = formatRp(total);
    var badge = document.querySelector('.cart-badge');
    if (badge) { badge.textContent = jumlah; badge.style.display = jumlah > 0 ? 'inline-flex' : 'none'; }
}

document.addEventListener('click', function(e) {
    var btn = e.target.closest('[data-action]');
    if (!btn) return;
    // Jangan intercept tombol Bayar
    if (btn.id === 'btnBayar') return;

    var action = btn.dataset.action;
    var id     = btn.dataset.id;
    var row    = btn.closest('.item-row');

    if (action === 'update') {
        var newQty = parseInt(btn.dataset.qty);
        var maxStock = parseInt(row.dataset.stock || 999);

        if (newQty < 1) {
            if (!confirm('Hapus item ini dari keranjang?')) return;
            row.remove();
            recalcTotal();
            fetch(BASE_HAPUS + id, { redirect: 'manual' }).catch(function(){});
            return;
        }
        if (newQty > maxStock) {
            // Tombol + berkedip merah, qty tidak bertambah
            var btnPlus = row.querySelectorAll('[data-action="update"]')[1];
            if (btnPlus) {
                btnPlus.style.borderColor = '#ef4444';
                btnPlus.style.color = '#ef4444';
                btnPlus.style.background = '#fee2e2';
                setTimeout(function(){
                    btnPlus.style.borderColor = '';
                    btnPlus.style.color = '';
                    btnPlus.style.background = '';
                }, 800);
            }
            // Update data-qty tombol + agar tidak bisa terus naik
            btn.dataset.qty = maxStock + 1; // tetap > maxStock supaya selalu terblock
            return;
        }
        row.querySelector('.qty-num').textContent = newQty;
        var btns = row.querySelectorAll('[data-action="update"]');
        if (btns[0]) btns[0].dataset.qty = newQty - 1;
        if (btns[1]) btns[1].dataset.qty = newQty + 1;
        recalcTotal();
        fetch(BASE_UPDATE + id + '?qty=' + newQty, { redirect: 'manual' }).catch(function(){});

    } else if (action === 'hapus') {
        if (!confirm('Hapus item ini dari keranjang?')) return;
        row.remove();
        recalcTotal();
        fetch(BASE_HAPUS + id, { redirect: 'manual' }).catch(function(){});
    }
});

</script>

<?php endif; ?>

<?= view('frontend/footer2') ?>