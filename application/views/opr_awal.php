<!DOCTYPE html>
<html lang="id" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact customizer-hide" 
dir="ltr" 
data-theme="theme-default" 
data-assets-path="./img/" data-template="vertical-menu-template">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title><?= $INSTANSI['nama_instansi'];?> | Operator</title>

    
    <meta name="description" content="Aplikasi admin <?= $INSTANSI['nama_instansi'];?>" />
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url();?>img/favicon-16x16.png" />

    
    <!-- Icons -->
    <link rel="stylesheet" href="<?= base_url();?>fonts_mdi/materialdesignicons.css" />
    
    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="<?= base_url();?>cssjs_materio/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url();?>cssjs_materio/core_ext.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url();?>cssjs_materio/theme-default.css" class="template-customizer-theme-css" />
    <!-- <link rel="stylesheet" href="../../assets/css/demo.css" /> -->
    
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= base_url();?>cssjs_materio/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?= base_url();?>cssjs_materio/typeahead.css" /> 
    <link rel="stylesheet" href="<?= base_url();?>dttable_new/dataTables.dataTables.css" /> 
	<link rel="stylesheet" href="<?= base_url();?>dttable_new/buttons.dataTables.css" />     
    <link rel="stylesheet" href="<?= base_url();?>cssjs_all/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Helpers -->
    <script src="<?= base_url();?>cssjs_materio/helpers.js"></script>
    <script src="<?= base_url();?>cssjs_materio/config.js"></script>
    <style>
		h1, h2, h3, h4, h5, h6 { font-weight: bold; }
		hr, .card hr {
			  color: rgb(77, 68, 89);
			}
		.myinput-required {
			border-color:red;
		}
		fieldset { margin-bottom: 15px; }
		.table { border-color: #d8d8d8; }
	</style>	
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar  ">
    <div class="layout-container">
        <!-- Menu -->
        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo ">
                <a href="<?= base_url();?>opr" class="app-brand-link">
                    <span class="app-brand-logo demo me-1">
                        <img src="<?= base_url();?>img/percasi.png" height="32" style="border-radius: 100%;" alt="Logo"/></span>
                    <span class="app-brand-text demo menu-text fw-semibold ms-2">PERCASI</span>
                </a>
                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                    <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                <!-- Dashboards -->
                <li class="menu-item <?php if($MnuAktif=='Beranda') { echo 'active';} ?>">
                    <a href="<?= base_url();?>opr" class="menu-link"><i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                    <div data-i18n="Beranda">Beranda</div>
                    </a>
                </li>
				
				
				<li class="menu-item <?php if($MnuAktif=='Event') { echo 'open';} ?>">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons mdi mdi-flag-outline"></i>
                    <div data-i18n="Event">Events</div>
                    </a>
                    <ul class="menu-sub">
                        
                        <li class="menu-item <?php if($SubMnuAktif=='Event0') { echo 'active';} ?>">
                            <a href="<?= base_url();?>opr/event/0" class="menu-link">
                            <div data-i18n="Event0">Belum Mulai</div>
                            </a>
                        </li>
						<li class="menu-item <?php if($SubMnuAktif=='Event1') { echo 'active';} ?>">
                            <a href="<?= base_url();?>opr/event/1" class="menu-link">
                            <div data-i18n="Event1">Berjalan</div>
                            </a>
                        </li>
						<li class="menu-item <?php if($SubMnuAktif=='Event2') { echo 'active';} ?>">
                            <a href="<?= base_url();?>opr/event/2" class="menu-link">
                            <div data-i18n="Event2">Selesai</div>
                            </a>
                        </li>
                    </ul>
                </li>
				
                
  
                
				
                <li class="menu-item">
                    <a href="<?= base_url();?>opr/logout" class="menu-link">
                    <i class="menu-icon tf-icons mdi mdi-logout"></i>
                    <div data-i18n="Logout">Logout</div>
                    </a>
                </li>
            </ul>
        </aside>
        <!-- / Menu --> 

        <!-- Layout container -->
        <div class="layout-page">
            <!-- TOP Navbar -->
            <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" 
                id="layout-navbar">
                <!-- TOOGEL -->
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
                    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="mdi mdi-menu mdi-24px"></i>
                    </a>
                </div>
    
                <!-- TOP RIGHT NAV -->
                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                    <ul class="navbar-nav flex-row align-items-center me-auto">
                        <li class="me-1 me-xl-0">
                           <b><?= $INSTANSI['nama_instansi'];?></b> | Operator : <b><?= $_SESSION['NMPROV_OPR'];?></b>
                        </li>    
                    </ul>
                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <!-- User -->
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                        <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <div class="avatar avatar-online">
                            <img src="<?= base_url();?>img/opr/<?= $_SESSION['FOTO'];?>" alt class="w-px-40 h-auto rounded-circle">
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
                            <li>
                            <a class="dropdown-item pb-2 mb-1" href="pages-account-settings-account.html">
                                <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-2 pe-1">
                                    <div class="avatar avatar-online">
                                    <img src="<?= base_url();?>img/opr/<?= $_SESSION['FOTO'];?>" alt class="w-px-40 h-auto rounded-circle">
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0"><?= $_SESSION['NM_OPR'];?></h6>
                                    <small class="text-muted"><?= $_SESSION['NMPROV_OPR'];?></small>
                                </div>
                                </div>
                            </a>
                            </li>
                            <li>
                            <div class="dropdown-divider my-0"></div>
                            </li>
                            <li>
                            <a class="dropdown-item" href="<?= base_url('opr/profil') ?>">
                                <i class="mdi mdi-account-outline me-1 mdi-20px"></i>
                                <span class="align-middle">My Profile</span>
                            </a>
                            </li>
                            <!-- <li>
                            <a class="dropdown-item" href="pages-account-settings-account.html">
                                <i class="mdi mdi-cog-outline me-1 mdi-20px"></i>
                                <span class="align-middle">Settings</span>
                            </a>
                            </li> -->
                            <li>
                            <div class="dropdown-divider"></div>
                            </li>
                            <li>
                            <div class="dropdown-divider my-1"></div>
                            </li>
                            <li>
                            <a class="dropdown-item" href="<?= base_url();?>opr/logout">
                                <i class="mdi mdi-logout me-1 mdi-20px"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                            </li>
                        </ul>
                        </li>
                        <!--/ User -->
                    </ul>
                </div>
            </nav>
            <!-- / TOP Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
            <!-- Content -->            
                <div class="container-xxl flex-grow-1 container-p-y">