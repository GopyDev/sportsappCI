<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title; ?> :: Admin panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
<?php
		 foreach($js as $file){
				echo "\n\t\t";
				?><script src="<?php echo $file; ?>"></script><?php
		 } echo "\n\t";
?>
<?php

		 foreach($css as $file){
		 	echo "\n\t\t";
			?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
		 } echo "\n\t";
?>
<?php
		if(!empty($meta))
			foreach($meta as $name=>$content){
				echo "\n\t\t";
				?><meta name="<?php echo $name; ?>" content="<?php echo is_array($content) ? implode(", ", $content) : $content; ?>" /><?php
		 }
	?>
</head>
<body>
<nav class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="<?php echo site_url(); ?>">Admin Panel: Events, details and map </a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-user"></i> <?php echo $user->username; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo site_url('user/'.$user->id); ?>">Profile</a></li>
              <li><a href="<?php echo site_url('logout'); ?>">Logout</a></li>
            </ul>
          </li>
        </ul>
        <!--<form class="navbar-search pull-right">
          <input type="text" class="search-query" placeholder="Search">
        </form>-->
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</nav>
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li <?php if ($section=='dashboard') echo 'class="active"'; ?>"><a href="<?php echo site_url(); ?>"><i class="icon-dashboard"></i><span>Dashboard</span> </a> </li>
        <li <?php if ($section=='pois') echo 'class="active"'; ?>><a href="<?php echo site_url('pois'); ?>"><i class="icon-map-marker"></i><span>Events</span> </a> </li>
        <li <?php if ($section=='users') echo 'class="active"'; ?>><a href="<?php echo site_url('users'); ?>"><i class="icon-user"></i><span>Users</span> </a></li>
        <li <?php if ($section=='notifications') echo 'class="active"'; ?>><a href="javascript:;" data-toggle="tooltip" data-placement="right" title="Coming soon!"><i class="icon-bell"></i><span>Notifications</span> </a> </li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->

<?php echo $output;?>

<div class="footer">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="span12"> &copy; 2016 <a href="http://www.bandst.com/">B&amp;ST</a> </div>
        <!-- /span12 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /footer-inner --> 
</div>
<!-- /footer -->
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
</body>
</html>