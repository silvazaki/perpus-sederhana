<?php  
/**
* 
*/
class Mlogin extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function db_cek_login($userid, $password) 
	{
		$query = $this->db->query("SELECT * FROM user WHERE id_user=? AND password=?", array($userid, $password));
		return $query;
		$query=null;

		//menghapus variabel dari memory
		//$data=null;
		unset($userid, $password);
	}
}

?>