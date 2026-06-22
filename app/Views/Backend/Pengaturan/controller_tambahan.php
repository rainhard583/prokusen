// ============================================================
// PENGATURAN - KELOLA ADMIN
// Tambahkan function-function ini di dalam class Admin
// di file app/Controllers/Admin.php
// Letakkan setelah function updatePengaturan()
// ============================================================

public function pengaturan()
{
    $redirect = $this->cekSession();
    if ($redirect) return $redirect;

    $db = db_connect();

    // AMBIL SEMUA ADMIN
    $data['admins']  = $db->table('admins')
        ->orderBy('created_at', 'DESC')
        ->get()
        ->getResultArray();

    // AMBIL SETTING TOKO
    $data['setting'] = $this->pengaturanModel->getAllSetting();

    return view('Backend/Pengaturan/pengaturan-web', $data);
}

public function updatePengaturan()
{
    $redirect = $this->cekSession();
    if ($redirect) return $redirect;

    $settings = [
        'nama_toko'       => $this->request->getPost('nama_toko'),
        'alamat_toko'     => $this->request->getPost('alamat_toko'),
        'no_telp'         => $this->request->getPost('no_telp'),
        'no_wa'           => $this->request->getPost('no_wa'),
        'email_toko'      => $this->request->getPost('email_toko'),
        'jam_operasional' => $this->request->getPost('jam_operasional'),
        'deskripsi'       => $this->request->getPost('deskripsi'),
    ];

    foreach ($settings as $key => $value) {
        $this->pengaturanModel->updateSetting($key, $value);
    }

    session()->setFlashdata('success', 'Pengaturan toko berhasil disimpan!');
    return redirect()->to(base_url('pengaturan'));
}

public function saveAdmin()
{
    $redirect = $this->cekSession();
    if ($redirect) return $redirect;

    $db = db_connect();

    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');
    $passwordConfirm = $this->request->getPost('password_confirm');

    // CEK PASSWORD SAMA
    if ($password !== $passwordConfirm) {
        session()->setFlashdata('error', 'Password dan konfirmasi password tidak sama!');
        return redirect()->to(base_url('pengaturan'));
    }

    // CEK PASSWORD MINIMAL 6 KARAKTER
    if (strlen($password) < 6) {
        session()->setFlashdata('error', 'Password minimal 6 karakter!');
        return redirect()->to(base_url('pengaturan'));
    }

    // CEK USERNAME SUDAH ADA
    $cek = $db->table('admins')
        ->where('username', $username)
        ->get()
        ->getRowArray();

    if ($cek) {
        session()->setFlashdata('error', 'Username sudah digunakan, gunakan username lain!');
        return redirect()->to(base_url('pengaturan'));
    }

    $data = [
        'name'       => $this->request->getPost('name'),
        'username'   => $username,
        'email'      => $this->request->getPost('email'),
        'phone'      => $this->request->getPost('phone'),
        'gender'     => $this->request->getPost('gender'),
        'birth_date' => $this->request->getPost('birth_date') ?: null,
        'address'    => $this->request->getPost('address'),
        'role'       => $this->request->getPost('role'),
        'password'   => password_hash($password, PASSWORD_DEFAULT),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];

    $simpan = $db->table('admins')->insert($data);

    if ($simpan) {
        session()->setFlashdata('success', 'Admin baru berhasil ditambahkan!');
    } else {
        session()->setFlashdata('error', 'Gagal menambahkan admin!');
    }

    return redirect()->to(base_url('pengaturan'));
}

public function updateAdmin()
{
    $redirect = $this->cekSession();
    if ($redirect) return $redirect;

    $db = db_connect();

    $id       = $this->request->getPost('id');
    $username = $this->request->getPost('username');

    // CEK USERNAME SUDAH ADA (kecuali milik sendiri)
    $cek = $db->table('admins')
        ->where('username', $username)
        ->where('id !=', $id)
        ->get()
        ->getRowArray();

    if ($cek) {
        session()->setFlashdata('error', 'Username sudah digunakan admin lain!');
        return redirect()->to(base_url('pengaturan'));
    }

    $data = [
        'name'       => $this->request->getPost('name'),
        'username'   => $username,
        'email'      => $this->request->getPost('email'),
        'phone'      => $this->request->getPost('phone'),
        'gender'     => $this->request->getPost('gender'),
        'birth_date' => $this->request->getPost('birth_date') ?: null,
        'address'    => $this->request->getPost('address'),
        'role'       => $this->request->getPost('role'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];

    // GANTI PASSWORD HANYA JIKA DIISI
    $password = $this->request->getPost('password');
    if (!empty($password)) {
        if (strlen($password) < 6) {
            session()->setFlashdata('error', 'Password baru minimal 6 karakter!');
            return redirect()->to(base_url('pengaturan'));
        }
        $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    $update = $db->table('admins')
        ->where('id', $id)
        ->update($data);

    if ($update) {
        session()->setFlashdata('success', 'Data admin berhasil diperbarui!');
    } else {
        session()->setFlashdata('error', 'Gagal memperbarui data admin!');
    }

    return redirect()->to(base_url('pengaturan'));
}

public function deleteAdmin($id)
{
    $redirect = $this->cekSession();
    if ($redirect) return $redirect;

    $db = db_connect();

    // CEGAH HAPUS DIRI SENDIRI
    $idSession = session()->get('id_admin');
    if ($id == $idSession) {
        session()->setFlashdata('error', 'Tidak bisa menghapus akun yang sedang login!');
        return redirect()->to(base_url('pengaturan'));
    }

    $hapus = $db->table('admins')
        ->where('id', $id)
        ->delete();

    if ($hapus) {
        session()->setFlashdata('success', 'Admin berhasil dihapus!');
    } else {
        session()->setFlashdata('error', 'Gagal menghapus admin!');
    }

    return redirect()->to(base_url('pengaturan'));
}