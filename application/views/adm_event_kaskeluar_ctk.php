<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
include ('adm_awal_ctk.php'); ?>

<div class="container-fluid">
<h5 class="py-3 mb-4 text-center">DATA PENGELUARAN KAS EVENT </span> <?= strtoupper($DtEvent['nama_ev']);?></h5>
	
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
	
	<?php
	if ($JmlPen==0)
	{
		echo '<div class="alert alert-danger">Belum ada pengeluaran kas...</div>';
	}
	else	
	{
		?>
		
		<table class="table mb-4">
			<thead><tr><th>NO</th><th>TANGGAL</th><th>NO. BUKTI</th><th>KETERANGAN</th>
				<th>ADMIN</th><th class="text-end">JUMLAH</th></tr></thead>
			<tbody>
			<?php
			$total=0; $n=1;
			foreach ($DtPen as $k)
			{
				?>
				<tr><td><?= $n;?></td>
					<td><?= $CI->Mymodel->tgldmy($k->tgl_keluar);?></td>
					<td><?= $k->no_bukti;?></td>
					<td><?= stripslashes($k->keterangan);?></td>
					<td><?= $k->nama_admin;?></td>
					<td class="text-end"><?= number_format($k->jumlah, 0, ',', '.');?></td>
				</tr>
				<?php
				$n++; $total+=$k->jumlah;
			}
			?>
			</tbody>
			<tfoot>
			<tr><th colspan="5" class="text-end">JUMLAH</th>
				<th class="text-end"><?= number_format($total,0,',','.');?></th>
			</tr>
		</tfoot>
		</table>
	<?php		
	}		
	?>
</div>

<?php include ('adm_akhir_ctk.php'); ?>