<?= view('Backend/Template/header'); ?>

<div class="container-fluid">

    <!-- TITLE -->
    <h1 class="h3 mb-1 text-gray-800">
        Produk
    </h1>

    <p class="mb-4">
        Kelola katalog produk Anda
    </p>

    <!-- ALERT -->
    <?php if(session()->getFlashdata('success')) : ?>

        <div class="alert alert-success">

            <?= session()->getFlashdata('success'); ?>

        </div>

    <?php endif; ?>

    <?php if(session()->getFlashdata('error')) : ?>

        <div class="alert alert-danger">

            <?= session()->getFlashdata('error'); ?>

        </div>

    <?php endif; ?>

    <!-- CARD -->
    <div class="card shadow mb-4">

        <div class="card-body">

            <!-- FILTER -->
            <form
                method="GET"
                action="<?= base_url('produk'); ?>"
            >

                <div class="row mb-4">

                    <!-- SEARCH -->
                    <div class="col-md-8">

                        <input
                            type="text"
                            name="keyword"
                            class="form-control"
                            placeholder="Cari produk..."
                            value="<?= $_GET['keyword'] ?? ''; ?>"
                        >

                    </div>

                    <!-- KATEGORI -->
                    <div class="col-md-2">

                        <select
                            name="kategori"
                            class="form-control"
                        >

                            <option value="">
                                Semua Kategori
                            </option>

                            <option value="cat">
                                Cat
                            </option>

                            <option value="kusen">
                                Kusen
                            </option>

                        </select>

                    </div>

                    <!-- BUTTON -->
                    <div class="col-md-2">

                        <button
                            type="submit"
                            class="btn btn-primary btn-block"
                        >
                            Cari
                        </button>

                    </div>

                </div>

            </form>

            <!-- BUTTON TAMBAH -->
            <button
                class="btn btn-success mb-3"
                data-toggle="modal"
                data-target="#modalTambahProduk"
            >
                Tambah Produk
            </button>

            <!-- TABLE -->
            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead class="bg-dark text-white">

                        <tr>

                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th width="150">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php if(!empty($produk)) : ?>

                        <?php foreach($produk as $row) : ?>

                            <tr>

                                <!-- FOTO -->
                                <td width="100">

                                    <?php if(!empty($row['image'])) : ?>

                                        <img
                                            src="<?= base_url('uploads/produk/' . $row['image']); ?>"
                                            width="70"
                                            class="img-thumbnail"
                                        >

                                    <?php else : ?>

                                        <span class="text-muted">
                                            Tidak ada foto
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <!-- NAMA -->
                                <td>

                                    <strong>
                                        <?= $row['name']; ?>
                                    </strong>

                                    <br>

                                    <small class="text-muted">

                                        <?= $row['description']; ?>

                                    </small>

                                </td>

                                <!-- KATEGORI -->
                                <td>

                                    <span class="badge badge-warning">

                                        <?= ucfirst($row['category']); ?>

                                    </span>

                                </td>

                                <!-- HARGA -->
                                <td>

                                    Rp
                                    <?= number_format(
                                        $row['price'],
                                        0,
                                        ',',
                                        '.'
                                    ); ?>

                                </td>

                                <!-- STOK -->
                                <td>

                                    <?= $row['stock']; ?>

                                </td>

                                <!-- STATUS -->
                                <td>

                                    <?php if($row['is_active'] == 1) : ?>

                                        <span class="badge badge-success">
                                            Aktif
                                        </span>

                                    <?php else : ?>

                                        <span class="badge badge-secondary">
                                            Nonaktif
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <!-- AKSI -->
                                <td>

                                    <a
                                        href="<?= base_url('produk/edit/' . $row['id']); ?>"
                                        class="btn btn-sm btn-primary"
                                    >
                                        Edit
                                    </a>

                                    <a
                                        href="<?= base_url('produk/delete/' . $row['id']); ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin hapus produk?')"
                                    >
                                        Hapus
                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else : ?>

                        <tr>

                            <td colspan="7" class="text-center">

                                Data produk kosong

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- ===================================================== -->
<!-- MODAL TAMBAH PRODUK -->
<!-- ===================================================== -->

<div
    class="modal fade"
    id="modalTambahProduk"
    tabindex="-1"
>

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form
                action="<?= base_url('produk/save'); ?>"
                method="POST"
                enctype="multipart/form-data"
            >

                <div class="modal-header">

                    <h5 class="modal-title">
                        Tambah Produk
                    </h5>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                    >
                        <span>&times;</span>
                    </button>

                </div>

                <div class="modal-body">

                    <!-- NAMA -->
                    <div class="form-group">

                        <label>
                            Nama Produk
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            required
                        >

                    </div>

                    <!-- DESKRIPSI -->
                    <div class="form-group">

                        <label>
                            Deskripsi
                        </label>

                        <textarea
                            name="description"
                            class="form-control"
                            rows="3"
                        ></textarea>

                    </div>

                    <!-- HARGA + STOK -->
                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>
                                    Harga
                                </label>

                                <input
                                    type="number"
                                    name="price"
                                    class="form-control"
                                    required
                                >

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>
                                    Stok
                                </label>

                                <input
                                    type="number"
                                    name="stock"
                                    class="form-control"
                                    required
                                >

                            </div>

                        </div>

                    </div>

                    <!-- KATEGORI -->
                    <div class="form-group">

                        <label>
                            Kategori
                        </label>

                        <select
                            name="category"
                            class="form-control"
                            required
                        >

                            <option value="cat">
                                Cat
                            </option>

                            <option value="kusen">
                                Kusen
                            </option>

                        </select>

                    </div>

                    <!-- FOTO -->
                    <div class="form-group">

                        <label>
                            Foto Produk
                        </label>

                        <input
                            type="file"
                            name="foto"
                            class="form-control"
                        >

                    </div>

                    <!-- STATUS -->
                    <div class="form-group">

                        <label>
                            Status
                        </label>

                        <select
                            name="is_active"
                            class="form-control"
                        >

                            <option value="1">
                                Aktif
                            </option>

                            <option value="0">
                                Nonaktif
                            </option>

                        </select>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal"
                    >
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="btn btn-success"
                    >
                        Simpan Produk
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<?= view('Backend/Template/footer'); ?>