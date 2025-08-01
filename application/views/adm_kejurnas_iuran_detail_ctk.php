<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
$stbayar=array('Belum diverifikasi', 'Sudah diverifikasi');
$stbayarcl=array('secondary', 'success');
include ('adm_awal_ctk.php'); ?>

<div class="container-fluid">
<h5 class="mb-4 text-center">Data Pembayaran Iuran dan Registratsi<br/>Kejurnas : <?= $DtKj['nama_kj'];?>
	Provinsi : <?= $DtIuran['provinsi'];?></h5>
<div class="row">
	<div class="col-sm-4">
		<p>Tanggal Mulai : <b><?= $CI->Mymodel->tgldmy($DtKj['tgl_mulai']);?></b> sampai <b><?= $CI->Mymodel->tgldmy($DtKj['tgl_selesai']);?></b><p>
	</div>
	<div class="col-sm-4 text-center">
		<p>Batas Pendaftaran : <b><?= $CI->Mymodel->tgldmy($DtKj['tgl_max_daftar']);?></b> <p>
	</div>	
	<div class="col-sm-4 text-end">
			<p>Status : <b><?= $st[$DtKj['status_kj']];?></b></p>
	</div>
  
</div>

	<p class="mt-4"><b>Data Pembayaran Iuran</b></p>
	
	<?php	
		$kurang_reg=$DtIuran['jml_registrasi']-$DtIuran['byr_registrasi'];
		$kurang_wjb=$DtIuran['jml_wajib']-$DtIuran['byr_wajib'];
	?>	
	<div class="row">
		<div class="col-sm-4">		
			<p>Jumlah Iuran: <span class="float-end"><b><?= number_format($DtIuran['jml_wajib'],0,',','.');?></b></span></p>
		</div>
		<div class="col-sm-4">				
			<p>Dibayar: <span class="float-end"><b><?= number_format($DtIuran['byr_wajib'],0,',','.');?></b></span></p>
		</div>
		<div class="col-sm-4">				
			<p>Kurang Bayar: <span class="float-end"><b><?= number_format($kurang_wjb,0,',','.');?></b></span></p>
		</div>
	</div>	
	<hr/>
	<?php
	if ($JmlWajibByr==0)
	{
		echo '<p class="p-2 bg-light">Belum ada pembayaran iuran...</p>';
	}
	else	
	{
		?>
		<table class="table">
			<thead><tr><th>NO</th><th>TGL. BAYAR</th><th class="text-end">JML BAYAR</th><th>STATUS</th>
				</tr></thead>
			<tbody>
			<?php
			$n=1;
			foreach ($DtWajibByr as $k)
			{
				?>
				<tr><td><?= $n;?></td>
					<td><?= $CI->Mymodel->tgldmy($k->tgl_bayar);?></td>
					<td class="text-end"><?= number_format($k->jml_bayar,0,',','.');?></td>
					<td><span class="badge bg-<?= $stbayarcl[$k->status_verifikasi];?>">
						<?= $stbayar[$k->status_verifikasi];?></span>
						<?php
						if ($k->status_verifikasi==1)
						{
							echo '<br/> Oleh : '.$k->nama_admin.' Tgl : '.$k->tgl_verifikasi;
						}
						?>	
					</td>
					
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
		<?php
	}
	?>
	<hr/>
	<p><b>Data Pembayaran Registrasi</b></p>
	<div class="row">
		<div class="col-sm-4">		
			<p>Jumlah Iuran: <span class="float-end"><b><?= number_format($DtIuran['jml_registrasi'],0,',','.');?></b></span></p>
		</div>
		<div class="col-sm-4">		
			<p>Dibayar: <span class="float-end"><b><?= number_format($DtIuran['byr_registrasi'],0,',','.');?></b></span></p>
		</div>
		<div class="col-sm-4">		
			<p>Kurang Bayar: <span class="float-end"><b><?= number_format($kurang_reg,0,',','.');?></b></span></p>
		</div>
	</div>	
		
	<?php
	if ($JmlRegistrasiByr==0)
	{
		echo '<p class="p-2 bg-light">Belum ada pembayaran iuran...</p>';
	}
	else	
	{
		?>
		<table class="table">
			<thead><tr><th>NO</th><th>TGL. BAYAR</th><th class="text-end">JML BAYAR</th><th>STATUS</th>
				</tr></thead>
			<tbody>
			<?php
			$n=1;
			foreach ($DtRegistrasiByr as $k)
			{
				?>
				<tr><td><?= $n;?></td>
					<td><?= $CI->Mymodel->tgldmy($k->tgl_bayar);?></td>
					<td class="text-end"><?= number_format($k->jml_bayar,0,',','.');?></td>
					<td><span class="badge bg-<?= $stbayarcl[$k->status_verifikasi];?>">
						<?= $stbayar[$k->status_verifikasi];?></span>
						<?php
						if ($k->status_verifikasi==1)
						{
							echo '<br/> Oleh : '.$k->nama_admin.' Tgl : '.$k->tgl_verifikasi;
						}
						?>	
					</td>
					
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