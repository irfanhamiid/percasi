<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Berjalan', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
$jk=array('L'=>'Laki-laki', 'P'=>'Perempuan');
$stbayar=array('Belum diverifikasi', 'OK', 'Salah Bayar');
$stbayar_cl=array('secondary', 'success', 'danger');

include ('opr_awal.php'); ?>

<h5 class="py-3 mb-4">Informasi Iuran Event <span class="text-info"><?= $DtEvent['nama_ev'];?></span></h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>opr/event/0" class="btn btn-danger" ><i class="mdi mdi-close"></i> Kembali</a>
    </p>
	<?php include('opr_event_info.php'); ?>
  </div>
</div>  

<div class="card mb-5">   
  <div class="card-body">
	<ul class="nav nav-tabs">
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>opr/event_detail/<?= $DtEvent['id_ev'];?>">Kategori</a>
	  </li>
	   <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>opr/event_peserta/<?= $DtEvent['id_ev'];?>">Peserta Provinsi <?= $_SESSION['NMPROV_OPR'];?></a>
	  </li>
	  
	  <li class="nav-item bg-light">
		<a class="nav-link active" aria-current="page" href=""><b>Pembayaran Iuran</b></a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>opr/event_time/<?= $DtEvent['id_ev'];?>">Timeline</a>
	  </li>
	</ul>
	
	<p class="text-end">
			<a href="<?= base_url();?>opr/event_iuran/<?= $DtEvent['id_ev'];?>/ctk" class="btn btn-info" target="_blank">
			<i class="mdi mdi-printer"></i> Cetak</a>
		</p>
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
		<p><b>Data Pembayaran:</b></p>
		
		<ul class="nav nav-tabs" id="myTab" role="tablist">
		  <li class="nav-item" role="presentation">
			<button class="nav-link active" id="wajib-tab" data-bs-toggle="tab" data-bs-target="#wajib" type="button" role="tab" aria-controls="wajib" aria-selected="true">Iuran Wajib</button>
		  </li>
		  <li class="nav-item" role="presentation">
			<button class="nav-link" id="registrasi-tab" data-bs-toggle="tab" data-bs-target="#registrasi" type="button" role="tab" aria-controls="registrasi" aria-selected="false">Bayar Registrasi</button>
		  </li>
		  <li class="nav-item" role="presentation">
			<button class="nav-link" id="akomodasi-tab" data-bs-toggle="tab" data-bs-target="#akomodasi" type="button" role="tab" aria-controls="akomodasi" aria-selected="false">Bayar Akomodasi</button>
		  </li>
		</ul>
		<div class="tab-content" id="myTabContent">
		  <div class="tab-pane fade show active" id="wajib" role="tabpanel" aria-labelledby="wajib-tab">
			<p class="mt-4"><b>Daftar Pembayaran Iuran Wajib</b></p>
			<div class="row">
				<div class="col-sm-4">Jumlah Iuran : <span class="float-end"><b>Rp <?= number_format($DtIuran['jml_wajib'],0,',','.');?></b></span></div>
				<div class="col-sm-4">Dibayar Iuran: <span class="float-end"><b>Rp <?= number_format($DtIuran['byr_wajib'],0,',','.');?></b></span></div>
				<div class="col-sm-4">Kurang Bayar : <span class="float-end"><b>Rp <?= number_format($kurang_wjb,0,',','.');?></b></span></div>
			</div>
			
			<p class="my-4"><b>Daftar Pembayaran</b></p>
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
							<td><p><span class="badge bg-<?= $stbayar_cl[$b->status_verifikasi];?>"><?= $stbayar[$b->status_verifikasi];?></span></p>
							<?php
							if ($b->status_verifikasi>0)
							{
								echo '<p>Oleh : '.$b->nama_admin.'</p>';
							}								
							?>
							<p>
								<a href="<?= base_url();?>img/bayar/<?= $b->bukti;?>" target="_blank"
									class="btn btn-xs btn-info"><i class="mdi mdi-image"></i> Bukti</a>
								
							</p>
							
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
		  <div class="tab-pane fade" id="registrasi" role="tabpanel" aria-labelledby="registrasi-tab">
			<p class="mt-4"><b>Daftar Pembayaran Registrasi</b></p>
			<div class="row">
				<div class="col-sm-4">Jumlah Registrasi : <span class="float-end"><b>Rp <?= number_format($DtIuran['jml_registrasi'],0,',','.');?></b></span></div>
				<div class="col-sm-4">Dibayar Registrasi :  <span class="float-end"><b>Rp <?= number_format($DtIuran['byr_registrasi'],0,',','.');?></b></span></div>
				<div class="col-sm-4">Kurang Bayar :  <span class="float-end"><b>Rp <?= number_format($kurang_reg,0,',','.');?></b></span></div>
			</div>
			
			<p class="my-4"><b>Daftar Pembayaran</b></p>
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
							<td><p><span class="badge bg-<?= $stbayar_cl[$b->status_verifikasi];?>"><?= $stbayar[$b->status_verifikasi];?></span></p>
							<?php
							if ($b->status_verifikasi>0)
							{
								echo '<p>Verifikasi oleh : '.$b->nama_admin.'</p>';
							}
							?>
							<p><a href="<?= base_url();?>img/bayar/<?= $b->bukti;?>" target="_blank"
								class="btn btn-xs btn-info"><i class="mdi mdi-image"></i> Bukti</a>
								
							</p>
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

		  <div class="tab-pane fade" id="akomodasi" role="tabpanel" aria-labelledby="akomodasi-tab">
			<p class="mt-4"><b>Daftar Pembayaran Akomodasi</b></p>
			<div class="row">
				<div class="col-sm-4">Jumlah Akomodasi : <span class="float-end"><b>Rp <?= number_format($DtIuran['jml_akomodasi'],0,',','.');?></b></span></div>
				<div class="col-sm-4">Dibayar Akomodasi :  <span class="float-end"><b>Rp <?= number_format($DtIuran['byr_akomodasi'],0,',','.');?></b></span></div>
				<div class="col-sm-4">Kurang Bayar :  <span class="float-end"><b>Rp <?= number_format($kurang_akomodasi,0,',','.');?></b></span></div>
			</div>
			
			<p class="my-4"><b>Daftar Pembayaran</b></p>
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
							<td><p><span class="badge bg-<?= $stbayar_cl[$b->status_verifikasi];?>"><?= $stbayar[$b->status_verifikasi];?></span></p>
							<?php
							if ($b->status_verifikasi>0)
							{
								echo '<p>Verifikasi oleh : '.$b->nama_admin.'</p>';
							}
							?>
							<p><a href="<?= base_url();?>img/bayar/<?= $b->bukti;?>" target="_blank"
								class="btn btn-xs btn-info"><i class="mdi mdi-image"></i> Bukti</a>
								<?php
								if ($b->status_verifikasi==0)
								{
									?>
										<a href="<?= base_url();?>opr/event_iuran_byr_edit/<?= $b->id_byr;?>" 
											class="btn btn-xs btn-primary" title="Edit"><i class="mdi mdi-pencil"></i></a>
										<a href="#" class="btn btn-xs btn-danger" title="Hapus"
                                                    onclick="return hapus('<?= $b->id_byr;?>','<?= $b->id_byr;?>');">
                                                    <i class="mdi mdi-trash-can"></i></a>
									<?php
								}								
								?>
							</p>
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
		  
		</div>

	<?php		
	}		
	?>		
  </div>
</div>
<script>
		function hapus(idnya, nama)
		{

			Swal.fire({
				title: 'Hapus Pembayaran ?',
				html: "Anda akan menghapus <b>" + nama + "</b> !",
				icon: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Ya',
				cancelButtonText: 'Tidak',    

			}).then((result) => {
				if (result.value) {            
				window.location.href = "<?= base_url();?>/opr/event_iuran_byr_del/" + idnya;           
				}
			})
		}
	</script>
<?php include ('opr_akhir.php'); ?>