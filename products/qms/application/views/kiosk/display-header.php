
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
	<script src="<?php echo base_url('dist/js/');?>kiosk.js"></script>
	<!--<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>dist/js/jquery.jplayer.min.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>dist/js/sound.js"></script>-->
	<script  type="text/javascript">
		var baseurl="<?php echo base_url();?>";
	
	/* soundManager.setup({
	  useFlashBlock: true,
	  url: baseurl+'dist/swf/', // path to SoundManager2 SWF files (note trailing slash)
	  debugMode: false,
	  consoleOnly: true
	}); */
	</script>
  </head>

  <body class="displaybg">

    <div class="d-flex flex-column flex-md-row align-items-center px-md-4 bg-white border-bottom box-shadow" style="width:<?php echo @$items[0]->displayWidth;?>px;padding:0;margin:0 auto;">
      <h5 class="my-0 mr-md-auto font-weight-normal"><img src="<?php echo base_url('uploads/files/'.@$logo[0]->logoFile);?>" class="logo" /></h5>
      <nav class="my-2 my-md-0 mr-md-3">
		 <h5 class="p-2 text-dark nomargin" >Welcome to User</h5>
      </nav>
      <span>	
		<button class="btn btn-outline-primary"><?php echo @date("D, d M Y");?><br /><span id="clock" class="fbold" style="min-height:50px;">&nbsp;</span></button>
    </div>

    
