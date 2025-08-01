<?php
$CI =& get_instance();
$CI->load->model('Mymodel');


include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4"><span class="text-muted">Edit Peserta Pada Events </span> <?= $DtEvent['nama_ev'];?></h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">		
		<a href="<?= base_url();?>admin/event_detail/<?= $DtEvent['id_ev'];?>" class="btn btn-danger btn-sm" > <i class="mdi mdi-close"></i> Kembali</a>		
    </p>
	<hr/>
	<?php include('adm_event_info.php'); ?>
  </div>
</div>

<div class="card mb-5">   
  <div class="card-body">  
	<ul class="nav nav-tabs">
	  <li class="nav-item">
		<a class="nav-link"  href="<?= base_url();?>admin/event_detail/<?= $DtEvent['id_ev'];?>">Kategori dan Gelar</a>		
	  </li>
	  <li class="nav-item">
		<a class="nav-link active" aria-current="page" href="#"><b>Peserta</b></a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_time/<?= $DtEvent['id_ev'];?>">Time Line</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_iuran/<?= $DtEvent['id_ev'];?>">Penerimaan Iuran/Registrasi</a>
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
	
	<h5 class="my-5">Edit Peserta Provinsi <?= $DtPst['provinsi'];?></h5>
	
	<form name="fpstev" method="post" action="<?= base_url();?>admin/event_peserta_edit">
		<div class="row">
			<fieldset class="col-sm-6"><label>Nama Peserta</label>
				<input type="text" name="namapst" class="form-control myinput-required" data-validate="required"
					maxlength="40" placeholder="Nama Lengkap" value="<?= $DtPst['nama_pst'];?>"/>
			</fieldset>
			<fieldset class="col-sm-3"><label>Tanggal Lahir</label>
				<input type="date" name="tgllahir" class="form-control myinput-required" data-validate="required"
					 value="<?= $DtPst['tgl_lahir'];?>"/>
			</fieldset>
			<fieldset class="col-sm-3"><label>Umur</label>
				<input type="text" name="umur" class="form-control myinput-required" data-validate="required,number"
					maxlength="3" placeholder="Umur (th)" value="<?= $DtPst['umur'];?>"/>
			</fieldset>
			<fieldset class="col-sm-3"><label>ID Nasional</label>
				<input type="text" name="idnasional" class="form-control myinput-required" data-validate="required"
					maxlength="50" placeholder="Umur (th)" value="<?= $DtPst['id_nasional'];?>"/>
			</fieldset>
			<fieldset class="col-sm-4"><label>Jenis Kelamin</label>
				<select name="jk" class="form-control">
					<option value="P" <?php if ($DtPst['jk_pst']=='P') { echo 'selected="selected"'; } ?>>Pria</option>
					<option value="W" <?php if ($DtPst['jk_pst']=='W') { echo 'selected="selected"'; } ?>>Wanita</option>
				</select>
			</fieldset>
			<fieldset class="col-sm-4"><label>NIK atau Kartu Pelajar</label>
				<input type="text" name="nik" class="form-control myinput-required" data-validate="required"
					maxlength="16" placeholder="NIK atau Kartu Pelajar" value="<?= $DtPst['nik'];?>"/>
			</fieldset>
			<fieldset  class="col-sm-4"><label>No. Telepon Aktif</label>
				<input type="text" name="telepon" class="form-control myinput-required" data-validate="required,number"
					maxlength="20" placeholder="Nomor telepon/HP" value="<?= $DtPst['telepon'];?>"/>
			</fieldset>
			<fieldset class="col-sm-4"><label>Kategori</label>
				<select name="ktg" class="form-control">
				<?php
				foreach ($DtKtg as $g)
				{
					echo '<option value="'.$g->id_ktg_ev.'"';
					if ($DtPst['id_ktg_ev']==$g->id_ktg_ev) { echo ' selected="selected"'; }
					echo '>'.$g->kategori.'</option>';
				}
				?>
				</select>
			</fieldset>
			<fieldset class="col-sm-4"><label>Gelar</label>
				<select name="gelar" class="form-control">
				<?php
				foreach ($DtGelar as $g)
				{
					echo '<option value="'.$g->id_gelar_ev.'"';
					if ($DtPst['id_gelar_ev']==$g->id_gelar_ev) { echo ' selected="selected"'; }
					echo '>'.$g->gelar.'</option>';
				}
				?>
				</select>
			</fieldset>
			<fieldset class="col-sm-4"><label>Akomodasi</label>
				<select name="akomodasi" class="form-control">
				<?php
				foreach ($DtAkomodasi as $g)
				{
					echo '<option value="'.$g->id_akomodasi_ev.'"';
					if ($DtPst['id_akomodasi_ev']==$g->id_akomodasi_ev) { echo ' selected="selected"'; }
					echo '>'.$g->keterangan.'</option>';
				}
				?>
				</select>
			</fieldset>
		</div>
		<p class="text-center mt-4">
			<a href="<?= base_url();?>admin/event_peserta/<?= $DtEvent['id_ev'];?>" class="btn btn-danger btn-sm" > <i class="mdi mdi-close"></i> Batal</a>	
			<button type="submit" class="btn btn-primary btn-sm"><i class="mdi mdi-check"></i> Smpan</button>
		</p>
		<input type="hidden" name="idev" value="<?= $DtEvent['id_ev'];?>"/>
		<input type="hidden" name="idprov" value="<?= $DtPst['id_prov'];?>"/>
		<input type="hidden" name="oldktg" value="<?= $DtPst['id_ktg_ev'];?>"/>
		<input type="hidden" name="idpst" value="<?= $DtPst['id_pst_ev'];?>"/>
	</form>
  </div>
</div>

<?php include ('adm_akhir.php'); ?>