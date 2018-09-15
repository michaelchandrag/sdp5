<?php
class Model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function get_supplier()
	{
		$query = $this->db->get ("supplier");
		return $query->result();
	}
	
	function count_supplier()
	{
		return $this->db->count_all("supplier");		
	}
	
	function get_supplier_where($id)
	{
		$this->db->where("ID_SUPPLIER",$id);
		$query = $this->db->get("supplier");
		return $query->result();
	}
	
	public function report_data_pembelian($from,$to)
	{
		return $this->db->query("select ID_HBELI,DATE_FORMAT(TANGGAL, '%d/%m/%Y') as TANGGAL,ID_SUPPLIER,ID_GUDANG,STATUS_LUNAS,TOTAL from h_beli where DATE(TANGGAL)>='".$from."' and DATE(TANGGAL)<'".$to."'")->result();
		echo $from;
	}
	
	function update_supplier($id,$namaS,$namaCP,$telpCP,$alamatS,$telpS,$status)
	{
		$this->db->where('ID_SUPPLIER',$id);
		$data = array(
			'NAMA_SUPPLIER' => $namaS,
			'NAMACP' => $namaCP,
			'TELPCP' => $telpCP,
			'ALAMAT_SUP' => $alamatS,
			'TELP_SUP' => $telpS,
			'STATUS' => $status
		);
		$this->db->update("supplier",$data);
	}
	
	function fetch($limit,$start)
	{
		$this->db->limit($limit,$start);
		$query = $this->db->get("supplier");
		if($query->num_rows() > 0)
			return $query->result();
		return false;
	}
	
	
	function insert_supplier($id,$namaS,$namaCP,$telpCP,$alamatS,$telpS)
	{
		$data = array(
			'ID_SUPPLIER' => $id,
			'NAMA_SUPPLIER' => $namaS,
			'NAMACP' => $namaCP,
			'TELPCP' => $telpCP,
			'ALAMAT_SUP' => $alamatS,
			'TELP_SUP' => $telpS,
			'STATUS' => "T"
		);
		
		$this->db->insert("supplier",$data);
	}
	
	function insert_kategori($id,$nama)
	{
		$data = array(
			'ID_KATEGORI' => $id,
			'NAMA_KATEGORI' => $nama
		);
		$this->db->insert("kategori",$data);
	}
	
	function count_kategori()
	{
		return $this->db->count_all("kategori");
	}
	
	function get_gudang()
	{
		$query = $this->db->get("gudang");
		return $query->result();
	}
	
	function get_barang()
	{
		$query = $this->db->get("barang");
		return $query->result();
	}
	
	function get_barang_id($id)
	{
		$this->db->where('ID_BARANG',$id);
		$query = $this->db->get("barang");
		return $query->result();
	}
	
	function insert_hbeli($id,$ids,$idg,$tanggal,$status_lunas,$total)
	{
		$data = array(
			'ID_HBELI'=> $id,
			'ID_SUPPLIER'=> $ids,
			'ID_GUDANG'=> $idg,
			'TANGGAL' => $tanggal,
			'STATUS_LUNAS' => $status_lunas,
			'TOTAL' => $total
		);
		$this->db->insert("h_beli",$data);
	}
	
	public function count_hbeli()
	{
		return $this->db->count_all("h_beli");
	}
	
	public function insert_dbeli($id,$idbarang,$namabarang,$qtypesan,$qtydatang,$subtotal,$harga_beli)
	{
		$data = array(
			'ID_HBELI' => $id,
			'ID_BARANG' => $idbarang,
			'NAMA_BARANG' => $namabarang,
			'QTYPESAN' => $qtypesan,
			'QTYDATANG' => $qtydatang,
			'SUBTOTAL' => $subtotal,
			'HARGA_BELI' => $harga_beli
		);
		$this->db->insert("dbeli",$data);
	}
	
	public function get_hbeli()
	{
		$query = $this->db->get("h_beli");
		return $query->result();
	}
	
	public function get_hbeli_where($id)
	{
		$this->db->where("ID_HBELI",$id);
		$query = $this->db->get("h_beli");
		return $query->result();
	}
	
	public function get_dbeli_where($id)
	{
		$this->db->where("ID_HBELI",$id);
		$query = $this->db->get("dbeli");
		return $query->result();
	}
	
	public function get_stok_dbeli_where($id,$idbarang)
	{
		$this->db->where(array(
			'ID_HBELI' => $id,
			'ID_BARANG' => $idbarang
		));
		$query = $this->db->get("dbeli");
		return $query->result();
	}
	
	public function update_dbeli_where($id,$idbarang,$qtypesan,$qtydatang,$subtotal)
	{
		$this->db->where(array(
			'ID_HBELI' => $id,
			'ID_BARANG' => $idbarang
		));
		$data = array(
			'QTYPESAN' => $qtypesan,
			'QTYDATANG' => $qtydatang,
			'SUBTOTAL' => $subtotal
		);
		$this->db->update("dbeli",$data);
	}
	
	public function count_dbeli_total($id)
	{
		$this->db->where('ID_HBELI',$id);
		$this->db->select_sum("SUBTOTAL");
		$query = $this->db->get("dbeli");
		return $query->result();
	}
	
	public function update_hbeli_total_where($id,$total)
	{
		$this->db->where('ID_HBELI',$id);
		$data = array(
			'TOTAL' => $total
		);
		$this->db->update("h_beli",$data);
	}
	
	public function update_status_hbeli($id,$status)
	{
		$this->db->where('ID_HBELI',$id);
		$data = array(
			'STATUS_LUNAS' => $status
		);
		$this->db->update("h_beli",$data);
	}
	
	public function delete_dbeli($id,$idbarang)
	{
		$this->db->where(array(
			'ID_HBELI' => $id,
			'ID_BARANG' => $idbarang
		));
		$this->db->delete("dbeli");
	}
	
	public function get_dgudang_where($id)
	{
		$this->db->where(array(
			'ID_GUDANG' => $id
		));
		$query = $this->db->get("dgudang");
		return $query->result();
	}
	
	public function update_stok_dgudang($id,$idbarang,$stok)
	{
		$data = array(
			'STOK' => $stok
		);
		$this->db->where(array(
			'ID_GUDANG' => $id,
			'ID_BARANG' => $idbarang
		));
		$this->db->update("dgudang",$data);
	}
	
	public function insert_dgudang($id,$idbarang,$stok)
	{
		$data = array(
			'ID_GUDANG' => $id,
			'ID_BARANG' => $idbarang,
			'STOK' =>$stok
		);
		$this->db->insert("dgudang",$data);
	}
}


?>