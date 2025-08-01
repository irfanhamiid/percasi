<?php include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Data Operator Provinsi</h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>admin/operator_new/" class="btn btn-primary" > <i class="mdi mdi-plus"></i> Tambah</a>
    </p>
    <?php
        if($JmlOpr==0)
        { echo '<div class="alert alert-danger">Belum ada data....</div>';} else
        {
            ?>
            <table class="table table-hover">
            <thead>
                <tr><th>No. Urut</th>
                <th>NAMA PROVINSI</th>
				<th>NAMA OPERATOR</th>
				<th>TELEPON</th>
				<th>EMAIL</th>
				<th>STATUS</th>
                <th>IURAN</th>
                <th>AKSI</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
				$n=1;
                foreach($DtOpr as $a)
                {
                    ?>
                    <tr><td><?= $n;?></td>
						<td><?= $a->provinsi;?></td>
						<td><?= $a->nama_operator;?></td>
						<td><?= $a->telepon;?></td>
						<td><?= $a->email;?></td>
						<td><span class="badge bg-<?= $STATUS_AKTIF_CLR[$a->aktif];?>"><?= $STATUS_AKTIF[$a->aktif];?></span></td>
                        <td>
                            <?php if($a->iuran == "sudah"){ ?>
                                <span class="badge bg-success"><?= ucfirst($a->iuran) ?></span>
                            <?php }else{ ?>
                                <span class="badge bg-danger"><?= ucfirst($a->iuran) ?></span>
                            <?php } ?>
                        </td>
                        <td>
                            <a href="<?= base_url();?>admin/operator_edit/<?= $a->id_operator;?>" class="btn btn-xs btn-info" title="Edit">
                                <i class="mdi mdi-pencil"></i></a>
                            <a href="#" class="btn btn-xs btn-danger" title="Hapus"
                                                    onclick="return hapus('<?= $a->id_operator;?>','<?= $a->nama_operator;?>');">
                                                    <i class="mdi mdi-trash-can"></i></a>
                            
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
						title: 'Hapus Operator?',
						html: "Anda akan menghapus <b>" + nama + "</b> !",
						icon: 'question',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Ya',
						cancelButtonText: 'Tidak',    

					}).then((result) => {
						if (result.value) {            
						window.location.href = "<?= base_url('admin') ?>/operator_del/" + idnya;           
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