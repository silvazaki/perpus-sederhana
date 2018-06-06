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

    <fieldset>
<?if (isset($page) and ($page == 'tambah_mahasiswa')) { ?>

      <legend>Tambah Mahasiswa</legend>
      <?=form_open('aplikasi/proses_tambah_mahasiswa','class="form-horizontal"')?>
      <table>
        <tr><td>NIM</td><td>: <input type="text" name="nim" class="input-small" placeholder="NIM" data-placement="top" title="NIM"></td></tr>
        <tr><td>Nama</td><td>: <input type="text" name="nama" class="input-small" placeholder="Nama" data-placement="top" title="Nama"></td></tr>
        <tr><td>Jenis Kelamin</td><td>: <input type="radio" name="jk" value="laki-Laki">Laki-Laki
        <input type="radio" name="jk" value="perempuan">Perempuan</td></tr>
        <tr><td>Alamat</td><td>: <input type="text" name="alamat" class="input-small" placeholder="Alamat" data-placement="top" title="Alamat"></td></tr>
        <tr><td>Asal Kota</td><td>: <input type="text" name="kota" class="input-small" placeholder="Kota" data-placement="top" title="Kota"></td></tr>
        <tr><td>Email</td><td>: <input type="text" name="email" class="input-small" placeholder="email" data-placement="top" title="Email"></td></tr>
        <tr><td><button type="submit" name="simpan" class="btn btn-primary"><i class="icon-lock icon-white"></i>Simpan</button></td></tr>
      </table>
      </form>
<?
}else if (isset($page) and ($page == 'ubah_mahasiswa')) { ?>
      <legend>Ubah Mahasiswa</legend>
      <?=form_open('aplikasi/proses_ubah_mahasiswa','class="form-horizontal"')?>
        <input type="hidden" name="nim" value="<?=$mhs->nim?>">
        <?php 
        // print_r($mhs);exit();
        $lk = "";
        $pr = "";
        if($mhs->jk == 'laki-laki'){
          $lk = 'checked="checked"';
        }else{
          $pr = 'checked="checked"'; 
        } ?>
        <table>
          <tr><td>NIM</td><td>: <input type="text" name="nim" value="<?=$mhs->nim?>" <disabled/></td></tr>
          <tr><td>Nama</td><td>: <input type="text" name="nama" value="<?=$mhs->nama?>" <disabled/></td></tr>
          <tr><td>Jenis Kelamin</td><td>: 
          <input type="radio" name="jk" value="laki-laki" <?=$lk; ?>>Laki-Laki
          <input type="radio" name="jk" value="perempuan" <?=$pr; ?>>Perempuan
          </td></tr>
          <tr><td>Alamat</td><td>: <input type="text" name="alamat" value="<?=$mhs->alamat?>" <disabled/></td></tr>
          <tr><td>Asal Kota</td><td>: <input type="text" name="kota" value="<?=$mhs->kota?>" <disabled/></td></tr>
          <tr><td>Email</td><td>: <input type="text" name="email" value="<?=$mhs->email?>" <disabled/></td></tr>
          <tr><td><button type="submit" name="simpan" class="btn btn-primary"><i class="icon-lock icon-white"></i>Ubah</button></td></tr>
        </table>
      </form>

<?
unset($mhs);
}
elseif (isset($page) and ($page == 'daftar_mahasiswa')) { ?>
 <legend>Daftar Mahasiswa</legend>

      <table>
      <tr><form action="<?=base_url('aplikasi/daftar_mahasiswa')?>" class="form-horizontal" method="post" >
      
        <td>
          <input type="text" name="cari" class="input-small" placeholder="Pencarian" data-placement="top" title="NIM">
          <button type="submit" name="simpan" class="btn btn-primary"><i class="icon-lock icon-white"></i>Cari</button>
        </td>
        <td>
          <a href="<?=base_url('aplikasi/daftar_mahasiswa');?>">
          <button type="submit" name="daftardata" class="btn btn-primary"><i class="icon-lock icon-white"></i>Semua Data</button>
        </td>
        <td>
          <a href="<?=base_url('EXCEL_data');?>">
          <button type="submit" name="daftardata" class="btn btn-primary"><i class="icon-lock icon-white"></i>Data Excel</button>
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
       <td width="10%"><center>NIM</center></td>
       <td width="10%"><center>Nama</center></td>
       <td width="10%"><center>Jenis Kelamin</center></td>
       <td width="10%"><center>Alamat</center></td>
       <td width="10%"><center>Asal Kota</center></td>
       <td width="10%"><center>Email</center></td>
       <td width="10%"><center>Aksi</center></td>
     </tr>
     <? 
      foreach ($daftar_mhs as $r) {
        echo "<tr>
     <td>".$r->nim."</td>
     <td>".$r->nama."</td>
     <td>".$r->jk."</td>
     <td>".$r->alamat."</td>
     <td>".$r->kota."</td>
     <td>".$r->email."</td>
     <td><center><a href='".base_url('aplikasi/ubah_mahasiswa/'.$r->nim)."'><i class='icon-edit'></i>Ubah</a></center></td>
     <td><center><a href='".base_url('aplikasi/hapus_mahasiswa/'.$r->nim)."' onClick=\"return confirm('Apakah anda ingin menghapus data ini?')\"><i class='icon-remove'></i>Hapus</a></center></td>
   </tr>";
      }
      ?>
   </table>
   
   </br>
   <a href="<?=base_url('aplikasi/tambah_mahasiswa');?>"><i class="icon-input"></i>Tambah Mahasiswa</a>

<?
unset($daftar_mhs, $r);
}
else  {//home?>
  <legend>home</legend>
  Hai <?=$this->session->userdata('nama')?>, selamat datang di Aplikasi Perpustakaan menggunakan Codeigniter. <br><br>
  <a href="<?=base_url('aplikasi/daftar_mahasiswa');?>"><i class="icon-hand-right">List Mahasiswa &nbsp;&nbsp;&nbsp;&nbsp;</i></a>
  <a href="<?=base_url('user/daftar_user');?>"><i class="icon-hand-right">List Petugas &nbsp;&nbsp;&nbsp;&nbsp;</i></a>
  <a href="<?=base_url('buku/daftar_buku');?>"><i class="icon-hand-right">List Buku &nbsp;&nbsp;&nbsp;&nbsp;</i></a>
  <a href="<?=base_url('kategori/daftar_kategori');?>"><i class="icon-hand-right">List Kategori Buku &nbsp;&nbsp;&nbsp;&nbsp;</i></a>
  <a href="<?=base_url('peminjaman/daftar_peminjaman');?>"><i class="icon-hand-right">Peminjaman &nbsp;&nbsp;&nbsp;&nbsp;</i></a>

  <?
    }
  ?>

  
  <hr/>
  <a href="<?=base_url('aplikasi');?>"><i class="icon-home">HOME</i></a> || <a href="<?=base_url('aplikasi/logout');?>" onClick="return confirm('yakin logout?')"><i class="icon-home">LOGOUT</i></a><br/>

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