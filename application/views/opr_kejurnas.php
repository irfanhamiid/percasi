<?php 
$CI =& get_instance();
$CI->load->model('Mymodel');
include ('opr_awal.php'); 
$st=array('Belum Berjalan', 'Berjalan', 'Selesai');
?>

<h5 class="py-3 mb-4">Data Kejurnas <span class="text-info"><?= $st[$Status_KJ];?></span></h5>

<div class="card mb-5">   
  <div class="card-body">
    
    <?php
        if($JmlKj==0)
        { echo '<div class="alert alert-danger">Belum ada data....</div>';} else
        {
            ?>
            <table class="table table-hover">
            <thead>
                <tr>
                <th>NO</th>
                <th>KEJURNAS</th>
                <th>TANGGAL</th>
                <th>AKSI</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
				
				$cl=array('info', 'primary', 'success', 'danger');
				$n=1;
                foreach($DtKj as $k)
                {
                    ?>
                    <tr><td><?= $n;?></td>
						<td><?= $k->nama_kj;?></td>
						<td><?= $CI->Mymodel->tgldmy($k->tgl_mulai);?> sd <?= $CI->Mymodel->tgldmy($k->tgl_selesai);?></td>
						<td>
							<a href="<?= base_url();?>opr/kejurnas_detail/<?= $k->id_kj;?>" 
										class="btn btn-info btn-xs"><i class="mdi mdi-magnify"></i> Detail</a>
                        </td>
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

<?php include ('opr_akhir.php'); ?>