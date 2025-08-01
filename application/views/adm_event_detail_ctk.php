<?php 
$CI =& get_instance();
$CI->load->model('Mymodel');
include ('adm_awal_ctk.php'); 
?>
<div class="container">
	<h5 class="py-3 mb-4 text-center">Data Kategori dan Gelar Pada Event <?= $DtEvent['nama_ev'];?></h5>
	<?php
	$statusev=array('Belum Mulai', 'Berjalan', 'Selesai');
	$statusclr=array('secondary', 'info', 'success');
	?>
	<div class="row mb-4">
		<div class="col-sm-8">
			<p>Pelaksanaan : <b><?= $CI->Mymodel->tgldmy($DtEvent['tgl_mulai_ev']);?></b> sampai 
				<b><?= $CI->Mymodel->tgldmy($DtEvent['tgl_selesai_ev']);?></b></p>
			<p>Batas Pendaftaran :	<b><?= $CI->Mymodel->tgldmy($DtEvent['tgl_bts_daftar']);?></b></p>
			<p>Input/edit oleh : <b><?= $DtEvent['nama_admin'];?></b></p>
		</div>	
		<div class="col-sm-4 text-end">
			<p><span class="badge bg-<?= $statusclr[$DtEvent['status_ev']];?>"><?= $statusev[$DtEvent['status_ev']];?></span></p>
			
		</div>	
	</div>
	<div class="row">
		<div class="col-sm-6">
			<h6 class="mt-4 p-2 bg-light">Kategori</h6>
			
			<?php
			if ($JmlKtg==0)
			{
				echo '<p class="bg-light py-2">Belum ada data kategori ...</p>';
			}
			else
			{
				echo '<table class="table table-sm table-bordered">
						<thead><tr><th>NO</th><th>KATEGORI</th><th class="text-end">JML PESERTA</th></tr></thead>
						<tbody>';
				$n=1;
				foreach($DtKtg as $l)
				{
					?>
					<tr><td><?= $n;?></td>
						<td><?= $l->kategori;?></td>
						<td class="text-end"><?= number_format($l->jml_peserta,0,',','.');?></td>
					</tr>	
					<?php
					$n++;
				}
				?>
				</tbody></table>
			<?php	
			}
			?>
			
		  </div>
		  <div class="col-sm-6">
			<h6 class="mt-4 p-2 bg-light">Gelar</h6>
			
			<?php
			if ($JmlGelar==0)
			{
				echo '<p class="bg-light py-2">Belum ada data gelar ...</p>';
			}
			else
			{
				echo '<table class="table table-sm table-bordered">
						<thead><tr><th>NO</th><th>GELAR</th><th class="text-end">BI. REG.</th></tr></thead>
						<tbody>';
				$n=1;
				foreach($DtGelar as $g)
				{
					?>
					<tr><td><?= $n;?></td>
						<td><?= $g->gelar;?></td>
						<td class="text-end"><?= number_format($g->biaya_reg,0,',','.');?></td>
					</tr>
					<?php
					$n++;
				}
				?>
				</tbody></table>
				<?php
			}
			?>
		</div>
	</div>	
</div>


<?php include ('adm_akhir_ctk.php'); ?>