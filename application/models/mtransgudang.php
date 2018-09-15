<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtransgudang extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function insertTransGudang($ID_TRANS_GUDANG,$ID_ORIGIN_GUDANG,$ID_DESTINATION_GUDANG,$TGL,$KETERANGAN)
	{
		$data=array(
			"ID_TRANS_GUDANG"=>$ID_TRANS_GUDANG,
			"ID_GUDANG"=>$ID_ORIGIN_GUDANG,
			"GUD_ID_GUDANG"=>$ID_DESTINATION_GUDANG,
			"TGL"=>$TGL,
			"KETERANGAN"=>$KETERANGAN
			);

		$this->db->insert("transfer_gudang",$data);
	}

	public function deleteTransGudang($ID_TRANS_GUDANG)
	{
		$this->db->where("ID_TRANS_GUDANG",$ID_TRANS_GUDANG);
		$this->db->delete("transfer_gudang");
	}

	public function updateTransGudang($ID_TRANS_GUDANG,$ID_ORIGIN_GUDANG,$ID_DESTINATION_GUDANG,$TGL,$KETERANGAN)
	{
		$data=array(
			"ID_GUDANG"=>$ID_ORIGIN_GUDANG,
			"GUD_ID_GUDANG"=>$ID_DESTINATION_GUDANG,
			"TGL"=>$TGL,
			"KETERANGAN"=>$KETERANGAN
			);
		$this->db->where("ID_TRANS_GUDANG",$ID_TRANS_GUDANG);
		$this->db->update("transfer_gudang",$data);
	}

	public function selectTransGudang()
	{
		 return $this->db->query("select DATE_FORMAT(t.TGL, '%d/%m/%Y') as TGL,g.NAMA_GUDANG as ASAL,f.NAMA_GUDANG as TUJUAN,t.KETERANGAN,t.ID_TRANS_GUDANG as ID_TRANS_GUDANG from transfer_gudang t,gudang g,gudang f where t.ID_GUDANG=g.ID_GUDANG and t.GUD_ID_GUDANG=f.ID_GUDANG")->result();


	}

	public function selectTransGudangforReport($from,$to)
	{
		return $this->db->query("select DATE_FORMAT(t.TGL, '%d/%m/%Y') as TGL,g.NAMA_GUDANG as ASAL,f.NAMA_GUDANG as TUJUAN,t.KETERANGAN,t.ID_TRANS_GUDANG as ID_TRANS_GUDANG from transfer_gudang t,gudang g,gudang f where t.ID_GUDANG=g.ID_GUDANG and t.GUD_ID_GUDANG=f.ID_GUDANG  and DATE(t.TGL)>='".$from."' and DATE(t.TGL)<='".$to."'")->result();

		echo $from;
	}

	public function selectTransferGudangById($idtransfergudang)
	{
		$this->db->select("DATE_FORMAT(transfer_gudang.TGL, '%d/%m/%Y') as TGL,g.NAMA_GUDANG as ASAL,gg.NAMA_GUDANG as TUJUAN,transfer_gudang.KETERANGAN as KETERANGAN");
		$this->db->where("ID_TRANS_GUDANG",$idtransfergudang);
		$this->db->join("gudang g","g.ID_GUDANG=transfer_gudang.ID_GUDANG");
		$this->db->join("gudang gg","gg.ID_GUDANG=transfer_gudang.GUD_ID_GUDANG");
		$query=$this->db->get("transfer_gudang");

		return $query->row();

	}

	public function generateNumberIdTransGudang($prefix)
	{
		return $this->db->query("select count(*) as NOURUT from transfer_gudang where SUBSTR(ID_TRANS_GUDANG,1,6)='$prefix'")->row();
	}
}

/* End of file mtransgudang */
/* Location: ./application/models/mtransgudang */