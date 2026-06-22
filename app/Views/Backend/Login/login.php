<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Masuk ke Akun</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Poppins',sans-serif;
        }

        body{

            min-height:100vh;

            display:flex;
            justify-content:center;
            align-items:center;

            background:
            linear-gradient(
                135deg,
                #f5f1eb,
                #ebe4db
            );

            padding:30px;

        }

        .login-card{

            width:100%;
            max-width:460px;

            background:white;

            border-radius:24px;

            padding:45px;

            box-shadow:
            0 20px 50px rgba(0,0,0,0.08);

        }

        .logo-box{

            width:72px;
            height:72px;

            margin:auto;
            margin-bottom:22px;

            border-radius:20px;

            background:#8b5e3c;

            display:flex;
            justify-content:center;
            align-items:center;

            color:white;

            font-size:30px;

        }

        .title{

            text-align:center;

            font-size:42px;

            font-weight:700;

            color:#111;

            margin-bottom:10px;

        }

        .subtitle{

            text-align:center;

            color:#777;

            margin-bottom:35px;

            line-height:1.7;

        }

        .form-group{
            margin-bottom:22px;
        }

        .form-group label{

            display:block;

            margin-bottom:10px;

            font-size:14px;

            font-weight:600;

            color:#111;

        }

        .input-box{
            position:relative;
        }

        .input-box input{

            width:100%;

            height:58px;

            border-radius:14px;

            border:1px solid #d9d9d9;

            padding:0 18px;

            font-size:15px;

            outline:none;

            transition:.3s;

            background:#f8fafc;

        }

        .input-box input:focus{

            border-color:#8b5e3c;

            background:white;

        }

        .input-box i{

            position:absolute;

            right:18px;
            top:50%;

            transform:translateY(-50%);

            color:#999;

            cursor:pointer;

        }

        .btn-login{

            width:100%;

            height:58px;

            border:none;

            border-radius:14px;

            background:#8b5e3c;

            color:white;

            font-size:16px;

            font-weight:600;

            cursor:pointer;

            transition:.3s;

            margin-top:10px;

        }

        .btn-login:hover{

            background:#6f472a;

            transform:translateY(-2px);

        }

        .register{

            text-align:center;

            margin-top:22px;

            color:#777;

            font-size:15px;

        }

        .register a{

            color:#8b5e3c;

            text-decoration:none;

            font-weight:600;

        }

        .divider{

            display:flex;
            align-items:center;

            gap:12px;

            margin:28px 0;

            color:#aaa;

            font-size:13px;

        }

        .divider::before,
        .divider::after{

            content:'';

            flex:1;

            height:1px;

            background:#ddd;

        }

        .admin-link{

            text-align:center;

        }

        .admin-link a{

            color:#8b5e3c;

            text-decoration:none;

            font-weight:600;

        }

        .back-home{

            display:inline-flex;
            align-items:center;
            gap:10px;

            color:#7c6f64;

            margin-bottom:24px;

            text-decoration:none;

            font-size:14px;

        }

    </style>

</head>
<body>

    <div class="login-wrapper">

        <a href="<?= base_url('/') ?>" class="back-home">
            ← Kembali ke Beranda
        </a>

        <div class="login-card">

            <div class="logo-box">
                <i class="fa-solid fa-house"></i>
            </div>

            <h1 class="title">Masuk ke Akun</h1>

            <p class="subtitle">
                Masuk untuk melihat produk dan membuat pesanan
            </p>

            <form action="<?= base_url('login/process') ?>" method="POST">

                <div class="form-group">

                    <label>Email atau Username</label>

                    <div class="input-box">

                        <input
                            type="text"
                            name="username"
                            required
                        >

                    </div>

                </div>

                <div class="form-group">

                    <label>Password</label>

                    <div class="input-box">

                        <input
                            type="password"
                            name="password"
                            id="password"
                            required
                        >

                        <i class="fa-regular fa-eye"
                        onclick="togglePassword()"></i>

                    </div>

                </div>

                <button type="submit" class="btn-login">
                    Masuk
                </button>

            </form>

            <div class="register">
                Belum punya akun?
                <a href="<?= base_url('register') ?>">
                    Daftar Sekarang
                </a>
            </div>

            <div class="divider">
                ATAU
            </div>

            <div class="admin-link">
                Login sebagai admin?
                <a href="<?= base_url('admin/login') ?>">
                    Masuk Admin
                </a>
            </div>

        </div>

    </div>

    <script>

        function togglePassword(){

            const password =
            document.getElementById('password');

            if(password.type === 'password'){

                password.type = 'text';

            }else{

                password.type = 'password';

            }

        }

    </script>

</body>
</html>