<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
$stbayar=array('Belum diverifikasi', 'Sudah diverifikasi');
$stbayarcl=array('secondary', 'success');
include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4"><span class="text-muted">Penerimaan Iuran Event</span> <?= $DtEvent['nama_ev'];?></h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">		
		<a href="<?= base_url();?>admin/event_iuran/<?= $DtIuran['id_ev'];?>/scr"
		class="btn btn-warning"><i class="mdi mdi-close"></i> Kembali</a>
    </p>
	<hr/>
	<?php include('adm_event_info.php'); ?>
  </div>
</div>
<div class="card mb-5">   
  <div class="card-body">
	<ul class="nav nav-tabs">
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_detail/<?= $DtEvent['id_ev'];?>">Kategori dan Gelar</a>		
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_peserta/<?= $DtEvent['id_ev'];?>">Peserta</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_time/<?= $DtEvent['id_ev'];?>">Time Line</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link active" aria-current="page" ><b>Penerimaan Iuran/Registrasi</b></a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_penlain/<?= $DtEvent['id_ev'];?>">Penerimaan Lain</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_kaskeluar/<?= $DtEvent['id_ev'];?>">Pengeluaran Kas</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_keuangan/<?= $DtEvent['id_ev'];?>">Keuangan</a>
	  </li> 
	</ul>
	
	<p class="mt-4">Data Pembayaran Iuran  Provinsi : <b><?= $DtIuran['provinsi'];?></b></p>
	<p class="text-end">
		<?php
		if ($DtEvent['status_ev']==0)
		{
			?>
		<a href="<?= base_url();?>admin/event_iuran_byr_new/<?= $DtIuran['id_iuran_ev'];?>"
			class="btn btn-info"><i class="mdi mdi-plus"></i> Tambah Pembayaran</a>
		<?php
		}
		?>		
		<a href="<?= base_url();?>admin/event_iuran_detail/<?= $DtIuran['id_iuran_ev'];?>/ctk" target="_blank"		
			class="btn btn-info"><i class="mdi mdi-printer"></i> Cetak</a>
		
	</p>
	
	<?php	
		$kurang_reg=$DtIuran['jml_registrasi']-$DtIuran['byr_registrasi'];
		$kurang_wjb=$DtIuran['jml_wajib']-$DtIuran['byr_wajib'];
		$kurang_akom=$DtIuran['jml_akomodasi']-$DtIuran['byr_akomodasi'];
	?>	
	
		<p class="p-2 bg-light"><b>IURAN WAJIB</b></p>
		<div class="row mb-4">
			<div class="col-sm-4">
				Jumlah Iuran: <span class="float-end"><b><?= number_format($DtIuran['jml_wajib'],0,',','.');?></b></span>
			</div>
			<div class="col-sm-4">
				Dibayar: <span class="float-end"><b><?= number_format($DtIuran['byr_wajib'],0,',','.');?></b></span>
			</div>
			<div class="col-sm-4">
				Kurang Bayar: <span class="float-end"><b><?= number_format($kurang_wjb,0,',','.');?></b></span>
			</div>
		</div>
		
		<?php
		if ($JmlWajibByr==0)
		{
			echo '<div class="alert alert-danger">Belum ada pembayaran iuran...</div>';
		}
		else	
		{
			?>
			<table class="table">
				<thead><tr><th>NO</th><th>TGL. BAYAR</th><th class="text-end">JML BAYAR</th><th>STATUS</th>
					<th>AKSI</th></tr></thead>
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
								echo '<br/> Oleh : '.$k->nama_admin;
							}
							?>	
						</td>
						<td>
							
							<?php
							if ($DtEvent['status_ev']!=2)
							{
								?>
								<div class="btn-group">
								  
								  <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Aksi</button>
								  <ul class="dropdown-menu">
									<li><a class="dropdown-item" 
										href="<?= base_url();?>admin/event_iuran_byr_detail/<?= $k->id_byr;?>/scr">
										<i class="mdi mdi-magnify"></i> Detail</a></li>
									<?php
									if ($k->status_verifikasi==0)
									{
										?>
										<li><a class="dropdown-item" 
											href="<?= base_url();?>admin/event_iuran_byr_edit/<?= $k->id_byr;?>">
											<i class="mdi mdi-pencil"></i> Edit</a></li>
										<li><a class="dropdown-item" 
											href="<?= base_url();?>admin/event_iuran_byr_verdo/<?= $k->id_byr;?>">
											<i class="mdi mdi-check"></i> Verifikasi</a></li>
											<?php if($_SESSION['TP_ADMIN']==3) { ?>
										<li>
											<a href="#" class="dropdown-item text-danger"  title="Hapus"
											onclick="return hapus('<?= $k->id_byr;?>','<?= $k->tgl_bayar;?>, sebesar 
											<?= number_format($k->jml_bayar,0,',','.');?>');">
													<i class="mdi mdi-trash-can"></i> Hapus</a></li>
													<?php } ?>
										<?php
									}
									if (($_SESSION['TP_ADMIN']==3) && ($k->status_verifikasi==1) )
									{
										?>
										<li><a class="dropdown-item" 
											href="<?= base_url();?>admin/event_iuran_byr_unver/<?= $k->id_byr;?>">
											<i class="mdi mdi-cancel"></i> Batalkan verifikasi</a></li>
										<?php
									}
									?>	
								  </ul>
								</div>
							<?php
							}
							else
							{
								?>
								<a class="btn btn-info btn-xs" 
									href="<?= base_url();?>admin/event_iuran_byr_detail/<?= $k->id_byr;?>/scr">
									<i class="mdi mdi-magnify"></i> Detail</a>
								<?php
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
		
		<p class="p-2 bg-light"><b>REGISTRASI</b></p>
		<div class="row mb-4">
			<div class="col-sm-4">
				Jumlah Iuran: <span class="float-end"><b><?= number_format($DtIuran['jml_registrasi'],0,',','.');?></b></span>
			</div>	
			<div class="col-sm-4">
				Dibayar: <span class="float-end"><b><?= number_format($DtIuran['byr_registrasi'],0,',','.');?></b></span>
			</div>	
			<div class="col-sm-4">
				Kurang Bayar: <span class="float-end"><b><?= number_format($kurang_reg,0,',','.');?></b></span>
			</div>	
		</div>	
		
		<?php
		if ($JmlRegistrasiByr==0)
		{
			echo '<div class="alert alert-danger">Belum ada pembayaran iuran...</div>';
		}
		else	
		{
			?>
			<table class="table">
				<thead><tr><th>NO</th><th>TGL. BAYAR</th><th class="text-end">JML BAYAR</th><th>STATUS</th>
					<th>AKSI</th></tr></thead>
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
								echo '<br/> Oleh : '.$k->nama_admin;
							}
							?>	
						</td>
						<td>
							<?php
							if ($DtEvent['status_ev']!=2)
							{
								?>
								<div class="btn-group">
								  <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Aksi</button>
								  <ul class="dropdown-menu">
									<li><a class="dropdown-item" 
										href="<?= base_url();?>admin/event_iuran_byr_detail/<?= $k->id_byr;?>/scr">
										<i class="mdi mdi-magnify"></i> Detail</a></li>
										<?php
										if ($k->status_verifikasi==0)
										{
											?>
											<li><a class="dropdown-item" 
												href="<?= base_url();?>admin/event_iuran_byr_edit/<?= $k->id_byr;?>">
												<i class="mdi mdi-pencil"></i> Edit</a></li>
											<li><a class="dropdown-item" 
												href="<?= base_url();?>admin/event_iuran_byr_verdo/<?= $k->id_byr;?>">
												<i class="mdi mdi-check"></i> Verifikasi</a></li>
												<?php if($_SESSION['TP_ADMIN'] == 3) { ?>
											<li>
												<a href="#" class="dropdown-item text-danger"  title="Hapus"
													onclick="return hapus('<?= $k->id_byr;?>','<?= $k->tgl_bayar;?>, sebesar <?= number_format($k->jml_bayar,0,',','.');?>');">
													<i class="mdi mdi-trash-can"></i> Hapus</a>
											
										
											</li>
											<?php } ?>
											<?php
										}
										if (($_SESSION['TP_ADMIN']==3) && ($k->status_verifikasi==1) )
										{
											?>
											<li><a class="dropdown-item" 
												href="<?= base_url();?>admin/event_iuran_byr_unver/<?= $k->id_byr;?>">
												<i class="mdi mdi-cancel"></i> Batalkan verifikasi</a></li>
											<?php
										}
										?>	
								  </ul>
								</div>
							<?php
							}
							else
							{
								?>
								<a class="btn btn-info btn-xs" 
									href="<?= base_url();?>admin/event_iuran_byr_detail/<?= $k->id_byr;?>/scr">
									<i class="mdi mdi-magnify"></i> Detail</a>
								<?php
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

		<p class="p-2 bg-light"><b>AKOMODASI</b></p>
		<div class="row mb-4">
			<div class="col-sm-4">
				Jumlah Iuran: <span class="float-end"><b><?= number_format($DtIuran['jml_akomodasi'],0,',','.');?></b></span>
			</div>	
			<div class="col-sm-4">
				Dibayar: <span class="float-end"><b><?= number_format($DtIuran['byr_akomodasi'],0,',','.');?></b></span>
			</div>	
			<div class="col-sm-4">
				Kurang Bayar: <span class="float-end"><b><?= number_format($kurang_akom,0,',','.');?></b></span>
			</div>	
		</div>	
		
		<?php
		if ($JmlAkomodasiByr==0)
		{
			echo '<div class="alert alert-danger">Belum ada pembayaran iuran...</div>';
		}
		else	
		{
			?>
			<table class="table">
				<thead><tr><th>NO</th><th>TGL. BAYAR</th><th class="text-end">JML BAYAR</th><th>STATUS</th>
					<th>AKSI</th></tr></thead>
				<tbody>
				<?php
				$n=1;
				foreach ($DtAkomodasiByr as $k)
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
								echo '<br/> Oleh : '.$k->nama_admin;
							}
							?>	
						</td>
						<td>
							<?php
							if ($DtEvent['status_ev']!=2)
							{
								?>
								<div class="btn-group">
								  <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Aksi</button>
								  <ul class="dropdown-menu">
									<li><a class="dropdown-item" 
										href="<?= base_url();?>admin/event_iuran_byr_detail/<?= $k->id_byr;?>/scr">
										<i class="mdi mdi-magnify"></i> Detail</a></li>
										<?php
										if ($k->status_verifikasi==0)
										{
											?>
											<li><a class="dropdown-item" 
												href="<?= base_url();?>admin/event_iuran_byr_edit/<?= $k->id_byr;?>">
												<i class="mdi mdi-pencil"></i> Edit</a></li>
											<li><a class="dropdown-item" 
												href="<?= base_url();?>admin/event_iuran_byr_verdo/<?= $k->id_byr;?>">
												<i class="mdi mdi-check"></i> Verifikasi</a></li>
												<?php if($_SESSION['TP_ADMIN'] == 3) { ?>
											<li>
												<a href="#" class="dropdown-item text-danger"  title="Hapus"
													onclick="return hapus('<?= $k->id_byr;?>','<?= $k->tgl_bayar;?>, sebesar <?= number_format($k->jml_bayar,0,',','.');?>');">
													<i class="mdi mdi-trash-can"></i> Hapus</a>
											
										
											</li>
											<?php } ?>
											<?php
										}
										if (($_SESSION['TP_ADMIN']==3) && ($k->status_verifikasi==1) )
										{
											?>
											<li><a class="dropdown-item" 
												href="<?= base_url();?>admin/event_iuran_byr_unver/<?= $k->id_byr;?>">
												<i class="mdi mdi-cancel"></i> Batalkan verifikasi</a></li>
											<?php
										}
										?>	
								  </ul>
								</div>
							<?php
							}
							else
							{
								?>
								<a class="btn btn-info btn-xs" 
									href="<?= base_url();?>admin/event_iuran_byr_detail/<?= $k->id_byr;?>/scr">
									<i class="mdi mdi-magnify"></i> Detail</a>
								<?php
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
</div>
<script>
	function hapus(idnya, nama)
	{

		Swal.fire({
			title: 'Hapus Pembayaran ?',
			html: "Anda akan menghapus pembayaran tanggal <b>" + nama + "</b> !",
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak',    

		}).then((result) => {
			if (result.value) {            
			window.location.href = "<?= base_url();?>admin/event_iuran_byr_del/" + idnya;           
			}
		})
	}
</script>
<?php include ('adm_akhir.php'); ?>