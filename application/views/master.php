<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="right_col" role="main">
			<div class="page-title">
			
				<div class="title_left">
				<?php 

				
						if($this->session->flashdata("message"))
						{
							$message=$this->session->flashdata("message");
							echo "<div class='alert alert-success'>";
								echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
								echo "<strong>Success! </strong>$message";
							echo "</div>";
							
						}

						$error=$this->session->flashdata("alert");
						//echo validation_errors();
						if($error)
						{
							echo "<div class='alert alert-danger'>";
								echo "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
								echo "<strong>Fail! </strong> $error";
							echo "</div>";
						}

						

					?>
                	<h3>Master Pembelian</h3>
              	</div>
			</div>

			<div class="row">
				<div class="x_panel">
					<div class="x_content">
<?php
echo form_open("cont/master",array('class'=>'form-horizontal form-label-left'));
echo "Harap isi detail pembelian terlebih dahulu, sebelum mengisi header pembelian";

$temp = 0;
$supp = [];
foreach($arrSupp as $r)
{
	if($r->STATUS == "T")
	{
		$supp[$temp] = $r->ID_SUPPLIER."-".$r->NAMA_SUPPLIER;
		$temp++;	
	}
}
$temp = 0;
$gud = [];
foreach($arrGud as $r)
{
	if($r->STATUS == "T")
	{
		$string = $r->NAMA_GUDANG;
		$pos = strpos($string,'NON');
		if($pos == true)
		{
			$gud[$temp] = $r->ID_GUDANG."-".$r->NAMA_GUDANG;
			$temp++;	
		}
		
	}
	
}
$temp = 0;
$barang = [];
$barangHarga = [];
foreach($arrBarang as $r)
{
	if($r->STATUS == "T")
	{
		$barang[$temp] = $r->ID_BARANG."-".$r->NAMA_BARANG;
		$barangHarga[$temp] = $r->HARGA_BELI;
		$temp++;	
	}
}


echo form_hidden("grand",$grand);

echo "<div class='form-group'>";
	echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>NAMA SUPPLIER</label>";
		echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
		echo form_dropdown("supplier",$supp,"",array("class"=>"form-control"));
		echo "</div>";
echo "</div>";

echo "<div class='form-group'>";
	echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>NAMA GUDANG</label>";
		echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
		echo form_dropdown("gudang",$gud,"",array("class"=>"form-control"));
		echo "</div>";
echo "</div>";

echo "<div class='form-group'>";
	echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>TGL<span class='required'>*</span>";
   echo "</label>";
   echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
	echo "<input type='date' name='txttgl' value ='$todate' class='form-control'>";
	echo "</div>";
echo "</div>";

echo "<div class='form-group'>";
	echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>GRAND TOTAL</label>";
		echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
			echo form_label($grand,"",array("class"=>"form-control"));
		echo "</div>";
echo "</div>";

echo "<div class='form-group'>";
	echo "<div class='col-md-9 col-sm-9 col-xs-12 col-md-offset-3'>";
	echo form_submit("submit","Submit",array("class"=>"btn btn-success"));
	echo "</div>";
echo "</div>";

//echo "<h2>".form_label("Detail")."<br></h2>";

echo "<div class='form-group'>";
	echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>BARANG</label>";
		echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
			echo form_dropdown("barang",$barang,"",array("class"=>"form-control"));
		echo "</div>";
echo "</div>";

echo "<div class='form-group'>";
	echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>QTY PESAN</label>";
		echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
			echo form_input("pesan",0,"",array("class"=>"form-control"));
		echo "</div>";
echo "</div>";

echo "<div class='form-group'>";
	echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>QTY DATANG</label>";
		echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
			echo form_input("datang",0,"",array("class"=>"form-control"))."<br>";
		echo "</div>";
echo "</div>";

echo "<div class='form-group'>";
	echo "<div class='col-md-9 col-sm-9 col-xs-12 col-md-offset-3'>";
	echo form_submit("tambah","Tambah",array("class"=>"btn btn-success"));
	echo "</div>";
echo "</div>";
//echo form_submit("back","Back");

?>

<table id='datatable' class='table table-striped table-bordered'>
  <tr>
    <th>ID BARANG</th> 
    <th>NAMA BARANG</th>
	<th>QTY PESAN</th>
	<th>QTY DATANG</th>
	<th>SUBTOTAL</th>
	<th>HARGA BELI</th>
	<th>ACTION</th>
  </tr>
<?php
echo form_hidden("gabung",$gabung);
$potong = explode(";",$gabung);
$ctr = 0;
for($i =0;$i<count($potong);$i++)
{
	if($potong[$i] != "")
	{
		echo form_open("Cont/discard/$ctr");
		echo form_hidden("gabung2",$gabung);
		$a = $potong[$i];
		$potong2 = explode("+",$a);
		echo "<tr>";
		echo "<td>".$potong2[0]."</td>";
		echo "<td>".$potong2[1]."</td>";
		echo "<td>".$potong2[2]."</td>";
		echo "<td>".$potong2[3]."</td>";
		echo "<td>".$potong2[4]."</td>";
		echo "<td>".$potong2[5]."</td>";
		echo "<td>".form_submit("discard","Discard")."</td>";
		echo "</tr>";
		/*$this->table->add_row($potong2[0],
		$potong2[1],
		$potong2[2],
		$potong2[3],
		$potong2[4],
		$potong2[5],
		$a);*/
		echo form_close();
		$ctr++;
	}
}
echo form_close();
?>
</table>
	</div>	
				</div>
			</div>
	</div>
</body>
</html>