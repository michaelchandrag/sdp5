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
							echo "$message";
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
            	<h3>Report Penjualan</h3>
          	</div>
		</div>		
		<div class="row">
			<div class='x_panel'>
				<div class="x_title">
					<h3>Daftar Penjualan</h3>
					<?php
					
						echo form_open("cpenjualan/reportpenjualan");												
						echo "<div class='form-group'>";
							echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>FROM</label>";
							echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
							echo "<input type='date' name='tglawal' value='".$tglawal."' class='form-control'>";
							//echo form_input("dropidbarang",$option,"",array("class"=>"form-control"));
							echo "</div>";
						echo "</div>";
						echo "<div class='form-group'>";
							echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>TO</label>";
							echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
							echo "<input type='date' value='".$tglakhir."' name='tglakhir' class='form-control'>";
							//echo form_input("dropidbarang",$option,"",array("class"=>"form-control"));
							echo "</div>";
						echo "</div>";

						echo "<div class='form-group'>";
							echo "<div class='col-md-9 col-sm-9 col-xs-12 col-md-offset-3'>";
							echo form_submit("btnfind","Find",array("class"=>"btn btn-success"));
							echo "</div>";
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
						//tampilan table yang kelihatan
						$template=array(
						"table_open"=>"<table id='datatable' class='table table-striped table-bordered'>"
						);

						$this->table->set_heading("KODE TRANSAKSI","ID MEMBER","ID GUDANG","TANGGAL TRANS","TOTAL HARGA","JENIS PEMBAYARAN","ID PROMO");
						
						foreach($data as $row)
						{
							$idtrans=$row->KD_TRANSAKSI_HJUAL;
							$link="<a href='".site_url("cpenjualan/dodeletehjual/$idtrans")."'><i class='fa fa-eraser'></i>DELETE</a>";
							$this->table->add_row($row->KD_TRANSAKSI_HJUAL,$row->ID_MEMBER,$row->ID_GUDANG,$row->TGL_TRANS,"Rp ".number_format($row->TOTAL_HARGA,0,",","."),$row->JENIS_PEMBAYARAN,$row->ID_PROMO);
						}						
						
						$this->table->set_template($template);
						echo $this->table->generate();
						//tampilan table hidden untuk print
						echo "<div id='printer' style='display: none;'>";
							echo "<table id='datatable' class='table table-striped table-bordered' >";
								echo "<tr>";
									echo "<td>KODE TRANSAKSI</td>";
									echo "<td>ID MEMBER</td>";
									echo "<td>ID GUDANG</td>";
									echo "<td>TANGGAL TRANS</td>";
									echo "<td>TOTAL HARGA</td>";
									echo "<td>JENIS PEMBAYARAN</td>";
									echo "<td>ID PROMO</td>";
								echo "</tr>";
								foreach($data as $row)
								{
									echo "<tr>";
										echo "<td>".$row->KD_TRANSAKSI_HJUAL."</td>";
										echo "<td>".$row->ID_MEMBER."</td>";
										echo "<td>".$row->ID_GUDANG."</td>";
										echo "<td>".$row->TGL_TRANS."</td>";
										echo "<td>Rp ".number_format($row->TOTAL_HARGA,0,",",".")."</td>";
										echo "<td>".$row->JENIS_PEMBAYARAN."</td>";
										echo "<td>".$row->ID_PROMO."</td>";										
									echo "</tr>";
								}
							echo "</table>";							
						echo "</div>";
					?>
				</div>
				<input type="button" onclick="printDiv()" value="Print Invoice" class="btn btn-success" />
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
function printDiv() {
    var printContents = document.getElementById("printer").innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
</html>