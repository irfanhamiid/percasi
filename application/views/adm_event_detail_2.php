<?php
$CI = &get_instance();
$CI->load->model('Mymodel');
include('adm_awal.php');
?>

<h5 class="py-3 mb-4"><span class="text-muted">Detail Event</span> <?= $DtEvent['nama_ev']; ?></h5>

<div class="card mb-5">
	<div class="card-body">
		<p class="text-end">

			<a href="<?= base_url(); ?>admin/event_ubah_status/<?= $DtEvent['id_ev']; ?>" class="btn btn-info btn-sm"> <i class="mdi mdi-pencil"></i> Ubah Status</a>
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
				<a class="nav-link active" aria-current="page" href="#"><b>Kategori dan Gelar</b></a>
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
				<a class="nav-link" href="<?= base_url(); ?>admin/event_kaskeluar/<?= $DtEvent['id_ev']; ?>">Pengeluaran Kas</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url(); ?>admin/event_keuangan/<?= $DtEvent['id_ev']; ?>">Keuangan</a>
			</li>

		</ul>
		<?php
		if (($JmlKtg > 0) || ($JmlGelar > 0)) {
		?>
			<p class="my-4 text-end"><a href="<?= base_url(); ?>admin/event_detail/<?= $DtEvent['id_ev']; ?>/ctk" class="btn btn-primary" target="_blank">
					<i class="mdi mdi-printer me-2"></i> Cetak</a></p>
		<?php
		}
		?>
		<div class="row">
			<div class="col-sm-6">
				<h6 class="mt-4 p-2 bg-light">Kategori</h6>

				<?php
				if ($JmlKtg == 0) {
					echo '<div class="alert alert-danger">Belum ada data kategori ...</div>';
				} else {
					echo '<table class="table table-sm table-bordered">
						<thead><tr><th>NO</th><th>KATEGORI</th><th class="text-end">JML PESERTA</th><th>AKSI</th></tr></thead>
						<tbody>';
					$n = 1;
					foreach ($DtKtg as $l) {
				?>
						<tr>
							<td><?= $n; ?></td>
							<td><?= $l->kategori; ?></td>
							<td class="text-end"><?= number_format($l->jml_peserta, 0, ',', '.'); ?></td>
							<td><a href="<?= base_url(); ?>/admin/event_peserta_kategori/<?= $DtEvent['id_ev']; ?>/<?= $l->id_ktg_ev; ?>" class=" btn btn-xs btn-success"><i class="mdi mdi-magnify"></i></a>
							</td>
						</tr>
					<?php
						$n++;
					}
					?>
					</tbody>
					</table>

				<?php
				}
				?>

			</div>
			<div class="col-sm-6">
				<h6 class="mt-4 p-2 bg-light">Biaya Pendaftaran</h6>

				<?php
				if ($JmlGelar == 0) {
					echo '<div class="alert alert-danger">Belum ada data gelar ...</div>';
				} else {
					echo '<table class="table table-sm table-bordered">
						<thead><tr><th>NO</th><th>GELAR</th><th class="text-end">BI. REGISTRASI</th><th>AKSI</th></tr></thead>
						<tbody>';
					$n = 1;
					foreach ($DtGelar as $g) {
				?>
						<tr>
							<td><?= $n; ?></td>
							<td><?= $g->gelar; ?></td>
							<td class="text-end"><?= number_format($g->biaya_reg, 0, ',', '.'); ?></td>
							<td><a href="<?= base_url(); ?>/admin/event_peserta_gelar/<?= $DtEvent['id_ev']; ?>/<?= $g->id_gelar_ev; ?>" class=" btn btn-xs btn-success"><i class="mdi mdi-magnify"></i></a>
							</td>
						</tr>
					<?php
						$n++;
					}
					?>
					</tbody>
					</table>

				<?php
				}
				?>
			</div>
			<div class="col-sm-6"></div>
			<div class="col-sm-6">
				<h6 class="mt-4 p-2 bg-light">Biaya Penataran</h6>
				<?php
				if ($JmlPenataran == 0) {
					echo '<div class="alert alert-danger">Belum ada data penataran ...</div>';
				} else {
					echo '<table class="table table-sm table-bordered">
						<thead><tr><th>NO</th><th>Nama</th><th class="text-end">BI. REGISTRASI</th><th>AKSI</th></tr></thead>
						<tbody>';
					$n = 1;
					foreach ($DtPenataran as $g) {
				?>
						<tr>
							<td><?= $n++; ?></td>
							<td><?= $g->nama_penataran; ?></td>
							<td class="text-end"><?= number_format($g->biaya, 0, ',', '.'); ?></td>
							<td>
								<?php
								if ($_SESSION['TP_ADMIN'] > 1) {
								?>
									<a href="<?= base_url(); ?>/admin/event_peserta_penataran/<?= $DtEvent['id_ev']; ?>/<?= $g->id_penataran; ?>" class=" btn btn-xs btn-success"><i class="mdi mdi-magnify"></i></a>
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
	</div>
</div>
<script>
	function hapusevent(idnya, nama) {

		Swal.fire({
			title: 'Hapus Event ?',
			html: "Anda akan menghapus <b>" + nama + "</b> !",
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak',

		}).then((result) => {
			if (result.value) {
				window.location.href = "<?= base_url(); ?>admin/event_del/" + idnya;
			}
		})
	}
</script>

<?php include('adm_akhir.php'); ?>