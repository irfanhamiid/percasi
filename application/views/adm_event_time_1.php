<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Berjalan', 'Berjalan', 'Selesai', 'Gagal');
$cl=array('info', 'primary', 'success', 'danger');
include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4"><span class="text-muted">Time Line Event</span> <?= $DtEvent['nama_ev'];?></h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
		<a href="<?= base_url();?>admin/event_ubah_status/<?= $DtEvent['id_ev'];?>" class="btn btn-info btn-sm" ><i class="mdi mdi-pencil"></i> Ubah Status</a>		
        <a href="<?= base_url();?>admin/event/<?= $DtEvent['status_ev'];?>" class="btn btn-danger" ><i class="mdi mdi-close"></i> Kembali</a>
    </p>
	<?php include('adm_event_info.php'); ?>
</div>
</div>  

<div class="card mb-5">   
  <div class="card-body">
	<ul class="nav nav-tabs tab-pills">
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_detail/<?= $DtEvent['id_ev'];?>">Kategori dan Gelar</a>		
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/event_peserta/<?= $DtEvent['id_ev'];?>">Peserta</a>
	  </li>
	  <li class="nav-item">
				<a class="nav-link" href="<?= base_url(); ?>admin/event_peserta_penataran/<?= $DtEvent['id_ev']; ?>">Peserta Penataran</a>
			</li>
	  <li class="nav-item">
		<a class="nav-link active" aria-current="page" ><b>Time Line</b></a>
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
	
	<p class="mt-4"><b>Time Line Event</b></p>
	<p class="text-end"><a href="<?= base_url();?>admin/event_time_new/<?= $DtEvent['id_ev'];?>"
				class="btn btn-primary"><i class="mdi mdi-plus"></i> Tambah</a>
	<?php
	if ($JmlTime>0)
	{
		?>
		<a href="<?= base_url();?>admin/event_time/<?= $DtEvent['id_ev'];?>/ctk" target="_blank"
				class="btn btn-info"><i class="mdi mdi-printer"></i> Cetak</a>
		<?php
	}
	?>
	</p>
	<?php
	if ($JmlTime==0)
	{
		echo '<div class="alert alert-danger">Belum ada data timeline...</div>';
	}
	else
	{
		?>
		<div class="row overflow-hidden">
			<div class="col-12">
				<ul class="timeline timeline-center mt-12">
		<?php		
		foreach ($DtTime as $t)
		{
			?>
			<li class="timeline-item">
				<span class="timeline-indicator timeline-indicator-success aos-init aos-animate" data-aos="zoom-in" 
					data-aos-delay="200"><i class="mdi mdi-calendar-outline"></i>
				</span>
				<div class="timeline-event card p-0 aos-init aos-animate" data-aos="fade-right">
					<div class="card-header d-flex justify-content-between align-items-center flex-wrap">
						<h6 class="card-title mb-0"><?= $t->kegiatan;?></h6>
					</div>
					<div class="card-body">
						<p class="mb-2"><?= $t->catatan;?></p>
						<p class="text-end">By <?= $t->nama_admin;?>
						<?php
						if (($_SESSION['ID_ADMIN']==3) || ($_SESSION['ID_ADMIN']==$t->id_admin) ) 
						{
							?>
						<a href="<?= base_url();?>admin/event_time_edit/<?= $t->id_timeline;?>"
								class="btn btn-xs btn-info"><i class="mdi mdi-pencil"></i></a>
						<a href="#" class="btn btn-xs btn-danger" title="Hapus"
                                                    onclick="return hapus('<?= $t->id_timeline;?>','<?= $t->tanggal;?>');">
                                                    <i class="mdi mdi-trash-can"></i></a>
						<?php
						}
						?>	
						</p>							
					</div>
					<div class="timeline-event-time"><?= $CI->Mymodel->tgltext($t->tanggal);?></div>
				</div>
			</li>	
			<?php
		}
		?>
		</ul>
		</div>
		</div>
		<?php
	}
	?>
  </div>
</div>
<?php include ('adm_akhir.php'); ?>