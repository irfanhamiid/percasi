<?php 
$CI =& get_instance();
$CI->load->model('Mymodel');
$st=array('Tidak aktif', 'Aktif');
$st_cl=array('danger', 'success');
include ('adm_awal.php'); 

?>

<h5 class="py-3 mb-4">Data Berita</h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>admin/berita_new/" class="btn btn-primary" > <i class="mdi mdi-plus"></i> Tambah</a>
    </p>
    <?php
        if($JmlBerita==0)
        { echo '<div class="alert alert-danger">Belum ada data....</div>';} else
        {
            ?>
            <table class="table table-hover">
            <thead>
                <tr>
                <th>NO. URUT</th>
                <th>JUDUL</th>
                <th>TGL POST</th>
                <th>STATUS</th>
                <th>ADMIN</th>
                <th>AKSI</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
				$n=1;
                foreach($DtBerita as $a)
                {
                    ?>
                    <tr><td><?= $n;?></td>
						<td><?= $a->judul;?></td>
						<td><?= $CI->Mymodel->dttime_dmy($a->tgl_post);?></td>
						<td><span class="badge bg-<?= $st_cl[$a->aktif];?>"><?= $st[$a->aktif];?></span></td>
						<td><?= $a->nama_admin;?></td>
                        <td>
                            <a href="<?= base_url();?>admin/berita_edit/<?= $a->id_berita;?>" class="btn btn-xs btn-info" title="Edit">
                                <i class="mdi mdi-pencil"></i></a>
                            <?php
                            if ($_SESSION['TP_ADMIN']==3)
                            {
                                ?>									
									<a href="#" class="btn btn-xs btn-danger" title="Hapus"
                                                    onclick="return hapus('<?= $a->id_berita;?>','<?= $a->judul;?>');">
                                                    <i class="mdi mdi-trash-can"></i> belum</a>
                                <?php
                            }   
                            ?> 
                        </td>
                    </tr>
                    <?php
					$n++;
                }
                ?>
            </tbody>
            </table>
			<script>
				function hapus(idnya, nama)
				{

					Swal.fire({
						title: 'Hapus Berita ?',
						html: "<b>" + nama + "</b> !",
						icon: 'question',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Ya',
						cancelButtonText: 'Tidak',    

					}).then((result) => {
						if (result.value) {            
						window.location.href = "<?= base_url();?>admin/berita_del/" + idnya;           
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