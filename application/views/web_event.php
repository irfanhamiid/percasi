<?php
$CI =& get_instance();
$CI->load->model('Mymodel');
include ('web_awal.php');
?>


<section class="pt-8">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xxl-5 text-center mx-auto">
                <h2>Events</h2>
                <!--<p class="mb-4">Informasi event di PB Percasi</p>-->
            </div>
        </div>
        <div class="row mt-5">
			<?php
			if ($JmlEvent==0)
			{
				echo '<div class="alert alert-info">Belum ada data event</div>';
			}
			else
			{
				$st=array('Belum mulai', 'Berjalan', 'Selesai');
				$stclr=array('info', 'primary', 'success');
				foreach ($DtEvent as $b)
				{
					$poster='/img/poster/'.$b->poster;
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
				echo $Paging;
			}
			?>                
        </div>
    </div>
</section>

<?php
include ('web_akhir.php');
?>
