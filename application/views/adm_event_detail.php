<?php include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Detail Event</h5>
<?php
$LinkBack=array('next', 'run', 'done');
$statusev=array('Belum dimulai', 'Sedang berjalan', 'Sudah selesai');
$statusclr=array('secondary', 'info', 'success');
?>
<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EventEditModal" 
			data-bs-idev="<?= $DtEvent['id_ev'];?>" data-bs-namaev="<?= $DtEvent['nama_ev'];?>"
			data-bs-tglev="<?= $DtEvent['tgl_ev'];?>" data-bs-jamev="<?= $DtEvent['jam_ev'];?>"
			data-bs-statev="<?= $DtEvent['status_ev'];?>"
			data-bs-deskripsi="<?= $DtEvent['deskripsi'];?>"
			><i class="mdi mdi-pencil"></i> Edit Event</button>
		
		<a href="<?= base_url();?>admin/event_edit/<?= $DtEvent['id_ev'];?>" class="btn btn-info btn-sm" > <i class="mdi mdi-pencil"></i> Edit</a>
		<a href="<?= base_url();?>admin/event_del/<?= $DtEvent['id_ev'];?>" class="btn btn-warning btn-sm" > <i class="mdi mdi-trash-can-outline"></i> Hapus</a>
        <a href="<?= base_url();?>admin/event_<?= $LinkBack[$DtEvent['status_ev']];?>" class="btn btn-danger btn-sm" > <i class="mdi mdi-close"></i> Kembali</a>
		
    </p>
	<hr/>
	<div class="row mb-4">
		<div class="col-sm-8">
			<h6>Event :</h6> <p><?= $DtEvent['nama_ev'];?></p>
			<h6>Pelaksanaan : </h6> <p><?= $DtEvent['tgl_ev'];?>, <?= $DtEvent['jam_ev'];?></p>
		</div>	
		<div class="col-sm-4 text-end">
			<p><div class="badge bg-primary"><?= $DtEvent['id_ev'];?></div></p>
			<p><div class="badge bg-<?= $statusclr[$DtEvent['status_ev']];?>"><?= $statusev[$DtEvent['status_ev']];?></div></p>
		</div>	
	</div>
	<h6>Keterangan</h6>
	<p><?= $DtEvent['deskripsi'];?></p>
	
	<h6 class="mt-4 p-2 bg-dark text-white">Lampiran</h6>
	<p class="text-end">
        <a href="<?= base_url();?>admin/event_peserta_new/<?= $DtEvent['id_ev'];?>" class="btn btn-primary btn-xs" > 
			<i class="mdi mdi-plus"></i> Lampiran</a>
    </p>
	
	<h6 class="mt-4 p-2 bg-dark text-white">Lokasi Event</h6>
	<p class="text-end">
        <a href="<?= base_url();?>admin/event_lokasi_new/<?= $DtEvent['id_ev'];?>" class="btn btn-primary btn-xs" > 
			<i class="mdi mdi-plus"></i> Lokasi</a>
    </p>
	
	<?php
	if ($JmlLokasi==0)
	{
		echo '<div class="alert alert-danger">Belum ada data lokasi event...</div>';
	}
	else
	{
		echo '<ol>';
		foreach($DtLokasi as $l)
		{
			echo '<li>'.$l->lokasi.'</li>';
		}
		echo '</ol>';
	}
	?>
	<h6 class="mt-4 p-2 bg-dark text-white">Kategori</h6>
	<p class="text-end">
        <a href="<?= base_url();?>admin/event_kategori_new/<?= $DtEvent['id_ev'];?>" class="btn btn-primary btn-xs" > 
			<i class="mdi mdi-plus"></i> Kategori</a>
    </p>
	<?php
	if ($JmlKtg==0)
	{
		echo '<div class="alert alert-danger">Belum ada data kategori ...</div>';
	}
	else
	{
		echo '<uo>';
		foreach($DtKtg as $l)
		{
			echo '<li>'.$l->kategori.'</li>';
		}
		echo '</ol>';
	}
	?>
	
	<h6 class="mt-4 p-2 bg-dark text-white">Peserta</h6>
	<p class="text-end">
        <a href="<?= base_url();?>admin/event_peserta_new/<?= $DtEvent['id_ev'];?>" class="btn btn-primary btn-xs" > 
			<i class="mdi mdi-plus"></i> Peserta</a>
    </p>
  </div>
</div>

<!-- MODAL EDIT EVENT-->
<div class="modal fade" id="EventEditModal" tabindex="-1" aria-labelledby="EventEditModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="EventEditModalLabel">New message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  <form>
		  <div class="modal-body">
			<fieldset class="mb-3"><label>Nama Event</label>
				<input type="text" name="namaev" class="form-control myinput-requred" id="mdl_edit_nama_event">
			</fieldset>
			<div class="row mb-3">
				<fieldset class="col-sm-4"><label>Tgl Mulau</label>
					<input type="date" name="tglmulai" class="form-control myinput-requred" id="mdl_edit_tgl_event">
				</fieldset>
				<fieldset class="col-sm-4"><label>Jam Mulau</label>
					<input type="text" name="tglmulai" class="form-control myinput-requred" id="mdl_edit_jam_event">
				</fieldset>
				<fieldset class="col-sm-4"><label>Status Event</label>
					<select name="stevnt" class="form-control" id="mdl_edit_st_event">
						<option value="0" <?php if ($DtEvent['status_ev']==0) { echo 'selected="selected"'; }?>>Belum Mulai</option>
						<option value="1" <?php if ($DtEvent['status_ev']==1) { echo 'selected="selected"'; }?>>Berjalan</option>
						<option value="2" <?php if ($DtEvent['status_ev']==2) { echo 'selected="selected"'; }?>>Selesai</option>
					</select>
				</fieldset>
			  </div>
			  <div class="mb-3">
				<label for="message-text" class="col-form-label">Keterangan</label>
				<textarea class="form-control" id="mdl_edit_deskripsi"></textarea>
			  </div>
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal"><i class="mdi mdi-close"></i> Batal</button>
			<button type="button" class="btn btn-primary btn-sm"><i class="mdi mdi-check"></i> Simpan</button>
		  </div>
	  </form>
    </div>
  </div>
</div>

<script>
	const EventEditModal = document.getElementById('EventEditModal')
	EventEditModal.addEventListener('show.bs.modal', event => {
	  const button = event.relatedTarget
	  const namaev = button.getAttribute('data-bs-namaev')
	  const tglev = button.getAttribute('data-bs-tglev')
	  const jamev = button.getAttribute('data-bs-jamev')
	  const statev = button.getAttribute('data-bs-statev')
	  const deskripsi = button.getAttribute('data-bs-deskripsi')
	  
	  const modalNamaEv = EventEditModal.querySelector('#mdl_edit_nama_event')
	  
	  modalNamaEv.value = namaev
	})
</script>
<?php include ('adm_akhir.php'); ?>