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
          <?if (isset($page) and ($page == 'tambah_user')) { ?>

          <legend>Tambah user</legend>
          <?=form_open('user/proses_tambah_user','class="form-horizontal"')?>
          <table>
            <tr><td>ID</td><td>: <input type="text" name="id_user" class="input-small" placeholder="ID User" data-placement="top" title="ID"></td></tr>
            <tr><td>Password</td><td>: <input type="text" name="password" class="input-small" placeholder="Password" data-placement="top" title="Password"></td></tr>
            <tr><td>Nama</td><td>: <input type="text" name="nama" class="input-small" placeholder="Nama" data-placement="top" title="Nama"></td></tr>
            <tr><td><button type="submit" name="simpan" class="btn btn-primary"><i class="icon-lock icon-white"></i>Simpan</button></td></tr>
          </table>
        </form>
        <?
      }else if (isset($page) and ($page == 'ubah_user')) { ?>
      <legend>Ubah User</legend>
      <?=form_open('user/proses_ubah_user','class="form-horizontal"')?>
      <input type="hidden" name="id_user" value="<?=$mhs->id_user?>">
      <table>
        <tr><td>ID User</td><td>: <input type="text" name="'id_user" value="<?=$mhs->id_user?>" <disabled/></td></tr>
        <tr><td>Password</td><td>: <input type="text" name="password" value="<?=$mhs->password?>" <disabled/></td></tr>
        <tr><td>Nama</td><td>: <input type="text" name="nama" value="<?=$mhs->nama?>" <disabled/></td></tr>
        <tr><td><button type="submit" name="simpan" class="btn btn-primary"><i class="icon-lock icon-white"></i>Ubah</button></td></tr>
      </table>
    </form>

    <?
    unset($mhs);
  }
  elseif (isset($page) and ($page == 'daftar_user')) { ?>
  <legend>Daftar user</legend>

  <table>
    <tr><form action="<?=base_url('user/daftar_user')?>" class="form-horizontal" method="post" >

      <td>
        <input type="text" name="cari" class="input-small" placeholder="Pencarian" data-placement="top" title="NIM">
        <button type="submit" name="simpan" class="btn btn-primary"><i class="icon-lock icon-white"></i>Cari</button>
      </td>
      <td>
        <a href="<?=base_url('user/daftar_user');?>">
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
          <td width="20%"><center>ID User</center></td>
          <td width="20%"><center>Password</center></td>
          <td width="20%"><center>Nama</center></td>
          <td width="30%"><center>Aksi</center></td>
        </tr>
        <? 
        foreach ($daftar_mhs as $r) {
          echo "<tr>
          <td>".$r->id_user."</td>
          <td>".$r->password."</td>
          <td>".$r->nama."</td>
          <td><center><a href='".base_url('user/ubah_user/'.$r->id_user)."'><i class='icon-edit'></i>Ubah</a></center></td>
          <td><center><a href='".base_url('user/hapus_user/'.$r->id_user)."' onClick=\"return confirm('Apakah anda ingin menghapus data ini?')\"><i class='icon-remove'></i>Hapus</a></center></td>
          </tr>";
        }
        ?>
      </table>

    </br>
    <a href="<?=base_url('user/tambah_user');?>"><i class="icon-input"></i>Tambah user</a>

    <?
    unset($daftar_mhs, $r);
  }
  else  {//home?>
  <legend>home</legend>
  Hai <?=$this->session->userdata('nama')?>, selamat datang di user Perpustakaan menggunakan Codeigniter. <br><br>
  <a href="<?=base_url('aplikasi/daftar_mahasiswa');?>"><i class="icon-hand-right">List Mahasiswa &nbsp;&nbsp;&nbsp;&nbsp;</i></a>
  <a href="<?=base_url('user/daftar_user');?>"><i class="icon-hand-right">List Petugas &nbsp;&nbsp;&nbsp;&nbsp;</i></a>
  <a href="<?=base_url('buku/daftar_buku');?>"><i class="icon-hand-right">List Buku &nbsp;&nbsp;&nbsp;&nbsp;</i></a>
  <a href="<?=base_url('kategori/daftar_kategori');?>"><i class="icon-hand-right">List Kategori Buku &nbsp;&nbsp;&nbsp;&nbsp;</i></a>
  <a href="<?=base_url('peminjaman/daftar_peminjaman');?>"><i class="icon-hand-right">Peminjaman &nbsp;&nbsp;&nbsp;&nbsp;</i></a>

  <?
  }
  ?>


  <hr/>
  <a href="<?=base_url('user');?>"><i class="icon-home">HOME</i></a> || <a href="<?=base_url('user/logout');?>" onClick="return confirm('yakin logout?')"><i class="icon-home">LOGOUT</i></a><br/>

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