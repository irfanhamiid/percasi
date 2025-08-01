<?php 
$CI =& get_instance();
$CI->load->model('Mymodel');
include ('adm_awal.php'); 
?>

<h5 class="py-3 mb-4"><span class="text-muted">Detail Event</span> <?= $DtEvent['nama_ev'];?></h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
		<a href="<?= base_url();?>admin/event_iuran_byr_detail/<?= $DtBayar['id_byr'];?>/ctk" class="btn btn-info" target="_blank" ><i class="mdi mdi-printer"></i> Cetak</a>
		<a href="<?= base_url();?>admin/event_iuran_detail/<?= $DtBayar['id_iuran_ev'];?>" class="btn btn-danger" ><i class="mdi mdi-close"></i> Kembali</a>		
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
	
	<h5 class="my-4">Event : <?= $DtEvent['nama_ev'];?> <span class="float-end">Provinsi : <?= $DtBayar['provinsi'];?></span></h5>
	<hr/>
	
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
	<p><b>Bukti Pembayaran</b></p>
	<p class="mt-3"><img class="img-fluid" src="<?= base_url();?>img/bayar/<?= $DtBayar['bukti'];?>"/></p>	
	<?php
	if ($DtBayar['id_operator']>0)
	
	{
		echo '<p class="text-center">Input by Operator : '.$DtBayar['nama_admin'].'</p>';
	}
	?>
  </div>
</div>

<?php include ('adm_akhir.php'); ?>