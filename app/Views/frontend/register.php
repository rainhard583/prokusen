<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            background:linear-gradient(135deg,#fdf8e8 0%,#fff8f0 100%);
            min-height:100vh;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            padding:20px;
        }

        .back-link{
            align-self:flex-start;
            margin-left:calc(50% - 230px);
            margin-bottom:20px;
            display:flex;
            align-items:center;
            gap:6px;
            color:#6b7280;
            font-size:14px;
            text-decoration:none;
            transition:.2s;
        }
        .back-link:hover{color:#b8860b;}

        .register-box{
            width:100%;
            max-width:460px;
            background:#fff;
            border-radius:24px;
            padding:40px;
            box-shadow:0 10px 40px rgba(0,0,0,.08);
        }

        .icon-box{
            width:64px;
            height:64px;
            background:#b8860b;
            color:#fff;
            margin:0 auto 20px;
            border-radius:18px;
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:26px;
        }

        .title{
            text-align:center;
            font-size:26px;
            font-weight:700;
            color:#111827;
            margin-bottom:6px;
        }

        .subtitle{
            text-align:center;
            color:#6b7280;
            margin-bottom:30px;
            font-size:14px;
        }

        .form-group{
            margin-bottom:18px;
        }

        .form-label{
            display:block;
            margin-bottom:7px;
            font-size:13px;
            font-weight:600;
            color:#111827;
        }

        .form-control{
            width:100%;
            height:50px;
            border:1.5px solid #e5e7eb;
            border-radius:12px;
            padding:0 16px;
            font-size:14px;
            outline:none;
            background:#f8fafc;
            transition:.2s;
            color:#111827;
        }

        .form-control::placeholder{color:#9ca3af;}

        .form-control:focus{
            border-color:#b8860b;
            background:#fff;
            box-shadow:0 0 0 3px rgba(184,134,11,.1);
        }

        /* ===== PASSWORD WRAPPER ===== */
        .password-wrapper{
            position:relative;
        }

        .password-wrapper .form-control{
            padding-right:46px;
        }

        .toggle-password{
            position:absolute;
            right:14px;
            top:50%;
            transform:translateY(-50%);
            cursor:pointer;
            color:#9ca3af;
            font-size:15px;
            transition:.2s;
        }
        .toggle-password:hover{color:#b8860b;}

        /* ===== STRENGTH BAR ===== */
        .strength-wrap{
            margin-top:10px;
            max-height:0;
            overflow:hidden;
            opacity:0;
            transform:translateY(-6px);
            transition:max-height .45s cubic-bezier(.23,1,.32,1),
                        opacity .4s ease,
                        transform .4s cubic-bezier(.23,1,.32,1);
        }
        .strength-wrap.show{
            max-height:80px;
            opacity:1;
            transform:translateY(0);
        }

        .strength-bar{
            display:flex;
            gap:4px;
            margin-bottom:8px;
        }
        .bar-seg{
            flex:1;
            height:5px;
            border-radius:4px;
            background:#e5e7eb;
            transition:background .5s cubic-bezier(.23,1,.32,1),
                        transform .4s cubic-bezier(.23,1,.32,1),
                        box-shadow .5s ease;
            transform:scaleY(1);
        }
        .bar-seg.active-weak{
            background:#ef4444;
            box-shadow:0 2px 8px rgba(239,68,68,.35);
            transform:scaleY(1.2);
        }
        .bar-seg.active-medium{
            background:#f59e0b;
            box-shadow:0 2px 8px rgba(245,158,11,.35);
            transform:scaleY(1.2);
        }
        .bar-seg.active-strong{
            background:#22c55e;
            box-shadow:0 2px 8px rgba(34,197,94,.35);
            transform:scaleY(1.2);
        }

        .strength-rules{
            display:flex;
            gap:14px;
            flex-wrap:wrap;
        }
        .rule{
            display:flex;
            align-items:center;
            gap:5px;
            font-size:12px;
            color:#9ca3af;
            transition:color .4s ease, transform .3s ease;
        }
        .rule i{
            font-size:11px;
            transition:color .4s ease, transform .4s cubic-bezier(.23,1,.32,1);
        }
        .rule.ok{
            color:#22c55e;
            transform:translateY(0);
        }
        .rule.ok i{
            transform:scale(1.3);
        }
        .rule.ok i::before{
            content:"\f058"; /* fa-circle-check */
            font-weight:900;
        }
        .rule i::before{
            content:"\f111"; /* fa-circle */
            font-family:"Font Awesome 6 Free";
            font-weight:400;
        }

        /* ===== KONFIRMASI ERROR ===== */
        .error-msg{
            font-size:12px;
            color:#ef4444;
            margin-top:6px;
            display:flex;
            align-items:center;
            gap:4px;
            max-height:0;
            overflow:hidden;
            opacity:0;
            transform:translateY(-4px);
            transition:max-height .35s cubic-bezier(.23,1,.32,1),
                        opacity .3s ease,
                        transform .35s cubic-bezier(.23,1,.32,1);
        }
        .error-msg.show{
            max-height:30px;
            opacity:1;
            transform:translateY(0);
        }

        /* ===== BUTTON ===== */
        .btn-register{
            width:100%;
            height:50px;
            border:none;
            border-radius:12px;
            background:#b8860b;
            color:#fff;
            font-size:15px;
            font-weight:600;
            cursor:pointer;
            transition:.2s;
            margin-top:8px;
        }
        .btn-register:hover{
            background:#9a7200;
            transform:translateY(-1px);
            box-shadow:0 6px 20px rgba(184,134,11,.3);
        }

        .login{
            text-align:center;
            margin-top:20px;
            color:#6b7280;
            font-size:13px;
        }
        .login a{
            color:#b8860b;
            text-decoration:none;
            font-weight:600;
        }

    </style>
</head>
<body>

<a href="<?= base_url('login') ?>" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Kembali ke Login
</a>

<div class="register-box">

    <div class="icon-box">
        <i class="fa-solid fa-user-plus"></i>
    </div>

    <div class="title">Buat Akun Baru</div>
    <div class="subtitle">Daftar untuk mulai berbelanja kusen &amp; cat</div>

    <form method="post" action="<?= base_url('register/save') ?>" id="registerForm">

        <?= csrf_field() ?>

        <!-- NAMA -->
        <div class="form-group">
            <label class="form-label">Nama Lengkap <span style="color:#ef4444">*</span></label>
            <input type="text" name="nama" class="form-control"
                   placeholder="Masukkan nama lengkap" required>
        </div>

        <!-- EMAIL -->
        <div class="form-group">
            <label class="form-label">Email <span style="color:#ef4444">*</span></label>
            <input type="email" name="email" class="form-control"
                   placeholder="Masukkan email" required>
        </div>

        <!-- NO HP -->
        <div class="form-group">
            <label class="form-label">Nomor Telepon <span style="color:#ef4444">*</span></label>
            <input type="text" name="no_hp" class="form-control"
                   placeholder="08xxxxxxxxxx" required>
        </div>

        <!-- PASSWORD -->
        <div class="form-group">
            <label class="form-label">Password <span style="color:#ef4444">*</span></label>
            <div class="password-wrapper">
                <input type="password" name="password" id="password"
                       class="form-control" placeholder="Minimal 6 karakter" required>
                <i class="fa-regular fa-eye toggle-password" id="togglePassword"></i>
            </div>

            <!-- STRENGTH BAR — muncul hanya saat ada input -->
            <div class="strength-wrap" id="strengthWrap">
                <div class="strength-bar">
                    <div class="bar-seg" id="seg1"></div>
                    <div class="bar-seg" id="seg2"></div>
                    <div class="bar-seg" id="seg3"></div>
                </div>
                <div class="strength-rules">
                    <span class="rule" id="ruleLen">
                        <i class="fa-solid"></i> Minimal 6 karakter
                    </span>
                    <span class="rule" id="ruleUpper">
                        <i class="fa-solid"></i> Huruf besar
                    </span>
                    <span class="rule" id="ruleNum">
                        <i class="fa-solid"></i> Angka
                    </span>
                </div>
            </div>
        </div>

        <!-- KONFIRMASI PASSWORD -->
        <div class="form-group">
            <label class="form-label">Konfirmasi Password <span style="color:#ef4444">*</span></label>
            <div class="password-wrapper">
                <input type="password" name="konfirmasi_password" id="konfirmasi_password"
                       class="form-control" placeholder="Ulangi password" required>
                <i class="fa-regular fa-eye toggle-password" id="toggleKonfirmasi"></i>
            </div>
            <!-- Pesan error konfirmasi -->
            <div class="error-msg" id="errorKonfirmasi">
                <i class="fa-solid fa-circle-xmark"></i> Password tidak cocok
            </div>
        </div>

        <button type="submit" class="btn-register">Daftar Sekarang</button>

    </form>

    <div class="login">
        Sudah punya akun? <a href="<?= base_url('login') ?>">Masuk di sini</a>
    </div>

</div>

<script>

    /* ============ TOGGLE SHOW/HIDE PASSWORD ============ */
    function initToggle(toggleId, inputId) {
        const btn   = document.getElementById(toggleId);
        const input = document.getElementById(inputId);
        btn.addEventListener('click', () => {
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            btn.classList.toggle('fa-eye', !show);
            btn.classList.toggle('fa-eye-slash', show);
        });
    }
    initToggle('togglePassword',   'password');
    initToggle('toggleKonfirmasi', 'konfirmasi_password');


    /* ============ PASSWORD STRENGTH ============ */
    const pwInput     = document.getElementById('password');
    const strengthWrap= document.getElementById('strengthWrap');
    const seg1 = document.getElementById('seg1');
    const seg2 = document.getElementById('seg2');
    const seg3 = document.getElementById('seg3');
    const ruleLen   = document.getElementById('ruleLen');
    const ruleUpper = document.getElementById('ruleUpper');
    const ruleNum   = document.getElementById('ruleNum');

    pwInput.addEventListener('input', function () {
        const val = this.value;

        // Tampilkan strength wrap hanya kalau ada isian
        if (val.length === 0) {
            strengthWrap.classList.remove('show');
            return;
        }
        strengthWrap.classList.add('show');

        // Cek tiap syarat
        const hasLen   = val.length >= 6;
        const hasUpper = /[A-Z]/.test(val);
        const hasNum   = /[0-9]/.test(val);

        // Update ikon syarat
        ruleLen.classList.toggle('ok',   hasLen);
        ruleUpper.classList.toggle('ok', hasUpper);
        ruleNum.classList.toggle('ok',   hasNum);

        // Hitung skor (0–3)
        const score = [hasLen, hasUpper, hasNum].filter(Boolean).length;

        // Reset semua segmen
        [seg1, seg2, seg3].forEach(s => {
            s.className = 'bar-seg';
        });

        if (score === 1) {
            seg1.classList.add('active-weak');
        } else if (score === 2) {
            seg1.classList.add('active-medium');
            seg2.classList.add('active-medium');
        } else if (score === 3) {
            seg1.classList.add('active-strong');
            seg2.classList.add('active-strong');
            seg3.classList.add('active-strong');
        }

        // Re-cek konfirmasi kalau sudah diisi
        checkKonfirmasi();
    });


    /* ============ CEK KONFIRMASI PASSWORD ============ */
    const konfInput   = document.getElementById('konfirmasi_password');
    const errorKonf   = document.getElementById('errorKonfirmasi');

    function checkKonfirmasi() {
        const pw   = pwInput.value;
        const konf = konfInput.value;

        // Hanya tampilkan error kalau konfirmasi sudah mulai diisi
        if (konf.length === 0) {
            errorKonf.classList.remove('show');
            konfInput.style.borderColor = '';
            return;
        }

        if (pw !== konf) {
            errorKonf.classList.add('show');
            konfInput.style.borderColor = '#ef4444';
            konfInput.style.boxShadow   = '0 0 0 3px rgba(239,68,68,.1)';
        } else {
            errorKonf.classList.remove('show');
            konfInput.style.borderColor = '#22c55e';
            konfInput.style.boxShadow   = '0 0 0 3px rgba(34,197,94,.1)';
        }
    }

    konfInput.addEventListener('input', checkKonfirmasi);


    /* ============ BLOCK SUBMIT KALAU TIDAK COCOK ============ */
    document.getElementById('registerForm').addEventListener('submit', function (e) {
        if (pwInput.value !== konfInput.value) {
            e.preventDefault();
            errorKonf.classList.add('show');
            konfInput.focus();
        }
    });

</script>
</body>
</html>