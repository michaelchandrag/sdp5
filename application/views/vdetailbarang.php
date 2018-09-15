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

					//echo $this->breadcrumbs->show();

					?>
					<?php echo "<h6>".$this->breadcrumbs->show()."</h6>"; ?>		
				<h3>Detail Barang <?php  echo $data->NAMA_BARANG ?> </h3>
			</div>
		</div>

		<div class="row">
			<div class="">
				<div class="x_panel">
					<div class="x_title">
	                    <h2>Form Update Barang</h2>
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

						foreach($kategori as $row)
						{
							$dataKategori[$row->ID_KATEGORI]=$row->NAMA_KATEGORI;
						}
						//to fill drop brand
						foreach($brand as $row)
						{
							$dataBrand[$row->ID_BRAND]=$row->NAMA_BRAND;
						}



						echo form_open("cgudang/doUpdateBarang",array('id'=>'form','class'=>'form-horizontal form-label-left'));

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'></label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo form_hidden("txtidbarang",$data->ID_BARANG,array("class"=>"form-control"));
								echo "</div>";
							echo "</div>";

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>KATEGORI</label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo form_dropdown("dropkategori",$dataKategori,$data->ID_KATEGORI,array("class"=>"form-control"));
								echo "</div>";
							echo "</div>";

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>BRAND</label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo form_dropdown("dropbrand",$dataBrand,$data->ID_BRAND,array("class"=>"form-control"));
								echo "</div>";
							echo "</div>";

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>NAMA BARANG</label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo form_input("txtnamabarang",$data->NAMA_BARANG,array("class"=>"form-control"));
								echo "</div>";
							echo "</div>";

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>HARGA JUAL</label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo form_input("txthargajual",$data->HARGA_JUAL,array("class"=>"form-control"));
								echo "</div>";
							echo "</div>";

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>HARGA BELI</label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo form_input("txthargabeli",$data->HARGA_BELI,array("class"=>"form-control"));
								echo "</div>";
							echo "</div>";

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>SIZE</label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo form_input("txtsize",$data->SIZE,array("class"=>"form-control"));
								echo "</div>";
							echo "</div>";

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>STATUS</label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
									echo "<div class=''>";
		                             	echo "<label>";
		                             		if($data->STATUS=='T')
		                               			echo "<input name='txtstatus' type='checkbox' class='js-switch' checked /> AKTIF";
		                               		else
		                               		{
		                               			echo "<input name='txtstatus' type='checkbox' class='js-switch'/> AKTIF";
		                               		}
		                            	echo "</label>";
		                          	echo "</div>";
								echo "</div>";
							echo "</div>";

							

							

							

								

								
						echo form_close();

						echo "<div class='form-group'>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12 col-md-offset-3'>";
								echo form_submit("btnupdate","Update",array('id'=>'submitBtn','pesan'=>'Anda Yakin Ingin Update?',"class"=>"btn btn-success"));
								//echo form_submit("btndelete","Delete",array("class"=>"btn btn-success"));
								echo "</div>";
							echo "</div>";
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>