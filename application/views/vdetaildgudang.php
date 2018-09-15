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

				//echo 

				?>
				<?php echo $this->breadcrumbs->show(); ?>
            	<h3>LIST BARANG GUDANG :<?php echo $namaGudang ?></h3>
          	</div>
		</div>
		
		<div class="row">
			
				<div class="x_panel">
					<div class="x_content">
						<?php
							$this->table->set_heading("NAMA BARANG","STOK","NO. RAK","ACTION");
							$template=array(
									"table_open"=>"<table id='datatable' class='table table-striped table-bordered'>"
									);
							foreach($data as $row)
							{
								$idbarang=$row->ID_BARANG;
								$link="<a href='".site_url("cgudang/updateDgudang/$idgudang/$idbarang")."'><i class='fa fa-eraser'></i>EDIT</a>";
								$this->table->add_row($row->NAMA_BARANG,$row->STOK,$row->NO_RAK,$link);
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
	                    <h2>Form Insert Detail Gudang</h2>
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
								foreach($dataBarangBelumInsert as $row)
								{
									$option[$row->ID_BARANG]=$row->NAMA_BARANG;
								}

									echo form_open("cgudang/doInsertBarangDetailGudang",array('class'=>'form-horizontal form-label-left',"id"=>"form"));

										echo "<div class='form-group'>";
											echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'></label>";
											echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
											echo form_hidden("txtidgudang",$idgudang,array("class"=>"form-control"));
											echo "</div>";
										echo "</div>";

										echo "<div class='form-group'>";
											echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>NAMA BARANG</label>";
											echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
											echo form_dropdown("dropidbarang",$option,"",array("class"=>"form-control"));
											echo "</div>";
										echo "</div>";

										echo "<div class='form-group'>";
											echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>STOK</label>";
											echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
											echo form_input("txtstok","",array("class"=>"form-control"));
											echo "</div>";
										echo "</div>";

										echo "<div class='form-group'>";
											echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>NO RAK</label>";
											echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
											echo form_input("txtnorak","",array("class"=>"form-control"));
											echo "</div>";
										echo "</div>";

										/*echo "ID BRAND".form_input("txtidbrand")."<br>";
										echo "NAMA BRAND".form_input("txtnamabrand")."<br>";
										echo form_submit("btninsert","Insert")."<br>";*/
									echo form_close();
									

									echo "<div class='form-group'>";
										echo "<div class='col-md-9 col-sm-9 col-xs-12 col-md-offset-3'>";
										//echo form_submit("btninsert","Insert",array("id"=>"submitBtn","class"=>"btn btn-success"));
										echo "<button id='submitBtn' pesan='Anda Yakin Insert Detail Gudang ?' class='btn btn-success'>Insert</button>";
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