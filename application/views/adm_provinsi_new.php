<?php include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Tambah Data Provinsi</h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>admin/provinsi" class="btn btn-danger" > <i class="mdi mdi-close"></i> Batal</a>
    </p>
    <form name="fprov" method="post" action="<?= base_url();?>admin/provinsi_new" >
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <fieldset class="mb-3"><label>Nama Provinsi</label>
					<input type="text" class="form-control" name="provinsi" placeholder="Nama provinsi" autofocus
						data-validate="required" maxlength="30">
                </fieldset>
				
                <p class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Simpan</button></p>
            </div>
        </div>
    </form> 
  </div>
</div>

<?php include ('adm_akhir.php'); ?>