<?php
/**
 * =====================================================================
 * INSTRUKSI INTEGRASI - Tambahkan kode di bawah ke pesanan.php Anda
 * =====================================================================
 *
 * 1. Tambahkan <style> PAYMENT_POPUP ke dalam blok <style> yang sudah ada
 * 2. Tambahkan HTML MODAL ke sebelum penutup </div> .page-wrapper
 * 3. Ganti <button type="submit" class="btn-kirim"> menjadi <button type="button" onclick="bukaPembayaran()">
 * 4. Tambahkan <script> PAYMENT ke sebelum script updateQty yang sudah ada
 * 5. Buat Controller method baru: PesananController::kirim() — lihat bagian PHP di bawah
 */
?>

<!-- ================================================================
     BAGIAN 1: CSS — Tambahkan ke dalam blok <style> yang sudah ada
     ================================================================ -->
<style id="PAYMENT_POPUP_STYLE">
/* ---- Overlay ---- */
.pay-overlay{
    position:fixed;inset:0;background:rgba(0,0,0,.55);
    backdrop-filter:blur(3px);z-index:9000;
    display:flex;align-items:flex-end;justify-content:center;
    opacity:0;pointer-events:none;transition:opacity .3s;
}
.pay-overlay.active{opacity:1;pointer-events:all;}

/* ---- Sheet utama ---- */
.pay-sheet{
    width:100%;max-width:480px;
    background:#fff;border-radius:24px 24px 0 0;
    padding:0 0 32px;
    transform:translateY(100%);transition:transform .35s cubic-bezier(.4,0,.2,1);
    max-height:92vh;display:flex;flex-direction:column;
}
.pay-overlay.active .pay-sheet{transform:translateY(0);}

/* ---- Handle bar ---- */
.pay-handle{
    width:40px;height:4px;border-radius:2px;
    background:#e5e7eb;margin:12px auto 0;flex-shrink:0;
}

/* ---- Header sheet ---- */
.pay-header{
    display:flex;align-items:center;justify-content:space-between;
    padding:16px 20px 12px;border-bottom:1px solid #f1f5f9;flex-shrink:0;
}
.pay-header h3{font-size:16px;font-weight:700;color:#111827;margin:0;}
.pay-close{
    background:none;border:none;cursor:pointer;
    width:32px;height:32px;border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    color:#6b7280;transition:.2s;
}
.pay-close:hover{background:#f3f4f6;color:#111827;}

.pay-safe{
    font-size:12px;color:#10b981;text-align:center;
    padding:6px 20px;display:flex;align-items:center;
    justify-content:center;gap:4px;flex-shrink:0;
}

/* ---- Scroll area ---- */
.pay-body{overflow-y:auto;flex:1;padding:4px 0 8px;}

/* ---- Metode item ---- */
.pay-item{
    display:flex;align-items:center;gap:14px;
    padding:14px 20px;cursor:pointer;
    transition:background .15s;position:relative;
}
.pay-item:hover{background:#fafafa;}
.pay-item-icon{
    width:44px;height:44px;border-radius:12px;
    display:flex;align-items:center;justify-content:center;
    flex-shrink:0;font-size:20px;
}
.pay-item-info{flex:1;}
.pay-item-name{font-size:14px;font-weight:600;color:#111827;}
.pay-item-desc{font-size:12px;color:#6b7280;margin-top:2px;}
.pay-item-promo{
    font-size:11px;color:#ef4444;font-weight:600;
    background:#fef2f2;border-radius:4px;
    padding:2px 6px;margin-top:4px;display:inline-block;
}
.pay-item-arrow{color:#9ca3af;font-size:13px;}
.pay-item-radio{
    width:20px;height:20px;border-radius:50%;
    border:2px solid #d1d5db;flex-shrink:0;
    display:flex;align-items:center;justify-content:center;
    transition:.2s;
}
.pay-item.selected .pay-item-radio{
    border-color:#b8860b;background:#b8860b;
}
.pay-item.selected .pay-item-radio::after{
    content:'';width:8px;height:8px;
    border-radius:50%;background:white;
}
.pay-divider{height:1px;background:#f1f5f9;margin:4px 20px;}

/* ---- Footer sheet ---- */
.pay-footer{padding:16px 20px 0;flex-shrink:0;border-top:1px solid #f1f5f9;}
.btn-lanjutkan{
    width:100%;padding:15px;border-radius:12px;
    background:#b8860b;color:white;
    font-size:15px;font-weight:700;border:none;
    cursor:pointer;transition:.3s;
}
.btn-lanjutkan:hover{background:#9a7200;}
.btn-lanjutkan:disabled{background:#d1d5db;cursor:not-allowed;}

/* ---- Sub-sheet Virtual Account ---- */
.pay-sub-sheet{
    position:absolute;inset:0;background:#fff;
    border-radius:24px 24px 0 0;
    transform:translateX(100%);transition:transform .3s cubic-bezier(.4,0,.2,1);
    display:flex;flex-direction:column;
}
.pay-sub-sheet.active{transform:translateX(0);}

.pay-sub-header{
    display:flex;align-items:center;gap:12px;
    padding:16px 20px;border-bottom:1px solid #f1f5f9;flex-shrink:0;
}
.pay-sub-back{
    background:none;border:none;cursor:pointer;
    color:#6b7280;font-size:18px;padding:0;
    display:flex;align-items:center;
}
.pay-sub-header h3{font-size:16px;font-weight:700;color:#111827;margin:0;}

.bank-search{
    padding:12px 20px;flex-shrink:0;
}
.bank-search input{
    width:100%;padding:10px 14px 10px 36px;
    border:1.5px solid #e5e7eb;border-radius:10px;
    font-size:14px;outline:none;font-family:'Poppins',sans-serif;
    background:#f9fafb url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%239ca3af' stroke-width='2'%3E%3Ccircle cx='11' cy='11' r='8'/%3E%3Cpath d='m21 21-4.35-4.35'/%3E%3C/svg%3E") no-repeat 10px center/16px;
    box-sizing:border-box;
}
.bank-search input:focus{border-color:#b8860b;}

.bank-list{overflow-y:auto;flex:1;}
.bank-item{
    display:flex;align-items:center;gap:14px;
    padding:14px 20px;cursor:pointer;transition:.15s;
}
.bank-item:hover{background:#fafafa;}
.bank-item-logo{
    width:40px;height:40px;border-radius:8px;
    background:#f3f4f6;display:flex;align-items:center;
    justify-content:center;font-size:11px;font-weight:700;
    color:#374151;flex-shrink:0;overflow:hidden;
}
.bank-item-logo img{width:100%;height:100%;object-fit:contain;padding:4px;}
.bank-item-name{font-size:14px;font-weight:600;color:#111827;flex:1;}
.bank-item-radio{
    width:20px;height:20px;border-radius:50%;
    border:2px solid #d1d5db;flex-shrink:0;
    display:flex;align-items:center;justify-content:center;transition:.2s;
}
.bank-item.selected .bank-item-radio{border-color:#b8860b;background:#b8860b;}
.bank-item.selected .bank-item-radio::after{
    content:'';width:8px;height:8px;border-radius:50%;background:white;
}
.bank-divider{height:1px;background:#f1f5f9;margin:0 20px;}
</style>

<!-- ================================================================
     BAGIAN 2: HTML MODAL
     Letakkan ini sebelum penutup </div> .page-wrapper (sebelum <script>)
     ================================================================ -->

<!-- Input hidden untuk menyimpan metode pembayaran yang dipilih -->
<!-- Tambahkan ini di dalam <form> pesanan, misalnya setelah csrf_field() -->
<input type="hidden" name="metode_bayar" id="input_metode_bayar">
<input type="hidden" name="detail_bayar" id="input_detail_bayar">

<!-- MODAL PAYMENT -->
<div class="pay-overlay" id="payOverlay" onclick="tutupPembayaran(event)">
    <div class="pay-sheet" onclick="event.stopPropagation()">
        <div class="pay-handle"></div>
        <div class="pay-header">
            <h3>Metode Pembayaran</h3>
            <button class="pay-close" onclick="tutupPembayaran()">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="pay-safe">
            <i class="fa-solid fa-shield-halved"></i>
            Informasi Anda aman dan terenkripsi
        </div>

        <div class="pay-body" id="payBody">

            <!-- Dana -->
            <div class="pay-item" data-method="dana" data-label="Dana" onclick="pilihMetode(this)">
                <div class="pay-item-icon" style="background:#1a88e5;">
                    <span style="color:white;font-size:13px;font-weight:800;">DANA</span>
                </div>
                <div class="pay-item-info">
                    <div class="pay-item-name">Dana</div>
                    <div class="pay-item-desc">Bayar langsung dari dompet Dana</div>
                </div>
                <div class="pay-item-radio"></div>
            </div>
            <div class="pay-divider"></div>

            <!-- GoPay -->
            <div class="pay-item" data-method="gopay" data-label="GoPay" onclick="pilihMetode(this)">
                <div class="pay-item-icon" style="background:#00aed6;">
                    <span style="color:white;font-size:11px;font-weight:800;">GOPAY</span>
                </div>
                <div class="pay-item-info">
                    <div class="pay-item-name">GoPay</div>
                    <div class="pay-item-desc">Bayar via GoPay / GoPayLater</div>
                </div>
                <div class="pay-item-radio"></div>
            </div>
            <div class="pay-divider"></div>

            <!-- OVO -->
            <div class="pay-item" data-method="ovo" data-label="OVO" onclick="pilihMetode(this)">
                <div class="pay-item-icon" style="background:#4c3498;">
                    <span style="color:white;font-size:13px;font-weight:800;">OVO</span>
                </div>
                <div class="pay-item-info">
                    <div class="pay-item-name">OVO</div>
                    <div class="pay-item-desc">Bayar via OVO Cash</div>
                    <div class="pay-item-promo">Diskon Rp10.000 untuk pesanan di atas Rp100.000</div>
                </div>
                <div class="pay-item-radio"></div>
            </div>
            <div class="pay-divider"></div>

            <!-- QRIS -->
            <div class="pay-item" data-method="qris" data-label="QRIS" onclick="pilihMetode(this)">
                <div class="pay-item-icon" style="background:#e8192c;">
                    <span style="color:white;font-size:11px;font-weight:800;">QRIS</span>
                </div>
                <div class="pay-item-info">
                    <div class="pay-item-name">QRIS</div>
                    <div class="pay-item-desc">Scan QR dari semua aplikasi dompet digital</div>
                </div>
                <div class="pay-item-radio"></div>
            </div>
            <div class="pay-divider"></div>

            <!-- Virtual Account -->
            <div class="pay-item" data-method="va" data-label="Transfer Virtual Account" onclick="bukaVA()">
                <div class="pay-item-icon" style="background:#1e40af;">
                    <i class="fa-solid fa-building-columns" style="color:white;font-size:18px;"></i>
                </div>
                <div class="pay-item-info">
                    <div class="pay-item-name">Transfer Virtual Account</div>
                    <div class="pay-item-desc" id="va-desc">Pilih bank tujuan transfer</div>
                </div>
                <i class="fa-solid fa-chevron-right pay-item-arrow"></i>
            </div>

        </div><!-- /.pay-body -->

        <div class="pay-footer">
            <button class="btn-lanjutkan" id="btnLanjutkan" disabled onclick="konfirmasiPembayaran()">
                Lanjutkan
            </button>
        </div>

        <!-- SUB-SHEET: Virtual Account Bank List -->
        <div class="pay-sub-sheet" id="vaSubSheet">
            <div class="pay-sub-header">
                <button class="pay-sub-back" onclick="tutupVA()">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
                <h3>Pilih Bank</h3>
            </div>
            <div class="bank-search">
                <input type="text" id="bankSearch" placeholder="Cari bank..." oninput="filterBank(this.value)">
            </div>
            <div class="bank-list" id="bankList">
                <!-- Bank items generated by JS -->
            </div>
            <div class="pay-footer" style="padding-bottom:16px;">
                <button class="btn-lanjutkan" id="btnPilihBank" disabled onclick="konfirmasiBank()">
                    Pilih Bank Ini
                </button>
            </div>
        </div>

    </div><!-- /.pay-sheet -->
</div><!-- /.pay-overlay -->


<!-- ================================================================
     BAGIAN 3: JAVASCRIPT
     Letakkan ini sebelum script updateQty yang sudah ada
     ================================================================ -->
<script id="PAYMENT_SCRIPT">
/* ========================
   DATA BANK
======================== */
const BANKS = [
    {id:'bca',    name:'BCA',                color:'#0066ae', text:'white'},
    {id:'mandiri',name:'Mandiri',             color:'#003087', text:'#f8c300'},
    {id:'bni',    name:'BNI',                 color:'#f8692b', text:'white'},
    {id:'bri',    name:'BRI',                 color:'#003087', text:'white'},
    {id:'bsi',    name:'BSI',                 color:'#1b8038', text:'white'},
    {id:'cimb',   name:'CIMB Niaga',          color:'#d71920', text:'white'},
    {id:'permata',name:'Permata',             color:'#e31837', text:'white'},
    {id:'danamon',name:'Danamon',             color:'#e31837', text:'white'},
    {id:'btn',    name:'BTN',                 color:'#f8a500', text:'#003087'},
    {id:'maybank',name:'Maybank',             color:'#ffda00', text:'#003087'},
    {id:'panin',  name:'Bank Panin',          color:'#003087', text:'white'},
    {id:'uob',    name:'Bank UOB Indonesia',  color:'#d71920', text:'white'},
    {id:'ocbc',   name:'OCBC',                color:'#e31837', text:'white'},
    {id:'mega',   name:'Bank Mega',           color:'#cc1417', text:'white'},
    {id:'sinarmas',name:'Sinarmas',           color:'#e31837', text:'white'},
    {id:'nagari', name:'Bank Nagari',         color:'#005496', text:'white'},
    {id:'bpddiy', name:'BPD DIY',             color:'#004b8d', text:'white'},
];

let selectedMethod   = null; // dana | gopay | ovo | qris | va
let selectedBank     = null; // {id, name}

/* ========================
   OPEN / CLOSE
======================== */
function bukaPembayaran() {
    // Validasi form dulu
    const nama = document.querySelector('[name="nama_pembeli"]');
    const hp   = document.querySelector('[name="no_hp"]');
    if (!nama.value.trim()) { nama.focus(); return alert('Nama lengkap wajib diisi!'); }
    if (!hp.value.trim())   { hp.focus();   return alert('Nomor telepon wajib diisi!'); }

    renderBankList(BANKS);
    document.getElementById('payOverlay').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function tutupPembayaran(e) {
    if (e && e.target !== document.getElementById('payOverlay')) return;
    document.getElementById('payOverlay').classList.remove('active');
    document.body.style.overflow = '';
}

/* ========================
   PILIH METODE
======================== */
function pilihMetode(el) {
    // Hapus selected dari semua
    document.querySelectorAll('.pay-item').forEach(i => i.classList.remove('selected'));

    el.classList.add('selected');
    selectedMethod = el.dataset.method;
    selectedBank   = null;

    // Update tombol lanjutkan
    document.getElementById('btnLanjutkan').disabled = false;

    // Reset va-desc kalau sebelumnya sudah pilih bank
    if (selectedMethod !== 'va') {
        document.getElementById('va-desc').textContent = 'Pilih bank tujuan transfer';
    }
}

/* ========================
   VIRTUAL ACCOUNT
======================== */
function bukaVA() {
    document.getElementById('vaSubSheet').classList.add('active');
}

function tutupVA() {
    document.getElementById('vaSubSheet').classList.remove('active');
}

function renderBankList(banks) {
    const list = document.getElementById('bankList');
    list.innerHTML = banks.map(b => `
        <div class="bank-item" data-id="${b.id}" data-name="${b.name}" onclick="pilihBank(this)">
            <div class="bank-item-logo" style="background:${b.color};">
                <span style="color:${b.text};font-size:9px;font-weight:800;text-align:center;line-height:1.2;padding:2px;">
                    ${b.name.split(' ').slice(0,2).join('<br>')}
                </span>
            </div>
            <div class="bank-item-name">${b.name}</div>
            <div class="bank-item-radio"></div>
        </div>
        <div class="bank-divider"></div>
    `).join('');
}

function filterBank(q) {
    const filtered = BANKS.filter(b => b.name.toLowerCase().includes(q.toLowerCase()));
    renderBankList(filtered);
}

function pilihBank(el) {
    document.querySelectorAll('.bank-item').forEach(i => i.classList.remove('selected'));
    el.classList.add('selected');
    selectedBank = { id: el.dataset.id, name: el.dataset.name };
    document.getElementById('btnPilihBank').disabled = false;
}

function konfirmasiBank() {
    if (!selectedBank) return;

    // Update pilihan VA di sheet utama
    document.querySelectorAll('.pay-item').forEach(i => i.classList.remove('selected'));
    const vaItem = document.querySelector('[data-method="va"]');
    vaItem.classList.add('selected');
    selectedMethod = 'va';
    document.getElementById('va-desc').textContent = 'Bank ' + selectedBank.name;
    document.getElementById('btnLanjutkan').disabled = false;

    tutupVA();
}

/* ========================
   KONFIRMASI & SUBMIT
======================== */
function konfirmasiPembayaran() {
    if (!selectedMethod) return;

    let labelMetode = '';
    if (selectedMethod === 'va') {
        if (!selectedBank) { bukaVA(); return; }
        labelMetode = 'Virtual Account - ' + selectedBank.name;
    } else {
        const labels = {dana:'Dana', gopay:'GoPay', ovo:'OVO', qris:'QRIS'};
        labelMetode = labels[selectedMethod] || selectedMethod;
    }

    // Isi hidden input lalu submit form
    document.getElementById('input_metode_bayar').value = selectedMethod;
    document.getElementById('input_detail_bayar').value  = selectedBank ? selectedBank.name : '';

    // Tutup overlay
    document.getElementById('payOverlay').classList.remove('active');
    document.body.style.overflow = '';

    // Submit form utama
    document.querySelector('form[action*="pesanan/kirim"]').submit();
}
</script>


<!-- ================================================================
     BAGIAN 4: UBAH TOMBOL KIRIM PESANAN
     Ganti tombol submit yang lama dengan ini:
     ================================================================ -->
<!--
HAPUS INI (tombol lama):
<button type="submit" class="btn-kirim">
    <i class="fa-solid fa-paper-plane"></i>
    Kirim Pesanan
</button>

GANTI DENGAN INI:
<button type="button" class="btn-kirim" onclick="bukaPembayaran()">
    <i class="fa-solid fa-paper-plane"></i>
    Kirim Pesanan
</button>
-->


<?php
/* ================================================================
   BAGIAN 5: PHP CONTROLLER — PesananController.php
   Tambahkan metode kirim() atau update yang sudah ada
   ================================================================

public function kirim()
{
    $metodeBayar = $this->request->getPost('metode_bayar'); // dana|gopay|ovo|qris|va
    $detailBayar = $this->request->getPost('detail_bayar'); // nama bank jika VA

    $data = [
        'nama_pembeli' => $this->request->getPost('nama_pembeli'),
        'no_hp'        => $this->request->getPost('no_hp'),
        'email'        => $this->request->getPost('email'),
        'alamat'       => $this->request->getPost('alamat'),
        'catatan'      => $this->request->getPost('catatan'),
        'metode_bayar' => $metodeBayar,
        'detail_bayar' => $detailBayar,
        'status'       => 'pending',
        'created_at'   => date('Y-m-d H:i:s'),
    ];

    // Simpan ke DB
    $this->pesananModel->insert($data);

    // (Opsional) simpan item dari keranjang juga

    // Redirect ke halaman sukses
    return redirect()->to(base_url('pesanan/sukses'))->with('success', 'Pesanan berhasil dikirim!');
}

================================================================
   BAGIAN 6: MIGRASI — tambah kolom metode_bayar & detail_bayar
================================================================

ALTER TABLE pesanan
    ADD COLUMN metode_bayar VARCHAR(50) NULL AFTER catatan,
    ADD COLUMN detail_bayar VARCHAR(100) NULL AFTER metode_bayar;

================================================================ */
?>