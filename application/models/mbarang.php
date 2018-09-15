<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mbarang extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function insertBarang($ID_BARANG,$ID_KATEGORI,$ID_BRAND,$NAMA_BARANG,$HARGA_JUAL,$HARGA_BELI,$SIZE)
	{
		$data=array(
			"ID_BARANG"=>$ID_BARANG,
			"ID_KATEGORI"=>$ID_KATEGORI,
			"ID_BRAND"=>$ID_BRAND,
			"NAMA_BARANG"=>$NAMA_BARANG,
			"HARGA_JUAL"=>$HARGA_JUAL,
			"HARGA_BELI"=>$HARGA_BELI,
			"SIZE"=>$SIZE,
			"STATUS"=>"T"
			);

		$this->db->insert("barang",$data);
		
	}

	public function updateBarang($ID_BARANG,$ID_KATEGORI,$ID_BRAND,$NAMA_BARANG,$HARGA_JUAL,$HARGA_BELI,$SIZE,$STATUS)
	{
		$data=array(
			"ID_KATEGORI"=>$ID_KATEGORI,
			"ID_BARANG"=>$ID_BARANG,
			"NAMA_BARANG"=>$NAMA_BARANG,
			"HARGA_JUAL"=>$HARGA_JUAL,
			"HARGA_BELI"=>$HARGA_BELI,
			"SIZE"=>$SIZE,
			"STATUS"=>$STATUS
			);
		$this->db->where("ID_BARANG",$ID_BARANG);
		$this->db->update("barang",$data);
	}

	public function selectBarang($limit,$start)
	{
		$this->db->select("barang.ID_BARANG,barang.NAMA_BARANG,kategori.NAMA_KATEGORI,brand.NAMA_BRAND,barang.HARGA_BELI,barang.HARGA_JUAL,barang.SIZE,barang.STATUS");
		$this->db->join("kategori","kategori.ID_KATEGORI=barang.ID_KATEGORI");
		$this->db->join("brand","BRAND.ID_BRAND=barang.ID_BRAND");
		$query=$this->db->get("barang",$limit,$start);
		
		return $query->result();
	}

	public function deleteBarang($ID_BARANG)
	{
		$this->db->where("ID_BARANG",$ID_BARANG);
		$this->db->delete("barang");
		
	}

	public function selectBarangId($idbarang)
	{
		$this->db->where("ID_BARANG",$idbarang);
		$query=$this->db->get("barang");
		return $query->row();
	}
	
	public function getCountBarang()
	{
		return $this->db->count_all("barang");
	}


	public function selectMaxIdBarang($ID_BARANG_TEMP)
	{
		$this->db->select_max("ID_BARANG");
		//$this->db->where("SUBSTR(ID_BARANG,1,6)",$ID_BARANG_TEMP,FALSE);
		$this->db->like("ID_BARANG",$ID_BARANG_TEMP);
		return $this->db->get("barang")->row();
	}
	
}



/* End of file mbarang.php */
/* Location: ./application/models/mbarang.php */