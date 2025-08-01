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
	
	<h5 class="mt-4">Data Pemenang</h5>
	
	<?php
	if ($JmlWinner==0)
	{
		echo '<div class="alert alert-danger">Belum ada pemenang...</div>';
	}
	else	
	{
		
		?>
		<p class="text-end">
			<a href="<?= base_url();?>admin/event_winner/<?= $DtEvent['id_ev'];?>/ctk" class="btn btn-primary btn-xs" target="_blank">
			<i class="mdi mdi-printer me-2"></i> Cetak</a>
		</p>
		
			
		<table class="table" id="dataTable">
			<thead><tr><th>PERINGKAT</th><th>KETERANGAN</th><th>NAMA</th><th>PROVINSI</th>
				<th>PIAGAM</th><th>AKSI</th></tr></thead>
			<tbody>
			<?php

			foreach ($DtWinner as $k)
			{
				$f='pdf/piagam/'.$k->idjuara.'.pdf';
				if (file_exists('./'.$f))
				{
					$fs=base_url().$f;
				}
				else
				{
					$fs='*';
				}
				?>
				<tr><td><?= $k->peringkat;?></td>
					<td><?= $k->keterangan;?></td>
					<td><?= $k->nama_pst;?></td>
					<td><?= $k->provinsi;?></td>
					<td>
						<?php
						if ($fs=='*')
						{
							?>
							<form name="fuplod<?= $k->idjuara;?>" method="post" enctype="multipart/form-data"
								action="<?= base_url();?>admin/event_winner_upload">
								<div class="input-group input-group-sm" style="max-width:500px;">
									<div class="input-group-text" id="inputGroup-sizing-sm">Upload Piagam</div>
									<input type="file" name="piagam" class="form-control" data-validate="required"
										aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm"/>
									<button type="submit" class="btn btn-info btn-sm"><i class="mdi mdi-upload"></i>
									</button>
									<input type="hidden" name="idj" value="<?= $k->idjuara;?>"/>
									<input type="hidden" name="ideve" value="<?= $DtEvent['id_ev'];?>"/>
								</div>	
							</form>
							<?php
						}
						else
						{
							echo '<a href="'.$fs.'" class="btn btn-info btn-xs" title="Piagam" target="_blank">
								<i class="mdi mdi-certificate"></i></a>
								<a href="#" class="btn btn-danger btn-xs" title="Hapus Piagam"
									onclick="return hapuspiagam(\''.$k->idjuara.'\', \''.$k->nama_pst.'\',\''.$DtEvent['id_ev'].'\');">
									<i class="mdi mdi-file-document-remove"></i></a>';
						}
						?>
					</td>
					<td>	
						<a href="#" class="btn btn-danger btn-xs" title="Hapus"
						onclick="return hapus('<?= $k->idjuara;?>','<?= $k->nama_pst;?>','<?= $DtEvent['id_ev'];?>');">
						<i class="mdi mdi-trash-can"></i></a>
					</td>
				</tr>
				<?php
			}
			?>
			</tbody>
			
		</table>
		<script>
			function hapus(idnya, nama, idev)
			{

				Swal.fire({
					title: 'Hapus Pemenang ?',
					html: "Anda akan menghapus <b>" + nama + "</b> dari pemenang !",
					icon: 'question',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ya',
					cancelButtonText: 'Tidak',    

				}).then((result) => {
					if (result.value) {            
					window.location.href = "<?= base_url();?>admin/event_winner_del/" + idnya+"/"+idev;           
					}
				})
			}
			
			function hapuspiagam(idnya, nama, idev)
			{

				Swal.fire({
					title: 'Hapus Piagam ?',
					html: "Anda akan menghapus piagamnya <b>" + nama + "</b> !",
					icon: 'question',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Ya',
					cancelButtonText: 'Tidak',    

				}).then((result) => {
					if (result.value) {            
					window.location.href = "<?= base_url();?>admin/event_winner_piagam_del/" + idnya+"/"+idev;           
					}
				})
			}
		</script>
	<?php		
	}		
	?>
  </div>
</div>

<?php include ('adm_akhir.php'); ?>