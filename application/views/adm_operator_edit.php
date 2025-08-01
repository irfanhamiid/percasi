<?php include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Ubah Data Operator Provinsi</h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>admin/operator" class="btn btn-danger" > <i class="mdi mdi-close"></i> Batal</a>
    </p>
    <form name="fprov" method="post" action="<?= base_url();?>admin/operator_edit" enctype="multipart/form-data" >
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <fieldset class="mb-3"><label>Provinsi</label>
					<select name="idprov" class="form-control" autofocus>
						<?php
						foreach($DtProv as $p)
						{
							echo '<option value="'.$p->id_prov.'"';
							if ($DtOpr['id_prov']==$p->id_prov)
							{
								echo ' selected="selected"';
							}
							echo '>'.$p->provinsi.'</option>';
						}
						?>
					</select>
                </fieldset>
				<fieldset class="mb-3"><label>Nama Operator</label>
					<input type="text" class="form-control" name="namaopr" placeholder="Nama operator" 
						data-validate="required" maxlength="40" value="<?= $DtOpr['nama_operator'];?>">
                </fieldset>
				<fieldset class="mb-3"><label>Telepon</label>
					<input type="text" class="form-control" name="telepon" placeholder="Telepon aktif" 
						data-validate="required,number" maxlength="20" value="<?= $DtOpr['telepon'];?>">
                </fieldset>
				<fieldset class="mb-3"><label>Email</label>
					<input type="text" class="form-control" name="email" placeholder="Email aktif" 
						data-validate="required,email" maxlength="40" value="<?= $DtOpr['email'];?>">
                </fieldset>
				<fieldset class="mb-3"><p>Status</p>				 
					<div class="form-check form-check-inline mt-3">
					  <input class="form-check-input" type="radio" name="aktif" id="inlineRadio1" value="1" 
					  <?php if ($DtOpr['aktif']==1) { echo ' checked="checked"'; } ?>>
					  <label class="form-check-label" for="inlineRadio1">Aktif</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="aktif" id="inlineRadio2" value="0"
					  <?php if ($DtOpr['aktif']==0) { echo ' checked="checked"'; } ?>>
					  <label class="form-check-label" for="inlineRadio2">Tidak Aktif</label>
					</div>
				</fieldset>
				<fieldset class="mb-3"><label>Nama Pengguna</label>
					<input type="text" class="form-control" name="username" placeholder="Nama pengguna untuk login" 
						data-validate="required" maxlength="50"  value="<?= $DtOpr['user_name'];?>">
                </fieldset>
				<fieldset class="mb-3"><label>Password</label>
					<input type="password" class="form-control" name="passwd" placeholder="Password untuk login" 
						maxlength="50">
					<p class="text-info">Kosongkan bila tidak akan merubah password !</p>	
                </fieldset>
				<fieldset class="mb-3"><p>Status Iuran Tahunan</p>				 
					<div class="form-check form-check-inline mt-3">
					  <input class="form-check-input" type="radio" name="iuran" id="inlineRadio3" value="sudah" 
					  <?php if ($DtOpr['iuran']=='sudah') { echo ' checked="checked"'; } ?>>
					  <label class="form-check-label" for="inlineRadio3">Sudah</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="iuran" id="inlineRadio4" value="belum"
					  <?php if ($DtOpr['iuran']=='belum') { echo ' checked="checked"'; } ?>>
					  <label class="form-check-label" for="inlineRadio4">Belum</label>
					</div>
				</fieldset>
				<fieldset class="mb-3"><label>Foto (max 2Mb)</label>
					<input type="file" name="foto" accept=".jpg,.jpeg,.png"
						id="filegambar"  class="form-control" 
						onchange="return bacafile('imagesample',this.files[0],'filegambar','fileerror',2000000,'<?= base_url();?><?= $Foto;?>');"/>
					<p id="fileerror" class="text-danger"></p>	
					<p class="mt-3"><img id="imagesample" height="100" src="<?= base_url();?><?= $Foto;?>"/></p>
                </fieldset>
				<input type="hidden" name="idopr" value="<?= $DtOpr['id_operator'];?>"/>
                <p class="text-center">
                    <button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Simpan</button></p>
            </div>
        </div>
    </form> 
	<script>
		function bacafile(idimage, objekfile, idinput, iderrmsg, maxukuran, gbori)
		{
			var allowedFiles = [".jpg",".png",".jpeg"];
			var fileUpload = document.getElementById(idinput);
			var lblError = document.getElementById(iderrmsg);
			var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
			if (!regex.test(fileUpload.value.toLowerCase())) 
			{
				lblError.innerHTML = "Mohon hanya upload tipe file : <b>" + allowedFiles.join(', ') + "</b>.";
				fileUpload.value="";
				document.getElementById(idimage).src=gbori;


				return false;
			}
			else
			{
				if (objekfile.size>maxukuran)
				{
					var l=maxukuran.toString();
					var p=l.length-3;
					var s=l.substring(0,p);
					lblError.innerHTML = "Ukuran file terlalu besar, maksimal "+s+"KB.";
					fileUpload.value="";
					document.getElementById(idimage).src=gbori;
					return false;
				}
				else
				{
					lblError.innerHTML = "";
					document.getElementById(idimage).src = window.URL.createObjectURL(objekfile)
					return true;
				}
			}                                
		}    
		</script>  
  </div>
</div>

<?php include ('adm_akhir.php'); ?>