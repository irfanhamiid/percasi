<?php
$CI = &get_instance();
$CI->load->model('Mymodel');

$st = array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl = array('info', 'primary', 'success', 'danger');
include('opr_awal.php'); ?>

<h5 class="py-3 mb-4">Edit Peserta Event <span class="text-info"><?= $DtEvent['nama_ev']; ?></span></h5>

<div class="card mb-5">
	<div class="card-body">
		<p class="text-end">
			<a href="<?= base_url(); ?>opr/event_detail/<?= $DtEvent['id_ev']; ?>" class="btn btn-warning"><i class="mdi mdi-close"></i> Kembali</a>
		</p>
		<form name="fpstnew" method="post" action="<?= base_url(); ?>opr/event_peserta_penataran_edit" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-4 offset-sm-2">
					<fieldset><label>Nama Peserta</label>
						<input type="text" name="nama_peserta" value="<?= $DtPst['nama_peserta'] ?>" class="form-control myinput-required" data-validate="required"
							maxlength="100" />
					</fieldset>
					<fieldset><label>Tempat Lahir</label>
						<input type="text" name="tempat_lahir" value="<?= $DtPst['tempat_lahir'] ?>" class="form-control myinput-required" data-validate="required"
							maxlength="100" />
					</fieldset>
					<fieldset><label>Tanggal Lahir</label>
						<input type="date" id="tgllahir" value="<?= $DtPst['tanggal_lahir'] ?>" name="tanggal_lahir" class="form-control myinput-required" data-validate="required" />
					</fieldset>
					<fieldset><label>File Surat Rekomendasi</label>
						<input type="file" name="file_rekom" accept=".jpg,.jpeg,.png"
							id="filegambar" class="form-control"
							onchange="return rekomen('imagesample',this.files[0],'filegambar','fileerror',2000000,'<?= base_url(); ?>img/noimage.jpg');" />
						<p id="fileerror" class="text-danger"></p>
					</fieldset>
				</div>
				<div class="col-sm-4">
					<fieldset><label>Jenis Kelamin</label>
						<select name="jenis_kelamin" class="form-control myinput-required">
							<option value="P" <?php if ($DtPst['jenis_kelamin'] == "P") { ?> selected <?php } ?>>Pria</option>
							<option value="W" <?php if ($DtPst['jenis_kelamin'] == "W") { ?> selected <?php } ?>>Wanita</option>
						</select>
					</fieldset>
					<fieldset><label>Penataran</label>
						<select name="id_penataran" class="form-control myinput-required">
							<?php
							foreach ($DtPenataran as $k) {
								echo '<option value="' . $k->id_penataran . '"';
								if ($DtPst['id_penataran'] == $k->id_penataran) {
									echo ' selected="selected"';
								}
								echo '>' . $k->nama_penataran . ', ' . number_format($k->biaya, 0, ',', '.') . '</option>';
							}
							?>
						</select>
					</fieldset>
					<fieldset><label>File KTP</label>
						<input type="file" name="file_ktp" accept=".jpg,.jpeg,.png" data-validate=""
							id="file_ktp" class="form-control" />
					</fieldset>
					<fieldset><label>File Pas Foto</label>
						<input type="file" name="file_foto" accept=".jpg,.jpeg,.png" data-validate=""
							id="file_foto" class="form-control"/>
						<p id="fileerror" class="text-danger"></p>
					</fieldset>
				</div>
			</div>
			<p class="text-center mt-4">
				<a href="<?= base_url(); ?>opr/event_detail/<?= $DtEvent['id_ev']; ?>" class="btn btn-danger"><i class="mdi mdi-close"></i> Batal</a>
				<button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Simpan</button>
			</p>
			<input type="hidden" name="idev" value="<?= $DtEvent['id_ev']; ?>" />
			<input type="hidden" name="stev" value="<?= $DtEvent['status_ev']; ?>" />
			<input type="hidden" name="idpst" value="<?= $DtPst['id_peserta']; ?>" />
		</form>
	</div>
</div>

<?php include('opr_akhir.php'); ?>