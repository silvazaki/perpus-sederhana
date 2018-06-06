<?php  
/**
* 
*/
class Mbuku extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function tambah_buku($data) 
	{
		$this->db->query("INSERT INTO buku (kode_buku, judul, pengarang, penerbit, id_kategori) VALUES (?,?,?,?,?)",
			array($data['kode_buku'], $data['judul'], $data['pengarang'], $data['penerbit'], $data['id_kategori']));

		//menghapus variabel dari memory
		//$data=null;
		unset($data);
	}

	public function data_buku($kode_buku) 
	{
		$query = $this->db->query("SELECT * from v_buku where  kode_buku=?",array($kode_buku)
			);

		//menghapus variabel dari memory
		//$data=null;
		return $query;
		$query = null;

		unset($kode_buku);
	}


	public function get_kategori() {
		$query = $this->db->query("select * from kategori");
		return $query;
	}

	public function daftar_buku() 
	{
		$query = $this->db->query("SELECT a.*, b.* FROM buku a, kategori b where a.id_kategori = b.id_kategori order by kode_buku asc");

		return $query;
		//menghapus variabel dari memory
		//$data=null;
		$query = null;

	}

	public function ubah_buku($kode_buku, $data) 
	{
		$query = $this->db->query("update buku set judul=?, pengarang=?, penerbit=?, id_kategori=? WHERE kode_buku=?",array($data['judul'],$data['pengarang'],$data['penerbit'],$data['id_kategori'], $kode_buku)
			);

		//menghapus variabel dari memory
		//$data=null;
		return $query;
		$query = null;

		unset($kode_buku, $data);
	}

	public function hapus_buku($kode_buku) 
	{
		$query = $this->db->query("delete from buku WHERE kode_buku=?",array($kode_buku)
			);

		//menghapus variabel dari memory
		//$data=null;
		return $query;
		$query = null;

		unset($kode_buku);
	}


	public function cari_buku($data) 
	{
		$query = $this->db->query("select * from v_buku WHERE kode_buku like ? or judul like ? order by kode_buku asc",array('%'.$data.'%','%'.$data.'%')
			);

		//menghapus variabel dari memory
		//$data=null;
		return $query;
		$query = null;

		unset($kode_buku);
	}

	function putus_koneksi()
	{
		$this->db=null;
	}
}

?>