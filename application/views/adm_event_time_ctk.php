<?php
$CI =& get_instance();
$CI->load->model('Mymodel');
$statusev=array('Belum Mulai', 'Berjalan', 'Selesai');
$statusclr=array('secondary', 'info', 'success');
$st=array('Belum Berjalan', 'Berjalan', 'Selesai', 'Gagal');
$cl=array('info', 'primary', 'success', 'danger');
include ('adm_awal_ctk.php'); ?>

<div class="container-fluid">
	<h5 class="py-3 mb-4 text-center">TIME LINE EVENT </span> <?= strtoupper($DtEvent['nama_ev']);?></h5>
	<div class="row mb-3">
		<div class="col-sm-6">
			Pelaksanaan : <b><?= $CI->Mymodel->tgldmy($DtEvent['tgl_mulai_ev']);?></b> sampai 
				<b><?= $CI->Mymodel->tgldmy($DtEvent['tgl_selesai_ev']);?></b>
		</div>	
		<div class="col-sm-3 text-center">	
			Batas Pendaftaran :	<b><?= $CI->Mymodel->tgldmy($DtEvent['tgl_bts_daftar']);?></b>
		</div>	
		<div class="col-sm-3 text-end">Status : <b><?= $statusev[$DtEvent['status_ev']];?></b>
		</div>
	</div>
	
	<?php
	if ($JmlTime==0)
	{
		echo '<div class="alert alert-danger">Belum ada data timeline...</div>';
	}
	else
	{
		foreach ($DtTime as $t)
		{
			?>
			<h6 class="p-2 bg-light my-4"><?= $CI->Mymodel->tgltext($t->tanggal);?>, <?= $t->kegiatan;?></h6>
			<p class="mb-2"><?= $t->catatan;?></p>
			<p><span class="float-end">By <?= $t->nama_admin;?></span></p>	
			<hr/>
			<?php
		}
		
	}
	?>
</div>
<?php include ('adm_akhir_ctk.php'); ?>