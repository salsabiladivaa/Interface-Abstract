<?php
require_once 'TransferBank.php';
require_once 'EWallet.php';
require_once 'QRIS.php';
require_once 'COD.php';
require_once 'VirtualAccount.php';

$hasil_proses = "";
$hasil_struk = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nominal = $_POST['nominal'];
    $metode = $_POST['metode'];

    $pembayaran = null;

    if ($metode == "TransferBank") {
        $pembayaran = new TransferBank($nominal);
    } elseif ($metode == "EWallet") {
        $pembayaran = new EWallet($nominal);
    } elseif ($metode == "QRIS") {
        $pembayaran = new QRIS($nominal);
    } elseif ($metode == "COD") {
        $pembayaran = new COD($nominal);
    } elseif ($metode == "VirtualAccount") {
        $pembayaran = new VirtualAccount($nominal);
    }

    if ($pembayaran != null) {
        $hasil_proses = $pembayaran->prosesPembayaran();
        $hasil_struk = $pembayaran->cetakStruk();
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pembayaran Online</title>
</head>

<body>
    <h2>Form Sistem Pembayaran Online</h2>
    <form method="POST" action="">
        <label for="nominal">Masukkan Nominal (Rp):</label><br>
        <input type="number" id="nominal" name="nominal" min="1" required><br><br>

        <label for="metode">Pilih Metode Pembayaran:</label><br>
        <select id="metode" name="metode" required>
            <option value="" disabled selected>-- Pilih Metode --</option>
            <option value="TransferBank">Transfer Bank</option>
            <option value="EWallet">E-Wallet</option>
            <option value="QRIS">QRIS</option>
            <option value="COD">Cash On Delivery (COD)</option>
            <option value="VirtualAccount">Virtual Account</option>
        </select><br><br>

        <button type="submit">Bayar Sekarang</button>
    </form>

    <?php if ($hasil_proses != ""): ?>
        <hr>
        <h3>Hasil Transaksi:</h3>
        <p><strong>Status:</strong> <?= $hasil_proses ?></p>
        <p><strong>Detail Struk:</strong><br><br><?= $hasil_struk ?></p>
    <?php endif; ?>
</body>

</html>