<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Berjalan', 'Berjalan', 'Selesai', 'Gagal');
$cl=array('info', 'primary', 'success', 'danger');
include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Informasi Kejurnas <span class="text-info">Belum Berjalan</span></h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>adm/kejurnas" class="btn btn-danger" ><i class="mdi mdi-close"></i> Kembali</a>
    </p>
	<div class="row">
		<div class="col-sm-6">
			<h5>Kejurnas : <?= $DtKj['nama_kj'];?></h5>
			<p><a href="<?= base_url();?>img/poster/<?= $DtKj['id_kj'];?>.jpg" target="_blank"
				class="btn btn-success"><i class="mdi mdi-image"></i> Poster</a>
			   <a href="<?= base_url();?>pdf/kejurnas/<?= $DtKj['id_kj'];?>.pdf" target="_blank"
				class="btn btn-success"><i class="mdi mdi-file-pdf-box"></i> Proposal</a>		
			</p>
		</div>
		<div class="col-sm-6 text-end">
			<p>Tanggal Mulai : <b><?= $CI->Mymodel->tgldmy($DtKj['tgl_mulai']);?></b> sampai 
				<b><?= $CI->Mymodel->tgldmy($DtKj['tgl_selesai']);?></b></p>
			<p>Status : 
			<span class="badge bg-<?= $cl[$DtKj['status_kj']];?>"><?= $st[$DtKj['status_kj']];?></span></p>
			<p>Batas Pendaftaran : <b><?= $CI->Mymodel->tgldmy($DtKj['tgl_max_daftar']);?></b></p>
			
		</div>
	</div>
</div>
</div>  

<div class="card mb-5">   
  <div class="card-body">
	<ul class="nav nav-tabs tab-pills">
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/kejurnas_detail/<?= $DtKj['id_kj'];?>">Kategori</a>
	  </li>
	  
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/kejurnas_iuran/<?= $DtKj['id_kj'];?>">Penerimaan Iuran</a>
	  </li> 
	  <li class="nav-item">
		<a class="nav-link active" aria-current="page" >Pengeluaran Kas</a>
	  </li> 
	   <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/kejurnas_peserta/<?= $DtKj['id_kj'];?>">Peserta</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/kejurnas_time/<?= $DtKj['id_kj'];?>">Time Line</a>
	  </li>
	 
	</ul>
	
	<p class="mt-4"><b>Pengeluaran Kas Kejurnas</b></p>
	<p class="text-end"><a href="<?= base_url();?>admin/kejurnas_kaskeluar_new/<?= $DtKj['id_kj'];?>"
				class="btn btn-primary"><i class="mdi mdi-plus"></i> Tambah</a></p>
	<?php
	if ($JmlKas==0)
	{
		echo '<div class="alert alert-danger">Belum ada data pengeluaran kas...</div>';
	}
	else
	{
		?>
		<table class="table dataTable">
			<thead><tr><th>NO</th><th>TANGGAL</th><th>NO. BUKTI</th><th>KETERANGAN</th><th>ADMIN</th>
				<th class="text-end">JUMLAH</th><th>AKSI</th></tr></thead>
			<tbody>
		<?php		
		$total=0; $n=1;
		foreach ($DtKas as $k)
		{
			?>
			<tr><td><?= $n;?></td>
				<td><?= $CI->Mymodel->tgldmy($k->tgl_keluar);?></td>
				<td><?= $k->no_bukti;?></td>
				<td><?= $k->keterangan;?></td>
				<td><?= $k->nama_admin;?></td>
				<td class="text-end"><?= number_format($k->jumlah,0,',','.');?></td>
				<td>
						<?php
						if ($_SESSION['ID_ADMIN']!=2)
						{
							?>
						<a href="<?= base_url();?>admin/kejurnas_kaskeluar_edit/<?= $k->id_kaskeluar;?>"
								class="btn btn-xs btn-info"><i class="mdi mdi-pencil"></i></a>
						<a href="#" class="btn btn-xs btn-danger" title="Hapus"
								onclick="return hapus('<?= $k->id_kaskeluar;?>','<?= $k->no_bukti;?>');">
								<i class="mdi mdi-trash-can"></i></a>
						<?php
						}
						?>	
													
				</td>
			</tr>	
			<?php
			$n++; $total+=$k->jumlah;
		}
		?>
			</tbody>
			<tfoot>
			<tr><th class="text-end" colspan="5">JUMLAH</th>
				<th class="text-end"><?= number_format($total,0,',','.');?></th>
				<th></th>
			</tr>
			</tfoot>			
		</table>
		<?php
	}
	?>
  </div>
</div>
<script>
	function hapus(idnya, nama)
	{

		Swal.fire({
			title: 'Hapus Pengeluaran Kas ?',
			html: "Anda akan menghapus pengeluaran no bukti <b>" + nama + "</b> !",
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak',    

		}).then((result) => {
			if (result.value) {            
			window.location.href = "<?= base_url();?>admin/kejurnas_kaskeluar_del/" + idnya;           
			}
		})
	}
</script>
<?php include ('adm_akhir.php'); ?>