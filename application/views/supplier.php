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
                	<h3>Supplier</h3>
              	</div>
			</div>

			<div class="row">
				<div class="x_panel">
					<div class="x_content">
					<?php

					$template=array(
										"table_open"=>"<table id='datatable' class='table table-striped table-bordered'>"
										);
					$this->table->set_heading("NAMA_SUPPLIER","NAMACP","TELPCP","ALAMAT SUPPLIER","TELP SUPPLIER","STATUS","UPDATE");
					foreach($results as $r)
					{
						$link="<a href='".site_url("Cont/update_supplier/$r->ID_SUPPLIER")."'>EDIT</a>";
						if($r->STATUS == "T")
						{
							$status = "AKTIF";
						}
						else
						{
							$status= "TIDAK AKTIF";
						}
						$this->table->add_row($r->NAMA_SUPPLIER,$r->NAMACP,$r->TELPCP,$r->ALAMAT_SUP,$r->TELP_SUP,$status,$link);
						
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
					<h2>Form Insert Supplier</h2>
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
						echo form_open("Cont/doInsertSupplier",array('id'=>'form','class'=>'form-horizontal form-label-left'));

						echo "<div class='form-group'>";
							echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>ID KATEGORI</label>";
							echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
							echo form_input("txtidkategori",$id,array("class"=>"form-control", "readonly"=>"true"));
							echo "</div>";
						echo "</div>";
						
						echo "<div class='form-group'>";
							echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>NAMA SUPPLIER</label>";
							echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
							echo form_input("txtNamaSupp","",array("class"=>"form-control"));
							echo "</div>";
						echo "</div>";

						echo "<div class='form-group'>";
							echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>NAMA CP</label>";
							echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
							echo form_input("txtNamaCP","",array("class"=>"form-control"));
							echo "</div>";
						echo "</div>";

						echo "<div class='form-group'>";
							echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>TELP CP</label>";
							echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
							echo form_input("txtTelpCP","",array("class"=>"form-control"));
							echo "</div>";
						echo "</div>";

						echo "<div class='form-group'>";
							echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>ALAMAT SUPPLIER</label>";
							echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
							echo form_input("txtAlamatSupp","",array("class"=>"form-control"));
							echo "</div>";
						echo "</div>";

						echo "<div class='form-group'>";
							echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>TELP SUPPLIER</label>";
							echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
							echo form_input("txtTelpSupp","",array("class"=>"form-control"));
							echo "</div>";
						echo "</div>";
						
						echo form_close();
						
						
						echo "<div class='form-group'>";
							echo "<div class='col-md-9 col-sm-9 col-xs-12 col-md-offset-3'>";
							echo form_submit("insert","Insert",array('id'=>'submitBtn','pesan'=>'Anda Yakin insert Supplier ?',"class"=>"btn btn-success"));
							echo "</div>";
						echo "</div>";

						?>
				</div>
		</div>
	</div>
</div>


				</div>
	</div>
</body>
</html>