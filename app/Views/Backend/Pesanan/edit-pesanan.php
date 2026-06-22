<?= view('Backend/Template/header'); ?>

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">
        Edit Pesanan
    </h1>

    <div class="card shadow mb-4">

        <div class="card-body">

            <style>

                .form-control{

                    border-radius:10px;

                    height:45px;

                    transition:.3s;

                }

                .form-control:focus{

                    border-color:#4e73df;

                    box-shadow:
                        0 0 0 0.15rem
                        rgba(78,115,223,.25);

                }

                .btn-save{

                    background:#4e73df;

                    border:none;

                    color:white;

                    padding:12px 25px;

                    border-radius:10px;

                    font-weight:600;

                    transition:.3s;

                }

                .btn-save:hover{

                    transform:translateY(-2px);

                    background:#2e59d9;

                }

                .status-box{

                    padding:10px;

                    border-radius:12px;

                    background:#f8f9fc;

                }

            </style>

            <form
                action="<?= base_url('pesanan/update/' . $detail['id']); ?>"
                method="post"
            >

                <div class="row">

                    <!-- NAMA -->
                    <div class="col-md-6">

                        <div class="form-group">

                            <label>

                                Nama Customer

                            </label>

                            <input
                                type="text"
                                name="customer_name"
                                class="form-control"
                                value="<?= $detail['customer_name']; ?>"
                                required
                            >

                        </div>

                    </div>

                    <!-- TELEPON -->
                    <div class="col-md-6">

                        <div class="form-group">

                            <label>

                                Nomor Telepon

                            </label>

                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                value="<?= $detail['phone']; ?>"
                                required
                            >

                        </div>

                    </div>

                </div>

                <div class="row">

                    <!-- TOTAL -->
                    <div class="col-md-6">

                        <div class="form-group">

                            <label>

                                Total Harga

                            </label>

                            <input
                                type="number"
                                name="total_price"
                                class="form-control"
                                value="<?= $detail['total_price']; ?>"
                                required
                            >

                        </div>

                    </div>

                    <!-- STATUS -->
                    <div class="col-md-6">

                        <div class="form-group">

                            <label
                                class="font-weight-bold"
                            >

                                Status Pesanan

                            </label>

                            <div class="status-box">

                                <select
                                    name="status"
                                    class="form-control"
                                >

                                    <option
                                        value="pending"
                                        <?= $detail['status'] == 'pending'
                                            ? 'selected'
                                            : '' ?>
                                    >

                                        🟡 Pending

                                    </option>

                                    <option
                                        value="success"
                                        <?= $detail['status'] == 'success'
                                            ? 'selected'
                                            : '' ?>
                                    >

                                        🟢 Success

                                    </option>

                                    <option
                                        value="cancelled"
                                        <?= $detail['status'] == 'cancelled'
                                            ? 'selected'
                                            : '' ?>
                                    >

                                        🔴 Cancelled

                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- CATATAN -->
                <div class="form-group mt-3">

                    <label>

                        Catatan

                    </label>

                    <textarea
                        name="notes"
                        class="form-control"
                        rows="5"
                    ><?= $detail['notes']; ?></textarea>

                </div>

                <!-- BUTTON -->
                <div class="mt-4">

                    <button
                        type="submit"
                        class="btn-save"
                    >

                        Simpan Perubahan

                    </button>

                    <a
                        href="<?= base_url('pesanan'); ?>"
                        class="btn btn-secondary"
                        style="
                            padding:12px 25px;
                            border-radius:10px;
                            margin-left:10px;
                        "
                    >

                        Kembali

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<?= view('Backend/Template/footer'); ?>