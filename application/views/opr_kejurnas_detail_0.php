<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Berjalan', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
include ('opr_awal.php'); ?>

<h5 class="py-3 mb-4">Informasi Kejurnas <span class="text-info">Belum Berjalan</span></h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>opr/kejurnas" class="btn btn-danger" ><i class="mdi mdi-close"></i> Kembali</a>
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
	<ul class="nav nav-tabs">
	  <li class="nav-item bg-light">
		<a class="nav-link active" aria-current="page" href="#">Kategori</a>
	  </li>
	   <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>opr/kejurnas_peserta/<?= $DtKj['id_kj'];?>">Peserta Provinsi <?= $_SESSION['NMPROV_OPR'];?></a>
	  </li>
	  
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>opr/kejurnas_iuran/<?= $DtKj['id_kj'];?>">Pembayaran Iuran</a>
	  </li>
	 
	</ul>
	
	<div class="row">
		<div class="col-sm-5">
			<p class="mt-4"><b>Data Kategori</b></p>
			<?php
			if ($JmlKtg==0)
			{
				echo '<div class="alert alert-danger">Belum ada kategori pertandingan...</div>';
			}
			else	
			{
				?>
				<table class="table">
					<thead><tr><th>KATEGORI</th></tr></thead>
					<tbody>
					<?php
					foreach ($DtKtg as $k)
					{
						?>
						<tr><td><?= $k->kategori;?></td></tr>
						<?php
					}
					?>
					</tbody>
				</table>
			<?php		
			}		
			?>		
		</div>
		<div class="col-sm-7">
			<p class="mt-4"><b>Data Gelar</b></p>
			<?php
			if ($JmlGelar==0)
			{
				echo '<div class="alert alert-danger">Belum ada data gelar...</div>';
			}
			else	
			{
				?>
				<table class="table">
					<thead><tr><th>GELAR</th><th class="text-end">BIAYA REG.</th></tr></thead>
					<tbody>
					<?php
					foreach ($DtGelar as $k)
					{
						?>
						<tr><td><?= $k->gelar;?></td>
							<td class="text-end"><?= number_format($k->biaya_reg,0,',','.');?></td>
						</tr>
						<?php
					}
					?>
					</tbody>
				</table>
			<?php		
			}		
			?>	
	  </div>	
  </div>
</div>
<script>
	function hapus_glr(idnya, nama)
	{

		Swal.fire({
			title: 'Hapus Gelar ?',
			html: "Anda akan menghapus <b>" + nama + "</b> !",
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak',    

		}).then((result) => {
			if (result.value) {            
			window.location.href = "<?= base_url();?>admin/kejurnas_glr_del/" + idnya;           
			}
		})
	}
</script>

<?php include ('opr_akhir.php'); ?>