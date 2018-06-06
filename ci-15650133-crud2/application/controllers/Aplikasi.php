<?php  
defined('BASEPATH') OR exit('No deirect script access allowed');

/**
* 
*/
class Aplikasi extends CI_Controller
{
	

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('userid') and $this->session->userdata('pass')) {
			# code...
			$this->load->model('maplikasi');
		} else {
			# code...			
			redirect(base_url('aplikasi'));	
		}
		
	}

	public function index()
	{
		$this->load->view('vaplikasi');
	}

	public function tambah_mahasiswa()
	{//mengecek dari form
		$data['page'] = 'tambah_mahasiswa';


		$this->load->view('vaplikasi', $data);
		unset($data);
	}

	public function proses_tambah_mahasiswa()
	{//mengecek dari form
		$data['nim'] = $this->input->post('nim');
		$data['nama']  = $this->input->post('nama');
		$data['jk'] = $this->input->post('jk');
		$data['alamat']  = $this->input->post('alamat');
		$data['asal'] = $this->input->post('asal');
		$data['email']  = $this->input->post('email');


		//simpan ke database
		$this->maplikasi->tambah_mahasiswa($data);

		redirect(base_url('aplikasi/daftar_mahasiswa'));	

		unset($data);
	}

	public function daftar_mahasiswa()
	{//mengecek dari form
		$data['page'] = 'daftar_mahasiswa';

		if (!empty($this->input->post('cari'))) {
			$cari = $this->input->post("cari");
			$data['cari'] = $cari;
			$data['daftar_mhs'] = $this->maplikasi->cari_mahasiswa($cari)->result();
			$data['jumlah'] = count($data['daftar_mhs']);
		} else {
			$data['daftar_mhs'] = $this->maplikasi->daftar_mahasiswa()->result();
		}

		$this->load->view('vaplikasi', $data);

		unset($data, $cari);
	}

	public function ubah_mahasiswa($nim)
	{//mengecek dari form
		$data['page'] = 'ubah_mahasiswa';
		$data['mhs']  = $this->maplikasi->data_mahasiswa($nim)->row();


		$this->load->view('vaplikasi', $data);

		unset($data);
	}

	public function proses_ubah_mahasiswa()
	{//mengecek dari form
		$data['nama']  = $this->input->post('nama');
		$data['jk']  = $this->input->post('jk');
		$data['alamat']  = $this->input->post('alamat');
		$data['kota']  = $this->input->post('kota');
		$data['email']  = $this->input->post('email');
		$nim = $this->input->post('nim');


		$this->maplikasi->ubah_mahasiswa($nim, $data);

		redirect(base_url('aplikasi/daftar_mahasiswa'));	

		unset($nim, $data);
	}

	public function hapus_mahasiswa($nim)
	{//mengecek dari form
		//simpan ke database
		$this->maplikasi->hapus_mahasiswa($nim);

		redirect(base_url('aplikasi/daftar_mahasiswa'));	
	}

	public function logout()
	{
		$this->maplikasi->putus_koneksi();

		$array_session = $this->session->all_userdata();
		$this->session->unset_userdata($array_session);
		unset($array_session);

		$this->session->sess_destroy();

		redirect(base_url('login'));
	}

}

?>