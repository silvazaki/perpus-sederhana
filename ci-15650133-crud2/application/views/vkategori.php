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
        <?if (isset($page) and ($page == 'tambah_kategori')) { ?>

        <legend>Tambah kategori</legend>
        <?=form_open('kategori/proses_tambah_kategori','class="form-horizontal"')?>
        <table>
          <tr><td>ID Kategori</td><td>: <input type="text" name="id" class="input-small" placeholder="ID Kategori" data-placement="top" title="ID Kategori"></td></tr>
          <tr><td>Kategori</td><td>: <input type="text" name="kategori" class="input-small" placeholder="Kategori" data-placement="top" title="Kategori"></td></tr>
            <tr><td><button type="submit" name="simpan" class="btn btn-primary"><i class="icon-lock icon-white"></i>Simpan</button></td></tr>
          </table>
        </form>
        <?
      }else if (isset($page) and ($page == 'ubah_kategori')) { ?>

      <legend>Ubah kategori</legend>
      <?=form_open('kategori/proses_ubah_kategori','class="form-horizontal"')?>
      <input type="hidden" name="id" value="<?=$mhs->id_kategori?>">
      <table>
        <tr><td>ID Kategori</td><td>: <input type="text" name="id" value="<?=$mhs->id_kategori?>" <disabled/></td></tr>
        <tr><td>Kategori</td><td>: <input type="text" name="kategori" value="<?=$mhs->kategori?>" <disabled/></td></tr>
        <tr><td><button type="submit" name="simpan" class="btn btn-primary"><i class="icon-lock icon-white"></i>Ubah</button></td></tr>
      </table>
    </form>

    <?
    unset($mhs);
  }
  elseif (isset($page) and ($page == 'daftar_kategori')) { ?>
  <legend>Daftar kategori</legend>

  <table>
    <tr><form action="<?=base_url('kategori/daftar_kategori')?>" class="form-horizontal" method="post" >

      <td>
        <input type="text" name="cari" class="input-small" placeholder="Pencarian" data-placement="top" title="NIM">
        <button type="submit" name="simpan" class="btn btn-primary"><i class="icon-lock icon-white"></i>Cari</button>
      </td>
      <td>
        <a href="<?=base_url('kategori/daftar_kategori');?>">
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
         <td width="10%"><center>ID Kategori</center></td>
         <td width="10%"><center>Kategori</center></td>
         <td width="10%"><center>Aksi</center></td>
       </tr>
       <? 
       foreach ($daftar_mhs as $r) {
        echo "<tr>
        <td>".$r->id_kategori."</td>
        <td>".$r->kategori."</td>
        <td><center><a href='".base_url('kategori/ubah_kategori/'.$r->id_kategori)."'><i class='icon-edit'></i>Ubah</a></center></td>
        <td><center><a href='".base_url('kategori/hapus_kategori/'.$r->id_kategori)."' onClick=\"return confirm('Apakah anda ingin menghapus data ini?')\"><i class='icon-remove'></i>Hapus</a></center></td>
        </tr>";
      }
      ?>
    </table>

  </br>
  <a href="<?=base_url('kategori/tambah_kategori');?>"><i class="icon-input"></i>Tambah kategori</a>

  <?
  unset($daftar_mhs, $r);
}
else  {//home?>
<legend>home</legend>
Hai <?=$this->session->userdata('nama')?>, selamat datang di kategori Perpustakaan menggunakan Codeigniter. <br><br>
  <a href="<?=base_url('aplikasi/daftar_mahasiswa');?>"><i class="icon-hand-right">List Mahasiswa &nbsp;&nbsp;&nbsp;&nbsp;</i></a>
  <a href="<?=base_url('user/daftar_user');?>"><i class="icon-hand-right">List Petugas &nbsp;&nbsp;&nbsp;&nbsp;</i></a>
  <a href="<?=base_url('buku/daftar_buku');?>"><i class="icon-hand-right">List Buku &nbsp;&nbsp;&nbsp;&nbsp;</i></a>
  <a href="<?=base_url('kategori/daftar_kategori');?>"><i class="icon-hand-right">List Kategori Buku &nbsp;&nbsp;&nbsp;&nbsp;</i></a>
  <a href="<?=base_url('peminjaman/daftar_peminjaman');?>"><i class="icon-hand-right">Peminjaman &nbsp;&nbsp;&nbsp;&nbsp;</i></a>

<?
}
?>


<hr/>
<a href="<?=base_url('kategori');?>"><i class="icon-home">HOME</i></a> || <a href="<?=base_url('kategori/logout');?>" onClick="return confirm('yakin logout?')"><i class="icon-home">LOGOUT</i></a><br/>

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