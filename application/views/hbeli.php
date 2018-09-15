<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="right_col" role="main">
			<div class="page-title">
			
				<div class="title_left">

                	<h3>Koreksi / Hapus</h3>
              	</div>
			</div>

			<div class="row">
				<div class="x_panel">
					<div class="x_content">
				<?php
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
				foreach($results as $r)
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
	</div>
</body>
</html>