<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tecscilsolutions</title>

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
	<script src="<?php echo base_url('dist/vendor/');?>jquery/jquery.min.js"></script>
	<script type="text/javascript">
		var baseurl='<?php echo base_url();?>';
	</script>
  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bgfff1 navbg" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">
			<img src="<?php echo base_url('uploads/files/'.@$logo[0]->logoFile);?>" class="img-responsive s-logo" />
		</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger active1" href="<?php echo base_url();?>">Home</a>
            </li>
			<?php
			if(@$this->session->userdata('is_logged_in') == 1)
			{
			?>
			<li class="nav-item">
				<a class="nav-link js-scroll-trigger" href="<?php echo base_url('login/logout');?>">Logout</a>
			</li>
			<li class="nav-item">
				<span class="nav-link js-scroll-trigger">
				<?php echo @date("D, dS");?> &nbsp;<span id="clock" class="fbold" style="min-height:50px;">&nbsp;</span>
				</span>
			</li>
			<?php	
			}
			else
			{
			?>
			<li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?php echo base_url('about');?>">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?php echo base_url('services');?>">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?php echo base_url('portfolio');?>">Portfolio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?php echo base_url('contact');?>">Contact</a>
            </li>
			<?php
			}
			?>
          </ul>
        </div>
      </div>
    </nav>