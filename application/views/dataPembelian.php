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
            	<h3>Report Data Pembelian</h3>

          	</div>
		</div>

	
	<div class="row">
		<div class="x_panel">
			<div class="x_content">
				

				<?php 
					echo form_open("Cont/dataPembelian",array('class'=>'form-horizontal form-label-left'));

					echo "<div class='form-group'>";
						echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>FROM</label>";
						echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
						echo "<input type='date' name='txtfromdate' value='$fromdate' class='form-control'>";
						//echo form_input("dropidbarang",$option,"",array("class"=>"form-control"));
						echo "</div>";
					echo "</div>";
					echo "<div class='form-group'>";
						echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>TO</label>";
						echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
						echo "<input type='date' value='$todate' name='txttodate' class='form-control'>";
						//echo form_input("dropidbarang",$option,"",array("class"=>"form-control"));
						echo "</div>";
					echo "</div>";

					echo "<div class='form-group'>";
						echo "<div class='col-md-9 col-sm-9 col-xs-12 col-md-offset-3'>";
						echo form_submit("btnchange","Find",array("class"=>"btn btn-success"));
						echo "</div>";
					echo "</div>";

					echo form_close();

					echo "<hr>";

					$template=array(
					"table_open"=>"<table id='datatable' class='table table-striped table-bordered'>"
					);
				echo form_open("Cont/hbeli");
				$this->table->set_heading("NAMA SUPPLIER","NAMA GUDANG","TANGGAL","STATUS LUNAS","TOTAL","ACTION");

					/*foreach($data as $row)
					{
						$idkategori=$row->ID_KATEGORI;
						$link="<a href='".site_url("cgudang/updateKategori/$idkategori")."'>EDIT</a>";
						$this->table->add_row($row->NAMA_KATEGORI,$link);
					}*/
				foreach($data as $r)
				{
				$id = $r->ID_HBELI;
				$ids = $r->ID_SUPPLIER;
				foreach($supplier as $k)
				{
					if($ids == $k->ID_SUPPLIER)
					{
						$supp = $k->NAMA_SUPPLIER;
					}
				}
				$idg = $r->ID_GUDANG;
				foreach($gudang as $k)
				{
					if($idg == $k->ID_GUDANG)
					{
						$gud = $k->NAMA_GUDANG;
					}
				}
				$tanggal = $r->TANGGAL;
				$status = $r->STATUS_LUNAS;
				if($status == "1")
				{
					$s = "LUNAS";
				}
				else
				{
					$s = "BELUM LUNAS";
				}
				$total = $r->TOTAL;
				$link="<a href='".site_url("Cont/dbeli/$id")."'>EDIT</a>";
				$this->table->add_row($supp,$gud,$tanggal,$s,$total,$link);
				}
				$this->table->set_template($template);
				echo $this->table->generate();
				//echo form_submit("back","Back");
				echo form_close();
				?>

			</div>
		
		</div>

	</div>