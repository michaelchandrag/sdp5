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
				<h3>Detail Promo <?php  echo $data->NAMA_PROMO ?> </h3>
			</div>
		</div>
		<div class="row">
			<div class="">
				<div class="x_panel">
					<div class="x_title">
	                    <h2>Form Update Promo</h2>
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
						echo form_open("cpenjualan/doUpdatePromo",array('class'=>'form-horizontal form-label-left',"id"=>"form"));
			
							echo form_hidden("txtidpromo",$data->ID_PROMO,array("class"=>"form-control","required"=>null));

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>NAMA PROMO</label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo form_input("txtnamapromo",$data->NAMA_PROMO,array("class"=>"form-control","required"=>null));
								echo "</div>";
							echo "</div>";

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>DISKON </label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo form_input("txtdiskon",$data->DISKON,array("class"=>"form-control","required"=>null));
								echo "</div>";
							echo "</div>";

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>TANGGAL MULAI </label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo "<input type='date' name='txttglmulai'  value =".$data->TGL_MULAI." class='form-control' required=null>";
								//echo form_input("txttglmulai",$data->TGL_MULAI,array("class"=>"form-control","required"=>null));
								//echo "(YYYY-MM-DD)";
								echo "</div>";
							echo "</div>";

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>TANGGAL AKHIR</label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo "<input type='date' name='txttglakhir' value =".$data->TGL_AKHIR." class='form-control' required=null>";
								//echo form_input("txttglakhir",$data->TGL_AKHIR,array("class"=>"form-control","required"=>null));
								//echo "(YYYY-MM-DD)";
								echo "</div>";
							echo "</div>";

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>KETERANGAN</label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo form_input("txtketerangan",$data->KETERANGAN,array("class"=>"form-control"));
								echo "</div>";
							echo "</div>";

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>STATUS</label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
									echo "<div class=''>";
		                             	echo "<label>";
		                             		if($data->STATUS=='0')
		                               			echo "<input name='txtstatus' type='checkbox' class='js-switch' checked /> AKTIF";
		                               		else
		                               		{
		                               			echo "<input name='txtstatus' type='checkbox' class='js-switch'/> AKTIF";
		                               		}
		                            	echo "</label>";
		                          	echo "</div>";
								echo "</div>";
							echo "</div>";
							/*
							echo "<div class='form-group'>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12 col-md-offset-3'>";
								echo form_submit("btnupdate","Update",array("class"=>"btn btn-success"));
								//echo form_submit("btndelete","Delete",array("class"=>"btn btn-success"));
								echo "</div>";
							echo "</div>";	
							*/
						echo form_close();
						echo "<div class='form-group'>";
							echo "<div class='col-md-9 col-sm-9 col-xs-12 col-md-offset-3'>";
							//echo form_submit("btninsert","Insert",array("id"=>"submitBtn","class"=>"btn btn-success"));
							echo "<button id='submitBtn' pesan='Anda Yakin Update Promo?' class='btn btn-success'>Update</button>";
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