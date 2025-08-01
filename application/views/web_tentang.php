<?php
include ('web_awal.php');

if ($JmlTtg==0)
{
	?>
	<section class="pt-8">

    <div class="container">
       <div class="card myh-5">
			<div class="card-body">
				<div class="alert alert-info">Data tidak tersedia...</div>
			</div>
	   </div>
	</div>
	</section>
	<?php
}
else
{
	$gj=1;
	foreach($DtTtg as $t)
	{
		if ($gj==1)
		{
			echo '<section class="pt-8">';
			$gj=0;
		}
		else
		{
			echo '<section class="pt-8 bg-soft-primary">';
			$gj=1;
		}
		$g='img/'.$t->foto;
		if (file_exists('./'.$g))
		{
			$gbr=base_url().$g;
		}
		else
		{
			$gbr='NA';
		}
?>
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-xxl-5 text-center mx-auto">
						<h2><?= $t->judul; ?></h2>						
					</div>
				</div>
				   
				<div class="card myh-5">
					<div class="card-body">
						<?php
						if ($gbr!='NA')
						{
							echo '<p><img src="'.$gbr.'" class="img-fluid"/></p>';
						}
						?>
						<?= $t->deskripsi; ?>
					</div>
				</div>
				
			</div>
			</section>
<?php
	}
}

include ('web_akhir.php');
?>
