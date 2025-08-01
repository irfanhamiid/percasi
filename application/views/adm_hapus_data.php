<?php include('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Hapus Semua Data</h5>

<div class="card mb-5">
	<div class="card-body">
		<div class="alert alert-danger text-center">
			Proses ini akan mengosongkan semua data events, data master tidak dihapus...
		</div>

		<p class="text-center mt-4">
			<a href="<?= base_url(); ?>admin/hapusdata/y" class="btn btn-danger"><i class="mdi mdi-trash-can"></i>
				Hapus Sekarang !</a>
		</p>
	</div>
</div>


<?php include('adm_akhir.php'); ?>