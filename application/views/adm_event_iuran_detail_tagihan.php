<?php
$CI = &get_instance();
$CI->load->model('Mymodel');

$st = array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl = array('info', 'primary', 'success', 'danger');
$stbayar = array('Belum diverifikasi', 'Sudah diverifikasi');
$stbayarcl = array('secondary', 'success');
include('adm_awal.php'); ?>

<h5 class="py-3 mb-4"><span class="text-muted">Informasi Peserta Event </span> <?= $DtEvent['nama_ev']; ?></h5>

<div class="card mb-5">
    <div class="card-body">
        <p class="text-end">
            <a href="<?= base_url(); ?>admin/event_iuran/<?= $DtEvent['id_ev']; ?>/scr"
                class="btn btn-warning"><i class="mdi mdi-close"></i> Kembali</a>
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
                <a class="nav-link" href="<?= base_url(); ?>admin/event_peserta/<?= $DtEvent['id_ev']; ?>">Peserta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>admin/event_time/<?= $DtEvent['id_ev']; ?>">Time Line</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page"><b>Penerimaan Iuran/Registrasi</b></a>
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

        <p class="mt-4">Detail Tagihan Peserta Provinsi : <b><?= $DtProvinsi['provinsi']; ?></b></p>
        <p class="text-end">
            <!-- 		
		<?php
        if ($JmlPst > 0) {
        ?>
			<a href="<?= base_url(); ?>opr/event_peserta/<?= $DtEvent['id_ev']; ?>/ctk" 
				class="btn btn-info" target="_blank">
			<i class="mdi mdi-printer me-2"></i> Cetak</a>
			<?php
        }
            ?> -->
        </p>
        <?php
        if ($JmlPst == 0) {
            echo '<div class="alert alert-danger">Belum ada peserta ...</div>';
        } else {



            if ($JmlPst == 0) {
                echo '<div class="alert alert-danger">Belum ada data peserta ...</div>';
            } else {
                $jk = array('P' => 'Pria', 'W' => 'Wanita');
                $n = 1;
                $idktg = '-';
        ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>ID NASIONAL</th>
                                <th>NAMA PESERTA</th>
                                <th>UMUR</th>
                                <th>GELAR</th>
                                <th>BIAYA REG</th>
                                <th>AKOMODASI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n = 1;
                            $total_reg = 0;
                            $total_biaya = 0;

                            foreach ($DtPst as $x) {
                                // Potong gelar jika panjangnya lebih dari 20 karakter
                                $g = (strlen($x->gelar) > 20) ? substr($x->gelar, 0, 20) . '...' : $x->gelar;

                                // Tambahkan ke total
                                $total_reg += $x->biaya_reg;
                                $total_biaya += $x->biaya;
                            ?>
                                <tr>
                                    <td><?= $n; ?></td>
                                    <td><?= $x->id_nasional; ?></td>
                                    <td><?= $x->nama_pst; ?></td>
                                    <td><?= $x->umur; ?></td>
                                    <td><?= $g; ?></td>
                                    <td class="text-end"><?= number_format($x->biaya_reg, 0); ?></td>
                                    <td class="text-end"><?= number_format($x->biaya, 0); ?></td>
                                </tr>
                            <?php
                                $n++;
                            }
                            ?>
                            <tr>
                                <td colspan="5"><strong>Total Tagihan</strong></td>
                                <td class="text-end"><strong><?= number_format($total_reg, 0); ?></strong></td>
                                <td class="text-end"><strong><?= number_format($total_biaya, 0); ?></strong></td>
                            </tr>

                        </tbody>
                    </table>
                </div>


        <?php
            }
        }
        ?>

    </div>
</div>
<script>
    function hapus(idnya, nama) {

        Swal.fire({
            title: 'Hapus Pembayaran ?',
            html: "Anda akan menghapus pembayaran tanggal <b>" + nama + "</b> !",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',

        }).then((result) => {
            if (result.value) {
                window.location.href = "<?= base_url(); ?>admin/event_iuran_byr_del/" + idnya;
            }
        })
    }
</script>
<?php include('adm_akhir.php'); ?>