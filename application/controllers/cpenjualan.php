<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

 class Cpenjualan extends CI_Controller {

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
		$this->load->model("mmember");
		$this->load->model("mpromo");
		$this->load->model("mdpenjualan");
		$this->load->library("breadcrumbs");
		$this->load->library("form_validation");
		$this->load->library("cart");
		$this->load->library("session");
	}

	public function index()
	{
		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("assetsScript");
		$this->session->set_userdata("idmember","");	
		$this->session->set_userdata("idpromo","");		
	}
	// -- MEMBER --
	public function insertMember()
	{//tampilan view member
		$this->breadcrumbs->push("Insert Member","cpenjualan/insertMember");

		//$data["kategori"]=$this->mkategori->selectKategori(0,0);
		//$data["brand"]=$this->mbrand->selectBrand(0,0);
		$data["data"]=$this->mmember->selectMember(0,0);
		$idmember  = $this->mmember->autogenidmember();
		$this->session->set_userdata("idmember",$idmember);
		
		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("vmember",$data);
		$this->load->view("assetsScript");
	}
	public function doInsertMember()
	{//penanganan button insert di view member
		//$idmember=$this->input->post("txtidmember");
		$idmember  = $this->mmember->autogenidmember();
		$this->session->set_userdata("idmember",$idmember);		
		
		$namamember = $this->input->post("txtnamamember");
		$alamat = $this->input->post("txtalamat");
		$telp = $this->input->post("txttelp");
		$poin = $this->input->post("txtpoin");		

		//$this->form_validation->set_rules("txtidmember","ID Member","is_unique[member.ID_MEMBER]");
		$this->form_validation->set_rules("txtalamat","Alamat Member","max_length[50]|required");
		$this->form_validation->set_rules("txttelp","Telpon Member","integer|max_length[12]|required");
		$this->form_validation->set_rules("txtpoin","Poin Member","integer|max_length[7]|required");
		$this->form_validation->set_rules("txtnamamember","Nama Member","max_length[25]|required");

		if($this->form_validation->run()==true)
		{
			$this->mmember->insertMember($idmember,$namamember,$alamat,$telp,$poin);
			
			$this->session->set_flashdata("message","Berhasil Insert Member $namamember");

			redirect("cpenjualan/insertMember");
		}
		else
		{
			$this->session->set_flashdata("alert",validation_errors());
			redirect("cpenjualan/insertMember");
		}
	}
	public function updateMember($idmember)
	{
		//tampilan view detailmember
		$this->breadcrumbs->push("Insert Member","cpenjualan/insertMember");
		$this->breadcrumbs->push("Update Member","cpenjualan/updateMember/$idmember");

		$data["data"]=$this->mmember->selectMemberId($idmember);
		
		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("vdetailmember",$data);
		$this->load->view("assetsScript");
	}
	public function doUpdateMember()
	{
		//penanganan button update di view detailmember
		$idmember=$this->input->post("txtidmember");
		$namamember = $this->input->post("txtnamamember");
		$alamat = $this->input->post("txtalamat");
		$telp = $this->input->post("txttelp");
		$poin = $this->input->post("txtpoin");
		if($this->input->post("txtstatus"))
		{
			$status="0";
		}
		else
		{
			$status="1";
		}
		$this->form_validation->set_rules("txtalamat","Alamat Member","max_length[50]|required");
		$this->form_validation->set_rules("txttelp","Telpon Member","integer|max_length[12]|required");
		$this->form_validation->set_rules("txtpoin","Poin Member","integer|max_length[7]|required");
		$this->form_validation->set_rules("txtnamamember","Nama Member","max_length[25]|required");

		if($this->form_validation->run()==true)
		{
			$this->mmember->updateMember($idmember,$namamember,$alamat,$telp,$poin,$status);

			$this->session->set_flashdata("message","Berhasil Update member $namamember");
		}
		else
		{
			$this->session->set_flashdata("alert",validation_errors());
			
		}
		redirect("cpenjualan/updateMember/$idmember");		
	}
	public function doDeleteMember()
	{
		$idmember=$this->input->post("txtidmember");
		$namamember = $this->input->post("txtnamamember");

		$this->mmember->deleteMember($idmember);

		$this->session->set_flashdata("message","Berhasil Delete $namamember");

		redirect('cpenjualan/insertMember');
	}
	
	// -- PROMO --
	public function insertPromo()
	{//tampilan view promo
		$this->breadcrumbs->push("Insert Promo","cpenjualan/insertPromo");
		$data["data"]=$this->mpromo->selectPromo(0,0);
		
		$idpromo  = $this->mpromo->autogenidpromo();
		$this->session->set_userdata("idpromo",$idpromo);

		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("vpromo",$data);
		$this->load->view("assetsScript");
	}
	public function doInsertPromo()
	{//penanganan button insert di view promo
		//$idpromo=$this->input->post("txtidpromo");
		$idpromo  = $this->mpromo->autogenidpromo();
		$this->session->set_userdata("idpromo",$idpromo);
		
		$namapromo = $this->input->post("txtnamapromo");
		$diskon = $this->input->post("txtdiskon");
		$tglmulai = $this->input->post("txttglmulai");
		$tglakhir = $this->input->post("txttglakhir");
		$keterangan = $this->input->post("txtketerangan");
		

		//$this->form_validation->set_rules("txtidpromo","ID Promo","is_unique[promo.ID_PROMO]");
		$this->form_validation->set_rules("txtdiskon","Diskon","integer|required|max_length[3]");
		$this->form_validation->set_rules("txtnamapromo","Nama Promo","max_length[25]|required");
		$this->form_validation->set_rules("txtketerangan","Keterangan Promo","max_length[50]|required");
		$this->form_validation->set_rules("txttglmulai","Tanggal Awal ","required");
		$this->form_validation->set_rules("txttglakhir","Tanggal Akhir ","callback_cektgl|required");

		if($this->form_validation->run()==true)
		{
			$this->mpromo->insertPromo($idpromo,$namapromo,$diskon,$tglmulai,$tglakhir,$keterangan);

			$this->session->set_flashdata("message","Berhasil Insert Member $namapromo");

			redirect("cpenjualan/insertPromo");
		}
		else
		{
			$this->session->set_flashdata("alert",validation_errors());
			redirect("cpenjualan/insertPromo");
		}
	}
	public function cektgl($tglakhir)
	{//callback tanggal akhir tidak boleh lebih kecil dari tanggal awal
		if($this->input->post("txttglakhir") <= $this->input->post("txttglmulai"))
		{
			$this->form_validation->set_message("cektgl","tanggal akhir harus > tanggal mulai");
		}
		else {
			return true;
		}
	}
	public function updatePromo($idpromo)
	{
		//tampilan view detail promo
		$this->breadcrumbs->push("Insert Promo","cpenjualan/insertPromo");
		$this->breadcrumbs->push("Update Promo","cpenjualan/updatePromo/$idpromo");

		$data["data"]=$this->mpromo->selectPromoId($idpromo);
		
		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("vdetailpromo",$data);
		$this->load->view("assetsScript");
	}
	public function doUpdatePromo()
	{
		//penanganan button update pada view detail promo
		$idpromo=$this->input->post("txtidpromo");
		$namapromo = $this->input->post("txtnamapromo");
		$diskon = $this->input->post("txtdiskon");
		$tglmulai = $this->input->post("txttglmulai");
		$tglakhir = $this->input->post("txttglakhir");
		$keterangan = $this->input->post("txtketerangan");
		if($this->input->post("txtstatus"))
		{
			$status="0";
		}
		else
		{
			$status="1";
		}
		$this->form_validation->set_rules("txtdiskon","Diskon","integer|required|max_length[3]");
		$this->form_validation->set_rules("txtnamapromo","Nama Promo","max_length[25]|required");
		$this->form_validation->set_rules("txtketerangan","Keterangan Promo","max_length[50]|required");
		$this->form_validation->set_rules("txttglmulai","Tanggal Awal ","required");
		$this->form_validation->set_rules("txttglakhir","Tanggal Akhir ","callback_cektgl|required");

		if($this->form_validation->run()==true)
		{
			$this->mpromo->updatePromo($idpromo,$namapromo,$diskon,$tglmulai,$tglakhir,$keterangan,$status);

			$this->session->set_flashdata("message","Berhasil Update Promo $namapromo");
		}
		else
		{
			$this->session->set_flashdata("alert",validation_errors());			
		}
		redirect("cpenjualan/updatePromo/$idpromo");		
	}
	public function doDeletePromo()
	{
		$idpromo=$this->input->post("txtidpromo");
		$namapromo = $this->input->post("txtnamapromo");

		$this->mpromo->deletePromo($idpromo);

		$this->session->set_flashdata("message","Berhasil Delete $namapromo");

		redirect('cpenjualan/insertPromo');
	}	
	// TRANSAKSI PENJUALAN	
	public function infoDpenjualan()
	{//tampilan view penjualan
		//$idgudang = "";
		if($this->input->post("cmbgudang") == "")
		{
			$idgudang = $this->session->userdata("idgudang");
		}
		else
		{
			$idgudang = $this->input->post("cmbgudang");
		}
		
		$this->session->set_userdata("idgudang",$idgudang);
		
		/*
		$namagudang = $this->mdpenjualan->ambilnamagudang($idgudang);
		$tempnamagudang = "";
		foreach($namagudang->result() as $row)
		{
			$tempnamagudang = $row->NAMA_GUDANG;
		}
		$this->session->set_userdata("namagudang",$tempnamagudang);
		*/
		
		$data["semuabarang"] = $this->mdpenjualan->lihatbarang($idgudang);
		$data["promo"] = $this->mdpenjualan->cekpromo();
		//$data["dataNoRak"]=$this->mdpenjualan->selectDgudangbyGudang();
		//$data["dataAll"]=$this->mdgudang->selectDgudang();
		$data["isigudang"] = $this->mdpenjualan->ambilgudang();
		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("viewpenjualan",$data);
		$this->load->view("assetsScript");
	}
	public function buy()
	{//penangan button buy pada view penjualan
		//ketika button buy ditekan
		$kodebarang = $this->input->post("txtkode");
		$detail = $this->mdpenjualan->getdetailbarang($kodebarang);
		foreach($detail->result() as $databarang) { }
		
		$detaildgudang = $this->mdpenjualan->getdetaildgudang($this->session->userdata("idgudang"),$kodebarang);
	
		foreach($detaildgudang->result() as $databarangdgudang) { }
		
		$flag = 0; 
		foreach ($this->cart->contents() as $i)
		{
			//echo "tester";
			if($i['id'] == $kodebarang) {	// jika id cart sama dengan txtkode yang diklik
				$rowid = $i['rowid']; 
				$qty   = $i['qty']; 
				$flag = 1; 
			}
			//pengecekan barang harus dari gudang yang sama
			if($i['gudangasal'] != $this->session->userdata("idgudang"))
			{
				$flag = 2;
			}
		}
		if($flag == 0) {
			// isi data cart baru 
			$datacart = array(
				'id'	=>	$kodebarang,
				'qty'	=>	$this->input->post("txtqty"),
				'price'	=>	$databarang->HARGA_JUAL,
				'name'	=>	$databarang->NAMA_BARANG,
				'stock' => $databarangdgudang->STOK,
				'size' => $databarang->SIZE,
				'gudangasal' =>$databarangdgudang->ID_GUDANG
				//'options' => array('stok' => $databarangdgudang->STOK)
			);
			$this->cart->insert($datacart);
			//echo "cart berhasil masuk"; 				
		}
		else if($flag == 1){
			// update cart lama, tambahkan qty dengan angka 1
			$datacart = array(
				'rowid'	=>	$rowid,
				'qty'	=>	$this->input->post("txtqty")
			);
			$this->cart->update($datacart);
			//echo "cart berhasil update";  								
		}
		else
		{
			$this->session->set_flashdata("alert","Pastikan Barang Dari Gudang yang Sama");
		}
		redirect("cpenjualan/infoDpenjualan");
	}
	public function checkout()
	{
		//penanganan button save to database,batal beli, back to penjualan pada view checkout
		if($this->input->post("btnbacktopenjualan"))
		{//ketika button back to penjualan di tekan
			//$idgudang = $this->input->post("cmbgudang");
			//mengambil data dgudang sesuai id gudang
			$namagudang = $this->mdpenjualan->ambilnamagudang($this->session->userdata("idgudang"));
			$tempnamagudang = "";
			foreach($namagudang->result() as $row)
			{
				$tempnamagudang = $row->NAMA_GUDANG;
			}
			$this->session->set_userdata("namagudang",$tempnamagudang);
			$data["semuabarang"] = $this->mdpenjualan->lihatbarang($this->session->userdata("idgudang"));
			$data["promo"] = $this->mdpenjualan->cekpromo();
			$data["isigudang"] = $this->mdpenjualan->ambilgudang();
			$this->load->view("assetsCSS");
			$this->load->view("vmenu");
			$this->load->view("viewpenjualan",$data);
			$this->load->view("assetsScript");
		}
		else if($this->input->post("btnsavetodbase"))
		{
			//ketika di tekan button save to database
			$kodejual = $this->mdpenjualan->autogen();//autogenerate kodejual
			if($this->input->post("rdpromo") != "")
			{
				$ambilpromo = $this->mdpenjualan->cekpromobyid($this->input->post("rdpromo")); //cek promo hari ini
				foreach($ambilpromo as $row)
				{}
				$idpromo = $row->ID_PROMO;//dpt id promo
				$diskon = $row->DISKON;
			}
			else
			{
				$idpromo = null;//dpt id promo
				$diskon = "0";
			}			
			$jenispembayaran = $this->input->post("rd");//ambil isi radiobutton cash/credit
			if($jenispembayaran == "")
			{
				$jenispembayaran = "CASH";
			}
			$data["jenispembayaran"]=$jenispembayaran;
			$data["diskon"] = $diskon;
			$this->load->view("printpenjualan",$data);//tampilkan view print penjualan
			$adamember = $this->input->post("cmbmember");//ambil data combo box member
			
			
			//insert h_jual
			if($jenispembayaran == "CASH")
			{//insert h_jual jenispembayaran cash tidak dpt diskon
				$nomernota = $this->mdpenjualan->inserthjual($kodejual,$adamember,$this->session->userdata("idgudang"),date('Y-m-d H:i:s'),$this->cart->total(),$jenispembayaran,null);
			}
			else
			{//insert h_jual jenispembayaran credit dapat diskon
				$nomernota = $this->mdpenjualan->inserthjual($kodejual,$adamember,$this->session->userdata("idgudang"),date('Y-m-d H:i:s'),intval($this->cart->total())-((intval($this->cart->total())*intval($diskon))/intval(100)),$jenispembayaran,$idpromo);
			}			
			foreach ($this->cart->contents() as $i)
			{
				
				//insert djual
				if($jenispembayaran == "CASH")
				{//insert djual jenispembayaran cash tidak dpt diskon
					$this->mdpenjualan->insertdjual($i['id'],$kodejual,$i['price'],$i['qty'],0,$i['subtotal'],$i['subtotal']); 
				}
				else
				{//insert djual jenispembayaran credit dapat diskon
					$this->mdpenjualan->insertdjual($i['id'],$kodejual,$i['price'],$i['qty'],$diskon,$i['subtotal'],$i['subtotal']-((intval($diskon)*intval($i['subtotal']))/intval(100))); 
				}				
				//update stok barang di DGUDANG
				$this->mdpenjualan->updatestok($i['id'],$i['qty'],$this->session->userdata("idgudang"));
			}	
			$this->session->set_flashdata("message","Berhasil Save");
			$this->cart->destroy(); 
			/*
			$data["pesan"] = "cart tersimpan pada database"; 			
			$data["semuabarang"] = $this->mdpenjualan->lihatbarang($this->session->userdata("idgudang"));
			$data["promo"] = $this->mdpenjualan->cekpromo();
			$data["isigudang"] = $this->mdpenjualan->ambilgudang();
			*/
		}
		else if($this->input->post('btnhapus')) {//ketika button batal beli ditekan
			$datacart = array(
				'rowid'	=>	$this->input->post("txtrowid"),
				'qty'	=>	0
			);//ubah qty jadi 0 untuk menghapus data pada cart
			$data["promo"] = $this->mdpenjualan->cekpromo();
			$this->cart->update($datacart);
			$this->load->view("assetsCSS");
			$this->load->view("vmenu");
			$this->load->view("checkout",$data);
			$this->load->view("assetsScript");			
		}
		else
		{
			$data["promo"] = $this->mdpenjualan->cekpromo();
			$this->load->view("assetsCSS");
			$this->load->view("vmenu");
			$this->load->view("checkout",$data);
			$this->load->view("assetsScript"); 
		}
		//$this->load->view("checkout");		
	}	
	//HISTORY PENJUALAN
	public function historypenjualan()
	{		
		$data["data"]=$this->mdpenjualan->selectall(0,0);		
		$this->load->view("assetsCSS");
		$this->load->view("vmenu");
		$this->load->view("vhistorypenjualan",$data);
		$this->load->view("assetsScript");
	}
	
	public function dodeletehjual($idtrans)
	{
		$this->mdpenjualan->dodeletedjual($idtrans);
		$this->mdpenjualan->dodeleteh_jual($idtrans);
		redirect('cpenjualan/historypenjualan');
	}
	
	//REPORT PENJUALAN
	public function reportpenjualan()
	{	
		if($this->input->post('btnfind'))
		{
			if($this->input->post("tglawal") > $this->input->post("tglakhir"))
			{
				$this->session->set_flashdata("alert","from date harus lebih kecil dari to date");
				$data["data"]=$this->mdpenjualan->selectall(0,0);
				$data["tglawal"] = $this->input->post("tglawal");
				$data["tglakhir"] = $this->input->post("tglakhir");	
				$this->load->view("assetsCSS");
				$this->load->view("vmenu");
				$this->load->view("vreportpenjualan",$data);
				$this->load->view("assetsScript");
			}
			else
			{
				$data["data"]=$this->mdpenjualan->selectbydate($this->input->post("tglawal"),$this->input->post("tglakhir"),0,0);
				$data["tglawal"]=date_create(date("Y-m-d"));
				date_sub($data["tglawal"],date_interval_create_from_date_string("7 days"));
				$data["tglawal"]=date_format($data["tglawal"],"Y-m-d");
				$data["tglakhir"]=date("Y-m-d");
				$this->load->view("assetsCSS");
				$this->load->view("vmenu");
				$this->load->view("vreportpenjualan",$data);
				$this->load->view("assetsScript");
			}			
		}
		else
		{
			$data["data"]=$this->mdpenjualan->selectall(0,0);
			$data["tglawal"]=date_create(date("Y-m-d"));
			date_sub($data["tglawal"],date_interval_create_from_date_string("7 days"));
			$data["tglawal"]=date_format($data["tglawal"],"Y-m-d");
			$data["tglakhir"]=date("Y-m-d");			
			$this->load->view("assetsCSS");
			$this->load->view("vmenu");
			$this->load->view("vreportpenjualan",$data);
			$this->load->view("assetsScript");
		}
	}
 }
?>