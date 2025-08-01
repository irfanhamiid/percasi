<?php
$CI =& get_instance();
$CI->load->model('Mymodel');
$g='/img/poster/'.$DtEvent['id_ev'].'_thumb.jpg';
if (file_exists('.'.$g))
{
	$posterthumb=base_url().$g;
}
else
{
	$posterthumb=base_url().'/img/noimage.jpg/';
}	
$g='/img/poster/'.$DtEvent['id_ev'].'.jpg';
if (file_exists('.'.$g))
{
	$poster=base_url().$g;
}
else
{
	$poster=base_url().'/img/noimage.jpg';
}	
$st=array('Belum mulai', 'Berjalan', 'Selesai');
$stclr=array('info', 'primary', 'success');

include ('web_awal.php');
?>


<section class="pt-8">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xxl-5 text-center mx-auto">
                <h2><?= $DtEvent['nama_ev'];?></h2>
                
            </div>
        </div>
           
		<div class="card myh-5">
			<div class="card-body">
				<p><img src="<?= $poster;?>" alt="gambar" class="img-fluid"/></p>
				<p><span class="badge bg-<?= $stclr[$DtEvent['status_ev']];?>"><?= $st[$DtEvent['status_ev']];?></span> |				
				<i class="fas fa-calendar"></i> Pelaksanaan Event <?= $CI->Mymodel->tgldmy($DtEvent['tgl_mulai_ev']);?> |
				   <i class="fas fa-calendar"></i> Batas Pendaftaran <?= $CI->Mymodel->tgldmy($DtEvent['tgl_bts_daftar']);?></p>
			</div>
		</div>
		<div class="card  mt-5">
			<div class="card-body">
				<h5>Data Peserta</h5>
				<?php
				if ($JmlPeserta==0)
				{
					echo '<div class="alert alert-info">Belum ada peserta...</div>';
				}
				else
				{
					?>
					<table class="table dataTable">
						<thead><tr><th>Nama</th><th>ID Peserta</th><th>Provinsi</th><th>Kategori</th></tr></thead>
						<tbody>
						<?php
						foreach($DtPeserta as $p)
						{
							$id='******'.substr($p->id_pst_ev,6);
							?>
							<tr><td><?= $p->nama_pst;?></td>
								<td><?= $id;?></td>
							    <td><?= $p->provinsi;?></td>
								<td><?= $p->kategori;?></td>
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
			<?php
			if ($DtEvent['status_ev']==2)
			{
				?>
				<div class="card mt-5">
					<div class="card-body">
						<h5>Data Pemenang</h5>
						<table class="table dataTable">
						<thead><tr><th>Keterangan</th><th>Nama Peserta</th></tr></thead>
						<tbody>
						<?php
						foreach($Juara as $p)
						{
							?>
							<tr><td><?= $p->keterangan;?></td>
								<td><?= $p->nama_pst;?></td>
							</tr>
						<?php
						}
						?>
						</tbody>
					</table>
					</div>
				</div>	
				<?php
			}
			?>
		</div>
    </div>
</section>

<section class="pt-8 bg-soft-primary">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xxl-5 text-center mx-auto">
                <h2>Events Lainnya</h2>
                <p class="mb-4">Informasi event lain yang dilaksanakan oleh PB Percasi</p>
            </div>
        </div>
        <div class="row mt-5">
			<?php
			if ($JmlEventLain==0)
			{
				echo '<div class="alert alert-info">Belum ada data event</div>';
			}
			else
			{
				$st=array('Belum mulai', 'Berjalan', 'Selesai');
				$stclr=array('info', 'primary', 'success');
				foreach ($DtEventLain as $b)
				{
					$poster='/img/poster/'.$b->id_ev.'_thumb.jpg';
					if (file_exists('.'.$poster))
					{
						$fposter=base_url().$poster;
					}
					else
					{
						$fposter=base_url().'/img/noimage.jpg/';
					}	
					?>
					<div class="col-sm-6 mb-3">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-4">
										<img class="w-100" src="<?= $fposter;?>" alt="Event"></div>
									<div class="col-sm-8">  
										<h5><?= $b->nama_ev;?></h5>
										<p class="mb-2">
											<span class="badge bg-<?= $stclr[$b->status_ev];?>"><?= $st[$b->status_ev];?></span><br/>
											<i class="fas fa-calendar"></i> Pelaksanaan <?= $CI->Mymodel->tgldmy($b->tgl_mulai_ev);?><br/>
											<i class="fas fa-calendar"></i> Pendaftaran <?= $CI->Mymodel->tgldmy($b->tgl_bts_daftar);?></p>
										<p class="text-end"><a href="<?= base_url();?>/web/event_detail/<?= $b->id_ev;?>" class="btn btn-xs btn-outline-primary"><i class="fas fa-link"></i> Baca</a>
										</p>  
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
			}
			?>                
        </div>
    </div>
</section>

<?php
include ('web_akhir.php');
?>
