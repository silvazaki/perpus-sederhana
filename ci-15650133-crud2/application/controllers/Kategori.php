<?php  
defined('BASEPATH') OR exit('No deirect script access allowed');

/**
* 
*/
class kategori extends CI_Controller
{
	

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('userid') and $this->session->userdata('pass')) {
			# code...
			$this->load->model('mkategori');
		} else {
			# code...			
			redirect(base_url('kategori'));	
		}
		
	}

	public function index()
	{
		$this->load->view('vkategori');
	}

	public function tambah_kategori()
	{//mengecek dari form
		$data['page'] = 'tambah_kategori';

		$this->load->view('vkategori', $data);
		unset($data);
	}

	public function proses_tambah_kategori()
	{//mengecek dari form
		$data['nim'] = $this->input->post('id');
		$data['kode_buku']  = $this->input->post('kategori');


		//simpan ke database
		$this->mkategori->tambah_kategori($data);

		redirect(base_url('kategori/daftar_kategori'));	

		unset($data);
	}

	public function daftar_kategori()
	{//mengecek dari form
		$data['page'] = 'daftar_kategori';

		if (!empty($this->input->post('cari'))) {
			$cari = $this->input->post("cari");
			$data['cari'] = $cari;
			$data['daftar_mhs'] = $this->mkategori->cari_kategori($cari)->result();
			$data['jumlah'] = count($data['daftar_mhs']);
		} else {
			$data['daftar_mhs'] = $this->mkategori->daftar_kategori()->result();
		}

		$this->load->view('vkategori', $data);

		unset($data, $cari);
	}

	public function ubah_kategori($nim)
	{//mengecek dari form
		$data['page'] = 'ubah_kategori';
		$data['mhs']  = $this->mkategori->data_kategori($nim)->row();


		$this->load->view('vkategori', $data);

		unset($data);
	}

	public function proses_ubah_kategori()
	{
	// {//mengecek dari form
		$data['kategori']  = $this->input->post('kategori');
		$id = $this->input->post('id');


		$this->mkategori->ubah_kategori($id, $data);

		redirect(base_url('kategori/daftar_kategori'));	

		unset($nim, $data);
	}

	public function hapus_kategori($nim)
	{//mengecek dari form
		//simpan ke database
		$this->mkategori->hapus_kategori($nim);

		redirect(base_url('kategori/daftar_kategori'));	
	}

	public function logout()
	{
		$this->mkategori->putus_koneksi();

		$array_session = $this->session->all_userdata();
		$this->session->unset_userdata($array_session);
		unset($array_session);

		$this->session->sess_destroy();

		redirect(base_url('login'));
	}

}

?>