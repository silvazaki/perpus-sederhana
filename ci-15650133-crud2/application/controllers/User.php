<?php  
defined('BASEPATH') OR exit('No deirect script access allowed');

/**
* 
*/
class User extends CI_Controller
{
	

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('userid') and $this->session->userdata('pass')) {
			# code...
			$this->load->model('muser');
		} else {
			# code...			
			redirect(base_url('user'));	
		}
		
	}

	public function index()
	{
		$this->load->view('vuser');
	}

	public function tambah_user()
	{//mengecek dari form
		$data['page'] = 'tambah_user';


		$this->load->view('vuser', $data);
		unset($data);
	}

	public function proses_tambah_user()
	{//mengecek dari form
		$data['id_user'] = $this->input->post('id_user');
		$data['password']  = $this->input->post('password');
		$data['nama']  = $this->input->post('nama');


		//simpan ke database
		$this->muser->tambah_user($data);

		redirect(base_url('user/daftar_user'));	

		unset($data);
	}

	public function daftar_user()
	{//mengecek dari form
		$data['page'] = 'daftar_user';

		if (!empty($this->input->post('cari'))) {
			$cari = $this->input->post("cari");
			$data['cari'] = $cari;
			$data['daftar_mhs'] = $this->muser->cari_user($cari)->result();
			$data['jumlah'] = count($data['daftar_mhs']);
		} else {
			$data['daftar_mhs'] = $this->muser->daftar_user()->result();
		}

		$this->load->view('vuser', $data);

		unset($data, $cari);
	}

	public function ubah_user($nim)
	{//mengecek dari form
		$data['page'] = 'ubah_user';
		$data['mhs']  = $this->muser->data_user($nim)->row();


		$this->load->view('vuser', $data);

		unset($data);
	}

	public function proses_ubah_user()
	{//mengecek dari form
		$data['nama']  = $this->input->post('nama');
		$data['password']  = $this->input->post('password');
		$id_user = $this->input->post('id_user');


		$this->muser->ubah_user($id_user, $data);

		redirect(base_url('user/daftar_user'));	

		unset($nim, $data);
	}

	public function hapus_user($nim)
	{//mengecek dari form
		//simpan ke database
		$this->muser->hapus_user($nim);

		redirect(base_url('user/daftar_user'));	
	}

	public function logout()
	{
		$this->muser->putus_koneksi();

		$array_session = $this->session->all_userdata();
		$this->session->unset_userdata($array_session);
		unset($array_session);

		$this->session->sess_destroy();

		redirect(base_url('login'));
	}

}

?>