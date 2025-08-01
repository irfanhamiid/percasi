<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

include ('adm_awal_ctk.php'); ?>

<div class="container-fluid">
	<h5 class="py-3 mb-4 text-center">DATA PEMENANG EVENT </span> <?= strtoupper($DtEvent['nama_ev']);?></h5>
	
	<P>Pelaksanaan : <b><?= $CI->Mymodel->tgldmy($DtEvent['tgl_mulai_ev']);?></b> sampai 
				<b><?= $CI->Mymodel->tgldmy($DtEvent['tgl_selesai_ev']);?></b></p>
				
	<?php
	if ($JmlWinner==0)
	{
		echo '<div class="alert alert-danger">Belum ada pemenang...</div>';
	}
	else	
	{
		?>
		
		<table class="table mb-4">
			<thead><tr><th>PERINGKAT</th><th>KETERANGAN</th><th>NAMA</th><th>PROVINSI</th>
				</tr></thead>
			<tbody>
			<?php

			foreach ($DtWinner as $k)
			{
				?>
				<tr><td><?= $k->peringkat;?></td>
					<td><?= $k->keterangan;?></td>
					<td><?= $k->nama_pst;?></td>
					<td><?= $k->provinsi;?></td>
				</tr>
				<?php
			}
			?>
			</tbody>
			
		</table>
	<?php
	}
	?>
	
</div>

<?php include ('adm_akhir_ctk.php'); ?>