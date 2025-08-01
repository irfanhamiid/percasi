<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
$jk=array('L'=>'Laki-laki', 'P'=>'Perempuan');
$stbayar=array('Belum diverifikasi', 'OK', 'Salah Bayar');
$stbayar_cl=array('secondary', 'success', 'danger');

include ('opr_awal_ctk.php'); ?>
<div class="container">
	<h5 class="text-center" style="text-transform: uppercase;">Daftar Pembayaran Iuran Kejurnas <?= $DtKj['nama_kj'];?><br/>
		Provinsi : <?= $_SESSION['NMPROV_OPR'];?></h5>

	<div class="row">		
		<div class="col-sm-6">
			<p>Tanggal Mulai : <b><?= $CI->Mymodel->tgldmy($DtKj['tgl_mulai']);?></b> sampai <b><?= $CI->Mymodel->tgldmy($DtKj['tgl_selesai']);?></b></p>
		</div>
		<div class="col-sm-6 text-end">
			<p>Status : <b><?= $st[$DtKj['status_kj']];?></b></p>
		</div>
	</div>
	
	<?php
	$kurang_wjb=$DtIuran['jml_wajib']-$DtIuran['byr_wajib'];
	$kurang_reg=$DtIuran['jml_registrasi']-$DtIuran['byr_registrasi'];
	
	if ($JmlIuran==0)
	{
		echo '<div class="alert alert-danger">Belum ada data iuran  pertandingan...</div>';
	}
	else	
	{
		
		?>
		
		<p class="mt-4 p-2 bg-light"><b>Daftar Pembayaran Iuran Wajib</b></p>
		<div class="row mb-4">
			<div class="col-sm-4">Jumlah Iuran : <span class="float-end"><b>Rp <?= number_format($DtIuran['jml_wajib'],0,',','.');?></b></span></div>
			<div class="col-sm-4">Dibayar Iuran: <span class="float-end"><b>Rp <?= number_format($DtIuran['byr_wajib'],0,',','.');?></b></span></div>
			<div class="col-sm-4">Kurang Bayar : <span class="float-end"><b>Rp <?= number_format($kurang_wjb,0,',','.');?></b></span></div>
		</div>
		<?php
		if ($JmlByrWjb==0)
		{
			echo '<div class="alert alert-info">Belum ada pembayaran...</div>';
		}
		else
		{
			$crtx=array('1'=>'Transfer', '2'=>'Tunai');
			?>
			<table class="table table-bordered">
				<thead><tr><th>ID BAYAR</th><th>TANGGAL</th><th class="text-end">JUMLAH</th><th>CARA BYR</th>
				<th colspan="2" class="text-center">KETERANGAN</th><th>STATUS</th></tr>
				</thead>
				<tbody>
				<?php
				foreach ($DtByrWjb as $b)
				{
				?>
					<tr><td><?= $b->id_byr;?></td>
						<td><?= $CI->Mymodel->tgldmy($b->tgl_bayar);?></td>
						<td class="text-end"><?= number_format($b->jml_bayar,0,',','.');?></td>
						<td><?php if ($b->cara_byr==1)  { echo 'Transfer Bank'; } else { echo 'Tunai'; }?>
						<td>
						<?php
						if ($b->cara_byr==1)
						{
							echo '<p>Dari Bank : '.$b->dari_bank.'<br/>
									No Rekening : '.$b->dari_rek.'<br/>
									Atas Nama : '.$b->nama_pembayar.'</p>';
							
						}
						else
						{
							echo '<p>Cara Bayar : <b>Tunai</b></p>';
							echo '<p>Penerima : '.$b->nama_pembayar.'</p>';
							
						}
						echo '<p>Catatan:<br/>'.$b->note_pembayar.'</p>';
						
						?>
						</td>
						<td>
						<?php
						if ($b->cara_byr==1)
						{
							echo '<p>Ke Bank : '.$b->ke_bank.'<br/>
									No Rekening : '.$b->ke_rek.'<br/>
									Atas Nama : '.$b->nama_penerima.'</p>';
							
						}
						else
						{
							echo '<p>Cara Bayar : <b>Tunai</b></p>';
							echo '<p>Penerima : '.$b->nama_penerima.'</p>';
							
						}
						echo '<p>Catatan:<br/>'.$b->note_penerima.'</p>';
						?>
						</td>
						<td><p><span class="badge bg-<?= $stbayar_cl[$b->status_verifikasi];?>"><?= $stbayar[$b->status_verifikasi];?></span></p>
						<?php
						if ($b->status_verifikasi>0)
						{
							echo '<p>Oleh : '.$b->nama_adm.'</p>';
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
		
		<p class="mt-4 p-2 bg-light"><b>Daftar Pembayaran Registrasi</b></p>
		<div class="row mb-4">
			<div class="col-sm-4">Jumlah Registrasi : <span class="float-end"><b>Rp <?= number_format($DtIuran['jml_registrasi'],0,',','.');?></b></span></div>
			<div class="col-sm-4">Dibayar Registrasi :  <span class="float-end"><b>Rp <?= number_format($DtIuran['byr_registrasi'],0,',','.');?></b></span></div>
			<div class="col-sm-4">Kurang Bayar :  <span class="float-end"><b>Rp <?= number_format($kurang_reg,0,',','.');?></b></span></div>
		</div>
			
		
		<?php
		if ($JmlByrReg==0)
		{
			echo '<div class="alert alert-info">Belum ada pembayaran...</div>';
		}
		else
		{
			$crtx=array('1'=>'Transfer', '2'=>'Tunai');
			?>
			<table class="table table-bordered">
				<thead><tr><th>ID BAYAR</th><th>TANGGAL</th><th class="text-end">JUMLAH</th><th>CARA BYR</th><th colspan="2">KETERANGAN</th><th>STATUS</th></tr>
				</thead>
				<tbody>
				<?php
				foreach ($DtByrReg as $b)
				{
				?>
					<tr><td><?= $b->id_byr;?></td><td><?= $b->tgl_bayar;?></td>
						<td class="text-end"><?= number_format($b->jml_bayar,0,',','.');?></td>
						<td><?php if ($b->cara_byr==1)  { echo 'Transfer Bank'; } else { echo 'Tunai'; }?>
						<td>
						<?php
						if ($b->cara_byr==1)
						{
							echo '<p>Dari Bank : '.$b->dari_bank.'<br/>
									No Rekening : '.$b->dari_rek.'<br/>
									Atas Nama : '.$b->nama_pembayar.'</p>';
							
						}
						else
						{
							echo '<p>Pembayar : '.$b->nama_pembayar.'</p>';
							
						}
						echo '<p>Catatan:<br/>'.$b->note_pembayar.'</p>';
						
						?>
						</td>
						<td>
						<?php
						if ($b->cara_byr==1)
						{
							echo '<p>Ke Bank : '.$b->ke_bank.'<br/>
									No Rekening : '.$b->ke_rek.'<br/>
									Atas Nama : '.$b->nama_penerima.'</p>';
							
						}
						else
						{
							echo '<p>Penerima : '.$b->nama_penerima.'</p>';
							
						}
						echo '<p>Catatan:<br/>'.$b->note_penerima.'</p>';
						?>
						</td>
						<td><p><span class="badge bg-<?= $stbayar_cl[$b->status_verifikasi];?>"><?= $stbayar[$b->status_verifikasi];?></span></p>
						<?php
						if ($b->status_verifikasi>0)
						{
							echo '<p>Verifikasi oleh : '.$b->nama_adm.'</p>';
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
		<p><em>Catatan : <br/>Untuk memudahkan verifikasi, dimohon Pengurus Provinsi tidak mencampur pembayaran iuran dan biaya registrasi !</em></p>
	<?php		
	}		
	?>	
</div>
<?php include ('opr_akhir_ctk.php'); ?>