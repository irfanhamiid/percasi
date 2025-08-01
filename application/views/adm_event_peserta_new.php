<?php
$CI =& get_instance();
$CI->load->model('Mymodel');


include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4"><span class="text-muted">Tambah Peserta Pada Events </span> <?= $DtEvent['nama_ev'];?></h5>

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
	
	<h5 class="my-5">Tambah Peserta Provinsi <?= $DtProv['provinsi'];?></h5>
	
	<form name="fpstev" method="post" action="<?= base_url();?>admin/event_peserta_new">
		<div class="row">
			<fieldset class="col-sm-6"><label>Nama Peserta</label>
				<input type="text" name="namapst" class="form-control myinput-required" data-validate="required"
					maxlength="40" placeholder="Nama Lengkap"/>
			</fieldset>
			<fieldset class="col-sm-3"><label>Tanggal Lahir</label>
				<input type="date" id="tgllahir" name="tgllahir" class="form-control myinput-required" data-validate="required"
					/>
			</fieldset>
			<fieldset class="col-sm-3"><label>Umur</label>
				<input type="text" name="umur" id="umur" class="form-control myinput-required" data-validate="required,number"
					maxlength="3" placeholder="Umur (th)"/>
			</fieldset>
			<fieldset class="col-sm-3"><label>ID Nasional</label>
				<input type="text" name="idnasional" class="form-control myinput-required" data-validate="required"
					maxlength="50" placeholder="ID Nasional"/>
			</fieldset>
			<fieldset class="col-sm-4"><label>Jenis Kelamin</label>
				<select name="jk" class="form-control">
					<option value="P">Pria</option>
					<option value="W">Wanita</option>
				</select>
			</fieldset>
			<fieldset class="col-sm-4"><label>NIK atau Kartu Pelajar</label>
				<input type="text" name="nik" class="form-control myinput-required" data-validate="required"
					maxlength="16" placeholder="NIK atau Kartu Pelajar"/>
			</fieldset>
			<fieldset  class="col-sm-4"><label>No. Telepon Aktif</label>
				<input type="text" name="telepon" class="form-control myinput-required" data-validate="required,number"
					maxlength="20" placeholder="Nomor telepon/HP"/>
			</fieldset>
			<fieldset class="col-sm-4"><label>Kategori</label>
				<select name="ktg" class="form-control">
				<?php
				foreach ($DtKtg as $g)
				{
					echo '<option value="'.$g->id_ktg_ev.'">'.$g->kategori.'</option>';
				}
				?>
				</select>
			</fieldset>
			<fieldset class="col-sm-4"><label>Gelar</label>
				<select name="gelar" class="form-control">
				<?php
				foreach ($DtGelar as $g)
				{
					echo '<option value="'.$g->id_gelar_ev.'">'.$g->gelar.'</option>';
				}
				?>
				</select>
			</fieldset>
			<fieldset class="col-sm-4"><label>Akomodasi</label>
				<select name="akomodasi" class="form-control">
				<?php
				foreach ($DtAkomodasi as $g)
				{
					echo '<option value="'.$g->id_akomodasi_ev.'">'.$g->keterangan.'</option>';
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
		<input type="hidden" name="idprov" value="<?= $DtProv['id_prov'];?>"/>
	</form>
  </div>
</div>

<script>
    // Fungsi untuk menghitung umur berdasarkan tanggal lahir
    function hitungUmur(tanggal) {
      const today = new Date(); // Tanggal saat ini
      const birthDate = new Date(tanggal); // Konversi input tanggal ke Date object
      let umur = today.getFullYear() - birthDate.getFullYear(); // Selisih tahun

      // Cek apakah bulan/tanggal sudah lewat di tahun ini
      const bulan = today.getMonth() - birthDate.getMonth();
      if (bulan < 0 || (bulan === 0 && today.getDate() < birthDate.getDate())) {
        umur--; // Kurangi umur jika belum ulang tahun tahun ini
      }
      return umur;
    }

    // Event listener untuk menghitung umur saat input tanggal lahir berubah
    document.getElementById('tgllahir').addEventListener('change', function () {
      const tanggal = this.value;
      const umur = hitungUmur(tanggal);
      document.getElementById('umur').value = umur; // Tampilkan umur
    });
  </script>

<?php include ('adm_akhir.php'); ?>