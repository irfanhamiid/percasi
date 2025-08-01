<?php
$CI =& get_instance();
$CI->load->model('Mymodel');


include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4"><span class="text-muted">Edit Gelar Pada Events</span> <?= $DtEvent['nama_ev'];?></h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">		
		<a href="<?= base_url();?>admin/event_detail/<?= $DtEvent['id_ev'];?>" class="btn btn-danger btn-sm" > <i class="mdi mdi-close"></i> Kembali</a>		
    </p>
	<hr/>
	<?php include('adm_event_info.php'); ?>
  </div>
</div>

<div class="card mb-5">   
  <div class="card-body">  
	<ul class="nav nav-tabs">
	  <li class="nav-item">
		<a class="nav-link active" aria-current="page" href="#"><b>Kategori dan Gelar</b></a>		
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_iuran/<?= $DtEvent['id_ev'];?>">Penerimaan Iuran/Registrasi</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_penlain/<?= $DtEvent['id_ev'];?>">Penerimaan Lain</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_kaskeluar/<?= $DtEvent['id_ev'];?>">Pengeluaran Kas</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_keuangan/<?= $DtEvent['id_ev'];?>">Keuangan</a>
	  </li> 
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_peserta/<?= $DtEvent['id_ev'];?>">Peserta</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_time/<?= $DtEvent['id_ev'];?>">Time Line</a>
	  </li>
	</ul>
	
	<h5 class="mt-4">Tambah Gelar</h5>
	
	<form name="fktgkj" method="post" action="<?= base_url();?>admin/event_gelar_edit">
		<div class="row">
			<div class="col-sm-6 offset-sm-3">
				<fieldset><label>Gelar</label>
					<input type="text" name="gelar" class="form-control myinput-required" data-validate="required"
						maxlength="100" placeholder="Contoh : GM/GWM" value="<?= $DtGelar['gelar'];?>"/>
				</fieldset>
				<fieldset><label>Biaya Registrasi</label>
					<input type="text" name="biaya" class="form-control myinput-required" data-validate="required,number"
						maxlength="10" placeholder="Biaya registrasi"  value="<?= $DtGelar['biaya_reg'];?>"/>
				</fieldset>
				<p class="text-center mt-4">
					<a href="<?= base_url();?>admin/event_detail/<?= $DtGelar['id_ev'];?>" class="btn btn-danger btn-sm" > <i class="mdi mdi-close"></i> Batal</a>	
					<button type="submit" class="btn btn-primary btn-sm"><i class="mdi mdi-check"></i> Smpan</button>
				</p>
				<input type="hidden" name="idev" value="<?= $DtGelar['id_ev'];?>"/>
				<input type="hidden" name="idglr" value="<?= $DtGelar['id_gelar_ev'];?>"/>
			</div>
		</div>
	</form>
  </div>
</div>

<?php include ('adm_akhir.php'); ?>