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

                	<h3>List Gudang</h3>
              	</div>
			</div>
					

			<div class="row">
				<div class="x_panel">
					<div class="x_content">
						<?php

						$template=array(
							"table_open"=>"<table id='datatable' class='table table-striped table-bordered'>"
							);

						$this->table->set_template($template);
						$this->table->set_heading("NAMA GUDANG","ALAMAT GUDANG","TELP GUDANG","STATUS","ACTION");

						foreach ($data as $row) {
							# code...

							if($row->STATUS=="T")
								$status="AKTIF";
							else
								$status="NON-AKTIF";

							$idgudang=$row->ID_GUDANG;
							$linkedit="<a href='".site_url("cgudang/updateGudang/$idgudang")."'><i class='fa fa-eraser'></i>EDIT</a>";
							$this->table->add_row($row->NAMA_GUDANG,$row->ALAMAT_GUDANG,$row->TELP_GUDANG,$status,$linkedit);

						}
						//autogenerate kode gudang
						$idgudang=$this->mgudang->selectMaxIdGudang()->ID_GUDANG;
						if(!$idgudang)
							$idgudang=0;
						else
							$idgudang=substr($idgudang,2,3);
						$idgudang=$idgudang+1;
						$hasilkode = "GU".str_pad($idgudang, 3, "0", STR_PAD_LEFT);
						$idgudang = $hasilkode;
						

						echo $this->table->generate();

					
					?>

					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6 col-sm-12 col-xs-12">
					<div class="x_panel">
						
						<div class="x_title">
		                    <h2>Form Insert Gudang</h2>
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
								//print_r($this->session->flashdata("message"));



								echo form_open("cgudang/doInsertGudang",array('id'=>'form','class'=>'form-horizontal form-label-left'));

								echo "<div class='form-group'>";
									echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>ID GUDANG</label>";
									echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
									echo form_input("txtidgudang",$idgudang,array("class"=>"form-control", "readonly"=>"true"));
									echo "</div>";
								echo "</div>";

								echo "<div class='form-group'>";
									echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>NAMA GUDANG</label>";
									echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
									echo form_input("txtnamagudang","",array("class"=>"form-control"));
									echo "</div>";
								echo "</div>";

								echo "<div class='form-group'>";
									echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>ALAMAT GUDANG</label>";
									echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
									echo form_input("txtalamatgudang","",array("class"=>"form-control"));
									echo "</div>";
								echo "</div>";

								echo "<div class='form-group'>";
									echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>TELP GUDANG</label>";
									echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
									echo form_input("txttelpgudang","",array("class"=>"form-control"));
									echo "</div>";
								echo "</div>";

								echo "<div class='form-group'>";
									echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>NAMA CP GUDANG</label>";
									echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
									echo form_input("txtnamacpgudang","",array("class"=>"form-control"));
									echo "</div>";
								echo "</div>";

								echo "<div class='form-group'>";
									echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>TELP CP GUDANG</label>";
									echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
									echo form_input("txttelpcpgudang","",array("class"=>"form-control"));
									echo "</div>";
								echo "</div>";

								

								/*	echo "ID GUDANG:".form_input("txtidgudang")."<br>";
									echo "NAMA GUDANG:".form_input("txtnamagudang")."<br>";
									echo "ALAMAT GUDANG:".form_input("txtalamatgudang")."<br>";
									echo "TELP GUDANG:".form_input("txttelpgudang")."<br>";
									echo "NAMA CP GUDANG:".form_input("txtnamacpgudang")."<br>";
									echo "TELP CP GUDANG:".form_input("txttelpcpgudang")."<br>";
									echo form_submit("btninsert","INSERT");*/

								echo form_close();
								echo "<div class='form-group'>";
									echo "<div class='col-md-9 col-sm-9 col-xs-12 col-md-offset-3'>";
									echo form_submit("btninsert","Insert",array('id'=>'submitBtn','pesan'=>'Anda yakin insert Gudang?',"class"=>"btn btn-success"));
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