<!DOCTYPE html>
<html lang="en" class="light-style layout-wide  customizer-hide" dir="ltr" data-theme="theme-default" 
data-assets-path="img/" data-template="vertical-menu-template">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login Administrator</title>

    
    <meta name="description" content="Login admin <?= $INSTANSI['nama_instansi'];?>" />
    <meta name="keywords" content="dashboard, material, material design, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url();?>img/favicon-16x16.png" />

    
    <!-- Icons -->
    <link rel="stylesheet" href="<?= base_url();?>fonts_mdi/materialdesignicons.css" />
    
    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="<?= base_url();?>cssjs_materio/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url();?>cssjs_materio/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url();?>cssjs_materio/theme-default.css" class="template-customizer-theme-css" />
    <!-- <link rel="stylesheet" href="../../assets/css/demo.css" /> -->
    
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= base_url();?>cssjs_materio/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?= base_url();?>cssjs_materio/typeahead.css" /> 
    
    <!-- Page -->
    <link rel="stylesheet" href="<?= base_url();?>cssjs_materio/pages/page-auth.css">

    <!-- Helpers -->
    <script src="<?= base_url();?>cssjs_materio/helpers.js"></script>
    <script src="<?= base_url();?>cssjs_materio/config.js"></script>
    
</head>

<body>
<div class="position-relative">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">

      <!-- Login -->
      <div class="card p-2">
        <!-- Logo -->
        <div class="app-brand justify-content-center mt-5">
          <a href="index.html" class="app-brand-link gap-2">
            <span class="app-brand-logo demo"><img src="<?= base_url();?>img/percasi.png" height="40" style="border-radius: 100%;"/></span>
            <span class="app-brand-text demo text-heading fw-semibold"><?= $INSTANSI['nama_instansi'];?></span>
          </a>
        </div>
        <!-- /Logo -->

        <div class="card-body mt-2">
          <h4 class="mb-2">Welcome Administrator</h4>
          <?php
          if ($Gagal==0)
          {
            echo '<p class="mb-4">silahkan login ....</p>';
          }
          else
          {
            echo '<div class="alert alert-danger mb-3">Gagal login, silahkan ulangi...</div>';
          }  
          ?>
          <form  class="mb-3" action="<?= base_url();?>adminlogin" method="post">
            <div class="form-floating form-floating-outline mb-3">
              <input type="text" class="form-control" id="username" name="username" placeholder="Masukan username" autofocus>
              <label for="username">Username</label>
            </div>
            <div class="mb-3">
              <div class="form-password-toggle">
                <div class="input-group input-group-merge">
                  <div class="form-floating form-floating-outline">
                    <input type="password" id="passwd" class="form-control" name="passwd" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                    <label for="passwd">Password</label>
                  </div>
                  <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<!-- / Content -->
  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <script src="<?= base_url();?>cssjs_materio/jquery.js"></script>
  <script src="<?= base_url();?>cssjs_materio/popper/popper.js"></script>
  <script src="<?= base_url();?>cssjs_materio/js/bootstrap.js"></script>
  <script src="<?= base_url();?>cssjs_materio/node-waves.js"></script>
  <script src="<?= base_url();?>cssjs_materio/perfect-scrollbar.js"></script>
  <script src="<?= base_url();?>cssjs_materio/hammer.js"></script>
  <script src="<?= base_url();?>cssjs_materio/i18n/i18n.js"></script>
  <script src="<?= base_url();?>cssjs_materio/typeahead.js"></script>
  <script src="<?= base_url();?>cssjs_materio/menu.js"></script>
  <script src="<?= base_url();?>cssjs_materio/main.js"></script>
  <!-- Page JS -->
  <script src="<?= base_url();?>cssjs_materio/pages/pages-auth.js"></script>
  <script src="<?= base_url();?>cssjs_all/id.verify.notify.js"></script>
</body>

</html>