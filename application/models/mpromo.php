<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpromo extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	public function insertPromo($idpromo,$namapromo,$diskon,$tglmulai,$tglakhir,$keterangan)
	{
		$data=array(
			"ID_PROMO"=>$idpromo,
			"NAMA_PROMO"=>$namapromo,
			"DISKON"=>$diskon,
			"TGL_MULAI"=>$tglmulai,
			"TGL_AKHIR"=>$tglakhir,
			"KETERANGAN"=>$keterangan,
			"STATUS"=>"0"
			);

		$this->db->insert("promo",$data);
		
	}
	public function updatePromo($idpromo,$namapromo,$diskon,$tglmulai,$tglakhir,$keterangan,$status)
	{
		$data=array(
			"NAMA_PROMO"=>$namapromo,
			"DISKON"=>$diskon,
			"TGL_MULAI"=>$tglmulai,
			"TGL_AKHIR"=>$tglakhir,
			"KETERANGAN"=>$keterangan,
			"STATUS"=>$status
			);
		$this->db->where("ID_PROMO",$idpromo);
		$this->db->update("promo",$data);
	}
	public function deletePromo($ID_PROMO)
	{
		$data=array(
			"STATUS"=>"1"
			);
		$this->db->where("ID_PROMO",$ID_PROMO);
		$this->db->update("promo",$data);
	}
	public function selectPromo($limit,$start)
	{
		//$query = $this->db->order_by("NAMA");
		$query = $this->db->get("promo",$limit,$start);
		return $query->result();
	}
	public function selectPromoId($idpromo)
	{
		
		$this->db->where("ID_PROMO",$idpromo);
		$query=$this->db->get("promo");
		return $query->row();
	}
	public function autogenidpromo()
	{
		$yyyy = date("Y");
		$mm = date("m");
		$dd = date("d");
		$maxctr = "";
		$String = "select max(ID_PROMO) bantuanmax from promo";
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
		$hasilakhir = "PR".$mm.$dd.$yyyy.$angkamaxend;
		return $hasilakhir;
	}
}

/* End of file mpromo.php */
/* Location: ./application/models/mpromo.php */
?>
