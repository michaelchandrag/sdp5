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
                	<h3>Koreksi / Hapus </h3>
              	</div>
			</div>

			<div class="row">
				<div class="x_panel">
					<div class="x_content">
					<?php
					foreach($hbeli as $r)
					{
						echo "<h4>NAMA SUPPLIER :</h4>";
						foreach($supplier as $s)
						{
							if($s->ID_SUPPLIER == $r->ID_SUPPLIER)
							{
								$namasup = $s->NAMA_SUPPLIER;
							}
						}
						echo "<h4>".$namasup."</h4>";
						echo "<h4>NAMA GUDANG :</h4>";
						foreach($gudang as $s)
						{
							if($s->ID_GUDANG == $r->ID_GUDANG)
							{
								$namagud = $s->NAMA_GUDANG;
							}
						}
						echo "<h4>".$namagud."</h4>";
						echo "<h4>TANGGAL :</h4>";
						echo "<h4>".$r->TANGGAL."</h4>";
					}
					echo "<div class='form-group'>";
							
							echo "<a href='".site_url("Cont/print_dbeli/$id_hbeli")."'>";
							echo "<button class='btn btn-success'>Print!</button>";
							//echo form_submit("","Print",array("class"=>"btn btn-success"));
							echo "</a>";
							
						echo "</div>";
					?>
<table id='datatable' class='table table-striped table-bordered'>
  <tr>
    <th>NAMA_BARANG</th> 
    <th>QTY PESAN</th>
	<th>QTY DATANG</th>
	<th>SUBTOTAL</th>
	<th>HARGA BELI</th>
	<th>UPDATE</th>
	<th>DELETE</th>
  </tr>
<?php
$temp = 0;
foreach($results as $r)
{
	$id = $r->ID_BARANG;
	$nama = $r->NAMA_BARANG;
	$qtypesan = $r->QTYPESAN;
	$qtydatang = $r->QTYDATANG;
	$sub = $r->SUBTOTAL;
	$harga = $r->HARGA_BELI;
	echo form_open("Cont/update_dbeli/$id_hbeli-$temp-$id");
	//$this->table->add_row($id,$nama,form_input("qtypesan",$qtypesan),form_input("qtydatang",$qtydatang),$sub,$harga,form_submit('delete',"DELETE"));
	echo "<tr>";
	echo "<td>".$nama."</td>";
	echo "<td>".form_input("qtypesan",$qtypesan)."</td>";
	echo "<td>".form_input("qtydatang",$qtydatang)."</td>";
	echo "<td>".$sub."</td>";
	echo "<td>".$harga."</td>";
	echo "<td>".form_submit('update',"UPDATE")."</td>";
	echo "<td>".form_submit('delete',"DELETE")."</td>";
	echo form_hidden('id_barang',$id);
	echo form_hidden('harga_beli',$harga);
	echo "</tr>";
	echo form_close();
	$temp++;
}
echo "</table>";
foreach($hbeli as $r)
{
	echo form_open("Cont/dbeli/$id_hbeli",array('class'=>'form-horizontal form-label-left'));
	echo "<div class='form-group'>";
		echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>STATUS</label>";
		echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
			echo "<div class=''>";
				echo "<label>";
					if($r->STATUS_LUNAS=='1')
						echo "<input name='txtstatus' type='checkbox' class='js-switch' checked /> LUNAS";
					else
					{
						echo "<input name='txtstatus' type='checkbox' class='js-switch'/> LUNAS";
					}
				echo "</label>";
			echo "</div>";
		echo "</div>";
	echo "</div>";
	echo "<div class='form-group'>";
		echo "<div class='col-md-9 col-sm-9 col-xs-12 col-md-offset-3'>";
		echo form_submit("btnBack","Back & Submit",array("class"=>"btn btn-success"));
		echo "</div>";
	echo "</div>";
	echo form_close();
}
	
?>


</table>
	</div>	
				</div>
			</div>
	</div>
</body>
</html>