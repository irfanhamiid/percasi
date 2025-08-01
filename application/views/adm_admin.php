<?php include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Data Admin</h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>admin/admin_new/" class="btn btn-primary" > <i class="mdi mdi-account-plus"></i> Tambah</a>
    </p>
    <?php
        if($JmlAdmin==0)
        { echo '<div class="alert alert-danger">Belum ada data....</div>';} else
        {
            ?>
            <table class="table table-hover">
            <thead>
                <tr>
                <th>NAMA ADMIN</th>
                <th>STATUS</th>
                <th>HAK AKSES</th>
                <th>AKSI</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
                foreach($DtAdmin as $a)
                {
                    ?>
                    <tr><td><?= $a->nama_admin;?></td>
                        <td><span class="badge bg-<?= $STATUS_AKTIF_CLR[$a->aktif];?>"><?= $STATUS_AKTIF[$a->aktif];?></span></td>
                        <td><span class="badge bg-<?= $TIPE_ADMIN_CLR[$a->tipe_admin];?>"><?= $TIPE_ADMIN[$a->tipe_admin];?></span></td>
                        <td>
                            <a href="<?= base_url();?>admin/admin_edit/<?= $a->id_admin;?>" class="btn btn-xs btn-info" title="Edit">
                                <i class="mdi mdi-pencil"></i></a>
                            <?php
                            if ($a->tipe_admin==2)
                            {
                                ?>									
									<a href="#" class="btn btn-xs btn-danger" title="Hapus"
                                                    onclick="return hapus('<?= $a->id_admin;?>','<?= $a->nama_admin;?>');">
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
						title: 'Hapus Administrator ?',
						html: "Anda akan menghapus <b>" + nama + "</b> !",
						icon: 'question',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Ya',
						cancelButtonText: 'Tidak',    

					}).then((result) => {
						if (result.value) {            
						window.location.href = "<?= base_url();?>admin/admin_del/" + idnya;           
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