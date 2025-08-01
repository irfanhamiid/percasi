<?php include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Tambah Data Kejurnas</h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>admin/kejurnas" class="btn btn-danger" > <i class="mdi mdi-close"></i> Batal</a>
    </p>
    <form name="fadm" method="post" action="<?= base_url();?>admin/kejurnas_new" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <fieldset class="mb-3"><label>Nama Kejurnas</label>
					<input type="text" class="form-control" name="namakj" placeholder="Nama Kejurnas" autofocus
						data-validate="required" maxlength="20">
                </fieldset>
				<div class="row mb-3">
					<fieldset class="col-sm-6"><label>Tanggal Mulai</label>
						<input type="date" class="form-control" name="tgla" data-validate="required" >
					</fieldset>
					<fieldset class="col-sm-6"><label>Tanggal Selesai</label>
						<input type="date" class="form-control" name="tglb" data-validate="required" >
					</fieldset>
					<fieldset class="col-sm-6"><label>Batas Pendaftaran</label>
						<input type="date" class="form-control" name="tglmax" data-validate="required" >
					</fieldset>
					<fieldset class="col-sm-6"><label>Kas Awal</label>
						<input type="text" class="form-control" name="kasawal" data-validate="required,number" 
						maxlength="20">
					</fieldset>
					<fieldset class="col-sm-6"><label>Besar Iuran Wajib</label>
						<input type="text" class="form-control" name="iuranwjb" data-validate="required,number"
							maxlength="10" placeholder="Besarnya iuran wajib provinsi">
					</fieldset>		
				
					<fieldset class="col-sm-6"><label>Status</label>
						<select name="status" class="form-control">
							<option value="0">Belum berjalan</option>
							<option value="1">Sedang berjalan</option>
							<option value="2">Sudah Selesai</option>
							<option value="3">Dibatalkan</option>
						</select>
					</fieldset>
					<fieldset class="col-sm-6"><label>Upload Poster (format jpg)</label>
						<input type="file" class="form-control" name="poster" />
					</fieldset>	
					<fieldset class="col-sm-6"><label>Upload Proposal (format pdf)</label>
						<input type="file" class="form-control" name="proposal" />
					</fieldset>	
                </div>
                <p class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Simpan</button></p>
            </div>
        </div>
    </form>
  </div>
</div>

<?php include ('adm_akhir.php'); ?>