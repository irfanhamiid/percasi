<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4"><span class="text-muted">Pengeluaran Kas Event</span> <?= $DtEvent['nama_ev'];?></h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>admin/event_kaskeluar/<?= $DtEvent['id_ev'];?>" class="btn btn-warning btn-sm" > <i class="mdi mdi-close"></i> Kembali</a>		
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
		<a class="nav-link" href="<?= base_url();?>admin/event_iuran/<?= $DtEvent['id_ev'];?>" >Penerimaan Iuran/Registrasi</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link"  href="<?= base_url();?>admin/event_penlain/<?= $DtEvent['id_ev'];?>">Penerimaan Lain</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link active" aria-current="page"><b>Pengeluaran Kas</b></a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_keuangan/<?= $DtEvent['id_ev'];?>">Keuangan</a>
	  </li> 
	</ul>
	
	<h5 class="mt-4">Edit Data Pengeluaran Kas</h5>
	<form name="fpstnew" method="post" action="<?= base_url();?>admin/event_kaskeluar_edit"
		enctype="multipart/form-data">
		<div class="row">
			<fieldset class="col-sm-4"><label>Tanggal Pengeluaran</label>
				<input type="date" name="tglkeluar" class="form-control myinput-required" data-validate="required"
					 value="<?= $DtPen['tgl_keluar'];?>"/>
			</fieldset>
			<fieldset class="col-sm-4"><label>No. Bukti</label>
				<input type="text" name="nobukti" class="form-control myinput-required" data-validate="required"
					maxlength="15" value="<?= $DtPen['no_bukti'];?>"/>
			</fieldset>
			<fieldset class="col-sm-4"><label>Jumlah Pengeluaran</label>
				<input type="text" name="jmlkeluar" class="form-control myinput-required" data-validate="required,number"
					maxlength="10" value="<?= $DtPen['jumlah'];?>"/>
			</fieldset>
			<fieldset class="col-sm-6"><label>Keterangan</label>
				<textarea name="keterangan" class="form-control myinput-required"  data-validate="required"><?= stripslashes($DtPen['keterangan']);?></textarea>
			</fieldset>
			<fieldset class="col-sm-6"><label>Bukti Pembayaran (format jpg/png, max 2Mb)</label>
				<input type="file" name="bukti" accept=".jpg,.png,.jpeg"
					id="filegambar"  class="form-control" 
					onchange="return bacafile('imagesample',this.files[0],'filegambar','fileerror',2000000,'<?= base_url();?>img/bayar/<?= $DtPen['bukti'];?>');"/>
				<p id="fileerror" class="text-danger"></p>	
				<p class="mt-3"><img id="imagesample" height="100" src="<?= base_url();?>img/bayar/<?= $DtPen['bukti'];?>"/></p>
			</fieldset>
		</div>	
				
		
		
		<p class="text-center mt-4">
			<a href="<?= base_url();?>admin/event_penlain/<?= $DtEvent['id_ev'];?>" class="btn btn-danger btn-sm" > <i class="mdi mdi-close"></i> Batal</a>		
			<button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Smpan</button>
		</p>
		<input type="hidden" name="idev" value="<?= $DtEvent['id_ev'];?>"/>
		<input type="hidden" name="idkas" value="<?= $DtPen['id_kaskeluar'];?>"/>
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