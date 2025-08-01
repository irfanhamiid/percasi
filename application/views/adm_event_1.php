<?php 
$CI =& get_instance();
$CI->load->model('Mymodel');
include ('adm_awal.php'); 
?>

<h5 class="py-3 mb-4"><span class="text-muted">Data Events</span> Berjalan</h5>

<div class="card mb-5">   
  <div class="card-body">
    <?php
        if($JmlEv==0)
        { echo '<div class="alert alert-danger">Belum ada data....</div>';} else
        {
            ?>
            <table class="table table-hover dataTable">
            <thead>
                <tr><th>EVENTS</th><th>TGL MULAI</th><th>TGL SELESAI</th><th>BATAS DAFTAR</th>
                <th>AKSI</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
                foreach($DtEv as $e)
                {
                    ?>
                    <tr><td><?= $e->nama_ev;?></td>
                        <td><?= $CI->Mymodel->tgldmy($e->tgl_mulai_ev);?></td>
                        <td><?= $CI->Mymodel->tgldmy($e->tgl_selesai_ev);?></td>
                        <td><?= $CI->Mymodel->tgldmy($e->tgl_bts_daftar);?></td>
                        <td>
                            <a href="<?= base_url();?>admin/event_detail/<?= $e->id_ev;?>" class="btn btn-xs btn-info" title="Detail">
                                <i class="mdi mdi-magnify"></i></a>
							
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

<?php include ('adm_akhir.php'); ?>