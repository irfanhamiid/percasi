<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
include ('opr_awal.php'); ?>

<h5 class="py-3 mb-4">Tambah Peserta Event <span class="text-info"><?= $DtEvent['nama_ev'];?></span></h5>


<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>opr/event_detail/<?= $DtEvent['id_ev'];?>" class="btn btn-warning" ><i class="mdi mdi-close"></i> Kembali</a>
    </p>
	<p><b>Event : <?= $DtEvent['nama_ev'];?></b></p>
	
	<form name="fpstnew" method="post" action="<?= base_url();?>opr/event_peserta_new">
		<div class="row">
			<div class="col-sm-4 offset-sm-2">
				<fieldset><label>Nama Peserta</label>
					<input type="text" name="namapst" class="form-control myinput-required" data-validate="required"
						maxlength="30"/>
				</fieldset>
				<fieldset><label>NIK atau Kartu Pelajar</label>
					<input type="text" name="nik" class="form-control myinput-required" data-validate="required"
						maxlength="16"/>
				</fieldset>
				<fieldset><label>Tanggal Lahir</label>
					<input type="date" id="tgllahir" name="tgllahir" class="form-control myinput-required" data-validate="required"/>
				</fieldset>
				<fieldset><label>Umur</label>
					<input type="text" name="umur" id="umur" class="form-control myinput-required" data-validate="required,number"
						maxlength="2"/>
				</fieldset>
				<fieldset><label>ID Nasional</label>
					<input type="text" name="idnasional" id="idnasional" class="form-control myinput-required" data-validate="required"
						maxlength="50"/>
				</fieldset>
			</div>
			<div class="col-sm-4">
				<fieldset><label>Jenis Kelamin</label>
					<select name="jk" class="form-control myinput-required">
						<option value="P">Pria</option>
						<option value="W">Wanita</option>
					</select>
				</fieldset>
				<fieldset><label>Telepon</label>
					<input type="text" name="telepon" class="form-control myinput-required" data-validate="required,number"
						maxlength="20"/>
				</fieldset>
				<fieldset><label>Kategori</label>
					<select name="ktg" class="form-control myinput-required">
						<?php
						foreach($DtKtg as $k)
						{
							echo '<option value="'.$k->id_ktg_ev.'">'.$k->kategori.'</option>';
						}
						?>
					</select>
				</fieldset>
				<fieldset><label>Gelar</label>
					<select name="glr" class="form-control myinput-required">
						<?php
						foreach($DtGelar as $k)
						{
							echo '<option value="'.$k->id_gelar_ev.'">'.$k->gelar.', '.number_format($k->biaya_reg,0,',','.').'</option>';
						}
						?>
					</select>
				</fieldset>
				<fieldset><label>Akomodasi</label>
					<select name="akomodasi" class="form-control myinput-required">
						<?php
						foreach($DtAkomodasi as $k)
						{
							echo '<option value="'.$k->id_akomodasi_ev.'">'.$k->keterangan.', '.number_format($k->biaya,0,',','.').'</option>';
						}
						?>
					</select>
				</fieldset>
			</div>
		</div>
		<p class="text-center mt-4">
			<a href="<?= base_url();?>opr/event_detail/<?= $DtEvent['id_ev'];?>" class="btn btn-danger" ><i class="mdi mdi-close"></i> Batal</a>
			<button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Smpan</button>
		</p>
		<input type="hidden" name="idev" value="<?= $DtEvent['id_ev'];?>"/>
		<input type="hidden" name="stev" value="<?= $DtEvent['status_ev'];?>"/>
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

<?php include ('opr_akhir.php'); ?>