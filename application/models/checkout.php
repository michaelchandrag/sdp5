<?php
	echo "<table>";
	echo "<tr>";
			echo "<td><b>RowId</b></td>";
			echo "<td><b>RowId</b></td>";
			echo "<td><b>Id</b></td>";
			echo "<td><b>Name</b></td>";
			echo "<td><b>Price</b></td>";
			echo "<td><b>Qty</b></td>";
			echo "<td><b>Subtotal</b></td>";
			echo "<td><b>Stok</b></td>";
		echo "</tr>";
		
	foreach ($this->cart->contents() as $i)
	{
		echo form_open("cpenjualan/checkout"); 			
			$opsidata = $this->cart->product_options($i['rowid']);
			echo "<tr>";
				echo "<td>" . form_input("txtrowid",$i['rowid'])."</td>";
				echo "<td>" . $i['rowid']."</td>";
				echo "<td>" . $i['id'] . "</td>";
				echo "<td>" . $i['name'] . "</td>";
				echo "<td>" . $i['price'] . "</td>";
				echo "<td>" . $i['qty'] . "</td>";
				echo "<td>" . $i['subtotal'] . "</td>";
				echo "<td>" . $opsidata['stok'] . "</td>";
				echo "<td>".form_submit("btnhapus","Batal Beli")."</td>"; 
			echo "</tr>";
		echo form_close(); 
	}
	echo "</table>";
	echo "<h2>Total : ".$this->cart->total()."</h2>"; 
	echo "<h2>Total Barang : ".$this->cart->total_items()."</h2>"; 
	//echo $urldibawah; 
	
	echo form_open("cpenjualan/checkout"); 
		echo form_submit("btnbacktopenjualan","Back To Penjualan"); 
		echo form_submit("btnsavetodbase","Save Cart To Database"); 
		echo form_radio("rd","cash")."Cash";
		echo form_radio("rd","credit")."Credit";
		echo 
	echo form_close(); 
?>