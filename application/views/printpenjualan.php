<html>
<head>
	<style>
		#headerprint{
			width:70%;
			height:15%;
			font-family:calibri;
			font-size:20px;
			margin-left:auto;
			margin-right:auto;
			text-align:center;
		}
		#contentheader
		{
			width:50%;
			height:100%;
			float:left;
		}
		#printableArea
		{
			font-size:15px;
			font-family:calibri;
		}
	</style>
</head>
<body>
	<div id="headerprint">	
		<p> Nota Pembelian<br>
		adaSTORE<br>
		Jalan Ngagel 123, Surabaya<br>
		No. Telp (031) 2512748<br>
		</p>
	</div>
	<hr style="width:85%;"></hr>
	<hr style="width:85%;"></hr>
	<div id="printableArea">
       <?php
			//table
			echo "<table border=1 style='font-size:20px;width:80%;text-align:center;margin-left:auto;margin-right:auto;'>";
			echo "<tr>";
					echo "<td><b>Name</b></td>";
					echo "<td><b>Size</b></td>";
					echo "<td><b>Price</b></td>";
					echo "<td><b>Qty</b></td>";					
					echo "<td><b>Subtotal</b></td>";
			echo "</tr>";
			foreach ($this->cart->contents() as $i)
			{
				echo form_open("cpenjualan/checkout"); 			
					$opsidata = $this->cart->product_options($i['rowid']);
					echo "<tr>";
						echo form_hidden("txtrowid",$i['rowid']);
						echo "<td>" . $i['name'] . "</td>";
						echo "<td>" . $i['size'] . "</td>";
						echo "<td> Rp " . number_format($i['price'],0,",",".") . "</td>";
						echo "<td>" . $i['qty'] . "</td>";						
						echo "<td> Rp " . number_format($i['subtotal'],0,",",".") . "</td>";
					echo "</tr>";
				echo form_close(); 
			}
			echo "</table>";
			$this->table->clear();	
			//table
			echo "<h3>Total Barang : ".$this->cart->total_items()."</h3>";//Total Barang			
			echo "<h3>Total : Rp ".number_format($this->cart->total(),0,",",".")."</h3>";//Total Harga
			//Total Setelah Diskon
			$diskonan = (intval($this->cart->total())*intval($diskon))/intval(100);
			$hasildiskon = intval($this->cart->total())-intval($diskonan);
			if($jenispembayaran == "CASH")
			{}
			else
			{
				echo "<h3>Total Setelah Diskon : Rp ".number_format($hasildiskon,0,",",".")."</h3>";
			}			
		?>
	</div>
	<input type="button" onclick="printDiv()" value="Print Invoice" />
</body>
<script type="text/javascript">
function printDiv() {
    //var printContents = document.getElementById(divName).innerHTML;
    //var originalContents = document.body.innerHTML;
    //document.body.innerHTML = printContents;
    window.print();
    //document.body.innerHTML = originalContents;
}
</script>
</html>