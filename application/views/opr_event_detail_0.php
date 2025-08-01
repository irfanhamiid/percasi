<?php
$CI =& get_instance();
$CI->load->model('Mymodel');


include ('opr_awal.php'); ?>

<h5 class="py-3 mb-4">Informasi Event <span class="text-info"><?= $DtEvent['nama_ev'];?></span></h5>

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
	<ul class="nav nav-tabs">
	  <li class="nav-item">
		<a class="nav-link active" aria-current="page" href="#"><b>Kategori dan Gelar</b></a>
	  </li>
	   <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>opr/event_peserta/<?= $DtEvent['id_ev'];?>">Peserta Provinsi <?= $_SESSION['NMPROV_OPR'];?></a>
	  </li>
	  
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>opr/event_iuran/<?= $DtEvent['id_ev'];?>">Pembayaran Iuran</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>opr/event_time/<?= $DtEvent['id_ev'];?>">Timeline</a>
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

<?php include ('opr_akhir.php'); ?>