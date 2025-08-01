<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
include ('adm_awal_ctk.php'); ?>

<div class="container-fluid">
	<h5 class="py-3 mb-4 text-center">DATA PEMBAYARAN IURAN EVENT </span> <?= strtoupper($DtEvent['nama_ev']);?></h5>
	
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
	if ($JmlIuran==0)
	{
		echo '<div class="alert alert-danger">Belum ada pembayaran iuran...</div>';
	}
	else	
	{
		?>
		
		<table class="table table-bordered mb-4">
			<thead><tr><th>PROVINSI</th><th class="text-end">IURAN</th>
				<th class="text-end">IURAN DIBAYAR</th><th class="text-end">KEKURANGAN IURAN</th>
				<th class="text-end">REGISTRASI</th><th class="text-end">REG. DIBAYAR</th>
				<th class="text-end">KEKURANGAN REGISTRASI</th>
				<th class="text-end">AKOMODASI</th><th class="text-end">AKOMODASI DIBAYAR</th>
				<th class="text-end">KEKURANGAN AKOMODASI</th>
				</tr></thead>
			<tbody>
			<?php
// 			foreach ($DtIuran as $k)
// 			{
				$kurang_wjb=$DtIuran['jml_wajib'] - $DtIuran['byr_wajib'];
				$kurang_reg=$DtIuran['jml_registrasi']-$DtIuran['byr_registrasi'];
				$kurang_akomodasi=$DtIuran['jml_akomodasi']-$DtIuran['byr_akomodasi'];
				?>
				<tr><td><?= $DtIuran['provinsi'];?></td>
					<td class="text-end"><?= number_format($DtIuran['jml_wajib'],0,',','.');?></td>
					<td class="text-end"><?= number_format($DtIuran['byr_wajib'], 0, ',', '.');?></td>
					<td class="text-end"><?= number_format($kurang_wjb, 0, ',', '.');?></td>
					<td class="text-end"><?= number_format($DtIuran['jml_registrasi'], 0, ',', '.');?></td>
					<td class="text-end"><?= number_format($DtIuran['byr_registrasi'], 0, ',', '.');?></td>
					<td class="text-end"><?= number_format($kurang_reg, 0, ',', '.');?></td>
					<td class="text-end"><?= number_format($DtIuran['jml_akomodasi'], 0, ',', '.');?></td>
					<td class="text-end"><?= number_format($DtIuran['byr_akomodasi'], 0, ',', '.');?></td>
					<td class="text-end"><?= number_format($kurang_akomodasi, 0, ',', '.');?></td>
					
				</tr>
				<?php
// 			}
			?>
			</tbody>
		</table>
	<?php		
	}	
	?>		
</div>

<?php include ('adm_akhir_ctk.php'); ?>