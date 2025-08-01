<section class="py-0 py-xxl-6" id="help">
    <div class="bg-holder" style="background-image:url(<?= base_url();?>img/footer-bg.png);background-position:center;background-size:cover;">
    </div>
    
    <div class="container">
        <div class="row min-vh-75 min-vh-xl-50 pt-10">
        <div class="col-sm-2 mb-3">
            <img src="<?= base_url();?>img/percasi.png" height="100" alt="percasi" style="border-radius: 100%;"/>
        </div>    
        <div class="col-sm-6 mb-3 text-white">
            <h5><?= $INSTANSI['nama_instansi'];?></h5>
            <p><i class="fas fa-map-marker"></i> <?= $INSTANSI['alamat'];?></p>
            <p><i class="fas fa-phone"></i> <?= $INSTANSI['telepon'];?> | <i class="fab fa-whatsapp"></i> <?= $INSTANSI['telepon_wa'];?><br/>
            <i class="fas fa-envelope"></i> <?= $INSTANSI['email'];?></p>
        </div>
        <div class="col-sm-4 mb-3 text-end">
            <ul class="list-unstyled mb-md-4 mb-lg-0">
            <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!"><i class="fas fa-home"></i> Beranda</a></li>
            <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!"><i class="fas fa-newspaper"></i> Berita</a></a></li>
            <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!"><i class="fas fa-calendar"></i> Events</a></li>
            <li class="lh-lg"><a class="text-200 text-decoration-none" href="#!"><img src="<?= base_url();?>img/kuda_putih.png" height="16"/> Tentang Kami</a></li>
            </ul>
        </div>
        
        </div>
        <hr />
        <div class="row flex-center pb-3">
        <div class="col-md-6 order-0">
            <p class="text-200 text-center text-md-start">All rights Reserved &copy; <?= $INSTANSI['nama_instansi'];?>, <?= date('Y');?></p>
        </div>
        <div class="col-md-6 order-1">
            <p class="text-200 text-center text-md-end"> Made by Retno Utami</p>
        </div>
        </div>
    </div>
</section>

</main>
<script src="<?= base_url();?>cssjs_materio/jquery.js"></script>
<script src="<?= base_url();?>cssjs_web/popper.min.js"></script>
<script src="<?= base_url();?>cssjs_web/bootstrap.min.js"></script>
<script src="<?= base_url();?>cssjs_web/is.min.js"></script>
<script src=""></script>
<script src="<?= base_url();?>cssjs_web/theme.js"></script>

<script src="<?= base_url();?>dttable/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>dttable/dataTables.bootstrap5.min.js"></script>
<script>
	$(document).ready(function() {
		$('.dataTable').dataTable();
	})
  </script>
</body>
</html>
