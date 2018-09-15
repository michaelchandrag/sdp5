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

            	<h3>Transfer Gudang</h3>
          	</div>
		</div>

	
	<div class="row">
		<div class="x_panel">
			<div class="x_content">
				<?php 
					$this->table->set_heading("TGL","GUDANG ASAL","GUDANG TUJUAN","KETERANGAN","ACTION");
					$template=array(
								"table_open"=>"<table id='datatable' class='table table-striped table-bordered'>"
								);


					foreach($data as $row)
					{
						$idTransferGudang=$row->ID_TRANS_GUDANG;
						$link="<a href='".site_url("cgudang/detailTransferGudang/$idTransferGudang")."'><i class='fa fa-eraser'></i>VIEW</a>";
						$this->table->add_row($row->TGL,$row->ASAL,$row->TUJUAN,$row->KETERANGAN,$link);
					}

					$this->table->set_template($template);
					echo $this->table->generate();
				?>

			</div>
		
		</div>

	</div>

	

	
	
	
	<h3>Form Insert Transfer Gudang</h3>
	<div class="row">
		<div class="x_panel">
			

			<div class="x_title">
                <h2>Form Insert Transfer Gudang</h2>
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

					foreach($dataGudang as $row)
					{
						if($row->STATUS=="T")
						$opt[$row->ID_GUDANG]=$row->NAMA_GUDANG;
					}


					

					if($this->session->userdata("idtransgudang"))
					{
						foreach($dataBarang as $row)
						{
							$option[$row->ID_BARANG]=$row->NAMA_BARANG."-".$row->STOK;
						}


						
							$this->table->set_heading("NAMA BARANG","QTY");

							foreach($this->cart->contents() as $row)
							{
								$realQty=$row["qty"];
								$actionQty="<div class='col-sm-10'>".form_open("Cgudang/doUpdateDetailTransferGudang").form_hidden("txtrowid",$row["rowid"])."<input name='txtqty' type='number' min='0' max='999' value=$realQty class='form-control'></div><div class='col-sm-2'>".form_submit("btnupdate","Update",array('class'=>'btn btn-success'))."</div>".form_close();
								$this->table->add_row($row["name"],$actionQty);
							}

							echo $this->table->generate();
							echo form_open("cgudang/doInsertDetailTransferGudang",array('class'=>'form-horizontal form-label-left'));
							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>NAMA BARANG</label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								
								echo form_dropdown("dropidbarang",$option,"",array("class"=>"form-control"));
								echo "</div>";
							echo "</div>";

							echo "<div class='form-group'>";
								echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>QTY</label>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
								echo form_input("txtqty","",array("class"=>"form-control"));
								echo "</div>";
							echo "</div>";

							echo "<div class='form-group'>";
								echo "<div class='col-md-9 col-sm-9 col-xs-12 col-md-offset-3'>";
								echo form_submit("btnadd","Add",array("class"=>"btn btn-success"));
								echo "</div>";
							echo "</div>";

							

						echo form_close();

						echo "<div class='form-group'>";
							echo "<div class='col-md-9 col-sm-9 col-xs-12 col-md-offset-3'>";
							echo "<a href='".site_url("cgudang/doCompleteTransferGudang")."'><button class='btn btn-success'>Complete!</button></a>";
							echo "<a href='".site_url("cgudang/doCancelTransferGudang")."'><button class='btn btn-success'>Cancel</button></a>";

							echo "</div>";
						echo "</div>";
					}
					else
					{
							echo form_open("cgudang/doInsertTransferGudang",array('class'=>'form-horizontal form-label-left'));

								echo "<div class='form-group'>";
									echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>ID TRANSFER GUDANG</label>";
									echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
									echo form_input("txtidtransgudang",$genidtransgudang,array("class"=>"form-control","readonly"=>null));
									echo "</div>";
								echo "</div>";

								echo "<div class='form-group'>";
									echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>ASAL</label>";
									echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
									echo form_dropdown("dropidgudang",$opt,"",array("class"=>"form-control"));
									echo "</div>";
								echo "</div>";


								echo "<div class='form-group'>";
									echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>TUJUAN</label>";
									echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
									echo form_dropdown("dropgudidgudang",$opt,"",array("class"=>"form-control"));
									echo "</div>";
								echo "</div>";

								echo "<div class='form-group'>";
						        	echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>TGL<span class='required'>*</span>";
						           echo "</label>";
						           echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
									echo "<input type='date' value='".$dateTransferGudang."' name='txttgl' class='form-control'>";
									echo "</div>";
					            echo "</div>";

					            echo "<div class='form-group'>";
									echo "<label class='control-label col-md-3 col-sm-3 col-xs-12'>KETERANGAN</label>";
									echo "<div class='col-md-9 col-sm-9 col-xs-12'>";
									echo form_input("txtketerangan","",array("class"=>"form-control"));
									echo "</div>";
								echo "</div>";

					            echo "<div class='form-group'>";
									echo "<div class='col-md-9 col-sm-9 col-xs-12 col-md-offset-3'>";
									echo form_submit("btninsert","Insert",array("class"=>"btn btn-success"));
									echo "</div>";
								echo "</div>";

							echo form_close();
					}
				?>

			</div>

		</div>
	</div>
	</div>
	<script>
      $(document).ready(function() {
        $('#birthday').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_4"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
      });
     
    </script>
</body>
</html>