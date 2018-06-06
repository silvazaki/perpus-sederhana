<!DOCTYPE html>
<html>
<head>
  <title>Login Perpustakaan</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?=base_url("assets/css/bootstrap.css")?>">
</head>
<body>
    <div class="container">
      <fieldset>
        <legend>Login</legend>
        <?php   if (isset($gagal)) 
        {
          echo ("<div class = 'alert alert-error'>
                <strong>".$gagal."</strong>
                </div>"
              );
          unset($gagal);
        }
        ?>
        <?php echo form_open('login/cek_login','class="form-inline"')
        ?>
          <input type="text" name="userid" class="input-small" placeholder="User ID" data-placement="top" title="Masukkan User ID Anda"><br>
          <input type="password" name="password" class="input-small" placeholder="Password" data-placement="top" title="Masukkan Password Anda"><br>
          <button type="submit" name="login" class="btn btn-primary" class="icon-lock icon-white">Login</button>
        </form>
      </fieldset>
    </div>    

  <script src="<?=base_url("assets/js/jquery.min.js")?>"></script>
  <script src="<?=base_url("assets/js/bootstrap.js")?>"></script>

</body>
</html>