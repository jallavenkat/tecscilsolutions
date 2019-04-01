<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tecscilsolutions | </title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>uifiles/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>uifiles/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>uifiles/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url();?>uifiles/animate.css/animate.min.css" rel="stylesheet">
	<?php
	if(@sizeOf($logo) > 0)
	{
	?>
	<link rel="icon" href="<?php echo base_url('uploads/files/'.@$logo[0]->favicon);?>" type="image/png" sizes="16x16">
	<?php
	}
	?>
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>uifiles/build/css/custom.min.css" rel="stylesheet">
	<script src="<?php echo base_url();?>uifiles/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript">
		var baseurl='<?php echo base_url()?>';
	</script>
	<script src="<?php echo base_url();?>uifiles/js/venjos.js"></script>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
		  <?php
		  if(@$this->session->userdata('lFail') != '')
		  {
			?>
			<div class="alert alert-danger alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
				</button>
				<?php
				echo @$this->session->userdata('lFail');
				@$this->session->unset_userdata('lFail');
				?>
			</div>
			<?php
		  }
		  ?>
            <form id="uLogin" class="uLogin">
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" name="uEmail" id="uEmail" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="uPassword" id="uPassword" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" id="login">Log in</a>
                <a class="reset_pass" href="javascript:;" id="forgotpassword">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Tecscilsolutions</h1>
                  <p>©<?php echo @date("Y");?> All Rights Reserved. Tecscilsolutions</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Tecscilsolutions</h1>
                  <p>©2016 All Rights Reserved. Tecscilsolutions is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
