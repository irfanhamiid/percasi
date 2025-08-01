<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Berjalan', 'Berjalan', 'Selesai', 'Gagal');
$cl=array('info', 'primary', 'success', 'danger');
include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Informasi Kejurnas <span class="text-info">Belum Berjalan</span></h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>adm/kejurnas" class="btn btn-danger" ><i class="mdi mdi-close"></i> Kembali</a>
    </p>
	<div class="row">
		<div class="col-sm-6">
			<h5>Kejurnas : <?= $DtKj['nama_kj'];?></h5>
			<p><a href="<?= base_url();?>img/poster/<?= $DtKj['id_kj'];?>.jpg" target="_blank"
				class="btn btn-success"><i class="mdi mdi-image"></i> Poster</a>
			   <a href="<?= base_url();?>pdf/kejurnas/<?= $DtKj['id_kj'];?>.pdf" target="_blank"
				class="btn btn-success"><i class="mdi mdi-file-pdf-box"></i> Proposal</a>		
			</p>
		</div>
		<div class="col-sm-6 text-end">
			<p>Tanggal Mulai : <b><?= $CI->Mymodel->tgldmy($DtKj['tgl_mulai']);?></b> sampai 
				<b><?= $CI->Mymodel->tgldmy($DtKj['tgl_selesai']);?></b></p>
			<p>Status : 
			<span class="badge bg-<?= $cl[$DtKj['status_kj']];?>"><?= $st[$DtKj['status_kj']];?></span></p>
			<p>Batas Pendaftaran : <b><?= $CI->Mymodel->tgldmy($DtKj['tgl_max_daftar']);?></b></p>
			
		</div>
	</div>
</div>
</div>  

<div class="card mb-5">   
  <div class="card-body">
	<ul class="nav nav-tabs tab-pills">
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/kejurnas_detail/<?= $DtKj['id_kj'];?>">Kategori</a>
	  </li>
	  
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/kejurnas_iuran/<?= $DtKj['id_kj'];?>">Penerimaan Iuran</a>
	  </li> 
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/kejurnas_kaskeluar/<?= $DtKj['id_kj'];?>">Pengeluaran Kas</a>
	  </li> 
	   <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/kejurnas_peserta/<?= $DtKj['id_kj'];?>">Peserta</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link active"  aria-current="page">Time Line</a>
	  </li>
	 
	</ul>
	
	<p class="mt-4"><b>Time Line Kejurnas</b></p>
	<p class="text-end"><a href="<?= base_url();?>admin/kejurnas_time_new/<?= $DtKj['id_kj'];?>"
				class="btn btn-primary"><i class="mdi mdi-plus"></i> Tambah</a></p>
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
						<p>Status : <span class="badge bg-<?= $cl[$t->status_kegiatan];?>"><?= $st[$t->status_kegiatan];?></p>
						<p class="text-end">By <?= $t->nama_admin;?>
						<?php
						if (($_SESSION['ID_ADMIN']==3) || ($_SESSION['ID_ADMIN']==$t->id_admin) ) 
						{
							?>
						<a href="<?= base_url();?>admin/kejurnas_time_edit/<?= $t->id_timeline;?>"
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
<script>
	function hapus(idnya, nama)
	{

		Swal.fire({
			title: 'Hapus Timeline ?',
			html: "Anda akan menghapus <b>" + nama + "</b> !",
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak',    

		}).then((result) => {
			if (result.value) {            
			window.location.href = "<?= base_url();?>admin/kejurnas_time_del/" + idnya;           
			}
		})
	}
</script>
<?php include ('adm_akhir.php'); ?>