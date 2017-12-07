<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <!-- Bootstrap -->
    <link href="<?php echo e(asset('templates/gentelella')); ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo e(asset('templates/gentelella')); ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo e(asset('templates/gentelella')); ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo e(asset('templates/gentelella')); ?>/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="<?php echo e(asset('templates/gentelella')); ?>/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo e(asset('templates/gentelella')); ?>/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo e(asset('templates/gentelella')); ?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo e(asset('templates/gentelella')); ?>/build/css/custom.min.css" rel="stylesheet">
    <?php echo $__env->yieldContent('css'); ?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col ">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><i class="fa fa-briefcase"></i> <span>Administrador</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo e(url('adminuser/img-perfil/'.Auth::user()->id)); ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Bienvenido:</span>
                <h2><?php echo e(Auth::user()->name); ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu ">
              <div class="menu_section menu_fixed">
                <h3>Area Administracion</h3>
                <ul class="nav side-menu">
                  <li><a href="<?php echo e(url('/adminuser/home')); ?>"><i class="fa fa-home"></i> Inicio </a></li>
                  <li><a><i class="fa fa-users"></i> Administrar Usuarios <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php if(Auth::user()->tipo == 'all'): ?>
                      <li><a href="<?php echo e(url('adminuser/users/admin')); ?>">Administradores</a></li>
                      <?php endif; ?>
                      <?php if(Auth::user()->tipo == 'all' || Auth::user()->tipo == 'ventas'): ?>
                      <li><a href="<?php echo e(url('adminuser/users/ventas')); ?>">Ventas</a></li>
                      <?php endif; ?>
                      <?php if(Auth::user()->tipo == 'all' || Auth::user()->tipo == 'produccion'): ?>
                      <li><a href="<?php echo e(url('adminuser/users/produccion')); ?>">Produccion</a></li>
                      <?php endif; ?>
                      <?php if(Auth::user()->tipo == 'all' || Auth::user()->tipo == 'facturacion'): ?>
                      <li><a href="<?php echo e(url('adminuser/users/facturacion')); ?>">Facturacion</a></li>
                      <?php endif; ?>
                    </ul>
                  </li>
                  <li><a href="<?php echo e(url('adminuser/ots')); ?>"><i class="fa fa-inbox"></i> Ordenes de Trabajo </a></li>
                  <li><a href="<?php echo e(url('adminuser/clientes')); ?>"><i class="fa fa-users"></i> Clientes </a></li>
                  <li><a href="<?php echo e(url('adminuser/reportes')); ?>"><i class="fa fa-file-pdf-o"></i> Reportes </a></li>
                </ul>
              </div>
              <div class="menu_section menu_fixed">
                <h3>Area Produccion</h3>
                <ul class="nav side-menu">
                  <li><a href="<?php echo e(url('/adminuser/productos')); ?>"><i class="fa fa-cubes"></i> Productos </a></li>
                  <li><a href="<?php echo e(url('/adminuser/categorias')); ?>"><i class="fa fa-sort-alpha-desc"></i>Categorias</a></li>
                  <li><a href="<?php echo e(url('/adminuser/marcas')); ?>"><i class="fa fa-flag-o"></i>Marcas</a></li>
                  <li><a href="<?php echo e(url('/adminuser/inventarios')); ?>"><i class="fa fa-reorder"></i>Inventarios</a></li>
                    
                  
                </ul>
              </div>
              <div class="menu_section menu_fixed">
                <h3>Estadisticas</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-bar-chart"></i> Ventas <span class="fa fa-chevron-down"></span></a>
                    
                      <ul class="nav child_menu">
                        <li><a href="<?php echo e(url('/adminuser/estadisticas/ventas_por_vendedor')); ?>"></i> Ventas por Vendedor </a></li>
                      
                      </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo e(url('adminuser/img-perfil/'.Auth::user()->id)); ?>" alt="">
                    <?php echo e(Auth::user()->name); ?>

                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo e(url('adminuser/perfil')); ?>"><i class="fa fa-user pull-right"></i> Perfil</a></li>
                    
                    <li><a href="<?php echo e(url('/adminuser/logout')); ?>"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a>
                                        <form id="logout-form" action="<?php echo e(url('/adminuser/logout')); ?>" method="POST" style="display: none;">
                                        <?php echo e(csrf_field()); ?>

                                    </form></li>
                  </ul>
                </li>

                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <?php if(session('mensaje')): ?>
          <div class="x_content bs-example-popovers">
            <div class="alert alert-success alert-dismissible fade in" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
              </button>
              <?php echo e(session('mensaje')); ?>

            </div>
          </div>
          <?php endif; ?>
          <?php echo $__env->yieldContent('contenido'); ?>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            ImagenGroup
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    
    <!-- jQuery -->
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo e(asset('templates/gentelella')); ?>/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo e(asset('templates/gentelella')); ?>/build/js/custom.js"></script>
	  <?php echo $__env->yieldContent('js'); ?>
  </body>
</html>
