
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?= $title ?></title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= base_url()?>/node_modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="<?= base_url()?>/node_modules/weathericons/css/weather-icons.min.css">
  <link rel="stylesheet" href="<?= base_url()?>/node_modules/weathericons/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="<?= base_url()?>/node_modules/summernote/dist/summernote-bs4.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url()?>/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url()?>/assets/css/components.css">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?= base_url()?>/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?= session('nama')?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="<?=base_url(
                'logout/supplier'
              )?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
<!-- Main Sidebar -->
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="">Cisnu Petshop Supplier</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="">St</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Dashboard</li>
              <li class="nav-item active">
                <a href="<?= base_url('supplier/dashboard')?>" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              </li>
              <li class="menu-header">Data Pesanan</li>
              <li class="nav-item">
                <a href="<?=base_url('supplier/pesanan')?>" class="nav-link"><i class="fas fa-box"></i> <span>Pesanan</span></a>
                
              </li>
        </aside>
      </div>
<!-- End Sidebar -->
      <!-- Main Content -->

      <?= $this->renderSection('content')?>
      
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; <?date('Y')?> Cisnu Petshop & Aquarium
        </div>
        
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="../assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="<?=base_url()?>/node_modules/simpleweather/jquery.simpleWeather.min.js"></script>
  <script src="<?=base_url()?>/node_modules/chart.js/dist/Chart.min.js"></script>
  <script src="<?=base_url()?>/node_modules/jqvmap/dist/jquery.vmap.min.js"></script>
  <script src="<?=base_url()?>/node_modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="<?=base_url()?>/node_modules/summernote/dist/summernote-bs4.js"></script>
  <script src="<?=base_url()?>/node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

  <!-- Template JS File -->
  <script src="<?=base_url()?>/assets/js/scripts.js"></script>
  <script src="<?=base_url()?>/assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <script src="<?=base_url()?>/assets/js/page/index-0.js"></script>
</body>
</html>
