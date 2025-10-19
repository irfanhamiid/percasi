<?php
$CI = &get_instance();
$CI->load->model('Mymodel');

$st = array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl = array('info', 'primary', 'success', 'danger');
include('adm_awal.php'); ?>

<h5 class="py-3 mb-4"><span class="text-muted">Pengeluaran Kas Event</span> <?= $DtEvent['nama_ev']; ?></h5>

<div class="card mb-5">
	<div class="card-body">
		<p class="text-end">
			<a href="<?= base_url(); ?>admin/event_ubah_status/<?= $DtEvent['id_ev']; ?>" class="btn btn-info btn-sm"><i class="mdi mdi-pencil"></i> Ubah Status</a>
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
				<a class="nav-link" href="<?= base_url(); ?>admin/event_winner/<?= $DtEvent['id_ev']; ?>">Pemenang</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url(); ?>admin/event_time/<?= $DtEvent['id_ev']; ?>">Time Line</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url(); ?>admin/event_iuran/<?= $DtEvent['id_ev']; ?>">Iuran/Registrasi</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url(); ?>admin/event_penlain/<?= $DtEvent['id_ev']; ?>">Penerimaan Lain</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" aria-current="page"><b>Pengeluaran Kas</b></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url(); ?>admin/event_keuangan/<?= $DtEvent['id_ev']; ?>">Keuangan</a>
			</li>
		</ul>

		<h5 class="mt-4">Data Pengeluaran Kas</h5>
		<p class="text-end">
			<?php
			if ($JmlPen > 0) {
			?>
				<a href="<?= base_url(); ?>admin/event_kaskeluar/<?= $DtEvent['id_ev']; ?>/ctk" class="btn btn-info" target="_blank">
					<i class="mdi mdi-printer"></i> Cetak</a>
			<?php
			}
			?>
		</p>
		<?php
		if ($JmlPen == 0) {
			echo '<div class="alert alert-danger">Belum ada pengeluaran kas...</div>';
		} else {
		?>

			<table class="table mb-4" id="dataTable">
				<thead>
					<tr>
						<th>NO</th>
						<th>TANGGAL</th>
						<th>NO. BUKTI</th>
						<th>KETERANGAN</th>
						<th>ADMIN</th>
						<th class="text-end">JUMLAH</th>
						<th>AKSI</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$total = 0;
					$n = 1;
					foreach ($DtPen as $k) {
					?>
						<tr>
							<td><?= $n; ?></td>
							<td><?= $CI->Mymodel->tgldmy($k->tgl_keluar); ?></td>
							<td><?= $k->no_bukti; ?></td>
							<td><?= stripslashes($k->keterangan); ?></td>
							<td><?= $k->nama_admin; ?></td>
							<td class="text-end"><?= number_format($k->jumlah, 0, ',', '.'); ?></td>
							<td>
								<a href="<?= base_url(); ?>admin/event_kaskeluar_detail/<?= $k->id_kaskeluar; ?>"
									class="btn btn-info btn-xs"><i class="mdi mdi-magnify"></i></a>
							</td>
						</tr>
					<?php
						$n++;
						$total += $k->jumlah;
					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="5" class="text-end">JUMLAH</th>
						<th class="text-end"><?= number_format($total, 0, ',', '.'); ?></th>
						<th></th>
					</tr>
				</tfoot>
			</table>

		<?php
		}
		?>
	</div>
</div>

<?php include('adm_akhir.php'); ?>