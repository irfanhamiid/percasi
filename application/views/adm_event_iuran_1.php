<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4"><span class="text-muted">Penerimaan Iuran Event</span> <?= $DtEvent['nama_ev'];?></h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
		<a href="<?= base_url();?>admin/event_ubah_status/<?= $DtEvent['id_ev'];?>" class="btn btn-info btn-sm" ><i class="mdi mdi-pencil"></i> Ubah Status</a>		
        <a href="<?= base_url();?>admin/event/<?= $DtEvent['status_ev'];?>/scr" class="btn btn-warning btn-sm" > <i class="mdi mdi-close"></i> Kembali</a>		
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
				<a class="nav-link" href="<?= base_url(); ?>admin/event_peserta_penataran/<?= $DtEvent['id_ev']; ?>">Peserta Penataran</a>
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
	
	<h5 class="mt-4">Data Penerimaan Iuran</h5>
	<p class="text-end">
		<a href="<?= base_url();?>admin/event_iuran_upd/<?= $DtEvent['id_ev'];?>" class="btn btn-primary" ><i class="mdi mdi-cog-outline"></i> Update Penerimaan</a>
		<?php
		if ($JmlIuran>0)
		{
			?>
			<a href="<?= base_url();?>admin/event_iuran/<?= $DtEvent['id_ev'];?>/ctk" class="btn btn-info" target="_blank">
				<i class="mdi mdi-printer"></i> Cetak</a>
			<?php
		}
		?>
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
		<table class="table mb-4" id="dataTable">
			<thead><tr><th>PROVINSI</th><th class="text-end my_bg1">IURAN WAJIB</th>
				<th class="text-end my_bg1">IURAN DIBAYAR</th><th class="text-end my_bg1">KEKURANGAN IURAN</th>
				<th class="text-end my_bg2">REGISTRASI</th><th class="text-end my_bg2">REG. DIBAYAR</th>
				<th class="text-end my_bg2">KEKURANGAN REGISTRASI</th>
				<th class="text-end my_bg1">AKOMODASI</th><th class="text-end my_bg1">AK. DIBAYAR</th>
				<th class="text-end my_bg1">KEKURANGAN AKOMODASI</th>
				<th>AKSI</th></tr></thead>
			<tbody>
			<?php
			foreach ($DtIuran as $k)
			{
				$kurang_wjb=$k->jml_wajib-$k->byr_wajib;
				$kurang_reg=$k->jml_registrasi-$k->byr_registrasi;
				$kurang_akomodasi=$k->jml_akomodasi-$k->byr_akomodasi;
				?>
				<tr><td><?= $k->provinsi;?></td>
					<td class="text-end my_bg1"><?= number_format($k->jml_wajib,0,',','.');?></td>
					<td class="text-end my_bg1"><?= number_format($k->byr_wajib, 0, ',', '.');?></td>
					<td class="text-end my_bg1"><?= number_format($kurang_wjb, 0, ',', '.');?></td>
					<td class="text-end my_bg2"><?= number_format($k->jml_registrasi, 0, ',', '.');?></td>
					<td class="text-end my_bg2"><?= number_format($k->byr_registrasi, 0, ',', '.');?></td>
					<td class="text-end my_bg2"><?= number_format($kurang_reg, 0, ',', '.');?></td>
					<td class="text-end my_bg1"><?= number_format($k->jml_akomodasi, 0, ',', '.');?></td>
					<td class="text-end my_bg1"><?= number_format($k->byr_akomodasi, 0, ',', '.');?></td>
					<td class="text-end my_bg1"><?= number_format($kurang_akomodasi, 0, ',', '.');?></td>
					<td>
						<a href="<?= base_url();?>admin/event_iuran_detail/<?= $k->id_iuran_ev;?>"
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
  </div>
</div>

<?php include ('adm_akhir.php'); ?>