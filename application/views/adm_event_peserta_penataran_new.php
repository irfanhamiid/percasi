<?php
$CI = &get_instance();
$CI->load->model('Mymodel');


include('adm_awal.php'); ?>

<h5 class="py-3 mb-4"><span class="text-muted">Tambah Peserta Pada Events </span> <?= $DtEvent['nama_ev']; ?></h5>

<div class="card mb-5">
    <div class="card-body">
        <p class="text-end">
            <a href="<?= base_url(); ?>admin/event_detail/<?= $DtEvent['id_ev']; ?>" class="btn btn-danger btn-sm"> <i class="mdi mdi-close"></i> Kembali</a>
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
                <a class="nav-link " aria-current="page"  href="<?= base_url(); ?>admin/event_peserta/<?= $DtEvent['id_ev']; ?>"><b>Peserta</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?= base_url(); ?>admin/event_peserta_penataran/<?= $DtEvent['id_ev']; ?>">Peserta Penataran</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="<?= base_url(); ?>admin/event_time/<?= $DtEvent['id_ev']; ?>">Time Line</a>
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

        <h5 class="my-5">Tambah Peserta Provinsi <?= $DtProv['provinsi']; ?></h5>

        <form name="fpstnew" method="post" action="<?= base_url(); ?>admin/event_peserta_penataran_new" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-4 offset-sm-2">
                    <fieldset><label>Nama Peserta</label>
                        <input type="text" name="nama_peserta" class="form-control myinput-required" data-validate="required"
                            maxlength="100" />
                    </fieldset>
                    <fieldset><label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control myinput-required" data-validate="required"
                            maxlength="100" />
                    </fieldset>
                    <fieldset><label>Tanggal Lahir</label>
                        <input type="date" id="tgllahir" name="tanggal_lahir" class="form-control myinput-required" data-validate="required" />
                    </fieldset>
                    <fieldset><label>File Surat Rekomendasi</label>
                        <input type="file" name="file_rekom" accept=".jpg,.jpeg,.png" data-validate="required"
                            id="filegambar" class="form-control myinput-required"
                            onchange="return rekomen('imagesample',this.files[0],'filegambar','fileerror',2000000,'<?= base_url(); ?>img/noimage.jpg');" />
                        <p id="fileerror" class="text-danger"></p>
                    </fieldset>
                </div>
                <div class="col-sm-4">
                    <fieldset><label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control myinput-required">
                            <option value="P">Pria</option>
                            <option value="W">Wanita</option>
                        </select>
                    </fieldset>
                    <fieldset><label>Penataran</label>
                        <select name="id_penataran" class="form-control myinput-required">
                            <?php
                            foreach ($DtPenataran as $k) {
                                echo '<option value="' . $k->id_penataran . '">' . $k->nama_penataran . ', ' . number_format($k->biaya, 0, ',', '.') . '</option>';
                            }
                            ?>
                        </select>
                    </fieldset>
                    <fieldset><label>File KTP</label>
                        <input type="file" name="file_ktp" accept=".jpg,.jpeg,.png" data-validate="required"
                            id="file_ktp" class="form-control myinput-required"
                            onchange="return ktp('ktps',this.files[0],'file_ktp','fileerror',2000000,'<?= base_url(); ?>img/noimage.jpg');" />
                        <p id="fileerror" class="text-danger"></p>
                    </fieldset>
                    <fieldset><label>File Pas Foto</label>
                        <input type="file" name="file_foto" accept=".jpg,.jpeg,.png" data-validate="required"
                            id="file_foto" class="form-control myinput-required"
                            onchange="return foto('pfoto',this.files[0],'file_foto','fileerror',2000000,'<?= base_url(); ?>img/noimage.jpg');" />
                        <p id="fileerror" class="text-danger"></p>
                    </fieldset>
                </div>
            </div>
            <p class="text-center mt-4">
                <a href="<?= base_url(); ?>admin/event_detail/<?= $DtEvent['id_ev']; ?>" class="btn btn-danger"><i class="mdi mdi-close"></i> Batal</a>
                <button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Simpan</button>
            </p>
            <input type="hidden" name="idev" value="<?= $DtEvent['id_ev']; ?>" />
            <input type="hidden" name="stev" value="<?= $DtEvent['status_ev']; ?>" />
            <input type="hidden" name="idprov" value="<?= $DtProv['id_prov'];?>"/>
        </form>
    </div>
</div>

<script>
    // Fungsi untuk menghitung umur berdasarkan tanggal lahir
    function hitungUmur(tanggal) {
        const today = new Date(); // Tanggal saat ini
        const birthDate = new Date(tanggal); // Konversi input tanggal ke Date object
        let umur = today.getFullYear() - birthDate.getFullYear(); // Selisih tahun

        // Cek apakah bulan/tanggal sudah lewat di tahun ini
        const bulan = today.getMonth() - birthDate.getMonth();
        if (bulan < 0 || (bulan === 0 && today.getDate() < birthDate.getDate())) {
            umur--; // Kurangi umur jika belum ulang tahun tahun ini
        }
        return umur;
    }

    // Event listener untuk menghitung umur saat input tanggal lahir berubah
    document.getElementById('tgllahir').addEventListener('change', function() {
        const tanggal = this.value;
        const umur = hitungUmur(tanggal);
        document.getElementById('umur').value = umur; // Tampilkan umur
    });
</script>

<?php include('adm_akhir.php'); ?>