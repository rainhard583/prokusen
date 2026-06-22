<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Panel</title>

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
            max-width:420px;

            background:white;

            border-radius:24px;

            padding:45px;

            box-shadow:
            0 20px 50px rgba(0,0,0,0.08);

        }

        .logo-box{

            width:70px;
            height:70px;

            margin:auto;
            margin-bottom:25px;

            border-radius:20px;

            background:#8b5e3c;

            display:flex;
            justify-content:center;
            align-items:center;

            color:white;

            font-size:28px;

        }

        .title{

            text-align:center;

            font-size:30px;

            font-weight:700;

            color:#111;

            margin-bottom:8px;

        }

        .subtitle{

            text-align:center;

            color:#777;

            margin-bottom:35px;

            font-size:15px;

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

        .back{

            text-align:center;

            margin-top:25px;

        }

        .back a{

            color:#8b5e3c;

            text-decoration:none;

            font-size:14px;

            font-weight:500;

        }

        .alert{

            background:#ffe5e5;

            color:#c0392b;

            padding:14px;

            border-radius:12px;

            margin-bottom:20px;

            font-size:14px;

            text-align:center;

        }

    </style>

</head>
<body>

    <div class="login-card">

        <div class="logo-box">
            <i class="fa-solid fa-user-shield"></i>
        </div>

        <h1 class="title">Admin Panel</h1>

        <p class="subtitle">
            Masuk ke dashboard administrator
        </p>

        <?php if(session()->getFlashdata('error')) : ?>

            <div class="alert">
                <?= session()->getFlashdata('error'); ?>
            </div>

        <?php endif; ?>

        <!-- LOGIN ADMIN -->
        <form action="<?= base_url('admin/autentikasi') ?>" method="POST">

            <div class="form-group">

                <label>Username</label>

                <div class="input-box">

                    <input
                        type="text"
                        name="username"
                        placeholder="Masukkan username"
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
                        placeholder="Masukkan password"
                        required
                    >

                    <i class="fa-regular fa-eye"
                    onclick="togglePassword()"></i>

                </div>

            </div>

            <button type="submit" class="btn-login">
                Masuk Dashboard
            </button>

        </form>

        <div class="back">
            <a href="<?= base_url('/login') ?>">
                ← Kembali ke Login User
            </a>
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