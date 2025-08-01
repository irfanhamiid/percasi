<?php include ('adm_awal.php'); ?>
    
    <h5 class="py-3 mb-4">Iuran Tahunan <?= date('Y') ?></h5>
    
    <div class="card mb-5">   
      <div class="card-body">
            <?php
            if($JmlProv==0)
            { echo '<div class="alert alert-danger">Belum ada data....</div>';} else
            {
                ?>
                <p class="text-end">
    	</p>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA PROVINSI</th>
                        <th>IURAN DIBAYAR</th>
                        <th>OPSI</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php
                    $no= 1;
                    foreach($DtProv as $a)
                    {
                        ?>
                        <tr>
                        <td style="width: 5%;"><?= $no++ ?></td>
                        <td><?= $a->provinsi ?></td>
                    <?php $tahun = date('Y');$i = $this->db->query("SELECT * FROM iurantahunan WHERE id_prov='$a->id_prov' AND tahun='$tahun'")->row() ?>
                        <?php if($i){ ?>
                        <td><?= number_format($i->jumlah) ?></td>
                        <td>
                            <a href="<?= base_url('admin/iuran_tahunan_detail/'.$i->id) ?>" class="btn btn-primary"> <i class="mdi mdi-magnify"></i></a>
                            <a href="<?= base_url('admin/iuran_tahunan_hapus/'.$i->id) ?>" class="btn btn-danger"> <i class="mdi mdi-trash-can"></i></a>
                        </td>
                        <?php }else{ ?>
                        <td>0</td>
                        <td><a href="<?= base_url('admin/bayar_iuran_tahunan/'.$a->id_prov);?>" class="btn btn-info"><i class="mdi mdi-plus"></i></a></td>
                        <?php } ?>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <script>
                function hapus(idnya, nama) {
    
                    Swal.fire({
                        title: 'Hapus Provinsi?',
                        html: "Anda akan menghapus <b>" + nama + "</b> !",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Tidak',
    
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = "<?= base_url('admin') ?>/provinsidel/" + idnya;
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