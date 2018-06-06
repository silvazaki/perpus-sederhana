<?php  
/**
* 
*/
class Mpeminjaman extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function tambah_peminjaman($data) 
	{
		$a = date('d-m-y');
		$this->db->query("INSERT INTO peminjaman (nim, kode_buku, tanggal_pinjam, status, operator) VALUES (?,?,'$a','belum kembali',?)",$data);

		//menghapus variabel dari memory
		//$data=null;
		unset($data);
	}

	public function data_peminjaman($nim) 
	{
		$query = $this->db->query("SELECT * from v_peminjaman where id_transaksi=?",array($nim)
			);

		//menghapus variabel dari memory
		//$data=null;
		return $query;
		$query = null;

		unset($nim);
	}

	public function get_nim() {
		$query = $this->db->query("select * from mahasiswa");
		return $query;
	}
	public function get_kode() {
		$query = $this->db->query("select * from buku");
		return $query;
	}
	public function get_user() {
		$query = $this->db->query("select * from user");
		return $query;
	}

	public function daftar_peminjaman() 
	{
		$query = $this->db->query("SELECT a.id_transaksi, a.nim, b.nama, a.kode_buku, c.judul, a.tanggal_pinjam, a.tanggal_kembali, a.status, a.operator, d.nama as 'petugas' FROM peminjaman a, mahasiswa b, buku c, user d where a.nim=b.nim and a.kode_buku=c.kode_buku and a.operator=d.id_user order by id_transaksi asc");

		return $query;
		//menghapus variabel dari memory
		//$data=null;
		$query = null;

	}

	public function ubah_peminjaman($id_transaksi, $data) 
	{
		$a = date('d-m-y');
		$query = $this->db->query("update peminjaman set tanggal_kembali='$a', status=?, operator=? WHERE id_transaksi=?",array($data['status'],$data['operator'], $id_transaksi)
			);

		//menghapus variabel dari memory
		//$data=null;
		return $query;
		$query = null;

		unset($nim, $data);
	}

	public function hapus_peminjaman($nim) 
	{
		$query = $this->db->query("delete from peminjaman WHERE id_transaksi=?",array($nim)
			);

		//menghapus variabel dari memory
		//$data=null;
		return $query;
		$query = null;

		unset($nim);
	}


	public function cari_peminjaman($data) 
	{
		$query = $this->db->query("select * from v_peminjaman WHERE id_transaksi like ? or nim like ? or kode_buku like ? or nama like ? or judul like ? order by nim asc",array('%'.$data.'%','%'.$data.'%','%'.$data.'%','%'.$data.'%','%'.$data.'%')
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