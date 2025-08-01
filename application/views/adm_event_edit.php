<?php include ('adm_awal.php'); 
?>
<h5 class="py-3 mb-4">Edit Data Event</h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>admin/event_detail/<?= $DtEvent['id_ev'];?>" class="btn btn-warning" >
			<i class="mdi mdi-close"></i> Kembali</a>
    </p>
    <form name="fprov" method="post" action="<?= base_url();?>admin/event_edit" enctype="multipart/form-data">
        <div class="row">
            <fieldset class="col-sm-6"><label>Nama Event</label>
				<input type="text" class="form-control myinput-required" name="namaevent" placeholder="Nama event" 
					data-validate="required" maxlength="30" value="<?= $DtEvent['nama_ev'];?>">
			</fieldset>
			<fieldset class="col-sm-3"><label>Tanggal Event Dimulai</label>
				<input type="date" name="tglevnta" class="form-control myinput-required" data-validate="required"
					 value="<?= $DtEvent['tgl_mulai_ev'];?>">
			</fieldset>
			<fieldset class="col-sm-3"><label>Tanggal Event Berakhir</label>
				<input type="date" name="tglevntb" class="form-control myinput-required" data-validate="required"
					 value="<?= $DtEvent['tgl_selesai_ev'];?>">
			</fieldset>
			<fieldset class="col-sm-3"><label>Tanggal Batas Pendaftaran Event</label>
				<input type="date" name="tglevntend" class="form-control myinput-required" data-validate="required"
					 value="<?= $DtEvent['tgl_bts_daftar'];?>">
			</fieldset>
			<fieldset class="col-sm-3"><label>Iuran Wajib <span class="text-danger">(isi nol jika tidak ada)</span></label>
				<input type="text" name="iuranwjb" class="form-control myinput-required" data-validate="required,number"
					 value="<?= $DtEvent['iuran_wjb'];?>">
			</fieldset>
			<fieldset class="col-sm-3"><label>Status Event</label>
				<select name="status" class="form-control">
					<option value="0" <?php if ($DtEvent['status_ev']==0) { echo 'selected="selected"'; }?>>Belum Mulai</option>
					<option value="1" <?php if ($DtEvent['status_ev']==1) { echo 'selected="selected"'; }?>>Berjalan</option>
					<option value="2" <?php if ($DtEvent['status_ev']==2) { echo 'selected="selected"'; }?>>Selesai</option>
				</select>
			</fieldset>
		</div>
		<div class="row">
			<fieldset class="col-sm-6"><label>Upload Poster (format jpg/png)</label>
				<input type="file" class="form-control" name="poster" accept=".jpg,.png,.jpeg"/>
			</fieldset>	
			<fieldset class="col-sm-6"><label>Upload Proposal (format pdf)</label>
				<input type="file" class="form-control" name="proposal" accept="application/pdf"/>
			</fieldset>
		</div>
		<input type="hidden" name="idev" value="<?= $DtEvent['id_ev'];?>">
		<p class="text-center">
			<a href="<?= base_url();?>admin/event_detail/<?= $DtEvent['id_ev'];?>" class="btn btn-danger" > <i class="mdi mdi-close"></i> Batal</a>
			<button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Simpan</button></p>
           
    </form>  
  </div>
</div>

<?php include ('adm_akhir.php'); ?>