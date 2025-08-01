 <?php include ('adm_awal.php'); ?>
        
        <h5 class="py-3 mb-4">Bayar Iuran Tahunan <?= $DtProv->provinsi ?> <?= date('Y') ?></h5>
        
        <div class="card mb-5">   
          <div class="card-body">
            <form action="<?= base_url('admin/iuran_tahunan_byr') ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-4">
                        <fieldset><label>Jumlah Pembayaran</label>
    					<input type="text" name="jumlah" class="form-control" data-validate="required,number"
    						maxlength="10"/>
                        <input type="hidden" name="tahun" value="<?= date('Y') ?>" id="">
                        <input type="hidden" name="id_prov" value="<?= $id ?>" id="">
    				</fieldset>
                    <fieldset><label>Tanggal Bayar</label>
    					<input type="date" name="tanggal_bayar" class="form-control" data-validate="required"/>
    				</fieldset>
                    </div>
                    <div class="col-4">
                        <fieldset>
                            <label for="">Nama Pembayar</label>
                            <input type="text" class="form-control" name="nama_pembayar" required id="">
                        </fieldset>
                        <fieldset>
                            <label for="">Nama Penerima</label>
                            <input type="text" class="form-control" name="nama_penerima" required id="">
                        </fieldset>
                    </div>
                    <div class="col-4">
                        <fieldset>
                            <label for="">Catatan jika diperlukan</label>
                            <textarea name="catatan" class="form-control" id=""></textarea>
                        </fieldset>
                        <fieldset class="mb-3"><label>Bukti Pembayaran</label>
    					<input type="file" name="bukti" accept=".jpg,.png,.jpeg" data-validate="required"
    						id="filegambar"  class="form-control" 
    						onchange="return bacafile('imagesample',this.files[0],'filegambar','fileerror',2000000,'<?= base_url();?>img/noimage.jpg');"/>
    					<p id="fileerror" class="text-danger"></p>	
    					<p class="mt-3"><img id="imagesample" height="100" src="<?= base_url();?>img/noimage.jpg"/></p>
                    </fieldset>
                    </div>
                </div>
                <p class="text-center mt-4">
    			<button type="submit" class="btn btn-primary"><i class="mdi mdi-check"></i> Simpan</button>
    		</p>
            </form>
            <script>
    		function bacafile(idimage, objekfile, idinput, iderrmsg, maxukuran, gbori)
    		{
    			var allowedFiles = [".jpg",".jpeg",".png"];
    			var fileUpload = document.getElementById(idinput);
    			var lblError = document.getElementById(iderrmsg);
    			var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
    			if (!regex.test(fileUpload.value.toLowerCase())) 
    			{
    				lblError.innerHTML = "Mohon hanya upload tipe file : <b>" + allowedFiles.join(', ') + "</b>.";
    				fileUpload.value="";
    				document.getElementById(idimage).src=gbori;
    
    
    				return false;
    			}
    			else
    			{
    				if (objekfile.size>maxukuran)
    				{
    					var l=maxukuran.toString();
    					var p=l.length-3;
    					var s=l.substring(0,p);
    					lblError.innerHTML = "Ukuran file terlalu besar, maksimal "+s+"KB.";
    					fileUpload.value="";
    					document.getElementById(idimage).src=gbori;
    					return false;
    				}
    				else
    				{
    					lblError.innerHTML = "";
    					document.getElementById(idimage).src = window.URL.createObjectURL(objekfile)
    					return true;
    				}
    			}                                
    		}    
    		</script>  
          </div>
        </div>
        
        <?php include ('adm_akhir.php'); ?>