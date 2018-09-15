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

				//

				?>
				
				<?php echo $this->breadcrumbs->show(); ?>
            	
            	<h3><?php echo $namaGudang ?></h3>
            	<h3> EDIT BARANG <?php echo $namaBarang ?> </h3>
          	</div>
		</div>
	
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
                    <h2>Form Update Stok & No.Rak</h2>
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
						echo form_open("cgudang/doUpdateDgudang",array("id"=>"form",'class'=>'form-horizontal form-label-left'));

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'></label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo form_hidden("txtidgudang",$idgudang,array("class"=>"form-control"));
								echo "</div>";
							echo "</div>";

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'></label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo form_hidden("txtidbarang",$idbarang,array("class"=>"form-control"));
								echo "</div>";
							echo "</div>";

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>NAMA BARANG</label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo form_input("txtnamabarang",$namaBarang,array("class"=>"form-control","disabled"=>null));
								echo "</div>";
							echo "</div>";

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>STOK</label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo form_input("txtstok",$data->STOK,array("class"=>"form-control"));
								echo "</div>";
							echo "</div>";


							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>NO. RAK</label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo form_input("txtrak",$data->NO_RAK,array("class"=>"form-control"));
								echo "</div>";
							echo "</div>";

					


							

						

						echo form_close();
							echo "<div class='form-group'>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12 col-md-offset-3'>";
								echo form_submit("btnupdate","Update",array('id'=>'submitBtn',"pesan"=>"Anda yakin update detail gudang?","class"=>"btn btn-success"));
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