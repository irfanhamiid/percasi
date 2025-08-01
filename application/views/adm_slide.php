<?php include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Data Slide Show</h5>

<div class="card mb-5">   
  <div class="card-body">
    <h5>Slide 1</h5>
	<p class="mt-3"><img id="imagesample1" class="img-fluid" src="<?= base_url();?>img/slide_1.jpg"/></p>
	<form name="fslide1" method="post" action="<?= base_url();?>admin/slide_edit" enctype="multipart/form-data">
		<fieldset class="mb-3"><label>Gambar (format jpg, max 500Kb)</label>
			<input type="file" name="foto" accept="image/jpeg"
				id="filegambar"  class="form-control"  data-validate="required"
				onchange="return bacafile('imagesample1',this.files[0],'filegambar','fileerror',500000,'<?= base_url();?>img/slide_1.jpg');"/>
			<p id="fileerror" class="text-danger"></p>	
			
			<input type="hidden" name="id" value="1"/>
		</fieldset>
		
		<p class="text-center">
			<button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Simpan</button></p>
	</form>
	</div>
</div>
<div class="card mb-5">   
  <div class="card-body">
	
	<h5>Slide 2</h5>
	<p class="mt-3"><img id="imagesample2" class="img-fluid" src="<?= base_url();?>img/slide_2.jpg"/></p>
	<form name="fslide2" method="post" action="<?= base_url();?>admin/slide_edit" enctype="multipart/form-data">
		<fieldset class="mb-3"><label>Gambar (format jpg, max 500Kb)</label>
			<input type="file" name="foto" accept="image/jpeg"
				id="filegambar"  class="form-control" data-validate="required"
				onchange="return bacafile('imagesample2',this.files[0],'filegambar','fileerror',500000,'<?= base_url();?>img/slide_2.jpg');"/>
			<p id="fileerror" class="text-danger"></p>	
		</fieldset>
		<input type="hidden" name="id" value="2"/>
		<p class="text-center">
			<button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Simpan</button></p>
	</form>
	
</div>
</div>
<div class="card mb-5">   
  <div class="card-body">
	
	<h5>Slide 3</h5>
	<p class="mt-3"><img id="imagesample3" class="img-fluid" src="<?= base_url();?>img/slide_3.jpg"/></p>
	<form name="fslide3" method="post" action="<?= base_url();?>admin/slide_edit" enctype="multipart/form-data">
		<fieldset class="mb-3"><label>Gambar (format jpg, max 500Kb)</label>
			<input type="file" name="foto" accept="image/jpeg"
				id="filegambar"  class="form-control"  data-validate="required"
				onchange="return bacafile('imagesample3',this.files[0],'filegambar','fileerror',500000,'<?= base_url();?>img/slide_3.jpg');"/>
			<p id="fileerror" class="text-danger"></p>	
		</fieldset>
		<input type="hidden" name="id" value="3"/>
		<p class="text-center">
			<button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Simpan</button></p>
	</form>
	
	
    
  </div>
</div>
<script>
		function bacafile(idimage, objekfile, idinput, iderrmsg, maxukuran, gbori)
		{
			var allowedFiles = [".jpg"];
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
<?php include ('adm_akhir.php'); ?>