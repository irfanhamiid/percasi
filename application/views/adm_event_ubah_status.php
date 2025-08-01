<?php include ('adm_awal.php'); 
?>
<h5 class="py-3 mb-4">Ubah Status Event</h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>admin/event_detail/<?= $DtEvent['id_ev'];?>" class="btn btn-warning" >
			<i class="mdi mdi-close"></i> Kembali</a>
    </p>
    <form name="fprov" method="post" action="<?= base_url();?>admin/event_ubah_status">
        <div class="row">
           
			<fieldset class="col-sm-4 offset-sm-4"><label>Status Event</label>
				<select name="status" class="form-control">
					<option value="0" <?php if ($DtEvent['status_ev']==0) { echo 'selected="selected"'; }?>>Belum Mulai</option>
					<option value="1" <?php if ($DtEvent['status_ev']==1) { echo 'selected="selected"'; }?>>Berjalan</option>
					<option value="2" <?php if ($DtEvent['status_ev']==2) { echo 'selected="selected"'; }?>>Selesai</option>
				</select>
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