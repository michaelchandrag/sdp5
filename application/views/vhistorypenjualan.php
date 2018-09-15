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
				<h3>List HJUAL</h3>
			</div>
		</div>
		<div class="row">
			<div class="x_panel">
				<div class="x_content">
					<?php
						$template=array(
						"table_open"=>"<table id='datatable' class='table table-striped table-bordered'>"
						);

						$this->table->set_heading("KODE TRANSAKSI","ID MEMBER","ID GUDANG","TANGGAL TRANS","TOTAL HARGA","JENIS PEMBAYARAN","ID PROMO","ACTION");
						
						foreach($data as $row)
						{
							$idtrans=$row->KD_TRANSAKSI_HJUAL;
							$link="<a href='".site_url("cpenjualan/dodeletehjual/$idtrans")."'><i class='fa fa-eraser'></i>DELETE</a>";
							$this->table->add_row($row->KD_TRANSAKSI_HJUAL,$row->ID_MEMBER,$row->ID_GUDANG,$row->TGL_TRANS,"Rp ".number_format($row->TOTAL_HARGA,0,",","."),$row->JENIS_PEMBAYARAN,$row->ID_PROMO,$link);

						}
						
						
						$this->table->set_template($template);
						echo $this->table->generate();
					?>
				</div>	
			</div>
		</div>
	</div>
</body>
</html>