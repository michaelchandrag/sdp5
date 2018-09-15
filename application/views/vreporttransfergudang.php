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

            	<h3>Report Transfer Gudang</h3>

          	</div>
		</div>

	
	<div class="row">
		<div class="x_panel">
			<div class="x_content">
				

				<?php 
					echo form_open("cgudang/reporttransfergudang",array('class'=>'form-horizontal form-label-left'));

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
						echo form_submit("btnchange","Show",array("class"=>"btn btn-success"));
						echo "</div>";
					echo "</div>";

					echo form_close();

					echo "<hr>";

					$this->table->set_heading("TGL","GUDANG ASAL","GUDANG TUJUAN","KETERANGAN","ACTION");
					$template=array(
								"table_open"=>"<table id='' class='table table-striped table-bordered'>"
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