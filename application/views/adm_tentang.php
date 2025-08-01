<?php include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Data Tentang Kami</h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>admin/tentang_new/" class="btn btn-primary" > <i class="mdi mdi-account-plus"></i> Tambah</a>
    </p>
    <?php
        if($JmlTentang==0)
        { echo '<div class="alert alert-danger">Belum ada data....</div>';} else
        {
            ?>
            <table class="table table-hover">
            <thead>
                <tr>
                <th>JUDUL</th>
                <th>STATUS</th>
                <th>AKSI</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
                foreach($DtTentang as $a)
                {
                    ?>
                    <tr><td><?= $a->judul;?></td>
                        <td><span class="badge bg-<?= $STATUS_AKTIF_CLR[$a->aktif];?>"><?= $STATUS_AKTIF[$a->aktif];?></span></td>
                        <td>
                            <a href="<?= base_url();?>admin/tentang_edit/<?= $a->id_ttg;?>" class="btn btn-xs btn-info" title="Edit">
                                <i class="mdi mdi-pencil"></i></a>
							<a href="#" class="btn btn-xs btn-danger" title="Hapus"
                               onclick="return hapus('<?= $a->id_ttg;?>','<?= $a->judul;?>');">
                                     <i class="mdi mdi-trash-can"></i></a>
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
						title: 'Hapus Data ?',
						html: "Anda akan menghapus <b>" + nama + "</b> !",
						icon: 'question',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Ya',
						cancelButtonText: 'Tidak',    

					}).then((result) => {
						if (result.value) {            
						window.location.href = "<?= base_url();?>admin/tentang_del/" + idnya;           
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