<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
include ('opr_awal.php'); ?>

<h5 class="py-3 mb-4">Edit Pembayaran Iuran Event <span class="text-info"><?= $DtEvent['nama_ev'];?></span></h5>

<div class="card mb-5">   
  <div class="card-body">
	<p class="text-end">
        <a href="<?= base_url();?>opr/event_iuran/<?= $DtEvent['id_ev'];?>" class="btn btn-warning" ><i class="mdi mdi-close"></i> Kembali</a>
    </p>
  </div>
</div> 

<div class="card mb-5">   
  <div class="card-body">
	<h5>ID BAYAR : <?= $DtBayar['id_pembayaran'];?></h5>
	
	<form name="fpstnew" method="post" action="<?= base_url();?>opr/event_penataran_bayar_edit"
		enctype="multipart/form-data">
		<div class="row">
			<div class="col-sm-3">				
				<p><b>Detail Pembayaran</b></p>
				<fieldset><label>Jumlah Pembayaran</label>
					<input type="number" name="jumlah_bayar" class="form-control" data-validate="required,number"
						maxlength="10" value="<?= $DtBayar['jumlah_bayar'];?>"/>
				</fieldset>
				<fieldset><label>Tanggal Bayar</label>
					<input type="date" name="tanggal_bayar" class="form-control" data-validate="required"
						value="<?= $DtBayar['tanggal_bayar'];?>"/>
				</fieldset>
				<fieldset><label>Cara Bayar</label>
					<div class="form-check form-check-primary">
						<input name="cara_bayar" class="form-check-input" type="radio" value="1" id="byrtransfer" 
							<?php if ($DtBayar['cara_bayar']==1) { echo 'checked="checked"'; }?>>
						<label class="form-check-label" for="byrtransfer"> Transfer Bank </label>
					</div>
					<div class="form-check form-check-primary">
						<input name="cara_bayar" class="form-check-input" type="radio" value="2" id="bayartunai"
							<?php if ($DtBayar['cara_bayar']==2) { echo 'checked="checked"'; }?>>
						<label class="form-check-label" for="bayartunai"> Bayar Tunai</label>
					</div> 
				</fieldset>
			</div>
			<div class="col-sm-3">
				<p><b>Pembayar</b></p>
				<fieldset><label>Ditransfer dari bank (Jika tunai, isi dengan Cash)</label>
					<input type="text" name="daribank" class="form-control" data-validate="required"
						maxlength="30" value="<?= $DtBayar['dari_bank'];?>"/>
				</fieldset>
				<fieldset><label>Nomor Rekening Bank Asal (Jika tunai, isi dengan Cash)</label>
					<input type="text" name="darirek" class="form-control" data-validate="required"
						maxlength="30" value="<?= $DtBayar['dari_rek'];?>"/>
				</fieldset>
				<fieldset><label>Nama pemilik rekening Bank (Jika tunai, isi nama orang yang membayar )</label>
					<input type="text" name="namapembayar" class="form-control" data-validate="required"
						maxlength="30" value="<?= $DtBayar['nama_pembayar'];?>"/>
				</fieldset>
			</div>
			<div class="col-sm-3">
				<p><b>Penerima</b></p>
				<fieldset><label>Ditransfer ke bank (Jika tunai, isi dengan Cash)</label>
					<input type="text" name="kebank" class="form-control" data-validate="required"
						maxlength="30" value="<?= $DtBayar['ke_bank'];?>"/>
				</fieldset>
				<fieldset><label>Nomor Rekening Bank Tujuan (Jika tunai, isi dengan -)</label>
					<input type="text" name="kerek" class="form-control" data-validate="required"
						maxlength="30" value="<?= $DtBayar['ke_rek'];?>"/>
				</fieldset>
				<fieldset><label>Nama pemilik rekening Bank Tujuan (Jika tunai, isi nama orang yang menerima )</label>
					<input type="text" name="namapenerima" class="form-control" data-validate="required"
						maxlength="30" value="<?= $DtBayar['nama_penerima'];?>"/>
				</fieldset>
			</div>
			<div class="col-sm-3">	
                <p><b>Bukti Pembayaran</b></p>
				<fieldset class="mb-3"><label>Bukti Pembayaran (format jpg/jpeg/png, max 2Mb)</label>
					<input type="file" name="bukti" accept=".jpg,.jpeg,.png" 
						id="filegambar"  class="form-control" 
						onchange="return bacafile('imagesample',this.files[0],'filegambar','fileerror',2000000,'<?= $Bukti;?>');"/>
					<p id="fileerror" class="text-danger"></p>	
					<p class="mt-3"><img id="imagesample" height="100" src="<?= $Bukti;?>"/></p>
                </fieldset>
			</div>
		</div>	
		
		<p class="text-center mt-4">
			<a href="<?= base_url();?>opr/event_iuran/<?= $DtEvent['id_ev'];?>" class="btn btn-danger" >
				<i class="mdi mdi-close"></i> Batal</a>
			<button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Simpan</button>
		</p>
		<input type="hidden" name="idev" value="<?= $DtEvent['id_ev'];?>"/>
		<input type="hidden" name="stev" value="<?= $DtEvent['status_ev'];?>"/>
		<input type="hidden" name="idbyr" value="<?= $DtBayar['id_pembayaran'];?>"/>
	</form>
	<script>
		function bacafile(idimage, objekfile, idinput, iderrmsg, maxukuran, gbori)
		{
			var allowedFiles = [".png", ".jpg", ".jpeg"];
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