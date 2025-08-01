<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mymodel extends CI_Model {
    public function tgltext($tgl=false)
    {
		if (($tgl=='') || ($tgl===false))
		{
			return '';
		}
		else
		{
			$bln=array(
				'01'=>'Januari',
				'02'=>'Februari',
				'03'=>'Maret',
				'04'=>'April',
				'05'=>'Mei',
				'06'=>'Juni',
				'07'=>'Juli',
				'08'=>'Agustus',
				'09'=>'September',
				'10'=>'Oktober',
				'11'=>'November',
				'12'=>'Desember'
			);
			$t=explode('-',$tgl);
			if ($t[2]=='00')
			{
				$h=$bln[$t[1]].' '.$t[0];
			}
			else
			{
				$h=$t[2].' '.$bln[$t[1]].' '.$t[0];
			}
			return $h;
		}
    }
    
    public function tgldmy($tgl=false)
    {
        $t=explode('-',$tgl);
        $h=$t[2].'-'.$t[1].'-'.$t[0];
        return $h;
    }
    public function dttime_dmy($tgl=false)
    {
        $t=explode(' ',$tgl);
        $tg=$this->tgldmy($t[0]);
        $h=$tg.' '.$t[1];
        return $h;
    }

	public function urut($key, $max)
	{
		$tgl=date('Ym');
		$h=$this->db->query("SELECT * FROM urut WHERE idurut=?", $key);
		if ($h->num_rows()==0)
		{
			$p=array($key, $tgl);
			$this->db->query("INSERT INTO urut (idurut, nomor, tanggal) VALUES (?, 1, ?)", $p);
			$i=1;
		}
		else
		{
			$dth=$h->row_array();
			if ($dth['tanggal']!=$tgl)
			{
				$i=1;
				$p=array($tgl, $key);
				$this->db->query("UPDATE urut SET nomor=1, tanggal=? WHERE idurut=?", $p);
			}
			else
			{
				$i=$dth['nomor']+1;
				if ($i>$max) { $i=1;}
				$p=array($i, $key);
				$this->db->query("UPDATE urut SET nomor=? WHERE idurut=?", $p);
			}
		}
		$l=strlen($max);
		$id=$tgl.sprintf('%0'.$l.'d',$i);
		return $id;
	}
    public function urut_saja($key, $max)
	{
		$tgl=date('Ym');
		$h=$this->db->query("SELECT * FROM urut WHERE idurut=?", $key);
		if ($h->num_rows()==0)
		{
			$p=array($key, $tgl);
			$this->db->query("INSERT INTO urut (idurut, nomor, tanggal) VALUES (?, 1, ?)", $p);
			$i=1;
		}
		else
		{
			$dth=$h->row_array();
			if ($dth['tanggal']!=$tgl)
			{
				$i=1;
				$p=array($tgl, $key);
				$this->db->query("UPDATE urut SET nomor=1, tanggal=? WHERE idurut=?", $p);
			}
			else
			{
				$i=$dth['nomor']+1;
				if ($i>$max) { $i=1;}
				$p=array($i, $key);
				$this->db->query("UPDATE urut SET nomor=? WHERE idurut=?", $p);
			}
		}
		$l=strlen($max);
		$id=sprintf('%0'.$l.'d',$i);
		return $id;
	}

	public function paging($link, $currpage, $maxpage, $totalpage)
	{
		$start=((($currpage%$maxpage==0) ? ($currpage/$maxpage) : intval($currpage/$maxpage)+1)-1)*$maxpage+1;
		$end=((($start+$maxpage-1)<=$totalpage) ? ($start+$maxpage-1) : $totalpage);
		
		$paging='<nav aria-label="pagination example"><ul class="pagination justify-content-center my-5">';
		if($currpage>1){
			$paging.='<li class="page-item"><a class="page-link" href="'.$link.'1"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i></a></li>';
			$paging.='<li class="page-item"><a class="page-link" href="'.$link.($currpage-1).'"><i class="fas fa-chevron-left"></i></a></li>';
		}
		
		if($start>$maxpage){
			$paging.='<li class="page-item"><a class="page-link" href="'.$link.($start-1).'">...</a></li>';
		}
		
		for($i=$start;$i<=$end;$i++){
			if($currpage==$i){
				$paging.='<li class="page-item active"><a class="page-link" href="#">'.$i.'</a></li>';
			}
			else{
				$paging.='<li class="page-item"><a class="page-link" href="'.$link.$i.'">'.$i.'</a></li>';
			}
		}
		
		if($end<$totalpage){
			$paging.='<li class="page-item"><a class="page-link" href="'.$link.($end+1).'">...</a></li>';
		}
		
		if($currpage<$totalpage){
			$paging.='<li class="page-item"><a class="page-link" href="'.$link.($currpage+1).'"><i class="fas fa-chevron-right"></i></a></li>';
			$paging.='<li class="page-item"><a class="page-link" href="'.$link.$totalpage.'"><i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i></a></li>';
		}
		$paging.='</ul></nav>';
		return $paging;
	}
}
?>