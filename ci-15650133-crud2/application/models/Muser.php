<?php  
/**
* 
*/
class Muser extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function tambah_user($data) 
	{
		$this->db->query("INSERT INTO user (id_user, password, nama) VALUES (?,?,?)",
			array($data['id_user'],$data['password'], $data['nama']));

		//menghapus variabel dari memory
		//$data=null;
		unset($data);
	}
	public function data_user($id_user) 
	{
		$query = $this->db->query("SELECT id_user, password, nama FROM user WHERE id_user=?",array($id_user)
			);

		//menghapus variabel dari memory
		//$data=null;
		return $query;
		$query = null;

		unset($id_user);
	}

	public function daftar_user() 
	{
		$query = $this->db->query("SELECT id_user, password, nama from user order by id_user asc");

		return $query;
		//menghapus variabel dari memory
		//$data=null;
		$query = null;

	}

	public function ubah_user($id_user, $data) 
	{
		$query = $this->db->query("update user set nama=?, password=? WHERE id_user=?",array($data['nama'],$data['password'], $id_user)
			);

		//menghapus variabel dari memory
		//$data=null;
		return $query;
		$query = null;

		unset($id_user, $data);
	}

	public function hapus_user($id_user) 
	{
		$query = $this->db->query("delete from user WHERE id_user=?",array($id_user)
			);

		//menghapus variabel dari memory
		//$data=null;
		return $query;
		$query = null;

		unset($id_user);
	}


	public function cari_user($data) 
	{
		$query = $this->db->query("select id_user, password, nama from user WHERE id_user like ? or nama like ? order by id_user asc",array('%'.$data.'%','%'.$data.'%')
			);

		//menghapus variabel dari memory
		//$data=null;
		return $query;
		$query = null;

		unset($id_user);
	}

	function putus_koneksi()
	{
		$this->db=null;
	}
}

?>