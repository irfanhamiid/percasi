<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Ubah Gelar Dalam Kejurnas</h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>admin/kejurnas_detail/<?= $DtKj['id_kj'];?>" class="btn btn-danger" ><i class="mdi mdi-close"></i> Batal</a>
    </p>
	<h5><?= $DtKj['nama_kj'];?></h5></div>
	
	<form name="fktgkj" method="post" action="<?= base_url();?>admin/kejurnas_glr_edit">
		<dic class="row">
			<div class="col-sm-6 offset-sm-3">
			<fieldset><label>Gelar</label>
				<input type="text" name="gelar" class="form-control" data-validate="required"
					maxlength="100" placeholder="Contoh : GM, IM, FM, Non Gelar" value="<?= $DtGelar['gelar'];?>"/>
			</fieldset>
			
			<fieldset><label>Biaya Registrasi</label>
				<input type="text" name="byy" class="form-control" data-validate="required,number"
					maxlength="10"  value="<?= $DtGelar['biaya_reg'];?>"/>
			</fieldset>
			<p class="text-center mt-4">
				<button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Smpan</button>
			</p>
			<input type="hidden" name="idkj" value="<?= $DtKj['id_kj'];?>"/>
			<input type="hidden" name="idgelar" value="<?= $DtGelar['id_gelar_kj'];?>"/>
		</div>
	</div>
  </div>
</div>

<?php include ('adm_akhir.php'); ?>