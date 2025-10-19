<?php
$CI = &get_instance();
$CI->load->model('Mymodel');

$st = array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl = array('info', 'primary', 'success', 'danger');
include('adm_awal.php'); ?>

<h5 class="py-3 mb-4"><span class="text-muted">Laporan Keuangan Event</span> <?= $DtEvent['nama_ev']; ?></h5>

<div class="card mb-5">
	<div class="card-body">
		<p class="text-end">

			<a href="<?= base_url(); ?>admin/event_edit/<?= $DtEvent['id_ev']; ?>" class="btn btn-info btn-sm"> <i class="mdi mdi-pencil"></i> Edit</a>
			<?php
			if ($_SESSION['TP_ADMIN'] == 3) {
			?>
				<a href="#" class="btn btn-danger" title="Hapus"
					onclick="return hapusevent('<?= $DtEvent['id_ev']; ?>','<?= $DtEvent['nama_ev']; ?>');">
					<i class="mdi mdi-trash-can"></i> Hapus</a>
			<?php
			}
			?>
			<a href="<?= base_url(); ?>admin/event/<?= $DtEvent['status_ev']; ?>/scr" class="btn btn-warning btn-sm"> <i class="mdi mdi-close"></i> Kembali</a>
		</p>
		<hr />
		<?php include('adm_event_info.php'); ?>
	</div>
</div>

<div class="card mb-5">
	<div class="card-body">
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url(); ?>admin/event_detail/<?= $DtEvent['id_ev']; ?>">Kategori dan Gelar</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url(); ?>admin/event_peserta/<?= $DtEvent['id_ev']; ?>">Peserta</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url(); ?>admin/event_peserta_penataran/<?= $DtEvent['id_ev']; ?>">Peserta Penataran</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url(); ?>admin/event_time/<?= $DtEvent['id_ev']; ?>">Time Line</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url(); ?>admin/event_iuran/<?= $DtEvent['id_ev']; ?>">Penerimaan Iuran/Registrasi</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url(); ?>admin/event_penlain/<?= $DtEvent['id_ev']; ?>">Penerimaan Lain</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url(); ?>admin/event_kaskeluar/<?= $DtEvent['id_ev']; ?>">Pengeluaran Kas</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" aria-current="page"><b>Keuangan</b></a>
			</li>
		</ul>

		<h5 class="mt-4">Data Keuangan</h5>
		<p class="text-end">
			<a href="<?= base_url(); ?>admin/event_keuangan/<?= $DtEvent['id_ev']; ?>/ctk" class="btn btn-info" target="_blank">
				<i class="mdi mdi-printer"></i> Cetak</a>
		</p>


		<table class="table mb-4">
			<tr>
				<th colspan="4">PENERIMAAN</th>
			</tr>
			<tr>
				<td>1.</td>
				<td>Iuran Wajib</td>
				<td class="text-end"><?= number_format($JmlIuranWjb, 0, ',', '.'); ?></td>
				<td></td>
			</tr>
			<tr>
				<td>2.</td>
				<td>Registrasi</td>
				<td class="text-end"><?= number_format($JmlIuranReg, 0, ',', '.'); ?></td>
				<td></td>
			</tr>
			<tr>
				<td>3.</td>
				<td>Akomodasi</td>
				<td class="text-end"><?= number_format($JmlAkomodasi, 0, ',', '.'); ?></td>
				<td></td>
			</tr>
			<tr>
				<td>4.</td>
				<td>Penerimaan Lain</td>
				<td class="text-end"><?= number_format($JmlPenLain, 0, ',', '.'); ?></td>
				<td></td>
			</tr>
			<tr>
				<td>5.</td>
				<td>Penataran</td>
				<td class="text-end"><?= number_format($JmlPenataran, 0, ',', '.'); ?></td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<th>Jumlah Penerimaan</th>
				<th></th>
				<th class="text-end"><?= number_format($JmlPenerimaan, 0, ',', '.'); ?></th>
			</tr>
			<tr>
				<th colspan="4">PENGELUARAN</th>
			</tr>
			<tr>
				<td>1.</td>
				<td>Pengeluaran Kas</td>
				<td></td>
				<td class="text-end"><?= number_format($JmlKasKeluar, 0, ',', '.'); ?></td>
			</tr>
			<tr>
				<td></td>
				<th>SALDO KAS</th>
				<th></th>
				<th class="text-end"><b><?= number_format($SaldoKas, 0, ',', '.'); ?></b></th>
			</tr>

		</table>
	</div>

	<?php include('adm_akhir.php'); ?>