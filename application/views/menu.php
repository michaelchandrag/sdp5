<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php
echo form_open("cont/menu");
echo "<h1>Menu Pembelian</h1>";
echo form_submit("btnSupplier","Go To Supplier");
//echo form_submit("btnKategori","Go To Kategori");
echo form_submit("btnMaster","Go To Master Pembelian");
echo form_submit("btnHbeli","Go To Header Pembelian");
echo form_close();
?>

</body>
</html>