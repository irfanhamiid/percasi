<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum mulai', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
$jk=array('L'=>'Laki-laki', 'P'=>'Perempuan');
$stbayar=array('Belum diverifikasi', 'OK', 'Salah Bayar');


include ('opr_awal_ctk.php'); ?>
<div class="container-fluid">
<h5 class="py-3 mb-4 text-center">Data Pembayaran Iuran Event <?= $DtEvent['nama_ev'];?></h5>

<div class="row mb-4">
	<div class="col-sm-8">
		<p>Pelaksanaan : <b><?= $CI->Mymodel->tgldmy($DtEvent['tgl_mulai_ev']);?></b> sampai 
			<b><?= $CI->Mymodel->tgldmy($DtEvent['tgl_selesai_ev']);?></b></p>
		<p>Batas Pendaftaran :	<b><?= $CI->Mymodel->tgldmy($DtEvent['tgl_bts_daftar']);?></b></p>
	</div>	
	<div class="col-sm-4 text-end">
		<p><b><?= $st[$DtEvent['status_ev']];?></b></p>
	</div>	
</div>
<hr/>

	<?php
	$kurang_wjb=$DtIuran['jml_wajib']-$DtIuran['byr_wajib'];
	$kurang_reg=$DtIuran['jml_registrasi']-$DtIuran['byr_registrasi'];
	$kurang_akomodasi=$DtIuran['jml_akomodasi']-$DtIuran['byr_akomodasi'];
	
	if ($JmlIuran==0)
	{
		echo '<div class="alert alert-danger">Belum ada data iuran event...</div>';
	}
	else	
	{
		
		?>
			<p class="mt-4 p-2 bg-light"><b>Data Pembayaran Iuran Wajib</b></p>
			<div class="row">
				<div class="col-sm-4">Jumlah Iuran : <span class="float-end"><b>Rp <?= number_format($DtIuran['jml_wajib'],0,',','.');?></b></span></div>
				<div class="col-sm-4">Dibayar Iuran: <span class="float-end"><b>Rp <?= number_format($DtIuran['byr_wajib'],0,',','.');?></b></span></div>
				<div class="col-sm-4">Kurang Bayar : <span class="float-end"><b>Rp <?= number_format($kurang_wjb,0,',','.');?></b></span></div>
			</div>
			
			<p class="my-4"><b>Daftar Pembayaran Iuran</b></p>
			<p class="text-danger">Pembayaran akan dianggap sah setelah divalidasi oleh Admin PB Percasi</p>
			<?php
			if ($JmlByrWjb==0)
			{
				echo '<div class="alert alert-info">Belum ada pembayaran...</div>';
			}
			else
			{
				$crtx=array('1'=>'Transfer', '2'=>'Tunai');
				?>
				 <table class="table table-bordered dtTable">
					<thead><tr><th>ID BAYAR</th><th>TANGGAL</th><th class="text-end">JUMLAH</th><th>CARA BYR</th>
					<th class="text-center">DARI</th><th class="text-center">KEPADA</th><th>STATUS PEMBAYARAN</th></tr>
					</thead>
					<tbody>
					<?php
					foreach ($DtByrWjb as $b)
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
							<td><p><?= $stbayar[$b->status_verifikasi];?></p>
							<?php
							if ($b->status_verifikasi>0)
							{
								echo '<p>Oleh : '.$b->nama_admin.'</p>';
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
		  
			<p class="mt-4 p-2 bg-light"><b>Pembayaran Registrasi</b></p>
			<div class="row">
				<div class="col-sm-4">Jumlah Registrasi : <span class="float-end"><b>Rp <?= number_format($DtIuran['jml_registrasi'],0,',','.');?></b></span></div>
				<div class="col-sm-4">Dibayar Registrasi :  <span class="float-end"><b>Rp <?= number_format($DtIuran['byr_registrasi'],0,',','.');?></b></span></div>
				<div class="col-sm-4">Kurang Bayar :  <span class="float-end"><b>Rp <?= number_format($kurang_reg,0,',','.');?></b></span></div>
			</div>
			
			<p class="my-4"><b>Daftar Pembayaran Registrasi</b></p>
			<p class="text-danger">Pembayaran akan dianggap sah setelah divalidasi oleh Admin PB Percasi</p>
			<?php
			if ($JmlByrReg==0)
			{
				echo '<div class="alert alert-info">Belum ada pembayaran...</div>';
			}
			else
			{
				$crtx=array('1'=>'Transfer', '2'=>'Tunai');
				?>
				<table class="table table-bordered dtTable">
					<thead><tr><th>ID BAYAR</th><th>TANGGAL</th><th class="text-end">JUMLAH</th><th>CARA BYR</th>
					<th class="text-center">DARI</th><th class="text-center">KEPADA</th><th>STATUS PEMBAYARAN</th></tr>
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
							<td><p><?= $stbayar[$b->status_verifikasi];?></p>
							<?php
							if ($b->status_verifikasi>0)
							{
								echo '<p>Verifikasi oleh : '.$b->nama_admin.'</p>';
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

			<p class="mt-4 p-2 bg-light"><b>Pembayaran Akomodasi</b></p>
			<div class="row">
				<div class="col-sm-4">Jumlah Akomodasi : <span class="float-end"><b>Rp <?= number_format($DtIuran['jml_akomodasi'],0,',','.');?></b></span></div>
				<div class="col-sm-4">Dibayar Akomodasi :  <span class="float-end"><b>Rp <?= number_format($DtIuran['byr_akomodasi'],0,',','.');?></b></span></div>
				<div class="col-sm-4">Kurang Bayar :  <span class="float-end"><b>Rp <?= number_format($kurang_akomodasi,0,',','.');?></b></span></div>
			</div>
			
			<p class="my-4"><b>Daftar Pembayaran Akomodasi</b></p>
			<p class="text-danger">Pembayaran akan dianggap sah setelah divalidasi oleh Admin PB Percasi</p>
			<?php
			if ($JmlByrAkomodasi==0)
			{
				echo '<div class="alert alert-info">Belum ada pembayaran...</div>';
			}
			else
			{
				$crtx=array('1'=>'Transfer', '2'=>'Tunai');
				?>
				<table class="table table-bordered dtTable">
					<thead><tr><th>ID BAYAR</th><th>TANGGAL</th><th class="text-end">JUMLAH</th><th>CARA BYR</th>
					<th class="text-center">DARI</th><th class="text-center">KEPADA</th><th>STATUS PEMBAYARAN</th></tr>
					</thead>
					<tbody>
					<?php
					foreach ($DtByrAkomodasi as $b)
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
							<td><p><?= $stbayar[$b->status_verifikasi];?></p>
							<?php
							if ($b->status_verifikasi>0)
							{
								echo '<p>Verifikasi oleh : '.$b->nama_admin.'</p>';
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
	<?php		
	}		
	?>		
</div>

<?php include ('opr_akhir_ctk.php'); ?>