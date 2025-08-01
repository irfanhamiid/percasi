<?php include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Pengaturan Data Organisasi</h5>

<div class="card mb-5">   
  <div class="card-body">
    
    <form name="fadm" method="post" action="<?= base_url();?>admin/pengaturan">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <fieldset class="mb-3"><label>Nama Organisasi</label>
					<input type="text" class="form-control" name="namax" 
						disabled="disabled" value="<?= $INSTANSI['nama_instansi'];?>">
                </fieldset>
                <fieldset class="mb-3"><label>Alamat</label>
                    <input type="text" class="form-control" name="alamat" placeholder="alamat Organisasi"
						data-validate="required" maxlength="250" value="<?= $INSTANSI['alamat'];?>">
                </fieldset class="mb-3">
				<fieldset class="mb-3"><label>No. Telepon</label>
                    <input type="text" class="form-control" name="telepon" placeholder="No. Telepon"
						maxlength="20" value="<?= $INSTANSI['telepon'];?>" data-validate="required">
                </fieldset>
				<fieldset class="mb-3"><label>No. Whatshap</label>
                    <input type="text" class="form-control" name="telepon_wa" placeholder="No. WA"
						maxlength="20" value="<?= $INSTANSI['telepon_wa'];?>" data-validate="required">
                </fieldset>
				<fieldset class="mb-3"><label>Email Admin</label>
                    <input type="text" class="form-control" name="email" placeholder="Email Admin"
						maxlength="200" value="<?= $INSTANSI['email'];?>" data-validate="required,email">
                </fieldset>
				
                <p class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Simpan</button></p>
            </div>
        </div>
    </form>
  </div>
</div>

<?php include ('adm_akhir.php'); ?>