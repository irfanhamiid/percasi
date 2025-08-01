<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4"><span class="text-muted">Penerimaan Lainnya Event</span> <?= $DtEvent['nama_ev'];?></h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>admin/event_penlain/<?= $DtEvent['id_ev'];?>" class="btn btn-warning btn-sm" > <i class="mdi mdi-close"></i> Kembali</a>		
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
		<a class="nav-link" href="<?= base_url();?>admin/event_time/<?= $DtEvent['id_ev'];?>">Time Line</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_iuran/<?= $DtEvent['id_ev'];?>" >Penerimaan Iuran/Registrasi</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link active" aria-current="page" ><b>Penerimaan Lain</b></a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_kaskeluar/<?= $DtEvent['id_ev'];?>">Pengeluaran Kas</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_keuangan/<?= $DtEvent['id_ev'];?>">Keuangan</a>
	  </li> 
	</ul>
	
	<h5 class="mt-4">Data Penerimaan Lain</h5>
	<div class="row">
		<div class="col-sm-4">
			<p>Tanggal Penerimaan : <b><?= $DtPen['tgl_terima'];?></b></p>
		</div>
		<div class="col-sm-4"><p>No. Bukti : <b><?= $DtPen['no_bukti'];?></b></p></div>
		<div class="col-sm-4"><p>Jumlah Penerimaan : <b><?= number_format($DtPen['jumlah'],0,',','.');?></b></p></div>
		<div class="col-sm-6"><p>Keterangan :<br/>
			<?= stripslashes($DtPen['keterangan']);?></p>
		</div>
		<div class="col-sm-6"><p>Bukti Pembayaran :<br/>
			<img class="img-fluid" src="<?= base_url();?>img/bayar/<?= $DtPen['bukti'];?>"/></p>
		</div>
	</div>	
  </div>
</div>

<?php include ('adm_akhir.php'); ?>