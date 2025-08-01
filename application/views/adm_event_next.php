<?php include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Data Event Belum Mulai</h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>admin/event_new/" class="btn btn-primary" > <i class="mdi mdi-account-plus"></i> Tambah</a>
    </p>
    <?php
        if($JmlEvent==0)
        { echo '<div class="alert alert-danger">Belum ada data....</div>';} else
        {
            ?>
			<div class="card-datatable table-responsive">
            <table class="dt-multilingual table table-bordered">
            <thead>
                <tr>
				<th>NO. URUT</th>
                <th>NAMA EVENT</th>
                <th>TGL. MULAI</th>
                <th>INPUT BY</th>
                <th>AKSI</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
				$n=1;
                foreach($DtEvent as $a)
                {
                    ?>
                    <tr><td><?= $n;?></td>
						<td><?= $a->nama_ev;?></td>
						<td><?= $a->tgl_ev;?>, Jam <?= $a->jam_ev;?></td>
						<td><?= $a->nama_admin;?></td>
                        <td>
                            <a href="<?= base_url();?>admin/event_detail/<?= $a->id_ev;?>" class="btn btn-xs btn-success" title="Detail">
                                <i class="mdi mdi-magnify"></i></a>
							<a href="<?= base_url();?>admin/event_edit/<?= $a->id_ev;?>" class="btn btn-xs btn-info" title="Edit">
                                <i class="mdi mdi-pencil"></i></a>
							<a href="#" class="btn btn-xs btn-danger" title="Hapus"
                                  onclick="return hapus('<?= $a->id_ev;?>','<?= $a->nama_ev;?>');">
                                  <i class="mdi mdi-trash-can"></i> belum</a>
                        </td>
                    </tr>
                    <?php
					$n++;
                }
                ?>
            </tbody>
            </table>
			</div>
			<script>
				function hapus(idnya, nama)
				{

					Swal.fire({
						title: 'Hapus Event ?',
						html: nama,
						icon: 'question',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Ya',
						cancelButtonText: 'Tidak',    

					}).then((result) => {
						if (result.value) {            
						window.location.href = "{{ @BASE }}/event_del/" + idnya;           
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