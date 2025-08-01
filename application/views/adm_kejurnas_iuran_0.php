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
		<a class="nav-link active"  aria-current="page" href="#">Penerimaan Iuran</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/kejurnas_kaskeluar/<?= $DtKj['id_kj'];?>">Pengeluaran Kas</a>
	  </li> 
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/kejurnas_peserta/<?= $DtKj['id_kj'];?>">Peserta</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/kejurnas_time/<?= $DtKj['id_kj'];?>">Time Line</a>
	  </li>
	</ul>
	
	<p class="mt-4">Data Pembayaran Iuran</p>
	<p class="text-end">
				<a href="<?= base_url();?>admin/kejurnas_iuran_upd/<?= $DtKj['id_kj'];?>" class="btn btn-primary" ><i class="mdi mdi-cog-outline"></i> Update Penerimaan</a>
			</p>
	<?php
	if ($JmlIuran==0)
	{
		echo '<div class="alert alert-danger">Belum ada pembayaran iuran...</div>';
	}
	else	
	{
		?>
		<style>
			.my_bg1 { background-color: #e2f0fd!important; }
			.my_bg2 { background-color: #faffe3!important; }
		</style>	
		<table class="table mb-4">
			<thead><tr><th>PROVINSI</th><th class="text-end my_bg1">IURAN</th>
				<th class="text-end my_bg1">IURAN DIBAYAR</th><th class="text-end my_bg1">KEKURANGAN IURAN</th>
				<th class="text-end my_bg2">REGISTRASI</th><th class="text-end my_bg2">REG. DIBAYAR</th>
				<th class="text-end my_bg2">KEKURANGAN REGISTRASI</th>
				<th>AKSI</th></tr></thead>
			<tbody>
			<?php
			foreach ($DtIuran as $k)
			{
				$kurang_wjb=$k->jml_wajib-$k->byr_wajib;
				$kurang_reg=$k->jml_registrasi-$k->byr_registrasi;
				?>
				<tr><td><?= $k->provinsi;?></td>
					<td class="text-end my_bg1"><?= number_format($k->jml_wajib,0,',','.');?></td>
					<td class="text-end my_bg1"><?= number_format($k->byr_wajib, 0, ',', '.');?></td>
					<td class="text-end my_bg1"><?= number_format($kurang_wjb, 0, ',', '.');?></td>
					<td class="text-end my_bg2"><?= number_format($k->jml_registrasi, 0, ',', '.');?></td>
					<td class="text-end my_bg2"><?= number_format($k->byr_registrasi, 0, ',', '.');?></td>
					<td class="text-end my_bg2"><?= number_format($kurang_reg, 0, ',', '.');?></td>
					<td>
						<a href="<?= base_url();?>admin/kejurnas_iuran_detail/<?= $k->id_iuran_kj;?>"
							class="btn btn-info btn-xs"><i class="mdi mdi-magnify"></i></a>
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
	<hr/><h5>Penerimaan Lainnya</h5>
	<p class="text-end">
		<a href="<?= base_url();?>admin/kejurnas_penlain_new/<?= $DtKj['id_kj'];?>" class="btn btn-primary"><i class="mdi mdi-plus"></i> Tambah Penerimaan Lain</a></p>
	<?php
	if ($JmlTerima==0)
	{
		echo '<div class="alert alert-danger">Belum ada data penerimaan lainnya...</div>';
	}
	else
	{
		?>
		<table class="table">
			<thead><tr><th>NO</th><th>TANGGAL</th><th>NO. BUKTI</th><th>KETERANGAN</th><th>ADMIN</th>
				<th class="text-end">JUMLAH</th></tr></thead>
			<tbody>	
		<?php
		$total=0; $n=1;
		foreach ($DtTerima as $t)
		{
			?>
			<tr><td><?= $n;?></td><td><?= $CI->Mymodel->tgldmy($t->tgl_terima);?></td>
				<td><?= $t->no_bukti;?></td><td><?= stripslashes($t->keterangan);?></td>
				<td><?= $t->nama_admin;?></td>
				<td class="text-end"><?= number_format($t->jumlah,0,',','.');?></td>
				<td>
					<a href="<?= base_url();?>admin/kejurnas_penlain_edit/<?= $t->id_penerimaan;?>"
						class="btn btn-xs btn-info"><i class="mdi mdi-pencil"></i></a>
					<a href="<?= base_url();?>admin/kejurnas_penlain_del/<?= $t->id_penerimaan;?>"
						class="btn btn-xs btn-danger"><i class="mdi mdi-trash-can"></i></a>
				</td>
			</tr>	
			<?php
			$n++; $total+=$t->jumlah;
		}
		?>
		</tbody>
		<tfoot>
			<tr><th colspan="5" class="text-end">JUMLAH</th>
				<th class="text-end"><?= number_format($total,0,',','.');?></th>
				<th></th>
			</tr>
		</tfoot>	
		</table>
		<?php
	}
	?>		
  </div>
</div>

<?php include ('adm_akhir.php'); ?>