<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Berjalan', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
$jk=array('L'=>'Laki-laki', 'P'=>'Perempuan');
$clbar=array('info', 'succsess', 'primary', 'warning', 'secondary', 'danger');
include ('opr_awal_ctk.php'); ?>

<div class="container-fluid">
<h5 class="py-3 mb-4 text-center">INFORMASI PESERTA EVENT <?= strtoupper($DtEvent['nama_ev']);?></h5>

<p>Provinsi : <b><?= $_SESSION['NMPROV_OPR'];?></b></p>
		
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
		<table class="table">
			<thead><tr><th><tr><th>NO</th><th>NAMA PESERTA</th><th>UMUR</th><th>GELAR</th></tr></thead>
				<tbody>
		<?php	
			$n=1;
		foreach($DtPst as $x)
				{
								
					if (strlen($x->gelar)>20)
					{
						$g=substr($x->gelar,0,20).'...';
					}
					else
					{
						$g=$x->gelar;
					}
					?>
					<tr><td><?= $n;?></td>

						<td><?= $x->nama_pst;?></td>
						<td><?= $x->umur;?></td>
						<td><?= $g;?></td>
						
					</tr>
					<?php
					$n++;
				}
				?>
				</tbody>
				</table>
			<?php	
		
	}


	?>		
	
 
</div>

<?php include ('opr_akhir_ctk.php'); ?>