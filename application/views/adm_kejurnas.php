<?php 
$CI =& get_instance();
$CI->load->model('Mymodel');
include ('adm_awal.php'); ?>

<h5 class="py-3 mb-4">Data Admin</h5>

<div class="card mb-5">   
  <div class="card-body">
    <p class="text-end">
        <a href="<?= base_url();?>admin/kejurnas_new/" class="btn btn-primary" > <i class="mdi mdi-account-plus"></i> Tambah</a>
    </p>
    <?php
        if($JmlKj==0)
        { echo '<div class="alert alert-danger">Belum ada data....</div>';} else
        {
            ?>
            <table class="table table-hover">
            <thead>
                <tr>
                <th>NO</th>
                <th>KEJURNAS</th>
                <th>TANGGAL</th>
                <th>STATUS</th>
                <th>INPUT BY</th>
                <th>AKSI</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php
				$st=array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
				$cl=array('secondary', 'info',  'success', 'danger');
				$n=1;
                foreach($DtKj as $k)
                {
                    ?>
                    <tr><td><?= $n;?></td>
						<td><?= $k->nama_kj;?></td>
						<td><?= $CI->Mymodel->tgldmy($k->tgl_mulai);?> sd <?= $CI->Mymodel->tgldmy($k->tgl_selesai);?></td>
						<td><span class="badge bg-<?= $cl[$k->status_kj];?>"><?= $st[$k->status_kj];?></span></td>
                        <td><?= $k->nama_admin;?></td>
                        <td>
							<div class="btn-group">
							  <button class="btn btn-primary btn-xs" type="button">
								Aksi
							  </button>
							  <button type="button" class="btn btn-xs btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
								<span class="visually-hidden">Toggle Dropdown</span>
							  </button>
							  <ul class="dropdown-menu">
								<li>
									<a href="<?= base_url();?>admin/kejurnas_edit/<?= $k->id_kj;?>" 
										class="dropdown-item"><i class="mdi mdi-pencil"></i> Edit</a>
									<a href="<?= base_url();?>admin/kejurnas_detail/<?= $k->id_kj;?>" 
										class="dropdown-item"><i class="mdi mdi-magnify"></i> Detail</a>
									<a href="<?= base_url();?>admin/kejurnas_peserta/<?= $k->id_kj;?>" 
										class="dropdown-item"><i class="mdi mdi-account-search-outline"></i> Peserta</a>									
									<a href="<?= base_url();?>admin/kejurnas_iuran/<?= $k->id_kj;?>" 
										class="dropdown-item"><i class="mdi mdi-credit-card-marker-outline"></i> Iuran</a>
									
								</li>
								</li>
									<?php
									if ($_SESSION['TP_ADMIN']==3)
									{
										?>	
											<a href="#" class="dropdown-item" 
															onclick="return hapus('<?= $k->id_kj;?>','<?= $k->nama_kj;?>');">
															<i class="mdi mdi-trash-can"></i> Hapus belum</a>
										<?php
									}   
									?> 
								</li>
							  </ul>
							</div>

                            
                        </td>
                    </tr>
                    <?php
					$n++;
                }
                ?>
            </tbody>
            </table>
			<script>
				function hapus(idnya, nama)
				{

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
						window.location.href = "<?= base_url();?>admin/kejurnas_del/" + idnya;           
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