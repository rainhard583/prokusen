<!-- =========================================================
     SIDEBAR PSG — Fixed height, sticky, animated burger
========================================================= -->

<style>

/* ─────────────────────────────────────────────
   RESET LAYOUT UTAMA — Override SB Admin 2
───────────────────────────────────────────── */

/* Wrapper seluruh halaman */
#wrapper {
    display: flex !important;
    overflow: hidden !important;   /* cegah double scrollbar */
    height: 100vh !important;
}

/* Sidebar: full tinggi viewport, tidak ikut scroll konten */
#accordionSidebar {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    height: 100vh !important;
    width: 224px !important;
    overflow-y: auto !important;
    overflow-x: hidden !important;
    z-index: 1000 !important;
    flex-shrink: 0 !important;

    /* Sembunyikan scrollbar tapi tetap bisa scroll */
    scrollbar-width: none;
    -ms-overflow-style: none;
}
#accordionSidebar::-webkit-scrollbar { display: none; }

/* Saat sidebar di-toggled (toggled class dari SB Admin 2) */
#accordionSidebar.toggled {
    width: 6.5rem !important;
    overflow: visible !important;
}
#accordionSidebar.toggled .sidebar-brand img {
    height: 38px !important;
}
#accordionSidebar.toggled .psg-nav {
    justify-content: center !important;
    padding: 12px !important;
}
#accordionSidebar.toggled .psg-nav i {
    margin: 0 !important;
    font-size: 16px !important;
}

/* ─────────────────────────────────────────────
   FADE HALUS UNTUK SEMUA TEKS SAAT SIDEBAR
   DIPERKECIL — biar nggak "snap" tiba-tiba
   dan nggak ada teks yang ke-skip (kayak
   psg-section sebelumnya, bikin wrap berantakan)
───────────────────────────────────────────── */

.sidebar-brand-text,
.psg-nav span,
.psg-section,
.psg-divider {
    opacity: 1;
    max-width: 200px;
    max-height: 40px;
    overflow: hidden;
    white-space: nowrap;
    transition: opacity 0.2s ease,
                max-width 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                max-height 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                margin 0.3s ease,
                padding 0.3s ease;
}

#accordionSidebar.toggled .sidebar-brand-text,
#accordionSidebar.toggled .psg-nav span,
#accordionSidebar.toggled .psg-section,
#accordionSidebar.toggled .psg-divider {
    opacity: 0 !important;
    max-width: 0 !important;
    max-height: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
    pointer-events: none;
}

/* Content wrapper: geser ke kanan sesuai lebar sidebar */
#content-wrapper {
    margin-left: 224px !important;
    width: calc(100% - 224px) !important;
    min-height: 100vh !important;
    display: flex !important;
    flex-direction: column !important;
    overflow-y: auto !important;  /* scroll di sini, bukan di body */
    transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                width      0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
}
#content-wrapper.toggled-content {
    margin-left: 6.5rem !important;
    width: calc(100% - 6.5rem) !important;
}

/* Body tidak scroll — scroll hanya di #content-wrapper */
body {
    overflow: hidden !important;
}

/* Sidebar transition saat toggle */
#accordionSidebar {
    transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

/* ─────────────────────────────────────────────
   SIDEBAR STYLE
───────────────────────────────────────────── */

.psg-nav {
    color: #c9a84c !important;
    font-size: 13px;
    font-weight: 500;
    padding: 11px 20px !important;
    border-radius: 0 !important;
    transition: all 0.22s ease;
    border-left: 3px solid transparent !important;
    display: flex !important;
    align-items: center !important;
    gap: 10px;
    white-space: nowrap;
}
.psg-nav:hover {
    color: #f0c040 !important;
    background: rgba(184,134,11,0.13) !important;
    border-left: 3px solid #f0c040 !important;
    padding-left: 24px !important;
}
.nav-item.active .psg-nav {
    color: #f0c040 !important;
    background: rgba(184,134,11,0.2) !important;
    border-left: 3px solid #f0c040 !important;
    font-weight: 700;
}
.psg-nav i {
    color: #c9a84c !important;
    font-size: 14px;
    width: 18px;
    text-align: center;
    flex-shrink: 0;
}
.nav-item.active .psg-nav i,
.psg-nav:hover i {
    color: #f0c040 !important;
}

.psg-section {
    color: #c9a84c;
    font-size: 10px;
    font-weight: 700;
    padding: 12px 20px 4px;
    letter-spacing: 1.5px;
    text-transform: uppercase;
}

.psg-divider {
    margin: 10px 16px;
    border-top: 1px solid rgba(184,134,11,0.2);
}

/* ─────────────────────────────────────────────
   ANIMATED BURGER BUTTON
───────────────────────────────────────────── */

.burger-btn {
    width: 40px;
    height: 40px;
    border: none;
    background: rgba(184,134,11,0.18);
    border-radius: 10px;
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 5px;
    padding: 0;
    transition: background 0.2s ease, transform 0.2s ease;
    flex-shrink: 0;
}
.burger-btn:hover {
    background: rgba(184,134,11,0.35);
    transform: scale(1.07);
}
.burger-btn:focus { outline: none; }

.burger-line {
    display: block;
    width: 20px;
    height: 2px;
    background: #b8860b;
    border-radius: 2px;
    transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                opacity   0.25s ease,
                width     0.3s ease;
    transform-origin: center;
}

/* State: sidebar terbuka → animasi jadi X */
.burger-btn.is-open .burger-line:nth-child(1) {
    transform: translateY(7px) rotate(45deg);
}
.burger-btn.is-open .burger-line:nth-child(2) {
    opacity: 0;
    width: 0;
}
.burger-btn.is-open .burger-line:nth-child(3) {
    transform: translateY(-7px) rotate(-45deg);
}

/* ─────────────────────────────────────────────
   TOPBAR — pastikan tidak ikut scroll
───────────────────────────────────────────── */
.topbar {
    position: sticky !important;
    top: 0 !important;
    z-index: 900 !important;
    flex-shrink: 0 !important;
}

/* ─────────────────────────────────────────────
   FOOTER — tetap di bawah konten
───────────────────────────────────────────── */
.sticky-footer {
    flex-shrink: 0 !important;
    margin-top: auto !important;
}

/* ─────────────────────────────────────────────
   MOBILE — overlay sidebar
───────────────────────────────────────────── */
@media (max-width: 768px) {
    #accordionSidebar {
        transform: translateX(-100%) !important;
        transition: transform 0.3s cubic-bezier(0.4,0,0.2,1),
                    width     0.3s cubic-bezier(0.4,0,0.2,1) !important;
        width: 224px !important;
    }
    #accordionSidebar.mobile-open {
        transform: translateX(0) !important;
    }
    #content-wrapper {
        margin-left: 0 !important;
        width: 100% !important;
    }
    #content-wrapper.toggled-content {
        margin-left: 0 !important;
        width: 100% !important;
    }
    /* Overlay gelap di belakang sidebar mobile */
    .sidebar-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.45);
        z-index: 999;
        backdrop-filter: blur(2px);
        animation: fadeIn 0.25s ease;
    }
    .sidebar-overlay.show { display: block; }
    @keyframes fadeIn { from { opacity:0 } to { opacity:1 } }
}

</style>

<!-- Overlay untuk mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- ─── SIDEBAR ─── -->
<ul class="navbar-nav sidebar sidebar-dark accordion"
    id="accordionSidebar"
    style="background: linear-gradient(180deg, #1a1008 0%, #2d1a0a 40%, #1a1008 100%);">

    <!-- BRAND / LOGO -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center py-3"
       href="<?= base_url('dashboard') ?>"
       style="border-bottom:1px solid rgba(184,134,11,0.3); text-decoration:none; min-height:72px;">

        <img src="<?= base_url('logo_png.png') ?>"
             alt="PSG Logo"
             style="height:44px; width:auto; object-fit:contain;
                    filter:drop-shadow(0 2px 8px rgba(184,134,11,0.5)); flex-shrink:0;">

        <div class="sidebar-brand-text mx-2" style="line-height:1.2;">
            <div style="font-size:14px; font-weight:800; color:#f0c040; letter-spacing:1px;">PSG</div>
            <div style="font-size:9px; font-weight:500; color:#c9a84c; letter-spacing:0.5px; text-transform:uppercase;">
                Putra Sumedang Grub
            </div>
        </div>

    </a>

    <div style="height:6px;"></div>

    <!-- Dashboard -->
    <li class="nav-item <?= (current_url() == base_url('dashboard')) ? 'active' : '' ?>">
        <a class="nav-link psg-nav" href="<?= base_url('dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- SECTION: MASTER DATA -->
    <div class="psg-section">Master Data</div>

    <li class="nav-item <?= (strpos(current_url(), 'produk') !== false) ? 'active' : '' ?>">
        <a class="nav-link psg-nav" href="<?= base_url('produk') ?>">
            <i class="fas fa-fw fa-box-open"></i>
            <span>Data Produk</span>
        </a>
    </li>

    <li class="nav-item <?= (strpos(current_url(), 'pesanan') !== false) ? 'active' : '' ?>">
        <a class="nav-link psg-nav" href="<?= base_url('pesanan') ?>">
            <i class="fas fa-fw fa-clipboard-list"></i>
            <span>Data Pesanan</span>
        </a>
    </li>

    <!-- SECTION: LAPORAN -->
    <div class="psg-section">Laporan</div>

    <li class="nav-item <?= (strpos(current_url(), 'laporan') !== false) ? 'active' : '' ?>">
        <a class="nav-link psg-nav" href="<?= base_url('laporan/pesanan') ?>">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Laporan Penjualan</span>
        </a>
    </li>

    <!-- SECTION: AKUN -->
    <div class="psg-section">Akun</div>

    <li class="nav-item <?= (strpos(current_url(), 'profil') !== false) ? 'active' : '' ?>">
        <a class="nav-link psg-nav" href="<?= base_url('profil') ?>">
            <i class="fas fa-fw fa-user-circle"></i>
            <span>Profil Admin</span>
        </a>
    </li>

    <li class="nav-item <?= (strpos(current_url(), 'pengaturan') !== false) ? 'active' : '' ?>">
        <a class="nav-link psg-nav" href="<?= base_url('pengaturan') ?>">
            <i class="fas fa-fw fa-cog"></i>
            <span>Pengaturan</span>
        </a>
    </li>

    <div class="psg-divider"></div>

    <!-- Logout -->
    <li class="nav-item mb-3">
        <a class="nav-link psg-nav" href="<?= base_url('logout-admin') ?>"
           style="color:#e57373 !important;">
            <i class="fas fa-fw fa-sign-out-alt" style="color:#e57373 !important;"></i>
            <span>Logout</span>
        </a>
    </li>

</ul>

<!-- ─── SCRIPT BURGER + TOGGLE ─── -->
<script>
(function () {

    // Tunggu DOM siap
    document.addEventListener('DOMContentLoaded', init);
    // Fallback kalau DOM sudah siap sebelum script jalan
    if (document.readyState !== 'loading') init();

    function init() {

        const sidebar    = document.getElementById('accordionSidebar');
        const contentW   = document.getElementById('content-wrapper');
        const burgerBtn  = document.getElementById('burgerBtn');        // dari header.php
        const burgerBtnM = document.getElementById('burgerBtnMobile');  // tombol mobile di topbar
        const overlay    = document.getElementById('sidebarOverlay');

        const MOBILE_BP  = 768;

        if (!sidebar || !contentW) return;

        // ─── Cek apakah mobile ───
        function isMobile() { return window.innerWidth <= MOBILE_BP; }

        // ─── Toggle Desktop (collapse jadi icon-only) ───
        function toggleDesktop() {
            const collapsed = sidebar.classList.toggle('toggled');
            contentW.classList.toggle('toggled-content', collapsed);

            // Animasi burger
            if (burgerBtn) burgerBtn.classList.toggle('is-open', !collapsed);

            // Simpan state ke localStorage
            localStorage.setItem('psg_sidebar', collapsed ? 'collapsed' : 'open');
        }

        // ─── Toggle Mobile (overlay) ───
        function toggleMobile() {
            const open = sidebar.classList.toggle('mobile-open');
            if (overlay) overlay.classList.toggle('show', open);
            if (burgerBtnM) burgerBtnM.classList.toggle('is-open', open);
        }

        // ─── Event listener tombol burger desktop (ada di header.php) ───
        if (burgerBtn) {
            burgerBtn.addEventListener('click', function () {
                if (isMobile()) toggleMobile();
                else toggleDesktop();
            });
        }

        // ─── Event listener tombol burger mobile (ada di topbar) ───
        if (burgerBtnM) {
            burgerBtnM.addEventListener('click', function () {
                toggleMobile();
            });
        }

        // ─── Tutup sidebar mobile saat klik overlay ───
        if (overlay) {
            overlay.addEventListener('click', function () {
                sidebar.classList.remove('mobile-open');
                overlay.classList.remove('show');
                if (burgerBtnM) burgerBtnM.classList.remove('is-open');
            });
        }

        // ─── Restore state desktop dari localStorage ───
        if (!isMobile()) {
            const saved = localStorage.getItem('psg_sidebar');
            if (saved === 'collapsed') {
                sidebar.classList.add('toggled');
                contentW.classList.add('toggled-content');
                if (burgerBtn) burgerBtn.classList.remove('is-open');
            } else {
                if (burgerBtn) burgerBtn.classList.add('is-open');
            }
        }

        // ─── Handle resize ───
        let resizeTimer;
        window.addEventListener('resize', function () {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function () {
                if (!isMobile()) {
                    // Tutup overlay kalau layar diperlebar
                    sidebar.classList.remove('mobile-open');
                    if (overlay) overlay.classList.remove('show');
                }
            }, 150);
        });
    }

})();
</script>
<!-- End of Sidebar -->