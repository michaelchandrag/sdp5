<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
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

				//echo $this->breadcrumbs->show();

				?>

            	<h3>Info Stok Gudang</h3>
          	</div>
		</div>
		
		<div class="row">
			<div class='x_panel'>
					<div class="x_title">
	                    <h3>List Gudang & Jumlah Item</h3>
	                    <ul class="nav navbar-right panel_toolbox">
	                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	                      </li>
	                      <li><a class="close-link"><i class="fa fa-close"></i></a>
	                      </li>
	                    </ul>
	                    <div class="clearfix"></div>
	                </div>
				
					<div class="x_content">
						
						
						<?php
							$template=array(
											"table_open"=>"<table id='datatable' class='table table-striped table-bordered'>"
											);

							$this->table->set_heading("NAMA GUDANG","JUMLAH JENIS BARANG","ACTION");
							foreach($dataNoRak as $row)
							{
								$idgudang=$row->ID_GUDANG;
								$link="<a href='".site_url("cgudang/detailDgudang/$idgudang")."'><i class='fa fa-folder'></i>DETAIL</a>";
								$this->table->add_row($row->NAMA_GUDANG,$row->JUMLAH,$link);
							}
							$this->table->set_template($template);
							echo $this->table->generate();

							$this->table->clear();
						?>
					</div>
			</div>
		</div>

		<div class="row">

			<div class='x_panel'>
				
					<div class="x_title">
	                    <h3>List Detail Stok</h3>
	                    <ul class="nav navbar-right panel_toolbox">
	                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	                      </li>
	                      <li><a class="close-link"><i class="fa fa-close"></i></a>
	                      </li>
	                    </ul>
	                    <div class="clearfix"></div>
	                </div>

					<div class="x_content">
						<?php
							$temp=array(
											"table_open"=>"<table id='datatable-buttons' class='table table-striped table-bordered'>"
											);

							$this->table->set_heading("NAMA BARANG","NAMA GUDANG","STOK");
							foreach($dataAll as $row)
							{
								$this->table->add_row($row->NAMA_BARANG,$row->NAMA_GUDANG,$row->STOK);
							}
							$this->table->set_template($temp);
							echo $this->table->generate();

						?>
					</div>
			</div>
		</div>
	</div>

</body>
</html>

<?php
/*
	echo "<table>";
		echo "<tr>";
			echo "<td>Nama Barang</td>";
			echo "<td>Harga</td>";
			echo "<td>Size</td>";
		echo "</tr>";
		foreach($semuabarang as $row)
		{
			echo "<tr>";
				echo "<td>".$row->NAMA_BARANG."</td>";
				echo "<td>".$row->HARGA_JUAL."</td>";
				echo "<td>".$row->SIZE."</td>";
				echo form_open("cpenjualan/buy");
					echo form_hidden("txtkode",$row->ID_BARANG);
					echo "<td>".form_submit("btnbuy","Buy")."</td>";
					$stok = $this->cmodel->getdetaildgudang($row->ID_BARANG);
					foreach($stok->result() as $i)
					{
						echo "<td><input type='number' name='txtqty' value=1 max=".$i->STOK." min=1></td>";
					}
				echo form_close();
			echo "</tr>";
		}
	echo "</table>";
	if($promo)
	{
		foreach($promo as $row)
		{
			echo $row->ID_PROMO."<br>";
		}
	}
	echo form_open("cpenjualan/checkout");
		echo form_submit("btncheckout","Checkout");
	echo form_close();
	*/
	
?>	