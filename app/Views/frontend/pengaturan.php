<?php $title = 'Pengaturan Akun - PSG'; ?>

<?= $this->include('frontend/header2') ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --gold:        #c9920a;
    --gold-light:  #f0c040;
    --gold-soft:   #fdf6e3;
    --gold-glow:   rgba(201,146,10,.18);
    --surface:     #ffffff;
    --surface-2:   #fafaf9;
    --border:      #eeece8;
    --text-1:      #1a1710;
    --text-2:      #6b6760;
    --text-3:      #b0ada6;
    --green:       #16a34a;
    --green-soft:  #dcfce7;
    --red:         #dc2626;
    --red-soft:    #fff1f2;
    --radius-card: 22px;
    --radius-btn:  12px;
    --shadow-card: 0 2px 24px rgba(0,0,0,.07), 0 1px 4px rgba(0,0,0,.04);
    --shadow-gold: 0 8px 28px rgba(201,146,10,.28);
    --transition:  .22s cubic-bezier(.4,0,.2,1);
}

body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f5f3ef; color: var(--text-1); }

/* ─── PAGE WRAPPER ─────────────────────────────────── */
.pg {
    max-width: 860px;
    margin: 163px auto 80px;
    padding: 0 20px;
}

/* ─── PAGE HEADER ─────────────────────────────────── */
.pg-head {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 28px;
    animation: fadeUp .4s ease both;
}
.pg-head-icon {
    width: 50px; height: 50px;
    border-radius: 16px;
    background: linear-gradient(135deg, #c9920a, #f0c040);
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 20px;
    box-shadow: var(--shadow-gold);
    flex-shrink: 0;
}
.pg-head h1 { font-size: 22px; font-weight: 800; color: var(--text-1); line-height: 1.2; }
.pg-head p  { font-size: 13px; color: var(--text-3); margin-top: 2px; }

/* ─── FLASH MESSAGES ──────────────────────────────── */
.flash {
    display: flex; align-items: flex-start; gap: 10px;
    padding: 14px 18px; border-radius: 14px;
    font-size: 13.5px; font-weight: 500;
    margin-bottom: 18px; animation: fadeUp .35s ease both;
}
.flash.ok    { background: var(--green-soft); color: #14532d; border: 1px solid #86efac; }
.flash.error { background: var(--red-soft);   color: #7f1d1d; border: 1px solid #fca5a5; }
.flash.warn  { background: #fff7ed; color: #7c2d12; border: 1px solid #fed7aa; }
.flash i { font-size: 17px; flex-shrink: 0; margin-top: 1px; }

/* ─── CARD ─────────────────────────────────────────── */
.card {
    background: var(--surface);
    border-radius: var(--radius-card);
    border: 1px solid var(--border);
    box-shadow: var(--shadow-card);
    margin-bottom: 18px;
    overflow: hidden;
    animation: fadeUp .4s ease both;
}
.card:nth-child(2) { animation-delay: .05s; }
.card:nth-child(3) { animation-delay: .10s; }

.card-header {
    padding: 18px 26px;
    border-bottom: 1px solid var(--border);
    display: flex; align-items: center; justify-content: space-between;
    background: var(--surface-2);
}
.card-header-left {
    display: flex; align-items: center; gap: 9px;
}
.card-header-left i { color: var(--gold); font-size: 15px; }
.card-header-left h2 { font-size: 15px; font-weight: 700; color: var(--text-1); }
.card-body { padding: 24px 26px; }

/* ─── PROFILE SECTION ─────────────────────────────── */
.profile-row {
    display: flex; align-items: center; gap: 20px;
    padding-bottom: 22px; margin-bottom: 22px;
    border-bottom: 1px solid var(--border);
}

.avatar {
    width: 72px; height: 72px;
    border-radius: 50%;
    background: linear-gradient(135deg, #fde68a, #f59e0b);
    display: flex; align-items: center; justify-content: center;
    font-size: 28px; font-weight: 900; color: #78350f;
    flex-shrink: 0; overflow: hidden; position: relative; cursor: pointer;
    box-shadow: 0 0 0 3px var(--gold-soft), 0 0 0 4px var(--gold);
    transition: box-shadow var(--transition), transform var(--transition);
}
.avatar:hover { transform: scale(1.04); box-shadow: 0 0 0 3px var(--gold-soft), 0 0 0 5px var(--gold), 0 8px 24px var(--gold-glow); }
.avatar img { width: 100%; height: 100%; object-fit: cover; }

.avatar-overlay {
    position: absolute; inset: 0; border-radius: 50%;
    background: rgba(0,0,0,0); display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    color: transparent; font-size: 10px; font-weight: 700;
    transition: var(--transition); gap: 2px; z-index: 2;
}
.avatar:hover .avatar-overlay { background: rgba(0,0,0,.42); color: #fff; }
.avatar-overlay i { font-size: 14px; }

.avatar-upload-btn {
    position: absolute; bottom: 0; right: 0;
    width: 22px; height: 22px; border-radius: 50%;
    background: var(--gold); color: #fff;
    display: flex; align-items: center; justify-content: center;
    font-size: 10px; border: 2px solid #fff; cursor: pointer; z-index: 3;
    transition: background var(--transition);
}
.avatar-upload-btn:hover { background: #a97a08; }

.profile-info { flex: 1; }
.profile-name  { font-size: 19px; font-weight: 800; color: var(--text-1); }
.profile-email { font-size: 13px; color: var(--text-2); margin-top: 3px; }
.profile-badge {
    display: inline-flex; align-items: center; gap: 5px;
    background: var(--gold-soft); color: var(--gold);
    font-size: 11px; font-weight: 700;
    padding: 3px 10px; border-radius: 99px;
    border: 1px solid #e9c96a; margin-top: 8px;
}

/* ─── INFO GRID ────────────────────────────────────── */
.info-grid {
    display: grid; grid-template-columns: 1fr 1fr; gap: 12px;
}
.info-item {
    background: var(--surface-2); border-radius: 14px;
    padding: 14px 16px; border: 1px solid var(--border);
    transition: border-color var(--transition), box-shadow var(--transition);
}
.info-item:hover { border-color: #d9c07a; box-shadow: 0 2px 12px var(--gold-glow); }
.info-label {
    font-size: 10.5px; font-weight: 700; color: var(--text-3);
    text-transform: uppercase; letter-spacing: .6px; margin-bottom: 5px;
}
.info-value { font-size: 14.5px; font-weight: 700; color: var(--text-1); }
.info-value.empty { color: var(--text-3); font-style: italic; font-weight: 400; }

/* ─── BOTTOM ACTIONS ────────────────────────────────── */
.bottom-actions {
    display: flex; align-items: center; justify-content: space-between;
    padding: 16px 26px; background: var(--surface-2);
    border-top: 1px solid var(--border); gap: 10px; flex-wrap: wrap;
}
.btn-group { display: flex; gap: 8px; flex-wrap: wrap; }

/* ─── BUTTONS ────────────────────────────────────────── */
.btn {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 10px 18px; border-radius: var(--radius-btn);
    font-size: 13px; font-weight: 600;
    border: none; cursor: pointer; text-decoration: none;
    transition: all var(--transition); white-space: nowrap;
    font-family: inherit;
}
.btn-outline {
    background: var(--surface); color: var(--text-2);
    border: 1.5px solid var(--border);
}
.btn-outline:hover { border-color: var(--gold); color: var(--gold); background: var(--gold-soft); }

.btn-gold {
    background: linear-gradient(135deg, #c9920a, #f0c040);
    color: #fff; box-shadow: 0 4px 14px var(--gold-glow);
}
.btn-gold:hover { filter: brightness(1.08); box-shadow: 0 6px 22px var(--gold-glow); transform: translateY(-1px); }

.btn-danger {
    background: var(--surface); color: var(--red);
    border: 1.5px solid #fecaca;
}
.btn-danger:hover { background: var(--red); color: #fff; border-color: var(--red); }

.btn-red-solid {
    background: linear-gradient(135deg, #dc2626, #ef4444);
    color: #fff; box-shadow: 0 4px 14px rgba(220,38,38,.2);
}
.btn-red-solid:hover { filter: brightness(1.08); transform: translateY(-1px); }

/* ─── FORM ────────────────────────────────────────────── */
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
.form-group { margin-bottom: 14px; }
.form-label { display: block; font-size: 12.5px; font-weight: 700; color: var(--text-2); margin-bottom: 6px; }
.form-control {
    width: 100%; padding: 11px 14px;
    border: 1.5px solid var(--border); border-radius: 11px;
    font-size: 14px; background: var(--surface-2);
    outline: none; transition: border-color var(--transition), box-shadow var(--transition);
    font-family: inherit; color: var(--text-1);
}
.form-control:focus { border-color: var(--gold); background: #fff; box-shadow: 0 0 0 3px var(--gold-glow); }
textarea.form-control { resize: vertical; min-height: 88px; }

.password-group { position: relative; }
.password-input  { padding-right: 48px; }
.toggle-pw {
    position: absolute; top: 50%; right: 13px;
    transform: translateY(-50%);
    border: none; background: none; cursor: pointer;
    color: var(--text-3); font-size: 15px; transition: color var(--transition);
}
.toggle-pw:hover { color: var(--gold); }

/* ─── PESANAN LIST ────────────────────────────────────── */
.pesanan-list { display: flex; flex-direction: column; gap: 11px; }

.card-pesanan {
    display: flex; align-items: center; justify-content: space-between;
    padding: 16px 18px; border-radius: 15px;
    border: 1.5px solid var(--border); background: var(--surface);
    transition: border-color var(--transition), box-shadow var(--transition), transform var(--transition);
    gap: 14px;
}
.card-pesanan:hover { border-color: #d9c07a; box-shadow: 0 4px 16px var(--gold-glow); transform: translateY(-1px); }

.pesanan-icon {
    width: 42px; height: 42px; border-radius: 13px;
    background: linear-gradient(135deg, #d1fae5, #6ee7b7);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.pesanan-icon i { color: #065f46; font-size: 16px; }

.pesanan-meta { flex: 1; }
.pesanan-num  { font-size: 13.5px; font-weight: 700; color: var(--text-1); margin-bottom: 3px; }
.pesanan-date { font-size: 12px; color: var(--text-3); }

.pesanan-right { text-align: right; flex-shrink: 0; }
.pesanan-total { font-size: 15px; font-weight: 800; color: var(--text-1); margin-bottom: 6px; }

.badge-success {
    display: inline-flex; align-items: center; gap: 5px;
    background: var(--green-soft); color: var(--green);
    font-size: 11.5px; font-weight: 700;
    padding: 4px 11px; border-radius: 99px;
    border: 1px solid #86efac;
}

/* ─── EMPTY STATE ──────────────────────────────────────── */
.empty-state { text-align: center; padding: 44px 20px; }
.empty-icon {
    width: 68px; height: 68px; border-radius: 50%;
    background: var(--gold-soft); display: flex;
    align-items: center; justify-content: center;
    font-size: 26px; color: var(--gold); margin: 0 auto 14px;
}
.empty-state h3 { font-size: 15px; font-weight: 700; color: var(--text-1); margin-bottom: 6px; }
.empty-state p  { font-size: 13px; color: var(--text-3); margin-bottom: 18px; }

/* ─── ANIMATIONS ────────────────────────────────────────── */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ═══════════════════════════════════════════════════════════
   FOTO POPUP OVERLAY
   ═══════════════════════════════════════════════════════════ */
#fotoOverlay {
    position: fixed; inset: 0; z-index: 9999;
    display: flex; align-items: center; justify-content: center;
    background: rgba(0,0,0,0); opacity: 0; visibility: hidden;
    backdrop-filter: blur(0px);
    transition: opacity .32s ease, background .32s ease,
                backdrop-filter .32s ease, visibility 0s .32s;
}
#fotoOverlay.show {
    background: rgba(8,8,14,.82); opacity: 1; visibility: visible;
    backdrop-filter: blur(8px);
    transition: opacity .32s ease, background .32s ease,
                backdrop-filter .32s ease, visibility 0s 0s;
}
.foto-modal {
    position: relative; background: #18181f;
    border-radius: 24px; overflow: hidden;
    width: min(92vw, 400px);
    transform: scale(.78) translateY(32px); opacity: 0;
    transition: transform .38s cubic-bezier(.34,1.56,.64,1), opacity .3s ease, box-shadow .5s ease;
    border: 1px solid rgba(255,255,255,.08);
    box-shadow: 0 32px 80px rgba(0,0,0,.6);
}
#fotoOverlay.show .foto-modal { transform: scale(1) translateY(0); opacity: 1; }
.foto-modal.glow-active {
    box-shadow:
        0 0 0 2px rgba(var(--glow-r),var(--glow-g),var(--glow-b),.55),
        0 0 28px 8px rgba(var(--glow-r),var(--glow-g),var(--glow-b),.32),
        0 0 70px 20px rgba(var(--glow-r),var(--glow-g),var(--glow-b),.15),
        0 32px 80px rgba(0,0,0,.55);
    border-color: rgba(var(--glow-r),var(--glow-g),var(--glow-b),.4);
}
.foto-modal.glow-active::after {
    content: ''; position: absolute; inset: -1px; border-radius: 24px;
    border: 1.5px solid rgba(var(--glow-r),var(--glow-g),var(--glow-b),.4);
    animation: glowPulse 2.8s ease-in-out infinite;
    pointer-events: none; z-index: 20;
}
@keyframes glowPulse { 0%,100%{opacity:1} 50%{opacity:.55} }

.foto-preview {
    width: 100%; aspect-ratio: 1/1;
    position: relative; background: #0e0e14;
    overflow: hidden; display: flex; align-items: center; justify-content: center;
}
.foto-preview img {
    width: 100%; height: 100%; object-fit: cover; object-position: center top;
    display: block; transform: scale(1.04);
    transition: transform .45s ease;
}
#fotoOverlay.show .foto-preview img { transform: scale(1); }
.foto-initials-big { font-size: 100px; font-weight: 900; color: #92400e; opacity: .65; }

.foto-shimmer {
    position: absolute; inset: 0; z-index: 2;
    background: linear-gradient(110deg, rgba(255,255,255,0) 20%, rgba(255,255,255,.06) 50%, rgba(255,255,255,0) 80%);
    background-size: 220% 100%;
    animation: shimmer 1.4s infinite;
}
@keyframes shimmer { 0%{background-position:220% 0} 100%{background-position:-220% 0} }

.foto-close-x {
    position: absolute; top: 12px; right: 12px;
    width: 32px; height: 32px; border-radius: 50%;
    background: rgba(0,0,0,.5); border: 1.5px solid rgba(255,255,255,.14);
    color: #e5e7eb; font-size: 13px;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; z-index: 10; transition: var(--transition);
}
.foto-close-x:hover { background: rgba(0,0,0,.75); }

.foto-info {
    padding: 16px 20px;
    display: flex; align-items: center; justify-content: space-between; gap: 10px;
}
.foto-name  { font-size: 14px; font-weight: 700; color: #f3f4f6; }
.foto-email { font-size: 11px; color: #6b7280; margin-top: 2px; }
.foto-actions { display: flex; gap: 7px; }

.foto-btn {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 9px 14px; border-radius: 10px;
    font-size: 12px; font-weight: 600; border: none;
    cursor: pointer; text-decoration: none; transition: var(--transition);
    font-family: inherit; white-space: nowrap;
}
.foto-btn-gold  { background: linear-gradient(135deg,#c9920a,#f0c040); color: #fff; }
.foto-btn-gold:hover { filter: brightness(1.12); }
.foto-btn-close { background: rgba(255,255,255,.07); color: #9ca3af; border: 1px solid rgba(255,255,255,.1); }
.foto-btn-close:hover { background: rgba(255,255,255,.14); color: #e5e7eb; }

/* ═══════════════════════════════════════════════════════════
   DELETE ACCOUNT MODAL
   ═══════════════════════════════════════════════════════════ */
.del-overlay {
    position: fixed; inset: 0; z-index: 10000;
    display: flex; align-items: center; justify-content: center;
    padding: 20px;
    background: rgba(0,0,0,0); backdrop-filter: blur(0px);
    opacity: 0; pointer-events: none;
    transition: opacity .3s ease, background .3s ease, backdrop-filter .3s ease;
}
.del-overlay.active {
    opacity: 1; pointer-events: all;
    background: rgba(0,0,0,.65); backdrop-filter: blur(6px);
}
.del-modal {
    background: #fff; border-radius: 24px;
    width: 100%; max-width: 400px;
    box-shadow: 0 32px 80px rgba(0,0,0,.25);
    transform: scale(.82) translateY(28px); opacity: 0;
    transition: transform .38s cubic-bezier(.34,1.56,.64,1), opacity .3s ease;
    overflow: hidden;
}
.del-overlay.active .del-modal { transform: scale(1) translateY(0); opacity: 1; }

.del-header {
    background: linear-gradient(135deg, #dc2626, #ef4444);
    padding: 28px 28px 22px; text-align: center;
}
.del-icon-ring {
    width: 70px; height: 70px; border-radius: 50%;
    background: rgba(255,255,255,.18);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 14px; font-size: 28px; color: #fff;
    border: 3px solid rgba(255,255,255,.35);
    animation: delPulse 2s ease-in-out infinite;
}
@keyframes delPulse { 0%,100%{box-shadow:0 0 0 0 rgba(255,255,255,.3)} 50%{box-shadow:0 0 0 10px rgba(255,255,255,0)} }
.del-header h3 { color: #fff; font-size: 17px; font-weight: 800; margin-bottom: 5px; }
.del-header p  { color: rgba(255,255,255,.8); font-size: 12.5px; line-height: 1.5; }

.del-body { padding: 20px 22px 6px; }
.del-warnings { list-style: none; margin-bottom: 16px; }
.del-warnings li {
    display: flex; align-items: flex-start; gap: 9px;
    font-size: 13px; color: #374151;
    padding: 9px 12px; border-radius: 10px;
    margin-bottom: 6px; background: #fff1f2; border: 1px solid #fecaca;
}
.del-warnings li i { color: #ef4444; flex-shrink: 0; margin-top: 2px; font-size: 13px; }

.del-label { font-size: 12.5px; font-weight: 700; color: #374151; margin-bottom: 6px; display: block; }
.del-label span { font-family: monospace; background: #f3f4f6; padding: 1px 7px; border-radius: 5px; color: #dc2626; font-weight: 700; }
.del-input {
    width: 100%; padding: 11px 14px; border: 1.5px solid #e5e7eb;
    border-radius: 10px; font-size: 14px; outline: none;
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: border-color var(--transition), box-shadow var(--transition); box-sizing: border-box;
}
.del-input:focus { border-color: #ef4444; box-shadow: 0 0 0 3px rgba(239,68,68,.12); }
.del-input.valid { border-color: #10b981; box-shadow: 0 0 0 3px rgba(16,185,129,.1); }

.del-footer { display: flex; gap: 10px; padding: 10px 22px 22px; }
.del-btn-cancel {
    flex: 1; padding: 13px; border-radius: 11px;
    border: 1.5px solid #e5e7eb; background: #fff;
    color: #374151; font-size: 13.5px; font-weight: 600;
    cursor: pointer; font-family: inherit; transition: var(--transition);
}
.del-btn-cancel:hover { background: #f9fafb; border-color: #d1d5db; }
.del-btn-hapus {
    flex: 1; padding: 13px; border-radius: 11px; border: none;
    background: linear-gradient(135deg, #dc2626, #ef4444);
    color: #fff; font-size: 13.5px; font-weight: 700;
    cursor: pointer; font-family: inherit; transition: var(--transition);
    opacity: .42; pointer-events: none;
}
.del-btn-hapus.ready { opacity: 1; pointer-events: all; }
.del-btn-hapus.ready:hover { filter: brightness(1.1); transform: translateY(-1px); box-shadow: 0 8px 20px rgba(220,38,38,.35); }

/* ─── RESPONSIVE ─────────────────────────────────────────── */
@media (max-width: 640px) {
    .info-grid  { grid-template-columns: 1fr; }
    .form-row   { grid-template-columns: 1fr; }
    .bottom-actions { flex-direction: column; align-items: flex-start; }
    .pg-head h1 { font-size: 19px; }
}
.pag-wrap {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 18px 0 6px;
    flex-wrap: wrap;
}
 
.pag-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    height: 36px;
    padding: 0 10px;
    border-radius: 10px;
    border: 1.5px solid var(--border);
    background: var(--surface);
    color: var(--text-2);
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all var(--transition);
    font-family: inherit;
    line-height: 1;
}
 
.pag-btn:hover:not(.pag-disabled):not(.pag-active) {
    border-color: var(--gold);
    color: var(--gold);
    background: var(--gold-soft);
}
 
.pag-active {
    background: linear-gradient(135deg, #c9920a, #f0c040);
    border-color: #c9920a;
    color: #fff;
    box-shadow: 0 4px 12px var(--gold-glow);
    pointer-events: none;
}
 
.pag-disabled {
    opacity: .38;
    cursor: not-allowed;
    pointer-events: none;
}
 
.pag-dots {
    color: var(--text-3);
    font-size: 14px;
    padding: 0 4px;
    user-select: none;
}
 
.pag-info {
    font-size: 12px;
    color: var(--text-3);
    text-align: center;
    padding-bottom: 4px;
}
</style>

<div class="pg">

    <!-- Header -->
    <div class="pg-head">
        <div class="pg-head-icon">
            <i class="fa-solid fa-user-gear"></i>
        </div>
        <div>
            <h1>Akun Saya</h1>
            <p>Kelola profil dan akun Anda</p>
        </div>
    </div>

    <!-- Flash messages -->
    <?php if(session()->getFlashdata('success')): ?>
    <div class="flash ok">
        <i class="fa-solid fa-circle-check"></i>
        <?= session()->getFlashdata('success') ?>
    </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('error')): ?>
    <div class="flash error">
        <i class="fa-solid fa-circle-xmark"></i>
        <?= session()->getFlashdata('error') ?>
    </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('error_hapus')): ?>
    <div class="flash warn">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <div>
            <strong>Akun tidak dapat dihapus</strong><br>
            <?= session()->getFlashdata('error_hapus') ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if(isset($_GET['edit'])): ?>
    <!-- ═══ FORM EDIT PROFIL ═══ -->
    <div class="card" style="animation-delay:.08s">
        <div class="card-header">
            <div class="card-header-left">
                <i class="fa-solid fa-pen"></i>
                <h2>Edit Profil</h2>
            </div>
            <a href="<?= base_url('pengaturan-user') ?>" class="btn btn-outline" style="padding:8px 14px;font-size:12px;">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="<?= base_url('user/update-profil') ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="<?= esc($user['nama']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="no_hp" class="form-control" value="<?= esc($user['no_hp']) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control"><?= esc($user['alamat']) ?></textarea>
                </div>
                <div style="display:flex;gap:10px;margin-top:4px;">
                    <button type="submit" class="btn btn-gold">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                    <a href="<?= base_url('pengaturan-user') ?>" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <?php elseif(isset($_GET['password'])): ?>
    <!-- ═══ FORM UBAH PASSWORD ═══ -->
    <div class="card" style="animation-delay:.08s">
        <div class="card-header">
            <div class="card-header-left">
                <i class="fa-solid fa-key"></i>
                <h2>Ubah Password</h2>
            </div>
            <a href="<?= base_url('pengaturan-user') ?>" class="btn btn-outline" style="padding:8px 14px;font-size:12px;">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="<?= base_url('user/update-password') ?>" method="post">
                <?= csrf_field() ?>
                <?php
                $fields = [
                    ['password_lama', 'Password Lama'],
                    ['password_baru', 'Password Baru'],
                    ['konfirmasi_password', 'Konfirmasi Password'],
                ];
                foreach($fields as [$id, $label]):
                ?>
                <div class="form-group">
                    <label class="form-label"><?= $label ?></label>
                    <div class="password-group">
                        <input type="password" name="<?= $id ?>" id="<?= $id ?>"
                               class="form-control password-input" required>
                        <button type="button" class="toggle-pw" onclick="togglePw('<?= $id ?>',this)">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
                <div style="display:flex;gap:10px;margin-top:4px;">
                    <button type="submit" class="btn btn-gold">
                        <i class="fa-solid fa-key"></i> Simpan Password
                    </button>
                    <a href="<?= base_url('pengaturan-user') ?>" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <?php else: ?>
    <!-- ═══ VIEW PROFIL ═══ -->

    <!-- Card 1: Profil -->
    <div class="card" style="animation-delay:.04s">
        <div class="card-header">
            <div class="card-header-left">
                <i class="fa-solid fa-circle-user"></i>
                <h2>Profil Saya</h2>
            </div>
            <a href="<?= base_url('pengaturan-user?edit=1') ?>" class="btn btn-outline" style="padding:8px 14px;font-size:12px;">
                <i class="fa-solid fa-pen"></i> Edit Profil
            </a>
        </div>

        <div class="card-body">
            <!-- Avatar + nama -->
            <div class="profile-row">
                <form action="<?= base_url('user/update-profil') ?>" method="POST"
                      enctype="multipart/form-data" id="uploadFotoForm">
                    <?= csrf_field() ?>
                    <input type="hidden" name="nama"   value="<?= esc($user['nama']) ?>">
                    <input type="hidden" name="no_hp"  value="<?= esc($user['no_hp']) ?>">
                    <input type="hidden" name="alamat" value="<?= esc($user['alamat']) ?>">

                    <div class="avatar" id="avatarTrigger" title="Klik untuk lihat foto">
                        <?php if(!empty($user['foto'])): ?>
                            <img src="<?= base_url('uploads/profile/'.$user['foto']) ?>"
                                 alt="Foto Profil" id="avatarThumb">
                        <?php else: ?>
                            <?= strtoupper(substr($user['nama'] ?? 'U', 0, 1)) ?>
                        <?php endif; ?>
                        <span class="avatar-overlay" aria-hidden="true">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Zoom
                        </span>
                        <label class="avatar-upload-btn" title="Ganti foto" onclick="event.stopPropagation()">
                            <i class="fa-solid fa-camera"></i>
                            <input type="file" name="foto" id="fotoInput" accept="image/*" hidden>
                        </label>
                    </div>
                </form>

                <div class="profile-info">
                    <div class="profile-name"><?= esc($user['nama']) ?></div>
                    <div class="profile-email"><?= esc($user['email']) ?></div>
                    <div class="profile-badge">
                        <i class="fa-solid fa-star" style="font-size:10px;"></i>
                        Member
                    </div>
                </div>
            </div>

            <!-- Info grid -->
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Nomor Telepon</div>
                    <div class="info-value <?= !$user['no_hp'] ? 'empty' : '' ?>">
                        <?= $user['no_hp'] ?: 'Belum diisi' ?>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-label">Alamat</div>
                    <div class="info-value <?= !$user['alamat'] ? 'empty' : '' ?>">
                        <?= $user['alamat'] ?: 'Belum diisi' ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom-actions">
            <a href="<?= base_url('pengaturan-user?password=1') ?>" class="btn btn-outline">
                <i class="fa-solid fa-lock"></i> Ubah Password
            </a>
            <div class="btn-group">
                <a href="<?= base_url('logout-user') ?>" class="btn btn-danger">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar
                </a>
                <button type="button" class="btn btn-red-solid" onclick="bukaModalHapus()">
                    <i class="fa-solid fa-user-xmark"></i> Hapus Akun
                </button>
            </div>
        </div>
    </div>

    <!-- Card 2: Pesanan -->
        <div class="card" style="animation-delay:.10s">
        <div class="card-header">
            <div class="card-header-left">
                <i class="fa-solid fa-box"></i>
                <h2>Pesanan Saya
                    <span style="color:var(--text-3);font-weight:500;">
                        (<?= $totalPesanan ?>)
                    </span>
                </h2>
            </div>
        </div>
 
        <div class="card-body">
 
            <?php if (!empty($pesanan)): ?>
 
                <div class="pesanan-list">
                    <?php foreach ($pesanan as $item): ?>
                    <div class="card-pesanan">
                        <div class="pesanan-icon">
                            <i class="fa-solid fa-box-open"></i>
                        </div>
                        <div class="pesanan-meta">
                            <div class="pesanan-num"><?= esc($item['order_number']) ?></div>
                            <div class="pesanan-date"><?= date('d M Y, H:i', strtotime($item['created_at'])) ?></div>
                        </div>
                        <div class="pesanan-right">
                            <div class="pesanan-total">Rp <?= number_format($item['total_price'], 0, ',', '.') ?></div>
                            <span class="badge-success">
                                <i class="fa-solid fa-circle-check" style="font-size:10px;"></i>
                                Selesai
                            </span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
 
                <?php if ($totalPages > 1): ?>
                <!-- ── PAGINATION ── -->
                <p class="pag-info">
                    Halaman <?= $currentPage ?> dari <?= $totalPages ?>
                </p>
                <div class="pag-wrap">
 
                    <!-- Tombol Previous -->
                    <?php if ($currentPage > 1): ?>
                        <a href="<?= base_url('pengaturan-user') ?>?page=<?= $currentPage - 1 ?>"
                           class="pag-btn">
                            <i class="fa-solid fa-chevron-left" style="font-size:11px;"></i>
                        </a>
                    <?php else: ?>
                        <span class="pag-btn pag-disabled">
                            <i class="fa-solid fa-chevron-left" style="font-size:11px;"></i>
                        </span>
                    <?php endif; ?>
 
                    <!-- Nomor Halaman -->
                    <?php
                    // Tampilkan maks 5 nomor: 2 kiri, aktif, 2 kanan
                    $startPage = max(1, $currentPage - 2);
                    $endPage   = min($totalPages, $currentPage + 2);
 
                    // Selalu tampilkan halaman 1
                    if ($startPage > 1): ?>
                        <a href="<?= base_url('pengaturan-user') ?>?page=1"
                           class="pag-btn">1</a>
                        <?php if ($startPage > 2): ?>
                            <span class="pag-dots">…</span>
                        <?php endif; ?>
                    <?php endif; ?>
 
                    <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                        <?php if ($i === $currentPage): ?>
                            <span class="pag-btn pag-active"><?= $i ?></span>
                        <?php else: ?>
                            <a href="<?= base_url('pengaturan-user') ?>?page=<?= $i ?>"
                               class="pag-btn"><?= $i ?></a>
                        <?php endif; ?>
                    <?php endfor; ?>
 
                    <!-- Selalu tampilkan halaman terakhir -->
                    <?php if ($endPage < $totalPages): ?>
                        <?php if ($endPage < $totalPages - 1): ?>
                            <span class="pag-dots">…</span>
                        <?php endif; ?>
                        <a href="<?= base_url('pengaturan-user') ?>?page=<?= $totalPages ?>"
                           class="pag-btn"><?= $totalPages ?></a>
                    <?php endif; ?>
 
                    <!-- Tombol Next -->
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="<?= base_url('pengaturan-user') ?>?page=<?= $currentPage + 1 ?>"
                           class="pag-btn">
                            <i class="fa-solid fa-chevron-right" style="font-size:11px;"></i>
                        </a>
                    <?php else: ?>
                        <span class="pag-btn pag-disabled">
                            <i class="fa-solid fa-chevron-right" style="font-size:11px;"></i>
                        </span>
                    <?php endif; ?>
 
                </div>
                <!-- ── /PAGINATION ── -->
                <?php endif; ?>
 
            <?php else: ?>
                <div class="empty-state">
                    <div class="empty-icon"><i class="fa-solid fa-box-open"></i></div>
                    <h3>Belum ada pesanan</h3>
                    <p>Anda belum pernah melakukan pemesanan.</p>
                    <a href="<?= base_url('produk-user') ?>" class="btn btn-gold">
                        <i class="fa-solid fa-bag-shopping"></i> Mulai Belanja
                    </a>
                </div>
            <?php endif; ?>
 
        </div>
    </div>

    <?php endif; ?>

    <!-- ═══ FOTO POPUP ═══ -->
    <div id="fotoOverlay" role="dialog" aria-modal="true" aria-label="Foto Profil">
        <div class="foto-modal" id="fotoModal">
            <button class="foto-close-x" id="fotoCloseX" aria-label="Tutup">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="foto-preview" id="fotoPreviewArea">
                <div class="foto-shimmer" id="fotoShimmer"></div>
                <?php if(!empty($user['foto'])): ?>
                    <img src="<?= base_url('uploads/profile/'.$user['foto']) ?>"
                         alt="Foto Profil" id="fotoPopupImg"
                         onload="document.getElementById('fotoShimmer').style.display='none'">
                <?php else: ?>
                    <span class="foto-initials-big" id="fotoPopupInitials">
                        <?= strtoupper(substr($user['nama'] ?? 'U', 0, 1)) ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="foto-info">
                <div>
                    <div class="foto-name"><?= esc($user['nama']) ?></div>
                    <div class="foto-email"><?= esc($user['email']) ?></div>
                </div>
                <div class="foto-actions">
                    <label class="foto-btn foto-btn-gold" style="cursor:pointer;">
                        <i class="fa-solid fa-camera"></i> Ganti Foto
                        <input type="file" id="fotoInputModal" accept="image/*" hidden>
                    </label>
                    <button class="foto-btn foto-btn-close" id="fotoBtnClose">
                        <i class="fa-solid fa-xmark"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ═══ MODAL HAPUS AKUN ═══ -->
    <div class="del-overlay" id="delOverlay">
        <div class="del-modal">
            <div class="del-header">
                <div class="del-icon-ring"><i class="fa-solid fa-user-xmark"></i></div>
                <h3>Hapus Akun Permanen</h3>
                <p>Tindakan ini tidak dapat dibatalkan.<br>Semua data Anda akan dihapus selamanya.</p>
            </div>
            <div class="del-body">
                <ul class="del-warnings">
                    <li><i class="fa-solid fa-circle-xmark"></i> Data profil dan foto akan dihapus permanen</li>
                    <li><i class="fa-solid fa-circle-xmark"></i> Riwayat pesanan tidak bisa diakses lagi</li>
                    <li><i class="fa-solid fa-circle-xmark"></i> Akun tidak dapat dipulihkan setelah dihapus</li>
                </ul>
                <div style="margin-bottom:14px;">
                    <label class="del-label">Ketik <span>HAPUS</span> untuk mengkonfirmasi</label>
                    <input type="text" id="delConfirmInput" class="del-input"
                           placeholder="Ketik HAPUS di sini..." autocomplete="off"
                           oninput="cekKonfirmasi(this)">
                </div>
            </div>
            <div class="del-footer">
                <button type="button" class="del-btn-cancel" onclick="tutupModalHapus()">
                    <i class="fa-solid fa-xmark"></i> Batal
                </button>
                <form method="post" action="<?= base_url('user/hapus-akun') ?>" id="formHapusAkun" style="flex:1;display:flex;">
                    <?= csrf_field() ?>
                    <button type="submit" class="del-btn-hapus" id="delBtnHapus" style="width:100%;">
                        <i class="fa-solid fa-trash"></i> Hapus Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>

</div><!-- .pg -->

<script>
/* ── Toggle password ── */
function togglePw(id, btn) {
    const inp = document.getElementById(id);
    const ico = btn.querySelector('i');
    const show = inp.type === 'password';
    inp.type = show ? 'text' : 'password';
    ico.className = show ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye';
}

/* ── Upload foto (avatar kecil) ── */
(function(){
    const fi = document.getElementById('fotoInput');
    if (!fi) return;
    fi.addEventListener('change', function(){
        const file = this.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = ev => {
            const thumb = document.getElementById('avatarThumb');
            if (thumb) { thumb.src = ev.target.result; }
            else {
                const av = document.getElementById('avatarTrigger');
                const img = document.createElement('img');
                img.src = ev.target.result; img.alt = 'Foto'; img.id = 'avatarThumb';
                av.insertBefore(img, av.firstChild);
            }
            const pi = document.getElementById('fotoPopupImg');
            if (pi) pi.src = ev.target.result;
        };
        reader.readAsDataURL(file);
        document.getElementById('uploadFotoForm').submit();
    });
})();

/* ── Foto popup ── */
(function(){
    const overlay  = document.getElementById('fotoOverlay');
    const modal    = document.getElementById('fotoModal');
    const closeX   = document.getElementById('fotoCloseX');
    const closeBtn = document.getElementById('fotoBtnClose');
    const trigger  = document.getElementById('avatarTrigger');
    const shimmer  = document.getElementById('fotoShimmer');
    const popupImg = document.getElementById('fotoPopupImg');
    if (!overlay) return;

    function dominantColor(img, cb){
        try {
            const c = document.createElement('canvas'); c.width = c.height = 40;
            const ctx = c.getContext('2d'); ctx.drawImage(img, 0, 0, 40, 40);
            const d = ctx.getImageData(0,0,40,40).data;
            let r=0,g=0,b=0,n=0;
            for(let i=0;i<d.length;i+=16){
                const br=(d[i]+d[i+1]+d[i+2])/3;
                if(br<20||br>235) continue;
                r+=d[i]; g+=d[i+1]; b+=d[i+2]; n++;
            }
            cb(n?Math.round(r/n):184, n?Math.round(g/n):134, n?Math.round(b/n):11);
        } catch(e){ cb(201,146,10); }
    }

    function applyGlow(img){
        if(!modal) return;
        dominantColor(img,(r,g,b)=>{
            const mid=(Math.max(r,g,b)+Math.min(r,g,b))/2, k=1.25;
            modal.style.setProperty('--glow-r', Math.min(255,Math.round(mid+(r-mid)*k)));
            modal.style.setProperty('--glow-g', Math.min(255,Math.round(mid+(g-mid)*k)));
            modal.style.setProperty('--glow-b', Math.min(255,Math.round(mid+(b-mid)*k)));
            modal.classList.add('glow-active');
        });
    }

    function open(){
        overlay.classList.add('show');
        document.body.style.overflow='hidden';
        if(shimmer && popupImg){
            shimmer.style.display='block';
            if(popupImg.complete){ shimmer.style.display='none'; setTimeout(()=>applyGlow(popupImg),80); }
            else popupImg.addEventListener('load',function f(){ shimmer.style.display='none'; applyGlow(popupImg); popupImg.removeEventListener('load',f); });
        } else if(!popupImg && modal){
            modal.style.setProperty('--glow-r',201); modal.style.setProperty('--glow-g',146); modal.style.setProperty('--glow-b',10);
            setTimeout(()=>modal.classList.add('glow-active'),80);
        }
    }
    function close(){
        modal.classList.remove('glow-active');
        overlay.classList.remove('show');
        document.body.style.overflow='';
    }

    if(trigger) trigger.addEventListener('click', e=>{ if(!e.target.closest('.avatar-upload-btn')) open(); });
    if(closeX)   closeX.addEventListener('click', close);
    if(closeBtn) closeBtn.addEventListener('click', close);
    overlay.addEventListener('click', e=>{ if(e.target===overlay) close(); });
    document.addEventListener('keydown', e=>{ if(e.key==='Escape'){ close(); tutupModalHapus(); } });

    /* Upload dari dalam popup */
    const fim = document.getElementById('fotoInputModal');
    if(fim) fim.addEventListener('change', function(){
        const file=this.files[0]; if(!file) return;
        const reader=new FileReader();
        reader.onload=ev=>{
            if(popupImg){ popupImg.src=ev.target.result; if(shimmer) shimmer.style.display='none'; popupImg.onload=()=>applyGlow(popupImg); }
            else {
                const ini=document.getElementById('fotoPopupInitials'); if(ini) ini.style.display='none';
                const img=document.createElement('img'); img.id='fotoPopupImg'; img.src=ev.target.result;
                img.style='width:100%;height:100%;object-fit:cover;display:block;transform:scale(1);';
                img.onload=()=>applyGlow(img);
                document.getElementById('fotoPreviewArea').appendChild(img);
                if(shimmer) shimmer.style.display='none';
            }
            const th=document.getElementById('avatarThumb'); if(th) th.src=ev.target.result;
        };
        reader.readAsDataURL(file);
        const mi=document.getElementById('fotoInput');
        if(mi){ const dt=new DataTransfer(); dt.items.add(file); mi.files=dt.files; document.getElementById('uploadFotoForm').submit(); }
    });
})();

/* ── Modal hapus akun ── */
function bukaModalHapus(){
    document.getElementById('delOverlay').classList.add('active');
    document.body.style.overflow='hidden';
    document.getElementById('delConfirmInput').value='';
    document.getElementById('delBtnHapus').classList.remove('ready');
    document.getElementById('delConfirmInput').classList.remove('valid');
    setTimeout(()=>document.getElementById('delConfirmInput').focus(), 400);
}
function tutupModalHapus(){
    document.getElementById('delOverlay').classList.remove('active');
    document.body.style.overflow='';
}
function cekKonfirmasi(inp){
    const ok = inp.value.trim().toUpperCase()==='HAPUS';
    document.getElementById('delBtnHapus').classList.toggle('ready', ok);
    inp.classList.toggle('valid', ok);
}
document.getElementById('delOverlay').addEventListener('click', function(e){ if(e.target===this) tutupModalHapus(); });
</script>

<?= $this->include('frontend/footer2') ?>