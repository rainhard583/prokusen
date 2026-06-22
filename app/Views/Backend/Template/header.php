<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Sistem Penjualan - PSG Admin</title>

    <!-- Font Awesome -->
    <link href="<?= base_url('Assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">

    <!-- SB Admin 2 CSS -->
    <link href="<?= base_url('Assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?= base_url('Assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">

    <!-- SweetAlert2 -->
    <link href="<?= base_url('Assets/css/sweetalert2.min.css') ?>" rel="stylesheet">

    <style>

        /* ===== GLOBAL ===== */
        body {
            background: #f4f4f8;
            font-family: 'Nunito', sans-serif;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            background: #fff !important;
            border-bottom: 2px solid #f0e6c8;
            box-shadow: 0 2px 12px rgba(184,134,11,0.08) !important;
        }

        .topbar .nav-link {
            color: #5a4a2a !important;
        }

        /* ===== CARDS ===== */
        .card {
            border: none !important;
            border-radius: 16px !important;
            box-shadow: 0 2px 16px rgba(0,0,0,0.07) !important;
            transition: box-shadow 0.2s ease, transform 0.2s ease;
        }
        .card:hover {
            box-shadow: 0 6px 24px rgba(0,0,0,0.11) !important;
            transform: translateY(-2px);
        }

        /* ===== CARD BORDER LEFT OVERRIDE ===== */
        .border-left-primary {
            border-left: 4px solid #b8860b !important;
        }
        .border-left-success {
            border-left: 4px solid #16a34a !important;
        }
        .border-left-info {
            border-left: 4px solid #0ea5e9 !important;
        }
        .border-left-warning {
            border-left: 4px solid #f59e0b !important;
        }

        /* ===== BUTTONS ===== */
        .btn-primary {
            background: linear-gradient(135deg, #b8860b, #d4a017) !important;
            border: none !important;
            border-radius: 10px !important;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(184,134,11,0.3);
            transition: all 0.2s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #9a700a, #b8860b) !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(184,134,11,0.4);
        }
        .btn-secondary {
            border-radius: 10px !important;
            font-weight: 600;
        }
        .btn-success {
            border-radius: 10px !important;
            font-weight: 600;
        }
        .btn-danger {
            border-radius: 10px !important;
            font-weight: 600;
        }
        .btn-info {
            border-radius: 10px !important;
            font-weight: 600;
        }
        .btn-sm {
            border-radius: 8px !important;
        }

        /* ===== FORM CONTROLS ===== */
        .form-control {
            border-radius: 10px !important;
            border: 1.5px solid #e2d9c5 !important;
            font-size: 13.5px;
            transition: all 0.2s ease;
        }
        .form-control:focus {
            border-color: #b8860b !important;
            box-shadow: 0 0 0 3px rgba(184,134,11,0.15) !important;
        }

        /* ===== TABLE ===== */
        .table {
            border-radius: 12px;
            overflow: hidden;
        }
        .table thead.thead-dark th {
            background: linear-gradient(135deg, #1a1008, #2d1a0a) !important;
            color: #f0c040 !important;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.5px;
            border: none;
            padding: 14px 12px;
        }
        .table tbody tr {
            transition: background 0.15s ease;
        }
        .table tbody tr:hover {
            background: #fffbf0 !important;
        }
        .table td {
            vertical-align: middle !important;
            font-size: 13.5px;
            border-color: #f0e6c8 !important;
            padding: 12px !important;
        }

        /* ===== BADGES ===== */
        .badge {
            border-radius: 20px !important;
            padding: 5px 12px !important;
            font-size: 11px !important;
            font-weight: 700 !important;
        }
        .badge-warning { background: #fef3c7; color: #92400e !important; }
        .badge-success { background: #dcfce7; color: #166534 !important; }
        .badge-danger  { background: #fee2e2; color: #991b1b !important; }
        .badge-primary { background: #fef9e7; color: #78350f !important; }
        .badge-secondary { background: #f1f5f9; color: #475569 !important; }
        .badge-info    { background: #e0f2fe; color: #0c4a6e !important; }

        /* ===== CARD HEADER ===== */
        .card-header {
            background: #fff !important;
            border-bottom: 1.5px solid #f0e6c8 !important;
            border-radius: 16px 16px 0 0 !important;
            font-weight: 700;
            color: #3d2a0a;
        }

        /* ===== MODAL ===== */
        .modal-content {
            border-radius: 16px !important;
            border: none !important;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15) !important;
        }
        .modal-header {
            background: linear-gradient(135deg, #1a1008, #2d1a0a);
            color: #f0c040;
            border-radius: 16px 16px 0 0 !important;
            border-bottom: none !important;
        }
        .modal-header .close {
            color: #f0c040 !important;
            opacity: 1;
            text-shadow: none;
        }
        .modal-title {
            font-weight: 700;
            color: #f0c040;
        }

        /* ===== SIDEBAR TOGGLE BUTTON ===== */
        #sidebarToggle {
            background: rgba(184,134,11,0.15);
            color: #b8860b;
        }
        #sidebarToggle:hover {
            background: rgba(184,134,11,0.3);
        }

        /* ===== PAGE TITLE ===== */
        h1.h3 {
            font-weight: 800;
            color: #1a1008;
            letter-spacing: -0.3px;
        }

        /* ===== ALERT ===== */
        .alert-success {
            background: #dcfce7;
            border: 1px solid #86efac;
            color: #166534;
            border-radius: 12px !important;
        }
        .alert-danger {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #991b1b;
            border-radius: 12px !important;
        }

        /* ===== FOOTER ===== */
        .sticky-footer {
            border-top: 1px solid #f0e6c8 !important;
        }
        .sticky-footer span {
            color: #9a8060;
            font-size: 13px;
        }

        /* ===== DROPDOWN PROFILE ===== */
        .dropdown-menu {
            border-radius: 14px !important;
            border: 1px solid #f0e6c8 !important;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12) !important;
            padding: 8px !important;
        }
        .dropdown-item {
            border-radius: 8px !important;
            font-size: 13.5px;
            color: #3d2a0a !important;
            transition: all 0.15s;
        }
        .dropdown-item:hover {
            background: #fef9e7 !important;
            color: #b8860b !important;
        }
        .dropdown-divider {
            border-color: #f0e6c8 !important;
        }

        /* ===== IMG PROFILE TOPBAR ===== */
        .img-profile {
            border: 2px solid #f0c040;
            width: 34px;
            height: 34px;
        }

        /* ===== SELECT STATUS in TABLE ===== */
        .form-control select,
        select.form-control {
            cursor: pointer;
        }

        /* ===== SCROLL TO TOP ===== */
        .scroll-to-top {
            background: linear-gradient(135deg, #b8860b, #f0c040) !important;
        }

    </style>

</head>

<body id="page-top">

<div id="wrapper">

    <!-- =========== SIDEBAR =========== -->
    <?= view('Backend/Template/sidebar') ?>
    <!-- =========== END SIDEBAR =========== -->

    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            <!-- =========== TOPBAR =========== -->
            <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top"
                 style="background:#fff; border-bottom:2px solid #f0e6c8; box-shadow:0 2px 12px rgba(184,134,11,0.08);">

                <!-- Sidebar Toggle (Animated Burger) -->
                <button id="burgerBtn" class="burger-btn mr-3" type="button" aria-label="Toggle Sidebar">
                    <span class="burger-line"></span>
                    <span class="burger-line"></span>
                    <span class="burger-line"></span>
                </button>

                <!-- Topbar Right -->
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item dropdown no-arrow">

                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                           href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            <div style="text-align:right; line-height:1.2; margin-right:8px;">
                                <div style="font-size:13px; font-weight:700; color:#1a1008;">
                                    <?= ucfirst(session()->get('username')) ?>
                                </div>
                                <div style="font-size:11px; color:#9a8060; font-weight:500;">Administrator</div>
                            </div>

                            <div style="
                                width:36px; height:36px;
                                background: linear-gradient(135deg, #b8860b, #f0c040);
                                border-radius:50%;
                                display:flex; align-items:center; justify-content:center;
                                color:#1a1008; font-weight:800; font-size:15px;
                                box-shadow: 0 2px 8px rgba(184,134,11,0.3);
                            ">
                                <?= strtoupper(substr(session()->get('username') ?? 'A', 0, 1)) ?>
                            </div>

                        </a>

                        <!-- Dropdown -->
                        <div class="dropdown-menu dropdown-menu-right"
                             aria-labelledby="userDropdown">

                            <div style="padding:10px 14px 8px; border-bottom:1px solid #f0e6c8; margin-bottom:6px;">
                                <div style="font-size:13px; font-weight:700; color:#1a1008;">
                                    <?= ucfirst(session()->get('username')) ?>
                                </div>
                                <div style="font-size:11px; color:#9a8060;">Administrator</div>
                            </div>

                            <a class="dropdown-item" href="<?= base_url('profil') ?>">
                                <i class="fas fa-user fa-sm fa-fw mr-2" style="color:#b8860b;"></i>
                                Profil Saya
                            </a>

                            <a class="dropdown-item" href="<?= base_url('pengaturan') ?>">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2" style="color:#b8860b;"></i>
                                Pengaturan
                            </a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="<?= base_url('logout-admin') ?>"
                               style="color:#e53e3e !important;">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2" style="color:#e53e3e;"></i>
                                Logout
                            </a>

                        </div>

                    </li>

                </ul>

            </nav>
            <!-- =========== END TOPBAR =========== -->

            <!-- =========== MAIN CONTENT =========== -->
            <div class="container-fluid">