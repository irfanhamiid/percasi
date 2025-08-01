<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4"><span class="text-muted">Daftar Pemenang  Event</span> <?= $DtEvent['nama_ev'];?></h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
		<a href="<?= base_url();?>admin/event_ubah_status/<?= $DtEvent['id_ev'];?>" class="btn btn-info btn-sm" ><i class="mdi mdi-pencil"></i> Ubah Status</a>
		<?php
		if ($_SESSION['TP_ADMIN']==3)
		{
			?>
			<a href="#" class="btn btn-danger" title="Hapus"
				onclick="return hapusevent('<?= $DtEvent['id_ev'];?>','<?= $DtEvent['nama_ev'];?>');">
				<i class="mdi mdi-trash-can"></i> Hapus</a>
		<?php
		}
		?>
        <a href="<?= base_url();?>admin/event/<?= $DtEvent['status_ev'];?>/scr" class="btn btn-warning btn-sm" > <i class="mdi mdi-close"></i> Kembali</a>		
    </p>
	<hr/>
	<?php include('adm_event_info.php'); ?>
  </div>
</div>

<div class="card mb-5">   
  <div class="card-body">
	<ul class="nav nav-tabs">
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_detail/<?= $DtEvent['id_ev'];?>">Kategori dan Gelar</a>		
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_peserta/<?= $DtEvent['id_ev'];?>">Peserta</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link active" aria-current="page" href="#"><b>Pemenang</b></a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_time/<?= $DtEvent['id_ev'];?>">Time Line</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_iuran/<?= $DtEvent['id_ev'];?>" >Iuran/Registrasi</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link"  href="<?= base_url();?>admin/event_penlain/<?= $DtEvent['id_ev'];?>">Penerimaan Lain</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_kaskeluar/<?= $DtEvent['id_ev'];?>">Pengeluaran Kas</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_keuangan/<?= $DtEvent['id_ev'];?>">Keuangan</a>
	  </li> 
	</ul>
	
	<h5 class="mt-4">Tambahkan Data Pemenang</h5>
	<p>Peserta : <b><?= $DtPst['nama_pst'];?></b></p>
	<p class="text-info">Silahkan isi peringkat berapa dan keterangan juara</p>
	<form name="fwin" method="post" action="<?= base_url();?>admin/event_winner_set">
		<div class="row">
			<fieldset class="col-sm-3 offset-sm-2"><label>Peringkat</label>
				<input type="text" name="peringkat" data-validate="required, maxVal(99), minVal(1)"
					class="form-control"/>
			</fieldset>		
			<fieldset class="col-sm-4"><label>Keterangan</label>
				<input type="text" name="keterangan" data-validate="required" maxlength="40"
					class="form-control" placeholder="Juara 1, Juara 2, dsb..."/>
			</fieldset>
		</div>
		<input type="hidden" name="idpst" value="<?= $DtPst['id_pst_ev'];?>"/>
		<input type="hidden" name="ideve" value="<?= $DtEvent['id_ev'];?>"/>
		<p class="text-center mt-4"><button type="submit" class="btn btn-primary">
			<i class="mdi mdi-check"></i> Simpan</button></p>
	</form>
	
  </div>
</div>

<?php include ('adm_akhir.php'); ?>