<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Tambah Pembayaran Penerimaan Lain Kejurnas</h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>admin/kejurnas_iuran/<?= $DtKj['id_kj'];?>" class="btn btn-danger" ><i class="mdi mdi-close"></i> Batal</a>
    </p>
	<h5 class="my-4">Kejurnas : <?= $DtKj['nama_kj'];?></h5>
	<hr/>
	<form name="fpstnew" method="post" action="<?= base_url();?>admin/kejurnas_penlain_new"
		enctype="multipart/form-data">
		<div class="row">
			<fieldset class="col-sm-4"><label>Tanggal Bayar</label>
				<input type="date" name="tglbayar" class="form-control" data-validate="required"/>
			</fieldset>
			<fieldset class="col-sm-4"><label>No. Bukti</label>
				<input type="text" name="nobukti" class="form-control" data-validate="required"
					maxlength="15"/>
			</fieldset>
			<fieldset class="col-sm-4"><label>Jumlah Diterima</label>
				<input type="text" name="jmlbayar" class="form-control" data-validate="required,number"
					maxlength="10"/>
			</fieldset>
			
			<fieldset  class="col-sm-6"><label>Keterangan</label>
				<textarea name="keterangan" class="form-control" data-validate="required"></textarea>
			</fieldset>
		
			<fieldset class="col-sm-6"><label>Bukti Pembayaran (format jpg, max 500Kb)</label>
				<input type="file" name="bukti" accept="image/jpeg" data-validate="required"
					id="filegambar"  class="form-control" 
					onchange="return bacafile('imagesample',this.files[0],'filegambar','fileerror',500000,'<?= base_url();?>img/noimage.jpg');"/>
				<p id="fileerror" class="text-danger"></p>	
				<p class="mt-3"><img id="imagesample" height="100" src="<?= base_url();?>img/noimage.jpg"/></p>
			</fieldset>
			
		</div>	
		
		<p class="text-center mt-4">
			<button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Smpan</button>
		</p>
		<input type="hidden" name="idkj" value="<?= $DtKj['id_kj'];?>"/>
		<input type="hidden" name="stkj" value="<?= $DtKj['status_kj'];?>"/>
	</form>
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
  </div>
</div>

<?php include ('adm_akhir.php'); ?>