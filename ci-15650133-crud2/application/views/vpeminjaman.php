<?php  
defined('BASEPATH') OR exit('No deirect script access allowed');
if ($this->session->userdata('userid') and $this->session->userdata('pass')){
  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <title>Perpustakaan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/bootstrap.css")?>">
  </head>
  <body>
    <div class="container">
      <!-- <?php echo date('y-m-d'); ?> -->
      <fieldset>
        <?if (isset($page) and ($page == 'tambah_peminjaman')) { ?>
        <legend>Tambah peminjaman</legend>
        <?=form_open('peminjaman/proses_tambah_peminjaman','class="form-horizontal"')?>
        <table>
          <tr><td>NIM</td><td>: 
            <select name="nim">
              <?php if($user) {
                foreach ($user as $value) {
                  ?>      
                    <option value="<?=$value->nim; ?>"><?=$value->nim; ?></option>
                  <?php    }
              }?>
            </select>
          </td></tr>
          <tr><td>Judul Buku</td><td>: 
            <select name="kode_buku">
              <?php if($kode_buku) {
                foreach ($kode_buku as $value) {
                  ?>      
                    <option value="<?=$value->kode_buku; ?>"><?=$value->judul; ?></option>
                  <?php    }
              }?>
            </select>
          </td></tr>
          <tr><td>Petugas</td><td>: 
            <select name="operator">
              <?php if($operator) {
                foreach ($operator as $value) {
                  ?>      
                    <option value="<?=$value->id_user; ?>"><?=$value->nama; ?></option>
                  <?php    }
              }?>
            </select>
          </td></tr>
            <tr><td><button type="submit" name="simpan" class="btn btn-primary"><i class="icon-lock icon-white"></i>Simpan</button></td></tr>
          </table>
        </form>
        <?
      }else if (isset($page) and ($page == 'ubah_peminjaman')) { ?>
      <legend>Ubah peminjaman</legend>
      <?=form_open('peminjaman/proses_ubah_peminjaman','class="form-horizontal"')?>
      <input type="hidden" name="nim" value="<?=$mhs->nim?>">
      <table>
        <tr><td>ID Transaksi</td><td>: <input type="text" name="id_transaksi" value="<?=$mhs->id_transaksi?>" <disabled/></td></tr>
          <!-- <tr><td>NIM</td><td>: 
            <select name="nim">
              <?php if($user) {
                foreach ($user as $value) {
                  ?>      
                    <option value="<?=$value->nim; ?>"><?=$value->nim; ?></option>
                  <?php    }
              }?>
            </select>
          </td></tr>
          <tr><td>Judul Buku</td><td>: 
            <select name="kode_buku">
              <?php if($kode_buku) {
                foreach ($kode_buku as $value) {
                  ?>      
                    <option value="<?=$value->kode_buku; ?>"><?=$value->judul; ?></option>
                  <?php    }
              }?>
            </select>
          </td></tr> -->
          <tr><td>Status</td><td>: 
            <select name="status">
                <option value="sudah kembali">sudah kembali</option>
                <option value="belum kembali">belum kembali</option>
            </select>
          </td></tr>
          <tr><td>Petugas</td><td>: 
            <select name="operator">
              <?php if($operator) {
                foreach ($operator as $value) {
                  ?>      
                    <option value="<?=$value->id_user; ?>"><?=$value->nama; ?></option>
                  <?php    }
              }?>
            </select>
          </td></tr>
        <tr><td><button type="submit" name="simpan" class="btn btn-primary"><i class="icon-lock icon-white"></i>Ubah</button></td></tr>
      </table>
    </form>

    <?
    unset($mhs);
  }
  elseif (isset($page) and ($page == 'daftar_peminjaman')) { ?>
  <legend>Daftar peminjaman</legend>

  <table>
    <tr><form action="<?=base_url('peminjaman/daftar_peminjaman')?>" class="form-horizontal" method="post" >

      <td>
        <input type="text" name="cari" class="input-small" placeholder="Pencarian" data-placement="top" title="NIM">
        <button type="submit" name="simpan" class="btn btn-primary"><i class="icon-lock icon-white"></i>Cari</button>
      </td>
      <td>
        <a href="<?=base_url('peminjaman/daftar_peminjaman');?>">
          <button type="submit" name="daftardata" class="btn btn-primary"><i class="icon-lock icon-white"></i>Semua Data</button>
        </td>
      </tr>
    </table>
    <?php  
    if (!empty($cari)) {
      if ($jumlah>0) {
        echo "<div class='alert alert-success'> Ditemukan".$jumlah." data</div>";
      } else {            
        echo "<div class='alert alert-success'> Data idak Ditemukan</div>";
      }
    }
    ?>


    <table class="table table-bordered">
     <tr>
       <td width="10%"><center>ID Transaksi</center></td>
       <td width="10%"><center>Nama Peminjam</center></td>
       <td width="10%"><center>Judul Buku</center></td>
       <td width="10%"><center>Tanggal Pinjam</center></td>
       <td width="10%"><center>Tanggal Kembali</center></td>
       <td width="10%"><center>Status</center></td>
       <td width="10%"><center>Operator</center></td>
       <td width="10%"><center>Aksi</center></td>
     </tr>
     <? 
     foreach ($daftar_mhs as $r) {
      echo "<tr>
      <td>".$r->id_transaksi."</td>
      <td>".$r->nama."</td>
      <td>".$r->judul."</td>
      <td>".$r->tanggal_pinjam."</td>
      <td>".$r->tanggal_kembali."</td>
      <td>".$r->status."</td>
      <td>".$r->petugas."</td>
      <td><center><a href='".base_url('peminjaman/ubah_peminjaman/'.$r->id_transaksi)."'><i class='icon-edit'></i>Ubah</a></center></td>
      <td><center><a href='".base_url('peminjaman/hapus_peminjaman/'.$r->id_transaksi)."' onClick=\"return confirm('Apakah anda ingin menghapus data ini?')\"><i class='icon-remove'></i>Hapus</a></center></td>
      </tr>";
    }
    ?>
  </table>

</br>
<a href="<?=base_url('peminjaman/tambah_peminjaman');?>"><i class="icon-input"></i>Tambah peminjaman</a>

<?
unset($daftar_mhs, $r);
}
else  {//home?>
<legend>home</legend>
Hai <?=$this->session->userdata('nama')?>, selamat datang di peminjaman Perpustakaan menggunakan Codeigniter. <br><br>
<a href="<?=base_url('aplikasi/daftar_mahasiswa');?>"><i class="icon-hand-right">List Mahasiswa &nbsp;&nbsp;&nbsp;&nbsp;</i></a>
<a href="<?=base_url('user/daftar_user');?>"><i class="icon-hand-right">List Petugas &nbsp;&nbsp;&nbsp;&nbsp;</i></a>
<a href="<?=base_url('buku/daftar_buku');?>"><i class="icon-hand-right">List Buku &nbsp;&nbsp;&nbsp;&nbsp;</i></a>
<a href="<?=base_url('kategori/daftar_kategori');?>"><i class="icon-hand-right">List Kategori Buku &nbsp;&nbsp;&nbsp;&nbsp;</i></a>
<a href="<?=base_url('peminjaman/daftar_peminjaman');?>"><i class="icon-hand-right">Peminjaman &nbsp;&nbsp;&nbsp;&nbsp;</i></a>

<?
}
?>


<hr/>
<a href="<?=base_url('peminjaman');?>"><i class="icon-home">HOME</i></a> || <a href="<?=base_url('peminjaman/logout');?>" onClick="return confirm('yakin logout?')"><i class="icon-home">LOGOUT</i></a><br/>

<?
unset($page);

?>
</fieldset>
</div>    
</body>

<script src="<?=base_url("assets/js/jquery.min.js")?>"></script>
<script src="<?=base_url("assets/js/bootstrap.js")?>"></script>
</html>
<?php } ?>