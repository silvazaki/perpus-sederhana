<?php  
/**
* 
*/
class Mkategori extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function tambah_kategori($data) 
	{
		$a = date('y-m-d');
		$this->db->query("INSERT INTO kategori  VALUES (?,?)",$data);

		//menghapus variabel dari memory
		//$data=null;
		unset($data);
	}

	public function data_kategori($nim) 
	{
		$query = $this->db->query("SELECT * FROM kategori WHERE id_kategori=?",array($nim)
			);

		//menghapus variabel dari memory
		//$data=null;
		return $query;
		$query = null;

		unset($nim);
	}

	public function daftar_kategori() 
	{
		$query = $this->db->query("SELECT * from kategori order by id_kategori asc");

		return $query;
		//menghapus variabel dari memory
		//$data=null;
		$query = null;

	}

	public function ubah_kategori($nim, $data) 
	{
		$query = $this->db->query("update kategori set kategori=? WHERE id_kategori=?",array($data['kategori'], $nim)
			);

		//menghapus variabel dari memory
		//$data=null;
		return $query;
		$query = null;

		unset($nim, $data);
	}

	public function hapus_kategori($nim) 
	{
		$query = $this->db->query("delete from kategori WHERE id_kategori=?",array($nim)
			);

		//menghapus variabel dari memory
		//$data=null;
		return $query;
		$query = null;

		unset($nim);
	}


	public function cari_kategori($data) 
	{
		$query = $this->db->query("select * from kategori WHERE id_kategori like ? or kategori like ? order by id_kategori asc",array('%'.$data.'%','%'.$data.'%')
			);

		//menghapus variabel dari memory
		//$data=null;
		return $query;
		$query = null;

		unset($nim);
	}

	function putus_koneksi()
	{
		$this->db=null;
	}
}

?>