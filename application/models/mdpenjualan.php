<?php
	class Mdpenjualan extends CI_model
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->database();
		}
		public function lihatbarang($idgudang)
		{
			$this->db->select('*');
			$this->db->from("barang");
			$this->db->join("dgudang","barang.ID_BARANG = dgudang.ID_BARANG");
			$this->db->where("dgudang.STOK >",0);
			$this->db->where("dgudang.ID_GUDANG",$idgudang);
			$this->db->where("barang.STATUS","T");
			return $this->db->get()->result();
		}
		public function getdetailbarang($kodebarang)
		{
			$this->db->where("ID_BARANG",$kodebarang);
			return $this->db->get("barang");
		}
		public function getdetaildgudang($idgudang,$kodebarang)
		{
			$this->db->where("ID_GUDANG",$idgudang);
			$this->db->where("ID_BARANG",$kodebarang);
			return $this->db->get("dgudang");
		}
		public function autogen()
		{
			$yyyy = date("Y");
			$mm = date("m");
			$dd = date("d");
			$maxctr = "";
			$String = "select max(KD_TRANSAKSI_HJUAL) bantuanmax from h_jual";
			$hasil = $this->db->query($String);
			foreach($hasil->result() as $baris)
			{
				$maxctr = $baris->bantuanmax; 
			}
			$angkamax = substr($maxctr,10); 
			$angkamax = (int)$angkamax;
			$angkamax = $angkamax + 1;
			$angkamaxend = 0;
			if($angkamax < 10)
			{
				$angkamaxend = '000'.$angkamax;
			}
			else if($angkamax < 100)
			{
				$angkamaxend = '00'.$angkamax;
			}
			else if($angkamax < 1000)
			{
				$angkamaxend = '0'.$angkamax;
			}
			else
			{
				$angkamaxend = ''.$angkamax;
			}
			$hasilakhir = "TR".$mm.$dd.$yyyy.$angkamaxend;
			return $hasilakhir;
		}
		public function inserthjual($kodejual,$idmember,$idgudang,$tgl,$total,$jenisbayar,$idpromo)
		{
			$data = array(
				"KD_TRANSAKSI_HJUAL" => $kodejual,
				"ID_MEMBER" => $idmember,
				"ID_GUDANG" => $idgudang,
				"TGL_TRANS" => $tgl,
				"TOTAL_HARGA" => $total,
				"JENIS_PEMBAYARAN" => $jenisbayar,
				"ID_PROMO" => $idpromo
			);
			$this->db->insert("h_jual",$data);
		}
		public function insertdjual($idbarang,$kodejual,$harga,$qty,$diskon,$subtotal,$subtotalnetto)
		{
			$data = array(
				"ID_BARANG" => $idbarang,
				"KD_TRANSAKSI_HJUAL" => $kodejual,
				"HARGA" => $harga,
				"QTY" => $qty,
				"DISKON" => $diskon,
				"SUBTOTAL" => $subtotal,
				"SUBTOTAL_NETTO" => $subtotalnetto
			);
			$this->db->insert("djual",$data);
		}
		
		public function cekpromo()
		{
			$this->db->where("TGL_MULAI <=","CURDATE()",false);
			$this->db->where("TGL_AKHIR >=","CURDATE()",false);
			$this->db->where("STATUS",0);
			return $this->db->get("promo")->result();
		}
		public function cekpromobyid($id)
		{
			$this->db->where("ID_PROMO",$id);
			return $this->db->get("promo")->result();
		}
		public function updatestok($idbarang,$jumbeli,$idgudang)
		{
			$this->db->where("ID_BARANG",$idbarang);
			$this->db->where("ID_GUDANG",$idgudang);
			$query = $this->db->get("dgudang");
			foreach($query->result() as $i)
			{
				$stok = $i->STOK;
			}
			$stok = $stok-$jumbeli;
			$data = array(
				"stok" => $stok
			);
			$this->db->where("ID_BARANG",$idbarang);
			$this->db->where("ID_GUDANG",$idgudang);
			$this->db->update("dgudang",$data);
		}
		public function ambilgudang()
		{
			$this->db->order_by("NAMA_GUDANG");
			$this->db->not_like("NAMA_GUDANG","NON");
			$this->db->where("STATUS","T");
			$query = $this->db->get("gudang")->result_array();
			$hasil = array();
			for($i = 0; $i<count($query); $i+=1)
			{
				$hasil[$query[$i]["ID_GUDANG"]] = $query[$i]["NAMA_GUDANG"];
			}
			return $hasil;
		}
		public function ambilnamagudang($idgudang)
		{
			$this->db->where("ID_GUDANG",$idgudang);
			return $this->db->get("gudang");
		}
		public function getDataMember()
		{
			$query = $this->db->get("member")->result_array();
			$hasil = array();
			for($i = 0; $i<count($query); $i+=1)
			{
				$hasil[$query[$i]["ID_MEMBER"]] = $query[$i]["ID_MEMBER"];
			}
			return $hasil;
		}
		//HISTORY PENJUALAN
		public function selectall($limit,$start)
		{
			//mengambil seluruh data pada h_jual
			$query = $this->db->order_by("KD_TRANSAKSI_HJUAL","DESC");
			$query = $this->db->get("h_jual",$limit,$start);
			
			return $query->result();
		}
		public function selecth_jualbyid($idtrans)
		{
			$query = $this->db->where("KD_TRANSAKSI_HJUAL",$idtrans);
			$query = $this->db->get("h_jual");
			return $query->result();
		}
		public function selectdjualbyid($idtrans)
		{
			$query = $this->db->where("KD_TRANSAKSI_HJUAL",$idtrans);
			$query = $this->db->get("djual");
			return $query->result();
		}
		public function selectdgudangbyid($idgudang,$idbarang)
		{
			$query = $this->db->where(array(
				"ID_GUDANG" => $idgudang,
				"ID_BARANG" => $idbarang
			));
			$query = $this->db->get("dgudang");
			return $query->result();
		}
		public function dodeletedjual($idtrans)
		{//delete djual menurut KD_TRANSAKSI_HJUAL
			//update dulu stok ke semula
			//mengambil data2 h_jual
			$dptidgudang = $this->mdpenjualan->selecth_jualbyid($idtrans);
			foreach($dptidgudang as $row1)
			{}
			//mengambil data2 djual
			$targetdelete = $this->mdpenjualan->selectdjualbyid($idtrans);
			foreach($targetdelete as $row)
			{
				//mengambil data2 dgudang
				$dptposisi = $this->mdpenjualan->selectdgudangbyid($row1->ID_GUDANG,$row->ID_BARANG);
				foreach($dptposisi as $row2)
				{}
				$this->db->where(array(
					"ID_GUDANG" => $row1->ID_GUDANG,
					"ID_BARANG" => $row->ID_BARANG
				));
				//perhitungan stok
				$perhitunganstok = intval($row2->STOK)+intval($row->QTY);
				$data = array(
					"STOK" => $perhitunganstok
				);
				//update stok dgudang
				$this->db->update("dgudang",$data);
			}
			//delete djual
			$this->db->where('KD_TRANSAKSI_HJUAL',$idtrans);
			$this->db->delete('djual');
		}
		public function dodeleteh_jual($idtrans)
		{//delete h_jual menurut KD_TRANSAKSI_HJUAL
			$this->db->where('KD_TRANSAKSI_HJUAL',$idtrans);
			$this->db->delete('h_jual');
		}
		
		//REPORT PENJUALAN
		public function selectbydate($tglawal,$tglakhir,$limit,$start)
		{
			$query = $this->db->where("TGL_TRANS <=",$tglakhir);
			$query = $this->db->where("TGL_TRANS >=",$tglawal);
			$query = $this->db->order_by("KD_TRANSAKSI_HJUAL","desc");
			$query = $this->db->get("h_jual",$limit,$start);
			
			return $query->result();
		}
	}
?>