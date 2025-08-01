<?php
$CI =& get_instance();
$CI->load->model('Mymodel');

$st=array('Belum Mulai', 'Berjalan', 'Selesai', 'Batal');
$cl=array('info', 'primary', 'success', 'danger');
include ('adm_awal_ctk.php'); ?>

<div class="container-fluid">
<h5 class="py-3 mb-4 text-center">DATA KEUANGAN EVENT </span> <?= strtoupper($DtEvent['nama_ev']);?></h5>
	
	<div class="row mb-5">
		<div class="col-sm-6">
			Pelaksanaan : <b><?= $CI->Mymodel->tgldmy($DtEvent['tgl_mulai_ev']);?></b> sampai 
				<b><?= $CI->Mymodel->tgldmy($DtEvent['tgl_selesai_ev']);?></b>
		</div>	
		<div class="col-sm-3 text-center">	
			Batas Pendaftaran :	<b><?= $CI->Mymodel->tgldmy($DtEvent['tgl_bts_daftar']);?></b>
		</div>	
		<div class="col-sm-3 text-end">		
			<b><?= $st[$DtEvent['status_ev']];?></b>
		</div>
	</div>
	<table class="table mb-4">
		<tr><th colspan="4">PENERIMAAN</th></tr>
		<tr><td>1.</td><td>Iuran Wajib</td><td class="text-end"><?= number_format($JmlIuranWjb,0,',','.');?></td><td></td></tr>
		<tr><td>2.</td><td>Registrasi</td><td class="text-end"><?= number_format($JmlIuranReg,0,',','.');?></td><td></td></tr>
		<tr><td>3.</td><td>Akomodasi</td><td class="text-end"><?= number_format($JmlAkomodasi,0,',','.');?></td><td></td></tr>
		<tr><td>4.</td><td>Penerimaan Lain</td><td class="text-end"><?= number_format($JmlPenLain,0,',','.');?></td><td></td></tr>
		<tr><td></td><th>JUMLAH PENERIMAAN</th><th></th><th class="text-end"><?= number_format($JmlPenerimaan,0,',','.');?></th></tr>
		<tr><th colspan="4">PENGELUARAN</th></tr>
		<tr><td>1.</td><td>Pengeluaran Kas</td><td></td><td class="text-end"><?= number_format($JmlKasKeluar,0,',','.');?></td></tr>
		<tr><td></td><th>SALDO KAS</th><th></th><th class="text-end"><?= number_format($SaldoKas,0,',','.');?></th></tr>
		
	</table>
</div>

<?php include ('adm_akhir_ctk.php'); ?>