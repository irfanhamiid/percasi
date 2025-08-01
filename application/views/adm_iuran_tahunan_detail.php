<?php $CI =& get_instance();
$CI->load->model('Mymodel');include ('adm_awal.php'); ?>
    
    <h5 class="py-3 mb-4">Iuran Tahunan <?= date('Y') ?></h5>
    
    <div class="card mb-5">   
      <div class="card-body">
            <h5 class="my-4">Provinsi : <?= $DtBayar['provinsi'];?></h5>
            <hr/>
            <div class="row">
		<div class="col-sm-4">			
            <p>Jumlah Pembayaran : <span class="float-end"><b><?= number_format($DtBayar['jumlah'],0,',','.');?></b></span></p>
			<p>Tanggal Bayar : <span class="float-end"><b><?= $CI->Mymodel->tgldmy($DtBayar['tanggal_bayar']);?></b></span></p>
            <p><b>Pembayar</b></p>
            <p>Nama pembayar: <span class="float-end"><b><?= $DtBayar['nama_pembayar'];?></b></span></p>
			<p>Catatan Pembayar :<br/><em><?= stripslashes($DtBayar['catatan']);?></em></p>
            <p><b>Penerima</b></p>
            <p>Nama Penerima : <span class="float-end"><b><?= $DtBayar['nama_penerima'];?></b></span></p>
            <a href="<?= base_url('admin/iuran_tahunan') ?>" class="btn btn-secondary">Kembali</a>
		</div>
		<div class="col-sm-4">
			<p><b>Bukti Pembayaran</b></p>
	<p class="mt-3"><img class="img-fluid" src="<?= base_url();?>img/bayar/<?= $DtBayar['bukti'];?>"/></p>	
		</div>
	</div>	
	
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
    
      </div>
    </div>
    
    <?php include ('adm_akhir.php'); ?>