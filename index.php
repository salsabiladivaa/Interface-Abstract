
<?php
require_once 'transferBank.php';
require_once 'e-wallet.php';
require_once 'qris.php';

// objek
$transfer = new TransferBank(100000);
$ewallet = new Ewallet(50000);
$qris = new QRIS(75000);

// output
echo $transfer->prosesPembayaran();
echo "<br>";
echo $transfer->cetakStruk();

echo "<hr>";

echo $ewallet->prosesPembayaran();
echo "<br>";
echo $ewallet->cetakStruk();

echo "<hr>";

echo $qris->prosesPembayaran();
echo "<br>";
echo $qris->cetakStruk();
=======
<?php
require_once 'transferBank.php';
require_once 'e-wallet.php';
require_once 'qris.php';

// objek
$transfer = new TransferBank(100000);
$ewallet = new Ewallet(50000);
$qris = new QRIS(75000);

// output
echo $transfer->prosesPembayaran();
echo "<br>";
echo $transfer->cetakStruk();

echo "<hr>";

echo $ewallet->prosesPembayaran();
echo "<br>";
echo $ewallet->cetakStruk();

echo "<hr>";

echo $qris->prosesPembayaran();
echo "<br>";
echo $qris->cetakStruk();
>>>>>>> 1e55c69a479e2dcf4f22bf73f8fe865b3331fe25
?>