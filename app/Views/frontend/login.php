<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login User</title>

    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{
            background:#f5f5f5;
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:20px;
        }

        .login-box{
            width:100%;
            max-width:430px;
            background:#fff;
            border-radius:24px;
            padding:40px;
            box-shadow:0 10px 35px rgba(0,0,0,.08);
        }

        .icon-box{
            width:70px;
            height:70px;
            background:#b8860b;
            color:#fff;
            margin:auto;
            border-radius:20px;
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:28px;
            margin-bottom:25px;
        }

        .title{
            text-align:center;
            font-size:34px;
            font-weight:700;
            color:#111827;
            margin-bottom:10px;
        }

        .subtitle{
            text-align:center;
            color:#6b7280;
            margin-bottom:35px;
            font-size:15px;
        }

        .form-group{
            margin-bottom:22px;
        }

        .form-label{
            display:block;
            margin-bottom:8px;
            font-size:14px;
            font-weight:600;
            color:#111827;
        }

        .form-control{
            width:100%;
            height:54px;
            border:1px solid #d1d5db;
            border-radius:14px;
            padding:0 18px;
            font-size:15px;
            outline:none;
            transition:.2s;
        }

        .form-control:focus{
            border-color:#b8860b;
            box-shadow:0 0 0 4px rgba(184,134,11,.12);
        }

        .btn-login{
            width:100%;
            height:54px;
            border:none;
            border-radius:14px;
            background:#b8860b;
            color:#fff;
            font-size:16px;
            font-weight:600;
            cursor:pointer;
            transition:.2s;
        }

        .btn-login:hover{
            background:#a37407;
        }

        .register{
            text-align:center;
            margin-top:22px;
            color:#6b7280;
            font-size:14px;
        }

        .register a{
            color:#b8860b;
            text-decoration:none;
            font-weight:600;
        }

        .alert{
            background:#fee2e2;
            color:#b91c1c;
            padding:14px 16px;
            border-radius:12px;
            margin-bottom:20px;
            font-size:14px;
        }
        .back-home{
    display:inline-flex;
    align-items:center;
    gap:8px;

    margin-bottom:20px;
    margin-left:5px;

    color:#6b7280;
    font-size:14px;
    font-weight:500;
    text-decoration:none;
    transition:.3s;
}

.back-home:hover{
    color:#b8860b;
    transform:translateX(-3px);
}
    </style>

</head>
<body>

    <div style="width:100%; max-width:430px;">

    <a href="<?= base_url('/') ?>" class="back-home">
        <i class="fa-solid fa-arrow-left"></i>
        Kembali ke Beranda
    </a>
    <div class="login-box">

        <div class="icon-box">

            <i class="fa-solid fa-user"></i>

        </div>

        <div class="title">

            Login User

        </div>

        <div class="subtitle">

            Masuk untuk mulai membeli produk

        </div>

        <?php if(session()->getFlashdata('error')): ?>

            <div class="alert">

                <?= session()->getFlashdata('error') ?>

            </div>

        <?php endif; ?>

        <form method="post"
              action="<?= base_url('login/process') ?>">

            <?= csrf_field() ?>

            <!-- EMAIL -->
            <div class="form-group">

                <label class="form-label">

                    Email

                </label>

                <input type="email"
                       name="email"
                       class="form-control"
                       placeholder="Masukkan email"
                       required>

            </div>

            <!-- PASSWORD -->
            <div class="form-group">

                <label class="form-label">

                    Password

                </label>

                <div style="position:relative;">

                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control"
                           placeholder="Masukkan password"
                           required>

                    <i class="fa-solid fa-eye"
                       id="togglePassword"
                       style="
                            position:absolute;
                            right:18px;
                            top:50%;
                            transform:translateY(-50%);
                            cursor:pointer;
                            color:#9ca3af;
                            font-size:16px;
                       ">
                    </i>

                </div>

            </div>

            <!-- BUTTON LOGIN -->
            <button type="submit"
                    class="btn-login">

                Login

            </button>

        </form>

        <!-- REGISTER -->
        <div class="register">

            Belum punya akun?

            <a href="<?= base_url('register') ?>">

                Daftar sekarang

            </a>

        </div>

        <!-- GARIS PEMISAH -->
        <div style="
            display:flex;
            align-items:center;
            gap:12px;
            margin:24px 0;
        ">

            <div style="
                flex:1;
                height:1px;
                background:#e5e7eb;
            "></div>

            <span style="
                font-size:13px;
                color:#9ca3af;
            ">

                ATAU

            </span>

            <div style="
                flex:1;
                height:1px;
                background:#e5e7eb;
            "></div>

        </div>

        <!-- LOGIN ADMIN -->
        <div style="
            text-align:center;
            font-size:14px;
            color:#6b7280;
        ">

            Login sebagai admin?

            <a href="<?= base_url('admin/login') ?>"
               style="
                    color:#b8860b;
                    font-weight:600;
                    text-decoration:none;
               ">

                Masuk Admin

            </a>

        </div>

    </div>

    <!-- SCRIPT SHOW PASSWORD -->
    <script>

        const togglePassword =
            document.getElementById('togglePassword');

        const password =
            document.getElementById('password');

        togglePassword.addEventListener('click', function () {

            const type =
                password.getAttribute('type') === 'password'
                ? 'text'
                : 'password';

            password.setAttribute('type', type);

            this.classList.toggle('fa-eye');

            this.classList.toggle('fa-eye-slash');

        });

    </script>

</body>
</html>