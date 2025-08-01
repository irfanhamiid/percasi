<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4"><span class="text-muted">Time Line </span> <?= $DtEvent['nama_ev'];?></h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>adm/event_time/<?= $DtEvent['id_ev'];?>" class="btn btn-danger" ><i class="mdi mdi-close"></i> Kembali</a>
    </p>
	<?php include('adm_event_info.php'); ?>
</div>
</div>  

<div class="card mb-5">   
  <div class="card-body">
	<ul class="nav nav-tabs tab-pills">
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_detail/<?= $DtEvent['id_ev'];?>">Kategori dan Gelar</a>		
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_peserta/<?= $DtEvent['id_ev'];?>">Peserta</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link active" aria-current="page" ><b>Time Line</b></a>
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
	 
	</ul>
	
	<p class="mt-4"><b>Edit Time Line Events</p>
	
	<form name="ftime" method="post" action="<?= base_url();?>admin/event_time_edit">
		<div class="row">
			<fieldset class="col-sm-3"><label>Tanggal</label>
				<input type="date" name="tgl" class="form-control" data-validate="required"
					value="<?= $DtTime['tanggal'];?>"/>
			</fieldset>	
			
			<fieldset class="col-sm-3"><label>Status</label>
				<select name="publik" class="form-control">
					<option value="0" <?php if ($DtTime['publik']==0) { echo 'selected="selected"'; }?>>Hanya admin bisa melihat</option>
					<option value="1" <?php if ($DtTime['publik']==1) { echo 'selected="selected"'; }?>>Semua bisa melihat</option>
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
			<a href="<?= base_url();?>admin/event_time/<?= $DtEvent['id_ev'];?>"
				class="btn btn-danger"><i class="mdi mdi-close"></i> Batal</a>
			<button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Simpan</button>
		</p>
		<input type="hidden" name="idev" value="<?= $DtEvent['id_ev'];?>"/>
		<input type="hidden" name="idtime" value="<?= $DtTime['id_timeline'];?>"/>
	</form>
  </div>
</div>

<?php include ('adm_akhir.php'); ?>