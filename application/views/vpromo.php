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
				<h3>List Member</h3>
			</div>
		</div>
		<div class="row">
			<div class="x_panel">
				<div class="x_content">
					<?php
						$template=array(
						"table_open"=>"<table id='datatable' class='table table-striped table-bordered'>"
						);

						$this->table->set_heading("NAMA PROMO","DISKON","TGL_MULAI","TGL_AKHIR","KETERANGAN","STATUS","ACTION");

						foreach($data as $row)
						{
							$idpromo=$row->ID_PROMO;
							$tanggalawalajah = explode(" ",$row->TGL_MULAI);
							$tanggalakhirajah = explode(" ",$row->TGL_AKHIR);
							$link="<a href='".site_url("cpenjualan/updatePromo/$idpromo")."'><i class='fa fa-eraser'></i>EDIT</a>";
							if($row->STATUS == "1")
							{
								$this->table->add_row($row->NAMA_PROMO,$row->DISKON,$tanggalawalajah[0],$tanggalakhirajah[0],$row->KETERANGAN,"TIDAK AKTIF",$link);
							}
							else
							{
								$this->table->add_row($row->NAMA_PROMO,$row->DISKON,$tanggalawalajah[0],$tanggalakhirajah[0],$row->KETERANGAN,"AKTIF",$link);
							}

						}
						$this->table->set_template($template);
						echo $this->table->generate();
					?>
				</div>	
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-sm-12 col-xs-12">
				<div class="x_panel">						
					<div class="x_title">
						<h2>Form Insert Promo</h2>
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
							echo form_open("cpenjualan/doInsertPromo",array('class'=>'form-horizontal form-label-left',"id"=>"form"));
									
								echo "<div class='form-group'>";
									echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>ID PROMO</label>";
									echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
									echo form_input("txtidpromo",$this->session->userdata("idpromo"),array("class"=>"form-control","disabled"=>true));
									echo "</div>";
								echo "</div>";

								echo "<div class='form-group'>";
									echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>NAMA PROMO</label>";
									echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
									echo form_input("txtnamapromo","",array("class"=>"form-control","required"=>null));
									echo "</div>";
								echo "</div>";

								echo "<div class='form-group'>";
									echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>DISKON </label>";
									echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
									echo form_input("txtdiskon","",array("class"=>"form-control","required"=>null));
									echo "</div>";
								echo "</div>";

								echo "<div class='form-group'>";
									echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>TANGGAL MULAI<span class='required'>*</span>";
								   echo "</label>";
								   echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
									echo "<input type='date' name='txttglmulai' class='form-control'>";
									echo "</div>";
								echo "</div>";
								
								echo "<div class='form-group'>";
									echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>TANGGAL AKHIR<span class='required'>*</span>";
								   echo "</label>";
								   echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
									echo "<input type='date' name='txttglakhir' class='form-control'>";
									echo "</div>";
								echo "</div>";
								
								echo "<div class='form-group'>";
									echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>KETERANGAN</label>";
									echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
									echo form_input("txtketerangan","",array("class"=>"form-control"));
									echo "</div>";
								echo "</div>";
								/*
								echo "<div class='form-group'>";
									echo "<div class='col-md-9 col-sm-9 col-xs-12 col-md-offset-3'>";
									echo form_submit("btninsert","Insert",array("class"=>"btn btn-success"));
									echo "</div>";
								echo "</div>";
								*/
							echo form_close();
							echo "<div class='form-group'>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12 col-md-offset-3'>";
								//echo form_submit("btninsert","Insert",array("id"=>"submitBtn","class"=>"btn btn-success"));
								echo "<button id='submitBtn' pesan='Anda Yakin Insert Promo?' class='btn btn-success'>Insert</button>";
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