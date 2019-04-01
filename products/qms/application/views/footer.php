<footer class="p-0 footerbg">
    <div class="container py-5">
        <div class="row">
          <div class="col-lg-4 mx-auto text-center">
            <h2 class="txtLeft section-heading hfont">Menu</h2>
            <hr class="mleft0 my-4">
			<ul class="fmenus">
				<li>
					<a href="">About us</a>
				</li>
				<li>
					<a href="">Portfolio</a>
				</li>
				
				<li>
					<a href="">Blog</a>
				</li>
				<li>
					<a href="">Contact Us</a>
				</li>
				
			</ul>
          </div>
		  <div class="col-lg-4 mx-auto text-center">
            <h2 class="txtLeft section-heading hfont">Services</h2>
            <hr class="mleft0 my-4">
			<ul class="fmenus">
				<li>
					<a href="<?php echo base_url('website-design');?>">Website Design</a>
				</li>
				<li>
					<a href="<?php echo base_url('responsive-website');?>">Responsive Website</a>
				</li>
				
				<li>
					<a href="<?php echo base_url('custom-web-application');?>">Custom Web Application</a>
				</li>
				<li>
					<a href="<?php echo base_url('e-commerce application');?>">E-Commerce Application</a>
				</li>
				<li>
					<a href="<?php echo base_url('application-development');?>">Application Development</a>
				</li>
			</ul>
          </div>
		  <div class="col-lg-4 mx-auto text-center">
            <h2 class="txtLeft section-heading hfont">Get in Touch</h2>
            <hr class="mleft0 my-4">
			<ul class="fmenus">
				<li>
					<p>Techscil Solutions</p>
				</li>
				<li>
					<h5>Get Socials</h5>
					<ul class="socials">
					<?php
					if(@sizeOf($socials) > 0)
					{
						for($s=0;$s<sizeOf($socials);$s++)
						{
					?>
						<li>
							<a href="<?php echo @$socials[$s]->socURL;?>" target="_blank"><img src="<?php echo base_url('uploads/files/'.$socials[$s]->socIcon);?>" /></a>
						</li>
					<?php
						}
					}
					?>
						
					</ul>
				</li>
			</ul>
          </div>
        </div>
      </div>
	  <div class="container-fluid" style="background:#000;">
		<div class="container footst">
			All Rights reserved <?php echo @date("Y");?>
		</div>
	  </div>
</footer>
<!-- Bootstrap core JavaScript -->
    
    <script src="<?php echo base_url('dist/vendor/');?>bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="<?php echo base_url('dist/vendor/');?>jquery-easing/jquery.easing.min.js"></script>
    <script src="<?php echo base_url('dist/vendor/');?>scrollreveal/scrollreveal.min.js"></script>
    <script src="<?php echo base_url('dist/vendor/');?>magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="<?php echo base_url('dist/js/');?>creative.min.js"></script>
    <script src="<?php echo base_url('dist/js/');?>kiosk.js"></script>

  </body>

</html>
