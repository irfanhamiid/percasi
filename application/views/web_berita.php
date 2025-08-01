<?php
$CI =& get_instance();
$CI->load->model('Mymodel');
include ('web_awal.php');
?>

<section class="pt-8">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xxl-5 text-center mx-auto">
                <h2>Berita Terkini</h2>
                <!--<p class="mb-4">Berabagai informasi di PB Percasi</p>-->
            </div>
        </div>
           
		<div class="card myh-5">
			<div class="card-body">
				<?php
				if ($JmlBerita==0)
				{ echo '<div class="alert alert-info">Belum ada data...</div>'; } else
				{
					foreach ($DtBerita as $b)
					{
						?>
					<div class="row mb-2">	
						<div class="col-sm-3">
							<img class="w-100" src="<?= base_url();?>img/berita/<?= $b->foto;?>" alt=""></div>
						<div class="col-sm-9">  
							<h5><?= $b->judul;?></h5>
							<p class="mb-2"><?= $b->ringkasan;?></p>
							<p>
								<span class="small"><i class="fas fa-calendar"></i> <?= $CI->Mymodel->dttime_dmy($b->tgl_post);?>, oleh :
									<?= $b->nama_admin;?>
								</span>
								<span class="float-end">
								<a href="<?= base_url();?>/web/berita_detail/<?= $b->id_berita;?>" class="btn btn-xs btn-outline-primary">
								<i class="fas fa-link"></i> Baca</a></span>
								
							</p>  
						</div>
					</div>
					<?php
					}
					echo $Paging;
				}
				
				?>
			</div>

	  
		</div>
    </div>
</section>

<?php
include ('web_akhir.php');
?>
