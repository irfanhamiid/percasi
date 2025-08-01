<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $INSTANSI['nama_instansi'];?></title>

    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url();?>img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url();?>img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url();?>img/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url();?>img/favicon-16x16.png">
    
    <link href="<?= base_url();?>fontawesome/css/all.min.css" rel="stylesheet" />
    <link href="<?= base_url();?>cssjs_web/theme.css" rel="stylesheet" />
	
    <link rel="stylesheet" href="<?= base_url();?>dttable/dataTables.bootstrap5.css" /> 
    <style>
      .navbar-light .navbar-nav .nav-link {
        color: #fff !important;
      }
      .btn-xs {
        padding: 3px 5px;
        font-size: 0.8rem;
      }
    </style>  
  </head>
  <body>
  <main class="main" id="top">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-4 d-block" data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container"><a class="navbar-brand text-white" href="<? base_url();?>">
          <img src="<?= base_url();?>img/percasi.png" height="32" alt="percasi" style="border-radius: 100%;"/> <?= $INSTANSI['nama_instansi'];?></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
          <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base">
              <li class="nav-item px-2"><a class="nav-link" href="<?= base_url();?>"><i class="fas fa-home"></i> Beranda</a></li>
              <li class="nav-item px-2"><a class="nav-link" href="<?= base_url();?>web/berita"><i class="fas fa-newspaper"></i> Berita</a></li>
              <li class="nav-item px-2"><a class="nav-link" href="<?= base_url();?>web/event"><i class="fas fa-calendar"></i> Events</a></li>
              <li class="nav-item px-2"><a class="nav-link" href="<?= base_url();?>web/tentang">
                  <img src="<?= base_url();?>img/kuda_putih.png" height="16"/> Tentang Kami</a></li>
			  <li class="nav-item px-2"><a class="nav-link" href="<?= base_url();?>opr" target="_blank"><i class="fas fa-user"></i> Pengda</a></li>
            </ul>
        </div>
      </nav>