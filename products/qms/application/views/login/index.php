
<section class="Welcome py-5 mh200">
	<div class="container py-sm-4">
		<div class="welcome-grids row">
			<div class="col-lg-12 mb-lg-0 mb-5">
				
				<div class="col-lg-4 mx-auto loginbg">
					<h3 class="mt-lg-0 txtCenter logoClrCon">
						Login
					</h3>
					<?php
					if(@$this->session->userdata('logFail') != '')
					{
					?>
					<h5 style="color:#FF0000;font-size:13px;font-weight:bold;">
						<?php echo @$this->session->userdata('logFail');
						@$this->session->unset_userdata('logFail');
						?>
					</h5>
					<?php
					}
					?>
					
					<form method="POST" action="<?php echo base_url('login/verifyMe');?>">
					  <div class="form-group">
						<label for="username">Username:</label>
						<input type="text" class="form-control" id="username" name="username" required />
					  </div>
					  <div class="form-group">
						<label for="password">Password:</label>
						<input type="password" class="form-control" id="password" name="password" required />
					  </div>
					  <div class="form-group txtCenter">
						<button type="submit" class="btn btn-warning txtCenter lgBtn">Submit</button>
						</div>
					</form>
				  </div>	
			</div>
		</div>	
	</div>	
</section>

