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

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f6d365, #fda085);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            width: 350px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #ff7e5f;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #eb5e3c;
        }

        .result {
            margin-top: 20px;
            background: #f9f9f9;
            padding: 15px;
            border-radius: 10px;
            border-left: 5px solid #ff7e5f;
        }

        .result h3 {
            margin-top: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Sistem Pembayaran</h2>

        <form method="POST" action="">
            <label for="nominal">Nominal (Rp):</label>
            <input type="number" id="nominal" name="nominal" min="1" required>

            <label for="metode">Metode Pembayaran:</label>
            <select id="metode" name="metode" required>
                <option value="" disabled selected>-- Pilih Metode --</option>
                <option value="TransferBank">Transfer Bank</option>
                <option value="EWallet">E-Wallet</option>
                <option value="QRIS">QRIS</option>
                <option value="COD">Cash On Delivery (COD)</option>
                <option value="VirtualAccount">Virtual Account</option>
            </select>

            <button type="submit">Bayar Sekarang</button>
        </form>

        <?php if ($hasil_proses != ""): ?>
            <div class="result">
                <h3>Hasil Transaksi</h3>
                <p><strong>Status:</strong> <?= $hasil_proses ?></p>
                <p><strong>Struk:</strong><br><?= $hasil_struk ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>