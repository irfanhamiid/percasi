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
	
	
	<p class="mt-4"><b>Tambah Pengeluaran Kas Kejurnas</p>
	<p class="text-end"><a href="<?= base_url();?>admin/kejurnas_kaskeluar/<?= $DtKj['id_kj'];?>"
				class="btn btn-danger"><i class="mdi mdi-close"></i> Kembali</a></p>
	<form name="ftime" method="post" action="<?= base_url();?>admin/kejurnas_kaskeluar_new">
		<div class="row">
			<fieldset class="col-sm-3"><label>Tanggal</label>
				<input type="date" name="tgl" class="form-control" data-validate="required"/>
			</fieldset>	
			<fieldset class="col-sm-3"><label>No. Bukti</label>
				<input type="text" name="bukti" class="form-control" data-validate="required" maxlength="15"/>
			</fieldset>	
			<fieldset class="col-sm-6"><label>Jumlah</label>
				<input type="text" name="jumlah" class="form-control" maxlength="20" data-validate="required,number"/>
			</fieldset>
			<fieldset class="col-sm-12"><label>Keterangan</label>
				<textarea name="keterangan" class="form-control" data-validate="required"></textarea>
			</fieldset>
			
		</div>
		<p class="text-center mt-4">
			<button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> simpan</button>
		</p>
		<input type="hidden" name="idkj" value="<?= $DtKj['id_kj'];?>"/>
	</form>
  </div>
</div>

<?php include ('adm_akhir.php'); ?>