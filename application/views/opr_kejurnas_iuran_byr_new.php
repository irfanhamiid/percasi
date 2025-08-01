<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
include ('opr_awal.php'); ?>

<h5 class="py-3 mb-4">Tambah Pembayaran Iuran Kejurnas</h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>opr/kejurnas_iuran/<?= $DtKj['id_kj'];?>" class="btn btn-danger" ><i class="mdi mdi-close"></i> Batal</a>
    </p>
	<h5><?= $DtKj['nama_kj'];?></h5>
	
	<form name="fpstnew" method="post" action="<?= base_url();?>opr/kejurnas_iuran_byr_new"
		enctype="multipart/form-data">
		<div class="row">
			<div class="col-sm-3">				
				<fieldset><label>Jenis Pembayaran</label>
					<div class="form-check form-check-primary">
						<input name="jenisbyr" class="form-check-input" type="radio" value="1" id="iuranwjb" checked="checked">
						<label class="form-check-label" for="iuranwjb"> Iuran Wajib </label>
					</div>
					<div class="form-check form-check-primary">
						<input name="jenisbyr" class="form-check-input" type="radio" value="2" id="iuranpst">
						<label class="form-check-label" for="iuranwjb"> Biaya Registrasi </label>
					</div> 
				</fieldset>
				
				<fieldset><label>Jumlah Pembayaran</label>
					<input type="text" name="jmlbayar" class="form-control" data-validate="required,number"
						maxlength="10"/>
				</fieldset>
				<fieldset><label>Tanggal Bayar</label>
					<input type="date" name="tglbayar" class="form-control" data-validate="required"/>
				</fieldset>
				<fieldset><label>Cara Bayar</label>
					<div class="form-check form-check-primary">
						<input name="carabyr" class="form-check-input" type="radio" value="1" id="byrtransfer" checked="checked">
						<label class="form-check-label" for="byrtransfer"> Transfer Bank </label>
					</div>
					<div class="form-check form-check-primary">
						<input name="carabyr" class="form-check-input" type="radio" value="2" id="bayartunai">
						<label class="form-check-label" for="bayartunai"> Bayar Tunai</label>
					</div> 
				</fieldset>
			</div>
			<div class="col-sm-3">
				<p><b>Pembayar</b></p>
				<fieldset><label>Ditransfer dari bank (Jika tunai, isi dengan Cash)</label>
					<input type="text" name="daribank" class="form-control" data-validate="required"
						maxlength="30"/>
				</fieldset>
				<fieldset><label>Nomor Rekening Bank Asal (Jika tunai, isi dengan Cash)</label>
					<input type="text" name="darirek" class="form-control" data-validate="required"
						maxlength="30"/>
				</fieldset>
				<fieldset><label>Nama pemilik rekening Bank (Jika tunai, isi nama orang yang membayar )</label>
					<input type="text" name="namapembayar" class="form-control" data-validate="required"
						maxlength="30"/>
				</fieldset>
			</div>
			<div class="col-sm-3">
				<p><b>Penerima</b></p>
				<fieldset><label>Ditransfer ke bank (Jika tunai, isi dengan -)</label>
					<input type="text" name="kebank" class="form-control" data-validate="required"
						maxlength="30"/>
				</fieldset>
				<fieldset><label>Nomor Rekening Bank Tujuan (Jika tunai, isi dengan Cash)</label>
					<input type="text" name="kerek" class="form-control" data-validate="required"
						maxlength="30"/>
				</fieldset>
				<fieldset><label>Nama pemilik rekening Bank Tujuan (Jika tunai, isi nama orang yang menerima )</label>
					<input type="text" name="namapenerima" class="form-control" data-validate="required"
						maxlength="30"/>
				</fieldset>
			</div>
			<div class="col-sm-3">	
				<fieldset><label>Catatan jika diperlukan</label>
					<textarea name="catatan" class="form-control" ></textarea>
				</fieldset>
				<fieldset class="mb-3"><label>Bukti Pembayaran (format jpg/jpeg/png, max 2Mb)</label>
					<input type="file" name="bukti" accept=".jpeg,.jpg,.png" data-validate="required"
						id="filegambar"  class="form-control" 
						onchange="return bacafile('imagesample',this.files[0],'filegambar','fileerror',2000000,'<?= base_url();?>img/noimage.jpg');"/>
					<p id="fileerror" class="text-danger"></p>	
					<p class="mt-3"><img id="imagesample" height="100" src="<?= base_url();?>img/noimage.jpg"/></p>
                </fieldset>
			</div>
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

<?php include ('opr_akhir.php'); ?>