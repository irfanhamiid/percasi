<?php include('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Data Slide Show</h5>

<?php $no = 1;
foreach ($foto as $foto) : ?>
	<div class="card mb-5">
		<div class="card-body">
			<h5>Slide <?= $no++ ?></h5>
			<p class="mt-3"><img id="imagesample1" class="img-fluid" src="<?= base_url('img/slide/' . $foto->foto) ?>" /></p>
			<form name="fslide1" method="post" action="<?= base_url(); ?>admin/slide_edit" enctype="multipart/form-data">
				<fieldset class="mb-3"><label>Gambar (max 2Mb)</label>
					<input type="file" name="foto" accept=".jpg,.jpeg,.png,.webp,.svg"
						id="filegambar" class="form-control" data-validate="required"
						onchange="return bacafile('imagesample1',this.files[0],'filegambar','fileerror',2000000)" />
					<p id="fileerror" class="text-danger"></p>

					<input type="hidden" name="id" value="<?= $foto->id ?>" />
				</fieldset>

				<p class="text-center">
					<button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Simpan</button>
				</p>
			</form>
		</div>
	</div>
<?php endforeach ?>

<script>
	function bacafile(idimage, objekfile, idinput, iderrmsg, maxukuran) {
		var allowedFiles = [".jpg", ".jpeg", ".png"];
		var fileUpload = document.getElementById(idinput);
		var lblError = document.getElementById(iderrmsg);
		var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
		if (!regex.test(fileUpload.value.toLowerCase())) {
			lblError.innerHTML = "Mohon hanya upload tipe file : <b>" + allowedFiles.join(', ') + "</b>.";
			fileUpload.value = "";
			document.getElementById(idimage).src = gbori;
			return false;
		} else {
			if (objekfile.size > maxukuran) {
				var l = maxukuran.toString();
				var p = l.length - 3;
				var s = l.substring(0, p);
				lblError.innerHTML = "Ukuran file terlalu besar, maksimal " + s + "KB.";
				fileUpload.value = "";
				document.getElementById(idimage).src = gbori;
				return false;
			} else {
				lblError.innerHTML = "";
				document.getElementById(idimage).src = window.URL.createObjectURL(objekfile)
				return true;
			}
		}
	}
</script>
<?php include('adm_akhir.php'); ?>