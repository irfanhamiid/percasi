<?php 
$CI =& get_instance();
$CI->load->model('Mymodel');
$st=array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
include ('adm_awal_ctk.php'); 
?>
<div class="container-fluid">
	<h5 class="py-3 mb-4 text-center">DATA PEMBAYARAN IURAN EVENT </span> <?= strtoupper($DtEvent['nama_ev']);?></h5>
	<p class="my-4">Event : <?= $DtEvent['nama_ev'];?> <span class="float-end">Provinsi : <?= $DtBayar['provinsi'];?></span></h5>
	
	<div class="row mb-5">
		<div class="col-sm-6">
			Pelaksanaan : <b><?= $CI->Mymodel->tgldmy($DtEvent['tgl_mulai_ev']);?></b> sampai 
				<b><?= $CI->Mymodel->tgldmy($DtEvent['tgl_selesai_ev']);?></b>
		</div>	
		<div class="col-sm-3 text-center">	
			Batas Pendaftaran :	<b><?= $CI->Mymodel->tgldmy($DtEvent['tgl_bts_daftar']);?></b>
		</div>	
		<div class="col-sm-3 text-end">		
			<b><?= $st[$DtEvent['status_ev']];?></b>
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-sm-4">				
			<p>Jenis Pembayaran : <span class="float-end"><b>
				<?php if ($DtBayar['jenis_byr']==1) { echo 'Iuran Wajib'; } else { echo 'Registrasi'; }?></b></span></p>
			
			<p>Jumlah Pembayaran : <span class="float-end"><b><?= number_format($DtBayar['jml_bayar'],0,',','.');?></b></span></p>
			
			<p>Tanggal Bayar : <span class="float-end"><b><?= $CI->Mymodel->tgldmy($DtBayar['tgl_bayar']);?></b></span></p>
			<p>Cara Bayar : <span class="float-end"><b><?php if ($DtBayar['cara_byr']==1) { echo 'Transfer Bank'; } else { echo 'Tunai'; }?></b></span></p>
			<?php
			if ($DtBayar['status_verifikasi']==0)
			{
				echo '<p class="text-end"><b>Belum diverifikasi</b></p>';
			}
			else
			{
				echo '<p class="text-end">Sudah diverifikasi oleh : <b>'.$DtBayar['nama_admin'].'</b>, Tanggal : <b>';
				echo $CI->Mymodel->tgldmy($DtBayar['tgl_verifikasi']).'</b></p>';
			}
			?>
		</div>
		<div class="col-sm-4">
			<p><b>Pembayar</b></p>
			<?php
			if ($DtBayar['cara_byr']==1)
			{
				?>
			<p>Ditransfer dari bank : <span class="float-end"><b><?= $DtBayar['dari_bank'];?></b></span></p>
			<p>Nomor Rekening Bank Asal : <span class="float-end"><b><?= $DtBayar['dari_rek'];?></b></span></p>
			<p>Nama pemilik rekening Bank : <span class="float-end"><b><?= $DtBayar['nama_pembayar'];?></b></span></p>
			<?php
			}
			else
			{
				?>
				<p>Nama pembayar: <span class="float-end"><b><?= $DtBayar['nama_pembayar'];?></b></span></p>
				<?php
			}
			?>
			<p>Catatan Pembayar :<br/><em><?= stripslashes($DtBayar['note_pembayar']);?></em></p>
		</div>
		<div class="col-sm-4">
			<p><b>Penerima</b></p>
			<?php
			if ($DtBayar['cara_byr']==1)
			{
				?>
				<p>Ditransfer ke bank : <span class="float-end"><b><?= $DtBayar['ke_bank'];?></b></span></p>
				<p>Nomor Rekening Bank Tujuan : <span class="float-end"><b><?= $DtBayar['ke_rek'];?></b></span></p>
				<p>Nama pemilik rekening Bank Tujuan : <span class="float-end"><b><?= $DtBayar['nama_penerima'];?></b></span></p>
				<?php
			}
			else
			{
				?>
				<p>Nama Penerima : <span class="float-end"><b><?= $DtBayar['nama_penerima'];?></b></span></p>
				<?php
			}
			?>
			<p>Catatan Penerima :<br/><em><?= stripslashes($DtBayar['note_penerima']);?></em></p>
		</div>
	</div>	
	
	<?php
	if ($DtBayar['id_operator']>0)
	
	{
		echo '<p class="text-center">Input by Operator : '.$DtBayar['nama_admin'].'</p>';
	}
	?>
	
</div>

<?php include ('adm_akhir_ctk.php'); ?>