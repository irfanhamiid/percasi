<?php
$CI = &get_instance();
$CI->load->model('Mymodel');
include('adm_awal.php');
?>

<h5 class="py-3 mb-4"><span class="text-muted">Detail Event</span> <?= $DtEvent['nama_ev']; ?></h5>

<div class="card mb-5">
    <div class="card-body">
        <p class="text-end">

            <a href="<?= base_url(); ?>admin/event_ubah_status/<?= $DtEvent['id_ev']; ?>" class="btn btn-info btn-sm"> <i class="mdi mdi-pencil"></i> Ubah Status</a>
            <?php
            if ($_SESSION['TP_ADMIN'] == 3) {
            ?>
                <a href="#" class="btn btn-danger" title="Hapus"
                    onclick="return hapusevent('<?= $DtEvent['id_ev']; ?>','<?= $DtEvent['nama_ev']; ?>');">
                    <i class="mdi mdi-trash-can"></i> Hapus</a>
            <?php
            }
            ?>
            <a href="<?= base_url(); ?>admin/event/<?= $DtEvent['status_ev']; ?>/scr" class="btn btn-warning btn-sm"> <i class="mdi mdi-close"></i> Kembali</a>
        </p>
        <hr />
        <?php include('adm_event_info.php'); ?>
    </div>
</div>

<div class="card mb-5">
    <div class="card-body">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>admin/event_detail/<?= $DtEvent['id_ev']; ?>">Kategori dan Gelar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="<?= base_url(); ?>admin/event_peserta/<?= $DtEvent['id_ev']; ?>"><b>Peserta</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?= base_url(); ?>admin/event_peserta_penataran/<?= $DtEvent['id_ev']; ?>">Peserta Penataran</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>admin/event_time/<?= $DtEvent['id_ev']; ?>">Time Line</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>admin/event_iuran/<?= $DtEvent['id_ev']; ?>">Penerimaan Iuran/Registrasi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>admin/event_penlain/<?= $DtEvent['id_ev']; ?>">Penerimaan Lain</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>admin/event_kaskeluar/<?= $DtEvent['id_ev']; ?>">Pengeluaran Kas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>admin/event_keuangan/<?= $DtEvent['id_ev']; ?>">Keuangan</a>
            </li>

        </ul>


        <h6 class="mt-4">Data Peserta</h6>
        <div class="row my-4">
            <div class="col-sm-6">
                <form name="fprov" method="post" action="<?= base_url(); ?>admin/event_peserta_penataran/0/0/scr">
                    <div class="input-group">
                        <div class="input-group-text">Pilih Provinsi</div>
                        <select name="idprov" class="form-control">
                            <?php
                            echo '<option value="0"';
                            if ($IdProvNya == 0) {
                                echo ' selected="selected"';
                            }
                            echo '>Semua</option>';
                            foreach ($DtProv as $p) {
                                echo '<option value="' . $p->id_prov . '"';
                                if ($IdProvNya == $p->id_prov) {
                                    echo ' selected="selected"';
                                }
                                echo '>' . $p->provinsi . '</option>';
                            }
                            ?>
                        </select>
                        <button type="submit" class="btn btn-info"><i class="mdi mdi-magnify"></i></button>
                        <input type="hidden" name="idev" value="<?= $DtEvent['id_ev']; ?>" />
                    </div>
                </form>
            </div>
            <div class="col-sm-6 text-end">
                <?php
                if ($IdProvNya > 0) {
                ?>
                    <!-- <a href="<?= base_url(); ?>admin/event_peserta_penataran_new/<?= $DtEvent['id_ev']; ?>/<?= $IdProvNya; ?>" class="btn btn-primary btn-xs">
                        <i class="mdi mdi-plus"></i> Tambah Peserta</a> -->
                <?php
                } else {
                ?>
                    <!-- <a href="#" class="btn btn-danger btn-xs">Pilih provinsi untuk menambah peserta</a> -->
                <?php
                }

                if ($JmlPst > 0) {
                ?>
                    <a href="<?= base_url(); ?>admin/event_peserta_ctk/<?= $DtEvent['id_ev']; ?>/<?= $IdProvNya; ?>" class="btn btn-primary btn-xs" target="_blank">
                        <i class="mdi mdi-printer me-2"></i> Cetak</a>
                <?php
                }
                ?>
            </div>
        </div>
        <?php
        if ($JmlPst == 0) {
            echo '<div class="alert alert-danger">Belum ada data peserta ...</div>';
        } else {
            $jk = array('P' => 'Pria', 'W' => 'Wanita');
            $n = 1;
            $idktg = '-';
        ?>
            <div class="table-responsive">
                <table class="table" id="dataTable">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>PROVINSI</th>
                            <th>NAMA PESERTA</th>
                            <th>TANGGAL LAHIR</th>
                            </th>
                            <th>PENATARAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $n = 1;
                        foreach ($DtPst as $x) {

                            if (strlen($x->nama_penataran) > 20) {
                                $g = substr($x->nama_penataran, 0, 20) . '...';
                            } else {
                                $g = $x->nama_penataran;
                            }
                        ?>
                            <tr>
                                <td><?= $n; ?></td>
                                <td><?= $x->provinsi; ?></td>
                                <td><?= $x->nama_peserta; ?></td>
                                <td><?= date('d-m-Y', strtotime($x->tanggal_lahir)); ?></td>
                                <td><?= $g; ?></td>
                               
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        <?php
        }
        ?>

    </div>
</div>
<script>
    function hapusevent(idnya, nama) {

        Swal.fire({
            title: 'Hapus Event ?',
            html: "Anda akan menghapus <b>" + nama + "</b> !",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',

        }).then((result) => {
            if (result.value) {
                window.location.href = "<?= base_url(); ?>admin/event_del/" + idnya;
            }
        })
    }

    function hapussertifikat(idnya, nama, idev) {

        Swal.fire({
            title: 'Hapus Sertifikat ?',
            html: "Anda akan menghapus sertifikatnya <b>" + nama + "</b> !",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',

        }).then((result) => {
            if (result.value) {
                window.location.href = "<?= base_url(); ?>admin/event_peserta_sertifikat_del/" + idnya + "/" + idev;
            }
        })
    }

    function hapuspstp(idnya, nama, idev) {

        Swal.fire({
            title: 'Hapus Peserta ?',
            html: "Anda akan menghapus peserta <b>" + nama + "</b> !",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',

        }).then((result) => {
            if (result.value) {
                window.location.href = "<?= base_url(); ?>admin/event_peserta_penataran_del/" + idnya + "/" + idev;
            }
        })
    }
</script>

<?php include('adm_akhir.php'); ?>