<?php
$statusev=array('Belum Mulai', 'Berjalan', 'Selesai');
$statusclr=array('secondary', 'info', 'success');
?>
<div class="row mb-4">
	<div class="col-sm-8">
		<p>Pelaksanaan : <b><?= $CI->Mymodel->tgldmy($DtEvent['tgl_mulai_ev']);?></b> sampai 
			<b><?= $CI->Mymodel->tgldmy($DtEvent['tgl_selesai_ev']);?></b></p>
		<p>Batas Pendaftaran :	<b><?= $CI->Mymodel->tgldmy($DtEvent['tgl_bts_daftar']);?></b></p>

	</div>	
	<div class="col-sm-4 text-end">
		<p><span class="badge bg-<?= $statusclr[$DtEvent['status_ev']];?>"><?= $statusev[$DtEvent['status_ev']];?></span></p>
		<p>
		<?php
		$fn='img/poster/'.$DtEvent['poster'];
		if (file_exists('./'.$fn))
		{
			echo '<a href="'.base_url().$fn.'" target="_blank" class="btn btn-info btn-sm me-1"><i class="mdi mdi-image"></i> Poster</a>';
		}
		else
		{
			echo '<span class="btn btn-danger btn-sm">Belum ada poster !</span>';
		}
		$fn='pdf/'.$DtEvent['id_ev'].'.pdf';
		if (file_exists('./'.$fn))
		{
			echo '<a href="'.base_url().$fn.'" target="_blank" class="btn btn-info btn-sm"><i class="mdi mdi-file-pdf-box"></i> Proposal</a>';
		}
		else
		{
			echo '<span class="btn btn-danger btn-sm">Belum ada proposal !</span>';
		}
		?>
		</p>
	</div>	
</div>