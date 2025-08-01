<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Berjalan', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
$jk=array('L'=>'Laki-laki', 'P'=>'Perempuan');
$clbar=array('info', 'succsess', 'primary', 'warning', 'secondary', 'danger');
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
		<a class="nav-link" href="<?= base_url();?>admin/kejurnas_kaskeluar/<?= $DtKj['id_kj'];?>">Pengeluaran Kas</a>
	  </li> 
	  <li class="nav-item bg-light">
		<a class="nav-link active" aria-current="page" href=#">Peserta </a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?= base_url();?>admin/kejurnas_time/<?= $DtKj['id_kj'];?>">Time Line</a>
	  </li>
	 
	</ul>
	
	<p class="mt-4"><b>Data Peserta Pertandingan  Provinsi : <?= $NamaProv;?></b></p>
	<div class="row">
		<div class="col-sm-6">
			<form name="fprov" method="post" action="<?= base_url();?>admin/kejurnas_peserta/a/b/scr">
				<div class="input-group">
					<div class="input-group-text">Pilih Provinsi</div>
					<select name="idprov" class="form-control">
						<option value="0">Semua</option>
						<?php
						foreach($DtProv as $p)
						{
							echo '<option value="'.$p->id_prov.'"';
							if ($p->id_prov==$IdProv) { echo ' selected="selected"'; }						
							echo '>'.$p->provinsi.'</option>';
						}
						?>
					</select>
					<button type="submit" class="btn btn-info"><i class="mdi mdi-magnify"></i></button>
					<input type="hidden" name="idkj" value="<?= $DtKj['id_kj'];?>"/>
				</div>	
			</form>
		</div>
		<div class="col-sm-6">
			<p class="text-end">
				<?php
				if ($IdProv>0)
				{
					?>
				<a href="<?= base_url();?>admin/kejurnas_peserta_new/<?= $DtKj['id_kj'];?>/<?= $IdProv;?>"
					class="btn btn-primary"><i class="mdi mdi-plus"></i> Tambah Peserta</a>
					<?php
				}
				else
				{
					?>
					<span class="btn btn-danger">Pilih provinsi untuk tambah peserta !</span>	
					<?php
				}
				?>
				<a href="<?= base_url();?>admin/kejurnas_peserta/<?= $DtKj['id_kj'];?>/<?= $IdProv;?>/ctk" target="_blank"
					class="btn btn-info"><i class="mdi mdi-printer"></i> Cetak</a>	
			</p>
		</div>
	</div>
	
	
		
	<?php
	if ($JmlPst==0)
	{
		echo '<div class="alert alert-danger">Belum ada peserta pertandingan...</div>';
	}
	else	
	{
		?>
		<div class="accordion mt-4" id="accordionExample">
		<?php
		$gl='-'; $jmlgl=0; $jmlall=0; $n=1;
		$jmlby=0; $jmlbyall=0; $clnya=0;
	
		foreach ($DtPst as $k)
		{
			
			if ($gl!=$k->id_ktg_kj)
			{
				if ($gl!='-')
				{
					?>
					
					</tbody>
					<tfoot>
						<tr><th colspan="8" class="text-end">Jumlah</th>
							<th class="text-end"><?= number_format($jmlby,0,',','.');?></th>
						</tr>						
					</tfoot>
					</table>
					<p class="text-end text-info"><b>Jumlah Peserta : <?= number_format($jmlgl,0,',','.');?></b></p>
					</div></div>
					<?php
				}
				?>
				<h2 class="accordion-header" id="heading<?= $k->gelar;?>">
				  <button type="button" class="accordion-button collapsed  btn-<?= $cl[$clnya];?> m-1" data-bs-toggle="collapse" data-bs-target="#accordion<?= $k->id_ktg_kj;?>" aria-expanded="false" aria-controls="accordion<?= $k->id_ktg_kj;?>">
					<b><?= $k->kategori;?></b>
				  </button>
				</h2>

				<div id="accordion<?= $k->id_ktg_kj;?>" class="accordion-collapse collapse" data-bs-parent="#accordionExample" style="">
				  <div class="accordion-body">
				<table class="table dataTable">
				<thead><tr><th>NO</th><th>PROVINSI</th><th>PESERTA</th><th>NIK</th><th>TGL LAHIR</th><th class="text-end">UMUR</th>
					<th>JENIS KEL.</th><th>GELAR</th><th class="text-end">BIAYA REG.</th><th>AKSI</th>
					</tr></thead>
				<tbody>
				<?php
				$gl=$k->id_ktg_kj; $jmlgl=0; $n=1; $jmlby=0;
				$clnya++;
				if ($clnya>1) { $clnya=0; } 
			}
			?>
			<tr><td><?= $n;?></td>
				<td><?= $k->provinsi;?></td>
				<td><?= $k->nama_pst;?></td>
				<td><?= $k->nik;?></td>
				<td><?= $k->tgl_lahir;?></td>
				<td class="text-end"><?= $k->umur;?></td>
				<td><?= $jk[$k->jk_pst];?></td>
				<td><?= $k->gelar;?></td>
				<td class="text-end"><?= number_format($k->biaya_reg,0,',','.');?></td>
				<td nowrap><a href="<?= base_url();?>admin/kejurnas_peserta_edit/<?= $k->id_pst_kj;?>" class="btn btn-info btn-xs"
					title="Edit"><i class="mdi mdi-pencil"></i></a>
					<a href="#" class="btn btn-xs btn-danger" title="Hapus"
							onclick="return hapus('<?= $k->id_pst_kj;?>','<?= $k->nama_pst;?>');">
							<i class="mdi mdi-trash-can"></i></a>
				</td>	
			</tr>
			<?php
			$jmlgl++; $jmlall++; $n++; $jmlby+=$k->biaya_reg; $jmlbyall+=$k->biaya_reg;
			
		}
		?>
				</tbody>
				<tfoot>
					<tr><th colspan="8" class="text-end">Jumlah</th>
						<th class="text-end"><?= number_format($jmlby,0,',','.');?></th>
					</tr>						
				</tfoot>
			</table>
			<p class="text-end text-info">Jumlah Peserta <b>: <?= number_format($jmlgl,0,',','.');?></b></p>
			</div></div>
		</div>
		<div class="alert alert-info mt-3">
			<p><b>Jumlah Seluruh Peserta : <?= number_format($jmlall,0,',','.');?></b></p>
			<p><b>Jumlah Biaya Registrasi : <?= number_format($jmlbyall,0,',','.');?></b></p>
		</div>
		<script>
				function hapus(idnya, nama)
				{

					Swal.fire({
						title: 'Hapus Peserta ?',
						html: "Anda akan menghapus <b>" + nama + "</b> !",
						icon: 'question',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Ya',
						cancelButtonText: 'Tidak',    

					}).then((result) => {
						if (result.value) {            
						window.location.href = "<?= base_url();?>admin/kejurnas_peserta_del/" + idnya;           
						}
					})
				}
			</script>
	<?php		
	}		
	?>		
  </div>
</div>

<?php include ('adm_akhir.php'); ?>