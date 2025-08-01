<?php include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Tambah Events Baru</h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
	
        <a href="<?= base_url();?>admin/events/0" class="btn btn-danger" > <i class="mdi mdi-close"></i> Kembali</a>
    </p>
    <form name="fevent" method="post" action="<?= base_url();?>admin/event_new" enctype="multipart/form-data" >
        <div class="row">
            <fieldset class="col-sm-6"><label>Nama Event</label>
				<input type="text" class="form-control myinput-required" name="namaevent" placeholder="Nama event" 
					data-validate="required" maxlength="30">
			</fieldset>
			<fieldset class="col-sm-3"><label>Tanggal Event Dimulai</label>
				<input type="date" name="tglevnta" class="form-control myinput-required" data-validate="required">
			</fieldset>
			<fieldset class="col-sm-3"><label>Tanggal Event Berakhir</label>
				<input type="date" name="tglevntb" class="form-control myinput-required" data-validate="required">
			</fieldset>
			<fieldset class="col-sm-3"><label>Tanggal Batas Pendaftaran Event</label>
				<input type="date" name="tglevntend" class="form-control myinput-required" data-validate="required">
			</fieldset>
			<fieldset class="col-sm-3"><label>Iuran Wajib <span class="text-danger">(isi nol jika tidak ada)</span></label>
				<input type="text" name="iuranwjb" class="form-control myinput-required" data-validate="required,number">
			</fieldset>
		</div>
		<div class="row">
			<fieldset class="col-sm-6"><label>Upload Poster (format jpg/png)</label>
				<input type="file" class="form-control" name="poster" accept=".jpg,.jpeg,.png"/>
			</fieldset>	
			<fieldset class="col-sm-6"><label>Upload Proposal (format pdf)</label>
				<input type="file" class="form-control" name="proposal" accept="application/pdf"/>
			</fieldset>
		</div>
		<p class="text-center mt-4">
			<a href="<?= base_url();?>admin/events/0" class="btn btn-danger" > <i class="mdi mdi-close"></i> Batal</a>
			<button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Simpan</button></p>           
    </form>  
  </div>
</div>

<?php include ('adm_akhir.php'); ?>