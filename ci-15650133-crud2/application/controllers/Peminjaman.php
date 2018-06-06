<?php  
defined('BASEPATH') OR exit('No deirect script access allowed');

/**
* 
*/
class Peminjaman extends CI_Controller
{
	

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('userid') and $this->session->userdata('pass')) {
			# code...
			$this->load->model('mpeminjaman');
		} else {
			# code...			
			redirect(base_url('peminjaman'));	
		}
		
	}

	public function index()
	{
		$this->load->view('vpeminjaman');
	}

	public function tambah_peminjaman()
	{//mengecek dari form
		$data['page'] = 'tambah_peminjaman';
		$data['user'] = $this->mpeminjaman->get_nim()->result();
		$data['kode_buku'] = $this->mpeminjaman->get_kode()->result();
		$data['operator'] = $this->mpeminjaman->get_user()->result();

		$this->load->view('vpeminjaman', $data);
		unset($data);
	}

	public function proses_tambah_peminjaman()
	{//mengecek dari form
		$data['nim'] = $this->input->post('nim');
		$data['kode_buku']  = $this->input->post('kode_buku');
		$data['operator']  = $this->input->post('operator');


		//simpan ke database
		$this->mpeminjaman->tambah_peminjaman($data);

		redirect(base_url('peminjaman/daftar_peminjaman'));	

		unset($data);
	}

	public function daftar_peminjaman()
	{//mengecek dari form
		$data['page'] = 'daftar_peminjaman';

		if (!empty($this->input->post('cari'))) {
			$cari = $this->input->post("cari");
			$data['cari'] = $cari;
			$data['daftar_mhs'] = $this->mpeminjaman->cari_peminjaman($cari)->result();
			$data['jumlah'] = count($data['daftar_mhs']);
		} else {
			$data['daftar_mhs'] = $this->mpeminjaman->daftar_peminjaman()->result();
		}

		$this->load->view('vpeminjaman', $data);

		unset($data, $cari);
	}

	public function ubah_peminjaman($nim)
	{//mengecek dari form
		$data['page'] = 'ubah_peminjaman';
		$data['mhs']  = $this->mpeminjaman->data_peminjaman($nim)->row();
		// $data['user'] = $this->mpeminjaman->get_nim()->result();
		// $data['kode_buku'] = $this->mpeminjaman->get_kode()->result();
		$data['operator'] = $this->mpeminjaman->get_user()->result();



		$this->load->view('vpeminjaman', $data);

		unset($data);
	}

	public function proses_ubah_peminjaman()
	{
	// {//mengecek dari form
		$data['status']  = $this->input->post('status');
		$data['operator']  = $this->input->post('operator');
		$id = $this->input->post('id_transaksi');


		$this->mpeminjaman->ubah_peminjaman($id, $data);

		redirect(base_url('peminjaman/daftar_peminjaman'));	

		unset($nim, $data);
	}

	public function hapus_peminjaman($nim)
	{//mengecek dari form
		//simpan ke database
		$this->mpeminjaman->hapus_peminjaman($nim);

		redirect(base_url('peminjaman/daftar_peminjaman'));	
	}

	public function logout()
	{
		$this->mpeminjaman->putus_koneksi();

		$array_session = $this->session->all_userdata();
		$this->session->unset_userdata($array_session);
		unset($array_session);

		$this->session->sess_destroy();

		redirect(base_url('login'));
	}

}

?>