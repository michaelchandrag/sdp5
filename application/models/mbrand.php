<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mbrand extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}	

	public function insertBrand($ID_BRAND,$NAMA_BRAND)
	{
		$data=array(
			"ID_BRAND"=>$ID_BRAND,
			"NAMA_BRAND"=>$NAMA_BRAND,
			"STATUS"=>"T"
			);
		$this->db->insert("brand",$data);
	}

	public function updateBrand($ID_BRAND,$NAMA_BRAND,$STATUS)
	{
		$data=array(
			"NAMA_BRAND"=>$NAMA_BRAND,
			"STATUS"=>$STATUS
			);
		$this->db->where("ID_BRAND",$ID_BRAND);
		$this->db->update("brand",$data);
	}

	public function selectBrand($limit,$start)
	{
		$query=$this->db->get("brand",$limit,$start);
		return $query->result();
	}

	public function deleteBrand($ID_BRAND)
	{
		$this->db->where("ID_BRAND",$ID_BRAND);
		$this->db->delete("brand");
	}

	public function getCountBrand()
	{
		return $this->db->count_all("brand");
	}

	public function selectBrandId($idbrand)
	{
		$this->db->where("ID_BRAND",$idbrand);
		$query=$this->db->get("brand");
		return $query->row();
	}

	public function selectMaxIdBrand()
	{
		$this->db->select_max("ID_BRAND");
		return $this->db->get("brand")->row();
	}

}

/* End of file mbrang.php */
/* Location: ./application/models/mbrang.php */