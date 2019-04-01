<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <meta name="author" content="">
<?php
if(@sizeOf($metas) > 0)
{
	if(@$metas[0]->metaTitle != '')
	{
?>
    <title><?php echo @$metas[0]->metaTitle;?></title>
	<meta name="description" content="<?php echo @$metas[0]->metaDesc;?>" />
	<meta name="keywords" content="<?php echo @$metas[0]->metaKeys;?>" />
<?php		
	}
	else
	{
?>
    <title>Tecscilsolutions</title>
<?php
	}
}
else{
?>
    <title>Tecscilsolutions</title>
<?php
}
?>


    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('dist/vendor/');?>bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="<?php echo base_url('dist/vendor/');?>fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    
    <!-- Plugin CSS -->
    <link href="<?php echo base_url('dist/vendor/');?>magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('dist/css/');?>creative.css" rel="stylesheet">
    <link href="<?php echo base_url('dist/css/');?>styles.css" rel="stylesheet">
	<?php
	if(@sizeOf($logo) > 0)
	{
	?>
	<link rel="icon" href="<?php echo base_url('uploads/files/'.@$logo[0]->favicon);?>" type="image/png" sizes="16x16">
	<?php
	}
	?>
  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top1 bgfff1 navbg" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">
			<img src="<?php echo base_url('dist/img/logo.jpg');?>" class="img-responsive logo" />
		</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger  <?php if(@$menu == 'home'){echo 'active1';}?>" href="<?php echo base_url();?>">Home</a>
            </li>
			<!--<li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?php //echo base_url('about');?>">About</a>
            </li>-->
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger <?php if(@$menu == 'services'){echo 'active1';}?>" href="<?php echo base_url('services');?>">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger <?php if(@$menu == 'portfolio'){echo 'active1';}?>" href="<?php echo base_url('portfolio');?>">Portfolio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger <?php if(@$menu == 'contact'){echo 'active1';}?>" href="<?php echo base_url('contact');?>">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>