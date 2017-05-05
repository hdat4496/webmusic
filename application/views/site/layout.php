<!DOCTYPE html>
<html>
	<head>
		<?php $this -> load ->view('site/head')?>
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
    <!-- Main Header -->
 		<header class="main-header">
			<?php $this -> load ->view('site/header')?>
		</header>
    <!-- Left side column. contains the logo and sidebar -->
	  <aside class="main-sidebar">
		  <?php $this -> load ->view('site/main-sidebar') ?>
	  </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?php $this -> load -> view($temp)?>
    </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
    <footer class="main-footer">
      <?php $this-> load -> view('site/footer') ?>
    </footer>
  </div>
<!-- ./wrapper -->
</html>

