<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Putra Sumedang Grub - Kusen & Cat Terpercaya</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>
        **{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Plus Jakarta Sans',sans-serif;
    scroll-behavior:smooth;
}
        body{background:#fff;overflow-x:hidden;}
        a{text-decoration:none;color:inherit;}

        /* ===== NAVBAR ===== */
        .navbar{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    padding:16px 50px;
    box-sizing:border-box;

    display:flex;
    justify-content:space-between;
    align-items:center;

    z-index:999;
    transition:background .4s, box-shadow .4s;
}
        .navbar.scrolled{
            background:rgba(255,255,255,0.97);
            box-shadow:0 2px 20px rgba(0,0,0,0.08);
        }
        .navbar.scrolled .menu a{color:#374151;}
        .navbar.scrolled .menu a:hover{color:#b8860b;}
        .navbar.scrolled .logo-text strong{color:#111;}
        .navbar.scrolled .logo-text span{color:#b8860b;}

        .navbar.scrolled .btn-pesan-nav{
            background:#b8860b;
            color:white;
            border-color:#b8860b;
        }
        .navbar.scrolled .btn-pesan-nav:hover{
            background:#9a7009;
            border-color:#9a7009;
        }
        .navbar.scrolled .btn-user-nav{
            border-color:#e5e7eb;
            color:#374151;
        }
        .navbar.scrolled .btn-user-name{color:#374151;}
        .navbar.scrolled .btn-user-avatar{
            background:linear-gradient(135deg,#b8860b,#d4a017);
            color:white;
        }
        .navbar.scrolled .btn-user-chevron{color:#9ca3af;}
        .navbar.scrolled .btn-logout-nav{
            color:#6b7280;
            border-color:#e5e7eb;
        }
        .navbar.scrolled .btn-logout-nav:hover{
            color:#e53e3e;
            border-color:#fecaca;
            background:#fff5f5;
        }

        .logo{display:flex;align-items:center;gap:12px;}
        .main-logo{height:72px;width:auto;object-fit:contain;}
        .logo-text{display:flex;flex-direction:column;line-height:1.2;}
        .logo-text strong{font-size:15px;font-weight:700;color:white;transition:.4s;}
        .logo-text span{font-size:10px;color:#f0d080;font-weight:600;letter-spacing:1px;}

        .menu{
    display:flex;
    align-items:center;
    gap:20px;
    margin-left:auto;
}
        .menu > a:not(.btn-pesan-nav):not(.btn-user-nav):not(.btn-logout-nav){
    position:relative;
    color:#111827;
    font-weight:600;
    font-size:14px;
    padding:8px 2px;
    transition:
        color .25s ease,
        transform .25s ease;
}

/* garis animasi bawah */
.menu > a:not(.btn-pesan-nav):not(.btn-user-nav):not(.btn-logout-nav)::after{
    content:'';
    position:absolute;
    left:0;
    bottom:-4px;
    width:0%;
    height:2px;
    background:linear-gradient(90deg,#b8860b,#d4a017);
    border-radius:999px;
    transition:width .3s ease;
}

/* hover */
.menu > a:not(.btn-pesan-nav):not(.btn-user-nav):not(.btn-logout-nav):hover{
    color:#b8860b;
    transform:translateY(-2px);
}

/* animasi garis jalan */
.menu > a:not(.btn-pesan-nav):not(.btn-user-nav):not(.btn-logout-nav):hover::after{
    width:100%;
}
        .btn-pesan-nav{
            position:relative;
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:10px 20px;
            border-radius:10px;
            font-size:13.5px;
            font-weight:600;
            color:white;
            border:1.5px solid rgba(255,255,255,0.55);
            background:transparent;
            overflow:hidden;
            transition:
                border-color .25s ease,
                color .25s ease,
                box-shadow .25s ease;
        }
        .btn-pesan-nav::before{
            content:'';
            position:absolute;
            top:0; left:-100%;
            width:70%;
            height:100%;
            background:linear-gradient(
                120deg,
                transparent 0%,
                rgba(255,255,255,0.18) 50%,
                transparent 100%
            );
            transition:left .45s ease;
            pointer-events:none;
        }
        .btn-pesan-nav:hover::before{left:150%;}
        .btn-pesan-nav .btn-arrow-icon{
            display:inline-block;
            font-size:12px;
            transition:transform .25s cubic-bezier(.34,1.56,.64,1), opacity .2s ease;
            opacity:.75;
        }
        .btn-pesan-nav:hover .btn-arrow-icon{
            transform:translateX(4px);
            opacity:1;
        }
        .btn-pesan-nav:hover{
            border-color:rgba(255,255,255,0.9);
            box-shadow:0 0 0 3px rgba(255,255,255,0.1);
        }

        .btn-user-nav{
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:7px 14px 7px 8px;
            border-radius:999px;
            border:1.5px solid rgba(255,255,255,0.28);
            color:rgba(255,255,255,0.92);
            font-size:13px;
            font-weight:500;
            transition:
                border-color .22s ease,
                background .22s ease,
                box-shadow .22s ease,
                transform .22s ease;
        }
        .btn-user-nav:hover{
            border-color:rgba(255,255,255,0.65);
            background:rgba(255,255,255,0.08);
            box-shadow:0 0 0 3px rgba(255,255,255,0.07);
            transform:translateY(-1px);
        }
        .btn-user-avatar{
            width:28px;
            height:28px;
            border-radius:50%;
            background:rgba(255,255,255,0.22);
            color:white;
            font-size:12px;
            font-weight:700;
            display:flex;
            align-items:center;
            justify-content:center;
            flex-shrink:0;
            transition:background .22s ease;
        }
        .btn-user-name{
            font-size:13px;
            font-weight:600;
            max-width:100px;
            white-space:nowrap;
            overflow:hidden;
            text-overflow:ellipsis;
            transition:color .22s ease;
        }
        .btn-user-chevron{
            font-size:10px;
            color:rgba(255,255,255,0.55);
            transition:transform .25s ease, color .22s ease;
        }
        .btn-user-nav:hover .btn-user-chevron{
            transform:rotate(180deg);
            color:rgba(255,255,255,0.85);
        }

        .btn-logout-nav{
            display:inline-flex;
            align-items:center;
            gap:6px;
            padding:8px 14px;
            border-radius:9px;
            border:1.5px solid rgba(255,255,255,0.2);
            color:rgba(255,255,255,0.65);
            font-size:13px;
            font-weight:500;
            transition:
                color .22s ease,
                border-color .22s ease,
                background .22s ease,
                transform .22s ease;
        }
        .btn-logout-nav i{
            font-size:13px;
            transition:transform .25s cubic-bezier(.34,1.56,.64,1);
        }
        .btn-logout-nav:hover i{transform:translateX(3px);}
        .btn-logout-nav:hover{
            color:#ff6b6b;
            border-color:rgba(255,100,100,0.45);
            background:rgba(255,100,100,0.08);
            transform:translateY(-1px);
        }

        /* ===== HERO ===== */
        .hero{
            min-height:100vh;
            background:
                linear-gradient(to right, rgba(0,0,0,0.72) 45%, rgba(0,0,0,0.3) 100%),
                url('<?= base_url("hero-toko.jpg") ?>') center/cover no-repeat;
            display:flex;align-items:center;
            padding:140px 60px 100px;
            position:relative;
            overflow:hidden;
        }

        .scroll-indicator{
            position:absolute;bottom:32px;left:50%;transform:translateX(-50%);
            display:flex;flex-direction:column;align-items:center;gap:10px;
            opacity:1;z-index:10;
        }
        .scroll-indicator .mouse{
            width:28px;height:44px;
            border:2.5px solid rgba(255,255,255,0.85);
            border-radius:14px;
            display:flex;justify-content:center;
            padding-top:7px;
            box-shadow:0 0 14px rgba(255,255,255,0.15);
        }
        .scroll-indicator .mouse span{
            display:block;width:4px;height:8px;
            background:white;border-radius:2px;
            animation:scrollDot 1.8s cubic-bezier(.4,0,.2,1) infinite;
        }
        .scroll-indicator .scroll-label{
            color:rgba(255,255,255,0.75);
            font-size:10px;font-weight:600;
            letter-spacing:2px;text-transform:uppercase;
        }
        @keyframes scrollDot{
            0%{opacity:1;transform:translateY(0);}
            60%{opacity:0;transform:translateY(12px);}
            61%{opacity:0;transform:translateY(0);}
            100%{opacity:1;transform:translateY(0);}
        }

        .hero-content{
    max-width:520px;
    position:relative;
    z-index:2;
    margin-top:-150px;
}
        .hero-badge{
            display:inline-block;
            background:rgba(184,134,11,0.92);color:white;
            padding:8px 20px;border-radius:8px;
            font-size:13px;font-weight:600;
            margin-bottom:28px;
            opacity:0;animation:fadeDown .7s .2s forwards;
        }
        .hero h1{
    font-size:64px;
    font-weight:800;
    color:white;
    line-height:1.08;
    letter-spacing:-1.5px;
    margin-bottom:22px;
    opacity:0;
    animation:fadeUp .8s .4s forwards;
}
        .hero p{
            color:#e5e7eb;font-size:16px;line-height:1.85;
            margin-bottom:36px;max-width:480px;
            opacity:0;animation:fadeUp .8s .6s forwards;
        }
        .hero-buttons{
            display:flex;gap:14px;flex-wrap:wrap;margin-bottom:64px;
            opacity:0;animation:fadeUp .8s .8s forwards;
        }
        .stats{
            display:flex;gap:50px;flex-wrap:wrap;
            opacity:0;animation:fadeUp .8s 1s forwards;
        }

        @keyframes fadeDown{from{opacity:0;transform:translateY(-16px);}to{opacity:1;transform:translateY(0);}}
        @keyframes fadeUp{from{opacity:0;transform:translateY(24px);}to{opacity:1;transform:translateY(0);}}

        .btn-primary-hero{
            background:#b8860b;color:white;
            padding:15px 30px;border-radius:10px;
            font-weight:600;font-size:15px;
            display:flex;align-items:center;gap:8px;
            transition:.3s;
        }
        .btn-primary-hero:hover{transform:translateY(-3px);box-shadow:0 12px 28px rgba(184,134,11,0.45);}

        .btn-secondary-hero{
            border:1.5px solid rgba(255,255,255,0.55);color:white;
            padding:15px 30px;border-radius:10px;
            font-weight:500;font-size:15px;
            display:flex;align-items:center;gap:8px;
            backdrop-filter:blur(4px);
            transition:.3s;
        }
        .btn-secondary-hero:hover{background:rgba(255,255,255,0.12);}

        .stat-num{font-size:42px;font-weight:800;color:#d4a017;margin-bottom:2px;}
        .stat-label{color:#d1d5db;font-size:13px;}

        /* ===== SCROLL REVEAL ===== */
        .reveal{
            opacity:0;
            transform:translateY(40px);
            transition:opacity .7s ease, transform .7s ease;
        }
        .reveal.visible{opacity:1;transform:translateY(0);}
        .stagger > *{
            opacity:0;
            transform:translateY(36px);
            transition:opacity .6s ease, transform .6s ease;
        }
        .stagger.visible > *:nth-child(1){opacity:1;transform:translateY(0);transition-delay:.1s;}
        .stagger.visible > *:nth-child(2){opacity:1;transform:translateY(0);transition-delay:.22s;}
        .stagger.visible > *:nth-child(3){opacity:1;transform:translateY(0);transition-delay:.34s;}
        .stagger.visible > *:nth-child(4){opacity:1;transform:translateY(0);transition-delay:.46s;}
        .stagger.visible > *:nth-child(5){opacity:1;transform:translateY(0);transition-delay:.58s;}
        .stagger.visible > *:nth-child(6){opacity:1;transform:translateY(0);transition-delay:.70s;}

        /* ===== SECTION GENERAL ===== */
        .section{padding:100px 60px;}

        .section-badge{
            display:inline-block;
            background:#fdf8e8;color:#b8860b;
            padding:7px 16px;border-radius:999px;
            font-size:12px;font-weight:600;
            margin-bottom:18px;
        }
        .section-title{
            font-size:46px;font-weight:800;
            color:#111827;line-height:1.2;margin-bottom:20px;
        }
        .section-title span{color:#b8860b;}
        .section-desc{color:#6b7280;line-height:1.85;font-size:15px;}

        /* ===== ABOUT ===== */
        .about-grid{display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;}

        .about-img-wrap{position:relative;}

        /* ===== MAPS PREVIEW ===== */
        .maps-link-wrap{
            position:relative;
            display:block;
            border-radius:20px;
            overflow:hidden;
            height:440px;
            cursor:pointer;
            box-shadow:0 20px 50px rgba(0,0,0,0.15);
            /* iframe di dalamnya pakai position absolute */
            transition:
                transform .45s cubic-bezier(.23,1,.32,1),
                box-shadow .45s cubic-bezier(.23,1,.32,1);
            text-decoration:none;
        }
        .maps-link-wrap:hover{
            transform:scale(1.03) translateY(-6px);
            box-shadow:0 32px 64px rgba(0,0,0,0.22), 0 0 0 3px rgba(184,134,11,0.35);
        }

        /* Gambar maps */
        .maps-link-wrap img{
            width:100%;
            height:100%;
            object-fit:cover;
            border-radius:20px;
            display:block;
            transition:transform .5s cubic-bezier(.23,1,.32,1), filter .4s ease;
        }
        .maps-link-wrap:hover img{
            transform:scale(1.06);
            filter:brightness(0.82);
        }

        /* Overlay gradient bawah */
        .maps-overlay{
            position:absolute;
            inset:0;
            border-radius:20px;
            background:linear-gradient(
                to top,
                rgba(0,0,0,0.68) 0%,
                rgba(0,0,0,0.18) 45%,
                transparent 100%
            );
            transition:opacity .4s ease;
        }
        .maps-link-wrap:hover .maps-overlay{
            opacity:1;
            background:linear-gradient(
                to top,
                rgba(0,0,0,0.78) 0%,
                rgba(0,0,0,0.28) 55%,
                transparent 100%
            );
        }

        /* Label lokasi di bawah */
        .maps-info{
            position:absolute;
            bottom:0;left:0;right:0;
            padding:24px 22px 22px;
            z-index:2;
        }
        .maps-info-inner{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:12px;
        }
        .maps-address{
            display:flex;
            align-items:flex-start;
            gap:10px;
        }
        .maps-pin-icon{
            width:36px;height:36px;
            border-radius:10px;
            background:linear-gradient(135deg,#b8860b,#d4a017);
            display:flex;align-items:center;justify-content:center;
            color:white;font-size:15px;
            flex-shrink:0;
            box-shadow:0 4px 12px rgba(184,134,11,0.5);
        }
        .maps-address-text strong{
            display:block;
            color:white;
            font-size:14px;
            font-weight:700;
            line-height:1.3;
        }
        .maps-address-text span{
            color:rgba(255,255,255,0.72);
            font-size:12px;
        }

        /* Tombol "Buka Maps" */
        .maps-open-btn{
            display:inline-flex;
            align-items:center;
            gap:6px;
            background:rgba(255,255,255,0.14);
            border:1.5px solid rgba(255,255,255,0.35);
            backdrop-filter:blur(8px);
            color:white;
            font-size:12px;
            font-weight:600;
            padding:8px 14px;
            border-radius:8px;
            white-space:nowrap;
            flex-shrink:0;
            transition:
                background .25s ease,
                border-color .25s ease,
                transform .25s cubic-bezier(.34,1.56,.64,1);
        }
        .maps-link-wrap:hover .maps-open-btn{
            background:rgba(184,134,11,0.9);
            border-color:#b8860b;
            transform:translateY(-2px);
        }
        .maps-open-btn i{font-size:11px;}

        /* Badge "Klik untuk buka Maps" di pojok kanan atas */
        .maps-badge-top{
            position:absolute;
            top:14px;right:14px;
            background:rgba(0,0,0,0.55);
            backdrop-filter:blur(8px);
            border:1px solid rgba(255,255,255,0.2);
            color:white;
            font-size:11px;
            font-weight:600;
            padding:6px 12px;
            border-radius:999px;
            display:flex;
            align-items:center;
            gap:6px;
            z-index:3;
            opacity:0;
            transform:translateY(-4px);
            transition:opacity .3s ease, transform .3s ease;
            pointer-events:none;
        }
        .maps-badge-top .pulse-dot{
            width:7px;height:7px;
            border-radius:50%;
            background:#4ade80;
            box-shadow:0 0 0 0 rgba(74,222,128,0.6);
            animation:pulseGreen 1.6s infinite;
            flex-shrink:0;
        }
        @keyframes pulseGreen{
            0%{box-shadow:0 0 0 0 rgba(74,222,128,0.6);}
            70%{box-shadow:0 0 0 6px rgba(74,222,128,0);}
            100%{box-shadow:0 0 0 0 rgba(74,222,128,0);}
        }
        .maps-link-wrap:hover .maps-badge-top{
            opacity:1;
            transform:translateY(0);
        }

        /* ===== ANIMASI TRANSISI KE MAPS ===== */
        /* Ripple overlay fullscreen saat diklik */
        #maps-ripple-overlay{
            position:fixed;
            inset:0;
            z-index:9999;
            pointer-events:none;
            display:flex;
            align-items:center;
            justify-content:center;
            background:transparent;
        }
        .maps-ripple-circle{
            width:0;height:0;
            border-radius:50%;
            background:radial-gradient(circle, rgba(184,134,11,0.92) 0%, rgba(7,18,38,0.96) 70%);
            transform:scale(0);
            opacity:0;
            transition:none;
        }
        .maps-ripple-circle.animate{
            animation:mapsRippleExpand .65s cubic-bezier(.4,0,.2,1) forwards;
        }
        @keyframes mapsRippleExpand{
            0%{
                width:0px;height:0px;
                transform:scale(0);
                opacity:1;
            }
            100%{
                width:300vmax;height:300vmax;
                transform:scale(1) translate(-50%,-50%);
                opacity:1;
            }
        }

        /* Icon animasi di tengah overlay */
        .maps-ripple-icon{
            position:fixed;
            inset:0;
            z-index:10000;
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            pointer-events:none;
            opacity:0;
            transition:opacity .2s ease;
        }
        .maps-ripple-icon.show{opacity:1;}
        .maps-ripple-icon i{
            font-size:48px;
            color:white;
            animation:iconPop .5s cubic-bezier(.34,1.56,.64,1) .2s both;
        }
        .maps-ripple-icon span{
            color:rgba(255,255,255,0.85);
            font-size:15px;
            font-weight:600;
            margin-top:12px;
            animation:iconPop .5s cubic-bezier(.34,1.56,.64,1) .32s both;
        }
        @keyframes iconPop{
            from{opacity:0;transform:scale(0.5);}
            to{opacity:1;transform:scale(1);}
        }

        /* iframe maps mengisi penuh container */
        .maps-link-wrap iframe{
            position:absolute;
            inset:0;
            width:100%;
            height:100%;
            border:0;
        }

        .about-text p{margin-bottom:14px;}
        .features{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-top:28px;margin-bottom:30px;}
        .feature{display:flex;align-items:center;gap:8px;font-weight:500;font-size:14px;color:#374151;}
        .feature i{color:#b8860b;}

        .btn-orange{
            display:inline-flex;align-items:center;gap:8px;
            background:#b8860b;color:white;
            padding:14px 26px;border-radius:10px;
            font-weight:600;font-size:15px;transition:.3s;
        }
        .btn-orange:hover{transform:translateY(-3px);box-shadow:0 10px 25px rgba(184,134,11,0.4);}

        /* ===== SERVICES ===== */
        .services{background:#f8fafc;}
        .services-header{text-align:center;margin-bottom:60px;}
        .services-header .section-desc{max-width:600px;margin:auto;}

        .cards-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:24px;}

        .card{
            background:white;border-radius:20px;
            padding:36px 30px;
            box-shadow:0 4px 20px rgba(0,0,0,0.06);
            border:1px solid #f1f5f9;
            border-bottom:3px solid transparent;
            position:relative;overflow:hidden;
            transition:transform .5s cubic-bezier(.23,1,.32,1),
                        box-shadow .5s cubic-bezier(.23,1,.32,1),
                        border-color .4s ease;
            cursor:pointer;
        }
        .card::before{
            content:'';
            position:absolute;
            top:0;left:-100%;
            width:60%;height:100%;
            background:linear-gradient(120deg,transparent 0%,rgba(212,160,23,0.12) 50%,transparent 100%);
            transition:left .55s cubic-bezier(.23,1,.32,1);
            pointer-events:none;
            z-index:1;
        }
        .card:hover::before{left:150%;}
        .card:hover{
            transform:translateY(-10px) scale(1.02);
            box-shadow:0 20px 45px rgba(0,0,0,0.12), 0 0 20px rgba(212,160,23,0.1);
        }
        .card.hover-brown:hover{border-bottom-color:#8B5E3C;}
        .card.hover-gray:hover{border-bottom-color:#9ca3af;}
        .card.hover-red:hover{border-bottom-color:#e53e3e;}
        .card.hover-green:hover{border-bottom-color:#00b894;}
        .card.hover-orange:hover{border-bottom-color:#b8860b;}
        .card:hover .card-icon{transform:scale(1.12);box-shadow:0 8px 20px rgba(0,0,0,0.2);}
        .card-icon{
            width:60px;height:60px;border-radius:16px;
            display:flex;align-items:center;justify-content:center;
            color:white;font-size:22px;margin-bottom:22px;
            transition:transform .4s cubic-bezier(.23,1,.32,1), box-shadow .4s ease;
        }
        .icon-orange{background:linear-gradient(135deg,#b8860b,#d4a017);}
        .icon-brown{background:linear-gradient(135deg,#8B5E3C,#a0714f);}
        .icon-gray{background:linear-gradient(135deg,#9ca3af,#cbd5e1);}
        .icon-red{background:linear-gradient(135deg,#e53e3e,#ff4d4d);}
        .icon-green{background:linear-gradient(135deg,#00b894,#00d084);}

        .card h3{font-size:18px;font-weight:700;color:#111827;margin-bottom:12px;}
        .card p{color:#6b7280;font-size:14px;line-height:1.8;}

        /* ===== ADVANTAGES ===== */
        .advantages{background:#111111;position:relative;overflow:hidden;}
        .advantages::before{
            content:'';position:absolute;
            width:500px;height:500px;
            background:radial-gradient(circle, rgba(212,160,23,0.18) 0%, transparent 70%);
            border-radius:50%;top:-150px;left:-150px;
        }
        .advantages::after{
            content:'';position:absolute;
            width:450px;height:450px;
            background:radial-gradient(circle, rgba(212,160,23,0.14) 0%, transparent 70%);
            border-radius:50%;bottom:-120px;right:-120px;
        }

        .advantages-header{text-align:center;margin-bottom:60px;position:relative;z-index:2;}
        .advantages-header .section-badge{background:rgba(255,255,255,0.18);color:white;}
        .advantages-header p{color:#f5e0a0;max-width:680px;margin:auto;line-height:1.8;font-size:15px;}

        .adv-cards{display:grid;grid-template-columns:repeat(3,1fr);gap:22px;position:relative;z-index:2;}

        .adv-card{
            background:rgba(255,255,255,0.06);
            border:1px solid rgba(255,255,255,0.12);
            backdrop-filter:blur(10px);
            border-radius:20px;
            padding:36px 28px;
            position:relative;overflow:hidden;
            transition:transform .5s cubic-bezier(.23,1,.32,1),
                        box-shadow .5s cubic-bezier(.23,1,.32,1),
                        background .5s ease,
                        border-color .5s ease;
        }
        .adv-card::before{
            content:'';position:absolute;top:0;left:-100%;width:60%;height:100%;
            background:linear-gradient(120deg,transparent 0%,rgba(212,160,23,0.18) 50%,transparent 100%);
            transition:left .55s cubic-bezier(.23,1,.32,1);pointer-events:none;
        }
        .adv-card:hover::before{left:150%;}
        .adv-card::after{
            content:'';position:absolute;inset:0;border-radius:20px;
            border:1.5px solid rgba(212,160,23,0);
            transition:border-color .5s ease, box-shadow .5s ease;pointer-events:none;
        }
        .adv-card:hover::after{
            border-color:rgba(212,160,23,0.5);
            box-shadow:inset 0 0 20px rgba(212,160,23,0.06);
        }
        .adv-card:hover{
            transform:translateY(-12px) scale(1.02);
            background:rgba(255,255,255,0.1);
            box-shadow:0 28px 50px rgba(0,0,0,0.35), 0 0 30px rgba(212,160,23,0.15);
            border-color:rgba(212,160,23,0.3);
        }
        .adv-icon{
            width:52px;height:52px;border-radius:14px;
            background:rgba(255,255,255,0.12);
            display:flex;align-items:center;justify-content:center;
            color:#d4a017;font-size:20px;margin-bottom:22px;
            transition:background .4s ease, box-shadow .4s ease, transform .4s ease;
        }
        .adv-card:hover .adv-icon{
            background:rgba(212,160,23,0.2);
            box-shadow:0 0 16px rgba(212,160,23,0.4);
            transform:scale(1.1);
        }
        .adv-card h3{color:white;font-size:18px;font-weight:700;margin-bottom:10px;}
        .adv-card p{color:#f5e0a0;font-size:14px;line-height:1.8;}

        /* ===== FAQ ===== */
        .faq-section{background:#fff;}
        .faq-header{text-align:center;margin-bottom:50px;}

        .faq-list{max-width:750px;margin:0 auto;display:flex;flex-direction:column;gap:14px;}

        .faq-item{border:1px solid #e5e7eb;border-radius:14px;overflow:hidden;}

        .faq-question{
            width:100%;padding:20px 24px;
            background:white;border:none;cursor:pointer;
            display:flex;justify-content:space-between;align-items:center;
            font-size:15px;font-weight:500;color:#111827;
            text-align:left;transition:.2s;
        }
        .faq-question:hover{background:#f9fafb;}
        .faq-question i{color:#9ca3af;transition:.3s;flex-shrink:0;}
        .faq-question.open i{transform:rotate(180deg);color:#b8860b;}

        .faq-answer{
            max-height:0;overflow:hidden;
            transition:max-height .35s ease, padding .3s;
            padding:0 24px;
            color:#6b7280;font-size:14px;line-height:1.8;
            background:white;
        }
        .faq-answer.open{max-height:200px;padding:0 24px 20px;}

        /* ===== CTA ===== */
        .cta{
            background:#071226;text-align:center;
            color:white;position:relative;overflow:hidden;
        }
        .cta::before{
            content:'';position:absolute;
            width:400px;height:400px;
            background:#b8860b;filter:blur(160px);
            opacity:0.12;top:-100px;left:-100px;
        }
        .cta-content{position:relative;z-index:2;max-width:750px;margin:auto;}
        .cta h2{font-size:52px;font-weight:800;margin-bottom:20px;}
        .cta p{color:#cbd5e1;font-size:17px;line-height:1.8;margin-bottom:40px;}

        .cta-buttons{display:flex;justify-content:center;gap:16px;flex-wrap:wrap;}
        .btn-wa{
            background:#00c853;color:white;
            padding:16px 32px;border-radius:12px;font-weight:600;
            display:flex;align-items:center;gap:8px;transition:.3s;
        }
        .btn-wa:hover{transform:translateY(-3px);}
        .btn-phone{
            border:1.5px solid rgba(255,255,255,0.35);color:white;
            padding:16px 32px;border-radius:12px;
            display:flex;align-items:center;gap:8px;transition:.3s;
        }
        .btn-phone:hover{background:rgba(255,255,255,0.08);}

        /* ===== FOOTER ===== */
        .footer{
            background:#071226;color:white;
            padding:70px 60px 40px;
            border-top:1px solid rgba(255,255,255,0.07);
        }
        .footer-grid{
            display:grid;grid-template-columns:1.4fr 1fr 1.2fr 1.3fr;
            gap:40px;margin-bottom:50px;
        }
        .footer-logo{display:flex;align-items:center;gap:12px;margin-bottom:16px;}
        .footer-logo .logo-icon{width:42px;height:42px;font-size:18px;}
        .footer-logo .logo-text strong{color:white;font-size:14px;}
        .footer-logo .logo-text span{color:#b8860b;}

        .footer p{color:#94a3b8;line-height:1.9;font-size:14px;}
        .footer-wa{
            display:inline-flex;align-items:center;gap:8px;
            color:#4ade80;font-size:14px;font-weight:500;margin-top:14px;
        }
        .footer h4{font-size:15px;font-weight:700;margin-bottom:16px;color:white;}
        .footer ul{list-style:none;}
        .footer li{color:#94a3b8;font-size:14px;line-height:2.2;}
        .footer li a{color:#94a3b8;transition:.2s;}
        .footer li a:hover{color:#b8860b;}
        .footer-contact li{display:flex;align-items:flex-start;gap:10px;margin-bottom:10px;}
        .footer-contact i{color:#b8860b;margin-top:4px;min-width:14px;}

        .copyright{
            text-align:center;color:#475569;
            font-size:13px;padding-top:30px;
            border-top:1px solid rgba(255,255,255,0.07);
            display:flex;justify-content:space-between;
        }

        /* ===== RESPONSIVE ===== */
        @media(max-width:1024px){
            .navbar{padding:14px 24px;}
            .hero{padding:120px 24px 80px;}
            .hero h1{font-size:44px;}
            .section{padding:80px 24px;}
            .about-grid{grid-template-columns:1fr;gap:40px;}
            .adv-cards{grid-template-columns:1fr 1fr;}
            .footer-grid{grid-template-columns:1fr 1fr;}
            .section-title{font-size:34px;}
            .cta h2{font-size:36px;}
        }
        @media(max-width:640px){
            .menu > a:not(.btn-pesan-nav):not(.btn-user-nav):not(.btn-logout-nav){display:none;}
            .hero h1{
    font-size:44px;
    line-height:1.1;
    letter-spacing:-1px;
}
            .adv-cards{grid-template-columns:1fr;}
            .footer-grid{grid-template-columns:1fr;}
            .copyright{flex-direction:column;gap:8px;text-align:center;}
            .stats{gap:28px;}
            .stat-num{font-size:32px;}
            .btn-user-name{display:none;}
            .maps-link-wrap{height:300px;}
        }
    </style>
</head>
<body>

    <!-- MAPS RIPPLE OVERLAY -->
    <div id="maps-ripple-overlay">
        <div class="maps-ripple-circle" id="mapsRippleCircle"></div>
    </div>
    <div class="maps-ripple-icon" id="mapsRippleIcon">
        <i class="fa-solid fa-location-dot"></i>
        <span>Membuka Google Maps...</span>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar" id="navbar">
        <div class="logo">
            <img src="<?= base_url('logo_png.png') ?>" alt="PSG Logo" class="main-logo">
            <div class="logo-text">
                <strong>PUTRA SUMEDANG GRUB</strong>
                <span>KUSEN & CAT TERPERCAYA</span>
            </div>
        </div>

        <div class="menu">

            <a href="#beranda">Beranda</a>
            <a href="#tentang">Tentang</a>
            <a href="#layanan">Layanan</a>
            <a href="#faq">FAQ</a>
            <a href="#contact">Kontak</a>

            <?php if(session()->get('logged_in_user')): ?>

                <a href="<?= base_url('produk-user') ?>" class="btn-user-nav">
                    <span class="btn-user-avatar">
                        <?= strtoupper(substr(session()->get('user_nama'), 0, 1)) ?>
                    </span>
                    <span class="btn-user-name"><?= session()->get('user_nama') ?></span>
                    <i class="fa-solid fa-chevron-down btn-user-chevron"></i>
                </a>

                <a href="<?= base_url('logout-user') ?>" class="btn-logout-nav">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Keluar</span>
                </a>

            <?php else: ?>

                <a href="<?= base_url('login') ?>" class="btn-pesan-nav">
                    <span>Pesan Sekarang</span>
                    <i class="fa-solid fa-arrow-right btn-arrow-icon"></i>
                </a>

            <?php endif; ?>

        </div>
    </nav>

    <!-- HERO -->
    <section class="hero" id="beranda">
        <div class="hero-content">
            <span class="hero-badge">Melayani Sejak 2010 · Sumedang</span>
            <h1>Kusen Kuat, Cat Tahan Lama — Harga Langsung dari Pengrajin</h1>
            <p>Kusen kayu jati, aluminium & UPVC, plus cat tembok berbagai merek. Langsung dari toko kami — tanpa perantara, harga lebih hemat.</p>
            <div class="hero-buttons">
                <a href="<?= base_url('produk-user') ?>" class="btn-primary-hero">
                    Pesan Sekarang <i class="fa-solid fa-arrow-right"></i>
                </a>
                <a href="https://wa.me/6282218967866?text=Halo%20saya%20ingin%20bertanya%20tentang%20produk"
                   target="_blank"
                   class="btn-secondary-hero">
                    <i class="fa-brands fa-whatsapp"></i>
                    Hubungi WhatsApp
                </a>
            </div>
            <div class="stats">
                <div>
                    <div class="stat-num">15+</div>
                    <div class="stat-label">Tahun Pengalaman</div>
                </div>
                <div>
                    <div class="stat-num"><?= $stat_proyek_selesai ?>+</div>
                    <div class="stat-label">Proyek Selesai</div>
                </div>
                <div>
                    <div class="stat-num"><?= $stat_pelanggan ?>+</div>
                    <div class="stat-label">Pelanggan Puas</div>
                </div>
                <div>
                    <div class="stat-num"><?= $stat_produk ?>+</div>
                    <div class="stat-label">Produk Tersedia</div>
                </div>
            </div>
        </div>
        <div class="scroll-indicator">
            <div class="mouse"><span></span></div>
            <div class="scroll-label">Scroll</div>
        </div>
    </section>

    <!-- ABOUT -->
    <section class="section" id="tentang">
        <div class="about-grid">
            <div class="about-text reveal">
                <span class="section-badge">Tentang Kami</span>
                <h2 class="section-title">Toko Kusen & Cat <span>Lokal</span> yang Sudah Teruji 15 Tahun</h2>
                <p class="section-desc"><strong>Toko Kusen & Cat Berkah Jaya</strong> bukan toko baru. Sudah 15 tahun kami melayani warga Sumedang dan sekitarnya — mulai dari renovasi rumah sederhana sampai proyek gedung. Stok kami lengkap: kusen kayu jati, aluminium, UPVC, hingga cat tembok berbagai merek.</p>
                <p class="section-desc" style="margin-top:14px;">Beli langsung ke toko = harga lebih miring dari toko online. Tim kami siap bantu ukur, pilih material, sampai pasang — gratis konsultasi.</p>
                <div class="features">
                    <div class="feature"><i class="fa-solid fa-circle-check"></i> Material Premium</div>
                    <div class="feature"><i class="fa-solid fa-circle-check"></i> Harga Bersaing</div>
                    <div class="feature"><i class="fa-solid fa-circle-check"></i> Garansi Resmi</div>
                    <div class="feature"><i class="fa-solid fa-circle-check"></i> Tim Profesional</div>
                </div>
                <a href="<?= base_url('produk-user') ?>" class="btn-orange">Pesan Sekarang <i class="fa-solid fa-arrow-right"></i></a>
            </div>

            <!-- ===== MAPS PREVIEW (menggantikan foto pekerja) ===== -->
            <div class="about-img-wrap reveal" style="transition-delay:.2s;">
                <a
                    href="https://maps.app.goo.gl/1ZYyoyfrzSaHiv4L7?g_st=aw"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="maps-link-wrap"
                    id="mapsLink"
                    title="Buka Lokasi di Google Maps"
                >
                    <!-- Badge hover kiri atas -->
                    <div class="maps-badge-top">
                        <span class="pulse-dot"></span>
                        Klik untuk buka Maps
                    </div>

                    <!-- Google Maps Embed langsung — tidak perlu file gambar -->
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d991.6748406694997!2d107.91822!3d-6.84722!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68b9ad2a3e9f4f%3A0x0!2zNsKwNTAnNDkuOSJTIDEwN8KwNTUnMDUuNiJF!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                        width="100%"
                        height="100%"
                        style="border:0;display:block;pointer-events:none;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Lokasi Putra Sumedang Grub"
                    ></iframe>

                    <!-- Gradient overlay -->
                    <div class="maps-overlay"></div>

                    <!-- Info lokasi di bawah -->
                    <div class="maps-info">
                        <div class="maps-info-inner">
                            <div class="maps-address">
                                <div class="maps-pin-icon">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div class="maps-address-text">
                                    <strong>Putra Sumedang Grub</strong>
                                    <span>Jl. Raya Utama No. 123, Jakarta Selatan</span>
                                </div>
                            </div>
                            <div class="maps-open-btn">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                Buka Maps
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- ===== END MAPS PREVIEW ===== -->

        </div>
    </section>

    <!-- SERVICES -->
    <section class="services section" id="layanan">
        <div class="services-header reveal">
            <span class="section-badge">Layanan Kami</span>
            <h2 class="section-title">Apa yang Kami <span>Tawarkan</span></h2>
            <p class="section-desc">Kami menyediakan berbagai layanan terbaik untuk memenuhi kebutuhan kusen dan cat rumah Anda.</p>
        </div>
        <div class="cards-grid stagger">
            <div class="card hover-brown">
                <div class="card-icon icon-brown"><i class="fa-solid fa-door-open"></i></div>
                <h3>Kusen Pintu</h3>
                <p>Berbagai pilihan kusen pintu berkualitas tinggi dari kayu jati, aluminium, dan UPVC untuk keamanan dan estetika rumah Anda.</p>
            </div>
            <div class="card hover-gray">
                <div class="card-icon icon-gray"><i class="fa-solid fa-window-maximize"></i></div>
                <h3>Kusen Jendela</h3>
                <p>Kusen jendela modern dan klasik dengan material premium. Tahan lama, anti karat, dan desain yang elegan.</p>
            </div>
            <div class="card hover-red">
                <div class="card-icon icon-red"><i class="fa-solid fa-paint-roller"></i></div>
                <h3>Cat Tembok</h3>
                <p>Pilihan cat tembok terlengkap untuk interior dan eksterior. Merek terpercaya dengan daya tutup tinggi.</p>
            </div>
            <div class="card hover-green">
                <div class="card-icon icon-green"><i class="fa-solid fa-ruler-combined"></i></div>
                <h3>Konsultasi & Ukur</h3>
                <p>Layanan konsultasi gratis dan pengukuran ke lokasi. Kami bantu pilih material yang tepat untuk kebutuhan Anda.</p>
            </div>
        </div>
    </section>

    <!-- ADVANTAGES -->
    <section class="advantages section">
        <div class="advantages-header reveal">
            <span class="section-badge">Kenapa Pilih Kami</span>
            <h2 class="section-title" style="color:white;">Keunggulan <span style="color:#f0d080;">Berkah Jaya</span></h2>
            <p>Berikut alasan mengapa pelanggan mempercayakan kebutuhan kusen dan cat mereka kepada kami.</p>
        </div>
        <div class="adv-cards stagger">
            <div class="adv-card">
                <div class="adv-icon"><i class="fa-solid fa-award"></i></div>
                <h3>Kualitas Premium</h3>
                <p>Material pilihan berkualitas tinggi dengan garansi produk untuk setiap pembelian.</p>
            </div>
            <div class="adv-card">
                <div class="adv-icon"><i class="fa-solid fa-truck-fast"></i></div>
                <h3>Pengiriman Cepat</h3>
                <p>Layanan pengiriman yang cepat dan aman ke seluruh area Jabodetabek dan sekitarnya.</p>
            </div>
            <div class="adv-card">
                <div class="adv-icon"><i class="fa-solid fa-shield-halved"></i></div>
                <h3>Garansi Resmi</h3>
                <p>Setiap produk dilengkapi garansi resmi dari produsen untuk ketenangan Anda.</p>
            </div>
            <div class="adv-card">
                <div class="adv-icon"><i class="fa-solid fa-headset"></i></div>
                <h3>Layanan Konsultasi</h3>
                <p>Tim ahli kami siap memberikan konsultasi gratis untuk kebutuhan kusen dan cat Anda.</p>
            </div>
            <div class="adv-card">
                <div class="adv-icon"><i class="fa-solid fa-clock"></i></div>
                <h3>Pengerjaan Tepat Waktu</h3>
                <p>Komitmen waktu pengerjaan yang disepakati tanpa mengorbankan kualitas.</p>
            </div>
            <div class="adv-card">
                <div class="adv-icon"><i class="fa-solid fa-tag"></i></div>
                <h3>Harga Kompetitif</h3>
                <p>Harga terbaik di pasaran dengan kualitas yang tidak perlu diragukan lagi.</p>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="faq-section section" id="faq">
        <div class="faq-header reveal">
            <span class="section-badge">FAQ</span>
            <h2 class="section-title">Pertanyaan yang <span>Sering Diajukan</span></h2>
            <p class="section-desc">Temukan jawaban untuk pertanyaan umum tentang produk dan layanan kami.</p>
        </div>
        <div class="faq-list stagger">
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Apakah tersedia layanan pemasangan kusen?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">Ya, kami menyediakan layanan pemasangan kusen oleh tim profesional berpengalaman. Biaya pemasangan akan disesuaikan dengan jenis dan jumlah kusen yang dipasang.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Bagaimana cara melakukan pemesanan?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">Anda dapat memesan melalui WhatsApp, telepon, atau langsung datang ke toko kami. Tim kami akan membantu proses pemesanan dari awal hingga produk sampai ke tangan Anda.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Apakah bisa custom ukuran kusen?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">Tentu bisa! Kami melayani custom ukuran sesuai kebutuhan Anda. Tim kami akan melakukan pengukuran langsung ke lokasi untuk memastikan ketepatan ukuran.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Berapa lama proses pengiriman?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">Untuk area Jabodetabek, pengiriman biasanya memakan waktu 1-3 hari kerja. Untuk area luar Jabodetabek, estimasi pengiriman 3-7 hari kerja tergantung jarak dan ketersediaan ekspedisi.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Apakah ada garansi produk?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">Ya, semua produk kami dilengkapi garansi resmi dari produsen. Garansi kusen biasanya 1-2 tahun untuk material dan pengerjaan, sedangkan cat mengikuti garansi dari masing-masing merek.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleFaq(this)">
                    Bagaimana cara cek status pesanan?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">Anda dapat mengecek status pesanan melalui WhatsApp dengan menyebutkan nomor pesanan Anda. Tim kami akan memberikan update secara berkala mengenai progres pesanan Anda.</div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta" style="padding:60px 60px;" id="contact">
        <div class="cta-content reveal">
            <h2>Siap Wujudkan Rumah Impian Anda?</h2>
            <p>Hubungi kami sekarang untuk konsultasi gratis dan dapatkan penawaran terbaik untuk kebutuhan kusen dan cat Anda.</p>
            <div class="cta-buttons">
                <a href="https://wa.me/<?= $setting['no_wa'] ?? '6282218967866'; ?>" target="_blank" class="btn-wa">
                    <i class="fa-brands fa-whatsapp"></i> Chat via WhatsApp
                </a>
                <a href="https://wa.me/<?= $setting['no_wa'] ?? '6282218967866'; ?>"
                   target="_blank"
                   class="btn-phone">
                    <i class="fa-brands fa-whatsapp"></i>
                    <?= $setting['no_telp'] ?? '0822-1896-7866'; ?>
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-grid">
            <div>
                <div class="footer-logo">
                    <img src="<?= base_url('logo_png.png') ?>" alt="PSG Logo" class="main-logo">
                    <div class="logo-text">
                        <strong>PUTRA SUMEDANG GRUB</strong>
                        <span>KUSEN & CAT TERPERCAYA</span>
                    </div>
                </div>
                <p>Menyediakan berbagai macam kusen berkualitas tinggi dan cat tembok terbaik untuk rumah impian Anda.</p>
                <a href="https://wa.me/<?= $setting['no_wa'] ?? '6282218967866'; ?>" target="_blank" class="footer-wa">
                    <i class="fa-brands fa-whatsapp"></i> Chat WhatsApp
                </a>
            </div>
            <div>
                <h4>MENU</h4>
                <ul>
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#">Produk</a></li>
                    <li><a href="#">Buat Pesanan</a></li>
                    <li><a href="#">Riwayat Pesanan</a></li>
                </ul>
            </div>
            <div>
                <h4>KATEGORI PRODUK</h4>
                <ul>
                    <li><a href="#">Kusen Pintu Kayu Jati</a></li>
                    <li><a href="#">Kusen Jendela Aluminium</a></li>
                    <li><a href="#">Kusen Pintu UPVC</a></li>
                    <li><a href="#">Cat Tembok Interior</a></li>
                    <li><a href="#">Cat Tembok Eksterior</a></li>
                    <li><a href="#">Cat Kayu & Besi</a></li>
                </ul>
            </div>
            <div>
                <h4>HUBUNGI KAMI</h4>
                <ul class="footer-contact">
                    <li><i class="fa-solid fa-phone"></i> <?= $setting['no_telp'] ?? '0822-1896-7866'; ?></li>
                    <li>
                        <a href="https://wa.me/<?= $setting['no_wa'] ?? '6282218967866'; ?>" target="_blank" style="color:inherit;">
                            <i class="fa-brands fa-whatsapp"></i> WhatsApp
                        </a>
                    </li>
                    <li><i class="fa-solid fa-envelope"></i> <?= $setting['email_toko'] ?? 'admin@kusencat.com'; ?></li>
                    <li><i class="fa-solid fa-location-dot"></i> <?= $setting['alamat_toko'] ?? 'Jl. Raya Utama No. 123, Jakarta Selatan'; ?></li>
                    <li><i class="fa-solid fa-clock"></i> <?= $setting['jam_operasional'] ?? 'Senin – Sabtu: 08:00 – 17:00 | Minggu: Tutup'; ?></li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <span>© 2026 Putra Sumedang Grub. Semua hak dilindungi.</span>
            <span>Dibuat dengan dedikasi untuk pelanggan kami.</span>
        </div>
    </footer>

    <script>
        // ===== NAVBAR scroll effect =====
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 60);
        });

        // ===== SCROLL REVEAL =====
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.reveal, .stagger').forEach(el => observer.observe(el));

        // ===== FAQ =====
        function toggleFaq(btn) {
            const answer = btn.nextElementSibling;
            const isOpen = btn.classList.contains('open');
            document.querySelectorAll('.faq-question').forEach(q => {
                q.classList.remove('open');
                q.nextElementSibling.classList.remove('open');
            });
            if (!isOpen) {
                btn.classList.add('open');
                answer.classList.add('open');
            }
        }

        // ===== ANIMASI TRANSISI MAPS =====
        const mapsLink      = document.getElementById('mapsLink');
        const rippleCircle  = document.getElementById('mapsRippleCircle');
        const rippleIcon    = document.getElementById('mapsRippleIcon');
        const mapsUrl       = 'https://maps.app.goo.gl/1ZYyoyfrzSaHiv4L7?g_st=aw';

        mapsLink.addEventListener('click', function(e) {
            e.preventDefault(); // tahan dulu, animasi dulu

            // Posisikan lingkaran ripple di tengah elemen yang diklik
            const rect   = mapsLink.getBoundingClientRect();
            const cx     = rect.left + rect.width  / 2;
            const cy     = rect.top  + rect.height / 2;

            // Reset
            rippleCircle.classList.remove('animate');
            rippleCircle.style.left = cx + 'px';
            rippleCircle.style.top  = cy + 'px';
            rippleCircle.style.marginLeft = '0';
            rippleCircle.style.marginTop  = '0';
            rippleCircle.style.position   = 'fixed';
            rippleCircle.style.transform  = 'translate(-50%, -50%) scale(0)';
            rippleCircle.style.width      = '0';
            rippleCircle.style.height     = '0';

            // Paksa reflow biar animasi mulai dari awal
            void rippleCircle.offsetWidth;

            // Jalankan animasi
            rippleCircle.classList.add('animate');

            // Tampilkan icon di tengah layar
            setTimeout(() => {
                rippleIcon.classList.add('show');
            }, 200);

            // Buka Maps setelah animasi selesai (~650ms) + sedikit jeda
            setTimeout(() => {
                window.open(mapsUrl, '_blank', 'noopener,noreferrer');
                // Reset overlay
                setTimeout(() => {
                    rippleCircle.classList.remove('animate');
                    rippleIcon.classList.remove('show');
                }, 400);
            }, 750);
        });
    </script>

</body>
</html>