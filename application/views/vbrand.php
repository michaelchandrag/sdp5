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

            	<h3>List Brand</h3>
          	</div>
		</div>

		<div class="row">
				<div class="x_panel">
					<div class="x_content">	
							<?php
								$template=array(
								"table_open"=>"<table id='datatable' class='table table-striped table-bordered'>"
								);
								$this->table->set_heading("ID BRAND","NAMA BRAND","STATUS","ACTION");

								foreach($data as $row)
								{
									
									$idbrand=$row->ID_BRAND;
									$link="<a href='".site_url("cgudang/updateBrand/$idbrand")."'><i class='fa fa-eraser'></i>EDIT</a>";
									if($row->STATUS=="T")
									{
										$status="AKTIF";
									}
									else
									{
										$status="NON-AKTIF";
									}


									$this->table->add_row($row->ID_BRAND,$row->NAMA_BRAND,$status,$link);
								}
								
								//autogenerate kode brand
								$idbrand=$this->mbrand->selectMaxIdBrand()->ID_BRAND;
								if(!$idbrand)
									$idbrand=0;
								else
									$idbrand=substr($idbrand,2,3);
								$idbrand=$idbrand+1;
								$hasilkode = "BR".str_pad($idbrand, 3, "0", STR_PAD_LEFT);
								$idbrand = $hasilkode;

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
	                    <h2>Form Insert Brand</h2>
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
									echo form_open("cgudang/doInsertBrand",array('id'=>'form','class'=>'form-horizontal form-label-left'));

										echo "<div class='form-group'>";
											echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>ID BRAND</label>";
											echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
											echo form_input("txtidbrand",$idbrand,array("class"=>"form-control", "readonly"=>"true"));
											echo "</div>";
										echo "</div>";

										echo "<div class='form-group'>";
											echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>NAMA BRAND</label>";
											echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
											echo form_input("txtnamabrand","",array("class"=>"form-control"));
											echo "</div>";
										echo "</div>";


										

										/*echo "ID BRAND".form_input("txtidbrand")."<br>";
										echo "NAMA BRAND".form_input("txtnamabrand")."<br>";
										echo form_submit("btninsert","Insert")."<br>";*/
									echo form_close();

									echo "<div class='form-group'>";
										echo "<div class='col-md-9 col-sm-9 col-xs-12 col-md-offset-3'>";
										echo form_submit("btninsert","Insert",array('id'=>'submitBtn','pesan'=>'Anda yakin insert Brand ?',	"class"=>"btn btn-success"));
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