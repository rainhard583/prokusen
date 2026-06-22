<?= view('Backend/Template/header'); ?>

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">
        Edit Produk
    </h1>

    <div class="card shadow mb-4">
        <div class="card-body">

            <form action="<?= base_url('produk/update/' . $detail['id']); ?>" method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="name" class="form-control"
                        value="<?= $detail['name']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-control"><?= $detail['description']; ?></textarea>
                </div>

                <div class="form-group">
                    <label>Harga</label>
                    <input type="number" name="price" class="form-control"
                        value="<?= $detail['price']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stock" class="form-control"
                        value="<?= $detail['stock']; ?>" required>
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="category" class="form-control">
                        <option value="kusen"
                            <?= $detail['category'] == 'kusen' ? 'selected' : ''; ?>>
                            Kusen
                        </option>

                        <option value="cat"
                            <?= $detail['category'] == 'cat' ? 'selected' : ''; ?>>
                            Cat
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Foto Produk</label>
                    <input type="file" name="foto" class="form-control">
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="is_active" class="form-control">
                        <option value="1"
                            <?= $detail['is_active'] == 1 ? 'selected' : ''; ?>>
                            Aktif
                        </option>

                        <option value="0"
                            <?= $detail['is_active'] == 0 ? 'selected' : ''; ?>>
                            Nonaktif
                        </option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Produk
                </button>

            </form>

        </div>
    </div>

</div>

<?= view('Backend/Template/footer'); ?>