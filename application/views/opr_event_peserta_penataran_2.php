<?php
$CI = &get_instance();
$CI->load->model('Mymodel');

$st = array('Belum Berjalan', 'Berjalan', 'Selesai', 'Batal');
$cl = array('info', 'primary', 'success', 'danger');
$jk = array('L' => 'Laki-laki', 'P' => 'Perempuan');
$clbar = array('info', 'succsess', 'primary', 'warning', 'secondary', 'danger');
include('opr_awal.php'); ?>

<h5 class="py-3 mb-4">Informasi Peserta Event <span class="text-info"><?= $DtEvent['nama_ev']; ?></span></h5>
<div class="card mb-5">
	<div class="card-body">
		<p class="text-end">
			<a href="<?= base_url(); ?>opr/event/0" class="btn btn-danger"><i class="mdi mdi-close"></i> Kembali</a>
		</p>
		<?php include('opr_event_info.php'); ?>
	</div>
</div>

<div class="card mb-5">
	<div class="card-body">
		<ul class="nav nav-tabs tab-pills">
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url(); ?>opr/event_detail/<?= $DtEvent['id_ev']; ?>">Kategori dan Gelar</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" aria-current="page" href="<?= base_url(); ?>opr/event_peserta/<?= $DtEvent['id_ev']; ?>">Peserta Provinsi <?= $_SESSION['NMPROV_OPR']; ?></a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" href="<?= base_url(); ?>opr/event_peserta_penataran/<?= $DtEvent['id_ev']; ?>">Peserta Penataran</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url(); ?>opr/event_iuran/<?= $DtEvent['id_ev']; ?>">Pembayaran</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url(); ?>opr/event_time/<?= $DtEvent['id_ev']; ?>">Timeline</a>
			</li>
		</ul>

		<p class="mt-4"><b>Data Peserta Penataran Provinsi : <?= $_SESSION['NMPROV_OPR']; ?></b></p>
		<p class="text-end">
			<?php if ($_SESSION['IURAN'] == 'sudah') { ?>
				<?php
				if ($JmlPst > 0) {
				?>
					<a href="<?= base_url(); ?>opr/event_peserta_penataran/<?= $DtEvent['id_ev']; ?>/ctk"
						class="btn btn-info" target="_blank">
						<i class="mdi mdi-printer me-2"></i> Cetak</a>
				<?php
				}
				?>
			<?php } else { ?>
			<?php } ?>
		</p>


		<?php
		if ($JmlPst == 0) {
			echo '<div class="alert alert-danger">Belum ada peserta ...</div>';
		} else {



			if ($JmlPst == 0) {
				echo '<div class="alert alert-danger">Belum ada data peserta ...</div>';
			} else {
				$jk = array('P' => 'Pria', 'W' => 'Wanita');
				$n = 1;
				$idktg = '-';
		?>
				<div class="table-responsive">
					<table class="table" id="dataTable">
						<thead>
							<tr>
								<th>NO</th>
								<th>NAMA PESERTA</th>
								<th>TEMPAT, TANGGAL LAHIR</th>
								<th>PENATARAN</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$n = 1;
							foreach ($DtPst as $x) {

								if (strlen($x->nama_penataran) > 20) {
									$g = substr($x->nama_penataran, 0, 20) . '...';
								} else {
									$g = $x->nama_penataran;
								}
							?>
								<tr>
									<td><?= $n; ?></td>
									<td><?= $x->nama_peserta; ?></td>
									<td><?= $x->tempat_lahir; ?>,<?= $x->tanggal_lahir ?></td>
									<td><?= $g; ?></td>
								</tr>
							<?php
								$n++;
							}
							?>
						</tbody>
					</table>
				</div>


		<?php
			}
		}
		?>
		<p class="p-2 mt-4 bg-light">Total Peserta : <b><?= number_format($JmlPst, 0, ',', '.'); ?></b></p>
	</div>
</div>

<?php include('opr_akhir.php'); ?>