<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

 class Cgudang extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array("url","form","cookie","html"));
		$this->load->library(array("session","table","pagination"));
		$this->load->model("mgudang");
		$this->load->model("mtransgudang");
		$this->load->model("mkategori");
		$this->load->model("mbrand");
		$this->load->model("mbarang");
		$this->load->model("mdgudang");
		$this->load->model("mdtransgudang");
		$this->load->model("mtransgudang");
		$this->load->library("breadcrumbs");
		$this->load->library("form_validation");
		$this->load->library("cart");

		
	}

	

	public function index()
	{

		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("assetsScript");
		redirect("cgudang/insertBarang");

			
	}

	public function reportTransferGudang()
	{
		$data["dataGudang"]=$this->mgudang->selectGudang(0,0);
		
		$data["data"]=$this->mtransgudang->selectTransGudang();

		if($this->input->post("btnchange"))
		{

			if($this->input->post("txtfromdate")<=$this->input->post("txttodate"))
			{
			$data["fromdate"]=$this->input->post("txtfromdate");

			$data["todate"]=$this->input->post("txttodate");
			}
			else
			{
				$this->session->set_flashdata("alert","from date harus lebih kecil dari to date");
				$data["fromdate"]=date_create(date("Y-m-d"));
				date_sub($data["fromdate"],date_interval_create_from_date_string("7 days"));
				$data["fromdate"]=date_format($data["fromdate"],"Y-m-d");
				$data["todate"]=date("Y-m-d");
			}
		}
		else
		{
			$data["fromdate"]=date_create(date("Y-m-d"));
			date_sub($data["fromdate"],date_interval_create_from_date_string("7 days"));
			$data["fromdate"]=date_format($data["fromdate"],"Y-m-d");
			$data["todate"]=date("Y-m-d");
		}

		//$data["dataGudang"]=$this->mgudang->selectGudang(0,0);
		
		$data["data"]=$this->mtransgudang->selectTransGudangforReport($data["fromdate"],$data["todate"]);
		echo $data["fromdate"];
		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("vreporttransfergudang",$data);
		$this->load->view("assetsScript");
	}

	public function doInsertBarangDetailGudang()
	{	
		
		$idgudang=$this->input->post("txtidgudang");
		$idbarang=$this->input->post("dropidbarang");
		$stok=$this->input->post("txtstok");
		$norak=$this->input->post("txtnorak");

		$this->form_validation->set_rules("txtstok","Stok","max_length[3]|integer|greater_than[-1]|required");
		$this->form_validation->set_rules("txtnorak","No. Rak","max_length[2]");

		if($this->form_validation->run())
		{
			$this->session->set_flashdata("message","Berhasil Insert !");
			
			$this->mdgudang->insertDgudang($idgudang,$idbarang,$stok,$norak);

			redirect("cgudang/detailDgudang/$idgudang");

		}
		else
		{

			$this->session->set_flashdata("alert",validation_errors());
			redirect("cgudang/detailDgudang/$idgudang");
		}
		

	}


	public function detailTransferGudang($idtransfergudang)
	{
		$this->breadcrumbs->push("Transfer Gudang","cgudang/transferGudang");
		$this->breadcrumbs->push("Detail Transfer Gudang","cgudang/detailTransferGudang/$idtransfergudang");

		$data["dataHeader"]=$this->mtransgudang->selectTransferGudangById($idtransfergudang);
		$data["dataDetail"]=$this->mdtransgudang->selectDtransgudangById($idtransfergudang);
		$data["idtransfergudang"]=$idtransfergudang;
		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("vdetailtransfergudang",$data);
		$this->load->view("assetsScript");
	}

	public function printDetailTransferGudang($idtransfergudang)
	{
		$data["dataHeader"]=$this->mtransgudang->selectTransferGudangById($idtransfergudang);
		$data["dataDetail"]=$this->mdtransgudang->selectDtransgudangById($idtransfergudang);

		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("vprintdetailtransfergudang",$data);
		$this->load->view("assetsScript");
	}

	public function transferGudang()
	{
		$data["dataGudang"]=$this->mgudang->selectGudang(0,0);
		
		$data["data"]=$this->mtransgudang->selectTransGudang();
		$data["dateTransferGudang"]=date("Y-m-d");

		$data["genidtransgudang"]="TR".date('my');
		$tempurut=$this->mtransgudang->generateNumberIdTransGudang($data["genidtransgudang"]);
		$tempurut->NOURUT+=1;
		$data["genidtransgudang"].=str_pad($tempurut->NOURUT,4,'0',STR_PAD_LEFT);
		if($this->session->userdata("idtransgudang"))
		{
			$data["dataBarang"]=$this->mdgudang->selectBarangByGudang($this->session->userdata("idgudangasal"));
		}

		$this->load->view("assetsCss");
		$this->load->view("vmenu");
		$this->load->view("vtransfergudang",$data);
		$this->load->view("assetsScript");
	}

	public function doInsertTransferGudang()
	{
		$idtransgudang=$this->input->post("txtidtransgudang");
		$idgudangasal=$this->input->post("dropidgudang");
		$idgudangtujuan=$this->input->post("dropgudidgudang");
		$tgl=$this->input->post("txttgl");
		$keterangan=$this->input->post("txtketerangan");

		$this->form_validation->set_rules("txttgl","Tanggal","required");
		$this->form_validation->set_rules("dropidgudang","GUDANG ASAL","callback_checkAsalJenisBarang");
		$this->form_validation->set_rules('dropgudidgudang', 'GUDANG TUJUAN', 'callback_checkTujuan['.$idgudangasal.']');



		if ($this->form_validation->run() == TRUE) {
			
			 $this->session->set_userdata("idtransgudang",$idtransgudang);
			 $this->session->set_userdata("idgudangasal",$idgudangasal);
			 $this->session->set_userdata("idgudangtujuan",$idgudangtujuan);
			 $this->session->set_userdata("tgl",$tgl);
			 $this->session->set_userdata("keterangan",$keterangan);


			redirect("cgudang/transferGudang");
		} else {
			# code...
			$this->session->set_flashdata("alert",validation_errors());
			redirect("cgudang/TransferGudang");
		}

		
	}

	public function checkAsalJenisBarang($str)
	{


		if(!$this->mdgudang->selectCount($str))
		{
				$this->form_validation->set_message("checkAsalJenisBarang","Gudang Asal Tidak Memiliki Barang Untuk Ditransfer");
			return false;
		}
		return true;
	}

	public function checkTujuan($str,$idgudangasal)
	{
		
		if($idgudangasal==$str)
		{
			$this->form_validation->set_message("checkTujuan","Gudang Tujuan Harus Berbeda dengan Gudang Asal");
			return false;
		}
		else
		{
			return true;
		}
	}

	public function doCancelTransferGudang()
	{
		$this->session->unset_userdata("idtransgudang");
		$this->session->unset_userdata("idgudangasal");
		$this->session->unset_userdata("idgudangtujuan");
		$this->session->unset_userdata("tgl");
		$this->session->unset_userdata("keterangan");

		$this->cart->destroy();

		redirect("cgudang/transferGudang");
	}

	public function doCompleteTransferGudang()
	{
		$insert=true;

		if($this->cart->contents())
		{
			foreach($this->cart->contents() as $row)
			{
				//cek stok dari gudang asal apa mencukupi untuk di transfer

				$stokGudangAsal=$this->mdgudang->checkStock($this->session->userdata("idgudangasal"),$row["id"])->STOK;

				if($stokGudangAsal<$row["qty"])
				{
					$insert=false;
					
				}


			}
		}
		else
		{
			$insert=false;
			$this->session->set_flashdata("alert","Isi Transfer Barang Tidak Boleh Kosong");
			redirect("cgudang/transfergudang");
		}

		if($insert)
		{
			//insert ke header transfer gudang
			$idtransfergudang=$this->session->userdata("idtransgudang");
			$idgudangasal=$this->session->userdata("idgudangasal");
			$idgudangtujuan=$this->session->userdata("idgudangtujuan");
			$tgl=$this->session->userdata("tgl");
			$keterangan=$this->session->userdata("keterangan");



			$this->mtransgudang->insertTransGudang($idtransfergudang,$idgudangasal,$idgudangtujuan,$tgl,$keterangan);

			foreach($this->cart->contents() as $row)
			{
				//insert ke tabel dtransgudang
				$this->mdtransgudang->insertDtransgudang($this->session->userdata("idtransgudang"),$row["id"],$row["qty"]);
				//mengurangi stok gudang asal
				$this->mdgudang->substractStokDgudang($idgudangasal,$row["id"],$row["qty"]);

				//menambahkan stok gudang tujuan atau menambahkan barang baru pada gudang tujuan
				$stokNowGudangTujuan=$this->mdgudang->checkStock($idgudangtujuan,$row["id"]);
				if($stokNowGudangTujuan)
				{
					$this->mdgudang->addStokDgudang($idgudangtujuan,$row["id"],$row["qty"]);
				}
				else
				{
					$this->mdgudang->insertDgudang($idgudangtujuan,$row["id"],$row["qty"],null);
				}

			}

			$this->cart->destroy();

			//untuk menghapu session
			$this->session->unset_userdata("idtransgudang");
			$this->session->unset_userdata("idgudangasal");
			$this->session->unset_userdata("idgudangtujuan");
			$this->session->unset_userdata("tgl");
			$this->session->unset_userdata("keterangan");


			$this->session->set_flashdata("message","Berhasil Insert Transfer Gudang");
		}
		else
		{
			$this->session->set_flashdata("alert","Gagal Melakukan Transfer Gudang karena Qty Tidak Mencukupi");
		}

		redirect("cgudang/transferGudang");
	}

	public function doInsertDetailTransferGudang()
	{
		$this->form_validation->set_rules("txtqty","QTY","required|greater_than[0]|integer");

		if($this->form_validation->run())
		{
			$idbarang=$this->input->post("dropidbarang");
			$qty=$this->input->post("txtqty");
			$namabarang=$this->mbarang->selectBarangId($idbarang)->NAMA_BARANG;

			$data = array(
				'id'      => $idbarang,
				'qty'     => $qty,
				'price'   => 0,
				'name'    => $namabarang
			);
			
			$this->cart->insert($data);

			redirect("cgudang/transferGudang");
		}
		else
		{

			$this->session->set_flashdata("alert",validation_errors());
			redirect("cgudang/TransferGudang");
		}

		


	}

	public function infoDgudang()
	{
		

		$data["dataNoRak"]=$this->mdgudang->selectDgudangbyGudang();
		$data["dataAll"]=$this->mdgudang->selectDgudang();
		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("vdgudang",$data);
		$this->load->view("assetsScript");
	}

	public function detailDgudang($idgudang)
	{
		$data["data"]=$this->mdgudang->selectDgudangIdGudang($idgudang);
		$data["namaGudang"]=$this->mgudang->selectGudangId($idgudang)->NAMA_GUDANG;
		$data["idgudang"]=$idgudang;

		$data["dataBarangBelumInsert"]=$this->mdgudang->selectNotInMasterBarang($idgudang);

		$this->breadcrumbs->push("Info Stock","cgudang/infoDgudang");
		$this->breadcrumbs->push("Detail Gudang","cgudang/detailDgudang/$idgudang");

		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("vdetaildgudang",$data);
		$this->load->view("assetsScript");
	}

	public function updateDgudang($idgudang,$idbarang)
	{
		$data["data"]=$this->mdgudang->selectDgudangIdGudangIdBarang($idgudang,$idbarang);
		$data["idgudang"]=$idgudang;
		$data["idbarang"]=$idbarang;
		$data["namaGudang"]=$this->mgudang->selectGudangId($idgudang)->NAMA_GUDANG;
		$data["namaBarang"]=$this->mbarang->selectBarangId($data["data"]->ID_BARANG)->NAMA_BARANG;

		$this->breadcrumbs->push("Info Stock","cgudang/infoDgudang");
		$this->breadcrumbs->push("Detail Gudang","cgudang/detailDgudang/$idgudang");
		$this->breadcrumbs->push("Update Barang Detail Gudang","cgudang/updateDgudang/$idgudang/$idbarang");

		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("vupdatedgudang",$data);
		$this->load->view("assetsScript");
	}

	public function doUpdateDgudang()
	{
		$idgudang=$this->input->post("txtidgudang");
		$idbarang=$this->input->post("txtidbarang");
		$stok=$this->input->post("txtstok");
		$norak=$this->input->post("txtrak");

		

		$this->form_validation->set_rules("txtstok","STOK","integer|greater_than[-1]|less_than[1000]");
		$this->form_validation->set_rules("txtrak","NO. RAK","max_length[3]|integer");

		if($this->form_validation->run())
		{
			$this->mdgudang->updateDgudang($idgudang,$idbarang,$stok,$norak);

			$this->session->set_flashdata("message","Berhasil Update!");
		}
		else
		{
			$this->session->set_flashdata("alert",validation_errors());
		}


		

		redirect("cgudang/detailDgudang/$idgudang");
	}

	public function insertBarang()
	{
		$this->breadcrumbs->push("Insert Barang","cgudang/insertBarang");

		$data["kategori"]=$this->mkategori->selectKategori(0,0);
		$data["brand"]=$this->mbrand->selectBrand(0,0);
		$data["data"]=$this->mbarang->selectBarang(0,0);
		
		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("vbarang",$data);
		$this->load->view("assetsScript");
	}

	public function updateBarang($idbarang)
	{

		$this->breadcrumbs->push("Insert Barang","cgudang/insertBarang");
		$this->breadcrumbs->push("Update Barang","cgudang/updateBarang/$idbarang");



		$data["kategori"]=$this->mkategori->selectKategori(0,0);
		$data["brand"]=$this->mbrand->selectBrand(0,0);


		$data["data"]=$this->mbarang->selectBarangId($idbarang);
		
		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("vdetailbarang",$data);
		$this->load->view("assetsScript");
	}

	public function doInsertBarang()
	{
		$idbarang=$this->input->post("txtidbarang");
		$idkategori=$this->input->post("dropkategori");
		$idbrand=$this->input->post("dropbrand");
		$namabarang=$this->input->post("txtnamabarang");
		$hargajual=$this->input->post("txthargajual");
		$hargabeli=$this->input->post("txthargabeli");
		$size=$this->input->post("txtsize");

		

		$this->form_validation->set_rules("txtidbarang","ID Barang","is_unique[barang.ID_BARANG]");
		$this->form_validation->set_rules("txthargajual","Harga Jual","integer|max_length[9]|greater_than[0]|required");
		$this->form_validation->set_rules("txthargabeli","Harga Beli","integer|max_length[9]|greater_than[0]|required");
		$this->form_validation->set_rules("txtnamabarang","Nama Barang","max_length[25]|required");
		$this->form_validation->set_rules("txtsize","Sizenya","max_length[2]");

		if($this->form_validation->run()==true)
		{
			$this->mbarang->insertBarang($idbarang,$idkategori,$idbrand,$namabarang,$hargajual,$hargabeli,$size);

			$this->session->set_flashdata("message","Berhasil Insert Barang $namabarang");

			redirect("cgudang/insertBarang");
		}
		else
		{
			$this->session->set_flashdata("alert",validation_errors());
			redirect("cgudang/insertBarang");
		}

		

	}

	

	public function doUpdateBarang()
	{
		
			$idbarang=$this->input->post("txtidbarang");
			$idkategori=$this->input->post("dropkategori");
			$idbrand=$this->input->post("dropbrand");
			$namabarang=$this->input->post("txtnamabarang");
			$hargajual=$this->input->post("txthargajual");
			$hargabeli=$this->input->post("txthargabeli");
			$size=$this->input->post("txtsize");
			if($this->input->post("txtstatus"))
			{
				$status="T";
			}
			else
			{
				$status="F";
			}

			//$this->load->library("form_validation");


			$this->form_validation->set_rules("txthargajual","Harga Jual","integer|max_length[9]|greater_than[0]");
			$this->form_validation->set_rules("txthargabeli","Harga Beli","integer|max_length[9]|greater_than[0]");
			$this->form_validation->set_rules("txtnamabarang","Nama Barang","max_length[25]");
			$this->form_validation->set_rules("txtsize","Size","max_length[2]");

			if($this->form_validation->run()==true)
			{
				$this->mbarang->updateBarang($idbarang,$idkategori,$idbrand,$namabarang,$hargajual,$hargabeli,$size,$status);

				$this->session->set_flashdata("message","Berhasil Update Brand $namabarang");
			}
			else
			{
				$this->session->set_flashdata("alert",validation_errors());
				
			}

			

			redirect("cgudang/updateBarang/$idbarang");
		
	}

	public function doDeleteBarang()
	{
		$idbarang=$this->input->post("txtidbarang");
		$namabarang=$this->input->post("txtnamabarang");

		$this->mbarang->deleteBarang($idbarang);

		$this->session->set_flashdata("message","Berhasil Delete $namabarang");

		redirect('cgudang/insertBarang');
	}

	public function insertBrand($start=0)
	{
		$this->load->library('pagination');
			
		$limit=0;

		$data["data"]=$this->mbrand->selectBrand($limit,$start);
				
		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("vbrand",$data);
		$this->load->view("assetsScript");
	}

	public function updateBrand($idbrand)
	{
		$data["data"]=$this->mbrand->selectBrandId($idbrand);
		
		$this->breadcrumbs->push("Insert Brand","cgudang/insertBrand");
		$this->breadcrumbs->push("Update Brand","cgudang/updateBrand/$idbrand");
		
		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("vdetailbrand",$data);
		$this->load->view("assetsScript");
	}

	public function doUpdateBrand()
	{
		
			$idbrand=$this->input->post("txtidbrand");
			$namabrand=$this->input->post("txtnamabrand");

			if($this->input->post("txtstatus"))
			{
				$status="T";
			}
			else
			{
				$status="F";
			}

			$this->form_validation->set_rules("txtnamabrand","Nama Brand","max_length[25]");

			if($this->form_validation->run()==true)
			{
				//$this->mbrand->insertBrand($idbrand,$namabrand);
				$this->mbrand->updateBrand($idbrand,$namabrand,$status);

				$this->session->set_flashdata("message","Berhasil Update Brand $namabrand");
			}
			else
			{

				$this->session->set_flashdata("alert",validation_errors());
			}

			

			

			redirect("cgudang/updateBrand/$idbrand");
		
	}

	public function doDeleteBrand()
	{
		$idbrand=$this->input->post("txtidbrand");
		$namabrand=$this->input->post("txtnamabrand");

		$this->mbrand->deleteBrand($idbrand);

		$this->session->set_flashdata("message","Berhasil Delete $namabrand");

		redirect('cgudang/insertBrand');
	}

	public function doInsertBrand()
	{
		$idbrand=$this->input->post("txtidbrand");
		$namabrand=$this->input->post("txtnamabrand");

		$this->form_validation->set_rules("txtidbrand","ID BRAND","is_unique[brand.ID_BRAND]");
		$this->form_validation->set_rules("txtnamabrand","Nama Brand","max_length[25]|required");

		if($this->form_validation->run()==true)
		{
			$this->mbrand->insertBrand($idbrand,$namabrand);

			$this->session->set_flashdata("message","Berhasi Insert Brand $namabrand");
		}
		else
		{

			$this->session->set_flashdata("alert",validation_errors());
		}
		


		

		redirect("cgudang/insertBrand");
	}

	public function insertKategori($start=0)
	{
		/*$config['base_url'] = site_url("cgudang/insertKategori");
		$config['total_rows'] = $this->mkategori->getCountKategori();
		$config['per_page'] = 5;*/
		
		
		/*$this->pagination->initialize($config);*/
		
		/*$data["links"]= $this->pagination->create_links();*/

		$limit=0;

		$data["data"]=$this->mkategori->selectKategori($limit,$start);
	
		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("vkategori",$data);
		$this->load->view("assetsScript");

	}

	public function updateKategori($idkategori)
	{
		$data["data"]=$this->mkategori->selectKategoriId($idkategori);
			
		$this->breadcrumbs->push("Insert Kategori","cgudang/insertKategori");
		$this->breadcrumbs->push("Update Kategori","cgudang/updateKategori/$idkategori");	

		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("vdetailkategori",$data);
		$this->load->view("assetsScript");

	}

	public function doUpdateKategori()
	{
		
			$idkategori=$this->input->post("txtidkategori");
			$namakategori=$this->input->post("txtnamakategori");
			//$status=$this->input->post("txtstatus");

			if($this->input->post("txtstatus"))
			{
				$status="T";
			}
			else
			{
				$status="F";
			}

			$this->form_validation->set_rules("txtnamakategori","NAMA KATEGORI","max_length[25]");

			if($this->form_validation->run()==true)
			{
					$this->mkategori->updateKategori($idkategori,$namakategori,$status);

					$this->session->set_flashdata("message","Berhasil Update $namakategori");
			}
			else
			{
					$this->session->set_flashdata("alert",validation_errors());
			}

		

			redirect("cgudang/updateKategori/$idkategori");
		
		
	}

	public function doInsertKategori()
	{
		$idkategori=$this->input->post("txtidkategori");
		$namakategori=$this->input->post("txtnamakategori");

		$this->form_validation->set_rules("txtidkategori","ID KATEGORI","is_unique[kategori.ID_KATEGORI]");
		$this->form_validation->set_rules("txtnamakategori","NAMA KATEGORI","max_length[25]|required");

		if($this->form_validation->run()==true)
		{
			$this->mkategori->insertKategori($idkategori,$namakategori);

			$this->session->set_flashdata("message","Berhasil Menambahkan $namakategori");

		
		}
		else
		{	
			$this->session->set_flashdata("alert",validation_errors());
		}

		redirect("cgudang/insertKategori");
	}

	public function doDeleteKategori()
	{
		$idkategori=$this->input->post("txtidkategori");
		$namakategori=$this->input->post("txtnamakategori");

		$this->mkategori->deleteKategori($idkategori);

		$this->session->set_flashdata("message","Berhasil Delete $namakategori");

		redirect('cgudang/insertKategori');
	}



	public function insertGudang($start=0)
	{
		$limit=0;
		
		$data["data"]=$this->mgudang->selectGudang($limit,0);
				
		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("vgudang",$data);
		$this->load->view("assetsScript");
	}

	public function updateGudang($idgudang)
	{
		$data["data"]=$this->mgudang->selectGudangId($idgudang);
		
		$this->breadcrumbs->push("Insert Gudang","cgudang/insertGudang");
		$this->breadcrumbs->push("Update Gudang","cgudang/updateGudang/$idgudang");

		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("vdetailgudang",$data);
		$this->load->view("assetsScript");
	}

	public function doInsertGudang()
	{	
		$idgudang=$this->input->post("txtidgudang");
		$namagudang=$this->input->post("txtnamagudang");
		$alamatgudang=$this->input->post("txtalamatgudang");
		$telpgudang=$this->input->post("txttelpgudang");
		$namacpgudang=$this->input->post("txtnamacpgudang");
		$telpcpgudang=$this->input->post("txttelpcpgudang");

		$this->form_validation->set_rules("txtidgudang","ID GUDANG","is_unique[gudang.ID_GUDANG]");
		$this->form_validation->set_rules("txtnamagudang","NAMA GUDANG","max_length[25]|required");
		$this->form_validation->set_rules("txtalamatgudang","ALAMAT GUDANG","max_length[50]|required");
		$this->form_validation->set_rules("txttelpgudang","TELP GUDANG","max_length[12]|integer|required");
		$this->form_validation->set_rules("txtnamacpgudang","NAMACP GUDANG","max_length[25]|required");
		$this->form_validation->set_rules("txttelpcpgudang","TELP CP GUDANG","max_length[12]|integer|required");

		if($this->form_validation->run())
		{

			$this->mgudang->insertGudang($idgudang,$namagudang,$alamatgudang,$telpgudang,$namacpgudang,$telpcpgudang);

			$this->session->set_flashdata("message","Berhasil Insert Gudang $namagudang");
		}
		else
		{
			$this->session->set_flashdata("alert",validation_errors());
		}

		

		redirect("cgudang/insertGudang");

	}

	public function doUpdateGudang()
	{
		
			$idgudang=$this->input->post("txtidgudang");
			$namagudang=$this->input->post("txtnamagudang");
			$alamatgudang=$this->input->post("txtalamatgudang");
			$telpgudang=$this->input->post("txttelpgudang");
			$namacpgudang=$this->input->post("txtnamacpgudang");
			$telpcpgudang=$this->input->post("txttelpcpgudang");

			if($this->input->post("txtstatus"))
				$status="T";
			else
				$status="F";

			$this->form_validation->set_rules("txtnamagudang","NAMA GUDANG","max_length[25]");
			$this->form_validation->set_rules("txtalamatgudang","ALAMAT GUDANG","max_length[50]");
			$this->form_validation->set_rules("txttelpgudang","TELP GUDANG","max_length[12]|integer");
			$this->form_validation->set_rules("txtnamacpgudang","NAMACP GUDANG","max_length[25]");
			$this->form_validation->set_rules("txttelpcpgudang","TELP CP GUDANG","max_length[12]|integer");

			if($this->form_validation->run())
			{	
				$this->mgudang->updateGudang($idgudang,$namagudang,$alamatgudang,$telpgudang,$namacpgudang,$telpcpgudang,$status);
				$this->session->set_flashdata("message","berhasil update gudang $idgudang");
			}
			else
			{
				$this->session->set_flashdata("alert",validation_errors());
			}

			
			redirect("cgudang/updateGudang/$idgudang");
		
	}

	public function doDeleteGudang()
	{
		$idgudang=$this->input->post("txtidgudang");
		$namagudang=$this->input->post("txtnamagudang");
		$this->mgudang->deleteGudang($idgudang);

		$this->session->set_flashdata("message","Berhasi Delete Gudang $namagudang");

		redirect("cgudang/insertGudang");
	}


	public function doUpdateDetailTransferGudang()
	{
		$this->form_validation->set_rules('txtqty', 'QTY', 'required|greater_than[-1]');

		if($this->form_validation->run())
		{
			$rowid=$this->input->post("txtrowid");
			$qty=$this->input->post("txtqty");
			

			$data = array(
				'rowid'      => $rowid,
				'qty'     => $qty
			);

			
			
			$this->cart->update($data);
			
			//$this->cart->insert($data);

			redirect("Cgudang/transferGudang");
		}
		else
		{
			$this->session->set_flashdata("alert",validation_errors());
			redirect("Cgudang/transferGudang");
		}
	}


}


/* Location: ./application/controllers/cgudang.php */

?>

