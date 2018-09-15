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
				<?php //echo "<h6>".$this->breadcrumbs->show()."</h6>"; ?>	

            	<h3>Detail Transfer Gudang </h3>
          	</div>
		</div>

		<div class="row">

				<div class="x_panel">
					<div class="x_title">
                    
	                    <h4>ASAL:</h4>
	                    <h4><?php echo $dataHeader->ASAL ?></h4>
	                    <h4>TUJUAN:</h4>
	                    <h4><?php echo $dataHeader->TUJUAN ?></h4>
	                    <h4>TGL:</h4>
	                    <h4><?php echo $dataHeader->TGL ?></h4>
	                    <h4>KETERANGAN:</h4>
	                    <h4><?php echo $dataHeader->KETERANGAN ?></h4>
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
							$template=array(
								"table_open"=>"<table id='' class='table table-striped table-bordered'>"
								);

							$this->table->set_heading("NAMA BARANG","QTY");

							foreach($dataDetail as $row)
							{
								$this->table->add_row($row->NAMA_BARANG,$row->QTY);
							}


							$this->table->set_template($template);

							echo $this->table->generate();

						?>



					</div>
				</div>
		</div>
	

	</div>
<script>
window.print();

</script>
</body>
</html>