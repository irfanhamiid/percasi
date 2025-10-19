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
				<a class="nav-link active" aria-current="page" href="#"><b>Peserta Provinsi <?= $_SESSION['NMPROV_OPR']; ?></b></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url(); ?>opr/event_peserta_penataran/<?= $DtEvent['id_ev']; ?>">Peserta Penataran</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url(); ?>opr/event_iuran/<?= $DtEvent['id_ev']; ?>">Pembayaran</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url(); ?>opr/event_time/<?= $DtEvent['id_ev']; ?>">Timeline</a>
			</li>
		</ul>

		<p class="mt-4"><b>Data Peserta Event Provinsi : <?= $_SESSION['NMPROV_OPR']; ?></b></p>
		<p class="text-end">
			<?php if ($_SESSION['IURAN'] == 'sudah') { ?>
				<a href="<?= base_url(); ?>opr/event_peserta_new/<?= $DtEvent['id_ev']; ?>"
					class="btn btn-info"><i class="mdi mdi-plus me-2"></i> Tambah Peserta</a>
				<?php
				if ($JmlPst > 0) {
				?>
					<a href="<?= base_url(); ?>opr/event_peserta/<?= $DtEvent['id_ev']; ?>/ctk"
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
								<th>ID NASIONAL</th>
								<th>NAMA PESERTA</th>
								<th>UMUR</th>
								<th>GELAR</th>
								<th>BIAYA REG</th>
								<th>AKOMODASI</th>
								<th>AKSI</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$n = 1;
							foreach ($DtPst as $x) {

								if (strlen($x->gelar) > 20) {
									$g = substr($x->gelar, 0, 20) . '...';
								} else {
									$g = $x->gelar;
								}
							?>
								<tr>
									<td><?= $n; ?></td>

									<td><?= $x->id_nasional; ?></td>
									<td><?= $x->nama_pst; ?></td>
									<td><?= $x->umur; ?></td>
									<td><?= $g; ?></td>
									<td class="text-end"><?= number_format($x->biaya_reg, 0); ?></td>
									<td class="text-end"><?= number_format($x->biaya, 0); ?></td>
									<td>

										<a href="<?= base_url(); ?>/opr/event_peserta_edit/<?= $x->id_pst_ev; ?>"
											class="btn btn-info btn-xs"><i class="mdi mdi-pencil"></i></a>

									</td>
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