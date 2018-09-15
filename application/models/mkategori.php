<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkategori extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insertKategori($ID_KATEGORI,$NAMA_KATEGORI)
	{
		$data=array(
			"ID_KATEGORI"=>$ID_KATEGORI,
			"NAMA_KATEGORI"=>$NAMA_KATEGORI,
			"STATUS"=>"T"
			);
		$this->db->insert("kategori",$data);
	}

	public function updateKategori($ID_KATEGORI,$NAMA_KATEGORI,$STATUS)
	{
		$data=array(
			"NAMA_KATEGORI"=>$NAMA_KATEGORI,
			"STATUS"=>$STATUS
			);
		$this->db->where("ID_KATEGORI",$ID_KATEGORI);
		$this->db->update("kategori",$data);
	}

	public function selectKategori($limit,$start)
	{
		$query=$this->db->get("kategori",$limit,$start);
		return $query->result();
	}

	public function deleteKategori($ID_KATEGORI)
	{
		$this->db->where("ID_KATEGORI",$ID_KATEGORI);
		$this->db->delete("kategori");
	}

	public function getCountKategori()
	{
		return $this->db->count_all("kategori");
	}

	public function selectKategoriId($idkategori)
	{
		$this->db->where("ID_KATEGORI",$idkategori);
		$query=$this->db->get("kategori");

		return $query->row();
	}

	public function selectMaxIdKategori()
	{
		$this->db->select_max("ID_KATEGORI");
		return $this->db->get("kategori")->row();
	}
}

/* End of file mkategori.php */
/* Location: ./application/models/mkategori.php */