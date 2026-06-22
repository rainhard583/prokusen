<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>

        * { box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            padding: 20px;
        }

        /* ── HEADER ── */
        .report-header {
            border-bottom: 3px solid #28a745;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        h2 {
            margin: 0 0 4px 0;
            font-size: 22px;
            color: #1a1a1a;
        }

        .info {
            color: #666;
            font-size: 11px;
        }

        /* ── SUMMARY CARDS ── */
        .summary-table {
            width: 100%;
            margin-bottom: 22px;
            border-collapse: separate;
            border-spacing: 8px 0;
        }

        .summary-table td {
            width: 25%;
            color: white;
            padding: 14px 16px;
            border-radius: 8px;
            vertical-align: top;
        }

        .green  { background: #28a745; }
        .blue   { background: #007bff; }
        .yellow { background: #e0a800; }
        .red    { background: #dc3545; }

        .label {
            font-size: 10px;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.9;
        }

        .value {
            font-size: 18px;
            font-weight: bold;
        }

        /* ── SECTION TITLE ── */
        .section-title {
            font-size: 13px;
            font-weight: bold;
            color: #343a40;
            margin: 0 0 8px 0;
            padding-bottom: 4px;
            border-bottom: 1px solid #dee2e6;
        }

        /* ── TABLE ── */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background: #343a40;
            color: white;
            font-size: 11px;
            padding: 9px 10px;
            text-align: left;
        }

        table td {
            border: 1px solid #dee2e6;
            padding: 8px 10px;
            font-size: 11px;
        }

        table tbody tr:nth-child(even) {
            background: #f8f9fa;
        }

        .text-center { text-align: center; }
        .text-right  { text-align: right; }

        .badge {
            display: inline-block;
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
        }

        .badge-success { background: #28a745; }

        /* ── FOOTER ── */
        .report-footer {
            margin-top: 20px;
            font-size: 10px;
            color: #999;
            text-align: right;
        }

    </style>
</head>
<body>

<?php
// ============================================================
// Semua data sudah difilter STATUS=SUCCESS oleh controller
// ============================================================
$totalPendapatan = 0;
$totalPesanan    = count($laporan);
$customerList    = [];

foreach ($laporan as $row) {
    $totalPendapatan += $row['total_price'];
    $customerList[]   = $row['customer_name'];
}

$totalCustomer = count(array_unique($customerList));
$rataRata      = $totalPesanan ? $totalPendapatan / $totalPesanan : 0;

// Label filter
$filterLabel = match($filter ?? '') {
    'hari'   => 'Hari Ini (' . date('d-m-Y') . ')',
    '7hari'  => '7 Hari Terakhir',
    '30hari' => '30 Hari Terakhir',
    default  => 'Semua Waktu',
};
?>

<!-- HEADER -->
<div class="report-header">
    <h2>Laporan Penjualan</h2>
    <div class="info">
        Periode: <strong><?= $filterLabel; ?></strong> &nbsp;|&nbsp;
        Dicetak: <strong><?= date('d-m-Y H:i'); ?></strong> &nbsp;|&nbsp;
        Status: <strong>Success</strong>
    </div>
</div>

<!-- SUMMARY -->
<table class="summary-table">
    <tr>
        <td class="green">
            <div class="label">Total Pendapatan</div>
            <div class="value">Rp <?= number_format($totalPendapatan, 0, ',', '.'); ?></div>
        </td>
        <td class="blue">
            <div class="label">Total Pesanan</div>
            <div class="value"><?= $totalPesanan; ?></div>
        </td>
        <td class="yellow">
            <div class="label">Customer Unik</div>
            <div class="value"><?= $totalCustomer; ?></div>
        </td>
        <td class="red">
            <div class="label">Rata-rata Order</div>
            <div class="value">Rp <?= number_format($rataRata, 0, ',', '.'); ?></div>
        </td>
    </tr>
</table>

<!-- TABEL -->
<p class="section-title">Detail Pesanan Berhasil</p>

<table>
    <thead>
        <tr>
            <th width="4%"  class="text-center">No</th>
            <th width="17%">No Order</th>
            <th width="20%">Customer</th>
            <th width="13%">No HP</th>
            <th width="16%" class="text-right">Total</th>
            <th width="10%" class="text-center">Status</th>
            <th width="14%" class="text-center">Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($laporan)) : ?>
            <?php $no = 1; foreach ($laporan as $row) : ?>
                <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['order_number']); ?></td>
                    <td><?= htmlspecialchars($row['customer_name']); ?></td>
                    <td><?= htmlspecialchars($row['customer_phone'] ?? $row['phone'] ?? '-'); ?></td>
                    <td class="text-right">Rp <?= number_format($row['total_price'], 0, ',', '.'); ?></td>
                    <td class="text-center">
                        <span class="badge badge-success">Success</span>
                    </td>
                    <td class="text-center">
                        <?= date('d-m-Y H:i', strtotime($row['created_at'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>

            <!-- BARIS TOTAL -->
            <tr style="background:#e9f7ef;font-weight:bold;">
                <td colspan="4" class="text-right" style="border:1px solid #dee2e6;padding:9px 10px;">
                    TOTAL
                </td>
                <td class="text-right" style="border:1px solid #dee2e6;padding:9px 10px;">
                    Rp <?= number_format($totalPendapatan, 0, ',', '.'); ?>
                </td>
                <td colspan="2" style="border:1px solid #dee2e6;"></td>
            </tr>

        <?php else : ?>
            <tr>
                <td colspan="7" class="text-center" style="padding:20px;">
                    Tidak ada data pesanan pada periode ini
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- FOOTER -->
<div class="report-footer">
    Dokumen ini digenerate otomatis oleh Sistem Penjualan Kusen &mdash; <?= date('d-m-Y H:i:s'); ?>
</div>

</body>
</html>