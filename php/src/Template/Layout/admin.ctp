<?php
  if ($user['photo']) {
    $avatar = "../uploads/".$user['photo'];
  } else {
    $avatar = '../dist/img/avatar'.($user['gender'] === 'Male' ? '5' : '2').'.png"';
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>TIMECrisis | Admin Panel </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <?= $this->Html->meta('icon', 'dist/img/favicon.ico'); ?>
    <meta name="theme-color" content="#dd4b39">
    <!-- Bootstrap 3.3.2 -->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="../plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="../plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap-datetimepicker -->
    <link href="../plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="../dist/css/skins/_all-skins.css" rel="stylesheet" type="text/css" />
    <link href="../dist/css/formStyle.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/formvalidation/formValidation.min.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/bootstrap-notify/animate.css" rel="stylesheet" type="text/css" />
    <link href="../dist/css/maps.css" rel="stylesheet" type="text/css" />
    <!-- datatables -->
    <link href="../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Ladda -->
    <link rel="stylesheet" href="/plugins/ladda/ladda-themeless.min.css" type="text/css" />
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    
    <!-- START OF GOOGLE MAPS API -->
    <?php if ($page == "dashboard"){ ?>
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=visualization,weather&amp;signed_in=false"></script>
      <script src="../script/maps.js"></script>
    <?php }?>
  </head>
  <body class="skin-red">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="dashboard" class="logo">
            <img src="../dist/img/logo.png" width="40px" height="40px" style="margin-bottom:5px; margin-right:5px;" /><b>TIME</b>Crisis
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
             
               <!-- VISIT SITE LINK-->
              <li class="#">
                <a href="../" target="_blank">
                  <span class="hidden-xs">Visit Site</span>
                </a>
              </li>
              
              <!-- User Account: style can be found in dropdown.less -->
              <!-- USER ACCOUNT : EDIT PROFILE & LOG OUT -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?= $avatar ?>" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?= $user['name'] ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?= $avatar ?>" class="img-circle" alt="User Image" />
                    <p>
                      <?= $user['name'] ?>
                      <small><?= $user['role'] ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="editProfile" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </div>
        </nav>
      </header>

      <!-- ..............................................................NAVIGATION................................................... -->
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?= $avatar ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?= $user['name'] ?></p>
              <small><?= $user['role'] ?></small>
            </div>
          </div>
          
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <?php if ($page == "dashboard"){ ?>  <li class= "active treeview"> <?php }else{ ?> <li class= "treeview"> <?php }?>
              <a href="dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> </i>
              </a>
            </li>

            <!-- MANAGE INCIDENTS-->
            <?php if ($page == "incidents" || $page == "incident_category"){ ?>  <li class= "active"> <?php }else{ ?> <li> <?php }?>
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Incidents</span>
              </a>
              <ul class="treeview-menu">
                <?php if ($page == "incidents"){ ?>  <li class= "active"> <?php }else{ ?> <li> <?php }?>
                    <a href="incident"><i class="fa fa-circle-o"></i>Incidents</a>
                </li>
                <?php if ($user['role'] === 'Administrator') {
                  if ($page == "incident_category"){ ?>  
                  <li class= "active"> <?php }else{ ?> <li> <?php }?>
                  <a href="incidentCategory"><i class="fa fa-circle-o"></i>Incident Category</a>
                </li>
                <?php }?>
              </ul>
            </li>
            
            <!-- MANAGE EVENTS-->
            <?php if ($page == "haze" || $page == "dengue"){ ?>  <li class= "active"> <?php }else{ ?> <li> <?php }?>
              <a href="#">
                <i class="fa fa-share"></i>
                <span>Events</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php if ($page == "dengue"){ ?>  <li class= "active"> <?php }else{ ?> <li> <?php }?>
                  <a href="dengue"><i class="fa fa-circle-o"></i>Dengue</a>
                </li>
                <?php if ($page == "haze"){ ?>  <li class= "active"> <?php }else{ ?> <li> <?php }?>
                  <a href="haze"><i class="fa fa-circle-o"></i>Haze</a>
                </li>
              </ul>
            </li>

            <!-- MANAGE CONTACTS -->
            <?php if ($user['role'] === 'Administrator') {
              if ($page == "agency" || $page == "subscribers"){ ?>  <li class= "active"> <?php }else{ ?> <li> <?php }?>
              <a href="#">
                <i class="fa fa-envelope"></i>
                <span>Contacts</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php if ($page == "agency"){ ?>  <li class= "active"> <?php }else{ ?> <li> <?php }?>
                  <a href="agency"><i class="fa fa-circle-o"></i>Agency</a>
                </li>
                <?php if ($page == "subscribers"){ ?>  <li class= "active"> <?php }else{ ?> <li> <?php }?>
                  <a href="subscriber"><i class="fa fa-circle-o"></i>Subscribers</a>
                </li>
              </ul>
            </li>
            <?php }?>

            <!-- MANAGE ACCOUNTS -->
            <?php if ($user['role'] === 'Administrator') {
              if ($page == "staff_account"){ ?>  <li class= "active"> <?php }else{ ?> <li> <?php }?>
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Accounts</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php if ($page == "staff_account"){ ?>  <li class= "active"> <?php }else{ ?> <li> <?php }?>
                  <a href="staff"><i class="fa fa-circle-o"></i>Staff Account</a>
                </li>
              </ul>
            </li>
            <?php }?>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <!-- .............................................END OF NAVIGATION............................................. -->
      
      <?= $this->fetch('content') ?>

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          Admin Panel
        </div>
        <strong>Copyright &copy; 2015 <a href="#">TIMECrisis</a>.</strong> All rights reserved.
      </footer>

    </div><!-- ./wrapper -->
      
    <!-- jQuery 2.1.3 -->
    <script src="../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="../plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="../plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="../plugins/chartjs/Chart.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../dist/js/pages/dashboard2.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js" type="text/javascript"></script>

    <!-- InputMask -->
    <script src="../plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="../plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="../plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>

    <!-- bootstrap-datetimepicker -->
    <script src="../bootstrap/js/collapse.js" type="text/javascript"></script>
    <script src="../bootstrap/js/transition.js" type="text/javascript"></script>
    <script src="../plugins/bootstrap-datetimepicker/moment.min.js"></script>
    <script src="../plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>

    <!-- bootstrap-notify -->
    <script src="../plugins/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- formvalidation -->
    <script src="../plugins/formvalidation/formValidation.min.js"></script>
    <script src="../plugins/formvalidation/bootstrap.min.js"></script>
    
    <!-- bootstrap-chosen -->
    <script src="../plugins/bootstrap-chosen/chosen.jquery.min.js"></script>

    <!-- datatables -->
    <script src="../plugins/datatables/jquery.dataTables.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.js"></script>

    <!-- Ladda -->
    <script src="/plugins/ladda/spin.min.js"></script>
    <script src="/plugins/ladda/ladda.min.js"></script>

    <?php
      switch ($page) {
        case 'agency':
          ?><script src="../script/agency.js"></script><?php
          break;
        case 'edit_profile':
          ?><script src="../script/edit_profile.js"></script><?php
          break;
        case 'incidents':
          ?>
          <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
          <script src="../dist/js/jquery.geocomplete.min.js"></script>
          <script src="../script/incidents.js"></script><?php
          break;
        case 'incident_category':
          ?><script src="../script/incident_categories.js"></script><?php
          break;
        case 'haze':
          ?><script src="../script/haze.js"></script><?php
          break;
        case 'dengue':
          ?><script src="../script/dengue.js"></script><?php
          break;
        case 'staff_account':
          ?><script src="../script/staff_accounts.js"></script><?php
          break;
        default:
          break;
      }
    ?>

    <?= $this->Flash->render(); ?>

  </body>
</html>

