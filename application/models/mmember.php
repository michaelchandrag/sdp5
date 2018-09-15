<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmember extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	public function insertMember($idmember,$namamember,$alamat,$telp,$poin)
	{
		$data=array(
			"ID_MEMBER"=>$idmember,
			"NAMA"=>$namamember,
			"ALAMAT"=>$alamat,
			"TELP"=>$telp,
			"POIN"=>$poin,
			"STATUS"=>"0"
			);

		$this->db->insert("member",$data);
		
	}
	public function updateMember($idmember,$namamember,$alamat,$telp,$poin,$status)
	{
		$data=array(
			"NAMA"=>$namamember,
			"ALAMAT"=>$alamat,
			"TELP"=>$telp,
			"POIN"=>$poin,
			"STATUS"=>$status
			);
		$this->db->where("ID_MEMBER",$idmember);
		$this->db->update("member",$data);
	}
	public function deleteMember($ID_MEMBER)
	{
		$data=array(
			"STATUS"=>"1"
			);
		$this->db->where("ID_MEMBER",$ID_MEMBER);
		$this->db->update("member",$data);
	}
	public function selectMember($limit,$start)
	{
		//$query = $this->db->order_by("NAMA");
		$query = $this->db->get("member",$limit,$start);
		
		return $query->result();
	}
	public function selectMemberId($idmember)
	{
		$this->db->where("ID_MEMBER",$idmember);
		$query=$this->db->get("member");
		return $query->row();
	}
	public function autogenidmember()
	{
		$yyyy = date("Y");
		$mm = date("m");
		$dd = date("d");
		$maxctr = "";
		$String = "select max(ID_MEMBER) bantuanmax from member";
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
		$hasilakhir = "ME".$mm.$dd.$yyyy.$angkamaxend;
		return $hasilakhir;
		
	}
}

/* End of file mmember.php */
/* Location: ./application/models/mmember.php */
?>
