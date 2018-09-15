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
            	<h3>Info Barang yang Di Beli</h3>
          	</div>
		</div>		
		<div class="row">
			<div class='x_panel'>
				<div class="x_title">
					<h3>Barang Customer</h3>
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
						echo "<table id='datatable' class='table table-striped table-bordered'>";
						echo "<tr>";
								echo "<td><b>Name</b></td>";
								echo "<td><b>Price</b></td>";
								echo "<td><b>Qty</b></td>";
								echo "<td><b>Subtotal</b></td>";
								echo "<td><b>Stok</b></td>";
								echo "<td><b>Size</b></td>";
						echo "</tr>";
						foreach ($this->cart->contents() as $i)
						{
							echo form_open("cpenjualan/checkout"); 			
								$opsidata = $this->cart->product_options($i['rowid']);
								echo "<tr>";
									echo form_hidden("txtrowid",$i['rowid']);
									//echo "<td>" . $i['rowid']."</td>";
									//echo "<td>" . $i['id'] . "</td>";
									echo "<td>" . $i['name'] . "</td>";
									echo "<td> Rp " . number_format($i['price'],0,",",".") . "</td>";
									echo "<td>" . $i['qty'] . "</td>";
									echo "<td> Rp " . number_format($i['subtotal'],0,",",".") . "</td>";
									echo "<td>" . $i['stock'] . "</td>";
									echo "<td>" . $i['size'] . "</td>";
									echo "<td>".form_submit("btnhapus","Batal Beli")."</td>"; 
								echo "</tr>";
							echo form_close(); 
						}
						echo "</table>";
						$this->table->clear();	
						
						echo "<h2>Total : Rp ".number_format($this->cart->total(),0,",",".")."</h2>";
						echo "<h2>Total Barang : ".$this->cart->total_items()."</h2>"; 						
						
						//echo $urldibawah; 
						echo "Jenis Pembayaran : ";
						echo form_open("cpenjualan/checkout",array('target' => '_blank')); 
							echo form_radio("rd","CASH")."Cash ";
							echo form_radio("rd","CREDIT")."Credit";
							echo "<br><br>";
							
							if($promo)
							{
								foreach($promo as $row)
								{
									echo form_radio("rdpromo",$row->ID_PROMO)." ".$row->NAMA_PROMO." ";					
								}
							}
							
							
							echo "<br><br>";
							$datamember = $this->mdpenjualan->getDataMember();
							echo "ID Member : ";
							echo form_dropdown("cmbmember",$datamember)."<br><br>";//data member
							
							echo "<div class='form-group'>";				
								echo form_submit("btnsavetodbase","Save Cart To Database",array("class"=>"btn btn-success"));								
							echo "</div>";	
						echo form_close(); 
						echo form_open("cpenjualan/checkout");
							echo "<div class='form-group'>";				
								echo form_submit("btnbacktopenjualan","Back To Penjualan",array("class"=>"btn btn-success"));								
							echo "</div>";
						echo form_close(); 
					?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
