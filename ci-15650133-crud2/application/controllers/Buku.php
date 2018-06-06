<?php  
defined('BASEPATH') OR exit('No deirect script access allowed');

/**
* 
*/
class Buku extends CI_Controller
{
	

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('userid') and $this->session->userdata('pass')) {
			# code...
			$this->load->model('mbuku');
		} else {
			# code...			
			redirect(base_url('buku'));	
		}
		
	}

	public function index()
	{
		$this->load->view('vbuku');
	}

	public function tambah_buku()
	{//mengecek dari form
		$data['page'] = 'tambah_buku';
		$data['kategori'] = $this->mbuku->get_kategori()->result();


		$this->load->view('vbuku', $data);
		unset($data);
	}

	public function proses_tambah_buku()
	{//mengecek dari form
		$data['kode_buku'] = $this->input->post('kode_buku');
		$data['judul']  = $this->input->post('judul');
		$data['pengarang'] = $this->input->post('pengarang');
		$data['penerbit']  = $this->input->post('penerbit');
		$data['id_kategori']  = $this->input->post('id_kategori');


		//simpan ke database
		$this->mbuku->tambah_buku($data);

		redirect(base_url('buku/daftar_buku'));	

		unset($data);
	}

	public function daftar_buku()
	{//mengecek dari form
		$data['page'] = 'daftar_buku';

		if (!empty($this->input->post('cari'))) {
			$cari = $this->input->post("cari");
			$data['cari'] = $cari;
			$data['daftar_mhs'] = $this->mbuku->cari_buku($cari)->result();
			$data['jumlah'] = count($data['daftar_mhs']);
		} else {
			$data['daftar_mhs'] = $this->mbuku->daftar_buku()->result();
		}

		$this->load->view('vbuku', $data);

		unset($data, $cari);
	}

	public function ubah_buku($kode_buku)
	{//mengecek dari form
		$data['page'] = 'ubah_buku';
		$data['mhs']  = $this->mbuku->data_buku($kode_buku)->row();
		$data['kategori'] = $this->mbuku->get_kategori()->result();


		$this->load->view('vbuku', $data);

		unset($data);
	}

	public function proses_ubah_buku()
	{//mengecek dari form
		$data['judul']  = $this->input->post('judul');
		$data['pengarang']  = $this->input->post('pengarang');
		$data['penerbit']  = $this->input->post('penerbit');
		$data['id_kategori']  = $this->input->post('id_kategori');
		$kode_buku = $this->input->post('nim');


		$this->mbuku->ubah_buku($kode_buku, $data);

		redirect(base_url('buku/daftar_buku'));	

		unset($kode_buku, $data);
	}

	public function hapus_buku($kode_buku)
	{//mengecek dari form
		//simpan ke database
		$this->mbuku->hapus_buku($kode_buku);

		redirect(base_url('buku/daftar_buku'));	
	}

	public function logout()
	{
		$this->mbuku->putus_koneksi();

		$array_session = $this->session->all_bukudata();
		$this->session->unset_userdata($array_session);
		unset($array_session);

		$this->session->sess_destroy();

		redirect(base_url('login'));
	}

}

?>