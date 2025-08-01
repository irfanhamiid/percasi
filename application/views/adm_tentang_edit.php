<?php include ('adm_awal.php'); 
$g='img/'.$DtTentang['foto'];
if (file_exists('./'.$g))
{
	$gbr=base_url().$g;
	$gbrada=1;
}
else
{
	$gbr=base_url().'img/noimage.jpg';
	$gbrada=0;
}
?>

<h5 class="py-3 mb-4">Edit Data Tentang Kami</h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>admin/tentang" class="btn btn-danger" > <i class="mdi mdi-close"></i> Batal</a>
    </p>
    <form name="fttg" method="post" action="<?= base_url();?>admin/tentang_edit" enctype="multipart/form-data">
        
		<fieldset class="mb-3"><label>Judul</label>
			<input type="text" class="form-control" name="judul" placeholder="Judul" autofocus
				data-validate="required" maxlength="255" value="<?= $DtTentang['judul'];?>">
		</fieldset>
		<fieldset class="mb-3"><label>Deskripsi</label>
			<textarea class="ckeditor" name="deskripsi" placeholder="Deskripsi"
				><?= stripslashes($DtTentang['deskripsi']);?></textarea>
		</fieldset class="mb-3">
		<fieldset class="mb-3"><p>Status</p>				 
			<div class="form-check form-check-inline mt-3">
			  <input class="form-check-input" type="radio" name="aktif" id="inlineRadio1" value="1" 
			  <?php if($DtTentang['aktif']==1) { echo 'checked="checked"'; } ?>>
			  <label class="form-check-label" for="inlineRadio1">Aktif</label>
			</div>
			<div class="form-check form-check-inline">
			  <input class="form-check-input" type="radio" name="aktif" id="inlineRadio2" value="0"
			  <?php if($DtTentang['aktif']==0) { echo 'checked="checked"'; } ?>>
			  <label class="form-check-label" for="inlineRadio2">Tidak Aktif</label>
			</div>
		</fieldset>
		
		<fieldset class="mb-3"><label>Gambar (format jpg/png, max 2Mb)</label>
			<input type="file" name="foto" accept=".jpg,.jpeg,.png"
				id="filegambar"  class="form-control" 
				onchange="return bacafile('imagesample',this.files[0],'filegambar','fileerror',2000000,'<?= $gbr;?>');"/>
			<p id="fileerror" class="text-danger"></p>	
			<p class="mt-3"><img id="imagesample" height="100" src="<?= $gbr;?>"/></p>
		</fieldset>
		<input type="hidden" value="<?= $DtTentang['id_ttg'];?>" name="id"/>
		
		<p class="text-center">
			<?php
			if ($gbrada==1)
			{
				?>
					<a href="#" 
						onclick="return hapusgbr('<?= $DtTentang['id_ttg']; ?>')" class="btn btn-danger">
						<i class="mdi mdi-image-remove"></i> Hapus gambar</a>
				<?php
			}
			?>
			<button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Simpan</button></p>
  
    </form>
	<script>
		function bacafile(idimage, objekfile, idinput, iderrmsg, maxukuran, gbori)
		{
			var allowedFiles = [".jpg",".jpeg",".png"];
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
		
		
		function hapusgbr(idnya)
		{

			Swal.fire({
				title: 'Hapus Gambar ?',
				html: "Anda akan menghapus gambar pada postingan ini</b> !",
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya',
				cancelButtonText: 'Tidak',    

			}).then((result) => {
				if (result.value) {            
				window.location.href = "<?= base_url();?>admin/tentang_delgbr/" + idnya;           
				}
			})
		}
	
		</script>  
  </div>
</div>

<?php include ('adm_akhir.php'); ?>