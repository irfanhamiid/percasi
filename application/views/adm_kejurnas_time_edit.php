<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Berjalan', 'Berjalan', 'Selesai', 'Gagal');
$cl=array('info', 'primary', 'success', 'danger');
include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Informasi Kejurnas <span class="text-info">Belum Berjalan</span></h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>adm/kejurnas" class="btn btn-danger" ><i class="mdi mdi-close"></i> Kembali</a>
    </p>
	<div class="row">
		<div class="col-sm-6">
			<h5>Kejurnas : <?= $DtKj['nama_kj'];?></h5>
			<p><a href="<?= base_url();?>img/poster/<?= $DtKj['id_kj'];?>.jpg" target="_blank"
				class="btn btn-success"><i class="mdi mdi-image"></i> Poster</a>
			   <a href="<?= base_url();?>pdf/kejurnas/<?= $DtKj['id_kj'];?>.pdf" target="_blank"
				class="btn btn-success"><i class="mdi mdi-file-pdf-box"></i> Proposal</a>		
			</p>
		</div>
		<div class="col-sm-6 text-end">
			<p>Tanggal Mulai : <b><?= $CI->Mymodel->tgldmy($DtKj['tgl_mulai']);?></b> sampai 
				<b><?= $CI->Mymodel->tgldmy($DtKj['tgl_selesai']);?></b></p>
			<p>Status : 
			<span class="badge bg-<?= $cl[$DtKj['status_kj']];?>"><?= $st[$DtKj['status_kj']];?></span></p>
			<p>Batas Pendaftaran : <b><?= $CI->Mymodel->tgldmy($DtKj['tgl_max_daftar']);?></b></p>
			
		</div>
	</div>
</div>
</div>  

<div class="card mb-5">   
  <div class="card-body">
	<ul class="nav nav-tabs tab-pills">
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/kejurnas_detail/<?= $DtKj['id_kj'];?>">Kategori</a>
	  </li>
	  
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/kejurnas_iuran/<?= $DtKj['id_kj'];?>">Pembayaran Iuran</a>
	  </li> 
	   <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/kejurnas_peserta/<?= $DtKj['id_kj'];?>">Peserta</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link active"  aria-current="page">Time Line</a>
	  </li>
	 
	</ul>
	
	<p class="mt-4"><b>Edit Time Line Kejurnas</p>
	<p class="text-end"><a href="<?= base_url();?>admin/kejurnas_time/<?= $DtKj['id_kj'];?>"
				class="btn btn-danger"><i class="mdi mdi-close"></i> Kembali</a></p>
	<form name="ftime" method="post" action="<?= base_url();?>admin/kejurnas_time_edit">
		<div class="row">
			<fieldset class="col-sm-3"><label>Tanggal</label>
				<input type="date" name="tgl" class="form-control" data-validate="required"
				value="<?= $DtTime['tanggal'];?>"/>
			</fieldset>	
			<fieldset class="col-sm-3"><label>Status</label>
				<select name="status" class="form-control">
					<option value="0" <?php if ($DtTime['status_kegiatan']==0) { echo 'selected="selected"'; }?>>Belum berjalan</option>
					<option value="1" <?php if ($DtTime['status_kegiatan']==1) { echo 'selected="selected"'; }?>>sedang berjalan</option>
					<option value="2" <?php if ($DtTime['status_kegiatan']==2) { echo 'selected="selected"'; }?>>Selesai</option>
					<option value="3" <?php if ($DtTime['status_kegiatan']==3) { echo 'selected="selected"'; }?>>Gagal</option>
				</select>
			</fieldset>
			<fieldset class="col-sm-6"><label>Kegiatan</label>
				<input type="text" name="kegiatan" class="form-control" maxlength="50" data-validate="required"
					value="<?= $DtTime['kegiatan'];?>"/>
			</fieldset>
			<fieldset class="col-sm-12"><label>Keterangan</label>
				<textarea name="catatan" class="form-control" data-validate="required"><?= stripslashes($DtTime['catatan']);?></textarea>
			</fieldset>
			
		</div>
		<p class="text-center mt-4">
			<button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> simpan</button>
		</p>
		<input type="hidden" name="idkj" value="<?= $DtKj['id_kj'];?>"/>
		<input type="hidden" name="idtime" value="<?= $DtTime['id_timeline'];?>"/>
	</form>
  </div>
</div>

<?php include ('adm_akhir.php'); ?>