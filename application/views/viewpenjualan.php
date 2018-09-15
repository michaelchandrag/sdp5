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
            	<h3>Info Stok Barang</h3>
          	</div>
		</div>		
		<div class="row">
			<div class='x_panel'>
				<div class="x_title">
					<h3>List Barang & Jumlah Item</h3>
					<?php
						echo form_open("cpenjualan/infoDpenjualan");
							if(!$this->session->userdata("namagudang"))
							{
								$this->session->set_userdata("namagudang","");
							}						
							echo form_dropdown("cmbgudang",$isigudang,$this->session->userdata("idgudang"),array("class"=>"form-control"));
							echo "<div class='form-group'>";				
								echo form_submit("btncari","Cari",array("class"=>"btn btn-success"));								
							echo "</div>";
						echo form_close();
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
					<?php
						echo "<table id='datatable' class='table table-striped table-bordered' >";
							echo "<tr>";
								echo "<td>Nama Barang</td>";
								echo "<td>Harga</td>";
								echo "<td>Size</td>";
							echo "</tr>";
							foreach($semuabarang as $row)
							{
								echo "<tr>";
									echo "<td>".$row->NAMA_BARANG."</td>";
									echo "<td> Rp ".number_format($row->HARGA_JUAL,0,",",".")."</td>";
									echo "<td>".$row->SIZE."</td>";
									echo form_open("cpenjualan/buy");
										echo form_hidden("txtkode",$row->ID_BARANG);
										echo "<td>".form_submit("btnbuy","Buy")."</td>";
										$stok = $this->mdpenjualan->getdetaildgudang($row->ID_GUDANG,$row->ID_BARANG);
										foreach($stok->result() as $i)
										{
											echo "<td><input type='number' name='txtqty' value=1 max=".$i->STOK." min=1></td>";
										}
									echo form_close();
								echo "</tr>";
							}
						echo "</table>";
						$this->table->clear();		
						if($promo)
						{
							foreach($promo as $row)
							{
								echo "Nama Promo : ".$row->NAMA_PROMO." || Besar Diskon : ".$row->DISKON." %<br>";						
							}
						}
						echo form_open("cpenjualan/checkout");
							echo "<div class='form-group'>";				
								echo form_submit("btncheckout","Checkout",array("class"=>"btn btn-success"));								
							echo "</div>";
							
						echo form_close();
					?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>