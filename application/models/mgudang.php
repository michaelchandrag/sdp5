<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mgudang extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insertGudang($ID_GUDANG,$NAMA_GUDANG,$ALAMAT_GUDANG,$TELP_GUDANG,$NAMACP_GUDANG,$TELPCP_GUDANG)
	{
		$data=array(
			"ID_GUDANG"=>$ID_GUDANG,
			"NAMA_GUDANG"=>$NAMA_GUDANG,
			"ALAMAT_GUDANG"=>$ALAMAT_GUDANG,
			"TELP_GUDANG"=>$TELP_GUDANG,
			"NAMACP_GUDANG"=>$NAMACP_GUDANG,
			"TELPCP_GUDANG"=>$TELPCP_GUDANG,
			"STATUS"=>"T"
		);
		

		$this->db->insert("gudang",$data);
		
	}

	public function updateGudang($ID_GUDANG,$NAMA_GUDANG,$ALAMAT_GUDANG,$TELP_GUDANG,$NAMACP_GUDANG,$TELPCP_GUDANG,$STATUS)
	{
		$data=array(
			"NAMA_GUDANG"=>$NAMA_GUDANG,
			"ALAMAT_GUDANG"=>$ALAMAT_GUDANG,
			"TELP_GUDANG"=>$TELP_GUDANG,
			"NAMACP_GUDANG"=>$NAMACP_GUDANG,
			"TELPCP_GUDANG"=>$TELPCP_GUDANG,
			"STATUS"=>$STATUS
		);

		$this->db->where("ID_GUDANG",$ID_GUDANG);
		$this->db->update("gudang",$data);

	}

	public function selectGudang($limit,$start)
	{	
	
		$query=$this->db->get("gudang",$limit,$start);
		return $query->result();
	}

	public function deleteGudang($ID_GUDANG)
	{
		$this->db->where("ID_GUDANG",$ID_GUDANG);
		$this->db->delete("gudang");
	}

	public function getCountGudang()
	{
		return $this->db->count_all("gudang");
	}

	public function selectGudangId($ID_GUDANG)
	{
		$this->db->where("ID_GUDANG",$ID_GUDANG);
		$query=$this->db->get("gudang");
		return $query->row();
	}

	public function selectMaxIdGudang()
	{
		$this->db->select_max("ID_GUDANG");
		return $this->db->get("gudang")->row();
	}




}


?>
