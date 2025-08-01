<?php 
$CI =& get_instance();
$CI->load->model('Mymodel');
include ('adm_awal.php'); 
?>

<h5 class="py-3 mb-4"><span class="text-muted">Data Events</span> Belum Mulai</h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>admin/event_new/" class="btn btn-primary" > <i class="mdi mdi-plus"></i> Tambah Event</a>
    </p>
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
							<a href="<?= base_url();?>admin/event_edit/<?= $e->id_ev;?>" class="btn btn-xs btn-info" title="Edit">
                                <i class="mdi mdi-pencil"></i></a>
							
                            <?php
                            if ($_SESSION['TP_ADMIN']==3)
                            {
                                ?>									
									<a href="#" class="btn btn-xs btn-danger" title="Hapus"
                                                    onclick="return hapus('<?= $e->id_ev;?>','<?= $e->nama_ev;?>');">
                                                    <i class="mdi mdi-trash-can"></i></a>
                                <?php
                            }   
                            ?> 
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
            </table>
			<script>
				function hapus(idnya, nama)
				{

					Swal.fire({
						title: 'Hapus Events ?',
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
            <?php
        }
    ?>
    
  </div>
</div>

<?php include ('adm_akhir.php'); ?>