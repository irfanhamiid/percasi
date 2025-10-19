<?php
$CI = &get_instance();
$CI->load->model('Mymodel');

$st = array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl = array('info', 'primary', 'success', 'danger');
include('opr_awal.php'); ?>

<h5 class="py-3 mb-4">Tambah Peserta Penataran <span class="text-info"><?= $DtEvent['nama_ev']; ?></span></h5>


<div class="card mb-5">
    <div class="card-body">
        <p class="text-end">
            <a href="<?= base_url(); ?>opr/event_detail/<?= $DtEvent['id_ev']; ?>" class="btn btn-warning"><i class="mdi mdi-close"></i> Kembali</a>
        </p>
        <p><b>Event : <?= $DtEvent['nama_ev']; ?></b></p>

        <form name="fpstnew" method="post" action="<?= base_url(); ?>opr/event_peserta_penataran_new" enctype="multipart/form-data">
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
                        <p class="mt-3"><img id="imagesample" height="100" src="<?= base_url(); ?>img/noimage.jpg" /></p>
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
                        <p class="mt-3"><img id="ktps" height="100" src="<?= base_url(); ?>img/noimage.jpg" /></p>
                    </fieldset>
                    <fieldset><label>File Pas Foto</label>
                        <input type="file" name="file_foto" accept=".jpg,.jpeg,.png" data-validate="required"
                            id="file_foto" class="form-control myinput-required"
                            onchange="return foto('pfoto',this.files[0],'file_foto','fileerror',2000000,'<?= base_url(); ?>img/noimage.jpg');" />
                        <p id="fileerror" class="text-danger"></p>
                        <p class="mt-3"><img id="pfoto" height="100" src="<?= base_url(); ?>img/noimage.jpg" /></p>
                    </fieldset>
                </div>
            </div>
            <p class="text-center mt-4">
                <a href="<?= base_url(); ?>opr/event_detail/<?= $DtEvent['id_ev']; ?>" class="btn btn-danger"><i class="mdi mdi-close"></i> Batal</a>
                <button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Simpan</button>
            </p>
            <input type="hidden" name="idev" value="<?= $DtEvent['id_ev']; ?>" />
            <input type="hidden" name="stev" value="<?= $DtEvent['status_ev']; ?>" />
        </form>
    </div>
</div>

<script>
    function rekomen(idimage, objekfile, idinput, iderrmsg, maxukuran, gbori) {
        var allowedFiles = [".png", ".jpg", ".jpeg"];
        var fileUpload = document.getElementById(idinput);
        var lblError = document.getElementById(iderrmsg);
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(fileUpload.value.toLowerCase())) {
            lblError.innerHTML = "Mohon hanya upload tipe file : <b>" + allowedFiles.join(', ') + "</b>.";
            fileUpload.value = "";
            document.getElementById(idimage).src = gbori;


            return false;
        } else {
            if (objekfile.size > maxukuran) {
                var l = maxukuran.toString();
                var p = l.length - 3;
                var s = l.substring(0, p);
                lblError.innerHTML = "Ukuran file terlalu besar, maksimal " + s + "KB.";
                fileUpload.value = "";
                document.getElementById(idimage).src = gbori;
                return false;
            } else {
                lblError.innerHTML = "";
                document.getElementById(idimage).src = window.URL.createObjectURL(objekfile)
                return true;
            }
        }
    }

    function ktp(idimage, objekfile, idinput, iderrmsg, maxukuran, gbori) {
        var allowedFiles = [".png", ".jpg", ".jpeg"];
        var fileUpload = document.getElementById(idinput);
        var lblError = document.getElementById(iderrmsg);
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(fileUpload.value.toLowerCase())) {
            lblError.innerHTML = "Mohon hanya upload tipe file : <b>" + allowedFiles.join(', ') + "</b>.";
            fileUpload.value = "";
            document.getElementById(idimage).src = gbori;


            return false;
        } else {
            if (objekfile.size > maxukuran) {
                var l = maxukuran.toString();
                var p = l.length - 3;
                var s = l.substring(0, p);
                lblError.innerHTML = "Ukuran file terlalu besar, maksimal " + s + "KB.";
                fileUpload.value = "";
                document.getElementById(idimage).src = gbori;
                return false;
            } else {
                lblError.innerHTML = "";
                document.getElementById(idimage).src = window.URL.createObjectURL(objekfile)
                return true;
            }
        }
    }

    function foto(idimage, objekfile, idinput, iderrmsg, maxukuran, gbori) {
        var allowedFiles = [".png", ".jpg", ".jpeg"];
        var fileUpload = document.getElementById(idinput);
        var lblError = document.getElementById(iderrmsg);
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(fileUpload.value.toLowerCase())) {
            lblError.innerHTML = "Mohon hanya upload tipe file : <b>" + allowedFiles.join(', ') + "</b>.";
            fileUpload.value = "";
            document.getElementById(idimage).src = gbori;


            return false;
        } else {
            if (objekfile.size > maxukuran) {
                var l = maxukuran.toString();
                var p = l.length - 3;
                var s = l.substring(0, p);
                lblError.innerHTML = "Ukuran file terlalu besar, maksimal " + s + "KB.";
                fileUpload.value = "";
                document.getElementById(idimage).src = gbori;
                return false;
            } else {
                lblError.innerHTML = "";
                document.getElementById(idimage).src = window.URL.createObjectURL(objekfile)
                return true;
            }
        }
    }
</script>

<?php include('opr_akhir.php'); ?>