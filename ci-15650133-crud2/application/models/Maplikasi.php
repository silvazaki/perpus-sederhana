<?php  
/**
* 
*/
class Maplikasi extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function tambah_mahasiswa($data) 
	{
		$this->db->query("INSERT INTO mahasiswa VALUES (?,?,?,?,?,?)",
			$data);

		//menghapus variabel dari memory
		//$data=null;
		unset($data);
	}

	public function data_mahasiswa($nim) 
	{
		$query = $this->db->query("SELECT * FROM mahasiswa WHERE nim=?",array($nim)
			);

		//menghapus variabel dari memory
		//$data=null;
		return $query;
		$query = null;

		unset($nim);
	}

	public function daftar_mahasiswa() 
	{
		$query = $this->db->query("SELECT * from mahasiswa order by nim asc");

		return $query;
		//menghapus variabel dari memory
		//$data=null;
		$query = null;

	}

	public function ubah_mahasiswa($nim, $data) 
	{
		$query = $this->db->query("update mahasiswa set nama=?, jk=?, alamat=?, kota=?, email=? WHERE nim=?",array($data['nama'],$data['jk'],$data['alamat'],$data['kota'],$data['email'], $nim)
			);

		//menghapus variabel dari memory
		//$data=null;
		$query = null;

		unset($nim, $data);
	}

	public function hapus_mahasiswa($nim) 
	{
		$query = $this->db->query("delete from mahasiswa WHERE nim=?",array($nim)
			);

		//menghapus variabel dari memory
		//$data=null;
		return $query;
		$query = null;

		unset($nim);
	}


	public function cari_mahasiswa($data) 
	{
		$query = $this->db->query("select * from mahasiswa WHERE nim like ? or nama like ? or kota like ? or email like ? or jk like ? order by nim asc",array('%'.$data.'%','%'.$data.'%','%'.$data.'%','%'.$data.'%','%'.$data.'%')
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