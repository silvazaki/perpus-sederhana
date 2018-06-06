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
        <?if (isset($page) and ($page == 'tambah_buku')) { ?>

        <legend>Tambah buku</legend>
        <?=form_open('buku/proses_tambah_buku','class="form-horizontal"')?>
        <table>
          <tr><td>Kode Buku</td><td>: <input type="text" name="kode_buku" class="input-small" placeholder="Kode Buku" data-placement="top" title="Kode Buku"></td></tr>
          <tr><td>Judul Buku</td><td>: <input type="text" name="judul" class="input-small" placeholder="Judul Buku" data-placement="top" title="Judul"></td></tr>
          <tr><td>Pengarang</td><td>: <input type="text" name="pengarang" class="input-small" placeholder="Pengarang" data-placement="top" title="Pengarang"></td></tr>
          <tr><td>Penerbit</td><td>: <input type="text" name="penerbit" class="input-small" placeholder="Penerbit" data-placement="top" title="Penerbit"></td></tr>
          <tr><td>Kategori</td><td>: 
            <select name="id_kategori">
              <?php if($kategori) {
                foreach ($kategori as $value) {
                  ?>      
                  <option value="<?=$value->id_kategori; ?>"><?=$value->kategori; ?></option>
                  <?php    }
                }?>
                
              </select>
            </td></tr>
            <tr><td><button type="submit" name="simpan" class="btn btn-primary"><i class="icon-lock icon-white"></i>Simpan</button></td></tr>
          </table>
        </form>
        <?
      }else if (isset($page) and ($page == 'ubah_buku')) { ?>
      <legend>Ubah buku</legend>
      <?=form_open('buku/proses_ubah_buku','class="form-horizontal"')?>
      <input type="hidden" name="nim" value="<?=$mhs->kode_buku?>">
      <table>
        <tr><td>Kode Buku</td><td>: <input type="text" name="kode_buku" value="<?=$mhs->kode_buku?>" <disabled/></td></tr>
        <tr><td>Judul Buku</td><td>: <input type="text" name="judul" value="<?=$mhs->judul?>" <disabled/></td></tr>
        <tr><td>Pengarang</td><td>: <input type="text" name="pengarang" value="<?=$mhs->pengarang?>" <disabled/></td></tr>
        <tr><td>Penerbit</td><td>: <input type="text" name="penerbit" value="<?=$mhs->penerbit?>" <disabled/></td></tr>
        <tr><td>Kategori</td><td>: 
          <select name="id_kategori">
            <?php if($kategori) {
              foreach ($kategori as $value) {
                ?>      
                <option value="<?=$value->id_kategori; ?>"><?=$value->kategori; ?></option>
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
    elseif (isset($page) and ($page == 'daftar_buku')) { ?>
    <legend>Daftar buku</legend>

    <table>
      <tr><form action="<?=base_url('buku/daftar_buku')?>" class="form-horizontal" method="post" >

        <td>
          <input type="text" name="cari" class="input-small" placeholder="Pencarian" data-placement="top" title="kode buku">
          <button type="submit" name="simpan" class="btn btn-primary"><i class="icon-lock icon-white"></i>Cari</button>
        </td>
        <td>
          <a href="<?=base_url('buku/daftar_buku');?>">
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
         <td width="20%"><center>Kode Buku</center></td>
         <td width="20%"><center>Judul Buku</center></td>
         <td width="20%"><center>Pengarang</center></td>
         <td width="20%"><center>Penerbit</center></td>
         <td width="20%"><center>Kategori</center></td>
         <td width="20%"><center>Aksi</center></td>
       </tr>
       <? 
       foreach ($daftar_mhs as $r) {
        echo "<tr>
        <td>".$r->kode_buku."</td>
        <td>".$r->judul."</td>
        <td>".$r->pengarang."</td>
        <td>".$r->penerbit."</td>
        <td>".$r->kategori."</td>
        <td><center><a href='".base_url('buku/ubah_buku/'.$r->kode_buku)."'><i class='icon-edit'></i>Ubah</a></center></td>
        <td><center><a href='".base_url('buku/hapus_buku/'.$r->kode_buku)."' onClick=\"return confirm('Apakah anda ingin menghapus data ini?')\"><i class='icon-remove'></i>Hapus</a></center></td>
        </tr>";
      }
      ?>
    </table>

  </br>
  <a href="<?=base_url('buku/tambah_buku');?>"><i class="icon-input"></i>Tambah buku</a>

  <?
  unset($daftar_mhs, $r);
}
else  {//home?>
<legend>home</legend>
Hai <?=$this->session->userdata('nama')?>, selamat datang di buku Perpustakaan menggunakan Codeigniter. <br><br>
<a href="<?=base_url('aplikasi/daftar_mahasiswa');?>"><i class="icon-hand-right">List Mahasiswa &nbsp;&nbsp;&nbsp;&nbsp;</i></a>
<a href="<?=base_url('user/daftar_user');?>"><i class="icon-hand-right">List Petugas &nbsp;&nbsp;&nbsp;&nbsp;</i></a>
<a href="<?=base_url('buku/daftar_buku');?>"><i class="icon-hand-right">List Buku &nbsp;&nbsp;&nbsp;&nbsp;</i></a>
<a href="<?=base_url('kategori/daftar_kategori');?>"><i class="icon-hand-right">List Kategori Buku &nbsp;&nbsp;&nbsp;&nbsp;</i></a>
<a href="<?=base_url('peminjaman/daftar_peminjaman');?>"><i class="icon-hand-right">Peminjaman &nbsp;&nbsp;&nbsp;&nbsp;</i></a>

<?
}
?>


<hr/>
<a href="<?=base_url('buku');?>"><i class="icon-home">HOME</i></a> || <a href="<?=base_url('buku/logout');?>" onClick="return confirm('yakin logout?')"><i class="icon-home">LOGOUT</i></a><br/>

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