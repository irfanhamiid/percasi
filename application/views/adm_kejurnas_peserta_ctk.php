<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Berjalan', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
$jk=array('L'=>'Laki-laki', 'P'=>'Perempuan');
$clbar=array('info', 'succsess', 'primary', 'warning', 'secondary', 'danger');
include ('adm_awal_ctk.php'); ?>

<div class="container-fluid">
	<h5 class="py-3 mb-4 text-center">Data Peserta Kejurnas <?= $DtKj['nama_kj'];?><br/>Provinsi : <?= $NamaProv;?></h5>

	<div class="row">
		<div class="col-sm-4">
			<p>Tanggal Mulai : <b><?= $CI->Mymodel->tgldmy($DtKj['tgl_mulai']);?></b> sampai 
				<b><?= $CI->Mymodel->tgldmy($DtKj['tgl_selesai']);?></b></p>
		</div><div class="col-sm-4 text-center">
			<p>Status : <b><?= $st[$DtKj['status_kj']];?></b></p>
		</div>
		<div class="col-sm-4 text-end">
			<p>Batas Pendaftaran : <b><?= $CI->Mymodel->tgldmy($DtKj['tgl_max_daftar']);?></b></p>
		</div>
	</div>		
		
			
	<?php
	if ($JmlPst==0)
	{
	echo '<div class="alert alert-danger">Belum ada peserta pertandingan...</div>';
	}
	else	
	{
	?>

		<?php
		$gl='-'; $jmlgl=0; $jmlall=0; $n=1;
		$jmlby=0; $jmlbyall=0; $clnya=0;

		foreach ($DtPst as $k)
		{
			
			if ($gl!=$k->id_ktg_kj)
			{
				if ($gl!='-')
				{
					?>
					
					</tbody>
					<tfoot>
						<tr><th colspan="7" class="text-end">Jumlah</th>
							<th class="text-end"><?= number_format($jmlby,0,',','.');?></th>
						</tr>						
					</tfoot>
					</table>
					<p class="text-end"><b>Jumlah Peserta : <?= number_format($jmlgl,0,',','.');?></b></p>
					<?php
				}
				?>
				<p class="bg-light p-2"><b><?= $k->kategori;?></b></p>

				<table class="table">
				<thead><tr><th>NO</th><th>PESERTA</th><th>NIK</th><th>TGL LAHIR</th><th class="text-end">UMUR</th>
					<th>JENIS KEL.</th><th>GELAR</th><th class="text-end">BIAYA REG.</th>
					</tr></thead>
				<tbody>
				<?php
				$gl=$k->id_ktg_kj; $jmlgl=0; $n=1; $jmlby=0;
				$clnya++;
				if ($clnya>1) { $clnya=0; } 
			}
			?>
			<tr><td><?= $n;?></td><td><?= $k->nama_pst;?></td>
				<td><?= $k->nik;?></td>
				<td><?= $k->tgl_lahir;?></td>
				<td class="text-end"><?= $k->umur;?></td>
				<td><?= $jk[$k->jk_pst];?></td>
				<td><?= $k->gelar;?></td>
				<td class="text-end"><?= number_format($k->biaya_reg,0,',','.');?></td>
				
			</tr>
			<?php
			$jmlgl++; $jmlall++; $n++; $jmlby+=$k->biaya_reg; $jmlbyall+=$k->biaya_reg;
			
		}
		?>
				</tbody>
				<tfoot>
					<tr><th colspan="7" class="text-end">Jumlah</th>
						<th class="text-end"><?= number_format($jmlby,0,',','.');?></th>
					</tr>						
				</tfoot>
			</table>
			<p class="text-end"><b>Jumlah Peserta : <?= number_format($jmlgl,0,',','.');?></b></p>
			
		<div class="row mt-32">
			<div class="col-sm-6 bg-light pt-2">
				<p><b>Jumlah Seluruh Peserta : <?= number_format($jmlall,0,',','.');?></b></p>
			</div>
			<div class="col-sm-6 bg-light text-end pt-2">
				<p><b>Jumlah Biaya Registrasi : <?= number_format($jmlbyall,0,',','.');?></b></p>
			</div>	
		</div>
	<?php		
	}		
	?>		
</div>
<?php include ('adm_akhir_ctk.php'); ?>