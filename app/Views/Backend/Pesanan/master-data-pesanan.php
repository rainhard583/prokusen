<?= view('Backend/Template/header'); ?>

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">
        Data Pesanan
    </h1>

    <div class="card shadow mb-4">

        <div class="card-body">

            <!-- FILTER -->
            <form method="GET">

                <div class="row mb-3">

                    <!-- SEARCH -->
                    <div class="col-md-7">

                        <input
                            type="text"
                            name="keyword"
                            class="form-control"
                            placeholder="Cari nomor pesanan atau nama..."
                            value="<?= $_GET['keyword'] ?? ''; ?>"
                        >

                    </div>

                    <!-- STATUS -->
                    <div class="col-md-3">

                        <select
                            name="status"
                            class="form-control"
                        >

                            <option value="">-- Semua Status --</option>

                            <option value="pending"
                                <?= ($_GET['status'] ?? '') == 'pending' ? 'selected' : ''; ?>>
                                Pending
                            </option>

                            <option value="success"
                                <?= ($_GET['status'] ?? '') == 'success' ? 'selected' : ''; ?>>
                                Success
                            </option>

                            <option value="cancelled"
                                <?= ($_GET['status'] ?? '') == 'cancelled' ? 'selected' : ''; ?>>
                                Cancelled
                            </option>

                        </select>

                    </div>

                    <!-- BUTTON -->
                    <div class="col-md-2">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Cari
                        </button>

                        <a
                            href="<?= base_url('pesanan'); ?>"
                            class="btn btn-secondary"
                        >
                            Refresh
                        </a>

                    </div>

                </div>

            </form>

            <!-- TABLE -->
            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead class="thead-dark">

                        <tr>

                            <th>No. Pesanan</th>
                            <th>Pelanggan</th>
                            <th>Telepon</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                            <th width="120">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php if(!empty($pesanan)) : ?>

                        <?php foreach($pesanan as $row) : ?>

                        <tr>

                            <td>
                                <?= $row['order_number']; ?>
                            </td>

                            <td>
                                <?= $row['customer_name']; ?>
                            </td>

                            <td>
                                <?= $row['phone']; ?>
                            </td>

<td>

    <form action="<?= base_url('pesanan/update/' . $row['id']) ?>"
          method="post">

        <select name="status"
                class="form-control"
                onchange="this.form.submit()">

            <option value="pending"
                <?= strtolower($row['status']) == 'pending'
                    ? 'selected'
                    : ''; ?>>

                🟡 Pending

            </option>

            <option value="success"
                <?= strtolower($row['status']) == 'success'
                    ? 'selected'
                    : ''; ?>>

                🟢 Success

            </option>

            <option value="cancelled"
                <?= strtolower($row['status']) == 'cancelled'
                    ? 'selected'
                    : ''; ?>>

                🔴 Cancelled

            </option>

        </select>

    </form>

</td>

                            <td>

                                Rp <?= number_format(
                                    $row['total_price'],
                                    0,
                                    ',',
                                    '.'
                                ); ?>

                            </td>

                            <td>

                                <?= date(
                                    'd M Y H:i',
                                    strtotime($row['created_at'])
                                ); ?>

                            </td>

                            <td>

    <!-- DETAIL -->
    <button
        class="btn btn-sm btn-info"
        data-toggle="modal"
        data-target="#detail<?= $row['id']; ?>"
    >
        👁
    </button>

    <!-- HAPUS -->
    <a
        href="<?= base_url('pesanan/delete/' . $row['id']); ?>"
        class="btn btn-sm btn-danger"
        onclick="return confirm('Hapus data?')"
    >
        🗑
    </a>

</td>

                        </tr>

                        <?php endforeach; ?>

                    <?php else : ?>

                        <tr>

                            <td
                                colspan="7"
                                class="text-center"
                            >

                                Data pesanan kosong

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

            <!-- ===== PAGINATION ===== -->
            <?php
                $totalRows   = $totalRows   ?? 0;
                $perPage     = $perPage     ?? 8;
                $currentPage = $currentPage ?? 1;
                $totalPages  = $totalPages  ?? 1;

                // simpan filter yang aktif (keyword & status) supaya
                // tidak ke-reset waktu pindah halaman
                $queryParams = [];

                if (!empty($_GET['keyword'])) {
                    $queryParams['keyword'] = $_GET['keyword'];
                }

                if (!empty($_GET['status'])) {
                    $queryParams['status'] = $_GET['status'];
                }

                $buatLinkHalaman = function ($page) use ($queryParams) {
                    $params = array_merge($queryParams, ['page' => $page]);
                    return base_url('pesanan') . '?' . http_build_query($params);
                };
            ?>

            <?php if ($totalRows > 0) : ?>

            <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">

                <!-- INFO JUMLAH DATA -->
                <div class="text-muted small mb-2">

                    Menampilkan
                    <?= (($currentPage - 1) * $perPage) + 1; ?>
                    -
                    <?= min($currentPage * $perPage, $totalRows); ?>
                    dari <?= $totalRows; ?> data

                </div>

                <!-- NAVIGASI HALAMAN -->
                <?php if ($totalPages > 1) : ?>

                <nav>

                    <ul class="pagination mb-2">

                        <!-- PREV -->
                        <li class="page-item <?= $currentPage <= 1 ? 'disabled' : ''; ?>">
                            <a
                                class="page-link"
                                href="<?= $buatLinkHalaman(max(1, $currentPage - 1)); ?>"
                            >
                                &laquo;
                            </a>
                        </li>

                        <?php
                            $jendela    = 2; // jumlah halaman yang ditampilkan di kiri/kanan halaman aktif
                            $halAwal    = max(1, $currentPage - $jendela);
                            $halAkhir   = min($totalPages, $currentPage + $jendela);
                        ?>

                        <!-- HALAMAN 1 + ... -->
                        <?php if ($halAwal > 1) : ?>

                            <li class="page-item">
                                <a class="page-link" href="<?= $buatLinkHalaman(1); ?>">1</a>
                            </li>

                            <?php if ($halAwal > 2) : ?>
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            <?php endif; ?>

                        <?php endif; ?>

                        <!-- HALAMAN DI SEKITAR HALAMAN AKTIF -->
                        <?php for ($i = $halAwal; $i <= $halAkhir; $i++) : ?>

                            <li class="page-item <?= $i == $currentPage ? 'active' : ''; ?>">
                                <a class="page-link" href="<?= $buatLinkHalaman($i); ?>">
                                    <?= $i; ?>
                                </a>
                            </li>

                        <?php endfor; ?>

                        <!-- ... + HALAMAN TERAKHIR -->
                        <?php if ($halAkhir < $totalPages) : ?>

                            <?php if ($halAkhir < $totalPages - 1) : ?>
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            <?php endif; ?>

                            <li class="page-item">
                                <a class="page-link" href="<?= $buatLinkHalaman($totalPages); ?>">
                                    <?= $totalPages; ?>
                                </a>
                            </li>

                        <?php endif; ?>

                        <!-- NEXT -->
                        <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : ''; ?>">
                            <a
                                class="page-link"
                                href="<?= $buatLinkHalaman(min($totalPages, $currentPage + 1)); ?>"
                            >
                                &raquo;
                            </a>
                        </li>

                    </ul>

                </nav>

                <?php endif; ?>

            </div>

            <?php endif; ?>

        </div>

    </div>

</div>

<!-- ===== MODAL DETAIL - DI LUAR TABEL ===== -->
<?php if(!empty($pesanan)) : ?>
    <?php foreach($pesanan as $row) : ?>
    <div class="modal fade" id="detail<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Detail Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <p>
                        <strong>No Pesanan:</strong>
                        <?= $row['order_number']; ?>
                    </p>

                    <p>
                        <strong>Nama:</strong>
                        <?= $row['customer_name']; ?>
                    </p>

                    <p>
                        <strong>Telepon:</strong>
                        <?= $row['phone']; ?>
                    </p>

                    <p>
                        <strong>Email:</strong>
                        <?= $row['customer_email']; ?>
                    </p>

                    <p>
                        <strong>Alamat:</strong>
                        <?= $row['address']; ?>
                    </p>

                    <p>
                        <strong>Status:</strong>
                        <?= ucfirst($row['status']); ?>
                    </p>

                    <p>
                        <strong>Total:</strong>
                        Rp <?= number_format($row['total_price'], 0, ',', '.'); ?>
                    </p>

                </div>

            </div>
        </div>
    </div>
    <?php endforeach; ?>
<?php endif; ?>

<?= view('Backend/Template/footer'); ?>