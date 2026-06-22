<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? 'Putra Sumedang Grub' ?></title>

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    <!-- FONT AWESOME -->
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
            background:#f8fafc;
            overflow-x:hidden;
        }

        a{
            text-decoration:none;
            color:inherit;
        }

        /* =========================
           NAVBAR
        ========================= */

        .navbar{
            position:sticky;
            top:0;
            left:0;
            width:100%;

            padding:14px 60px;

            display:flex;
            justify-content:space-between;
            align-items:center;

            z-index:999;

            background:#fff;

            box-shadow:0 2px 16px rgba(0,0,0,0.07);
        }

        .logo{
            display:flex;
            align-items:center;
            gap:12px;
        }

        .main-logo{
            height:52px;
            width:auto;
            object-fit:contain;
        }

        .logo-text strong{
            font-size:14px;
            font-weight:700;
            color:#111;
            display:block;
        }

        .logo-text span{
            font-size:10px;
            color:#b8860b;
            font-weight:600;
            letter-spacing:1px;
        }

        .nav-menu{
            display:flex;
            align-items:center;
            gap:8px;
        }

        .nav-menu a{
            color:#374151;
            font-weight:500;
            font-size:14px;

            padding:8px 16px;

            border-radius:8px;

            display:flex;
            align-items:center;
            gap:6px;

            transition:.2s;
            position:relative;
        }

        .nav-menu a:hover{
            background:#fdf8e8;
            color:#b8860b;
        }

        .nav-menu a.active{
            color:#b8860b;
            font-weight:600;
        }

        .cart-badge{
            background:#b8860b;
            color:white;

            font-size:10px;
            font-weight:700;

            width:18px;
            height:18px;

            border-radius:50%;

            display:inline-flex;
            align-items:center;
            justify-content:center;

            margin-left:2px;
        }

        .btn-pesan-nav{
            background:#b8860b;
            color:white !important;

            padding:10px 20px !important;

            border-radius:10px;

            font-weight:600 !important;

            transition:.3s !important;
        }

        .btn-pesan-nav:hover{
            background:#9a7200 !important;

            box-shadow:0 6px 20px rgba(184,134,11,0.35) !important;

            transform:translateY(-2px);
        }

        /* =========================
           FLASH MESSAGE
        ========================= */

        .flash-success,
        .flash-error{

            padding:14px 24px;
            margin:16px 60px 0;

            border-radius:12px;

            font-size:14px;
            font-weight:500;

            display:flex;
            align-items:center;
            gap:10px;
        }

        .flash-success{
            background:#d1fae5;
            color:#065f46;
            border:1px solid #6ee7b7;
        }

        .flash-error{
            background:#fee2e2;
            color:#991b1b;
            border:1px solid #fca5a5;
        }

        /* =========================
           FOOTER
        ========================= */

        .footer{
            background:#0f172a;
            color:white;

            padding:60px 60px 30px;

            margin-top:80px;
        }

        .footer-grid{
            display:grid;

            grid-template-columns:
                1.4fr
                1fr
                1.2fr
                1.3fr;

            gap:40px;

            margin-bottom:40px;
        }

        .footer-logo{
            display:flex;
            align-items:center;
            gap:12px;

            margin-bottom:14px;
        }

        .footer-logo .main-logo{
            height:44px;
        }

        .footer h4{
            font-size:13px;
            font-weight:700;

            color:#94a3b8;

            letter-spacing:1px;

            margin-bottom:14px;

            text-transform:uppercase;
        }

        .footer p,
        .footer li{
            color:#94a3b8;
            font-size:14px;
            line-height:2;
        }

        .footer ul{
            list-style:none;
        }

        .footer li a{
            color:#94a3b8;
            transition:.2s;
        }

        .footer li a:hover{
            color:#d4a017;
        }

        .footer-contact li{
            display:flex;
            align-items:flex-start;
            gap:8px;

            margin-bottom:8px;
        }

        .footer-contact i{
            color:#b8860b;

            margin-top:4px;

            min-width:14px;

            font-size:13px;
        }

        .footer-wa{
            display:inline-flex;
            align-items:center;
            gap:8px;

            color:#4ade80;

            font-size:14px;
            font-weight:500;

            margin-top:12px;
        }

        .copyright{
            text-align:center;

            color:#475569;

            font-size:12px;

            padding-top:24px;

            border-top:1px solid rgba(255,255,255,0.07);

            display:flex;
            justify-content:space-between;
        }

        @media(max-width:1024px){

            .navbar{
                padding:14px 24px;
            }

            .footer{
                padding:50px 24px 24px;
            }

            .footer-grid{
                grid-template-columns:1fr 1fr;
            }
        }

        @media(max-width:640px){

            .footer-grid{
                grid-template-columns:1fr;
            }

            .copyright{
                flex-direction:column;
                gap:6px;
                text-align:center;
            }
        }

    </style>

</head>

<body>

<!-- =========================
     NAVBAR
========================= -->

<nav class="navbar">

    <div class="logo">

        <img src="<?= base_url('logo_png.png') ?>"
             alt="PSG Logo"
             class="main-logo">

        <div class="logo-text">

            <strong>PUTRA SUMEDANG GRUB</strong>

            <span>KUSEN & CAT TERPERCAYA</span>

        </div>

    </div>

    <div class="nav-menu">

        <!-- BERANDA -->
        <a href="<?= base_url('/') ?>"
           class="<?= uri_string() == '' ? 'active' : '' ?>">

            <i class="fa-solid fa-house"></i>

            Beranda

        </a>

        <!-- PRODUK -->
        <a href="<?= base_url('produk-user') ?>"
           class="<?= str_starts_with(uri_string(), 'produk-user') ? 'active' : '' ?>">

            <i class="fa-solid fa-box"></i>

            Produk

        </a>

        <!-- PESANAN -->
        <a href="<?= base_url('pesanan-user') ?>"
           id="cart-icon"
           class="<?= uri_string() == 'pesanan-user' ? 'active' : '' ?>">

            <i class="fa-solid fa-cart-shopping"></i>

            Pesanan

            <?php

            $keranjang = session()->get('keranjang') ?? [];

            $jumlah = count($keranjang);

            if ($jumlah > 0):

            ?>

                <span class="cart-badge">

                    <?= $jumlah ?>

                </span>

            <?php endif; ?>

        </a>

        <!-- RIWAYAT -->
        <a href="<?= base_url('riwayat') ?>"
           class="<?= str_starts_with(uri_string(), 'riwayat') ? 'active' : '' ?>">

            <i class="fa-solid fa-clock-rotate-left"></i>

            Riwayat

        </a>

        <!-- PENGATURAN USER -->
        <a href="<?= base_url('pengaturan-user') ?>"
           class="<?= str_starts_with(uri_string(), 'pengaturan-user') ? 'active' : '' ?>">

            <i class="fa-solid fa-gear"></i>

            Pengaturan

        </a>

        <!-- LOGOUT USER -->
        <a href="<?= base_url('logout-user') ?>"
           style="
                background:#ef4444;
                color:white;
                padding:10px 18px;
                border-radius:10px;
                font-weight:600;
           ">

            <i class="fa-solid fa-right-from-bracket"></i>

            Logout

        </a>

    </div>

</nav>

<!-- =========================
     FLASH MESSAGE
========================= -->

<?php if (session()->getFlashdata('success')): ?>

    <div class="flash-success">

        <i class="fa-solid fa-circle-check"></i>

        <?= session()->getFlashdata('success') ?>

    </div>

<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>

    <div class="flash-error">

        <i class="fa-solid fa-circle-xmark"></i>

        <?= session()->getFlashdata('error') ?>

    </div>

<?php endif; ?>