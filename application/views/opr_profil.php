<?php include 'opr_awal.php';
$gbr = base_url() . 'img/noimage.jpg';
?>

<h5 class="py-3 mb-4">Ubah Profil Pengguna</h5>

<div class="card mb-5">
    <div class="card-body">
        <form name="fttg" method="post" action="<?= base_url() ?>opr/profil_update" enctype="multipart/form-data">
            <fieldset class="mb-3"><label>Gambar (format jpg, max 2Mb)</label>
                <input type="file" name="foto" accept=".jpg,.jpeg,.png" id="filegambar" class="form-control"
                    onchange="return bacafile('imagesample',this.files[0],'filegambar','fileerror',2000000,'<?= base_url();?>img/opr/<?= $operator->foto?>');" />
                <p id="fileerror" class="text-danger"></p>
                <p class="mt-3"><img id="imagesample" height="100" src="<?= base_url();?>img/opr/<?= $operator->foto;?>" /></p>
            </fieldset>
            <fieldset class="mb-3"><label>Nama Operator</label>
            <input type="text" class="form-control" name="nama_operator" placeholder="Nama administrator" autofocus
            data-validate="required" maxlength="30" value="<?= $operator->nama_operator;?>">
            </fieldset>
            <fieldset class="mb-3"><label>Nama Pengguna</label>
                <input type="text" class="form-control" name="username" value="<?= $operator->user_name ?>"
                    placeholder="Nama Pengguna" autofocus data-validate="required" maxlength="255" />
            </fieldset class="mb-3">
            <fieldset class="mb-3"><label>Password</label>
                <input type="password" class="form-control" name="passwd" placeholder="Password" maxlength="10">
                <input type="hidden" value="<?= $operator->id_operator ?>" name="id_operator" id="">
                <p class="text-info">Kosongkan bila password tidak diubah !</p>
            </fieldset>



            <p class="text-center">

                <button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Simpan</button>
            </p>

        </form>
        <script>
            function bacafile(idimage, objekfile, idinput, iderrmsg, maxukuran, gbori) {
                var allowedFiles = [".jpg",".jpeg",".png"];
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
    </div>
</div>

<?php include 'opr_akhir.php'; ?>
