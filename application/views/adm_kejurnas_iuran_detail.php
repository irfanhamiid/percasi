<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
$stbayar=array('Belum diverifikasi', 'Sudah diverifikasi');
$stbayarcl=array('secondary', 'success');
include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Informasi Kejurnas</h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>admin/kejurnas" class="btn btn-danger" ><i class="mdi mdi-close"></i> Batal</a>
    </p>
	<div class="row">
		<div class="col-sm-6">
			<h5>Kejurnas : <?= $DtKj['nama_kj'];?></h5>
			<p>
				<a href="<?= base_url();?>img/poster/<?= $DtKj['id_kj'];?>.jpg" class="btn btn-success" 
					target="_blank"><i class="mdi mdi-image"></i> Poster</a>
				<a href="<?= base_url();?>pdf/kejurnas/<?= $DtKj['id_kj'];?>.pdf" class="btn btn-success" 
					target="_blank"><i class="mdi mdi-file-pdf-box"></i> Proposal</a>
			</p>
		</div>
		<div class="col-sm-6 text-end">
			<p>Tanggal Mulai : <b><?= $CI->Mymodel->tgldmy($DtKj['tgl_mulai']);?></b> sampai <b><?= $CI->Mymodel->tgldmy($DtKj['tgl_selesai']);?></b><p>
			<p>Batas Pendaftaran : <b><?= $CI->Mymodel->tgldmy($DtKj['tgl_max_daftar']);?></b> <p>
			<p>Status : 
			<span class="badge bg-<?= $cl[$DtKj['status_kj']];?>"><?= $st[$DtKj['status_kj']];?></span></p>
		</div>
	</div>
  </div>
</div>
<div class="card mb-5">   
  <div class="card-body">
	<ul class="nav nav-tabs">
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/kejurnas_detail/<?= $DtKj['id_kj'];?>">Kategori</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link active"  aria-current="page" href="#">Pembayaran Iuran</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/kejurnas_peserta/<?= $DtKj['id_kj'];?>">Peserta</a>
	  </li>
	</ul>
	
	<p class="mt-4">Data Pembayaran Iuran  Provinsi : <b><?= $DtIuran['provinsi'];?></b></p>
	<p class="text-end">
		<a href="<?= base_url();?>admin/kejurnas_iuran_byr_new/<?= $DtIuran['id_iuran_kj'];?>"
			class="btn btn-info"><i class="mdi mdi-plus"></i> Tambah Pembayaran</a>
		<a href="<?= base_url();?>admin/kejurnas_iuran_detail/<?= $DtIuran['id_iuran_kj'];?>/ctk" target="_blank"		
			class="btn btn-info"><i class="mdi mdi-printer"></i> Cetak</a>
		<a href="<?= base_url();?>admin/kejurnas_iuran/<?= $DtIuran['id_kj'];?>/scr"
		class="btn btn-danger"><i class="mdi mdi-close"></i> Kembali</a>
	</p>
		
	<?php	
		$kurang_reg=$DtIuran['jml_registrasi']-$DtIuran['byr_registrasi'];
		$kurang_wjb=$DtIuran['jml_wajib']-$DtIuran['byr_wajib'];
	?>	
	<div class="row">
		<div class="col-sm-6">
			<p><b>IURAN</b></p>
			<p>Jumlah Iuran: <span class="float-end"><b><?= number_format($DtIuran['jml_wajib'],0,',','.');?></b></span></p>
			<p>Dibayar: <span class="float-end"><b><?= number_format($DtIuran['byr_wajib'],0,',','.');?></b></span></p>
			<p>Kurang Bayar: <span class="float-end"><b><?= number_format($kurang_wjb,0,',','.');?></b></span></p>
			<hr/>
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
								<div class="btn-group">
								  <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Aksi</button>
								  <ul class="dropdown-menu">
									<li><a class="dropdown-item" 
										href="<?= base_url();?>admin/kejurnas_iuran_byr_detail/<?= $k->id_byr;?>/scr">
										<i class="mdi mdi-magnify"></i> Detail</a></li>
									<?php
									if ($k->status_verifikasi==0)
									{
										?>
										<li><a class="dropdown-item" 
											href="<?= base_url();?>admin/kejurnas_iuran_byr_edit/<?= $k->id_byr;?>">
											<i class="mdi mdi-pencil"></i> Edit</a></li>
										<li><a class="dropdown-item" 
											href="<?= base_url();?>admin/kejurnas_iuran_byr_verdo/<?= $k->id_byr;?>">
											<i class="mdi mdi-check"></i> Verifikasi</a></li>
										<li>
											<a href="#" class="dropdown-item text-danger"  title="Hapus"
                                                    onclick="return hapus('<?= $k->id_byr;?>','<?= $k->tgl_bayar;?>, sebesar <?= number_format($k->jml_bayar,0,',','.');?>');">
                                                    <i class="mdi mdi-trash-can"></i> Hapus</a></li>
										<?php
									}
									if (($_SESSION['TP_ADMIN']==3) && ($k->status_verifikasi==1) )
									{
										?>
										<li><a class="dropdown-item" 
											href="<?= base_url();?>admin/kejurnas_iuran_byr_unver/<?= $k->id_byr;?>">
											<i class="mdi mdi-cancel"></i> Batalkan verifikasi</a></li>
										<?php
									}
									?>	
								  </ul>
								</div>
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
		<div class="col-sm-6">
			<p><b>REGISTRASI</b></p>
			<p>Jumlah Iuran: <span class="float-end"><b><?= number_format($DtIuran['jml_registrasi'],0,',','.');?></b></span></p>
			<p>Dibayar: <span class="float-end"><b><?= number_format($DtIuran['byr_registrasi'],0,',','.');?></b></span></p>
			<p>Kurang Bayar: <span class="float-end"><b><?= number_format($kurang_reg,0,',','.');?></b></span></p>
			
			
			<hr/>
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
								<div class="btn-group">
								  <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Aksi</button>
								  <ul class="dropdown-menu">
									<li><a class="dropdown-item" 
										href="<?= base_url();?>admin/kejurnas_iuran_byr_detail/<?= $k->id_byr;?>/scr">
										<i class="mdi mdi-magnify"></i> Detail</a></li>
										<?php
										if ($k->status_verifikasi==0)
										{
											?>
											<li><a class="dropdown-item" 
												href="<?= base_url();?>admin/kejurnas_iuran_byr_edit/<?= $k->id_byr;?>">
												<i class="mdi mdi-pencil"></i> Edit</a></li>
											<li><a class="dropdown-item" 
												href="<?= base_url();?>admin/kejurnas_iuran_byr_verdo/<?= $k->id_byr;?>">
												<i class="mdi mdi-check"></i> Verifikasi</a></li>
											<li>
												<a href="#" class="dropdown-item text-danger"  title="Hapus"
                                                    onclick="return hapus('<?= $k->id_byr;?>','<?= $k->tgl_bayar;?>, sebesar <?= number_format($k->jml_bayar,0,',','.');?>');">
                                                    <i class="mdi mdi-trash-can"></i> c</a>
											
										
											</li>
											<?php
										}
										if (($_SESSION['TP_ADMIN']==3) && ($k->status_verifikasi==1) )
										{
											?>
											<li><a class="dropdown-item" 
												href="<?= base_url();?>admin/kejurnas_iuran_byr_unver/<?= $k->id_byr;?>">
												<i class="mdi mdi-cancel"></i> Batalkan verifikasi</a></li>
											<?php
										}
										?>	
								  </ul>
								</div>
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
			window.location.href = "<?= base_url();?>admin/kejurnas_iuran_byr_del/" + idnya;           
			}
		})
	}
</script>
<?php include ('adm_akhir.php'); ?>