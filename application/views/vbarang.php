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
					

                	<h3>List Barang</h3>
              	</div>
			</div>

			<div class="row">
				<div class="x_panel">
					<div class="x_content">
						<?php
							$template=array(
							"table_open"=>"<table id='datatable' class='table table-striped table-bordered'>"
							);

							$this->table->set_heading("NAMA BARANG","KATEGORI","BRAND","HARGA BELI","HARGA JUAL","SIZE","STATUS","ACTION");

							
							foreach($data as $row)
							{
								$idbarang=$row->ID_BARANG;

								if($row->STATUS=="T")
								{
									$status="AKTIF";
								}
								else
								{
									$status="NON-AKTIF";
								}

								$link="<a href='".site_url("cgudang/updateBarang/$idbarang")."'><i class='fa fa-eraser'></i>EDIT</a>";
								$this->table->add_row($row->NAMA_BARANG,$row->NAMA_KATEGORI,$row->NAMA_BRAND,$row->HARGA_BELI,$row->HARGA_JUAL,$row->SIZE,$status,$link);

							}
							//autogenerate kode barang
							$idbarang=$this->mbarang->selectMaxIdBarang("BA".date('m').date('y')."")->ID_BARANG;

							if($idbarang==null)
							{
								$idbarang=0;

							}
							else
							{
								$idbarang=substr($idbarang,6,4);
							}

							$idbarang=$idbarang+1;
							$hasilkode = "BA".date('m').date('y').str_pad($idbarang, 4, "0", STR_PAD_LEFT);
							$idbarang = $hasilkode;
							
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
			                    <h2>Form Insert Barang</h2>
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
									//to fill drop kategori
									foreach($kategori as $row)
									{
										if($row->STATUS=='T')
										$dataKategori[$row->ID_KATEGORI]=$row->NAMA_KATEGORI;
									}
									//to fill drop brand
									foreach($brand as $row)
									{
										if($row->STATUS=='T')
										$dataBrand[$row->ID_BRAND]=$row->NAMA_BRAND;
									}

									echo form_open("cgudang/doInsertBarang",array('id'=>'form','class'=>'form-horizontal form-label-left'));
											
											echo "<div class='form-group'>";
												echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>ID BARANG</label>";
												echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
												echo form_input("txtidbarang",$idbarang,array("class"=>"form-control","required"=>null, "readonly"=>"true"));
												echo "</div>";
											echo "</div>";

											echo "<div class='form-group'>";
												echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>KATEGORI</label>";
												echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
												echo form_dropdown("dropkategori",$dataKategori,array("class"=>"form-control"));
												echo "</div>";
											echo "</div>";

											echo "<div class='form-group'>";
												echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>BRAND</label>";
												echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
												echo form_dropdown("dropbrand",$dataBrand,array("class"=>"form-control"));
												echo "</div>";
											echo "</div>";

											echo "<div class='form-group'>";
												echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>NAMA BARANG</label>";
												echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
												echo form_input("txtnamabarang","",array("class"=>"form-control"));
												echo "</div>";
											echo "</div>";

											echo "<div class='form-group'>";
												echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>HARGA JUAL</label>";
												echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
												echo form_input("txthargajual","",array("class"=>"form-control","required"=>null));
												echo "</div>";
											echo "</div>";

											echo "<div class='form-group'>";
												echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>HARGA BELI</label>";
												echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
												echo form_input("txthargabeli","",array("class"=>"form-control","required"=>null));
												echo "</div>";
											echo "</div>";

											echo "<div class='form-group'>";
												echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>SIZE</label>";
												echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
												echo form_input("txtsize","",array("class"=>"form-control"));
												echo "</div>";
											echo "</div>";

											
											
											
												
										echo form_close();

											echo "<div class='form-group'>";
												echo "<div class='col-md-9 col-sm-9 col-xs-12 col-md-offset-3'>";
												echo form_submit("btninsert","Insert",array('id'=>'submitBtn','pesan'=>'Anda Yakin insert Barang ?',"class"=>"btn btn-success"));
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