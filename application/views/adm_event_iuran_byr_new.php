<?php 
$CI =& get_instance();
$CI->load->model('Mymodel');
include ('adm_awal.php'); 
?>

<h5 class="py-3 mb-4"><span class="text-muted">Detail Event</span> <?= $DtEvent['nama_ev'];?></h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
		
		<a href="<?= base_url();?>admin/event_edit/<?= $DtEvent['id_ev'];?>" class="btn btn-info btn-sm" > <i class="mdi mdi-pencil"></i> Edit</a>
		<?php
		if ($_SESSION['TP_ADMIN']==3)
		{
			?>
			<a href="#" class="btn btn-xs btn-danger" title="Hapus"
				onclick="return hapusevent('<?= $DtEvent['id_ev'];?>','<?= $DtEvent['nama_ev'];?>');">
				<i class="mdi mdi-trash-can"></i> belum</a>
		<?php
		}
		?>
        <a href="<?= base_url();?>admin/event/<?= $DtEvent['status_ev'];?>/scr" class="btn btn-warning btn-sm" > <i class="mdi mdi-close"></i> Kembali</a>		
    </p>
	<hr/>
	<?php include('adm_event_info.php'); ?>
  </div>
</div>

<div class="card mb-5">   
  <div class="card-body">  
	<ul class="nav nav-tabs">
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_detail/<?= $DtEvent['id_ev'];?>">Kategori dan Gelar</a>		
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_peserta/<?= $DtEvent['id_ev'];?>">Peserta</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_time/<?= $DtEvent['id_ev'];?>">Time Line</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link active" aria-current="page" ><b>Penerimaan Iuran/Registrasi</b></a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_penlain/<?= $DtEvent['id_ev'];?>">Penerimaan Lain</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_kaskeluar/<?= $DtEvent['id_ev'];?>">Pengeluaran Kas</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_keuangan/<?= $DtEvent['id_ev'];?>">Keuangan</a>
	  </li> 
	  
	</ul>
	
	<h5 class="my-4">Event : <?= $DtEvent['nama_ev'];?> <span class="float-end">Provinsi : <?= $DtIuran['provinsi'];?></span></h5>
	<hr/>
	<form name="fpstnew" method="post" action="<?= base_url();?>admin/event_iuran_byr_new"
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
						<label class="form-check-label" for="iuranpst"> Biaya Registrasi </label>
					</div> 
					<div class="form-check form-check-primary">
						<input name="jenisbyr" class="form-check-input" type="radio" value="3" id="akomodasi">
						<label class="form-check-label" for="akomodasi"> Akomodasi  </label>
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
				<fieldset><label>Ditransfer dari bank (Jika tunai, isi dengan -)</label>
					<input type="text" name="daribank" class="form-control" data-validate="required"
						maxlength="30"/>
				</fieldset>
				<fieldset><label>Nomor Rekening Bank Asal (Jika tunai, isi dengan -)</label>
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
				<fieldset><label>Nomor Rekening Bank Tujuan (Jika tunai, isi dengan -)</label>
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
				<fieldset class="mb-3"><label>Bukti Pembayaran </label>
					<input type="file" name="bukti" accept=".jpg,.png,.jpeg" data-validate="required"
						id="filegambar"  class="form-control" 
						onchange="return bacafile('imagesample',this.files[0],'filegambar','fileerror',2000000,'<?= base_url();?>img/noimage.jpg');"/>
					<p id="fileerror" class="text-danger"></p>	
					<p class="mt-3"><img id="imagesample" height="100" src="<?= base_url();?>img/noimage.jpg"/></p>
                </fieldset>
			</div>
		</div>	
		
		<p class="text-center mt-4">
			<button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Simpan</button>
		</p>
		<input type="hidden" name="idiuran" value="<?= $DtIuran['id_iuran_ev'];?>"/>
		<input type="hidden" name="idev" value="<?= $DtEvent['id_ev'];?>"/>
		<input type="hidden" name="stev" value="<?= $DtEvent['status_ev'];?>"/>
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
		</script> 
  </div>
</div>

<?php include ('adm_akhir.php'); ?>