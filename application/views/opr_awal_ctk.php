<!DOCTYPE html>
<html lang="id">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title><?= $INSTANSI['nama_instansi'];?> | Operator</title>

    
    <meta name="description" content="Aplikasi admin <?= $INSTANSI['nama_instansi'];?>" />
    
    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url();?>cssjs_all/bootstrap.min.css"  />
	<style>
		.bg-light { background-color: #ece8e8 !important; }
	</style>	
</head>

<body>
  <div class="container-fluid">
	<table class="table table-borderless">
		<tr><td width="80"><img src="<?= base_url();?>img/percasi.png" width="70"/></td>
			<td><p><b><?= $INSTANSI['nama_instansi'];?></p></td>
		</tr>
	</table>	
  </div>	