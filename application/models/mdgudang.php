<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdgudang extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insertDgudang($ID_GUDANG,$ID_BARANG,$STOK,$NO_RAK)
	{
		$data=array(
			"ID_GUDANG"=>$ID_GUDANG,
			"ID_BARANG"=>$ID_BARANG,
			"STOK"=>$STOK,
			"NO_RAK"=>$NO_RAK
			);
		$this->db->insert("dgudang",$data);

	}

	public function updateDgudang($ID_GUDANG,$ID_BARANG,$STOK,$NO_RAK)
	{
		$data=array(
			"STOK"=>$STOK,
			"NO_RAK"=>$NO_RAK
			);
		$this->db->where("ID_GUDANG",$ID_GUDANG);
		$this->db->where("ID_BARANG",$ID_BARANG);
		$this->db->update("dgudang",$data);
	}

	public function selectDgudang()
	{
		$this->db->select("g.NAMA_GUDANG as NAMA_GUDANG,b.NAMA_BARANG as NAMA_BARANG,d.STOK as STOK");
		$this->db->from("dgudang d");
		$this->db->join("gudang g","g.ID_GUDANG=d.ID_GUDANG");
		$this->db->join("barang b","b.ID_BARANG=d.ID_BARANG");
		//$this->db->where("b.STATUS",'T');
		//$this->db->where("g.STATUS","T");
		//$this->db->order_by("b.NAMA_BARANG");
		$query=$this->db->get();
		return $query->result();
	}

	public function selectDgudangIdGudang($idgudang)
	{
		$this->db->where("ID_GUDANG",$idgudang);
		$this->db->join("barang","barang.ID_BARANG=dgudang.ID_BARANG");
		//$this->db->where("barang.STATUS","T");
		$query=$this->db->get("dgudang");
		return $query->result();
	}


	public function selectDgudangIdGudangIdBarang($idgudang,$idbarang)
	{
		$this->db->where("ID_GUDANG",$idgudang);
		$this->db->where("ID_BARANG",$idbarang);

		$query=$this->db->get("dgudang");
		return $query->row();
	}


	public function selectDgudangbyGudang()
	{
		$query=$this->db->query("select g.ID_GUDANG as ID_GUDANG,g.NAMA_GUDANG as NAMA_GUDANG,COUNT(d.ID_BARANG) as JUMLAH from dgudang d,gudang g where g.STATUS='T' and d.ID_GUDANG=g.ID_GUDANG GROUP BY g.NAMA_GUDANG");
		return $query->result();
	}

	public function deleteDgudang($ID_GUDANG,$ID_BARANG)
	{
		$this->db->where("ID_GUDANG",$ID_GUDANG);
		$this->db->where("ID_BARANG",$ID_BARANG);
	}

	public function selectBarangByGudang($idgudang)
	{
		$this->db->select("b.NAMA_BARANG as NAMA_BARANG,d.STOK as STOK,d.ID_BARANG as ID_BARANG");
		$this->db->from("dgudang d");
		$this->db->join("barang b","b.ID_BARANG=d.ID_BARANG");
		$this->db->where("d.ID_GUDANG",$idgudang);
		return $this->db->get()->result();
	}

	public function checkStock($idgudang,$idbarang)
	{
		$this->db->where("ID_GUDANG",$idgudang);
		$this->db->where("ID_BARANG",$idbarang);

		return $this->db->get("dgudang")->row();
	}

	public function substractStokDgudang($idgudang,$idbarang,$qty)
	{

		$this->db->where("ID_GUDANG",$idgudang);
		$this->db->where("ID_BARANG",$idbarang);

		$stokNow=$this->db->get("dgudang")->row()->STOK;


		$this->db->where("ID_GUDANG",$idgudang);
		$this->db->where("ID_BARANG",$idbarang);

		$stokNow=$stokNow-$qty;

		$data=array(
			"STOK"=>$stokNow
			);

		$this->db->update("dgudang",$data);
	}

	public function addStokDgudang($idgudang,$idbarang,$qty)
	{

		$this->db->where("ID_GUDANG",$idgudang);
		$this->db->where("ID_BARANG",$idbarang);

		$stokNow=$this->db->get("dgudang")->row()->STOK;


		$this->db->where("ID_GUDANG",$idgudang);
		$this->db->where("ID_BARANG",$idbarang);

		$stokNow=$stokNow+$qty;

		$data=array(
			"STOK"=>$stokNow
			);

		$this->db->update("dgudang",$data);
	}

	public function selectNotInMasterBarang($idgudang)
	{
		$query=$this->db->query("select b.ID_BARANG as ID_BARANG,b.NAMA_BARANG as NAMA_BARANG from barang b where b.ID_BARANG not in (select d.ID_BARANG from dgudang d where d.ID_GUDANG='$idgudang')");

		return $query->result();
	}

	public function selectCount($ID_GUDANG)
	{

		$this->db->where("ID_GUDANG",$ID_GUDANG);
		return $this->db->get("dgudang")->result();
	}
}

/* End of file mdgudang.php */
/* Location: ./application/models/mdgudang.php */