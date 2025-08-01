<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
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
	
	<p class="mt-4"><b>Data Pembayaran Iuran</b></p>
	<p class="text-end">
        <a href="<?= base_url();?>admin/kejurnas_iuran_new/<?= $DtKj['id_kj'];?>" class="btn btn-primary" ><i class="mdi mdi-cog-outline"></i> Update Tagihan</a>
    </p>
	<?php
	if ($JmlIuran==0)
	{
		echo '<div class="alert alert-danger">Belum ada pembayaran iuran...</div>';
	}
	else	
	{
		?>
		<table class="table">
			<thead><tr><th>PROVINSI</th><th class="text-end">IURAN</th>
				<th class="text-end">IURAN DIBAYAR</th><th class="text-end">KEKURANGAN IURAN</th>
				<th class="text-end">REGISTRASI</th><th class="text-end">REG. DIBAYAR</th>
				<th class="text-end">KEKURANGAN REG.</th>
				<th>AKSI</th></tr></thead>
			<tbody>
			<?php
			foreach ($DtIuran as $k)
			{
				$kurang_wjb=$k->jml_wajib-$k->byr_wajib;
				$kurang_reg=$k->jml_registrasi-$k->byr_registrasi;
				?>
				<tr><td><?= $k->provinsi;?></td>
					<td class="text-end"><?= number_format($k->jml_wajib,0,',','.');?></td>
					<td class="text-end"><?= number_format($k->byr_wajib, 0, ',', '.');?></td>
					<td class="text-end"><?= number_format($kurang_wjb, 0, ',', '.');?></td>
					<td class="text-end"><?= number_format($k->jml_registrasi, 0, ',', '.');?></td>
					<td class="text-end"><?= number_format($k->byr_registrasi, 0, ',', '.');?></td>
					<td class="text-end"><?= number_format($kurang_reg, 0, ',', '.');?></td>
					<td>
						
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

<?php include ('adm_akhir.php'); ?>