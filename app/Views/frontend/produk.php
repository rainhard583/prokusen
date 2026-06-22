<?php $title = 'Semua Produk - PSG'; ?>
<?= view('frontend/header2') ?>

<style>
    .page-wrapper{
        max-width:1300px;
        margin:0 auto;
        padding:40px 60px 80px;
    }

    .page-title{
        font-size:28px;
        font-weight:800;
        color:#111827;
        margin-bottom:6px;
    }

    .page-sub{
        color:#6b7280;
        font-size:14px;
        margin-bottom:30px;
    }

    /* Search */
    .search-bar{
        display:flex;
        align-items:center;
        gap:12px;
        background:white;
        padding:14px 20px;
        border-radius:14px;
        border:1px solid #e5e7eb;
        box-shadow:0 2px 10px rgba(0,0,0,0.05);
        margin-bottom:24px;
        flex-wrap:wrap;
    }

    .search-bar input{
        flex:1;
        border:none;
        outline:none;
        font-size:14px;
        color:#374151;
        min-width:200px;
    }

    .filter-btns{
        display:flex;
        gap:8px;
        flex-wrap:wrap;
    }

    .filter-btn{
        padding:8px 18px;
        border-radius:8px;
        border:1px solid #e5e7eb;
        background:white;
        font-size:13px;
        font-weight:500;
        color:#6b7280;
        cursor:pointer;
        transition:.2s;
        text-decoration:none;
    }

    .filter-btn:hover,
    .filter-btn.active{
        background:#b8860b;
        color:white;
        border-color:#b8860b;
    }

    .btn-search{
        background:#b8860b;
        color:white;
        padding:10px 20px;
        border-radius:10px;
        border:none;
        font-size:14px;
        font-weight:600;
        cursor:pointer;
        transition:.3s;
        display:flex;
        align-items:center;
        gap:6px;
    }

    .btn-search:hover{
        background:#9a7200;
    }

    .prod-count{
        color:#6b7280;
        font-size:13px;
        margin-bottom:20px;
    }

    /* GRID */
    .prod-grid{
        display:grid;
        grid-template-columns:repeat(auto-fill,minmax(260px,1fr));
        gap:22px;
    }

    .prod-card{
        background:white;
        border-radius:18px;
        border:1px solid #f1f5f9;
        box-shadow:0 2px 12px rgba(0,0,0,0.05);
        overflow:hidden;
        transition:.3s;
    }

    .prod-card:hover{
        transform:translateY(-5px);
        box-shadow:0 12px 25px rgba(0,0,0,0.08);
    }

    .prod-img{
        width:100%;
        height:220px;
        background:#fdf8e8;
        display:flex;
        align-items:center;
        justify-content:center;
        position:relative;
        overflow:hidden;
    }

    .prod-img img{
        width:100%;
        height:100%;
        object-fit:cover;
    }

    .prod-img .no-img{
        font-size:48px;
        color:#d4a017;
        opacity:.5;
    }

    .prod-badge{
        position:absolute;
        top:12px;
        right:12px;
        background:#b8860b;
        color:white;
        font-size:11px;
        font-weight:600;
        padding:4px 10px;
        border-radius:6px;
    }

    .prod-badge.cat-kusen{
        background:#8B5E3C;
    }

    .prod-badge.cat-cat{
        background:#e53e3e;
    }

    .prod-body{
        padding:20px;
    }

    .prod-name{
        font-size:16px;
        font-weight:700;
        color:#111827;
        margin-bottom:6px;
    }

    .prod-desc{
        font-size:13px;
        color:#6b7280;
        line-height:1.6;
        margin-bottom:14px;

        display:-webkit-box;
        -webkit-line-clamp:2;
        -webkit-box-orient:vertical;
        overflow:hidden;
    }

    .prod-price{
        font-size:20px;
        font-weight:800;
        color:#b8860b;
        margin-bottom:16px;
    }

    .prod-footer{
        display:flex;
        gap:10px;
    }

    .btn-detail{
        flex:1;
        padding:10px;
        border-radius:10px;
        border:1.5px solid #b8860b;
        color:#b8860b;
        font-size:13px;
        font-weight:600;
        background:transparent;
        text-align:center;
        text-decoration:none;
        transition:.2s;
    }

    .btn-detail:hover{
        background:#fdf8e8;
    }

    .btn-keranjang{
        flex:2;
        padding:10px;
        border-radius:10px;
        background:#b8860b;
        color:white;
        font-size:13px;
        font-weight:600;
        border:none;
        transition:.2s;

        display:flex;
        align-items:center;
        justify-content:center;
        gap:6px;

        text-decoration:none;
    }

    .btn-keranjang:hover{
        background:#9a7200;
        color:white;
    }

    .empty-state{
        text-align:center;
        padding:80px 20px;
        color:#9ca3af;
    }

    .empty-state i{
        font-size:60px;
        margin-bottom:16px;
        display:block;
    }

    @media(max-width:1024px){
        .page-wrapper{
            padding:30px 24px 60px;
        }
    }
</style>

<div class="page-wrapper">

    <h1 class="page-title">Semua Produk</h1>

    <p class="page-sub">
        Temukan kusen dan cat berkualitas untuk rumah Anda
    </p>

    <!-- SEARCH -->
    <form method="get" action="<?= base_url('produk-user') ?>">

        <div class="search-bar">

            <i class="fa-solid fa-magnifying-glass" style="color:#9ca3af;"></i>

            <input type="text"
                   name="keyword"
                   placeholder="Cari produk..."
                   value="<?= esc($keyword ?? '') ?>">

            <div class="filter-btns">

                <a href="<?= base_url('produk-user') ?>"
                   class="filter-btn <?= empty($kategori) ? 'active' : '' ?>">
                    Semua
                </a>

                <a href="<?= base_url('produk-user?kategori=Kusen') ?>"
                   class="filter-btn <?= ($kategori == 'Kusen') ? 'active' : '' ?>">
                    Kusen
                </a>

                <a href="<?= base_url('produk-user?kategori=Cat') ?>"
                   class="filter-btn <?= ($kategori == 'Cat') ? 'active' : '' ?>">
                    Cat
                </a>

            </div>

            <button type="submit" class="btn-search">
                <i class="fa-solid fa-magnifying-glass"></i>
                Cari
            </button>

        </div>

    </form>

    <p class="prod-count">
        Menampilkan <?= count($produk) ?> produk
    </p>

    <?php if (!empty($produk)): ?>

        <div class="prod-grid">

            <?php foreach ($produk as $p): ?>

                <div class="prod-card">

                    <div class="prod-img">

                        <?php if (!empty($p['image'])): ?>

                            <img src="<?= base_url('uploads/produk/' . $p['image']) ?>"
                                 alt="<?= esc($p['name']) ?>">

                        <?php else: ?>

                            <i class="fa-solid <?= $p['category'] == 'Cat' ? 'fa-paint-roller' : 'fa-door-open' ?> no-img"></i>

                        <?php endif; ?>

                        <span class="prod-badge cat-<?= strtolower($p['category']) ?>">
                            <?= esc($p['category']) ?>
                        </span>

                    </div>

                    <div class="prod-body">

                        <div class="prod-name">
                            <?= esc($p['name']) ?>
                        </div>

                        <div class="prod-desc">
                            <?= esc($p['description']) ?>
                        </div>

                        <div class="prod-price">
                            Rp <?= number_format($p['price'], 0, ',', '.') ?>
                        </div>

                        <div class="prod-footer">

                            <a href="<?= base_url('produk-user/detail/' . $p['id']) ?>"
                               class="btn-detail">
                                Detail
                            </a>

                            <button type="button"
                                class="btn-keranjang"
                                data-id="<?= $p['id'] ?>"
                                data-nama="<?= htmlspecialchars($p['name'], ENT_QUOTES) ?>"
                                data-harga="<?= $p['price'] ?>"
                                data-img="<?= !empty($p['image']) ? base_url('uploads/produk/' . $p['image']) : '' ?>"
                                data-desc="<?= htmlspecialchars($p['description'], ENT_QUOTES) ?>"
                                data-kategori="<?= esc($p['category']) ?>"
                                data-stok="<?= $p['stock'] ?>"
                                onclick="bukaModalFromBtn(this)">
                                <i class="fa-solid fa-cart-plus"></i>
                                Tambah
                            </button>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    <?php else: ?>

        <div class="empty-state">

            <i class="fa-solid fa-box-open"></i>

            <p style="font-size:16px;font-weight:600;color:#374151;margin-bottom:8px;">
                Produk tidak ditemukan
            </p>

            <p>
                Coba kata kunci lain atau pilih kategori berbeda
            </p>

        </div>

    <?php endif; ?>

</div>


<!-- =====================================================
     MODAL POPUP DETAIL PRODUK
===================================================== -->
<div id="modalProduk" style="
    display:none;
    position:fixed;
    inset:0;
    z-index:9999;
    background:rgba(0,0,0,0.5);
    backdrop-filter:blur(4px);
    align-items:center;
    justify-content:center;
    padding:20px;
">
    <div style="
        background:white;
        border-radius:20px;
        max-width:680px;
        width:100%;
        max-height:90vh;
        overflow-y:auto;
        box-shadow:0 20px 60px rgba(0,0,0,0.25);
        position:relative;
        animation:modalIn .3s cubic-bezier(.23,1,.32,1);
    ">
        <!-- CLOSE -->
        <button onclick="tutupModal()" style="
            position:absolute;
            top:16px;right:16px;
            width:36px;height:36px;
            border-radius:50%;
            border:none;
            background:#f1f5f9;
            font-size:16px;
            cursor:pointer;
            display:flex;align-items:center;justify-content:center;
            z-index:2;
            transition:.2s;
        " onmouseover="this.style.background='#fee2e2';this.style.color='#ef4444'"
           onmouseout="this.style.background='#f1f5f9';this.style.color=''">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <!-- CONTENT GRID -->
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:0;">

            <!-- GAMBAR -->
            <div style="
                background:#fdf8e8;
                border-radius:20px 0 0 20px;
                display:flex;align-items:center;justify-content:center;
                min-height:280px;
                overflow:hidden;
            ">
                <img id="modalImg"
                     src=""
                     alt=""
                     style="width:100%;height:100%;object-fit:cover;display:none;">
                <i id="modalNoImg"
                   class="fa-solid fa-box"
                   style="font-size:64px;color:#d4a017;opacity:.4;display:none;"></i>
            </div>

            <!-- INFO -->
            <div style="padding:28px 28px 24px;">

                <span id="modalBadge" style="
                    display:inline-block;
                    background:#fdf8e8;color:#b8860b;
                    padding:4px 12px;border-radius:6px;
                    font-size:11px;font-weight:600;
                    margin-bottom:12px;
                "></span>

                <h2 id="modalNama" style="
                    font-size:20px;font-weight:800;
                    color:#111827;margin-bottom:8px;
                    line-height:1.3;
                "></h2>

                <div id="modalHarga" style="
                    font-size:26px;font-weight:800;
                    color:#b8860b;margin-bottom:12px;
                "></div>

                <p id="modalDesc" style="
                    color:#6b7280;font-size:13px;
                    line-height:1.7;margin-bottom:16px;
                "></p>

                <div id="modalStokWrap" style="margin-bottom:16px;"></div>

                <!-- QTY -->
                <div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;">
                    <span style="font-size:13px;font-weight:600;color:#374151;">Jumlah:</span>
                    <div style="
                        display:flex;align-items:center;
                        border:1px solid #e5e7eb;border-radius:10px;overflow:hidden;
                    ">
                        <button type="button" onclick="ubahQty(-1)" style="
                            width:36px;height:36px;border:none;
                            background:#f9fafb;font-size:16px;cursor:pointer;
                            color:#374151;transition:.2s;
                        ">−</button>
                        <input type="number" id="modalQty" value="1" min="1"
                               style="width:48px;height:36px;border:none;text-align:center;
                                      font-size:15px;font-weight:600;outline:none;">
                        <button type="button" onclick="ubahQty(1)" style="
                            width:36px;height:36px;border:none;
                            background:#f9fafb;font-size:16px;cursor:pointer;
                            color:#374151;transition:.2s;
                        ">+</button>
                    </div>
                </div>

                <!-- FORM SUBMIT -->
                <form id="modalForm" method="post" action="">
                    <?= csrf_field() ?>
                    <input type="hidden" id="modalQtyHidden" name="qty" value="1">
                    <button type="submit" id="modalBtnTambah" style="
                        width:100%;padding:13px;
                        border-radius:12px;background:#b8860b;
                        color:white;font-size:14px;font-weight:700;
                        border:none;cursor:pointer;
                        display:flex;align-items:center;justify-content:center;gap:8px;
                        transition:.3s;
                    ">
                        <i class="fa-solid fa-cart-plus"></i>
                        Tambah ke Keranjang
                    </button>
                </form>

                <a id="modalLinkDetail" href="#" style="
                    display:block;text-align:center;
                    margin-top:12px;font-size:13px;
                    color:#9ca3af;text-decoration:none;
                    transition:.2s;
                " onmouseover="this.style.color='#b8860b'"
                   onmouseout="this.style.color='#9ca3af'">
                    Lihat halaman detail →
                </a>

            </div>
        </div>
    </div>
</div>

<style>
@keyframes modalIn {
    from { opacity:0; transform:scale(.93) translateY(16px); }
    to   { opacity:1; transform:scale(1)  translateY(0); }
}
@media(max-width:640px){
    #modalProduk > div > div { grid-template-columns:1fr !important; }
    #modalProduk > div > div > div:first-child { border-radius:20px 20px 0 0 !important; min-height:200px !important; }
}
</style>

<script>
let modalStokMax = 999;

function bukaModalFromBtn(btn) {
    const id       = btn.dataset.id;
    const nama     = btn.dataset.nama;
    const hargaRaw = parseInt(btn.dataset.harga);
    const imgUrl   = btn.dataset.img;
    const desc     = btn.dataset.desc;
    const kategori = btn.dataset.kategori;
    const stok     = parseInt(btn.dataset.stok);
    const hargaFormat = hargaRaw.toLocaleString('id-ID');
    bukaModal(id, nama, hargaFormat, hargaRaw, imgUrl, desc, kategori, stok);
}

function bukaModal(id, nama, hargaFormat, hargaRaw, imgUrl, desc, kategori, stok) {
    modalStokMax = stok;

    // Gambar
    const img     = document.getElementById('modalImg');
    const noImg   = document.getElementById('modalNoImg');
    if (imgUrl) {
        img.src = imgUrl;
        img.style.display = 'block';
        noImg.style.display = 'none';
    } else {
        img.style.display = 'none';
        noImg.style.display = 'block';
    }

    // Info
    document.getElementById('modalBadge').textContent  = kategori;
    document.getElementById('modalNama').textContent   = nama;
    document.getElementById('modalHarga').textContent  = 'Rp ' + hargaFormat;
    document.getElementById('modalDesc').textContent   = desc;

    // Stok badge
    const stokWrap = document.getElementById('modalStokWrap');
    if (stok > 0) {
        stokWrap.innerHTML = `<span style="
            display:inline-flex;align-items:center;gap:6px;
            background:#d1fae5;color:#065f46;
            padding:6px 12px;border-radius:8px;font-size:12px;font-weight:600;">
            <i class="fa-solid fa-circle-check"></i> Stok tersedia (${stok})
        </span>`;
    } else {
        stokWrap.innerHTML = `<span style="
            display:inline-flex;align-items:center;gap:6px;
            background:#fee2e2;color:#991b1b;
            padding:6px 12px;border-radius:8px;font-size:12px;font-weight:600;">
            <i class="fa-solid fa-circle-xmark"></i> Stok Habis
        </span>`;
    }

    // Form action & qty
    document.getElementById('modalForm').action = '<?= base_url('keranjang/tambah/') ?>' + id;
    document.getElementById('modalLinkDetail').href = '<?= base_url('produk-user/detail/') ?>' + id;
    document.getElementById('modalQty').value = 1;
    document.getElementById('modalQty').max   = stok;
    document.getElementById('modalQtyHidden').value = 1;

    // Disable tombol jika stok 0
    const btn = document.getElementById('modalBtnTambah');
    if (stok <= 0) {
        btn.disabled = true;
        btn.style.background = '#9ca3af';
        btn.style.cursor = 'not-allowed';
        btn.innerHTML = '<i class="fa-solid fa-ban"></i> Stok Habis';
    } else {
        btn.disabled = false;
        btn.style.background = '#b8860b';
        btn.style.cursor = 'pointer';
        btn.innerHTML = '<i class="fa-solid fa-cart-plus"></i> Tambah ke Keranjang';
    }

    // Tampilkan modal
    const modal = document.getElementById('modalProduk');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function tutupModal() {
    document.getElementById('modalProduk').style.display = 'none';
    document.body.style.overflow = '';
}

function ubahQty(n) {
    const input = document.getElementById('modalQty');
    const hidden = document.getElementById('modalQtyHidden');
    let val = parseInt(input.value) + n;
    if (val < 1) val = 1;
    if (val > modalStokMax) val = modalStokMax;
    input.value  = val;
    hidden.value = val;
}

// Sync input manual
document.getElementById('modalQty').addEventListener('input', function() {
    let val = parseInt(this.value) || 1;
    if (val < 1) val = 1;
    if (val > modalStokMax) val = modalStokMax;
    this.value = val;
    document.getElementById('modalQtyHidden').value = val;
});

// Klik di luar modal -> tutup
document.getElementById('modalProduk').addEventListener('click', function(e) {
    if (e.target === this) tutupModal();
});

// ESC -> tutup
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') tutupModal();
});
</script>

<?= view('frontend/footer2') ?>