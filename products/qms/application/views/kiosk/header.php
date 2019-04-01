
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>Kiosk - Queue Management System</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>dist/css/styles.css" rel="stylesheet">
	<script src="<?php echo base_url('dist/vendor/');?>jquery/jquery.min.js"></script>
	<script src="<?php echo base_url('dist/vendor/');?>jquery/jquery.min.js"></script>
	<script src="<?php echo base_url('dist/js/');?>kiosk.js"></script>
	<?php
	if(@sizeOf($logo) > 0)
	{
	?>
	<link rel="icon" href="<?php echo base_url('uploads/files/'.@$logo[0]->favicon);?>" type="image/png" sizes="16x16">
	<?php
	}
	?>
	<script  type="text/javascript">
		var baseurl="<?php echo base_url();?>";
	</script>
  </head>

  <body class="custombg">

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal"><img src="<?php echo base_url('uploads/files/'.@$logo[0]->logoFile);?>" class="logo" /></h5>
      <nav class="my-2 my-md-0 mr-md-3">
		 <h5 class="p-2 text-dark nomargin" >Welcome to User</h5>
      </nav>
      <span>	
		<button class="btn btn-outline-primary"><?php echo @date("D, d M Y");?><br /><span id="clock" class="fbold"></span></button>
    </div>

    
