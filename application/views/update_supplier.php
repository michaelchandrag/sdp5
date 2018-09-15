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
                	<h3>Update Supplier</h3>
              	</div>
			</div>

			<div class="row">
				<div class="x_panel">
					<div class="x_content">
						<?php
						echo form_open("Cont/doUpdateSupplier",array('id'=>'form','class'=>'form-horizontal form-label-left'));
						foreach($results as $r)
						{
							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>ID BARANG</label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo form_input("txtidSupplier",$r->ID_SUPPLIER,array("class"=>"form-control","required"=>null, "readonly"=>"true"));
								echo "</div>";
							echo "</div>";
							
								echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>NAMA SUPPLIER</label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo form_input("txtNamaSupp",$r->NAMA_SUPPLIER,array("class"=>"form-control"));
								echo "</div>";
							echo "</div>";

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>NAMA CONTACT PERSON</label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo form_input("txtNamaCP",$r->NAMACP,array("class"=>"form-control"));
								echo "</div>";
							echo "</div>";

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>TELP CONTACT PERSON</label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo form_input("txtTelpCP",$r->TELPCP,array("class"=>"form-control"));
								echo "</div>";
							echo "</div>";

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>ALAMAT SUPPLIER</label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo form_input("txtAlamatSupp",$r->ALAMAT_SUP,array("class"=>"form-control"));
								echo "</div>";
							echo "</div>";

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>TELP SUPPLIER</label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo form_input("txtTelpSupp",$r->TELP_SUP,array("class"=>"form-control"));
								echo "</div>";
							echo "</div>";

							echo "<div class='form-group'>";
									echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>STATUS</label>";
									echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
										echo "<div class=''>";
											echo "<label>";
												if($r->STATUS=='T')
													echo "<input name='txtstatus' type='checkbox' class='js-switch' checked /> AKTIF";
												else
												{
													echo "<input name='txtstatus' type='checkbox' class='js-switch'/> AKTIF";
												}
											echo "</label>";
										echo "</div>";
									echo "</div>";
								echo "</div>";
							
							

							/*echo "<div class='form-group'>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12 col-md-offset-3'>";
								echo form_submit("btnUpdate","Update Supplier",array("class"=>"btn btn-success"));
								echo "</div>";
							echo "</div>";*/
						}
						echo form_close();
						
						echo "<div class='form-group'>";
							echo "<div class='col-md-9 col-sm-9 col-xs-12 col-md-offset-3'>";
							echo form_submit("btninsert","Update",array('id'=>'submitBtn','pesan'=>'Anda Yakin update Supplier ?',"class"=>"btn btn-success"));
							echo "</div>";
						echo "</div>";
						?>
					</div>	
				</div>
			</div>
	</div>
</body>
</html>