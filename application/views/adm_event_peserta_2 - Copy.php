<?php 
$CI =& get_instance();
$CI->load->model('Mymodel');
include ('adm_awal.php'); 
?>

<h5 class="py-3 mb-4"><span class="text-muted">Detail Event</span> <?= $DtEvent['nama_ev'];?></h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
		
		<a href="<?= base_url();?>admin/event_ubah_status/<?= $DtEvent['id_ev'];?>" class="btn btn-info btn-sm" > <i class="mdi mdi-pencil"></i> Ubah Status</a>
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
	
	
	<h6 class="mt-4">Data Peserta</h6>
	<div class="row my-4">
		<div class="col-sm-6">
			<form name="fprov" method="post" action="<?= base_url();?>admin/event_peserta/0/0/scr">
				<div class="input-group">
					<div class="input-group-text">Pilih Provinsi</div>
					<select name="idprov" class="form-control">
					<?php
					echo '<option value="0"';
					if ($IdProvNya==0) { echo ' selected="selected"'; }
					echo '>Semua</option>';
					foreach($DtProv as $p)
					{
						echo '<option value="'.$p->id_prov.'"';
						if ($IdProvNya==$p->id_prov) { echo ' selected="selected"'; }
						echo '>'.$p->provinsi.'</option>';
					}
					?>
					</select>
					<button type="submit" class="btn btn-info"><i class="mdi mdi-magnify"></i></button>
					<input type="hidden" name="idev" value="<?= $DtEvent['id_ev'];?>"/>
				</div>	
			</form>
		</div>
		<div class="col-sm-6 text-end">
			<?php
			if ($JmlPst>0)
			{
				?>
				<a href="<?= base_url();?>admin/event_peserta/<?= $DtEvent['id_ev'];?>/<?= $IdProvNya;?>/ctk" class="btn btn-primary btn-xs" target="_blank">
				<i class="mdi mdi-printer me-2"></i> Cetak</a>
				<?php
			}
			?>
		</div>
	</div>
	<?php
	if ($JmlPst==0)
	{
		echo '<div class="alert alert-danger">Belum ada data peserta ...</div>';
	}
	else
	{
		$jk=array('P'=>'Pria', 'W'=>'Wanita');
		$n=1; $idktg='-'; 
		?>
		<div class="accordion  accordion-flush" id="accordionExample">
		<?php
		foreach($DtPst as $p)
		{
			if ($idktg!=$p['idktg'])
			{
				if ($idktg!='-')
				{
					?>
					</div>
					</div>
					</div>
					<?php
				}
				?>
				<div class="accordion-item mb-1">
					<h2 class="accordion-header" id="headingOne">
					  <button class="accordion-button bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $p['idktg'];?>" aria-expanded="false" aria-controls="collapse<?= $p['idktg'];?>">
						<b><?= $p['kategori'];?></b>
					  </button>
					</h2>
					<div id="collapse<?= $p['idktg'];?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $p['idktg'];?>" data-bs-parent="#accordionExample">
					<div class="accordion-body">
				<?php
				$idktg=$p['idktg'];
			}
			
			foreach($p['jk'] as $y)
			{
				
				
				$n=1;$idjk='-';
				?>
				<p class="my-4"><b><?= $jk[$y['jknya']];?></b>, Peserta : <b><?= number_format($y['jmlpst'],0,',','.');?></b> orang</p>
				<?php
				if ($y['jmlpst']>0)
				{
					?>
					<table class="table table-sm table-bordered">
						<thead><tr><th>NO</th><th>PROVINSI</th><th>NAMA PESERTA</th><th>UMUR</th><th>GELAR</th>
							</tr></thead>
						<tbody>
					<?php
					foreach($y['pstnya'] as $x)
					{
						?>
						<tr><td><?= $n;?></td>
							<td><?= $x['provinsi'];?></td>
							<td><?= $x['namapst'];?></td>
							<td><?= $x['umur'];?></td>
							<td><?= $x['gelar'];?></td>
						</tr>	
						<?php
						$n++;
					}
					?>
					</tbody></table>
					
				<?php
				}
				?>
				<?php
			}
		}
		?>
		</div>
		</div>
		</div>
		<p class="p-2 mt-4 bg-light">Total Peserta : <b><?= number_format($JmlPst,0,',','.');?></b></p>
		
	<?php	
	}
	?>
			
  </div>
</div>
<script>
	function hapusevent(idnya, nama)
	{

		Swal.fire({
			title: 'Hapus Event ?',
			html: "Anda akan menghapus <b>" + nama + "</b> !",
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak',    

		}).then((result) => {
			if (result.value) {            
			window.location.href = "<?= base_url();?>admin/event_del/" + idnya;           
			}
		})
	}
</script>

<?php include ('adm_akhir.php'); ?>