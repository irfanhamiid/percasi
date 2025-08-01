<?php
$CI =& get_instance();
$CI->load->model('Mymodel');
$g='/img/berita/'.$DtBerita['foto'];
if (file_exists('.'.$g))
{
	$gbrthumb=base_url().$g;
}
else
{
	$gbrthumb=base_url().'/img/noimage.jpg/';
}	
$g='/img/berita/'.$DtBerita['foto'];
if (file_exists('.'.$g))
{
	$gbr=base_url().$g;
}
else
{
	$gb=base_url().'/img/noimage.jpg';
}	

include ('web_awal.php');
?>


<section class="pt-8">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xxl-5 text-center mx-auto">
                <h2><?= $DtBerita['judul'];?></h2>
                
            </div>
        </div>
           
		<div class="card myh-5">
			<div class="card-body">
				<p><img src="<?= $gbr;?>" alt="gambar" class="img-fluid"/></p>
				<p><i class="fas fa-calendar"></i> <?= $CI->Mymodel->dttime_dmy($DtBerita['tgl_post']);?> |
					<i class="fas fa-user-o"></i> <?= $DtBerita['nama_admin'];?></p>
				<?= $DtBerita['detail'];?>
			</div>

	  
		</div>
    </div>
</section>

<section class="pt-8 bg-soft-primary">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xxl-5 text-center mx-auto">
                <h2>Berita Lainnya</h2>
            </div>
        </div>
		<div class="card myh-5">
			<div class="card-body">
				<?php
				if ($JmlBeritaLain==0)
				{ echo '<div class="alert alert-info">Belum ada berita lainnya...</div>'; } else
				{
					foreach ($DtBeritaLain as $b)
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
				}
				
				?>
			</div>

	  
		</div>
    </div>
</section>
<?php
include ('web_akhir.php');
?>
