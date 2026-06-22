<?php $title = esc($produk['name']) . ' - PSG'; ?>
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
        margin-bottom:28px;
        transition:.2s;
        text-decoration:none;
    }

    .back-link:hover{
        color:#b8860b;
    }

    .detail-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:60px;
    align-items:start;
    margin-top:40px;
}

    .detail-img{
        background:#fdf8e8;
        border-radius:20px;
        overflow:hidden;
        aspect-ratio:1;
        display:flex;
        align-items:center;
        justify-content:center;
        border:1px solid #f1f5f9;
    }

    .detail-img img{
        width:100%;
        height:100%;
        object-fit:cover;
    }

    .detail-img .no-img{
        font-size:80px;
        color:#d4a017;
        opacity:.4;
    }

    .detail-badge{
        display:inline-block;
        background:#fdf8e8;
        color:#b8860b;
        padding:5px 14px;
        border-radius:6px;
        font-size:12px;
        font-weight:600;
        margin-bottom:14px;
    }

    .detail-name{
        font-size:28px;
        font-weight:800;
        color:#111827;
        margin-bottom:12px;
        line-height:1.3;
    }

    .detail-price{
        font-size:32px;
        font-weight:800;
        color:#b8860b;
        margin-bottom:20px;
    }

    .detail-divider{
        border:none;
        border-top:1px solid #f1f5f9;
        margin:20px 0;
    }

    .detail-desc{
    color:#6b7280;
    font-size:15px;
    line-height:1.6;
    margin-bottom:8px;
}

    .stok-badge{
    display:inline-flex;
    align-items:center;
    gap:6px;
    padding:7px 14px;
    border-radius:8px;
    font-size:13px;
    font-weight:600;
    margin-bottom:24px;

    position:relative;
    top:-12px;
}

    .stok-ada{
        background:#d1fae5;
        color:#065f46;
    }

    .stok-habis{
        background:#fee2e2;
        color:#991b1b;
    }

    .qty-wrap{
        display:flex;
        align-items:center;
        gap:16px;
        margin-bottom:24px;
    }

    .qty-label{
        font-size:14px;
        font-weight:600;
        color:#374151;
    }

    .qty-control{
        display:flex;
        align-items:center;
        border:1px solid #e5e7eb;
        border-radius:10px;
        overflow:hidden;
    }

    .qty-btn{
        width:38px;
        height:38px;
        border:none;
        background:#f9fafb;
        font-size:16px;
        cursor:pointer;
        color:#374151;
    }

    .qty-btn:hover{
        background:#fdf8e8;
        color:#b8860b;
    }

    .qty-input{
        width:50px;
        height:38px;
        border:none;
        text-align:center;
        font-size:15px;
        font-weight:600;
        outline:none;
    }

    .btn-tambah{
        width:100%;
        padding:15px;
        border-radius:12px;
        background:#b8860b;
        color:white;
        font-size:15px;
        font-weight:700;
        border:none;
        cursor:pointer;
        display:flex;
        align-items:center;
        justify-content:center;
        gap:8px;
        transition:.3s;
        text-decoration:none;
    }

    .btn-tambah:hover{
        background:#9a7200;
    }

    @media(max-width:1024px){

        .page-wrapper{
            padding:30px 24px 60px;
        }

        .detail-grid{
            grid-template-columns:1fr;
            gap:30px;
        }
    }
</style>

<div class="page-wrapper">

    <a href="<?= base_url('produk-user') ?>" class="back-link">
        <i class="fa-solid fa-arrow-left"></i>
        Kembali ke Produk
    </a>

    <div class="detail-grid">

        <!-- GAMBAR -->
        <div>

            <div class="detail-img">

                <?php if (!empty($produk['image'])): ?>

                    <img src="<?= base_url('uploads/produk/' . $produk['image']) ?>"
                         id="product-image">

                <?php else: ?>

                    <i class="fa-solid fa-box no-img"></i>

                <?php endif; ?>

            </div>

        </div>

        <!-- DETAIL -->
        <div>

            <span class="detail-badge">
                <?= esc($produk['category']) ?>
            </span>

            <h1 class="detail-name">
                <?= esc($produk['name']) ?>
            </h1>

            <div class="detail-price">
                Rp <?= number_format($produk['price'],0,',','.') ?>
            </div>

            <hr class="detail-divider">

            <p class="detail-desc">
                <?= esc($produk['description']) ?>
            </p>

            <?php if ($produk['stock'] > 0): ?>

                <span class="stok-badge stok-ada">

                    <i class="fa-solid fa-circle-check"></i>

                    Stok tersedia (<?= $produk['stock'] ?>)

                </span>

            <?php else: ?>

                <span class="stok-badge stok-habis">

                    <i class="fa-solid fa-circle-xmark"></i>

                    Stok Habis

                </span>

            <?php endif; ?>

            <?php if ($produk['stock'] > 0): ?>

            <form method="post"
                  action="<?= base_url('keranjang/tambah/' . $produk['id']) ?>">

                <?= csrf_field() ?>

                <input type="hidden"
                       name="id_produk"
                       value="<?= $produk['id'] ?>">

                <!-- JUMLAH -->
                <div class="qty-wrap">

                    <span class="qty-label">Jumlah:</span>

                    <div class="qty-control">

                        <button type="button"
                                class="qty-btn"
                                onclick="changeQty(-1)">
                            −
                        </button>

                        <input type="number"
                               name="qty"
                               id="qty"
                               class="qty-input"
                               value="1"
                               min="1"
                               max="<?= $produk['stock'] ?>">

                        <button type="button"
                                class="qty-btn"
                                onclick="changeQty(1)">
                            +
                        </button>

                    </div>

                </div>

                <!-- BUTTON -->
                <div style="display:flex; gap:14px; margin-top:20px;">

                    <button type="submit"
                            class="btn-tambah add-to-cart-btn"
                            style="flex:1;">

                        <i class="fa-solid fa-cart-plus"></i>

                        Tambah ke Keranjang

                    </button>

                    <a href="<?= base_url('pesanan-user') ?>"
                       class="btn-tambah"
                       style="
                            flex:1;
                            background:#fff;
                            color:#111827;
                            border:1px solid #d1d5db;
                       ">

                        Lihat Pesanan

                    </a>

                </div>

            </form>

            <?php else: ?>

                <button type="button"
                        class="btn-tambah"
                        style="background:#9ca3af;cursor:not-allowed;"
                        disabled>

                    <i class="fa-solid fa-ban"></i>

                    Stok Habis

                </button>

            <?php endif; ?>

        </div>

    </div>

</div>

<script>

function changeQty(n)
{
    const input = document.getElementById('qty');

    const max = parseInt(input.max) || 999;

    let val = parseInt(input.value) + n;

    if(val < 1) val = 1;

    if(val > max) val = max;

    input.value = val;
}


// ==========================================
// ANIMASI TAMBAH KE KERANJANG
// ==========================================

document.querySelector('.add-to-cart-btn')
.addEventListener('click', function(e){

    e.preventDefault();

    const cart = document.getElementById('cart-icon');

    const product = document.getElementById('product-image');

    const productClone = product.cloneNode(true);

    const rectProduct = product.getBoundingClientRect();

    const rectCart = cart.getBoundingClientRect();

    productClone.style.position = 'fixed';

    productClone.style.left = rectProduct.left + 'px';

    productClone.style.top = rectProduct.top + 'px';

    productClone.style.width = '120px';

    productClone.style.height = '120px';

    productClone.style.objectFit = 'cover';

    productClone.style.borderRadius = '12px';

    productClone.style.zIndex = '9999';

    productClone.style.pointerEvents = 'none';

    productClone.style.willChange =
'transform';

productClone.style.backfaceVisibility =
'hidden';

productClone.style.boxShadow =
'0 20px 40px rgba(0,0,0,.18)';

productClone.style.border =
'2px solid rgba(255,255,255,.7)';

productClone.style.backdropFilter =
'blur(4px)';

    productClone.style.transition =
`
transform 1s cubic-bezier(
    0.22,
    1,
    0.36,
    1
),
opacity .9s ease,
width .9s ease,
height .9s ease,
left 1s cubic-bezier(
    0.22,
    1,
    0.36,
    1
),
top 1s cubic-bezier(
    0.22,
    1,
    0.36,
    1
)
`;

    document.body.appendChild(productClone);

    setTimeout(() => {
        productClone.style.filter =
'blur(.4px)';
        productClone.style.left = rectCart.left + 'px';

        productClone.style.top = rectCart.top + 'px';

        productClone.style.width = '20px';

        productClone.style.height = '20px';

        productClone.style.opacity = '0.2';

productClone.style.transform =
`
scale(.15)
rotate(12deg)
`;
    }, 50);

    setTimeout(() => {

        cart.style.transform = 'scale(1.25)';

        cart.style.transition = '.2s';

    }, 700);

    setTimeout(() => {

        cart.style.transform = 'scale(1)';

    }, 900);

    setTimeout(() => {

        productClone.remove();

        e.target.closest('form').submit();

    }, 950);

});

</script>

<?= view('frontend/footer2') ?>