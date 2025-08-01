<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Tambah Peserta Pertandingan Kejurnas</h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>admin/kejurnas_detail/<?= $DtKj['id_kj'];?>" class="btn btn-danger" ><i class="mdi mdi-close"></i> Kembali</a>
    </p>
	<h5><?= $DtKj['nama_kj'];?></h5>
	
	<form name="fpstnew" method="post" action="<?= base_url();?>admin/kejurnas_peserta_new">
		<div class="row">
			<div class="col-sm-4 offset-sm-2">
				<fieldset><label>Dari Provinsi</label>
					<b><?= $DtProv['provinsi'];?></b>
					<input type="hidden" name="idprov" value="<?= $DtProv['id_prov'];?>"/>
				</fieldset>
				<fieldset><label>Nama Peserta</label>
					<input type="text" name="namapst" class="form-control" data-validate="required"
						maxlength="30"/>
				</fieldset>
				<fieldset><label>NIK atau Kartu Pelajar</label>
					<input type="text" name="nik" class="form-control" data-validate="required"
						maxlength="16"/>
				</fieldset>
				<fieldset><label>Tanggal Lahir</label>
					<input type="date" name="tgllahir" class="form-control" data-validate="required"/>
				</fieldset>
				<fieldset><label>Umur</label>
					<input type="text" name="umur" class="form-control" data-validate="required,number"
						maxlength="2"/>
				</fieldset>
			</div>
			<div class="col-sm-4">
				<fieldset><label>Jenis Kelamin</label>
					<select name="jk" class="form-control">
						<option value="L">Laki-laki</option>
						<option value="P">Perempuan</option>
					</select>
				</fieldset>
				<fieldset><label>Telepon</label>
					<input type="text" name="telepon" class="form-control" data-validate="required,number"
						maxlength="20"/>
				</fieldset>
				<fieldset><label>Kategori</label>
					<select name="ktg" class="form-control">
						<?php
						foreach($DtKtg as $k)
						{
							echo '<option value="'.$k->id_ktg_kj.'">'.$k->kategori.'</option>';
						}
						?>
					</select>
				</fieldset>
				<fieldset><label>Gelar</label>
					<select name="glr" class="form-control">
						<?php
						foreach($DtGelar as $k)
						{
							echo '<option value="'.$k->id_gelar_kj.'">'.$k->gelar.', '.number_format($k->biaya_reg,0,',','.').'</option>';
						}
						?>
					</select>
				</fieldset>
			</div>
		</div>
		<p class="text-center mt-4">
			<a href="<?= base_url();?>admin/kejurnas_detail/<?= $DtKj['id_kj'];?>" class="btn btn-danger" ><i class="mdi mdi-close"></i> Batal</a>
			<button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Smpan</button>
		</p>
		<input type="hidden" name="idkj" value="<?= $DtKj['id_kj'];?>"/>
		<input type="hidden" name="stkj" value="<?= $DtKj['status_kj'];?>"/>
	</form>
  </div>
</div>

<?php include ('adm_akhir.php'); ?>