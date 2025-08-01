<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Berjalan', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
$jk=array('L'=>'Laki-laki', 'P'=>'Perempuan');
$clbar=array('info', 'succsess', 'primary', 'warning', 'secondary', 'danger');
include ('opr_awal.php'); ?>

<h5 class="py-3 mb-4">Timeline Event <span class="text-info"><?= $DtEvent['nama_ev'];?></span></h5>
<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>opr/event/0" class="btn btn-danger" ><i class="mdi mdi-close"></i> Kembali</a>
    </p>
	<?php include('opr_event_info.php');?>
  </div>
</div>

<div class="card mb-5">   
  <div class="card-body">
	<ul class="nav nav-tabs tab-pills">
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>opr/event_detail/<?= $DtEvent['id_ev'];?>">Kategori dan Gelar</a>
	  </li>
	   <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>opr/event_peserta/<?= $DtEvent['id_ev'];?>">Peserta Provinsi <?= $_SESSION['NMPROV_OPR'];?></a>
	  </li>
	  
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>opr/event_iuran/<?= $DtEvent['id_ev'];?>">Pembayaran Iuran</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link active" aria-current="page"  href="#"><b>Timeline</b></a>
	  </li>
	</ul>
	
	<p class="mt-4"><b>Time Line Event</b></p>
	
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

<?php include ('opr_akhir.php'); ?>