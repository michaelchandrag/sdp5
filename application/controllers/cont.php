<?php
class Cont extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper("url");
		$this->load->helper("form");
		$this->load->model("Model");
		$this->load->model("mkategori");
		$this->load->library("session");
		$this->load->library("pagination");
		$this->load->helper("date");
		$this->load->library("table");
		$this->load->library("form_validation");
	}
	
	public function index()
	{
		redirect("Cont/supplier");
	}
	
	public function menu()
	{
	
		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("assetsScript");
		$this->load->view("menu");
		if($this->input->post("btnSupplier"))
		{
			redirect("Cont/supplier");
		}
		else if($this->input->post("btnKategori"))
		{
			redirect("Cont/kategori");
		}
		else if($this->input->post("btnMaster"))
		{
			redirect("Cont/master");
		}
		else if($this->input->post("btnHbeli"))
		{
			redirect("Cont/hbeli");
		}
	}
	
	public function dataPembelian()
	{
		$results = $this->Model->get_hbeli();
		$data["results"] = $results;
		$supplier = $this->Model->get_supplier();
		$data["supplier"] = $supplier;
		$gudang = $this->Model->get_gudang();
		$data["gudang"] = $gudang;
		$tglawal = $this->input->post("txtfromdate");
		$tglakhir = $this->input->post("txttodate");
		if($this->input->post("btnchange"))
		{
			if(strtotime($tglawal) > strtotime($tglakhir))
			{
				$this->session->set_flashdata("alert","Pengisian Tanggal Tidak Sesuai");
				$data["fromdate"]=date_create(date("Y-m-d"));
				date_sub($data["fromdate"],date_interval_create_from_date_string("7 days"));
				$data["fromdate"]=date_format($data["fromdate"],"Y-m-d");
				$data["todate"]=date("Y-m-d");
			}
			else
			{
				if(isset($_SESSION['alert'])){
						unset($_SESSION['alert']);
					}
				$data["fromdate"]=$this->input->post("txtfromdate");

				$data["todate"]=$this->input->post("txttodate");
				$data["data"]=$this->Model->report_data_pembelian($data["fromdate"],$data["todate"]);
			}
		}
		else
		{
			$data["fromdate"]=date_create(date("Y-m-d"));
			date_sub($data["fromdate"],date_interval_create_from_date_string("7 days"));
			$data["fromdate"]=date_format($data["fromdate"],"Y-m-d");
			$data["todate"]=date("Y-m-d");
			//$data["data"]=$this->Model->report_data_pembelian($data["fromdate"],$data["todate"]);
		}
		$data["data"]=$this->Model->report_data_pembelian($data["fromdate"],$data["todate"]);
		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("assetsScript");
		$this->load->view("dataPembelian",$data);
	}
	public function supplier()
	{
		$data["results"] = $this->Model->get_supplier();
		
		$arrSupplier = $this->Model->get_supplier();
		$depan = "SU";
		$banyak = 0;
		foreach($arrSupplier as $r)
		{
			$banyak++;
		}
		$id = $depan.str_pad(($banyak+1),3,"0",STR_PAD_LEFT);
		$data["id"] = $id;
		
		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("supplier",$data);
		$this->load->view("assetsScript");
		
	}
	
	public function insert_supplier()
	{
		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("assetsScript");
		$this->load->view("insert_supplier");
		
		
	}
	
	public function doInsertSupplier()
	{
		$namaS = $this->input->post("txtNamaSupp");
		$namaCP = $this->input->post("txtNamaCP");
		$telpCP = $this->input->post("txtTelpCP");
		$alamatS = $this->input->post("txtAlamatSupp");
		$telpS = $this->input->post("txtTelpSupp");
		
		$this->form_validation->set_rules("txtNamaSupp","Nama Supplier","required|max_length[25]");
		$this->form_validation->set_rules("txtNamaCP","Nama Contact Person","required|max_length[25]");
		$this->form_validation->set_rules("txtTelpCP","Telp Contact Person","required|integer");
		$this->form_validation->set_rules("txtAlamatSupp","Alamat Supplier","required|max_length[25]");
		$this->form_validation->set_rules("txtTelpSupp","Telp Supplier","required|integer");
		if($this->form_validation->run()==true)
		{
			$arrSupplier = $this->Model->get_supplier();
			$depan = "SU";
			$banyak = 0;
			foreach($arrSupplier as $r)
			{
				$banyak++;
			}
			$id = $depan.str_pad(($banyak+1),3,"0",STR_PAD_LEFT);
			$this->Model->insert_supplier($id,$namaS,$namaCP,$telpCP,$alamatS,$telpS);
			
			$this->session->set_flashdata("message","Berhasil Insert Supplier");

		}
		else
		{
			$this->session->set_flashdata("alert",validation_errors());
		}
		redirect("Cont/supplier");
		
	
	}
	
	public function update_supplier($id)
	{
		$results = $this->Model->get_supplier_where($id);
		$data["id_supplier"] = $id;
		$data["results"] = $results;
		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("update_supplier",$data);
		$this->load->view("assetsScript");

	}
	
	public function doUpdateSupplier()
	{
		$id = $this->input->post("txtidSupplier");
		$namaS = $this->input->post("txtNamaSupp");
		$namaCP = $this->input->post("txtNamaCP");
		$telpCP = $this->input->post("txtTelpCP");
		$alamatS = $this->input->post("txtAlamatSupp");
		$telpS = $this->input->post("txtTelpSupp");
		if($this->input->post("txtstatus"))
		{
			$status="T";
		}
		else
		{
			$status="F";
		}
		$this->form_validation->set_rules("txtNamaSupp","Nama Supplier","required|max_length[25]");
		$this->form_validation->set_rules("txtNamaCP","Nama Contact Person","required|max_length[25]");
		$this->form_validation->set_rules("txtTelpCP","Telp Contact Person","required|integer");
		$this->form_validation->set_rules("txtAlamatSupp","Alamat Supplier","required|max_length[25]");
		$this->form_validation->set_rules("txtTelpSupp","Telp Supplier","required|integer");
		
		if($this->form_validation->run()==true)
		{
			$this->session->set_flashdata("message","Berhasil Update Supplier");
			$this->Model->update_supplier($id,$namaS,$namaCP,$telpCP,$alamatS,$telpS,$status);
			redirect("Cont/supplier");
		}
		else
		{
			$this->session->set_flashdata("alert",validation_errors());
			//redirect("Cont/update_supplier/$id");
		}
		redirect("Cont/update_supplier/$id");
	}
	
	public function kategori()
	{
		$this->load->view("kategori");
		if($this->input->post("back"))
		{
			redirect("Cont/menu");
		}
		else if($this->input->post("insert"))
		{
			$jumlah = $this->Model->count_kategori();
			$id = str_pad(($jumlah+1),3,"0",STR_PAD_LEFT);
			$nama = $this->input->post("txtNama");
			if($nama != "")
			$this->Model->insert_kategori($id,$nama);
			
		}
	}
	
	public function master()
	{
		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$data["fromdate"]=date_create(date("Y-m-d"));
		date_sub($data["fromdate"],date_interval_create_from_date_string("7 days"));
		$data["fromdate"]=date_format($data["fromdate"],"Y-m-d");
		$data["todate"]=date("Y-m-d");
		$arrSupp = $this->Model->get_supplier();
		$arrGud = $this->Model->get_gudang();	
		$arrBarang = $this->Model->get_barang();
		$temp = 0;
		$supp = [];
		foreach($arrSupp as $r)
		{
			if($r->STATUS == "T")
			{
				$supp[$temp] = $r->ID_SUPPLIER."+".$r->NAMA_SUPPLIER;
				$temp++;	
			}
		}
		$temp = 0;
		$gud = [];
		foreach($arrGud as $r)
		{
			if($r->STATUS == "T")
			{
				$gud[$temp] = $r->ID_GUDANG."+".$r->NAMA_GUDANG;
				$temp++;	
			}
			
		}
		$temp = 0;
		$barang = [];
		$barangHarga = [];
		foreach($arrBarang as $r)
		{
			if($r->STATUS == "T")
			{
				$barang[$temp] = $r->ID_BARANG."+".$r->NAMA_BARANG;
				$barangHarga[$temp] = $r->HARGA_BELI;
				$temp++;	
			}
		}
		$gabung = "";
		$grand = 0;
		$data["arrSupp"] = $arrSupp;
		$data["arrGud"] = $arrGud;
		$data["arrBarang"] = $arrBarang;
		if($this->session->flashdata("gabung"))
		{
			$data["gabung"] = $this->session->flashdata("gabung");
		}
		else
		{
			$data["gabung"] = $this->input->post("gabung");
		}
		$gabung = $data["gabung"];
		if($this->session->flashdata("grand"))
		{
			$data["grand"] = $this->session->flashdata("grand");
		}
		else
		{
			$data["grand"] = 0;
		}
		$grand = $data["grand"];
		$ctr = $this->input->post("gabung");
		if($this->input->post("back"))
		{
			redirect("cont/menu");
		}
		else if($this->input->post("tambah"))
		{
			if(isset($_SESSION['alert']))
			{
				unset($_SESSION['alert']);
			}
			$grand = $this->input->post("grand");
			$indeks = $this->input->post("barang");
			$brg = $barang[$indeks];
			$pesan = $this->input->post("pesan");
			$datang = $this->input->post("datang");
			$potong = explode(";",$gabung);
			$ada = false;
			for($i=0;$i<count($potong);$i++)
			{
				if($potong[$i] != "")
				{
					$potong2 = explode("+",$potong[$i]);
					$nama_barang = explode("+",$brg);
					if($potong2[1] == $nama_barang[1])
					{
						$ada = true;
					}
				}
			}
			if($ada == true)
			{
				$this->session->set_flashdata("alert","Barang sudah dipakai, jika ingin melakukan perubahan lakukan Discard terlebih dahulu.");
				//$this->session->set_flashdata("alert",$gabung);
			}
			else
			{
				if($pesan >= $datang && $pesan >=0 && $datang >=0 && $pesan != "" && $datang != "")
				{
					$ctr = $this->input->post("gabung");
					$harga = $barangHarga[$indeks];
					$total = $pesan*$harga;
					$gabung = $brg."+".$pesan."+".$datang."+".$total."+".$harga;
					$data["gabung"] = $ctr.";".$gabung;
					$grand = $total + $grand;
					$data["grand"] = $grand;
					//$this->session->set_flashdata("alert",$gabung);
				}
				else
				{
					$this->session->set_flashdata("alert","Qty datang harus lebih kecil / sama dengan dari qty pesan / error angka");
				}
			}
			
		}
		else if($this->input->post("discard"))
		{
			$asd = $this->input->post("discard");
			$indeks = substr($asd,7);
			$gabung = $this->input->post("gabung");
			$potong = explode(";",$gabung);
			$gabung = "";
			$grand = 0;
			$indeks+=1;
			for($i =0;$i<count($potong);$i++)
			{
				if($i!=$indeks && $potong[$i] != "")
				{
					$gabung = $gabung.";".$potong[$i];
					$potong2 = explode("+",$potong[$i]);
					$grand = $grand + $potong2[4];
				}
			}
			$data["gabung"] = $gabung;
			$data["grand"] = $grand;
		}
		else if($this->input->post("submit"))
		{
			$this->form_validation->set_rules("txttgl","Tanggal","required");
			if($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata("alert",validation_errors());
			}
			else
			{
				$jumlah = $this->Model->count_hbeli();
				$id = 'BELI'.str_pad(($jumlah+1),3,"0",STR_PAD_LEFT);
				$indeksSupp = $this->input->post("supplier");
				$potong = explode("+",$supp[$indeksSupp]);
				$ids = $potong[0];
				$indeksGud = $this->input->post("gudang");
				$potong = explode("+",$gud[$indeksGud]);
				$idg = $potong[0];
				$status_lunas = 0;
				$total = $this->input->post("grand");
				$tanggal = $this->input->post("txttgl");;
				
				$this->Model->insert_hbeli($id,$ids,$idg,$tanggal,$status_lunas,$total);
				$gabung = $this->input->post("gabung");
				$potong = explode(";",$gabung);
				$gudang = $this->Model->get_dgudang_where($idg);
				$g = 0;
				$id_barang = [];
				$stok = [];
				foreach($gudang as $r)
				{
					$id_barang[$g] = $r->ID_BARANG;
					$stok[$g] = $r->STOK; 
					$g++;
				}
				$data["g"] = $g;
				for($i=0;$i<count($potong);$i++)
				{
					if($potong[$i] != "")
					{
						$potong2 = explode("+",$potong[$i]);
						$idbarang = $potong2[0];
						$namabarang = $potong2[1];
						$qtypesan = $potong2[2];
						$qtydatang = $potong2[3];
						$subtotal = $potong2[4];
						$harga_beli = $potong2[5];
						$this->Model->insert_dbeli($id,$idbarang,$namabarang,$qtypesan,$qtydatang,$subtotal,$harga_beli);
						$ada = false;
						$ind = 0;
						for($j=0;$j<$g;$j++)
						{
							if($id_barang[$j] == $idbarang)
							{
								$ada = true;
								$ind = $j;
							}
						}
						if($ada == true)
						{
							$stock = $stok[$ind];
							$stock = $stock+$qtydatang;
							$this->Model->update_stok_dgudang($idg,$idbarang,$stock);
						}
						else if($ada == false)
						{
							$this->Model->insert_dgudang($idg,$idbarang,$qtydatang);
						}
					}
				}
				
				$data["grand"] = 0;
				$data["gabung"] = "";
			}
			
		}
		$this->load->view("master",$data);
		$this->load->view("assetsScript");
	}
	
	public function discard($id)
	{
		$asd = $this->input->post("discard");
		$indeks = $id;
		$gabung = $this->input->post("gabung2");
		echo $gabung;
		$potong = explode(";",$gabung);
		$gabung = "";
		$grand = 0;
		$indeks+=1;
		for($i =0;$i<count($potong);$i++)
		{
			if($i!=$indeks && $potong[$i] != "")
			{
				$gabung = $gabung.";".$potong[$i];
				$potong2 = explode("+",$potong[$i]);
				$grand = $grand + $potong2[4];
			}
		}
		$this->session->set_flashdata("gabung",$gabung);
		$this->session->set_flashdata("grand",$grand);
		redirect("Cont/master");
	}
	
	public function hbeli()
	{
			$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		
		$results = $this->Model->get_hbeli();
		$data["results"] = $results;
		$supplier = $this->Model->get_supplier();
		$data["supplier"] = $supplier;
		$gudang = $this->Model->get_gudang();
		$data["gudang"] = $gudang;
		if($this->input->post("back"))
		{
			redirect("Cont/menu");
		}
		$this->load->view("hbeli",$data);
		$this->load->view("assetsScript");
	}
	
	public function dbeli($id)
	{
		$results = $this->Model->get_dbeli_where($id);
		$supplier = $this->Model->get_supplier();
		$data["supplier"] = $supplier;
		$gudang = $this->Model->get_gudang();
		$data["gudang"] = $gudang;
		$data["results"] = $results;
		$hbeli = $this->Model->get_hbeli_where($id);
		$data["hbeli"] = $hbeli;
		$data["id_hbeli"] = $id;
			$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("assetsScript");
		$this->load->view("dbeli",$data);
		if($this->input->post("btnBack"))
		{
			if($this->input->post("txtstatus"))
			{
				$status="1";
			}
			else
			{
				$status="0";
			}
			$this->Model->update_status_hbeli($id,$status);
			redirect("Cont/hbeli/$id");
		}
	}
	
	public function update_dbeli($id)
	{
		
		$pecah = explode("-",$id);
		$id_hbeli = $pecah[0];
		$index = $pecah[1];
		$id_barang = $pecah[2];
		$hbeli = $this->Model->get_hbeli();
		$idg = "";
		$stok = 0;
		$qtypesan = $this->input->post("qtypesan");
		$qtydatang = $this->input->post("qtydatang"); 
		$id_barang = $this->input->post("id_barang");
		$harga_beli = $this->input->post("harga_beli");
		foreach($hbeli as $r)
		{
			if($id_hbeli == $r->ID_HBELI)
			{
				$idg = $r->ID_GUDANG;
			}
		}
		if($this->input->post("update"))
		{
			if($qtypesan>= $qtydatang)
			{
				$subtotal = $harga_beli*$qtypesan;
				
				$dbeli = $this->Model->get_stok_dbeli_where($id_hbeli,$id_barang);
				foreach($dbeli as $r)
				{
					$sebelum = $r->QTYDATANG;
				}
				$jum = $this->Model->count_dbeli_total($id_hbeli);
				foreach($jum as $r)
				{
					$total = $r->SUBTOTAL;
				}
				$this->Model->update_hbeli_total_where($id_hbeli,$total);
				$gudang = $this->Model->get_dgudang_where($idg);
				foreach($gudang as $r)
				{
					if($id_barang == $r->ID_BARANG)
					{
						$stok = $r->STOK;
					}
				}
				$tambahan = $qtydatang;
				if($sebelum < $qtydatang)
				{
					$tambahan = $qtydatang-$sebelum;
					$tambahan = $stok+$tambahan;
				}
				else if($sebelum > $qtydatang)
				{
					$tambahan = $sebelum-$qtydatang;
					$tambahan = $stok-$tambahan;
					
				}
				
				$this->Model->update_dbeli_where($id_hbeli,$id_barang,$qtypesan,$qtydatang,$subtotal);
				$this->Model->update_stok_dgudang($idg,$id_barang,$tambahan);
			}
			else
			{
				$this->session->set_flashdata("alert","Qty datang harus lebih kecil / sama dengan dari qty pesan");
			}
			
		}
		else if($this->input->post("delete"))
		{
			$id_barang = $this->input->post("id_barang");
			$this->Model->delete_dbeli($id_hbeli,$id_barang);
			$qtydatang = $this->input->post("qtydatang"); 
			$id_barang = $this->input->post("id_barang");
			$jum = $this->Model->count_dbeli_total($id_hbeli);
			foreach($jum as $r)
			{
				$total = $r->SUBTOTAL;
			}
			$this->Model->update_hbeli_total_where($id_hbeli,$total);
			$gudang = $this->Model->get_dgudang_where($idg);
			foreach($gudang as $r)
			{
				if($id_barang == $r->ID_BARANG)
				{
					$stok = $r->STOK;
				}
			}
			$tambahan = $stok-$qtydatang;
			$this->Model->update_stok_dgudang($idg,$id_barang,$tambahan);
		}
		redirect("Cont/dbeli/$id_hbeli");
	}
	
	public function print_dbeli($id)
	{
		$results = $this->Model->get_dbeli_where($id);
		$supplier = $this->Model->get_supplier();
		$data["supplier"] = $supplier;
		$gudang = $this->Model->get_gudang();
		$data["gudang"] = $gudang;
		$data["results"] = $results;
		$hbeli = $this->Model->get_hbeli_where($id);
		$data["hbeli"] = $hbeli;
		$data["id_hbeli"] = $id;
		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("printdbeli",$data);
		$this->load->view("assetsScript");
	}
	
}

?>