<?= view('Backend/Template/header'); ?>

<style>

.profile-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 4px 24px rgba(0,0,0,0.08);
}

.profile-banner{
    height:110px;
    background:linear-gradient(135deg, #1a3a5c 0%, #2196a6 100%);
    position:relative;
}

.profile-banner::after{
    content:'';
    position:absolute;
    bottom:-1px;
    left:0;
    right:0;
    height:40px;
    background:white;
    border-radius:50% 50% 0 0 / 100% 100% 0 0;
}

.profile-avatar-wrap{
    position:relative;
    z-index:2;
    margin-top:-52px;
    display:flex;
    justify-content:center;
}

.profile-avatar{
    width:96px;
    height:96px;
    border-radius:50%;
    background:white;
    box-shadow:0 4px 20px rgba(26,58,92,0.25);
    border:4px solid white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:38px;
    font-weight:800;
    color:#1a3a5c;
    letter-spacing:-1px;
}

.profile-name{
    text-align:center;
    margin-top:14px;
    font-size:20px;
    font-weight:800;
    color:#111827;
    letter-spacing:-0.3px;
}

.profile-role-badge{
    display:inline-flex;
    align-items:center;
    gap:6px;
    background:#e8f4f8;
    color:#1a3a5c;
    border-radius:20px;
    padding:5px 14px;
    font-size:12px;
    font-weight:700;
    margin-top:6px;
}

.profile-divider{
    height:1px;
    background:linear-gradient(to right, transparent, #f1f5f9, transparent);
    margin:20px 0;
}

.profile-info-list{
    padding:0 8px 8px;
    display:flex;
    flex-direction:column;
    gap:4px;
}

.profile-info-item{
    display:flex;
    align-items:center;
    gap:14px;
    padding:12px 14px;
    border-radius:12px;
    transition:.2s;
}

.profile-info-item:hover{
    background:#f8fafc;
}

.profile-info-icon{
    width:38px;
    height:38px;
    min-width:38px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:15px;
}

.icon-navy{
    background:#1a3a5c;
    color:#ffffff;
}

.icon-blue{
    background:#3b82f6;
    color:#ffffff;
}

.icon-green{
    background:#16a34a;
    color:#ffffff;
}

.icon-purple{
    background:#7c3aed;
    color:#ffffff;
}

.icon-gold{
    background:#d97706;
    color:#ffffff;
}

.profile-info-content{
    display:flex;
    flex-direction:column;
    gap:2px;
    min-width:0;
    flex:1;
}

.profile-info-label{
    font-size:11px;
    font-weight:600;
    color:#9ca3af;
    text-transform:uppercase;
    letter-spacing:0.5px;
    line-height:1;
}

.profile-info-value{
    font-size:13.5px;
    font-weight:600;
    color:#111827;
    word-break:break-word;
    line-height:1.4;
}

.profile-info-value.empty{
    color:#d1d5db;
    font-style:italic;
    font-weight:400;
}

</style>

<div class="container-fluid">

    <h1 class="h3 mb-1 text-gray-800 fw-bold">
        Profil Saya
    </h1>

    <p class="mb-4 text-muted">
        Kelola informasi profil Anda
    </p>

    <div class="row">

        <!-- PROFILE CARD KIRI -->
        <div class="col-lg-4">

            <div class="card profile-card mb-4">

                <div class="profile-banner"></div>

                <div class="card-body pt-0">

                    <div class="profile-avatar-wrap">
                        <div class="profile-avatar">
                            <?= strtoupper(substr($admin['name'], 0, 1)) ?>
                        </div>
                    </div>

                    <div class="profile-name">
                        <?= esc($admin['name']) ?>
                    </div>

                    <div class="text-center">
                        <span class="profile-role-badge">
                            <i class="fas fa-shield-alt"></i>
                            <?= esc($admin['username']) ?>
                        </span>
                    </div>

                    <div class="profile-divider"></div>

                    <div class="profile-info-list">

                        <div class="profile-info-item">
                            <div class="profile-info-icon icon-navy">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="profile-info-content">
                                <span class="profile-info-label">Username</span>
                                <span class="profile-info-value">
                                    <?= esc($admin['username']) ?>
                                </span>
                            </div>
                        </div>

                        <div class="profile-info-item">
                            <div class="profile-info-icon icon-blue">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="profile-info-content">
                                <span class="profile-info-label">Email</span>
                                <span class="profile-info-value">
                                    <?= esc($admin['email']) ?>
                                </span>
                            </div>
                        </div>

                        <div class="profile-info-item">
                            <div class="profile-info-icon icon-green">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="profile-info-content">
                                <span class="profile-info-label">Telepon</span>
                                <span class="profile-info-value <?= empty($admin['phone']) ? 'empty' : '' ?>">
                                    <?= !empty($admin['phone']) ? esc($admin['phone']) : 'Belum diisi' ?>
                                </span>
                            </div>
                        </div>

                        <div class="profile-info-item">
                            <div class="profile-info-icon icon-purple">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="profile-info-content">
                                <span class="profile-info-label">Alamat</span>
                                <span class="profile-info-value <?= empty($admin['address']) ? 'empty' : '' ?>">
                                    <?= !empty($admin['address']) ? esc($admin['address']) : 'Belum diisi' ?>
                                </span>
                            </div>
                        </div>

                        <div class="profile-info-item">
                            <div class="profile-info-icon icon-gold">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="profile-info-content">
                                <span class="profile-info-label">Bergabung sejak</span>
                                <span class="profile-info-value">
                                    <?= date('d M Y, H:i', strtotime($admin['created_at'])) ?>
                                </span>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- FORM KANAN -->
        <div class="col-lg-8">

            <div class="card shadow border-0 mb-4">

                <div class="card-body">

                    <h3 class="fw-bold mb-2">
                        Edit Informasi Profil
                    </h3>

                    <p class="text-muted mb-4">
                        Perbarui data profil Anda di bawah ini
                    </p>

                    <form action="<?= base_url('profil/update'); ?>" method="post">

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Nama Lengkap</label>
                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       value="<?= $admin['name']; ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email"
                                       name="email"
                                       class="form-control"
                                       value="<?= $admin['email']; ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>No. Telepon</label>
                                <input type="text"
                                       name="phone"
                                       class="form-control"
                                       value="<?= $admin['phone'] ?? ''; ?>">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Jenis Kelamin</label>
                                <select name="gender" class="form-control">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Alamat</label>
                                <textarea name="address"
                                          class="form-control"
                                          rows="3"><?= $admin['address'] ?? ''; ?></textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Username</label>
                                <input type="text"
                                       name="username"
                                       class="form-control"
                                       value="<?= $admin['username']; ?>">
                            </div>

                        </div>

                        <button class="btn btn-primary">
                            Simpan Perubahan
                        </button>

                    </form>

                </div>

            </div>

            <!-- PASSWORD -->
            <div class="card shadow border-0">

                <div class="card-body">

                    <h3 class="fw-bold mb-2">
                        Ganti Password
                    </h3>

                    <p class="text-muted mb-4">
                        Pastikan password baru Anda kuat dan mudah diingat
                    </p>

                    <form action="<?= base_url('profil/password'); ?>" method="post">

                        <div class="mb-3">
                            <label>Password Saat Ini</label>
                            <input type="password"
                                   name="password_lama"
                                   class="form-control">
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Password Baru</label>
                                <input type="password"
                                       name="password_baru"
                                       class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Konfirmasi Password</label>
                                <input type="password"
                                       name="konfirmasi_password"
                                       class="form-control">
                            </div>

                        </div>

                        <button class="btn btn-danger">
                            Ganti Password
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?= view('Backend/Template/footer'); ?>