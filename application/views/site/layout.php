<!DOCTYPE html>
<html>
	<head>
    <title><?php echo $title?></title>
		<?php $this -> load ->view('site/head')?>
	</head>

	<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">
      <?php $this -> load ->view('site/register',$this-> data)?>
      <?php $this -> load ->view('site/login',$this-> data)?>
    <!-- Main Header -->
 		<header class="main-header">
			<?php $this -> load ->view('site/header',$this-> data)?>
		</header>
    <!-- Left side column. contains the logo and sidebar -->
	  <aside class="main-sidebar">
		  <?php $this -> load ->view('site/main-sidebar',$this-> data) ?>
	  </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?php if($this-> data['message']) {
        $message=$this-> data['message'];
        echo "<script type='text/javascript'>alert('$message');</script>";
        }?>

      <?php $this -> load -> view($temp, $this-> data)?>
    </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
    <footer class="main-footer">
      <?php $this-> load -> view('site/footer',$this-> data) ?>
    </footer>
  </div>
<!-- ./wrapper -->
</html>

