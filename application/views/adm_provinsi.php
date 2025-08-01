<?php include 'adm_awal.php'; ?>

<h5 class="py-3 mb-4">Data Provinsi</h5>

<div class="card mb-5">
    <div class="card-body">
        <p class="text-end">
            <a href="<?= base_url() ?>admin/provinsi_new/" class="btn btn-primary"> <i class="mdi mdi-plus"></i> Tambah</a>
        </p>
        <?php
        if($JmlProv==0)
        { echo '<div class="alert alert-danger">Belum ada data....</div>';} else
        {
            ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>NAMA PROVINSI</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
                $no= 1;
                foreach($DtProv as $a)
                {
                    ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $a->provinsi ?></td>
                    <td>
                        <a href="<?= base_url() ?>admin/provinsi_edit/<?= $a->id_prov ?>" class="btn btn-xs btn-info"
                            title="Edit">
                            <i class="mdi mdi-pencil"></i></a>
                        <a href="#" class="btn btn-xs btn-danger" title="Hapus"
                            onclick="return hapus('<?= $a->id_prov ?>','<?= $a->provinsi ?>');">
                            <i class="mdi mdi-trash-can"></i></a>
                    </td>
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

<?php include 'adm_akhir.php'; ?>
