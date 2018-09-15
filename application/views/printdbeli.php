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
				<?php //echo "<h6>".$this->breadcrumbs->show()."</h6>"; ?>	

            	<h3>Detail Transfer Gudang </h3>
          	</div>
		</div>

		<div class="row">

				<div class="x_panel">
					<div class="x_title">
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
					?>
	                    <ul class="nav navbar-right panel_toolbox">
	                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	                      </li>
	                      <li><a class="close-link"><i class="fa fa-close"></i></a>
	                      </li>
	                    </ul>
	                    <div class="clearfix"></div>
	                </div>

					<div class="x_content">	
					<table id='datatable' class='table table-striped table-bordered'>
						  <tr>
							<th>NAMA_BARANG</th> 
							<th>QTY PESAN</th>
							<th>QTY DATANG</th>
							<th>SUBTOTAL</th>
							<th>HARGA BELI</th>
						  </tr>
						<?php
						foreach($results as $r)
						{
							$id = $r->ID_BARANG;
							$nama = $r->NAMA_BARANG;
							$qtypesan = $r->QTYPESAN;
							$qtydatang = $r->QTYDATANG;
							$sub = $r->SUBTOTAL;
							$harga = $r->HARGA_BELI;
							//$this->table->add_row($id,$nama,form_input("qtypesan",$qtypesan),form_input("qtydatang",$qtydatang),$sub,$harga,form_submit('delete',"DELETE"));
							echo "<tr>";
							echo "<td>".$nama."</td>";
							echo "<td>".$qtypesan."</td>";
							echo "<td>".$qtydatang."</td>";
							echo "<td>".$sub."</td>";
							echo "<td>".$harga."</td>";
							echo form_hidden('id_barang',$id);
							echo form_hidden('harga_beli',$harga);
							echo "</tr>";
						}
						?>

					</table>
					</div>
				</div>
		</div>
	

	</div>
<script>
window.print();

</script>
</body>
</html>