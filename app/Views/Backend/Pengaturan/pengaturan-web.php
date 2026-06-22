<?= view('Backend/Template/header'); ?>

<!-- PAGE TITLE -->
<div class="d-flex align-items-center mb-4">
    <div style="
        width:44px; height:44px;
        background: linear-gradient(135deg, #b8860b, #f0c040);
        border-radius:12px;
        display:flex; align-items:center; justify-content:center;
        margin-right:14px;
        box-shadow: 0 4px 12px rgba(184,134,11,0.3);
    ">
        <i class="fas fa-cogs" style="color:#1a1008; font-size:18px;"></i>
    </div>
    <div>
        <h1 class="h4 mb-0" style="font-weight:800; color:#1a1008;">Pengaturan</h1>
        <p class="mb-0" style="font-size:13px; color:#9a8060;">Kelola pengaturan toko dan data admin</p>
    </div>
</div>

<!-- ALERT -->
<?php if(session()->getFlashdata('success')) : ?>
    <div class="alert alert-success mb-4">
        <i class="fas fa-check-circle mr-2"></i>
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>
<?php if(session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger mb-4">
        <i class="fas fa-exclamation-circle mr-2"></i>
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>

<div class="row">

    <!-- ===== KIRI: PENGATURAN TOKO ===== -->
    <div class="col-lg-5 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="fas fa-store mr-2" style="color:#b8860b;"></i>
                    <span style="font-weight:700; color:#1a1008;">Pengaturan Toko</span>
                </div>
                <span style="
                    background:#fef3c7; color:#b8860b;
                    font-size:11px; font-weight:700;
                    padding:4px 12px; border-radius:20px;
                    border:1px solid #f0c040;
                ">
                    <i class="fas fa-pen mr-1"></i> Mode Edit
                </span>
            </div>
            <div class="card-body">
                <form action="<?= base_url('pengaturan/update'); ?>" method="post">

                    <div style="
                        background:#fef9e7; border:1px solid #f0e6c8;
                        border-radius:10px; padding:10px 14px;
                        margin-bottom:16px; font-size:12px; color:#9a7030;
                        display:flex; align-items:center; gap:8px;
                    ">
                        <i class="fas fa-link" style="color:#b8860b;"></i>
                        Data ini terhubung langsung ke <strong>footer website</strong> — perubahan akan langsung tampil di halaman utama.
                    </div>

                    <div class="form-group mb-3">
                        <label style="font-size:13px; font-weight:600; color:#3d2a0a;">Nama Toko</label>
                        <input type="text" name="nama_toko" class="form-control"
                               value="<?= $setting['nama_toko'] ?? ''; ?>"
                               placeholder="Masukkan nama toko">
                    </div>

                    <div class="form-group mb-3">
                        <label style="font-size:13px; font-weight:600; color:#3d2a0a;">Alamat Toko</label>
                        <textarea name="alamat_toko" class="form-control" rows="3"
                                  placeholder="Masukkan alamat toko"><?= $setting['alamat_toko'] ?? ''; ?></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label style="font-size:13px; font-weight:600; color:#3d2a0a;">No. Telepon</label>
                        <input type="text" name="no_telp" class="form-control"
                               value="<?= $setting['no_telp'] ?? ''; ?>"
                               placeholder="Contoh: 08123456789">
                    </div>

                    <div class="form-group mb-3">
                        <label style="font-size:13px; font-weight:600; color:#3d2a0a;">No. WhatsApp</label>
                        <div style="position:relative;">
                            <span style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#25D366; font-size:15px;">
                                <i class="fab fa-whatsapp"></i>
                            </span>
                            <input type="text" name="no_wa" class="form-control" style="padding-left:34px;"
                                   value="<?= $setting['no_wa'] ?? ''; ?>"
                                   placeholder="Contoh: 6282218967866 (format internasional)">
                        </div>
                        <small style="color:#9a8060; font-size:11px;">Gunakan format internasional tanpa + (contoh: 6282218967866)</small>
                    </div>

                    <div class="form-group mb-3">
                        <label style="font-size:13px; font-weight:600; color:#3d2a0a;">Email Toko</label>
                        <input type="email" name="email_toko" class="form-control"
                               value="<?= $setting['email_toko'] ?? ''; ?>"
                               placeholder="Contoh: toko@email.com">
                    </div>

                    <div class="form-group mb-3">
                        <label style="font-size:13px; font-weight:600; color:#3d2a0a;">Jam Operasional</label>
                        <input type="text" name="jam_operasional" class="form-control"
                               value="<?= $setting['jam_operasional'] ?? ''; ?>"
                               placeholder="Contoh: Senin – Sabtu: 08:00 – 17:00 | Minggu: Tutup">
                        <small style="color:#9a8060; font-size:11px;">Akan ditampilkan di footer website</small>
                    </div>

                    <div class="form-group mb-4">
                        <label style="font-size:13px; font-weight:600; color:#3d2a0a;">Deskripsi Toko</label>
                        <textarea name="deskripsi" class="form-control" rows="3"
                                  placeholder="Deskripsi singkat toko"><?= $setting['deskripsi'] ?? ''; ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save mr-2"></i> Simpan Pengaturan
                    </button>

                </form>
            </div>
        </div>
    </div>

    <!-- ===== KANAN: KELOLA ADMIN ===== -->
    <div class="col-lg-7 mb-4">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <i class="fas fa-users-cog mr-2" style="color:#b8860b;"></i>
                    <span style="font-weight:700; color:#1a1008;">Kelola Admin</span>
                </div>
                <button class="btn btn-primary btn-sm px-3"
                        data-toggle="modal" data-target="#modalTambahAdmin">
                    <i class="fas fa-plus mr-1"></i> Tambah Admin
                </button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th width="40">No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($admins)) : ?>
                            <?php $no = 1; foreach ($admins as $adm) : ?>
                            <tr>
                                <td style="color:#9a8060;"><?= $no++; ?></td>
                                <td>
                                    <div style="font-weight:700; color:#1a1008; font-size:13px;">
                                        <?= esc($adm['name']); ?>
                                    </div>
                                    <div style="font-size:11px; color:#9a8060;">
                                        <?= esc($adm['phone'] ?? '-'); ?>
                                    </div>
                                </td>
                                <td>
                                    <span style="
                                        background:#fef9e7; color:#b8860b;
                                        padding:3px 10px; border-radius:20px;
                                        font-size:12px; font-weight:700;
                                    ">
                                        <?= esc($adm['username']); ?>
                                    </span>
                                </td>
                                <td style="font-size:13px;">
                                    <?= esc($adm['email'] ?? '-'); ?>
                                </td>
                                <td>
                                    <span style="
                                        background:#dcfce7; color:#166534;
                                        padding:3px 10px; border-radius:20px;
                                        font-size:11px; font-weight:700;
                                    ">
                                        <?= esc($adm['role'] ?? 'admin'); ?>
                                    </span>
                                </td>
                                <td>
                                    <!-- EDIT -->
                                    <button class="btn btn-sm btn-warning"
                                            onclick="editAdmin(
                                                '<?= $adm['id']; ?>',
                                                '<?= esc($adm['name']); ?>',
                                                '<?= esc($adm['username']); ?>',
                                                '<?= esc($adm['email'] ?? ''); ?>',
                                                '<?= esc($adm['phone'] ?? ''); ?>',
                                                '<?= esc($adm['gender'] ?? ''); ?>',
                                                '<?= esc($adm['birth_date'] ?? ''); ?>',
                                                '<?= esc($adm['address'] ?? ''); ?>',
                                                '<?= esc($adm['role'] ?? ''); ?>'
                                            )"
                                            style="width:32px; height:32px; padding:0; border-radius:8px;">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <!-- HAPUS -->
                                    <a href="<?= base_url('pengaturan/admin/delete/' . $adm['id']); ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('Yakin hapus admin <?= esc($adm['name']); ?>?')"
                                       style="width:32px; height:32px; padding:0; border-radius:8px; display:inline-flex; align-items:center; justify-content:center;">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" class="text-center py-4" style="color:#9a8060;">
                                    <i class="fas fa-users fa-2x mb-2 d-block" style="color:#e2d9c5;"></i>
                                    Belum ada data admin
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- ===================================================== -->
<!-- MODAL TAMBAH ADMIN -->
<!-- ===================================================== -->
<div class="modal fade" id="modalTambahAdmin" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('pengaturan/admin/save'); ?>" method="post">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-user-plus mr-2"></i>Tambah Admin Baru
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <!-- NAMA -->
                        <div class="col-md-6 mb-3">
                            <label style="font-size:13px; font-weight:600; color:#3d2a0a;">
                                Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" class="form-control"
                                   placeholder="Masukkan nama lengkap" required>
                        </div>

                        <!-- USERNAME -->
                        <div class="col-md-6 mb-3">
                            <label style="font-size:13px; font-weight:600; color:#3d2a0a;">
                                Username <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="username" class="form-control"
                                   placeholder="Masukkan username" required>
                        </div>

                        <!-- EMAIL -->
                        <div class="col-md-6 mb-3">
                            <label style="font-size:13px; font-weight:600; color:#3d2a0a;">Email</label>
                            <input type="email" name="email" class="form-control"
                                   placeholder="Masukkan email">
                        </div>

                        <!-- PHONE -->
                        <div class="col-md-6 mb-3">
                            <label style="font-size:13px; font-weight:600; color:#3d2a0a;">No. Telepon</label>
                            <input type="text" name="phone" class="form-control"
                                   placeholder="Contoh: 08123456789">
                        </div>

                        <!-- GENDER -->
                        <div class="col-md-6 mb-3">
                            <label style="font-size:13px; font-weight:600; color:#3d2a0a;">Jenis Kelamin</label>
                            <select name="gender" class="form-control">
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>

                        <!-- BIRTH DATE -->
                        <div class="col-md-6 mb-3">
                            <label style="font-size:13px; font-weight:600; color:#3d2a0a;">Tanggal Lahir</label>
                            <input type="date" name="birth_date" class="form-control">
                        </div>

                        <!-- ROLE -->
                        <div class="col-md-6 mb-3">
                            <label style="font-size:13px; font-weight:600; color:#3d2a0a;">
                                Role <span class="text-danger">*</span>
                            </label>
                            <select name="role" class="form-control" required>
                                <option value="admin">Admin</option>
                                <option value="superadmin">Super Admin</option>
                                <option value="staff">Staff</option>
                            </select>
                        </div>

                        <!-- PASSWORD -->
                        <div class="col-md-6 mb-3">
                            <label style="font-size:13px; font-weight:600; color:#3d2a0a;">
                                Password <span class="text-danger">*</span>
                            </label>
                            <div style="position:relative;">
                                <input type="password" name="password" id="pwTambah"
                                       class="form-control" placeholder="Minimal 6 karakter" required>
                                <i class="fas fa-eye" onclick="togglePw('pwTambah', this)"
                                   style="position:absolute; right:14px; top:50%; transform:translateY(-50%); color:#9a8060; cursor:pointer;"></i>
                            </div>
                        </div>

                        <!-- KONFIRMASI PASSWORD -->
                        <div class="col-md-6 mb-3">
                            <label style="font-size:13px; font-weight:600; color:#3d2a0a;">
                                Konfirmasi Password <span class="text-danger">*</span>
                            </label>
                            <div style="position:relative;">
                                <input type="password" name="password_confirm" id="pwTambahConfirm"
                                       class="form-control" placeholder="Ulangi password" required>
                                <i class="fas fa-eye" onclick="togglePw('pwTambahConfirm', this)"
                                   style="position:absolute; right:14px; top:50%; transform:translateY(-50%); color:#9a8060; cursor:pointer;"></i>
                            </div>
                        </div>

                        <!-- ALAMAT -->
                        <div class="col-md-12 mb-3">
                            <label style="font-size:13px; font-weight:600; color:#3d2a0a;">Alamat</label>
                            <textarea name="address" class="form-control" rows="2"
                                      placeholder="Masukkan alamat lengkap"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="border-top:1px solid #f0e6c8;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Simpan Admin
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- ===================================================== -->
<!-- MODAL EDIT ADMIN -->
<!-- ===================================================== -->
<div class="modal fade" id="modalEditAdmin" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('pengaturan/admin/update'); ?>" method="post">

                <input type="hidden" name="id" id="editId">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-user-edit mr-2"></i>Edit Admin
                    </h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="row">

                        <!-- NAMA -->
                        <div class="col-md-6 mb-3">
                            <label style="font-size:13px; font-weight:600; color:#3d2a0a;">
                                Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" id="editName" class="form-control" required>
                        </div>

                        <!-- USERNAME -->
                        <div class="col-md-6 mb-3">
                            <label style="font-size:13px; font-weight:600; color:#3d2a0a;">
                                Username <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="username" id="editUsername" class="form-control" required>
                        </div>

                        <!-- EMAIL -->
                        <div class="col-md-6 mb-3">
                            <label style="font-size:13px; font-weight:600; color:#3d2a0a;">Email</label>
                            <input type="email" name="email" id="editEmail" class="form-control">
                        </div>

                        <!-- PHONE -->
                        <div class="col-md-6 mb-3">
                            <label style="font-size:13px; font-weight:600; color:#3d2a0a;">No. Telepon</label>
                            <input type="text" name="phone" id="editPhone" class="form-control">
                        </div>

                        <!-- GENDER -->
                        <div class="col-md-6 mb-3">
                            <label style="font-size:13px; font-weight:600; color:#3d2a0a;">Jenis Kelamin</label>
                            <select name="gender" id="editGender" class="form-control">
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>

                        <!-- BIRTH DATE -->
                        <div class="col-md-6 mb-3">
                            <label style="font-size:13px; font-weight:600; color:#3d2a0a;">Tanggal Lahir</label>
                            <input type="date" name="birth_date" id="editBirthDate" class="form-control">
                        </div>

                        <!-- ROLE -->
                        <div class="col-md-6 mb-3">
                            <label style="font-size:13px; font-weight:600; color:#3d2a0a;">Role</label>
                            <select name="role" id="editRole" class="form-control">
                                <option value="admin">Admin</option>
                                <option value="superadmin">Super Admin</option>
                                <option value="staff">Staff</option>
                            </select>
                        </div>

                        <!-- PASSWORD BARU (opsional) -->
                        <div class="col-md-6 mb-3">
                            <label style="font-size:13px; font-weight:600; color:#3d2a0a;">
                                Password Baru
                                <small style="color:#9a8060; font-weight:400;">(kosongkan jika tidak diubah)</small>
                            </label>
                            <div style="position:relative;">
                                <input type="password" name="password" id="pwEdit"
                                       class="form-control" placeholder="Isi jika ingin ganti password">
                                <i class="fas fa-eye" onclick="togglePw('pwEdit', this)"
                                   style="position:absolute; right:14px; top:50%; transform:translateY(-50%); color:#9a8060; cursor:pointer;"></i>
                            </div>
                        </div>

                        <!-- ALAMAT -->
                        <div class="col-md-12 mb-3">
                            <label style="font-size:13px; font-weight:600; color:#3d2a0a;">Alamat</label>
                            <textarea name="address" id="editAddress" class="form-control" rows="2"></textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer" style="border-top:1px solid #f0e6c8;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
// Toggle show/hide password
function togglePw(id, icon) {
    const input = document.getElementById(id);
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

// Isi modal edit dengan data admin
function editAdmin(id, name, username, email, phone, gender, birthDate, address, role) {
    document.getElementById('editId').value       = id;
    document.getElementById('editName').value     = name;
    document.getElementById('editUsername').value = username;
    document.getElementById('editEmail').value    = email;
    document.getElementById('editPhone').value    = phone;
    document.getElementById('editBirthDate').value = birthDate;
    document.getElementById('editAddress').value  = address;

    // Set gender dropdown
    const genderSel = document.getElementById('editGender');
    for (let i = 0; i < genderSel.options.length; i++) {
        if (genderSel.options[i].value === gender) {
            genderSel.selectedIndex = i;
            break;
        }
    }

    // Set role dropdown
    const roleSel = document.getElementById('editRole');
    for (let i = 0; i < roleSel.options.length; i++) {
        if (roleSel.options[i].value === role) {
            roleSel.selectedIndex = i;
            break;
        }
    }

    // Reset password field
    document.getElementById('pwEdit').value = '';

    // Buka modal
    $('#modalEditAdmin').modal('show');
}

// Validasi password konfirmasi saat tambah
document.querySelector('#modalTambahAdmin form').addEventListener('submit', function(e) {
    const pw  = document.getElementById('pwTambah').value;
    const pwc = document.getElementById('pwTambahConfirm').value;
    if (pw !== pwc) {
        e.preventDefault();
        alert('Password dan konfirmasi password tidak sama!');
    }
    if (pw.length < 6) {
        e.preventDefault();
        alert('Password minimal 6 karakter!');
    }
});
</script>

<?= view('Backend/Template/footer'); ?>