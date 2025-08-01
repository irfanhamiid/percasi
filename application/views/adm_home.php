<?php include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Beranda</h5>

<div class="card mb-5">   
  <div class="card-body">
    <div class="row">
      <div class="col-sm-5 text-end">
        <img src="<?= base_url();?>img/percasi.png" height="100"/>
      </div>
      <div class="col-sm-6">
        <h4><?= $INSTANSI['nama_instansi'];?></h4>
        <p><?= $INSTANSI['alamat'];?><br/>
          <i class="mdi mdi-phone"></i> <?= $INSTANSI['telepon'];?> | <i class="mdi mdi-email"></i>
          <?= $INSTANSI['email'];?>
        </p>
      </div>
    </div>
    <hr/>
    <h5 class="text-center">Selamat datang kembali <span class="text-info"><?= $_SESSION['NM_ADMIN'];?></span></h5>  
    <p class="text-center">Aplikasi Manajemen Event PB Percasi</p>
  </div>
</div>

<?php include ('adm_akhir.php'); ?>