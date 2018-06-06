<?php  
defined('BASEPATH') OR exit('No deirect script access allowed');

/**
* 
*/
class Login extends CI_Controller
{
	

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mlogin');
	}

	public function index()
	{
		//jika ada session maka redirect ke controller aplikasi
		if ($this->session->userdata('userid') and $this->session->userdata('pass' ))
		{		
			redirect(base_url('aplikasi'));	
		} else 
		{
			$this->load->view('vlogin');
		}
	}

	public function filter($data) 
	{
		$data = preg_replace('/[^a-zA-Z0-9]/', '', $data);
		return $data;
		unset($data);
	}

	public function cek_login()
	{//input useri dan password hanya angka dan huruf saja
		$userid = $this->input->post('userid');
		echo $userid = $this->filter($userid);

		$password = $this->input->post('password');
		echo $password = $this->filter($password);

		//
		//
		$cek = $this->mlogin->db_cek_login($userid,$password)->row();
		$jumlah = count($cek);

		if ($jumlah > 0) 
		{
			$array_session = array('userid' => $cek->id_user, 'pass' => $cek->password, 'nama' => $cek->nama, 'sukses_login' => true);
			$this->session->set_userdata($array_session);
			redirect(base_url('aplikasi'));
		} else
		{			
			redirect(base_url('login/login_gagal'));
		}

		unset($userid, $password, $cek, $jumlah, $array_session);
	}

	public function login_gagal() {
		$data['gagal'] = 'Anda Gagal Login';

		//menampilkan hasil
		$this->load->view('vlogin', $data);
		
	}
}

?>