<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdtransgudang extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insertDtransgudang($ID_TRANS_GUDANG,$ID_BARANG,$QTY)
	{
		$data=array(
			"ID_TRANS_GUDANG"=>$ID_TRANS_GUDANG,
			"ID_BARANG"=>$ID_BARANG,
			"QTY"=>$QTY
			);
		$this->db->insert("dtransgudang",$data);

	}

	public function updateDtransgudang($ID_TRANS_GUDANG,$ID_BARANG,$QTY)
	{
		$data=array(
			"QTY"=>$QTY
			);
		$this->db->where("ID_TRANS_GUDANG",$ID_TRANS_GUDANG);
		$this->db->where("ID_BARANG",$ID_BARANG);
		$this->db->update("dtransgudang",$data);

	}
	
	public function deleteDtransgudang($ID_TRANS_GUDANG,$ID_BARANG)
	{
		$this->db->where("ID_TRANS_GUDANG",$ID_TRANS_GUDANG);
		$this->db->where("ID_BARANG",$ID_BARANG);
		$this->db->delete("dtransgudang");
	}

	public function selectDtransgudang($limit,$start)
	{
		$query=$this->db->get("dtransgudang",$limit,$start);
		return $query->result();

	}

	public function selectDtransgudangById($idtransfergudang)
	{	
		$this->db->select("barang.NAMA_BARANG as NAMA_BARANG,dtransgudang.QTY");
		$this->db->where("ID_TRANS_GUDANG",$idtransfergudang);
		$this->db->join("barang","barang.ID_BARANG=dtransgudang.ID_BARANG");
		$query=$this->db->get("dtransgudang");

		return $query->result();
	}

	

}

/* End of file mdtransgudang.php */
/* Location: ./application/models/mdtransgudang.php */