<?php 
$CI =& get_instance();
$CI->load->model('Mymodel');

$statusev=array('Belum Mulai', 'Berjalan', 'Selesai');
$statusclr=array('secondary', 'info', 'success');

include ('adm_awal_ctk.php'); 

?>
<div class="container-fluid">
	<h5 class="py-3 mb-4 text-center">DATA PESERTA EVENT <?= strtoupper($DtEvent['nama_ev']);?><br/>
		PROVINSI <?= strtoupper($NamaProv);?></h5>
	<div class="row">
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
	if ($JmlPst==0)
	{
		echo '<div class="alert alert-danger">Belum ada data peserta ...</div>';
	}
	else
	{
		$jk=array('P'=>'Pria', 'W'=>'Wanita');
		$n=1; $idktg='-'; 
		foreach($DtPst as $p)
		{
			if ($idktg!=$p['idktg'])
			{
				?>
				<h5 class="p-2 mt-4 bg-light"><?= $p['kategori'];?></h5>
				<?php
				$idktg=$p['idktg'];
			}
			
			foreach($p['jk'] as $y)
			{
				
				
				$n=1;$idjk='-';
				?>
				<p class="my-4"><b><?= $jk[$y['jknya']];?></b>, Peserta : <b><?= number_format($y['jmlpst'],0,',','.');?></b> orang</p>
				<?php
				if ($y['jmlpst']>0)
				{
					?>
					<table class="table table-sm table-bordered">
						<thead><tr><th>NO</th><th>PROVINSI</th><th>NAMA PESERTA</th><th>UMUR</th><th>KATEGORI</th><th>GELAR</th></tr></thead>
						<tbody>
					<?php
					foreach($y['pstnya'] as $x)
					{
						?>
						<tr><td><?= $n;?></td>
							<td><?= $x['provinsi'];?></td>
							<td><?= $x['namapst'];?></td>
							<td><?= $x['umur'];?></td>
							<td><?= $x['kategori'];?></td>
							<td><?= $x['gelar'];?></td>
							
						</tr>	
					<?php
					$n++;
					}
					?>
					</tbody></table>
				<?php
				}
			}
		}
		?>
		</tbody></table>
		<p class="p-2 mt-4 bg-light">Total Peserta : <b><?= number_format($JmlPst,0,',','.');?></b></p>
		
	<?php	
	}
	?>
			
</div>
<?php include ('adm_akhir_ctk.php'); ?>