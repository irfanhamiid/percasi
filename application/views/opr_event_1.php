<?php 
$CI =& get_instance();
$CI->load->model('Mymodel');
include ('opr_awal.php'); 
$st=array('Belum Berjalan', 'Berjalan', 'Selesai');
?>

<h5 class="py-3 mb-4">Data Event <span class="text-info">Berjalan</span></h5>

<div class="card mb-5">   
  <div class="card-body">
    
    <?php
        if($JmlEvent==0)
        { echo '<div class="alert alert-danger">Belum ada data....</div>';} else
        {
            ?>
            <table class="table table-hover">
            <thead>
                <tr>
                <th>NO</th>
                <th>EVENT</th>
                <th>TANGGAL</th>
                <th>AKSI</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
				
				$n=1;
                foreach($DtEvent as $k)
                {
                    ?>
                    <tr><td><?= $n;?></td>
						<td><?= $k->nama_ev;?></td>
						<td><?= $CI->Mymodel->tgldmy($k->tgl_mulai_ev);?> sd <?= $CI->Mymodel->tgldmy($k->tgl_selesai_ev);?></td>
						<td>
							<a href="<?= base_url();?>opr/event_detail/<?= $k->id_ev;?>" 
										class="btn btn-info btn-xs"><i class="mdi mdi-magnify"></i></a>
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