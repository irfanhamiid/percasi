<?php include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Edit Data Kejurnas</h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>admin/kejurnas" class="btn btn-danger" ><i class="mdi mdi-close"></i> Batal</a>
    </p>
    <form name="fadm" method="post" action="<?= base_url();?>admin/kejurnas_edit" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <fieldset class="mb-3"><label>Nama Kejurnas</label>
					<input type="text" class="form-control" name="namakj" placeholder="Nama Kejurnas" autofocus
						data-validate="required" maxlength="20" value="<?= $DtKj['nama_kj'];?>">
                </fieldset>
				<div class="row mb-3">
					<fieldset class="col-sm-6"><label>Tanggal Mulai</label>
						<input type="date" class="form-control" name="tgla" data-validate="required" 
							value="<?= $DtKj['tgl_mulai'];?>">
					</fieldset>
					<fieldset class="col-sm-6"><label>Tanggal Selesai</label>
						<input type="date" class="form-control" name="tglb" data-validate="required" 
							value="<?= $DtKj['tgl_selesai'];?>">
					</fieldset>
					<fieldset class="col-sm-6"><label>Batas Pendaftaran</label>
						<input type="date" class="form-control" name="tglmax" data-validate="required" 
							value="<?= $DtKj['tgl_max_daftar'];?>">
					</fieldset>
					<fieldset class="col-sm-6"><label>Kas Awal</label>
						<input type="text" class="form-control" name="kasawal" data-validate="required,number" 
						maxlength="20" value="<?= $DtKj['kas_awal'];?>">
					</fieldset>
					<fieldset class="col-sm-6"><label>Besar Iuran Wajib</label>
						<input type="text" class="form-control" name="iuranwjb" data-validate="required,number"
							maxlength="10" placeholder="Besarnya iuran wajib provinsi"
							value="<?= $DtKj['iuran_wjb'];?>">
					</fieldset>		
				
					<fieldset class="col-sm-6"><label>Status</label>
						<select name="status" class="form-control">
							<option value="0" <?php if($DtKj['status_kj']==0) { echo 'selected="selected"'; }?>>Belum berjalan</option>
							<option value="1" <?php if($DtKj['status_kj']==1) { echo 'selected="selected"'; }?>>Sedang berjalan</option>
							<option value="2" <?php if($DtKj['status_kj']==2) { echo 'selected="selected"'; }?>>Sudah Selesai</option>
							<option value="3" <?php if($DtKj['status_kj']==3) { echo 'selected="selected"'; }?>>Dibatalkan</option>
						</select>
					</fieldset>
					<fieldset class="col-sm-6"><label>Upload Poster (format jpg)</label>
						<input type="file" class="form-control" name="poster" />
					</fieldset>	
					<fieldset class="col-sm-6"><label>Upload Proposal (format pdf)</label>
						<input type="file" class="form-control" name="proposal" />
					</fieldset>	
                </div>
				<input type="hidden" name="idkj" value="<?= $DtKj['id_kj'];?>"/>
                <p class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Simpan</button></p>
            </div>
        </div>
    </form>
  </div>
</div>

<?php include ('adm_akhir.php'); ?>