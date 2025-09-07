<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
include ('opr_awal.php'); ?>

<h5 class="py-3 mb-4">Edit Peserta Event  <span class="text-info"><?= $DtEvent['nama_ev'];?></span></h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>opr/event_detail/<?= $DtEvent['id_ev'];?>" class="btn btn-warning" ><i class="mdi mdi-close"></i> Kembali</a>
    </p>
	<form name="fpstnew" method="post" action="<?= base_url();?>opr/event_peserta_edit">
		<div class="row">
			<div class="col-sm-4 offset-sm-2">
				<fieldset><label>Nama Peserta</label>
					<input type="text" name="namapst" class="form-control" data-validate="required"
						maxlength="30" value="<?= $DtPst['nama_pst'];?>"/>
				</fieldset>
				<fieldset><label>NIK atau Kartu Pelajar</label>
					<input type="text" name="nik" class="form-control" data-validate="required"
						maxlength="16" value="<?= $DtPst['nik'];?>"/>
				</fieldset>
				<fieldset><label>Tanggal Lahir</label>
					<input type="date" name="tgllahir" class="form-control" data-validate="required"  value="<?= $DtPst['tgl_lahir'];?>"/>
				</fieldset>
				<fieldset><label>Umur</label>
					<input type="text" name="umur" class="form-control" data-validate="required,number"
						maxlength="2"  value="<?= $DtPst['umur'];?>"/>
				</fieldset>
				<fieldset><label>ID Nasional</label>
					<input type="text" name="idnasional" class="form-control" data-validate="required"
						maxlength="50"  value="<?= $DtPst['id_nasional'];?>"/>
				</fieldset>
			</div>
			<div class="col-sm-4">
				<fieldset><label>Jenis Kelamin</label>
					<select name="jk" class="form-control">
						<option value="P" <?php if($DtPst['jk_pst']=='P') { echo 'selected="selected"'; }?>>Pria</option>
						<option value="W" <?php if($DtPst['jk_pst']=='W') { echo 'selected="selected"'; }?>>Wanita</option>
					</select>
				</fieldset>
				<fieldset><label>Telepon</label>
					<input type="text" name="telepon" class="form-control" data-validate="required,number"
						maxlength="20" value="<?= $DtPst['telepon'];?>"/>
				</fieldset>
				<fieldset><label>Kategori</label>
					<select name="ktg" class="form-control">
						<?php
						foreach($DtKtg as $k)
						{
							echo '<option value="'.$k->id_ktg_ev.'"';
							if ($DtPst['id_ktg_ev']==$k->id_ktg_ev) { echo ' selected="selected"'; }
							echo '>'.$k->kategori.'</option>';
						}
						?>
					</select>
				</fieldset>
				<fieldset><label>Gelar</label>
					<select name="glr" class="form-control">
						<?php
						foreach($DtGelar as $k)
						{
							echo '<option value="'.$k->id_gelar_ev.'"';
							if ($DtPst['id_gelar_ev']==$k->id_gelar_ev) { echo ' selected="selected"'; }
							echo '>'.$k->gelar.', '.number_format($k->biaya_reg,0,',','.').'</option>';
						}
						?>
					</select>
				</fieldset>
				<fieldset><label>Akomodasi</label>
					<select name="akomodasi" class="form-control">
						<?php
						foreach($DtAkomodasi as $k)
						{
							echo '<option value="'.$k->id_akomodasi_ev.'"';
							if ($DtPst['id_akomodasi_ev']==$k->id_akomodasi_ev) { echo ' selected="selected"'; }
							echo '>'.$k->keterangan.', '.number_format($k->biaya,0,',','.').'</option>';
						}
						?>
					</select>
				</fieldset>
			</div>
		</div>
		<p class="text-center mt-4">
			<a href="<?= base_url();?>opr/event_detail/<?= $DtEvent['id_ev'];?>" class="btn btn-danger" ><i class="mdi mdi-close"></i> Batal</a>
			<button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Simpan</button>
		</p>
		<input type="hidden" name="idev" value="<?= $DtEvent['id_ev'];?>"/>
		<input type="hidden" name="stev" value="<?= $DtEvent['status_ev'];?>"/>
		<input type="hidden" name="idpst" value="<?= $DtPst['id_pst_ev'];?>"/>
	</form>
  </div>
</div>

<?php include ('opr_akhir.php'); ?>