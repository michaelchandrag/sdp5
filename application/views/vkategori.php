<!DOCTYPE html>
<html>
<head>

	<title></title>
</head>
<body>
	<?php print_r( $this->session->flashdata("message")); ?>
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

                	<h3>List Kategori</h3>
              	</div>
			</div>
			
			<div class="row">
				<div class="x_panel">
					<div class="x_content">	
						<?php
							$template=array(
							"table_open"=>"<table id='datatable' class='table table-striped table-bordered'>"
							);
							$this->table->set_heading("NAMA KATEGORI","STATUS","ACTION");

							foreach($data as $row)
							{
								$idkategori=$row->ID_KATEGORI;
								$link="<a href='".site_url("cgudang/updateKategori/$idkategori")."'><i class='fa fa-eraser'></i>EDIT</a>";
								if($row->STATUS=="T")
								{
									$status="AKTIF";
								}
								else
								{
									$status="NON-AKTIF";
								}

								$this->table->add_row($row->NAMA_KATEGORI,$status,$link);
							}

							//autogenerate kode kategori
							$idkategori=$this->mkategori->selectMaxIdKategori()->ID_KATEGORI;
							if(!$idkategori)
								$idkategori=0;
							else
								$idkategori=substr($idkategori,1,2);
							
							$idkategori=$idkategori+1;
							$hasilkode = "K".str_pad($idkategori, 2, "0", STR_PAD_LEFT);
							$idkategori = $hasilkode;

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
			                    <h2>Form Insert Kategori</h2>
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
								echo form_open("cgudang/doInsertKategori",array('id'=>'form','class'=>'form-horizontal form-label-left'));
									
									echo "<div class='form-group'>";
										echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>ID KATEGORI</label>";
										echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
										echo form_input("txtidkategori",$idkategori,array("class"=>"form-control", "readonly"=>"true"));
										echo "</div>";
									echo "</div>";

									echo "<div class='form-group'>";
										echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>NAMA KATEGORI</label>";
										echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
										echo form_input("txtnamakategori","",array("class"=>"form-control"));
										echo "</div>";
									echo "</div>";

									

									/*echo "ID KATEGORI".form_input("txtidkategori")."<br>";
									echo "NAMA KATEGORI".form_input("txtnamakategori")."<br>";
									echo form_submit("btninsert","INSERT");*/
								echo form_close();
								echo "<div class='form-group'>";
										echo "<div class='col-md-9 col-sm-9 col-xs-12 col-md-offset-3'>";
										echo form_submit("btninsert","Insert",array('id'=>'submitBtn','pesan'=>'Anda yaking insert Kategori?',"class"=>"btn btn-success"));
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